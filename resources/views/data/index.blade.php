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

            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

                <div class="container-fluid">

                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">

                        <li class="nav-item dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
                                aria-expanded="false">
                                <div class="avatar-sm">
                                    <img src="{{ asset('img/profile.jpg') }}" alt="..."
                                        class="avatar-img rounded-circle">
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg"><img src="{{ asset('img/profile.jpg') }}"
                                                    alt="image profile" class="avatar-img rounded"></div>
                                            <div class="u-text">
                                                <h4>Hizrian</h4>
                                                <p class="text-muted">hello@example.com</p><a href="profile.html"
                                                    class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">My Profile</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Account Setting</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Logout</a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>

        <!-- Sidebar -->
        <div class="sidebar sidebar-style-2">
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="avatar-sm float-left mr-2">
                            <img src="{{ asset('img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                <span>
                                    Hizrian
                                    <span class="user-level">Administrator</span>
                                    <span class="caret"></span>
                                </span>
                            </a>
                            <div class="clearfix"></div>

                            <div class="collapse in" id="collapseExample">
                                <ul class="nav">
                                    <li>
                                        <a href="#profile">
                                            <span class="link-collapse">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#edit">
                                            <span class="link-collapse">Edit Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#settings">
                                            <span class="link-collapse">Settings</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-primary">
                        <li class="nav-item active">
                            <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="dashboard">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="../demo1/index.html">
                                            <span class="sub-item">Dashboard 1</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../demo2/index.html">
                                            <span class="sub-item">Dashboard 2</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

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
                                </svg><span>Add Iventory</span></a>

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
                                    <input type="number" id="min_jumlah" min="0" class="form-control"
                                        placeholder="Min Jumlah">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" id="max_jumlah" min="0" class="form-control"
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
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitleEdit">Tambah Data Barang</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="my-3 p-3 bg-body rounded shadow-sm">

                                    <div class="mb-3 row">
                                        <label for="nama" class="col-sm-2 col-form-label">Barang</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name='nama_barang'
                                                id="nama_barang" required placeholder="Nama Barang">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                                        <div class="col-sm-10">
                                            <select name="kategori" id="kategori" class="form-control">
                                                <option value="" disabled selected>Pilih Opsi</option>
                                                <option value="Peralatan Rumah">Peralatan Rumah</option>
                                                <option value="Elektronik">Elektronik</option>
                                                <option value="Pakaian">Pakaian</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="" class="col-sm-2 col-form-label">Jumlah</label>
                                        <div class="col-sm-10">
                                            <input type="number" min="0" class="form-control" id="jumlah"
                                                placeholder="Jumlah">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary tombol-simpan">Simpan</button>
                                <button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
