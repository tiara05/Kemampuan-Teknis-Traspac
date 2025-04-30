<div class="modal-body text-center">
    <h5 class="mb-4">
        Are you sure you want to delete this data?
    </h5>

    <div class="d-flex justify-content-center gap-3">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">No</button>
        <form class="ajax_form" action="{{ $route }}" method="POST" style="display:inline;" data-after-submit="reload">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Yes, delete</button>
        </form>
    </div>
</div>
