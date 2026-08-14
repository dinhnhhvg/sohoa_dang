@if(isset($class_customer_id))
    <div class="table-responsive">
        <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="3">
            <thead>
            <tr>
                <th class="w-40px">
                    <input type="checkbox" class="form-check-input" onchange="checkAll(this)">
                </th>
                <th class="w-40px">#</th>
                <th>{!! renderThSort(__('app.name'), 'lessons.name', $orderByName, $orderByType) !!}</th>
                <th>{!! renderThSort(__('app.time'), 'lessons.date', $orderByName, $orderByType) !!}</th>
                <th>{{ __('app.attendance') }}</th>
                <th>{{ __('app.type') }}</th>
                <th>{{ __('app.classroom') }}</th>
                <th class="min-w-220px">{{ __('app.content') }}</th>
                <th class="min-w-100px">{{ __('app.action') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($lessonCustomers as $i => $lessonCustomer)
                @php $lesson = $lessonCustomer->lesson @endphp
                <tr>
                    <td class="text-center">
                        <input type="checkbox" class="form-check-input id" name="id[]" value="{{ $lessonCustomer->id }}">
                    </td>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td class="text-nowrap">{{ $lesson->name }}</td>
                    <td class="text-center text-nowrap">
                        {{ ucfirst($lesson->date?->translatedFormat('l')) }} ({{ $lesson->start_time?->format('H:i') }} - {{ $lesson->end_time?->format('H:i') }})
                        <br>
                        {{ $lesson->date?->format('d-m-Y') }}
                    </td>
                    <td class="text-center">
                        @if($lessonCustomer->status)
                            <span class="badge bg-primary">{{ __('app.'.$lessonCustomer->status->name) }}</span>
                        @endif
                    </td>
                    <td class="text-center"><span class="badge bg-primary">{{ __('app.'.$lesson->type?->name) }}</span></td>
                    <td class="text-nowrap">
                        @if($lesson->classroom)
                            {{ $lesson->classroom->name }} - {{ $lesson->center?->name }}
                        @endif
                    </td>
                    <td>{{ $lesson->content }}</td>
                    <td class="text-center">
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                           onclick="commonDelete('{{ route('admin.lesson_customer.destroy', ['lesson_customer' => $lessonCustomer->id]) }}')">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {!! renderPagination($lessonCustomers) !!}

    {!! renderSearchEmpty($lessonCustomers) !!}
@else
    <div class="table-responsive">
        <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100">
            <thead>
            <tr class="align-middle">
                <th rowspan="2" class="w-40px">
                    <input type="checkbox" class="form-check-input" onchange="checkAll(this)">
                </th>
                <th rowspan="2" class="w-40px">#</th>
                <th rowspan="2">{!! renderThSort(__('app.code'), 'customers.code', $orderByName, $orderByType) !!}</th>
                <th rowspan="2">{!! renderThSort(__('app.name'), 'customers.name', $orderByName, $orderByType) !!}</th>
                <th colspan="{{ count($statuses) }}">{{ __('app.attendance') }}</th>
                <th rowspan="2" class="min-w-100px">{{ __('app.action') }}</th>
            </tr>
            <tr>
                @foreach($statuses as $status)
                    <th>{{ __('app.'.$status->name) }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($lessonCustomers as $i => $lessonCustomer)
                @if($i == 0)
                    <tr class="text-center">
                        <td colspan="4" class="text-center">{{ __('app.check_all') }}</td>
                        @foreach($statuses as $status)
                            <td class="text-center">
                                <input type="checkbox" class="form-check-input" name="status_id" onchange="checkAll(this, 'status_id-{{ $status->id }}'); singleCheck(this)">
                            </td>
                        @endforeach
                        <td></td>
                    </tr>
                @endif
                @php $customer = $lessonCustomer->classCustomer->customer @endphp
                <tr>
                    <td class="text-center">
                        <input type="checkbox" class="form-check-input id" name="id[]" value="{{ $lessonCustomer->id }}">
                    </td>
                    <td class="text-center">{{ $i + 1 }}</td>`
                    <td class="text-center text-nowrap">{{ $customer?->code }}</td>
                    <td class="text-nowrap">{{ $customer?->name }}</td>
                    @foreach($statuses as $status)
                        <td class="text-center">
                            <input type="checkbox" class="form-check-input status_id-{{ $status->id }}" name="status_id[]" value="{{ $status->id }}" onchange="singleCheck(this)"
                                {{ $status->id == $lessonCustomer->status?->id ? 'checked' : '' }}>
                        </td>
                    @endforeach
                    <td class="text-center">
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                           onclick="commonDelete('{{ route('admin.lesson_customer.destroy', ['lesson_customer' => $lessonCustomer->id]) }}')">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {!! renderPagination($lessonCustomers) !!}

    {!! renderSearchEmpty($lessonCustomers) !!}
@endif
