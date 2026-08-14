<?php

namespace App\Services\Home\Category;

use App\Repositories\TopicRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class TopicService extends BaseService
{
    public function __construct(
        protected TopicRepository $topicRepository
    )
    {
        parent::__construct($topicRepository);
    }

    public function getByCategory(Request $request): array
    {
        $filters['category_id'] = $request->input('category_id');
        return [
            'topics' => $this->topicRepository->get($filters)
        ];
    }
}
