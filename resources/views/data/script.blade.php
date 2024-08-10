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
                    console.log('Kategori:', d.kategori);
                    console.log('Min Jumlah:', d.min_jumlah);
                    console.log('Max Jumlah:', d.max_jumlah);
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

    $(document).ready(function() {
        $('#kategoriTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('KategoriBarang') }}",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'kategori',
                    name: 'kategori'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                }
            ]
        });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var scrollPost;
    $('body').on('click', '.tombol-tambah', function(e) {
        e.preventDefault();
        scrollPost = $(window).scrollTop();
        // Reset form dan modal sebelum digunakan untuk "add"
        $('#modalTitleEdit').text('Tambah Data Barang');
        $('#nama_barang').val(''); // Kosongkan input field
        $('#kategori').val('');
        $('#jumlah').val('');

        // Pastikan event listener sebelumnya dihapus dan tambahkan event listener baru
        $('.tombol-simpan').off('click').on('click', function() {
            simpan(); // Panggil fungsi simpan tanpa ID untuk menambah data baru
            $('#exampleModal').modal('hide');
        });

        $('#exampleModal').modal('show'); // Tampilkan modal
        $('#exampleModal').on('shown.bs.modal', function() {
            $(window).scrollTop(scrollPost);
        });
    });

    $('body').on('click', '.tombol-edit', function(e) {
        var id = $(this).data('id');
        // Ambil data dari server untuk diisi ke dalam modal
        var scrollPos = $(window).scrollTop();

        $.ajax({
            url: 'BarangAjax/' + id + '/edit',
            type: 'GET',
            success: function(response) {
                $('#exampleModal').modal('show');
                $('#modalTitleEdit').text('Edit Data ' + response.result.nama_barang);
                $('#nama_barang').val(response.result.nama_barang);
                $('#jumlah').val(response.result.jumlah);
                $('#kategori').val(response.result.kategori);
                $('.tombol-simpan').off('click').on('click', function() {
                    simpan(
                        id); // Panggil fungsi simpan dengan ID untuk mengedit data
                    $('#exampleModal').modal('hide');
                });
                $('#exampleModal').on('shown.bs.modal', function() {
                    $(window).scrollTop(scrollPos);
                });
            }
        });
    });


    $(document).ready(function() {
        // Memanggil data statistik
        $.ajax({
            url: "{{ route('statistik') }}",
            method: 'GET',
            success: function(data) {
                $('#circles-barang').text(data.nama_barang);
                $('#circles-kategori').text(data.kategori);
                $('#circles-jumlah').text(data.jumlah);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });



    $('body').on('click', '.tombol-show', function(e) {
        e.preventDefault();
        var id = $(this).data('id');

        $.ajax({
            url: 'BarangAjax/' + id,
            type: 'GET',
            success: function(response) {
                // Tampilkan detail data dalam modal atau area lain
                $('#showModal').modal('show');
                $('#showModal .modal-body').html(`
                    <p><strong>Nama Barang:</strong> ${response.result.nama_barang}</p>
                    <p><strong>Kategori:</strong> ${response.result.kategori}</p>
                    <p><strong>Jumlah:</strong> ${response.result.jumlah}</p>`);
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat mengambil data.',
                });
            }
        });
    });


    $('body').on('click', '.tombol-delete', function(e) {
        var id = $(this).data('id');
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Mengirim permintaan Ajax untuk menghapus data
                $.ajax({
                    url: 'BarangAjax/' + id,
                    type: 'DELETE', // Metode pengiriman data
                    success: function(response) {
                        // Tampilkan pesan sukses setelah berhasil dihapus
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                        $('#myTable').DataTable().ajax.reload();

                    },
                    error: function(xhr, status, error) {
                        // Tampilkan pesan error jika terjadi kesalahan
                        Swal.fire({
                            title: "Error!",
                            text: "There was an issue deleting the file.",
                            icon: "error"
                        });
                    }
                });
            }
        });
    });

    function simpan(id = '') {
        if (id === '') {
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
                    $.each(response.errors, function(key, value) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: value,
                        })

                    });
                } else {
                    if (response.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Data Berhasil Masuk",
                            text: "Data Telah Di Tambahkan",
                        });
                    } else if (response.berhasil) {
                        Swal.fire({
                            icon: "success",
                            title: "Data Berhasil di edit",
                            text: "Data Diedit",
                        })

                    }
                }

                $('#myTable').DataTable().ajax.reload();
            }
        });
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
