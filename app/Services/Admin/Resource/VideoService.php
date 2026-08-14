<?php

namespace App\Services\Admin\Resource;

use App\Libraries\BunnyLibrary;
use App\Libraries\VdoCipherLibrary;
use App\Repositories\CategoryRepository;
use App\Repositories\TypeRepository;
use App\Repositories\VideoRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class VideoService extends BaseService
{
    public function __construct(
        protected VideoRepository $videoRepository,
        protected TypeRepository $typeRepository,
        protected CategoryRepository $categoryRepository,
        protected VdoCipherLibrary $vdoCipherLibrary,
        protected BunnyLibrary $bunnyLibrary
    )
    {
        parent::__construct($videoRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['types'] = $this->typeRepository->getActiveByModule('video_security');
        $data['categories'] = $this->categoryRepository->get(['module' => 'video_security']);
        return $data;
    }

    public function filter(Request $request): array
    {
        $videos = $this->videoRepository->get($request->all(), ['category', 'type']);
        foreach ($videos as $video) {
            if ($video->type->code === env('VDOCIPHER_CODE')) {
                $video->video = $this->vdoCipherLibrary->findById($video->videoId);
            }
            if ($video->type->code === env('BUNNY_CODE')) {
                $video->video = $this->bunnyLibrary->findById($video->videoId);
            }
        }

        return [
            'videos' => $videos,
            'orderByName' => $request->orderByName,
            'orderByType' => $request->orderByType,
            'viewType' => $request->viewType
        ];
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['types'] = $this->typeRepository->getActiveByModule('video_security');
        $data['categories'] = $this->categoryRepository->get(['module' => 'video_security']);
        return $data;
    }

    public function storeMany(Request $request): bool
    {
        $files = $request->file('video');
        foreach ($files as $file) {
            if ($request->type === env('VDOCIPHER_CODE')) {
                $videoId = $this->vdoCipherLibrary->upload($file);
            }
            if ($request->type === env('BUNNY_CODE')) {
                $videoId = $this->bunnyLibrary->upload($file);
            }

            if (isset($videoId) && $videoId) {
                $createData = [
                    'type_id' => $request->type_id,
                    'category_id' => env('APP_DEFAULT_VIDEO_CATEGORY_ID'),
                    'name' => $file->getClientOriginalName(),
                    'videoId' => $videoId,
                    'duration' => 1
                ];
                $this->videoRepository->create($createData);
            }
        }
        return true;
    }

    public function edit(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['video'] = $this->videoRepository->find($id);
        $data['types'] = $this->typeRepository->getActiveByModule('video_security');
        $data['categories'] = $this->categoryRepository->get(['module' => 'video_security']);
        return $data;
    }

    public function show(string|int $id, Request $request): array
    {
        $video = $this->videoRepository->find($id);
        if ($video->type->code === env('VDOCIPHER_CODE')) {
            $video->video = $this->vdoCipherLibrary->playById($video->videoId);
        }
        return [
            'video' => $video
        ];
    }

    public function destroy(int|string $id): ?bool
    {
        $video = $this->videoRepository->find($id);
        if ($video->type->code === env('VDOCIPHER_CODE')) {
            $this->vdoCipherLibrary->deleteById($video->videoId);
        }
        if ($video->type->code === env('BUNNY_CODE')) {
            $this->bunnyLibrary->deleteById($video->videoId);
        }
        return $this->videoRepository->delete($id);
    }
}
