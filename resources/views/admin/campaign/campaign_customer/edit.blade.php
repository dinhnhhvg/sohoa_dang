<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.edit') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.campaign_customer.update', ['campaign_customer' => $campaignCustomer->id]) }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.content') }}</label>
                    <textarea class="form-control" name="content" rows="5" placeholder="{{ __('app.enter_content') }}">{{ $campaignCustomer->content }}</textarea>
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
