<div class="modal fade" id="conversationIndexModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-primary">{{ __('app.chat') }}</h4>
                <button type="button" class="btn-close fs-22" onclick="commonShow('{{ route('message.filter_card', ['conversation_id' => 0]) }}', '#message-filter-card', this, 'conversation')" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-sm-flex align-items-center justify-content-between">
                                    <h5 class="card-title mb-0">{{ __('app.list') }}</h5>
                                    <div>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary p-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa-solid fa-plus"></i>
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="commonShowModal('{{ route('conversation.create') }}', '#conversationShowModal')">
                                                {{ __('app.private_conversation') }}
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="commonShowModal('{{ route('conversation.create', ['is_group' => true]) }}', '#conversationShowModal')">
                                                {{ __('app.group_chat') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="GET" action="{{ route('conversation.filter_conversation') }}" id="conversation-filter-form" class="filter-form" onsubmit="conversationFilter(); return false">
                                    <input type="hidden" name="member_id" value="{{ session('member_id') }}">
                                    <input type="hidden" name="member_type" value="{{ session('account') }}">
                                    <input type="hidden" name="type" value="">
                                    <input type="hidden" name="max_id" value="0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="search_key" onchange="changeActionForForm(this); conversationResetForm()" autocomplete="off" placeholder="{{ __('app.search') }}...">
                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-none">
                                        {!! renderSelectPaginateAndSubmit() !!}
                                    </div>
                                </form>

                                <div id="conversation-filter-table" class="filter-table" onscroll="conversationOnscrollBotton(this)"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card" id="message-filter-card"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="conversationShowModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content"></div>
    </div>
</div>

<!-- Pusher (Reverb dùng protocol của Pusher) -->
{{--<script src="{{ asset('assets/pusher/8.2.0/pusher.min.js') }}"></script>--}}
<!-- Laravel Echo -->
{{--<script src="{{ asset('assets/npm/laravel-echo/dist/echo.iife.js') }}"></script>--}}

<script>
    {{--window.Echo = new Echo.default({--}}
    {{--    broadcaster: 'reverb',--}}
    {{--    key: '{{ config('broadcasting.connections.reverb.key') }}',--}}
    {{--    wsHost: '{{ config('broadcasting.connections.reverb.options.host') }}',--}}
    {{--    wsPort: {{ config('broadcasting.connections.reverb.options.port') }},--}}
    {{--    forceTLS: false,--}}
    {{--    withCredentials: true,--}}
    {{--});--}}

    {{--window.Echo.connector.pusher.connection.bind('connected', function () {--}}
    {{--    console.log('connected');--}}
    {{--    $.ajax({--}}
    {{--        url: '{{ route('admin.user.info') }}',--}}
    {{--        type: 'GET',--}}
    {{--        dataType: 'JSON',--}}
    {{--        success: function(response) {--}}
    {{--            unreadConversationsCount(response?.data?.unread_conversations_count || 0);--}}
    {{--        },--}}
    {{--        error: function(xhr) {--}}
    {{--            let response = JSON.parse(xhr.responseText);--}}
    {{--            showNotification(response.type, response.message);--}}
    {{--        }--}}
    {{--    })--}}
    {{--});--}}

    {{--$(function () {--}}
    {{--    window.Echo.channel('conversation').listen('.message.sent', function (data) {--}}
    {{--        if (data.member_ids.includes({{ session('member_id') }})) {--}}
    {{--            if ($(`#message-filter-table[data-conversation-id=${data.message.conversation_id}]`).length) {--}}
    {{--                messageRender([data.message], 'new');--}}
    {{--                conversationRead(data.conversation_read_url);--}}
    {{--            }--}}
    {{--            conversationUnread(data.conversation_unread_url);--}}
    {{--        }--}}
    {{--    });--}}
    {{--});--}}

    function conversationRead(url) {
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                //
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
            }
        })
    }

    function conversationUnread(url) {
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                conversationRender(response?.data?.conversations, response?.data?.type);
                unreadConversationsCount(response?.data?.unread_conversations_count || 0);
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
            }
        })
    }

    function unreadConversationsCount(count = 0) {
        $('.unread_conversations_count').html(count);
    }
</script>

