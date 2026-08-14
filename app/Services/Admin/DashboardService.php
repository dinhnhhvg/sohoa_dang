<?php

namespace App\Services\Admin;

use App\Repositories\BatchRepository;
use App\Repositories\OldAgencyRepository;
use App\Repositories\SettingRepository;
use App\Repositories\StatusRepository;
use App\Repositories\TypeRepository;
use App\Services\BaseService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardService extends BaseService
{
    public function __construct(
        protected SettingRepository $settingRepository,
        protected StatusRepository $statusRepository,
        protected TypeRepository $typeRepository,
        protected OldAgencyRepository $oldAgencyRepository,
    )
    {
        parent::__construct($settingRepository);
    }

    public function index(Request $request): array
    {
        $onlineUsers = cache()->get('online-users', []);
        $onlineCount = collect($onlineUsers)
            ->filter(fn ($last) => $last >= now()->subMinutes(5)->timestamp)
            ->count();

        $data = $request->all();
        $data['onlineCount'] = $onlineCount;
        $data['batchStatuses'] = $this->statusRepository->get(['module' => 'batch'], [], ['batches']);
        $data['warnings'] = [];
        $data['today'] = Carbon::today();
        $data['lastToday'] = Carbon::today()->subWeek();

        $data['oldAgencies'] = $this->oldAgencyRepository->get();
        $data['statuses'] = $this->statusRepository->getActiveByModule('judgment');
        return $data;
    }
}
