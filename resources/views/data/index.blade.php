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
                    <div class="panel-header bg-primary-gradient">
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
                            <div class="mt-2">
                                <a href="" class="btn btn-danger tombol-tambah mt-1 ml-2" style="float: right;"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="mr-2 bi bi-plus-square-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0" />
                                    </svg><span id="Add-Kategori">Add Iventory</span></a>

                                <a href="{{ url('barang/export') }}"
                                    class="btn border  border-dark   btn-warning mb-5 mt-1 ml-2 " style="float: right">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="mr-2 bi bi-arrow-down-square-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5a.5.5 0 0 1 1 0" />
                                    </svg><span>Export Excel</span></a>
                            </div>

                            <div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <select name="kategori_barang" id="kategori_barang" class="form-control">
                                            <option value="" disabled selected>Pilih Kategori</option>
                                            <option value="Pakaian">Pakaian</option>
                                            <option value="Elektronik">Elektronik</option>
                                            <option value="Peralatan Rumah">Peralatan Rumah</option>

                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" id="min_jumlah" min="1" class="form-control"
                                            placeholder="Min Jumlah">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" id="max_jumlah" min="1" class="form-control"
                                            placeholder="Max Jumlah">
                                    </div>
                                    <div class="col-md-3">
                                        <button id="filter" class="btn btn-primary">Filter</button>
                                        <button id="reset" class="btn btn-secondary">Reset</button>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="col-md-1 text-center">No</th>
                                        <th class="col-md-4">Nama Barang</th>
                                        <th class="col-md-2">Kategori</th>
                                        <th class="col-md-1 text-center">Jumlah</th>
                                        <th class="col-md-2 text-center">Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </main>
                    @include('components.modal')
                </div>
            </div>
        </div>
    @endsection
