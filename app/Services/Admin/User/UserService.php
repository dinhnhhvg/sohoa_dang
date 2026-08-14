<?php

namespace App\Services\Admin\User;

use App\Exports\Admin\UserExport;
use App\Http\Requests\Admin\User\User\StoreRequest;
use App\Repositories\CenterRepository;
use App\Repositories\ConversationRepository;
use App\Repositories\ProvinceRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Repositories\WardRepository;
use App\SampleExports\UserSampleExport;
use App\Services\Admin\Log\ImportLogService;
use App\Services\BaseService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class UserService extends BaseService
{
    public function __construct(
        protected UserRepository         $userRepository,
        protected RoleRepository         $roleRepository,
        protected CenterRepository       $centerRepository,
        protected ProvinceRepository     $provinceRepository,
        protected WardRepository         $wardRepository,
        protected ConversationRepository $conversationRepository,

        protected ImportLogService       $importLogService
    )
    {
        parent::__construct($userRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['roles'] = $this->roleRepository->get();
        $data['centers'] = $this->centerRepository->get();
        $data['provinces'] = $this->provinceRepository->get();
        return $data;
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['roles'] = $this->roleRepository->get();
        $data['centers'] = $this->centerRepository->get();
        $data['provinces'] = $this->provinceRepository->get();
        return $data;
    }

    public function store(Request $request): Model|array|null
    {
        return $this->storeUser($request->validated());
    }

    public function storeUser(array $createData): Model|array|null
    {
        $createData['code'] = 'CODE';
        $createData['birth_date'] = Carbon::parse($createData['birth_date'])->format('Y-m-d');
        $createData['is_active'] = 1;
        $createData['password'] = Hash::make(env('APP_DEFAULT_PASSWORD'));

        $user = $this->userRepository->create($createData);
        $updateData['code'] = str_pad($user->id, 6, '0', STR_PAD_LEFT);
        $this->userRepository->update($user->id, $updateData);
        return $this->userRepository->find($user->id);
    }

    public function createImport(Request $request): array
    {
        $data = $request->all();
        $data['roles'] = $this->roleRepository->get();
        return $data;
    }

    public function downloadImport(): BinaryFileResponse
    {
        return Excel::download(new UserSampleExport(), 'users.xlsx');
    }

    public function storeImport(Request $request): array|null
    {
        $sheets = Excel::toArray((object)[], public_path($request->input('file_path')));
        $sheet = $sheets[0] ?? [];

        $rules = (new StoreRequest())->rules();

        $logData = [];
        foreach ($sheet as $i => $row) {
            if ($i == 0) {
                continue;
            }

            $row = cleanExcelValue($row, 4);
            $createData = [
                'name' => $row[0],
                'phone' => (!str_starts_with($row[1], '0')) ? '0' . $row[1] : $row[1],
                'email' => $row[2],
                'avatar' => env('APP_DEFAULT_AVATAR'),
                'gender' => $row[3],
                'birth_date' => $row[4],
                'role_id' => $request->input('role_id')
            ];

            $validator = Validator::make($createData, $rules);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                $logData[] = [
                    'status' => false,
                    'name' => __('app.row') . ' ' . $i + 1,
                    'value' => $row,
                    'message' => $errors[0] ?? ''
                ];
                continue;
            }

            $this->storeUser($createData);

            $logData[] = [
                'status' => true,
                'name' => __('app.row') . ' ' . $i + 1,
                'value' => $row,
                'message' => __('app.message.create_success')
            ];
        }

        $importLog = $this->importLogService->storeImportLog('user', $request->input('file_path'), $logData);
        return [
            'status' => true,
            'url' => route('admin.import_log.show', ['import_log' => $importLog->id])
        ];
    }


    public function show(string|int $id, Request $request): array
    {
        $user = $this->userRepository->find($id);

        $data = $request->all();
        $data['user'] = $user;
        $data['roles'] = $this->roleRepository->get();
        $data['centers'] = $this->centerRepository->get();
        $data['provinces'] = $this->provinceRepository->get();
        $data['wards'] = $this->wardRepository->get(['province_id' => [$user->province_id]]);
        return $data;
    }

    public function update(string|int $id, Request $request): array|bool|null
    {
        $updateData = $request->validated();
        if (isset($updateData['password'])) {
            $updateData['password'] = Hash::make($updateData['password']);
        }
        if (isset($updateData['birth_date'])) {
            $updateData['birth_date'] = Carbon::parse($updateData['birth_date'])->format('Y-m-d');
        }
        if (!$this->userRepository->update($id, $updateData)) {
            return false;
        }
        if (session('user_id') == $id) {
            createLoginSession('user', $this->repository->find(Auth::id()));
        }
        return true;
    }

    public function export(Request $request): BinaryFileResponse
    {
        $data = $this->repository->get($request->all());
        return Excel::download(new UserExport($data), 'users.xlsx');
    }

    public function info(Request $request): array
    {
        $data['unread_conversations_count'] = $this->conversationRepository->getUnreadConversationsCount();
        return $data;
    }
}
