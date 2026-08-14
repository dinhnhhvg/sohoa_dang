<?php

namespace App\Repositories;

use App\Models\CourseType;

class CourseTypeRepository extends BaseRepository
{
    public function __construct(
        protected CourseType $courseType
    )
    {
        parent::__construct($this->courseType);
    }
}
