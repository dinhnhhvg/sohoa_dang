<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.create') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('admin.order.store') }}" onsubmit="commonSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="type_id" value="{{ $type_id }}">
        <input type="hidden" name="contact_id" value="{{ $contact_id ?? null }}">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card h-100 mb-0">
                    <div class="card-header">
                        <div class="card-title mb-0">{{ __('app.detail') }} {{ __('app.customer') }}</div>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="avatar" value="{{ env('APP_DEFAULT_AVATAR') }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('app.name') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" onchange="searchCustomer(this)" required placeholder="{{ __('app.enter_name') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('app.phone') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="phone" oninput="phoneOnly(this)" onchange="searchCustomer(this)" required placeholder="{{ __('app.enter_phone') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('app.email') }}<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" required placeholder="{{ __('app.enter_email') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('app.gender') }}<span class="text-danger">*</span></label>
                                    <select class="form-select select2" name="gender" required>
                                        <option value="male">{{ __('app.male') }}</option>
                                        <option value="female">{{ __('app.female') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('app.birth_date') }}</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control datepicker" name="birth_date" data-format="d-m-Y" placeholder="{{ __('app.birth_date') }}">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('app.center') }}</label>
                                    <select class="form-select select2" name="center_id" data-placeholder="{{ __('app.select_center') }}">
                                        <option value=""></option>
                                        @foreach($centers as $center)
                                            <option value="{{ $center->id }}">{{ $center->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('app.agency') }}</label>
                                    <select class="form-select select2" name="agency_id" data-placeholder="{{ __('app.select_agency') }}">
                                        <option value=""></option>
                                        @foreach($agencies as $agency)
                                            <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('app.customer_tag') }}</label>
                                    <select class="form-select select2" name="customer_tag_id" data-placeholder="{{ __('app.select_customer_tag') }}">
                                        <option value=""></option>
                                        @foreach($customerTags as $customerTag)
                                            <option value="{{ $customerTag->id }}">{{ $customerTag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('app.province') }}<span class="text-danger">*</span></label>
                                    <select class="form-select select2" name="province_id" onchange="getWardByProvince(this)" data-placeholder="{{ __('app.select_province') }}" required>
                                        @foreach($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('app.ward') }}</label>
                                    <select class="form-select select2" name="ward_id" data-placeholder="{{ __('app.select_ward') }}">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('app.address') }}</label>
                                    <input type="text" class="form-control" name="address" placeholder="{{ __('app.address') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card h-100 mb-0">
                    <div class="card-header">
                        <div class="card-title mb-0">{{ __('app.detail') }} {{ __('app.order') }}</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('app.total_amount') }}</label>
                                    <input type="text" class="form-control" name="total_amount" disabled placeholder="{{ __('total_amount') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('app.coupon') }}</label>
                                    <input type="text" class="form-control" name="coupon_code" onchange="useCoupon(this)" placeholder="{{ __('coupon') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('app.coupon_amount') }}</label>
                                    <input type="text" class="form-control" name="coupon_amount" disabled placeholder="{{ __('coupon_amount') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('app.discount_amount') }}</label>
                                    <input type="text" class="form-control" name="discount_amount" value="0" onkeyup="addCommas(this)" onchange="useDiscountAmount(this)" placeholder="{{ __('discount_amount') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('app.final_amount') }}</label>
                                    <input type="text" class="form-control" name="final_amount" value="0" disabled placeholder="{{ __('final_amount') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('app.content') }}</label>
                                    <textarea class="form-control" name="content" rows="2" placeholder="{{ __('app.enter_content') }}"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('app.note') }}</label>
                                    <textarea class="form-control" name="note" rows="2" placeholder="{{ __('app.enter_note') }}">{{ __('app.create') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($type_id == env('APP_DEFAULT_TYPE_COURSE'))
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title mb-0">{{ __('app.detail') }} {{ __('app.course') }}</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group mb-3">
                                        <select class="form-select select2 course_type_select" data-placeholder="{{ __('app.select_course') }}">
                                            <option></option>
                                            @foreach($courseTypes as $courseType)
                                                <option value="{{ $courseType->id }}">
                                                    {{ $courseType->course->code }} - {{ $courseType->course->name }} - {{ __('app.'.$courseType->type->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <button type="button" class="btn btn-primary w-100" onclick="addCourseType(this)">{{ __('app.add') }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="table-responsive" id="order-item-table">
                                    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100">
                                        <thead>
                                        <tr>
                                            <th>{{ __('app.course') }}</th>
                                            <th>{{ __('app.course_type') }}</th>
                                            <th>{{ __('app.price') }}</th>
                                            <th>{{ __('app.lesson_count') }}</th>
                                            <th>{{ __('app.content') }}</th>
                                            <th class="min-w-100px">{{ __('app.action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($type_id == env('APP_DEFAULT_TYPE_PRODUCT'))
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title mb-0">{{ __('app.detail') }} {{ __('app.product') }}</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group mb-3">
                                        <select class="form-select select2 product_select" data-placeholder="{{ __('app.select_product') }}">
                                            <option></option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->code }} - {{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <button type="button" class="btn btn-primary w-100" onclick="showProductValue(this)">{{ __('app.add') }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="table-responsive" id="order-item-table">
                                    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100">
                                        <thead>
                                        <tr>
                                            <th>{{ __('app.product') }}</th>
                                            <th>{{ __('app.show') }}</th>
                                            <th>{{ __('app.price') }}</th>
                                            <th>{{ __('app.quantity') }}</th>
                                            <th>{{ __('app.content') }}</th>
                                            <th class="min-w-100px">{{ __('app.action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-md-12">
                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary">{{ __('app.save') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function addCourseType(e) {
        let course_type_id = $(e).closest('.row').find('select.course_type_select').val();
        if (!course_type_id) {
            showNotification('error', '{{ __('app.message.please_select_at_least_one_record') }}');
            return;
        }

        $.ajax({
            url: '{{ route('index') }}/'+'course-type/'+course_type_id+'/show',
            type: 'GET',
            data: {
                render_type: 'tr'
            },
            success: function(response) {
                $(e).closest('.card-body').find('.table tbody').append(response);
                calculatePrice();
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
            }
        });
    }

    function showProductValue(e, modal = '#common-modal-lg') {
        let product_id = $(e).closest('.row').find('select.product_select').val();
        if (!product_id) {
            showNotification('error', '{{ __('app.message.please_select_at_least_one_record') }}');
            return;
        }
        $.ajax({
            url: '{{ route('index') }}/'+'product/'+product_id+'/show',
            type: 'GET',
            data: {
                render_type: 'modal'
            },
            success: function(response) {
                $(modal).find('.modal-content').html(response);
                $(modal).modal('show');
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
            }
        });
    }

    function deleteCourseType(e) {
        $(e).closest('tr').remove();
        calculatePrice();
    }

    function calculatePrice(e = $('#order-item-table')) {
        let totalAmount = 0;
        $(e).find('tbody tr').each(function () {
            let price = parseInt($(this).find('input[name="price[]"]').val()) || 0;
            let quantity = parseInt($(this).find('input[name="quantity[]"]').val()) || 0;
            totalAmount += price*quantity;
        });

        let form = $(e).closest('form');
        form.find('input[name="total_amount"]').val(numberFormat(totalAmount));
        form.find('input[name="coupon_code"]').trigger('change');
    }
</script>
