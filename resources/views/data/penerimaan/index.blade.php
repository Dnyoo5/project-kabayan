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
                                    <div class="card-body">
                                        <div class="container">
                                            <h1>Daftar Penerimaan Barang</h1>
                                            <table id="penerimaan-table" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Nomor Pengiriman</th>
                                                        <th>Barang Dikirim</th>
                                                        <th>Jumlah Dikirim</th>
                                                        <th>Total Harga</th>
                                                        <th>Pengirim</th>
                                                        <th>Penerima</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
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

        @section('penerimaan')
            <script>
                $(document).ready(function() {
                    $('#penerimaan-table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('penerimaan.datatables') }}",
                        columns: [{
                                data: 'id',
                                name: 'id'
                            },
                            {
                                data: 'nomor_pengiriman',
                                name: 'nomor_pengiriman'
                            },
                            {
                                data: 'barang_nama',
                                name: 'barang.nama'
                            },
                            {
                                data: 'jumlah',
                                name: 'jumlah'
                            },
                            {
                                data: 'total_harga',
                                name: 'total_harga'
                            },
                            {
                                data: 'pengirim',
                                name: 'pengirim'
                            },
                            {
                                data: 'penerima',
                                name: 'penerima'
                            },
                            {
                                data: 'status_label',
                                name: 'status_label',
                                orderable: false,
                                searchable: false
                            },
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            }
                        ]
                    });
                });
            </script>
        @endsection
    @endsection
