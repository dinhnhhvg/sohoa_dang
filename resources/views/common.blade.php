<!-- Notification start -->
<script>
    $(document).ready(function() {
        @if (session('success'))
        showNotification('success', '{{ session('success') }}');
        @endif

        @if (session('error'))
        showNotification('error', '{{ session('error') }}');
        @endif

        @if ($errors->any())
        showNotification('error', '{{ __('app.message.validate_error') }}');
        @endif
    });

    function showNotification(type, message) {
        if (type === 'success') {
            toastr.success(message);
        } else {
            toastr.error(message);
        }
    }

    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "timeOut": "3000",
        "extendedTimeOut": "500"
    };
</script>
<!-- Notification end -->

<script>
    function tooltipRender(view = 'body') {
        $(`${view} a[title]`).tooltip();
        $(`${view} span[title]`).tooltip();
        $(`${view} button[title]`).tooltip();
    }

    function collapseRender() {
        const storageKey = 'activeCollapseId';
        const collapse = $('.collapse');

        collapse.on('show.bs.collapse', function () {
            sessionStorage.setItem(storageKey, this.id);
        });
        collapse.on('hide.bs.collapse', function () {
            sessionStorage.removeItem(storageKey);
        });

        const savedId = sessionStorage.getItem(storageKey);

        if (savedId) {
            const target = $('#' + savedId);
            if (target.length) {
                target.collapse('show');
            }
        }
    }

    function tableRender(view = 'body') {
        tooltipRender(view);
        collapseRender();
        tableStickyRender(view);
        hideShowColumnRender(view);
    }

    function hideShowColumnRender(view = 'body') {
        let pe = view === 'body' ? $(view) : $(view).closest('.filter-card');
        pe.find('.dropdown-item[data-localStorage-name]').each(function (i, e) {
            let lsName = $(e).attr('data-localStorage-name');
            let max = $(e).attr('data-sticky-column');
            max = max ? max : 0;
            let columns = localStorage.getItem(lsName);
            columns = columns ? columns.split(',') : '';

            let table = $(e).closest('.card').find('.table-responsive table');
            table.find('thead th').each(function (i2, th) {
                if (max <= i2 && columns && columns.includes(String(i2))) {
                    $(th).addClass('d-none');
                    table.find('tbody tr').each(function (i3, tr) {
                        $(tr).find('td').eq(i2).addClass('d-none');
                    });
                } else {
                    $(th).removeClass('d-none');
                    table.find('tbody tr').each(function (i3, tr) {
                        $(tr).find('td').eq(i2).removeClass('d-none');
                    });
                }
            });
        });
        tableDoubleScrollRender(view);
    }

    function tableStickyRender(view = 'body') {
        $(view).find('.table-responsive table[data-sticky-column]').each(function (i1, table) {
            let max = $(this).attr('data-sticky-column');
            let width = -1;
            $(table).find('thead tr').each(function (i2, thTr) {
                width = -1;
                $(thTr).find('th').each(function (i3, th) {
                    if (i3 < max) {
                        $(th).addClass('p-sticky').css('left', width);
                        $(table).find('tbody tr').each(function (i4, tr) {
                            $(tr).find('td').eq(i3).addClass('p-sticky').css('left', width);
                        })
                        width = width + $(th).outerWidth() - 1;
                    }
                })
            });
        });
    }

    function sortTable(e, name) {
        let type = '';
        if ($(e).find('.fas.fa-sort').length > 0) {
            type = 'ASC';
        }
        if ($(e).find('.fa-solid.fa-sort-up').length > 0) {
            type = 'DESC';
        }

        $(e).closest('.card-body').find('input[name="orderByName"]').val(name);
        $(e).closest('.card-body').find('input[name="orderByType"]').val(type);
        $(e).closest('.card-body').find('button[type="submit"]').trigger('click');
    }

    function tableDoubleScrollRender(view = 'body') {
        setTimeout(() => {
            $(view).find('.double-scroll').remove();
            $(view).find('.table-responsive').doubleScroll().css('overflow-y', 'auto');
        }, 100);
    }

    function formRender(view = 'body') {
        setTimeout(() => {
            select2Render(view);
            datepickerRender(view);
            ckeditorRender(view);
            changeIsSearch();
        }, 100);
    }

    function ckeditorRender(view = 'body') {
        const account = "{{ session('account') }}";
        $(view).find('textarea.ckeditor-render').each(function () {
            CKEDITOR.replace(this, {
                language: '{{ app()->getLocale() }}',
                filebrowserImageBrowseUrl: '/file-manager?type=' + account,
                filebrowserBrowseUrl: '/file-manager?type=' + account,
            })
        });

        if ($.fn.modal && $.fn.modal.Constructor) {
            $.fn.modal.Constructor.prototype._enforceFocus = function() {};
        }

        document.addEventListener('focusin', function(e) {
            if (e.target.closest('.cke_dialog')) {
                e.stopPropagation();
            }
        }, true);
    }

    function duplicateParentElement(e) {
        $(e).parent().clone().appendTo($(e).parent().parent());

        let newE = $(e).parent().siblings().last();

        newE.addClass('mt-2');
        newE.find('input').val('');
        newE.find('a').removeAttr('onclick').attr('onclick', 'deleteParentElement(this)');
        newE.find('i').removeClass().addClass('fa-solid fa-xmark text-danger')
    }

    function phoneOnly(input) {
        input.value = input.value.replace(/[^0-9]/g, '');
        if (input.value.length > 10) {
            input.value = input.value.substring(0, 10);
        }
    }

    function numberOnly(input) {
        input.value = input.value.replace(/[^0-9-]/g, '');
    }

    function addCommas(input) {
        let x = $(input).val();
        if (x === '-') {
            $(input).val('-');
            return;
        }
        let num = x ? parseFloat(x.replace(/\./g, '')) : '';
        if (!isNaN(num) && num !== '') {
            $(input).val(num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
            return;
        }
        $(input).val('');
        return '';
    }

    function togglePassword(e) {
        let show = '<i class="fa-regular fa-eye"></i>'
        let hide = '<i class="fa-regular fa-eye-slash"></i>';
        let input = $(e).parent().find('input');

        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            $(e).html(show);
        } else {
            input.attr('type', 'password');
            $(e).html(hide);
        }
    }

    const rawSelect2Lang = @json(__('select2'));
    const select2Lang = {};
    Object.keys(rawSelect2Lang).forEach(key => {
        select2Lang[key] = function(args) {
            let text = rawSelect2Lang[key];
            if (args && args.count !== undefined) {
                text = text.replace(':count', args.count);
            }
            return text;
        };
    });

    function select2Render(view = 'body') {
        setTimeout(function() {
            $(view).find('select.select2').each(function (i, s) {
                let m = $(s).closest('.modal');
                if (m.length > 0) {
                    $(s).select2({
                        minimumResultsForSearch: 5,
                        language: select2Lang,
                        dropdownParent: m,
                        allowClear: true
                    });
                } else {
                    $(s).select2({
                        minimumResultsForSearch: 5,
                        language: select2Lang,
                        allowClear: true
                    });
                }

                if ($(s).prop('multiple')) {
                    $(s).next('.select2-container').on('dblclick', function () {
                        let allValues = $(s).find('option:not([value=""])').map((index, option) => option.value).get();
                        $(s).val(allValues).trigger('change');
                    });
                }
            });
        }, 100);
    }

    function datepickerRender(view = 'body') {
        $(view).find("input.datepicker").each(function() {
            $(this).flatpickr({
                enableTime: false,
                dateFormat: $(this).attr("data-format"),
                allowInput: true
            });
        });
        $(view).find("input.timepicker").each(function() {
            $(this).flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: $(this).attr("data-format"),
                time_24hr: true,
                allowInput: true
            });
        });
        $(view).find("input.datetimepicker").each(function() {
            $(this).flatpickr({
                enableTime: true,
                dateFormat: $(this).attr("data-format"),
                time_24hr: true,
                allowInput: true
            });
        });
    }

    function showHideShowColumn(e, modal = '#common-modal-lg') {
        let html = ``;
        let lsName = $(e).attr('data-localStorage-name');
        let columns = localStorage.getItem(lsName);
        columns = columns ? columns.split(',') : '';

        let table = $(e).closest('.card').find('.table-responsive table');
        let max = table.attr('data-sticky-column');
        max = max ? max : 0;

        table.find('thead th').each(function (i, th) {
            if (max <= i) {
                let colName = $(th).text().trim();
                let check = columns && columns.includes(String(i)) ? '' : 'checked';
                html += `<div class="col-md-6">
                            <label>
                                <input type="checkbox" class="form-check-input" value="${i}" ${check} onchange="hideShowColumn(this, '${lsName}')"> ${colName}
                            </label>
                        </div>`;
            }
        });
        html = `<div class="modal-header">
                    <h4 class="modal-title text-primary">{{ __('app.hide_show_column') }}</h4>
                    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">${html}</div>
                </div>`
        $(modal).find('.modal-content').html(html);
        $(modal).modal('show');
    }

    function hideShowColumn(e, lsName) {
        let i = $(e).val();
        let columns = localStorage.getItem(lsName);
        if (e.checked) {
            if (columns) {
                columns = columns.split(',').filter(item => item !== i);
                localStorage.setItem(lsName, columns.join(','))
            }
        } else {
            columns = columns ? columns+','+String(i) : String(i);
            localStorage.setItem(lsName, columns);
        }
        hideShowColumnRender();
    }

    function renderViewType(e = null) {
        let viewType = localStorage.getItem('viewType');
        let tableIcon = '<i class="fas fa-th-list"></i>';
        let cardIcon = '<i class="fas fa-th-large"></i>';

        if (e) {
            viewType = viewType !== 'table' ? 'table' : 'card';
        } else {
            viewType = viewType ? viewType : 'table';
        }
        localStorage.setItem('viewType', viewType);

        $('.filter-card .filter-form input[name="viewType"]').val(viewType);
        $('.filter-card .view-type-button').html(viewType === 'table' ? tableIcon : cardIcon);
        if (e) {
            $(e).closest('.filter-card').find('.filter-form').submit();
        }
    }

    function changeIsSearch(e) {
        let isSearch = localStorage.getItem('isSearch');
        let search = '<i class="fa-solid fa-magnifying-glass"></i>';
        let noSearch = '<div class="fa-icon-slash"><i class="fas fa-search"></i></div>';

        if (e) {
            isSearch = isSearch !== 'search' ? 'search' : 'noSearch';
        } else {
            isSearch = isSearch ? isSearch : 'search';
        }
        localStorage.setItem('isSearch', isSearch);

        $('.filter-card .is-search-button').html(isSearch === 'search' ? search : noSearch);
        if (isSearch === 'search') {
            $('.filter-card .filter-form').removeClass('d-none');
        } else {
            $('.filter-card .filter-form').addClass('d-none');
        }
    }

    function getWardByProvince(e) {
        $.ajax({
            url: '{{ route("ward.get_by_province") }}',
            type: 'GET',
            data: {
                province_id: $(e).val()
            },
            success: function(response) {
                $(e).closest('.form-group').parent().next().find('select.select2').html(response).trigger('change');
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
            }
        });
    }

    function getDistrictByProvince(e) {
        $.ajax({
            url: '{{ route("old_district.get_by_old_province") }}',
            type: 'GET',
            data: {
                old_province_id: $(e).val()
            },
            success: function(response) {
                $(e).closest('.form-group').parent().next().find('select.select2').html(response).trigger('change');
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
            }
        });
    }

    function getWardByDistrict(e) {
        $.ajax({
            url: '{{ route("old_ward.get_by_old_district") }}',
            type: 'GET',
            data: {
                old_district_id: $(e).val()
            },
            success: function(response) {
                $(e).closest('.form-group').parent().next().find('select.select2').html(response).trigger('change');
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
            }
        });
    }

    function getClassroomByCenter(e) {
        $.ajax({
            url: '{{ route("classroom.get_by_center") }}',
            type: 'GET',
            data: {
                center_id: $(e).val()
            },
            success: function(response) {
                $(e).closest('form').find('select[name="classroom_id"]').html(response).trigger('change');
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
            }
        });
    }

    function getTopicByCategory(e) {
        $.ajax({
            url: '{{ route("topic.get_by_category") }}',
            type: 'GET',
            data: {
                category_id: $(e).val()
            },
            success: function (response) {
                $(e).closest('form').find('select[name="topic_id[]"]').html(response).trigger('change');
            },
            error: function (xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
            }
        });
    }

    function getParentCategoryByModule(e) {
        $.ajax({
            url: '{{ route("category.get_parent_by_module") }}',
            type: 'GET',
            data: {
                module: $(e).val()
            },
            success: function (response) {
                $(e).closest('form').find('select[name="parent_id"]').html(response).trigger('change');
            },
            error: function (xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
            }
        });
    }

    function getAttributeByCategory(e, view = '#attribute-multiple') {
        let category_id = $(e).val();
        if (!category_id) {
            $(e).closest('form').find(view).html('');
            return;
        }

        $.ajax({
            url: '{{ route("category_attribute.get_by_category") }}',
            type: 'GET',
            data: {
                category_id: category_id
            },
            success: function (response) {
                $(e).closest('form').find(view).html(response);
                formRender(view)
            },
            error: function (xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
            }
        });
    }

    function numberFormat(number) {
        number = parseInt(number) || 0;
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function changeStep(e, type = 'next', isChangeName = false) {
        let step = $(e).closest('.step');
        let parent = $(e).closest('.step-parent');

        if (type === 'next') {
            $(e).closest('.step').addClass('d-none');
            let next = step.next('.step');
            if (next.length === 0) {
                parent.find('.step').first().removeClass('d-none');
            } else {
                next.removeClass('d-none');
            }
        }

        if (type === 'back') {
            $(e).closest('.step').addClass('d-none');
            let prev = step.prev('.step');
            if (prev.length === 0) {
                parent.find('.step').last().removeClass('d-none');
            } else {
                prev.removeClass('d-none');
            }
        }

        if (isChangeName) {
            $(e).closest('form').find('.card-defendant').each(function (i, v) {
                let title = $(v).find('input[name="full_name[]"]').val();
                title = typeof title === 'undefined' ? '' : title;
                title = `{{ __('app.defendant') }} ${i+1}: ${title}`;
                $(v).find('.card-header .card-title').html(title);
            });
        }
    }
</script>

<!-- Common modal start -->
<div class="modal fade" id="common-modal-fullscreen" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
        <div class="modal-content"></div>
    </div>
</div>

<div class="modal fade" id="sub-modal-fullscreen" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
        <div class="modal-content"></div>
    </div>
</div>

<div class="modal fade" id="common-modal-xl" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content"></div>
    </div>
</div>

<div class="modal fade" id="common-modal-lg" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content"></div>
    </div>
</div>

<div class="modal fade" id="common-modal-md" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md modal-dialog-scrollable">
        <div class="modal-content"></div>
    </div>
</div>

<div class="modal fade" id="common-modal-sm" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm modal-dialog-scrollable">
        <div class="modal-content"></div>
    </div>
</div>
<!-- Common modal start -->

<!-- Common CRUD start -->
<script>
    function commonFilter(page = 1, form = '#filter-form', table = '#filter-table', isSaveStorage = true, isPagination = true) {

        if (isSaveStorage) {
            sessionStorage.setItem('filterForm', form);
            sessionStorage.setItem('filterTable', table);
        }

        const params = $(form).find('input, select, textarea').serialize();
        $.ajax({
            url: $(form).attr('action')+'?page='+page+'&'+params,
            type: 'GET',
            success: function(response) {
                $(table).html(response);
                tableRender(table);
                if (isPagination) {
                    paginationRender(table, 'commonFilter');
                }
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
            }
        })
    }

    function commonReFilter() {
        commonFilter(1, sessionStorage.getItem('filterForm'), sessionStorage.getItem('filterTable'));
    }

    function paginationRender(table, fName) {
        $(table).find('.pagination a[data-page]').each(function () {
            $(this).attr('href', 'javascript:void(0)');
            $(this).attr('onclick', `${fName}(${$(this).attr('data-page')}, '${sessionStorage.getItem('filterForm')}', '${sessionStorage.getItem('filterTable')}')`
            );
        })
    }

    function commonShow(url, item, e = null, type = null) {
        $.ajax({
            url: url,
            type: 'GET',
            data: {},
            success: function(response) {
                $(item).html(response);
                formRender(item);

                if (type === 'conversation') {
                    $(e).closest('#conversation-filter-table').find('.conversation-item').each(function () {
                        $(this).removeClass('active');
                    });

                    $(e).find('.conversation-new-message').remove();
                    $(e).addClass('active');
                }
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
            }
        });
    }

    function commonShowModal(url, modal = '#common-modal-md', e = null, ids = false) {
        let dataGet = {};
        if (e && ids) {
            ids = getCheckedValueByName(e, 'id');
            if (ids.length <= 0) {
                showNotification('error', '{{ __('app.message.please_select_at_least_one_record') }}');
                return;
            }
            dataGet.ids = ids.toString();
        }
        $.ajax({
            url: url,
            type: 'GET',
            data: dataGet,
            success: function(response) {
                $(modal).find('.modal-content').html(response);
                $(modal).modal('show');
                formRender(modal);
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
            }
        });
    }

    function commonShowTab(url, e) {
        let tab = $(e).find('.nav-link').first().attr('data-bs-target');
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                $(tab).html(response);
                formRender(tab);
                tableRender(tab);
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
            }
        });
    }

    function commonSubmit(e, hideModal = true, reSearch = true) {
        let form = $(e).closest('form');
        renderDataByCkeditor(form);

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            data: new FormData(form[0]),
            success: function(response) {
                showNotification(response.type, response.message);
                if (response.type === 'success') {
                    if (hideModal) {
                        $(e).closest('.modal').modal('hide');
                    } else {
                        $(e).find('span.error-message').remove();
                    }
                    if (reSearch) {
                        commonReFilter();
                    }
                    if (response?.data?.logs) {
                        showLogMessage(form, response.data.logs);
                    }
                    // Show log import
                    if (response?.data?.url) {
                        commonShowModal(response.data.url, '#common-modal-lg');
                    }
                }
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
                showNotificationValidate(form, response.errors ? response.errors : []);
            }
        })
    }

    function commonDelete(url, message = '{{ __('app.message.are_you_sure_delete') }}') {
        Swal.fire({
            title: '{{ __("app.message.are_you_sure") }}',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{ __("app.doing_now") }}',
            cancelButtonText: '{{ __("app.no") }}',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    dataType: 'JSON',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    data: {},
                    success: function(response) {
                        showNotification(response.type, response.message);
                        if (response.type === 'success') {
                            commonReFilter();
                        }
                    },
                    error: function(xhr) {
                        let response = JSON.parse(xhr.responseText);
                        showNotification(response.type, response.message);
                    }
                });
            }
        })
    }

    function commonToggleActive(url, is_active = null) {
        is_active = is_active ? 0 : 1;
        $.ajax({
            url: url,
            type: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            data: {
                is_active: is_active,
            },
            success: function(response) {
                showNotification(response.type, response.message);
                if (response.type === 'success') {
                    commonFilter();
                }
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
            }
        });
    }

    function commonHandleAction(e, url, message = '', reFilter = true) {
        Swal.fire({
            title: '{{ __("app.message.are_you_sure") }}',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{ __("app.doing_now") }}',
            cancelButtonText: '{{ __("app.no") }}',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'JSON',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    data: {},
                    success: function(response) {
                        showNotification(response.type, response.message);
                        if (response.type === 'success') {
                            if (reFilter) {
                                commonReFilter();
                            }
                        }
                    },
                    error: function(xhr) {
                        let response = JSON.parse(xhr.responseText);
                        showNotification(response.type, response.message);
                    }
                });
            }
        })
    }

    function commonHandleMany(e, url, message = '{{ __('app.message.are_you_delete_many') }}') {
        let ids = getCheckedValueByName(e, 'id');
        if (ids.length <= 0) {
            showNotification('error', '{{ __('app.message.please_select_at_least_one_record') }}');
            return;
        }
        let status_ids = getCheckedValueByName(e, 'status_id', ids);

        Swal.fire({
            title: '{{ __("app.message.are_you_sure") }}',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{ __("app.doing_now") }}',
            cancelButtonText: '{{ __("app.no") }}',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    dataType: 'JSON',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    data: {
                        ids: ids.toString(),
                        status_ids: status_ids.toString()
                    },
                    success: function(response) {
                        showNotification(response.type, response.message);
                        if (response.type === 'success') {
                            commonReFilter();
                        }
                    },
                    error: function(xhr) {
                        let response = JSON.parse(xhr.responseText);
                        showNotification(response.type, response.message);
                    }
                });
            }
        })
    }

    function renderDataByCkeditor(form) {
        form.find('textarea.ckeditor-render').each(function() {
            let editorInstance = CKEDITOR.instances[$(this).attr('name')];
            if (editorInstance) {
                $(this).val(editorInstance.getData());
            }
        });
    }

    function getCheckedValueByName(e, name, ids = null) {
        if (!ids) {
            let values = [];
            $(e).closest('.filter-card').find(`.table-responsive input[name="${name}[]"]:checked`).each(function () {
                values.push($(this).val());
            });
            return values;
        }

        let values = [];
        $.each(ids, function(i, id) {
            let eid = $(e).closest('.filter-card').find(`.table-responsive input[name="id[]"][value="${id}"]`).closest('tr').find(`input[name="${name}[]"]:checked`);
            if (eid.length) {
                values.push(eid.val());
            } else {
                values.push(null);
            }
        });
        return values;
    }

    function checkAll(e, c = 'id') {
        if (e.checked) {
            $(e).closest('table').find(`input.${c}:checkbox`).each(function () {
                this.checked = true;
                if (c !== 'id') {
                    singleCheck(this);
                }
            })
        } else {
            $(e).closest('table').find(`input.${c}:checkbox`).each(function () {
                this.checked = false;
            })
        }
    }

    function singleCheck(e) {
        if (e.checked) {
            let name = $(e).attr('name');
            $(e).closest('tr').find(`input[name="${name}"]`).each(function () {
                this.checked = false;
            });
            e.checked = true;
        }
    }

    function showNotificationValidate(form, errors) {
        $(form).find('span.error-message').remove();
        $.each(errors, function(i, v) {
            let e = $(form).find(`[name="${i}"]`);
            let message = `<span class="d-block error-message text-danger fs-15 mt-1">${v[0]}</span>`;
            if (e.length) {
                if (e.closest('.input-group').length) {
                    e.parent().after(message);
                } else {
                    e.parent().append(message);
                }
            } else {
                let e1 = $(form).find(`[name="${i}[]"]`);
                if (e1.length) {
                    $(form).find(`[name="${i}[]"]`).parent().append(message);
                } else {
                    let ai = i.split(".");
                    console.log(ai);
                    if (ai.length) {
                        $(form).find(`[name="${ai[0]}[]"]`).parent().append(message);
                    }
                }
            }
        })
    }

    function changeActionForForm(e, action = false, isSubmit = true) {
        let form = $(e).closest('form');
        if (action) {
            form.attr('action', action);
        }
        if (isSubmit) {
            form.trigger('submit');
        }
    }

    function commonChangeType(t, e) {
        let type = '';
        switch (t) {
            case 'document_type':
                type = $(e).find('option:selected').attr('data-code');
                if (type === 'document_other') {
                    type = '';
                }
                $(e).closest('form').find(`.${t}`).parent().find('input').val('');
                $(e).closest('form').find(`.${t}`).attr(`onclick`, `openFileManager(this, '${type}')`);
                break;
            case 'item_media':
                type = $(e).val();
                $(e).closest('form').find(`.${t}`).parent().find('input').val('');
                $(e).closest('form').find(`.${t}`).attr(`onclick`, `openFileManager(this, '${type}')`);
                break;
            case 'video_type':
                type = $(e).find('option:selected').attr('data-code');
                $(e).closest('form').find(`.${t}`).parent().parent().addClass('d-none');
                $(e).closest('form').find(`.${type}`).parent().parent().removeClass('d-none');
                break;
            default:
                break;
        }
    }

    function commonChangeValue(url, name, value, reSearch = false) {
        $.ajax({
            url: url,
            type: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            data: {
                [name]: value,
            },
            success: function(response) {
                showNotification(response.type, response.message);
                if (response.type === 'success') {
                    if (reSearch) {
                        commonFilter();
                    }
                }
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
            }
        });
    }

    function chartRender(ide, chartData) {
        const ctx = document.getElementById(ide).getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartData.labels,
                datasets: chartData.series.map(s => ({
                    label: s.name,
                    data: s.data,
                    borderWidth: 2,
                    tension: 0.3
                }))
            },
            options: {
                responsive: true,
                animation: false
            }
        });
    }
