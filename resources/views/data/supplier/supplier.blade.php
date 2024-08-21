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
            <!-- End Logo Header -->
            @include('components.navbar')
            <!-- Sidebar -->
            @include('components.sidebar')
            <div class="main-panel">
                <div class="content">
                    <div class="page-inner">
                        <div class="page-header">
                            <h4 class="page-title">Data Supplier</h4>
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
                                    <a href="/supplier">Data Supplier</a>
                                </li>

                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <a href="supplier/create">
                                            <button class="btn btn-secondary mb-4">
                                                <span class="btn-label">
                                                    <i class="fa fa-plus"></i>
                                                </span>
                                                Tambah Supllier
                                            </button>
                                        </a>
                                        <table id="suppliers-table" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nama Perusahaan</th>
                                                    <th>Kontak</th>
                                                    <th>Alamat</th>
                                                    <th>Email</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- DataTables akan mengisi data di sini melalui AJAX -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @section('supplier')
                @if (session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: '{{ session('success') }}',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>
                @endif
                <script>
                    $(document).ready(function() {
                        $('#suppliers-table').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: {
                                url: "{{ route('supplier.datatables') }}",
                                type: 'GET'
                            },
                            columns: [{
                                    data: 'DT_RowIndex',
                                    name: 'DT_RowIndex',
                                    orderable: false,
                                    searchable: false
                                },
                                {
                                    data: 'nama',
                                    name: 'nama'
                                },
                                {
                                    data: 'kontak',
                                    name: 'kontak'
                                },
                                {
                                    data: 'alamat',
                                    name: 'alamat'
                                },
                                {
                                    data: 'email',
                                    name: 'email'
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
                    $(document).on('click', '.btn-delete-supplier', function() {
                        var id = $(this).data('id');
                        Swal.fire({
                            title: 'Anda yakin?',
                            text: "Suppliers Ini Akan Dihapus",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, hapus!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '{{ url('supplier') }}/' + id,
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
                                                $('#suppliers-table').DataTable().ajax.reload();
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
                </script>
            @endsection
        @endsection
