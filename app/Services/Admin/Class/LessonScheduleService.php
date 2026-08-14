<?php

namespace App\Services\Admin\Class;

use App\Repositories\CenterRepository;
use App\Repositories\ClassRoomRepository;
use App\Repositories\LessonRepository;
use App\Repositories\LessonScheduleRepository;
use App\Repositories\TypeRepository;
use App\Services\BaseService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessonScheduleService extends BaseService
{
    public function __construct(
        protected LessonScheduleRepository $lessonScheduleRepository,
        protected TypeRepository           $typeRepository,
        protected CenterRepository         $centerRepository,
        protected ClassRoomRepository      $classRoomRepository,
        protected LessonRepository $lessonRepository
    )
    {
        parent::__construct($lessonScheduleRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['types'] = $this->typeRepository->getActiveByModule('lesson');
        return $data;
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['types'] = $this->typeRepository->getActiveByModule('lesson');
        $data['centers'] = $this->centerRepository->get();
        return $data;
    }

    public function createLesson(Request $request): array
    {
        return $request->all();
    }

    public function expectedSchedule(Request $request): array
    {
        return $this->storeLesson($request, false);
    }

    public function storeLesson(Request $request, bool $isCreate = true): array
    {
        $lessonSchedules = $this->lessonScheduleRepository->get(['ids' => explode(',', $request->ids)])->toArray();
        $schedules = $this->getScheduleByTime($lessonSchedules, Carbon::parse($request->start_date), Carbon::parse($request->end_date));

        $rules = [
            'date' => 'unique_date:holidays,date',
            'start_time' => 'unique_datetime:lessons,date,start_time,end_time,class_id',
            'classroom_id' => 'nullable|unique_datetime:lessons,date,start_time,end_time,classroom_id',
        ];

        $logs = [];
        foreach ($schedules as $schedule) {
            $date = Carbon::parse($schedule['date']);
            $lessonName = ucfirst($date->translatedFormat('l')).' ('.$date->format('d-m-Y').')';

            $validator = Validator::make($schedule, $rules);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                $logs[] = [
                    'status' => false,
                    'name' => $lessonName,
                    'message' => $errors[0] ?? ''
                ];
                continue;
            }

            $logs[] = [
                'status' => true,
                'name' => $lessonName,
                'message' => $isCreate ? __('app.message.create_success') : __('app.message.can_create')
            ];

            if ($isCreate) {
                $schedule['name'] = $lessonName;
                $schedule['status_id'] = env('APP_DEFAULT_LESSON_STATUS_ID');
                $this->lessonRepository->create($schedule);
            }
        }
        return ['logs' => $logs];
    }

    private function getScheduleByTime(mixed $lessonSchedules, ?Carbon $start, ?Carbon $end): ?array
    {
        $schedules = [];
        foreach ($lessonSchedules as $lessonSchedule) {
            $weekday = $lessonSchedule['day_of_week'] % 7;
            $date = $start->copy();
            while ($date->dayOfWeek !== $weekday) {
                $date->addDay();
            }

            while ($date->lte($end)) {
                $lessonSchedule['date'] = $date->format('Y-m-d');
                unset($lessonSchedule['id'], $lessonSchedule['content'], $lessonSchedule['value'], $lessonSchedule['created_at'], $lessonSchedule['updated_at']);
                $schedules[] = $lessonSchedule;
                $date->addWeek();
            }
        }
        usort($schedules, fn($a, $b) => strcmp($a['date'], $b['date']));
        return $schedules;
    }

    public function edit(string|int $id, Request $request): array
    {
        $lessonSchedule = $this->lessonScheduleRepository->find($id);

        $data = $request->all();
        $data['lessonSchedule'] = $lessonSchedule;
        $data['types'] = $this->typeRepository->getActiveByModule('lesson');
        $data['centers'] = $this->centerRepository->get();
        $data['classrooms'] = $this->classRoomRepository->get(['center_id' => $lessonSchedule->center_id]);
        return $data;
    }
}
