<?php

use Carbon\Carbon;

if (!function_exists('renderGender')) {
    function renderGender(?string $gender): string
    {
        if (!$gender) {
            return '';
        }
        return __('app.'.$gender);
    }
}

if (!function_exists('renderSelectPaginateAndSubmit')) {
    function renderSelectPaginateAndSubmit(bool $all = false, bool $submit = true): string
    {
        if (!$submit) {
            return '<div class="form-group">
                        <select class="form-select select2" name="per_page">
                            <option value="25" '.(env("APP_DEFAULT_PER_PAGE") == 25 ? "selected" : "").'>25</option>
                            <option value="50" '.(env("APP_DEFAULT_PER_PAGE") == 50 ? "selected" : "").'>50</option>
                            <option value="100" '.(env("APP_DEFAULT_PER_PAGE") == 100 ? "selected" : "").'>100</option>
                            <option value="0" '.(env("APP_DEFAULT_PER_PAGE") == 0 ? "selected" : "").'>All</option>
                        </select>
                    </div>';
        }

        if ($all === true) {
            return '<div class="col-xxl-3 col-sm-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <select class="form-select select2" name="per_page">
                                        <option value="0">All</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <button type="submit" class="btn btn-primary w-100">'.__('app.filter').'</button>
                                </div>
                            </div>
                        </div>
                    </div>';
        }

        return '<div class="col-xxl-3 col-sm-12">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <select class="form-select select2" name="per_page">
                                    <option value="25" '.(env("APP_DEFAULT_PER_PAGE") == 25 ? "selected" : "").'>25</option>
                                    <option value="50" '.(env("APP_DEFAULT_PER_PAGE") == 50 ? "selected" : "").'>50</option>
                                    <option value="100" '.(env("APP_DEFAULT_PER_PAGE") == 100 ? "selected" : "").'>100</option>
                                    <option value="0" '.(env("APP_DEFAULT_PER_PAGE") == 0 ? "selected" : "").'>All</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary w-100">'.__('app.filter').'</button>
                            </div>
                        </div>
                    </div>
                </div>';
    }
}

if (!function_exists('renderSelectIsActive')) {
    function renderSelectIsActive(): string
    {
        return '<div class="col-xxl-3 col-sm-12">
                    <div class="form-group mb-3">
                        <select class="form-select select2" name="is_active[]" data-placeholder="'.__('app.select_is_active').'" multiple>
                            <option value=""></option>
                            <option value="1">'.__('app.active').'</option>
                            <option value="0">'.__('app.inactive').'</option>
                        </select>
                    </div>
                </div>
            ';
    }
}

if (!function_exists('renderIsActive')) {
    function renderIsActive(string $isActive): string
    {
        if ($isActive === '1') {
            return '<span class="badge bg-success">'.__('app.active').'</span>';
        }
        if ($isActive === '0') {
            return '<span class="badge bg-danger">'.__('app.inactive').'</span>';
        }
        return $isActive;
    }
}

if (!function_exists('renderLanguageMessage')) {
    function renderLanguageMessage(array $messages, string $locale, string $html = ''): string
    {
        $action = route('admin.language.update_message', ['locale' => $locale]);
        foreach ($messages as $key => $message) {
            if (is_string($message)) {
                $html .= '<div class="col-xxl-4 col-lg-6 col-md-12 mb-3">
                              <form method="POST" action="'.$action.'" onsubmit="commonSubmit(this, false, false); return false">
                                  '.@csrf_field().'
                                  '.@method_field('PATCH').'
                                  <div class="input-group">
                                      <input type="hidden" class="form-control" name="key" value="'.$key.'">
                                      <input type="text" class="form-control ps-3" name="value" value="'.$message.'">
                                      <button type="submit" class="input-group-text btn btn-primary fa-solid fa-floppy-disk" title="'.__('app.save').'"></button>
                                  </div>
                              </form>
                          </div>';
            } else {
                $html .= renderLanguageMessage($message, $locale, $html);
            }
        }
        return $html;
    }
}

