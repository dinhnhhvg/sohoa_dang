<div class="modal fade" id="showNoteValueModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-primary">{{ __('app.note') }}</h4>
                <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div></div>
                <div>
                    <form method="POST" action="{{ route('admin.user.update', ['user' => session('user_id')]) }}"
                          onsubmit="commonSubmit(this, false, false); return false" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group mb-3">
                            <textarea class="form-control" rows="30" name="note_value" onchange="changeActionForForm(this)"></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showNoteValue(modal = '#showNoteValueModal') {
        $.ajax({
            url: '{{ route('admin.user.get_note_value', ['user' => session('user_id')]) }}',
            type: 'GET',
            success: function(response) {
                $(modal).find('textarea[name="note_value"]').val(response);
                $(modal).modal('show');
            },
            error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                showNotification(response.type, response.message);
            }
        });
    }
</script>
<!-- Note Value end -->
