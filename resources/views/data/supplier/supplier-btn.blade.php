<td>
    <div class="form-button-action">
        <a href="{{ route('supplier.edit', $row->id) }}"><button type="button" data-toggle="tooltip"
                data-id="{{ $row->id }}" title="edit" class="btn btn-link btn-primary btn-lg "
                data-original-title="Edit Task">
                <i class="fa fa-edit"></i>
            </button></a>
        <button type="button" data-toggle="tooltip" data-id="{{ $row->id }}"
            class="btn btn-link btn-danger btn-delete-supplier" data-original-title="Remove">
            <i class="fa fa-times"></i> </button>
    </div>
</td>
