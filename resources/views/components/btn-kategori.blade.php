{{-- <div style="margin: auto">
    <button class="btn btn-warning btn-sm btn-edit-kategori">Edit</button>
    <button class="btn btn-danger btn-sm btn-delete-kategori" data-id="{{ $data->id }}">Delete</button>
</div> --}}

<td>
    <div class="form-button-action">
        <button type="button" data-toggle="tooltip" data-id="{{ $data->id }}" title="edit"
            class="btn btn-link btn-primary btn-lg btn-edit-kategori" data-original-title="Edit Task">
            <i class="fa fa-edit"></i>
        </button>
        <button type="button" data-toggle="tooltip" data-id="{{ $data->id }}"
            class="btn btn-link btn-danger btn-delete-kategori" data-original-title="Remove">
            <i class="fa fa-times"></i>
        </button>
    </div>
</td>
