<div class="modal-header">
    <h5 class="modal-title text-danger fw-bold">Attention!</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form method="POST" action="{{ $url }}">
    @csrf
    @method('DELETE')

    <div class="modal-body">
        <p>Are you sure you want to delete?</p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Delete</button>
    </div>
</form>
