<?php

namespace App\Repositories;

use App\Models\ChapterVideo;

class ChapterVideoRepository extends BaseRepository
{
    public function __construct(
        protected ChapterVideo $chapterVideo
    )
    {
        parent::__construct($chapterVideo);
    }
}
