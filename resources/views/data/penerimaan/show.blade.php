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
                                            <h1>Terima Barang</h1>
                                            <form action="{{ route('penerimaan.receive', $pengiriman->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('POST')

                                                <div class="form-group">
                                                    <label for="penerima">Nama Penerima</label>
                                                    <input type="text" class="form-control" id="penerima"
                                                        name="penerima" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="total_harga">Total Harga</label>
                                                    <input type="text" class="form-control" id="total_harga"
                                                        name="total_harga" value="{{ $pengiriman->total_harga }}" readonly>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Konfirmasi Terima
                                                    Barang</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
