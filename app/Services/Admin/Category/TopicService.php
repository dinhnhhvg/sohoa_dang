<?php

namespace App\Services\Admin\Category;

use App\Repositories\TopicRepository;
use App\Services\BaseService;

class TopicService extends BaseService
{
    public function __construct(
        protected TopicRepository $topicRepository
    )
    {
        parent::__construct($topicRepository);
    }
}
