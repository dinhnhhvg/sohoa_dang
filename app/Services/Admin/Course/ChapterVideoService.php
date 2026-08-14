<?php

namespace App\Services\Admin\Course;

use App\Repositories\ChapterVideoRepository;
use App\Repositories\TypeRepository;
use App\Repositories\VideoRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class ChapterVideoService extends BaseService
{
    public function __construct(
        protected ChapterVideoRepository $chapterVideoRepository,
        protected TypeRepository         $typeRepository,
        protected VideoRepository        $videoRepository
    )
    {
        parent::__construct($chapterVideoRepository);
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['types'] = $this->typeRepository->getActiveByModule('video');
        $data['videos'] = $this->videoRepository->get(null, ['category']);
        return $data;
    }

    public function edit(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['chapterVideo'] = $this->chapterVideoRepository->find($id);
        $data['types'] = $this->typeRepository->getActiveByModule('video');
        $data['videos'] = $this->videoRepository->get(null, ['category']);
        return $data;
    }
}
