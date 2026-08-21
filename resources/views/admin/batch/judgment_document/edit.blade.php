<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.entry') }}: THÔNG TIN VĂN BẢN</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-8">
            <div class="card mb-0">
                <div class="card-body p-2">
                    <iframe class="file-manager-frame" style="height: calc(100vh - 175px);"
                            src="{!! url('file-manager?type='.session('account').'&callback=selectFileWithFileManager&working_dir='.removePrefix($judgmentDocument->judgment->folder_path.'&working_file_name='.basename($judgmentDocument->file_path))) !!}">
                    </iframe>
                </div>
            </div>
        </div>
        <div class="col-4 edit-by-file-path-col"></div>
    </div>
</div>

<script>
    editByFilePath2("{{ $judgmentDocument->file_path }}");

    function editByFilePath2(filePath, e = '.edit-by-file-path-col') {
        // filePath = filePath.replace(/^https?:\/\/[^\/]+/, '').substring(1);
        // if ($(e).length == 0) {
        //     return;
        // }

        $.ajax({
            url: '{{ route('admin.judgment_document.edit_by_file_path') }}',
            type: 'GET',
            data: {
                file_path: filePath,
                action_type: '{{ $action_type }}'
            },
            success: function(response) {
                $(e).html(response);
                formRender(e);
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
            }
        });
    }

    function editByFilePath(filePath, e = '.edit-by-file-path-col') {
        console.log('???');
        return;

        filePath = filePath.replace(/^https?:\/\/[^\/]+/, '').substring(1);
        if ($(e).length == 0) {
            return;
        }

        $.ajax({
            url: '{{ route('admin.judgment_document.edit_by_file_path') }}',
            type: 'GET',
            data: {
                file_path: filePath,
                action_type: '{{ $action_type }}'
            },
            success: function(response) {
                $(e).html(response);
                formRender(e);
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
            }
        });
    }

    function addDefendant() {
        let accordion = $('#accordionJD');
        let length = accordion.find('.accordion-item-defendant').length;
        length = length+4;
        let defendant = $('#accordionJD-defendant').parent().clone();
        defendant.find('.accordion-button').each(function () {
            let targetId = $(this).attr('data-bs-target')+'-'+length;
            $(this).attr('data-bs-target', targetId);
        });
        defendant.find('.accordion-collapse').each(function () {
            let id = $(this).attr('id')+'-'+length;
            $(this).attr('id', id)
        });
        defendant.find('select.form-select').addClass('select2');
        accordion.append(defendant);
        formRender(`#accordionJD-defendant-${length}`);
    }

    function showCopyDefendant(url, action_type, modal = '#common-modal-lg') {
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                action_type: action_type
            },
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

    function copyDefendant(e, reloadUrl, hideModal = true) {
        let form = $(e).closest('form');

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
                        commonShowModal(reloadUrl, '#sub-modal-fullscreen');
                    } else {
                        $(e).find('span.error-message').remove();
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

    function changeDefendantName(e) {
        let name = $(e).val();
        let title = '{{ __('app.defendant') }}: '+name;
        $(e).closest('.accordion-item-defendant').find('.accordion-header .defendant-name').text(title);
    }

    function changeHasAppeal(e) {
        let html = $(e).value ? '<i class="fa-solid fa-check text-primary"></i>' : '';
        $(e).closest('.accordion-item-defendant').find('.accordion-header .defendant-has-appeal').html(html);
    }

    function defendantSubmit(e) {
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
                    $(e).closest('form').find('input[name="defendant_id"]').val(response.data.defendant_id);
                }
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
                showNotificationValidate(form, response.errors ? response.errors : []);
            }
        })
    }

    function addDay(element, daysToAdd) {
        let $input = $(element).closest('.form-group').find('input.datepicker');
        let dateStr = $input.val();

        if (dateStr) {
            let isoFormat = dateStr.split('/').reverse().join('-');
            let jsDate = new Date(isoFormat);

            if (!isNaN(jsDate)) {
                jsDate.setDate(jsDate.getDate() + daysToAdd);
                let formatted = new Intl.DateTimeFormat('en-GB').format(jsDate);
                $input.val(formatted).trigger('change');
            }
        }
    }

    function onchangeJd(e) {
        let href = $(e).find('option:selected').val();
        commonShowModal(href, '#sub-modal-fullscreen')
    }

    function saveAll(e) {
        $(e).parent().parent().parent().find('form').each(function () {
            $(this).find('button[type="submit"]').trigger('click');
        });
    }

    function selectNextOption(e) {
        let s = $(e).closest('.modal-body').find('select[name="jd_id"]').first();
        let o = s.find('option:selected');
        let n = o.next('option');
        if (n.length > 0) {
            n.prop('selected', true);
            s.trigger('change');
        } else {
            $(e).remove();
        }
    }
</script>
