<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.show') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="text-center">
        @php
            $value = isset($importLog->value) ? json_decode($importLog->value, true) : [];
            $count = count($value);
            $doneCount = $value ? count(array_filter($value, fn($item) => $item['status'] === true)) : 0;
        @endphp
        <p>
            <strong>
                {{ __('app.user') }}: {{ $importLog->user->name }}
                <br>
                {{ __('app.created_at') }}: {{ $importLog->created_at->format('d-m-Y H:i:s') }}
                <br>
                {{ __('app.quantity') }}: <span class="text-success">{{ $doneCount }}</span>/{{ $count }}
                <br>
                {{ __('app.file_path') }}: {{ $importLog->file_path }}
            </strong>
        </p>
    </div>
    <div>
        @foreach($value as $row)
            <p class="mb-0 {{ $row['status'] ? 'text-success' : 'text-danger' }}">{{ $row['name'] }}: {{ $row['message'] }}</p>
        @endforeach
    </div>
</div>
