<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed no-nowrap w-100">
        <thead>
        <tr>
            <th colspan="3"></th>
            <th colspan="4">{{ __('app.information') }} {{ __('app.judgment') }}</th>
            <th colspan="18">{{ __('app.judgment_decision_information') }}</th>
            <th></th>
            <th></th>
            <th colspan="4"></th>
            <th colspan="21">CMND, CCCD, {{ __('app.passport') }}, {{ __('app.household_registration') }}</th>
            <th colspan="3">{{ __('app.personal_information') }}</th>
            <th colspan="8">{{ __('app.organization_info') }}</th>
            <th></th>
        </tr>
        <tr>
            <th rowspan="2" class="w-40px">#</th>
            <th rowspan="2" class="min-w-100px">{{ __('app.action') }}</th>
            <th rowspan="2" class="min-w-100px">{{ __('app.note') }}</th>

            <th rowspan="2" class="text-nowrap">{{ __('app.language') }}</th>
            <th rowspan="2" class="text-nowrap">{{ __('app.sheet') }}</th>
            <th rowspan="2" class="text-nowrap">{{ __('app.physical_condition') }}</th>
            <th rowspan="2" class="min-w-220px">{{ __('app.description') }}</th>

            <th rowspan="2" class="text-nowrap">{{ __('app.judgment_type') }}</th>
            <th rowspan="2" class="text-nowrap">{{ __('app.document_type') }}</th>
            <th rowspan="2" class="text-nowrap">{{ __('app.language') }}</th>
            <th rowspan="2" class="text-nowrap">{{ __('app.sheet') }}</th>
            <th rowspan="2" class="text-nowrap">{{ __('app.physical_condition') }}</th>
            <th rowspan="2" class="min-w-220px">{{ __('app.description') }}</th>
            <th rowspan="2" class="text-nowrap">{{ __('app.file_path') }}</th>

            <th rowspan="2" class="min-w-200px">{{ __('app.normalized_number') }}</th>
            <th rowspan="2" class="min-w-200px">{{ __('app.original_symbol') }}</th>
            <th rowspan="2" class="min-w-200px">{{ __('app.issued_date') }}</th>

            <th colspan="3" class="text-nowrap">Tên cơ quan ban hành Bản án/Quyết định/Tài liệu</th>
            <th rowspan="2" class="min-w-200px">Tên tổ chức/ cá nhân ban hành Bản án/Quyết định/Tài liệu</th>

            <th rowspan="2" class="min-w-200px">{{ __('app.effective_date') }}</th>

            <th colspan="3" class="text-nowrap">Bản án/Quyết định liên quan</th>

            <th rowspan="2" class="min-w-200px">{{ __('app.content_summary') }}</th>
            <th rowspan="2" class="text-nowrap">{{ __('app.has_appeal') }}</th>

            <th rowspan="2" class="text-nowrap">{{ __('app.court_fee') }}</th>
            <th rowspan="2" class="text-nowrap">{{ __('app.court_fee_status') }}</th>
            <th rowspan="2" class="text-nowrap">{{ __('app.legal_relationship') }}</th>
            <th rowspan="2" class="text-nowrap">{{ __('app.litigation_status') }}</th>

            <th rowspan="2" class="text-nowrap">{{ __('app.full_name') }}</th>
            <th rowspan="2" class="text-nowrap">{{ __('app.alias_name') }}</th>
            <th rowspan="2" class="text-nowrap">{{ __('app.identity_document') }}</th>
            <th rowspan="2" class="text-nowrap">{{ __('app.identity_number') }}</th>
            <th rowspan="2" class="text-nowrap">{{ __('app.identity_created_date') }}</th>
            <th rowspan="2" class="text-nowrap">{{ __('app.identity_expiry_date') }}</th>
            <th rowspan="2" class="text-nowrap">{{ __('app.gender') }}</th>
            <th rowspan="2" class="text-nowrap">{{ __('app.birth_date') }}</th>
            <th rowspan="2" class="text-nowrap">{{ __('app.nationality') }}</th>
            <th rowspan="2" class="text-nowrap">{{ __('app.ethnicity') }}</th>
            <th rowspan="2" class="text-nowrap">{{ __('app.religion') }}</th>

            <th colspan="4" class="text-nowrap">{{ __('app.permanent') }}</th>
            <th colspan="4" class="text-nowrap">{{ __('app.hometown') }}</th>
            <th colspan="2" class="text-nowrap">{{ __('app.foreign_document_number') }}</th>

            <th rowspan="2" class="text-nowrap">{{ __('app.father_name') }}</th>
            <th rowspan="2" class="text-nowrap">{{ __('app.mother_name') }}</th>
            <th rowspan="2" class="text-nowrap">{{ __('app.spouse_name') }}</th>

            <th rowspan="2" class="min-w-200px">{{ __('app.organization_type') }}</th>
            <th rowspan="2" class="min-w-200px">{{ __('app.organization_name') }}</th>
            <th rowspan="2" class="min-w-200px">{{ __('app.business_registration_code') }}</th>
            <th rowspan="2" class="min-w-200px">{{ __('app.tax_code') }}</th>

            <th colspan="4" class="text-nowrap">{{ __('app.organization_address') }}</th>

            <th rowspan="2" class="text-nowrap">{{ __('app.action') }}</th>
        </tr>
        <tr>
            <th class="min-w-200px">Đơn vị Tòa án ban hành</th>
            <th class="min-w-200px">Đơn vị Công an ban hành</th>
            <th class="min-w-200px">Đơn vị Viện kiểm sát ban hành</th>

            <th class="text-nowrap">{{ __('app.related_number') }}</th>
            <th class="text-nowrap">{{ __('app.related_date') }}</th>
            <th class="min-w-200px">Tòa án ban hành</th>

            <th class="text-nowrap">{{ __('app.province') }}</th>
            <th class="text-nowrap">{{ __('app.district') }}</th>
            <th class="text-nowrap">{{ __('app.ward') }}</th>
            <th class="min-w-200px">{{ __('app.address') }}</th>

            <th class="text-nowrap">{{ __('app.province') }}</th>
            <th class="text-nowrap">{{ __('app.district') }}</th>
            <th class="text-nowrap">{{ __('app.ward') }}</th>
            <th class="min-w-200px">{{ __('app.address') }}</th>

            <th class="text-nowrap">{{ __('app.identity_document') }}</th>
            <th class="text-nowrap">{{ __('app.identity_number') }}</th>

            <th class="text-nowrap">{{ __('app.province') }}</th>
            <th class="text-nowrap">{{ __('app.district') }}</th>
            <th class="text-nowrap">{{ __('app.ward') }}</th>
            <th class="min-w-200px">{{ __('app.address') }}</th>
        </tr>
        </thead>
        <tbody class="text-center">
        @php $i = 0 @endphp
        @foreach($judgmentDocuments as $jd)
            @if(count($jd->defendants))
                @foreach($jd->defendants as $ide => $defendant)
                    @php $i++ @endphp
                    <tr>
                        @include(env('APP_VIEW_PATH_ADMIN').'.batch.judgment_document.'.$view.'.judgment')
                        @include(env('APP_VIEW_PATH_ADMIN').'.batch.judgment_document.'.$view.'.defendant')
                    </tr>
                @endforeach
            @else
                @php $i++ @endphp
                @php $ide = 0 @endphp
                <tr>
                    @include(env('APP_VIEW_PATH_ADMIN').'.batch.judgment_document.'.$view.'.judgment')
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($judgmentDocuments) !!}

{!! renderSearchEmpty($judgmentDocuments) !!}