if (!function_exists('renderThSort')) {
    function renderThSort(?string $title, ?string $field, ?string $name, ?string $type): string
    {
        if ($field === $name) {
            return match ($type) {
                'ASC' => '<p>
                               ' . $title . '
                               <a href="javascript:void(0)" class="float-end ms-2" onclick="sortTable(this, \'' . $field . '\')"><i class="fa-solid fa-sort-up text-primary"></i></a>
                          </p>',
                'DESC' => '<p>
                                ' . $title . '
                                <a href="javascript:void(0)" class="float-end ms-2" onclick="sortTable(this, \'' . $field . '\')"><i class="fa-solid fa-sort-down text-primary"></i></a>
                            </p>',
                default => '<p>
                                ' . $title . '
                                <a href="javascript:void(0)" class="float-end ms-2" onclick="sortTable(this, \'' . $field . '\')"><i class="fas fa-sort"></i></a>
                            </p>',
            };
        }
        return '<p>
                    '.$title.'
                    <a href="javascript:void(0)" class="float-end ms-2" onclick="sortTable(this, \''.$field.'\')"><i class="fas fa-sort"></i></a>
                </p>';
    }
}

if (!function_exists('renderSearchEmpty')) {
    function renderSearchEmpty($data): string
    {
        if (count($data)) {
            return '';
        }
        return '<div class="text-center mb-4">
                    <img src="'. asset(env('APP_DEFAULT_EMPTY')) .'" alt="search empty" class="img-search-empty">
                    <span class="d-block">'. __('app.search_empty') .'</span>
                </div>';
    }
}

if (!function_exists('renderPagination')) {
    function renderPagination($data): string
    {
        if (method_exists($data, 'links')) {
            return $data->links();
        }
        return  '';
    }
}

if (!function_exists('renderSelectDocumentType')) {
    function renderDocumentType(null|string $type): string
    {
        return '<div class="form-group mb-3">
                    <label class="form-label">'.__('app.type').'<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="type" required>
                        <option value="word" '.($type === 'word' ? "selected" : "").'>word</option>
                        <option value="excel" '.($type === 'excel' ? "selected" : "").'>excel</option>
                        <option value="powerpoint" '.($type === 'powerpoint' ? "selected" : "").'>powerpoint</option>
                        <option value="pdf" '.($type === 'pdf' ? "selected" : "").'>pdf</option>
                        <option value="other" '.($type === 'other' ? "selected" : "").'>other</option>
                    </select>
                </div>
            ';
    }
}

if (!function_exists('renderAddress')) {
    function formatAddress(mixed $data): string
    {
        if (isset($data->address)) {
            $parts[] = $data->address;
        }
        if (isset($data->ward->full_name)) {
            $parts[] = $data->ward->full_name;
        }
        if (isset($data->province->full_name)) {
            $parts[] = $data->province->full_name;
        }
        return isset($parts) ? implode(', ', $parts) : '';
    }
}

if (!function_exists('renderTimeProgress')) {
    function renderTimeProgress(?Carbon $startDate, ?Carbon $endDate, ?Carbon $date = null): string
    {
        $date = $date ?? Carbon::today();
        if ($endDate <= $startDate) {
            return '';
        }
        if ($date <= $startDate) {
            return '';
        }
        if ($date >= $endDate) {
            $rate = 100;
        } else {
            $rate = round($startDate->diffInSeconds($date) / $startDate->diffInSeconds($endDate) * 100);
        }
        return '<div class="d-flex align-items-center justify-content-between">
                    <p class="mb-0 fs-12">'.$startDate?->format('d-m-Y').'</p>
                    <p class="mb-0 title text-primary">'.__('app.time').'</p>
                    <p class="mb-0 fs-12">'.$endDate?->format('d-m-Y').'</p>
                </div>
                <div class="progress bg-secondary w-100">
                    <div class="progress-value bg-primary" style="width: '.$rate.'%"></div>
                </div>';
    }
}

