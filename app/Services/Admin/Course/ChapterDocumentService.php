<?php

namespace App\Services\Admin\Course;

use App\Repositories\ChapterDocumentRepository;
use App\Repositories\TypeRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class ChapterDocumentService extends BaseService
{
    public function __construct(
        protected ChapterDocumentRepository $chapterDocumentRepository,
        protected TypeRepository            $typeRepository
    )
    {
        parent::__construct($chapterDocumentRepository);
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['types'] = $this->typeRepository->getActiveByModule('document');
        return $data;
    }

    public function edit(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['chapterDocument'] = $this->chapterDocumentRepository->find($id);
        $data['types'] = $this->typeRepository->getActiveByModule('document');
        return $data;
    }
}
