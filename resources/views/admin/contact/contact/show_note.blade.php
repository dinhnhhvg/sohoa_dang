<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.note') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="card h-100">
        <div class="card-body p-0">
            <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link p-3 active" data-bs-toggle="tab" data-bs-target="#tab-list" aria-selected="true" role="tab">
                        <strong>{{ __('app.list') }}</strong>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link p-3" data-bs-toggle="tab" data-bs-target="#tab-create" aria-selected="false" role="tab" tabindex="-1">
                        <strong>{{ __('app.create') }}</strong>
                    </button>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade p-3 active show" id="tab-list" role="tabpanel">
                    <ul class="timeline-with-icons m-2">
                        @foreach($contact->itemNotes as $note)
                            <li class="timeline-item mb-5">
                            <span class="timeline-icon">
                                <i class="fa-solid fa-user text-primary fa-sm fa-fw"></i>
                            </span>
                                <p class="mb-0 text-primary">{{ $note->createdBy?->name }}</p>
                                <p class="mb-0">
                                    <span class="fs-15">{{ $note->created_at->format('d-m-Y H:i:s') }}</span>
                                </p>
                                @if($note->status)
                                    <p class="mb-0"><span class="badge bg-primary">{{ __('app.'.$note->status->name) }}</span></p>
                                @endif
                                <p class="text-muted">
                                    @if ($note->channel)
                                        <span class="badge bg-danger">{{ $note->channel->name }}</span>
                                    @endif
                                    {{ $note->note }}
                                </p>
                            </li>
                        @endforeach
                    </ul>
                    {!! renderSearchEmpty($contact->itemNotes) !!}
                </div>

                <div class="tab-pane fade p-3" id="tab-create" role="tabpanel">
                    <form method="POST" action="{{ route('admin.contact.update', ['contact' => $contact->id]) }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('app.status') }}<span class="text-danger">*</span></label>
                                    <select class="form-select select2" name="status_id" required data-placeholder="{{ __('app.select_status') }}">
                                        @foreach($statuses as $status)
                                            <option value="{{ $status->id }}" {{ $status->id == $contact->status_id ? 'selected' : '' }}>
                                                {{ __('app.'.$status->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('app.channel') }}<span class="text-danger">*</span></label>
                                    <select class="form-select select2" name="channel_id" required data-placeholder="{{ __('app.select_channel') }}">
                                        @foreach($channels as $channel)
                                            <option value="{{ $channel->id }}" {{ $channel->id == $contact->customer->channel_id ? 'selected' : '' }}>
                                                {{ $channel->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('app.schedule_at') }}</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control datetimepicker" name="schedule_at" value="{{ $contact->schedule_at?->format('d-m-Y H:i') }}" data-format="d-m-Y H:i" placeholder="{{ __('app.schedule_at') }}">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('app.note') }}<span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="note" required placeholder="{{ __('app.enter_note') }}"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <button type="submit" class="btn btn-primary">{{ __('app.save') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