if (!function_exists('renderProgress')) {
    function renderProgress(string|int $progressRate): string
    {
        return '<div class="progress bg-secondary w-100">
                    <div class="progress-value bg-primary" style="width: '.$progressRate.'%"></div>
                </div>';
    }
}

if (!function_exists('renderPercentCircle')) {
    function renderPercentCircle(string|int $rate = 0, string $title = ''): string
    {
        return '<div class="percent-circle w-100 p-2" style="--percent-circle-rate:'.$rate.'">
                    <svg viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="45"></circle>
                        <circle cx="50" cy="50" r="45"></circle>
                    </svg>
                    <h4 class="percent-title title text-primary text-center mb-0">'.$title.'</h4>
                </div>';
    }
}

if (!function_exists('renderSelectDayOfWeek')) {
    function renderSelectDayOfWeek(string|int|null $dayOfWeek = null): string
    {
        return '<select class="form-select select2" name="day_of_week" data-placeholder="'.__('app.select_day_of_week').'">
                    <option value=""></option>
                    <option value="1" '.($dayOfWeek == 1 ? "selected" : "").'>'.__('app.monday').'</option>
                    <option value="2" '.($dayOfWeek == 2 ? "selected" : "").'>'.__('app.tuesday').'</option>
                    <option value="3" '.($dayOfWeek == 3 ? "selected" : "").'>'.__('app.wednesday').'</option>
                    <option value="4" '.($dayOfWeek == 4 ? "selected" : "").'>'.__('app.thursday').'</option>
                    <option value="5" '.($dayOfWeek == 5 ? "selected" : "").'>'.__('app.friday').'</option>
                    <option value="6" '.($dayOfWeek == 6 ? "selected" : "").'>'.__('app.saturday').'</option>
                    <option value="7" '.($dayOfWeek == 7 ? "selected" : "").'>'.__('app.sunday').'</option>
                </select>
            ';
    }
}

if (!function_exists('renderDayOfWeek')) {
    function renderDayOfWeek(string|int|null $dayOfWeek = null): string
    {
        return match ($dayOfWeek) {
            1 => __('app.monday'),
            2 => __('app.tuesday'),
            3 => __('app.wednesday'),
            4 => __('app.thursday'),
            5 => __('app.friday'),
            6 => __('app.saturday'),
            7 => __('app.sunday'),
            default => '',
        };
    }
}


if (!function_exists('renderProfile')) {
    function renderProfile(mixed $data, ?string $router = null): string
    {
        $onclick = $router ? 'onclick="commonShowModal(`'.$router.'`, `#common-modal-fullscreen`)"' : '';
        return '
                  <a href="javascript:void(0)" class="d-flex align-items-center" '.$onclick.'>
                    <img src="'.asset($data['avatar']).'" alt="Profile" class="w-45px me-2 rounded-circle">
                    <p class="mb-0">
                        <strong>'.$data['code'].'</strong>
                        <br>
                        <strong>'.$data['name'].'</strong>
                    </p>
                  </a>
        ';
    }
}

if (!function_exists('renderCodeName')) {
    function renderCodeName(mixed $row): string
    {
        return $row ? ($row?->code.'-'.$row?->name) : '';
    }
}

if (!function_exists('renderManyName')) {
    function renderManyName(mixed $rows, bool $showCode = false): string
    {
        $name = '';
        foreach ($rows as $row) {
            $name = $name
                ? $name.','.($showCode ? $row->code.'-'.$row->name : $row->name)
                : ($showCode ? $row->code.'-'.$row->name : $row->name);
        }
        return $name;
    }
}

if (!function_exists('renderStandardPath')) {
    function renderStandardPath(?string $pathFull, string $path = 'storage/users/shares/'): string
    {
        return !$pathFull ? $pathFull : str_replace($path, '', $pathFull);
    }
}

