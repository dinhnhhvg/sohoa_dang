<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.create') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('root.status.store') }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.name') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" required placeholder="{{ __('app.enter_name') }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.code') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="code" required placeholder="{{ __('app.enter_code') }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.module') }}<span class="text-danger">*</span></label>
                    <select class="form-select select2" name="module">
                        <option value="contact">contact</option>
                        <option value="order">order</option>
                        <option value="class">class</option>
                        <option value="lesson">lesson</option>
                        <option value="payment">payment</option>
                        <option value="class_customer">class_customer</option>
                        <option value="lesson_customer">lesson_customer</option>
                        <option value="campaign_customer">campaign_customer</option>
                        <option value="batch">batch</option>
                        <option value="judgment">judgment</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.bg_color') }}</label>
                    <input type="color" class="form-control" name="bg_color" value="#FFFFFF" placeholder="{{ __('app.enter_bg_color') }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('app.description') }}</label>
                    <textarea class="form-control" name="description" rows="2"></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary">{{ __('app.save') }}</button>
            </div>
        </div>
    </form>
</div>
