<?php

namespace App\Services\Admin\Course;

use App\Exports\Admin\UserExport;
use App\Libraries\VdoCipherLibrary;
use App\Models\Course;
use App\Repositories\CategoryRepository;
use App\Repositories\CourseRepository;
use App\Repositories\ItemTopicRepository;
use App\Repositories\LevelRepository;
use App\Repositories\TopicRepository;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CourseService extends BaseService
{
    public function __construct(
        protected CourseRepository   $courseRepository,
        protected CategoryRepository $categoryRepository,
        protected TopicRepository    $topicRepository,
        protected LevelRepository    $levelRepository,
        protected VdoCipherLibrary $vdoCipherLibrary,
        protected ItemTopicRepository $itemTopicRepository
    )
    {
        parent::__construct($courseRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['categories'] = $this->categoryRepository->get();
        $data['levels'] = $this->levelRepository->get();
        return $data;
    }

    public function filter(Request $request): array
    {
        $data = $request->all();
        $data['courses'] = $this->courseRepository->get(['category', 'level', 'topics', 'courseTypes.type']);
        return $data;
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['categories'] = $this->categoryRepository->get();
        $data['levels'] = $this->levelRepository->get();
        return $data;
    }

    public function store(Request $request): Model|array|null
    {
        $course = $this->courseRepository->create($this->handleData($request->validated()));
        $this->itemTopicRepository->syncTopic(Course::class, $course->id, $request->input('topic_id'));
        return $course;
    }

    private function handleData(?array $data): array
    {
        if ($data['name']) {
            $data['slug'] = formatSlug($data['name']);
        }
        if ($data['price']) {
            $data['price'] = formatSlug($data['price']);
        }
        unset($data['topic_id']);
        return $data;
    }

    public function show(string|int $id, Request $request): array
    {
        $course = $this->courseRepository->find($id, ['chapters.types', 'chapters.videos.video.type', 'chapters.videos.type', 'chapters.documents.type']);

        if ($request->type_id) {
            $typeId = $request->type_id;
            $course->chapters = $course->chapters->filter(function ($chapter) use ($typeId) {
                return $chapter->types->contains('id', $typeId);
            })->values();
        }

        $activeTitle = $course->name;
        $chapter = null;

        if ($request->video_id) {
            $video = $course->chapters
                ->flatMap(fn($chapter) => $chapter->videos)
                ->firstWhere('id', $request->video_id);

            if ($video) {
                $activeTitle = $video->name;
                $chapter = $course->chapters->firstWhere('id', $video->chapter_id);
                if ($video->video?->type?->code === env('VDOCIPHER_CODE')) {
                    $video->video->play = $this->vdoCipherLibrary->playById($video->video->videoId);
                }
            }
        } elseif ($request->document_id) {
            $document = $course->chapters
                ->flatMap(fn($chapter) => $chapter->documents)
                ->firstWhere('id', $request->document_id);

            if ($document) {
                $activeTitle = $document->name;
                $chapter = $course->chapters->firstWhere('id', $document->chapter_id);
            }
        }

        $course->chapters->each(function ($chapter) {
            $chapter->items = $chapter->videos
                ->concat($chapter->documents)
                ->sortBy('order_number')
                ->values();
        });

        $data = $request->all();
        $data['course'] = $course;
        $data['chapter'] = $chapter ?? null;
        $data['video'] = $video ?? null;
        $data['document'] = $document ?? null;
        $data['activeTitle'] = $activeTitle;
        $data['type_id'] = $request->type_id;
        return $data;
    }

    public function edit(string|int $id, Request $request): array
    {
        $data = $request->all();
        $course = $this->courseRepository->find($id);
        $data['course'] = $course;
        $data['categories'] = $this->categoryRepository->get();
        $data['topics'] = $this->topicRepository->get(['category_ids' => [$course->category_id]]);
        $data['levels'] = $this->levelRepository->get();
        return $data;
    }

    public function update(string|int $id, Request $request): array|bool|null
    {
        $updateData = $request->validated();
        if (isset($updateData['topic_id'])) {
            $this->itemTopicRepository->syncTopic(Course::class, $id, $updateData['topic_id']);
        }
        return $this->courseRepository->update($id, $this->handleData($updateData));
    }

    public function export(Request $request): BinaryFileResponse
    {
        $data = $this->repository->get($request->all());
        return Excel::download(new UserExport($data), 'users.xlsx');
    }
}
