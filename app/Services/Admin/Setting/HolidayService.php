<?php

namespace App\Services\Admin\Setting;

use App\Repositories\HolidayRepository;
use App\Services\BaseService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class HolidayService extends BaseService
{
    public function __construct(
        protected HolidayRepository $holidayRepository
    )
    {
        parent::__construct($holidayRepository);
    }

    public function store(Request $request): Model|array|null
    {
        $createData = $request->validated();
        $createData['date'] = Carbon::parse($createData['date'])->format('Y-m-d');
        return $this->holidayRepository->create($createData);
    }

    public function update(string|int $id, Request $request): array|bool|null
    {
        $updateData = $request->validated();
        if (isset($updateData['date'])) {
            $updateData['date'] = Carbon::parse($updateData['date'])->format('Y-m-d');
        }
        return $this->holidayRepository->update($id, $updateData);
    }
}
