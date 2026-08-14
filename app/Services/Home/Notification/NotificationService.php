<?php

namespace App\Services\Home\Notification;

use App\Repositories\NotificationRepository;
use App\Services\BaseService;

class NotificationService extends BaseService
{
    public function __construct(
        protected NotificationRepository $notificationRepository
    )
    {
        parent::__construct($notificationRepository);
    }
}
