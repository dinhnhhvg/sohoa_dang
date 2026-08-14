<div class="row">
    @foreach($categoryAttributes as $categoryAttribute)
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label class="form-label">{{ $categoryAttribute->attribute->name }}<span class="text-danger">*</span></label>
                <select class="form-select select2" name="value_id[]" multiple required data-placeholder="{{ __('app.select_option') }}">
                    <option></option>
                    @foreach($categoryAttribute->valuesByCategory($categoryAttribute->category_id)->get() as $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endforeach
</div>
