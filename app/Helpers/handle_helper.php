<?php

if (!function_exists('getProjectDiskInfo')) {
    function getProjectDiskInfo(array|string $folders): array
    {
        $size = 0;
        $fileCount = 0;
        $level1FolderCount = 0;

        $folders = is_array($folders) ? $folders : [$folders];
        foreach ($folders as $folder) {
            if ($folder && is_dir($folder)) {
                foreach (scandir($folder) as $item) {
                    if ($item === '.' || $item === '..') {
                        continue;
                    }

                    if (is_dir($folder . DIRECTORY_SEPARATOR . $item)) {
                        $level1FolderCount++;
                    }
                }
                $iterator = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($folder, FilesystemIterator::SKIP_DOTS)
                );
                foreach ($iterator as $file) {
                    if ($file->isFile()) {
                        $size += $file->getSize();
                        $fileCount++;
                    }
                }
            }
        }

        return [
            'size' => $size,
            'files_count' => $fileCount,
            'level1_folders_count' => $level1FolderCount,
        ];
    }
}

if (!function_exists('getLeafFolderPathsWithFilesFast')) {
    function getLeafFolderPathsWithFilesFast(array|string $paths): array
    {
        $leafFolders = [];
        $paths = is_array($paths) ? $paths : [$paths];

        foreach ($paths as $root) {
            if (!is_dir($root)) {
                continue;
            }

            $stack = [$root];

            while ($stack) {
                $currentDir = array_pop($stack);
                $hasSubFolder = false;
                $fileCount = 0;

                $handle = opendir($currentDir);
                if ($handle === false) {
                    continue;
                }

                while (($item = readdir($handle)) !== false) {
                    if ($item === '.' || $item === '..') {
                        continue;
                    }

                    $fullPath = $currentDir . DIRECTORY_SEPARATOR . $item;

                    if (is_dir($fullPath)) {
                        $hasSubFolder = true;
                        $stack[] = $fullPath;
                    } elseif (is_file($fullPath)) {
                        if (str_contains($item, ':Zone.Identifier')) {
                            @unlink($fullPath);
                            continue;
                        }

                        $fileCount++;
                    }
                }

                closedir($handle);

                if (!$hasSubFolder && $fileCount > 0) {
                    $leafFolders[] = [
                        'folder_path' => $currentDir,
                        'files_count' => $fileCount,
                    ];
                }
            }
        }

        return $leafFolders;
    }
}

if (!function_exists('getPdfFolderStatsLevel1')) {
    function getPdfFolderStatsLevel1(string $folderPath): array
    {
        $pdfCount = 0;
        $totalPages = 0;
        $totalSize = 0;

        if (!is_dir($folderPath)) {
            return [
                'files_count' => 0,
                'total_line' => 0,
                'total_size' => 0,
            ];
        }

        foreach (scandir($folderPath) as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }
            $fullPath = $folderPath . DIRECTORY_SEPARATOR . $item;
            if (!is_file($fullPath)) {
                continue;
            }
            $totalSize += filesize($fullPath);
            if (strtolower(pathinfo($fullPath, PATHINFO_EXTENSION)) === 'pdf') {
                $pdfCount++;
                $command = 'pdfinfo ' . escapeshellarg($fullPath) . ' 2>/dev/null';
                exec($command, $output);
                foreach ($output as $line) {
                    if (str_starts_with($line, 'Pages:')) {
                        $totalPages += (int)trim(str_replace('Pages:', '', $line));
                        break;
                    }
                }
            }
        }

        return [
            'files_count' => $pdfCount,
            'total_line' => $totalPages,
            'total_size' => $totalSize,
        ];
    }
}

if (!function_exists('getPdfFilesInfoInFolder')) {
    function getPdfFilesInfoInFolder(string $folderPath): array
    {
        $files = [];

        if (!is_dir($folderPath)) {
            return [];
        }

        foreach (scandir($folderPath) as $item) {

            if ($item === '.' || $item === '..') {
                continue;
            }

            $fullPath = $folderPath . DIRECTORY_SEPARATOR . $item;

            if (!is_file($fullPath)) {
                continue;
            }

            if (strtolower(pathinfo($fullPath, PATHINFO_EXTENSION)) !== 'pdf') {
                continue;
            }

            $size = filesize($fullPath);
            $pages = 0;

            $command = 'pdfinfo ' . escapeshellarg($fullPath) . ' 2>/dev/null';
            $output = [];
            exec($command, $output);

            foreach ($output as $line) {
                if (str_starts_with($line, 'Pages:')) {
                    $pages = (int) trim(str_replace('Pages:', '', $line));
                    break;
                }
            }

            $files[] = [
                'file_path'  => $fullPath,
                'file_size'  => $size,
                'pages_count' => $pages,
                'sheets_count' => ceil($pages*70/100),
            ];
        }

        return $files;
    }
}

if (!function_exists('removePrefix')) {
    function removePrefix(string $parent, string $child = 'storage/users'): string
    {
        return str_starts_with($parent, $child)
            ? substr($parent, strlen($child))
            : $parent;
    }
}

if (!function_exists('circularNextInArray')) {
    function circularNextInArray(array $array, string|int $key): array
    {
        $key = $key + 1;
        if (isset($array[$key])) {
            return [
                'key' => $key,
                'value' => $array[$key],
            ];
        }
        return [
            'key' => 0,
            'value' => $array[0],
        ];
    }
}

if (!function_exists('countValidElements')) {
    function countValidElements(?array $array): ?int
    {
        unset($array['pivot'], $array['id'], $array['judgment_id'], $array['judgment_document_id']);

        $count = 0;

        foreach ($array as $value) {
            if (is_array($value)) {
                if (!empty($value)) {
                    $subCount = countValidElements($value);
                    $count += $subCount;
                }
            } else {
                if ($value !== null && $value !== '') {
                    $count++;
                }
            }
        }

        return $count;
    }
}

if (!function_exists('countAllChanges')) {
    function countAllChanges($oldArray, $newArray): ?int
    {
        $excludeKeys = ['pivot', 'id', 'judgment_id', 'judgment_document_id'];
        foreach ($excludeKeys as $key) {
            unset($oldArray[$key], $newArray[$key]);
        }

        $count = 0;
        $allKeys = array_unique(array_merge(array_keys($oldArray), array_keys($newArray)));

        foreach ($allKeys as $key) {
            if (array_key_exists($key, $oldArray) && array_key_exists($key, $newArray)) {
                $valOld = $oldArray[$key];
                $valNew = $newArray[$key];

                if (is_array($valOld) && is_array($valNew)) {
                    $count += countAllChanges($valOld, $valNew);
                } elseif ($valOld !== $valNew) {
                    $count++;
                }
            }
            else {
                $count++;
            }
        }
        return $count;
    }
}

if (!function_exists('getEndName')) {
    function getEndName(?string $fullName, ?string $segment = '/'): ?string
    {
        if (!$fullName || !$segment) {
            return $fullName;
        }
        $array = explode($segment, $fullName);
        return end($array);
    }
}
