<?php

namespace App\Http\Controllers\Web\FileManage;

use UniSharp\LaravelFilemanager\Controllers\ItemsController;
use Illuminate\Support\Facades\Storage;

class CustomItemsController extends ItemsController
{
    public function getItems(): array
    {
        $currentPage = self::getCurrentPageFromRequest();
        $perPage = $this->helper->getPaginationPerPage();
        $items = array_merge($this->lfm->folders(), $this->lfm->files());

        $workingDir = $this->lfm->path('working_dir');
        $parentDir = trim(dirname($workingDir), '.\/');
        $parentDir = !$parentDir ? '/shares' : $parentDir;

        $dirs = Storage::disk('public')->directories('users/'.$parentDir);
        $rootFolders = collect($dirs)->map(function ($dir) {
            return (object) [
                'url' => str_starts_with($dir, 'users/') ? substr($dir, strlen('users')) : $dir,
                'name' => basename($dir),
                'children' => [],
            ];
        })->values();

        return [
            'items' => array_map(function ($item) {
                return $item->fill()->attributes;
            }, array_slice($items, ($currentPage - 1) * $perPage, $perPage)),
            'paginator' => [
                'current_page' => $currentPage,
                'total' => count($items),
                'per_page' => $perPage,
            ],
            'display' => $this->helper->getDisplayMode(),
            'working_dir' => $workingDir,
            'view_tree' => view('laravel-filemanager::tree')->with(['root_folders' => $rootFolders])->render()
        ];
    }

    protected static function getCurrentPageFromRequest(): int
    {
        $currentPage = (int) request()->get('page', 1);
        return max($currentPage, 1);
    }
}