</script>
<!-- Common CRUD end -->

<div class="modal fade" id="showLogMessageModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content"></div>
    </div>
</div>

<script>
    function showLogMessage(form, logs, modal = '#showLogMessageModal') {
        let html = '';
        $.each(logs, function(i, v) {
            html += `<p class="mb-2">${v.name}: <span class="${v.status ? 'text-success' : 'text-danger'}">${v.message}<span></p>`;
        });
        if (form.find('.show-log-message').length) {
            form.find('.show-log-message').html(html);
        } else {
            html = `<div class="modal-header">
                        <h4 class="modal-title text-primary">{{ __('app.log') }}</h4>
                        <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">${html}</div>`;
            $(modal).find('.modal-content').html(html);
            $(modal).modal('show');
        }
    }
</script>

<!-- Common ORDER start -->
<script>
    function useCoupon(e) {
        let row = $(e).closest('.row');
        let totalAmount = row.find('input[name="total_amount"]').val();
        totalAmount = parseInt(totalAmount.replaceAll('.', ''));
        let couponCode = $(e).val();
        if (!couponCode) {
            changeAmount(0, row);
            return;
        }

        $.ajax({
            url: '{{ route('admin.order.use_coupon') }}',
            type: 'POST',
            dataType: 'JSON',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            data: {
                coupon_code: $(e).val(),
                total_amount: totalAmount
            },
            success: function(response) {
                showNotification(response.type, response.message);
                changeAmount(response.data.amount, row);
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
                changeAmount(0, row);
            }
        })

        function changeAmount(couponAmount, row) {
            row.find('input[name="coupon_amount"]').val(numberFormat(couponAmount));
            row.find('input[name="discount_amount"]').trigger('change');

        }
    }

    function useDiscountAmount(e) {
        let row = $(e).closest('.row');
        let totalAmount = row.find('input[name="total_amount"]').val();
        let couponAmount = row.find('input[name="coupon_amount"]').val();
        let amount = parseInt(totalAmount.replaceAll('.', '')) - parseInt(couponAmount.replaceAll('.', ''));
        let discountAmount = row.find('input[name="discount_amount"]').val();

        if (discountAmount <= 0) {
            changeAmount(amount, 0, row);
            return;
        }

        $.ajax({
            url: '{{ route('admin.order.use_discount_amount') }}',
            type: 'POST',
            dataType: 'JSON',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            data: {
                coupon_code: $(e).val(),
                amount: amount,
                discount_amount: discountAmount
            },
            success: function(response) {
                showNotification(response.type, response.message);
                changeAmount(amount, response.data.discount_amount, row);
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
                changeAmount(amount, 0, row);
            }
        })

        function changeAmount(amount, discountAmount, row) {
            row.find('input[name="discount_amount"]').val(numberFormat(discountAmount));
            row.find('input[name="final_amount"]').val(numberFormat(amount - discountAmount));
        }
    }
