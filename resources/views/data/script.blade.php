<script src="//cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
<script>
    $('body').on('click', '.tombol-filters', function(e) {
        e.preventDefault();
        $('#filters').modal('show');
    });



    $(document).ready(function() {
        var table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('BarangAjax') }}",
                data: function(d) {
                    d.kategori = $('#kategori_barang').val();
                    d.min_jumlah = $('#min_jumlah').val();
                    d.max_jumlah = $('#max_jumlah').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama_barang',
                    name: 'nama_barang'
                },
                {
                    data: 'kategori',
                    name: 'kategori'
                },
                {
                    data: 'jumlah',
                    name: 'jumlah'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                }
            ]
        });

        $('#filter').click(function() {
            table.draw();
        });

        $('#reset').click(function() {
            $('#kategori_barang').val('');
            $('#min_jumlah').val('');
            $('#max_jumlah').val('');
            table.draw();
        });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('body').on('click', '.tombol-tambah', function(e) {
        e.preventDefault();
        $('#exampleModal').modal('show');
        $('.tombol-simpan').click(function() {
            simpan();
            $('#exampleModal').modal('hide');
        })
    });

    $('body').on('click', '.tombol-edit', function(e) {
        var id = $(this).data('id');
        $.ajax({
            url: 'BarangAjax/' + id + '/edit',
            type: 'GET',
            success: function(response) {
                $('#exampleModal').modal('show');
                $('#modalTitleEdit').text('Edit Data ' + response.result.nama_barang)
                $('#nama_barang').val(response.result.nama_barang);
                $('#jumlah').val(response.result.jumlah);
                $('#kategori').val(response.result.kategori);
                $('.tombol-simpan').click(function() {
                    simpan(id);
                    $('#exampleModal').modal('hide');
                });
            }
        });
    });

    $('body').on('click', '.tombol-delete', function(e) {
        if (confirm('yakin mau di hapus') == true) {
            var id = $(this).data('id');
            $.ajax({
                url: 'BarangAjax/' + id,
                type: 'DELETE',
            });
            $('#myTable').DataTable().ajax.reload();
        }
    });

    function simpan(id = ' ') {
        if (id == ' ') {
            var var_url = 'BarangAjax';
            var var_type = 'POST';
        } else {
            var var_url = 'BarangAjax/' + id;
            var var_type = 'PUT';
        }
        $.ajax({
            url: var_url,
            type: var_type,
            data: {
                nama_barang: $('#nama_barang').val(),
                kategori: $('#kategori').val(),
                jumlah: $('#jumlah').val(),
            },
            success: function(response) {
                if (response.errors) {
                    $('.alert-danger').removeClass('d-none');
                    $('.alert-danger').append("<ul>")
                    $.each(response.errors, function(key, value) {
                        $('.alert-danger').find('ul').append("<li>" + value + "</li>");
                    });
                    $('.alert-danger').append("</ul>");
                } else {
                    $('.alert-success').removeClass('d-none');
                    $('.alert-success').html(response.success);
                }
                $('#myTable').DataTable().ajax.reload();
            }
        })
    }


    $('#exampleModal').on('hidden.bs.modal', function() {
        $('#nama_barang').val('');
        $('#kategori').val('');
        $('#jumlah').val('');

        $('.alert-danger').addClass('d-none');
        $('.alert-danger').html('');

        $('.alert-success').addClass('d-none');
        $('.alert-success').html('');

    });
</script>
