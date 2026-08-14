<?php

namespace App\Services\Admin\Setting;

use App\Repositories\ChannelRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class ChannelService extends BaseService
{
    public function __construct(
        protected ChannelRepository $channelRepository
    )
    {
        parent::__construct($channelRepository);
    }
}
