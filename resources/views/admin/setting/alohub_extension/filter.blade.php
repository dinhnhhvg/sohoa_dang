<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{{ __('app.extension') }}</th>
            <th>{{ __('app.password') }}</th>
            <th>{{ __('app.user') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($alohubExtensions as $i => $alohubExtension)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center text-nowrap">{{ $alohubExtension->extension }}</td>
                <td class="text-center text-nowrap">{{ $alohubExtension->password }}</td>
                <td>
                    @foreach($alohubExtension->users as $iu => $user)
                        <span class="badge bg-danger">{{ $iu + 1 }}</span> {{ $user->name }}<br>
                    @endforeach
                </td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.alohub_extension.edit', ['alohub_extension' => $alohubExtension->id]) }}')">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.alohub_extension.destroy', ['alohub_extension' => $alohubExtension->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($alohubExtensions) !!}

{!! renderSearchEmpty($alohubExtensions) !!}