<script>
    function conversationIndex(modal = '#conversationIndexModal') {
        conversationResetForm();
        $(modal).modal('show');
        conversationFilter();
    }

    function conversationResetForm() {
        $('#conversation-filter-form input[name="type"]').val('');
        $('#conversation-filter-form input[name="max"]').val(0);
    }

    function conversationFilter(page = 1, form = '#conversation-filter-form', table = '#conversation-filter-table') {
        const params = $(form).find('input, select, textarea').serialize();
        $.ajax({
            url: $(form).attr('action')+'?page='+page+'&'+params,
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                if (response?.data?.conversations) {
                    conversationRender(response.data.conversations, response.data.type);
                    tooltipRender(table);
                }
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
            }
        })
    }

    function conversationSubmit(e, hideModal = true, reSearch = true) {
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
                        conversationFilter();
                    }
                    if (response?.data?.logs) {
                        showLogMessage(form, response.data.logs);
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

    function conversationDelete(url, e, message = '{{ __('app.message.are_you_sure_delete') }}') {
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
                            $(e).closest('.card-header').find('.action-close').trigger('click');
                            conversationFilter();
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

    function messageFilter(page = 1, form = '#message-filter-form', table = '#message-filter-table') {
        const params = $(form).find('input, select, textarea').serialize();
        $.ajax({
            url: $(form).attr('action')+'?page='+page+'&'+params,
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                if (response?.data?.messages) {
                    messageRender(response.data.messages, response.data.type);
                    tooltipRender(table);

                    unreadConversationsCount(response?.data?.unread_conversations_count || 0);
                }
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
            }
        })
    }

    function messageSubmit(e) {
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
                if (response.type === 'success') {
                    form.find('textarea[name="content"]').val('');
                }
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
                showNotificationValidate(form, response.errors ? response.errors : []);
            }
        })
    }

    function messageDelete(url, e, message = '{{ __('app.message.are_you_sure_delete') }}') {
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
                        if (response.type === 'success') {
                            $(e).closest('.message-item').remove();
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

    let oldCreateById = null;
    function messageRender(messages, type = null, table = '#message-filter-table') {
        oldCreateById = type ? oldCreateById : null;

        let html = '';
        if (messages) {
            messages.forEach(function (message) {
                if (message.created_by.id == {{ session('member_id') }}) {
                    html += `<div class="d-flex justify-content-end message-item" data-message-id="${message.id}">
                                <a href="javascript:void(0)" class="mb-1 me-1 message-action px-2 py-1 fs-12">
                                    ${ message.created_at_formatted }
                                </a>
                                <a href="javascript:void(0)" class="mb-1 me-1 message-action px-2 py-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="messageDelete('{{ route('message.index') }}/${ message.id }/destroy', this)">
                                        {{ __('app.delete') }}
                                    </a>
                                </div>
                                <p class="mb-1 message-content px-3 py-2 mx-3">${ message.content }</p>
                            </div>`;
                } else {
                    html += `<div class="message-item" data-message-id="${ message.id }">`;
                    if (!oldCreateById || oldCreateById != message.created_by.id) {
                        html += `<div class="d-flex align-items-center mb-1">
                                    <img src="{{ env('APP_URL') }}/${ message.created_by.avatar }" alt="Profile" class="rounded-circle w-40px me-2">
                                    <p class="mb-1">
                                        <span class="title text-primary">${ message.created_by.name }</span>
                                    </p>
                                </div>`;
                    }
                    html += `<div class="d-flex justify-content-start">
                                <p class="ms-5 mb-1 px-3 py-2 message-content">${ message.content }</p>
                                <a href="javascript:void(0)" class="mb-1 ms-1 message-action px-2 py-1 fs-12">
                                    ${ message.created_at_formatted }
                                </a>
                            </div>`;
                    html += `</div>`;
                }

                oldCreateById = message.created_by.id;
            })
        }

        let el = $(table);

        switch (type) {
            case 'new':
                let checkScroll = el.scrollTop() + el.innerHeight() >= el[0].scrollHeight - 5;
                el.append(html);
                if (checkScroll) {
                    el.scrollTop(el[0].scrollHeight);
                }
                break;
            case 'botton':
                el.append(html);
                el.scrollTop(el[0].scrollHeight);
                break;
            case 'top':
                let oldScrollHeight = el[0].scrollHeight;
                el.prepend(html);
                let newScrollHeight = el[0].scrollHeight;
                el.scrollTop(newScrollHeight - oldScrollHeight);
                break;
            default:
                el.html(html);
                el.scrollTop(el[0].scrollHeight);
                break;
        }
    }

    function conversationRender(conversations, type, table="#conversation-filter-table") {
        let html = '';
        let appMember = ' {{ __('app.member') }}';
        let el = $(table);

        if (conversations) {
            conversations.forEach(function (conversation) {
                html += `<div>
                            <a href="javascript:void(0)" class="d-flex align-items-center justify-content-between p-1 my-1 conversation-item" data-conversation-id="${conversation.id}"
                               onclick="commonShow('{{ route('message.filter_card') }}?conversation_id=${conversation.id}', '#message-filter-card', this, 'conversation')">
                                <p class="d-flex align-items-center mb-0">
                                    <img src="{{ env('APP_URL') }}/${conversation.avatar}" alt="Profile" class="rounded-circle w-45px me-2">
                                    <span class="mb-1">
                                        <span class="title text-primary">${conversation.name}</span>
                                        <br>
                                        <span class="me-3 text-black fs-12">${conversation.last_message_at_formatted}</span>
                                        <span class="text-black fs-12">${conversation.is_group ? (conversation.conversation_members_count + appMember) : ''}</span>
                                    </span>
                                </p>`;

                if (conversation.new_messages_count) {
                    html += `<span class="btn btn-sm btn-danger rounded-circle float-end conversation-new-message">${conversation.new_messages_count}</span>`;
                }

                html += '</a></div>';

                el.find(`.conversation-item[data-conversation-id="${conversation.id}"]`).parent().remove();
            });
        }

        switch (type) {
            case 'new':
            case 'top':
                let checkScroll = el.scrollTop() <= 5;
                el.prepend(html);
                if (checkScroll) {
                    el.scrollTop(0);
                }
                break;
            case 'botton':
                el.append(html);
                break;
            default:
                el.html(html);
                el.scrollTop(0);
                break;
        }
    }

    function messageOnscrollTop(e) {
        if ($(e).scrollTop() === 0) {
            let form = $('#message-filter-form');
            let max_id = $('#message-filter-table').find('.message-item').first().attr('data-message-id');
            form.find('input[name="max_id"]').val(max_id);
            form.find('input[name="type"]').val('top');
            form.trigger('submit');
        }
    }

    function conversationOnscrollBotton(e) {
        let el = $(e);
        if (el.scrollTop() + el.innerHeight() >= e.scrollHeight) {
            let form = $('#conversation-filter-form');
            let max_id = $('#conversation-filter-table').find('.conversation-item').first().attr('data-conversation-id');
            form.find('input[name="max_id"]').val(max_id);
            form.find('input[name="type"]').val('botton');
            form.trigger('submit');
        }
    }
</script>
