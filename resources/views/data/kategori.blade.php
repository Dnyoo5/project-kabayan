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
                    <div class="panel-header bg-info-gradient">
                        <div class="page-inner py-5">
                            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                                <div>
                                    <h2 class="text-white pb-2 fw-bold">Barang</h2>
                                    <h5 class="text-white op-7 mb-2">Free Bootstrap 4 Admin Dashboard</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <main class="container">
                        <div class="d-flex flex-column">
                            @include('components.exportAdd')
                            <table class="table table-striped" id="kategoriTable">
                                <thead>
                                    <tr>
                                        <th class="col-md-1 text-center">No</th>
                                        <th class="col-md-5">Kategori</th>
                                        <th class="col-md-2">Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </main>
                    @include('components.modal')
                </div>
            </div>
        @endsection
