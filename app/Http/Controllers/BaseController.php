<?php

namespace App\Http\Controllers;

use App\Services\BaseService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(
        protected BaseService $service
    )
    {
    }

    public function destroy(int|string $id): JsonResponse
    {
        if (!$this->service->destroy($id)) {
            return $this->responseError(__('app.message.destroy_error'));
        }
        return $this->responseSuccess(__('app.message.destroy_success'));
    }

    public function destroyMany(Request $request): JsonResponse
    {
        if (!$this->service->destroyMany($request)) {
            return $this->responseError(__('app.message.destroy_error'));
        }
        return $this->responseSuccess(__('app.message.destroy_success'));
    }

    public function responseSuccess(string $message = '', ?array $data = null, int $status = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => $message,
            'data' => $data
        ], $status);
    }

    public function responseError(string $message = '', ?array $errors = null, int $status = 400): JsonResponse
    {
        return response()->json([
            'status' => false,
            'type' => 'error',
            'message' => $message,
            'errors' => $errors
        ], $status);
    }
}
