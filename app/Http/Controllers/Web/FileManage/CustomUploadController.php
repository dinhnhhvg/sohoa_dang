<?php

namespace App\Http\Controllers\Web\FileManage;

use Error;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use UniSharp\LaravelFilemanager\Controllers\UploadController;
use UniSharp\LaravelFilemanager\Lfm;

class CustomUploadController extends UploadController
{
    public function upload(): JsonResponse
    {
        $uploaded_files = request()->file('upload');
        $error_bag = [];
        $new_filename = null;

        if (session('account') == 'user') {
            $type = request('type');
            $folderBase = config('lfm.folder_categories')[$type]['folder_name'];
            $folder = $folderBase.'/'.session($type.'_id');

            $info = getProjectDiskInfo(Storage::disk(config('lfm.disk'))->path($folder));
            $size = $info['size'];
            $maxSize = env('APP_FILE_MANAGE_CUSTOMER_FOLDER_SIZE')*1024*1024*1024;
        }

        foreach (is_array($uploaded_files) ? $uploaded_files : [$uploaded_files] as $file) {
            try {
                $this->lfm->validateUploadedFile($file);

                if (isset($size, $maxSize)) {
                    $newFileSize = $file->getSize();
                    $totalSize = $size + $newFileSize;
                    if ($totalSize > $maxSize) {
                        $error_bag[] = __('app.file_manage.your_folder_count_has_exceeded_the_allowed_limit').' ('.env('APP_FILE_MANAGE_CUSTOMER_FOLDER_SIZE').'GB)';
                    } else {
                        $new_filename = $this->lfm->upload($file);
                    }
                } else {
                    $new_filename = $this->lfm->upload($file);
                }
            } catch (Exception $e) {
                Log::error($e->getMessage(), [
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString()
                ]);
                $error_bag[] = $e->getMessage();
            } catch (Error $e) {
                Log::error($e->getMessage(), [
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString()
                ]);
                $error_bag[] = __('app.file_manage.some_error_occured_during_uploading');
            }
        }

        if (is_array($uploaded_files)) {
            $response = count($error_bag) > 0 ? $error_bag : parent::$success_response;
        } else if (is_null($new_filename)) {
            $response = [
                'error' => [ 'message' =>  $error_bag[0] ]
            ];
        } else {
            $url = $this->lfm->setName($new_filename)->url();

            $response = [
                'url' => $url,
                'uploaded' => $url
            ];
        }
        return response()->json($response);
    }

    public function uploadFolder(): JsonResponse
    {
        $files = request()->file('files');
        $paths = request()->input('paths');

        $type = request('type');
        $folderBase = config('lfm.folder_categories')[$type]['folder_name'];
        $workingDir = request()->input('working_dir');
        $folder = $folderBase.$workingDir;

        foreach ($files as $i => $file) {
            $relativePath = $folder.'/'.$paths[$i];
            Storage::disk(config('lfm.disk'))->put($relativePath, file_get_contents($file));
        }
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => __('app.message.create_success'),
            'data' => []
        ], 200);
    }
}
