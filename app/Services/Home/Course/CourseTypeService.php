<?php

namespace App\Services\Home\Course;

use App\Repositories\CourseTypeRepository;
use App\Services\BaseService;

class CourseTypeService extends BaseService
{
    public function __construct(
        protected CourseTypeRepository $courseTypeRepository
    )
    {
        parent::__construct($courseTypeRepository);
    }
}