</script>
<!-- Common ORDER end -->

<!-- Common Export start -->
<a href="javascript:void(0)" class="d-none" id="common-export-id">Export excel</a>

<script>
    function commonExport(url, e, a = '#common-export-id') {
        let param = $(e).closest('.filter-card').find('.filter-form').serialize();
        $(a).attr('href', url+'?'+param);
        $(a)[0].click();
    }
</script>
<!-- Common Export end -->

<!-- File manage start -->
<div class="modal fade" id="file-manager-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-primary">{{ __('app.select_file') }}</h4>
                <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <iframe class="file-manager-frame" src=""></iframe>
{{--                <iframe class="file-manager-frame" src="{{ url('file-manager?type='.session('account').'&callback=selectFileWithFileManager') }}"></iframe>--}}
            </div>
        </div>
    </div>
</div>

<script>
    let elementTargetFileManage = '';
    let elementFileTypes = '';

    function openFileManager(e, fileTypes = '', element = '#file-manager-modal') {
        elementTargetFileManage = $(e);
        elementFileTypes = fileTypes;

        let src = "{!! url('file-manager?type='.session('account').'&callback=selectFileWithFileManager') !!}";
        let workingDir = $(e).parent().find('input').val();
        workingDir = removePrefix(workingDir, 'storage/users');
        src = workingDir ? (src + '&working_dir=' + workingDir) : src;
        $(element).find('.file-manager-frame').attr('src', src);
        $('#file-manager-modal').modal('show');
    }

    function removePrefix(str, prefix) {
        if (str.startsWith(prefix)) {
            return str.slice(prefix.length);
        }
        return str;
    }

    function selectFileWithFileManager(files) {
        let file = files[0];

        if (!elementTargetFileManage) {
            return;
        }

        let p = elementTargetFileManage.closest('.form-group');
        let url = files[0].url;

        if (elementFileTypes !== '') {
            let fileTypeConfig = '<?php echo json_encode(config('lfm.file_type_config')); ?>';
            fileTypeConfig = JSON.parse(fileTypeConfig);
            let extensionConfig = [];
            elementFileTypes.split(',').forEach(function (v) {
                extensionConfig = extensionConfig.concat(fileTypeConfig[v]);
            });

            let extension = file.name.split('.').pop().toLowerCase();
            if (!extensionConfig.includes(extension)) {
                toastr.error('{{ __('app.message.select_file_type_error') }}');
                return;
            }
            if (elementFileTypes === 'image') {
                p.find('img').attr('src', url);
                p.find('button.save-image').removeClass('d-none');
            }
        }
        let path = file.is_file ? url.replace('<?php echo e(env('APP_URL')); ?>'+'/', '') : 'storage/users'+url;
        p.find('input').val(path);
        $('#file-manager-modal').modal('hide');
    }

    function judgmentUpdate(e) {
        let form = $(e).closest('form');
        renderDataByCkeditor(form);

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            data: new FormData(form[0]),
            success: function(response) {
                showNotification(response.type, response.message);
                if (response.type === 'success') {
                    $(e).closest('.modal').modal('hide');
                    $(e).find('span.error-message').remove();
                    commonFilter(1, '#judgment-filter-form', '#judgment-filter-table');
                }
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
                showNotificationValidate(form, response.errors ? response.errors : []);
            }
        })
    }
</script>
<!-- File manage end -->

<!-- Loading overlay -->
<div id="global-loading">
    <div class="loading-body">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">{{ __('app.loading') }}...</span>
        </div>
        <p class="text-primary">{{ __('app.loading_data') }}...</p>
    </div>
</div>

{{--<script src="https://player.vdocipher.com/playerAssets/1.6.10/vdo.js"></script>--}}

<script>
    function playVdoCipher(otp, playbackInfo, element) {
        vdo.add({
            otp: otp,
            playbackInfo: playbackInfo,
            theme: "9ae8bbe8dd964ddc9bdb932cca1cb59a",
            container: document.querySelector(element),
        });
    }
</script>


<script>
    formRender();
    renderViewType();
    changeIsSearch();

    $(document).ready(function() {
        tooltipRender();

        $(window).resize(function() {
            tableRender();
        })
    });

    $(document).ajaxStart(function() {
        $('#global-loading').fadeIn(100);
    });

    $(document).ajaxStop(function() {
        $('#global-loading').fadeOut(100);
    });

</script>
