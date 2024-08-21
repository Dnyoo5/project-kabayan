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
                            <h4 class="page-title">Edit Supplier</h4>
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
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <p>Edit Supplier</p>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" id="id" name="id">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Nama</label>
                                                    <input type="text" class="form-control" id="nama"
                                                        value="{{ $supplier->nama }}" name="nama">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Kontak</label>
                                                    <input type="number" value="{{ $supplier->kontak }}"
                                                        class="form-control" id="kontak" name="kontak">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputAddress">Alamat</label>
                                                <input type="text" class="form-control" id="alamat"
                                                    value="{{ $supplier->alamat }}" placeholder="Isi Alamat" name="alamat">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputAddress2">Email</label>
                                                <input type="email" class="form-control" id="email"
                                                    placeholder="Email" name="email" value="{{ $supplier->email }}">
                                                <button type="submit" class="btn btn-warning mt-4">Update</button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection
