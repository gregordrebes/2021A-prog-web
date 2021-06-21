<div class="modal fade" id="{{ $name }}-modal" tabindex="-1" role="dialog" aria-labelledby="{{ $name }}-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $name }}-modal-label">{{ $label }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                @yield("modal-form")
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                @yield("modal-submit-btn")
            </div>
        </div>
    </div>
</div>
