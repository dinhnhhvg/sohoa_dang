<?php

namespace App\Repositories;

use App\Models\ItemTopic;

class ItemTopicRepository extends BaseRepository
{
    public function __construct(
        protected ItemTopic $itemTopic,
    )
    {
        parent::__construct($itemTopic);
    }

    public function syncTopic(string $itemType, string|int $courseId, ?array $topicIds): void
    {
        if (!$topicIds) {
            return;
        }
        $this->model->where('item_id', $courseId)
            ->where('item_type', $itemType)
            ->whereNotIn('topic_id', $topicIds)
            ->delete();

        foreach ($topicIds as $topicId) {
            $this->model->firstOrCreate([
                'item_id'   => $courseId,
                'item_type' => $itemType,
                'topic_id'  => $topicId,
            ]);
        }
    }
}
