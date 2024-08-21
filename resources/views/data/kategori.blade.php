@extends('components.aplikasi')
@section('konten')
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="blue">

                <a href="index.html" class="logo">
                    <img src="{{ asset('img/logo.svg') }}" alt="navbar brand" class="navbar-brand">
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>
            @include('components.navbar')
            @include('components.sidebar')
            <div class="main-panel">
                <div class="content">
                    <div class="page-inner">
                        <div class="page-header">
                            <h4 class="page-title">Kategori Table</h4>
                            <ul class="breadcrumbs">
                                <li class="nav-home">
                                    <a href="/home">
                                        <i class="flaticon-home"></i>
                                    </a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="/kategori">Kategori</a>
                                </li>

                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <form id="kategoriForm">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="kategori">Tambah Kategori</label>
                                                    <input type="text" class="form-control" style="width: 500px"
                                                        id="kategori" name="kategori" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-md ml-2">Tambah
                                                    Kategori</button>
                                                <br>
                                                <br>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="kategoriTable" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="col-md-1">No</th>
                                                        <th>Kategori</th>
                                                        <th style="width: 20%">Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.edit')

        @section('kategori')
            <script>
                $(document).ready(function() {
                    $('#kategoriTable').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: "{{ route('kategori.datatables') }}",
                            type: 'GET'
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
                                name: 'aksi',
                                orderable: false,
                                searchable: false
                            }
                        ]
                    });
                });
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $(document).ready(function() {
                    $('#kategoriForm').on('submit', function(e) {
                        e.preventDefault(); // Mencegah pengiriman form secara default

                        $.ajax({
                            url: "{{ route('kategori.store') }}", // Ganti dengan route yang benar jika perlu
                            method: 'POST',
                            data: $(this).serialize(),
                            success: function(response) {
                                if (response.success) {
                                    // Menambahkan opsi kategori baru ke dropdown
                                    $('#kategori').append(new Option(response.kategori.kategori,
                                        response.kategori.id));

                                    // Menampilkan SweetAlert2
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: response.message
                                    });

                                    // Kosongkan input form setelah submit
                                    $('#kategoriForm')[0].reset();

                                    // Reload DataTable jika diperlukan
                                    $('#kategoriTable').DataTable().ajax.reload();
                                }
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Terjadi kesalahan. Silakan coba lagi.'
                                });
                            }
                        });
                    });
                });

                // delete
                $(document).on('click', '.btn-delete-kategori', function() {
                    var id = $(this).data('id');
                    Swal.fire({
                        title: 'Anda yakin?',
                        text: "Kategori ini akan dihapus!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{ url('kategori') }}/' + id,
                                method: 'DELETE',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(data) {
                                    if (data.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Dihapus!',
                                            text: data.message
                                        }).then(() => {
                                            // Reload DataTable atau lakukan tindakan lain
                                            $('#kategoriTable').DataTable().ajax.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: data.error
                                        });
                                    }
                                },
                                error: function(xhr) {
                                    console.error('Terjadi kesalahan:', xhr);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Terjadi kesalahan server'
                                    });
                                }
                            });
                        }
                    });
                });
                // edit

                $(document).on('click', '.btn-edit-kategori', function() {
                    var id = $(this).data('id'); // Ambil ID dari tombol edit
                    $.get('{{ url('kategori') }}/' + id + '/edit', function(data) {
                        if (data.success) {
                            // Isi form modal dengan data yang diterima dari server
                            $('#editModalKategori #id').val(data.kategori.id);
                            $('#editModalKategori #nama_kategori').val(data.kategori.kategori);

                            // Tampilkan modal edit
                            $('#editModalKategori').modal('show');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: data.message
                            });
                        }
                    }).fail(function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal memuat data kategori.'
                        });
                    });
                });

                $('#editFormKategori').on('submit', function(e) {
                    e.preventDefault(); // Mencegah reload halaman

                    var id = $('#editModalKategori #id').val(); // Ambil ID dari form modal
                    var kategori = $('#editModalKategori #nama_kategori').val(); // Ambil nilai kategori dari input form

                    $.ajax({
                        url: '{{ url('kategori') }}/' + id, // URL untuk update data
                        type: 'PUT', // Metode HTTP PUT untuk update data
                        data: {
                            _token: '{{ csrf_token() }}', // Sertakan token CSRF
                            kategori: kategori // Data yang akan dikirim
                        },
                        success: function(response) {
                            if (response.success) {
                                // Jika sukses, sembunyikan modal dan reload DataTable
                                $('#editModalKategori').modal('hide');
                                $('#kategoriTable').DataTable().ajax.reload();

                                // Tampilkan SweetAlert2 notification
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: response.message
                                });
                            }
                        },
                        error: function(xhr) {
                            // Jika terjadi kesalahan, tampilkan error di konsol
                            console.log(xhr.responseText);
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan. Silakan coba lagi.'
                            });
                        }
                    });
                });
            </script>
        @endsection
    @endsection
