<?php

namespace App\Http\Controllers\Web;

use App\Services\BaseService;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Controller extends BaseController
{
    public function __construct(
        protected BaseService $service,
        protected string $viewPath
    ) {
        parent::__construct($service);
    }

    public function index(Request $request): View
    {
        $data = $this->service->index($request);
        return view($this->viewPath.'.index', $data);
    }

    public function filterCard(Request $request): string
    {
        $data = $this->service->index($request);
        return view($this->viewPath.'.filter_card', $data)->render();
    }

    public function filterModal(Request $request): string
    {
        $data = $this->service->index($request);
        return view($this->viewPath.'.filter_modal', $data)->render();
    }

    public function filter(Request $request): string
    {
        $data = $this->service->filter($request);
        return view($this->viewPath.'.filter', $data)->render();
    }

    public function create(Request $request): string
    {
        $data = $this->service->create($request);
        return view($this->viewPath.'.create', $data)->render();
    }

    public function detail(int|string $id, Request $request): View
    {
        $data = $this->service->detail($id, $request);
        return view($this->viewPath.'.detail', $data);
    }

    public function show(int|string $id, Request $request): View|string
    {
        $data = $this->service->show($id, $request);
        return view($this->viewPath.'.show', $data);
    }

    public function edit(int|string $id, Request $request): string
    {
        $data = $this->service->edit($id, $request);
        return view($this->viewPath.'.edit', $data)->render();
    }

    public function createImport(Request $request): string
    {
        $data = $this->service->createImport($request);
        return view($this->viewPath.'.create_import', $data)->render();
    }

    public function downloadImport(): BinaryFileResponse
    {
        return $this->service->downloadImport();
    }

    public function export(Request $request): BinaryFileResponse
    {
        return $this->service->export($request);
    }
}
