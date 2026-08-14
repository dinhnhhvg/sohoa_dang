<?php

namespace App\Repositories;

use App\Models\ChapterDocument;

class ChapterDocumentRepository extends BaseRepository
{
    public function __construct(
        protected ChapterDocument $chapterDocument
    )
    {
        parent::__construct($chapterDocument);
    }
}
