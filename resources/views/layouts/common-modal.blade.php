<div class="modal fade" id="{{ $id }}" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered {{ isset($size) ? 'modal-' . $size : '' }}" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 id="modal_title"></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="content">
                test
            </div>
        </div>
    </div>
</div>
