<?php

namespace App\Services\Admin\Course;

use App\Repositories\ChapterRepository;
use App\Repositories\TypeRepository;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ChapterService extends BaseService
{
    public function __construct(
        protected ChapterRepository $chapterRepository,
        protected TypeRepository $typeRepository
    )
    {
        parent::__construct($chapterRepository);
    }

    public function filter(Request $request): array
    {
        $chapters = $this->chapterRepository->get($request->all(), ['types', 'videos.type', 'documents.type']);
        $chapters->each(function ($chapter) {
            $chapter->items = $chapter->videos
                ->concat($chapter->documents)
                ->sortBy('order_number')
                ->values();
        });

        return [
            'chapters' => $chapters,
            'orderByName' => $request->orderByName,
            'orderByType' => $request->orderByType,
            'viewType' => $request->viewType
        ];
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['types'] = $this->typeRepository->getActiveByModule('course');
        return $data;
    }

    public function store(Request $request): Model|array|null
    {
        $createData = $request->validated();
        $createData['slug'] = formatSlug($createData['name']);
        $chapter = $this->chapterRepository->create($createData);
        if ($request->type_ids) {
            $chapter->types()->attach($request->type_ids);
        }
        return $chapter;
    }

    public function edit(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['chapter'] = $this->chapterRepository->find($id);
        $data['types'] = $this->typeRepository->getActiveByModule('course');
        return $data;
    }

    public function update(string|int $id, Request $request): array|bool|null
    {
        $updateData = $request->validated();
        if (isset($updateData['name'])) {
            $updateData['slug'] = formatSlug($updateData['name']);
        }
        $this->chapterRepository->update($id, $updateData);

        $chapter = $this->chapterRepository->find($id);
        if ($request->type_ids) {
            $chapter->types()->sync($request->type_ids);
        }
        return true;
    }
}
