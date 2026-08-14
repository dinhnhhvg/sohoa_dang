<?php

namespace App\Http\Controllers\Web\Admin\Resource;

use App\Exports\Admin\VideoExport;
use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Resource\Video\StoreManyRequest;
use App\Http\Requests\Admin\Resource\Video\StoreRequest;
use App\Http\Requests\Admin\Resource\Video\UpdateRequest;
use App\Services\Admin\Resource\VideoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class VideoController extends Controller
{
    public function __construct(
        protected VideoService $videoService
    )
    {
        parent::__construct($videoService, env('APP_VIEW_PATH_ADMIN').'.resource.video');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->videoService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function storeMany(StoreManyRequest $request): JsonResponse
    {
        if (!$this->videoService->storeMany($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->videoService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }

    public function export(Request $request): BinaryFileResponse
    {
        $data = $this->videoService->get($request->all());
        return Excel::download(new VideoExport($data), 'videos.xlsx');
    }
}
