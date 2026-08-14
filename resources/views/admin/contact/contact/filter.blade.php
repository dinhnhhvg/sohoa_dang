<div class="table-responsive">
<table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="3">
    <thead>
    <tr>
        <th class="w-40px">
            <input type="checkbox" class="form-check-input" onchange="checkAll(this)">
        </th>
        <th class="w-40px">#</th>
        <th>{!! renderThSort(__('app.code'), 'contacts.id', $orderByName, $orderByType) !!}</th>
        <th>{!! renderThSort(__('app.name'), 'customers.name', $orderByName, $orderByType) !!}</th>
        <th class="min-w-220px">{{ __('app.title') }}</th>
        <th class="min-w-220px">{{ __('app.content') }}</th>
        <th>{!! renderThSort(__('app.schedule_at'), 'contacts.schedule_at', $orderByName, $orderByType) !!}</th>
        <th>{{ __('app.status') }}</th>
        <th class="min-w-220px">{{ __('app.note') }}</th>
        <th>{!! renderThSort(__('app.created_at'), 'contacts.created_at', $orderByName, $orderByType) !!}</th>
        <th class="min-w-100px">{{ __('app.action') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($contacts as $i => $contact)
        @php $customer = $contact->customer @endphp
        <tr style="background-color: {{ $contact->status->bg_color }}">
            <td class="text-center">
                <input type="checkbox" class="form-check-input id" name="id[]" value="{{ $contact->id }}">
            </td>
            <td class="text-center">{{ $i + 1 }}</td>
            <td class="text-center text-nowrap">{{ $contact->id }}</td>
            <td class="text-nowrap">
                {!! renderProfile($customer, route('admin.customer.show', ['customer' => $customer->id])) !!}
                <p class="mb-0"><i class="fas fa-envelope"></i> {{ $customer->email }}</p>
                <p class="mb-0"><i class="fas fa-phone"></i> {{ $customer->phone }}</p>
            </td>
            <td>{{ $contact->title }}</td>
            <td>{{ $contact->content }}</td>
            <td class="text-center text-nowrap">
                @if($contact->schedule_at)
                    {{ $contact->schedule_at->format('d-m-Y H:i') }}
                @endif
            </td>
            <td class="text-center">
                <span class="badge bg-primary">{{ __('app.'.$contact->status->name) }}</span>
            </td>
            <td>
                {{ $contact->note }}
            </td>
            <td class="text-center text-nowrap">{{ $contact->created_at->format('d-m-Y H:i') }}</td>
            <td class="text-center">
                <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                   onclick="commonShowModal('{{ route('admin.contact.edit', ['contact' => $contact->id]) }}', '#common-modal-lg')">
                    <i class="fa-solid fa-edit"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-primary mb-1" title="{{ __('app.call') }}"
                   onclick="showAlohubCallModal('{{ $contact->phone }}')">
                    <i class="fa-solid fa-phone"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.show_note') }}"
                   onclick="commonShowModal('{{ route('admin.contact.show_note', ['contact' => $contact->id]) }}', '#common-modal-lg')">
                    <i class="fas fa-heart"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                   onclick="commonDelete('{{ route('admin.contact.destroy', ['contact' => $contact->id]) }}')">
                    <i class="fa-solid fa-trash-can"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>

{!! renderPagination($contacts) !!}

{!! renderSearchEmpty($contacts) !!}
