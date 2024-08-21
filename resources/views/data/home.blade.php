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
                                    <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                                    <h5 class="text-white op-7 mb-2">Free Bootstrap 4 Admin Dashboard</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-inner mt--5">
                        <div class="row mt--2">
                            <div class="col-md-6">
                                <div class="card full-height">
                                    <div class="card-body">
                                        <div class="card-title">Statistik</div>

                                        <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                                            <div class="px-2 pb-2 pb-md-0 text-center">
                                                <div id="circles-1"></div>
                                                <h6 class="fw-bold mt-3 mb-0">Jumlah Barang</h6>
                                            </div>
                                            <div class="px-2 pb-2 pb-md-0 text-center">
                                                <div id="circles-2"></div>
                                                <h6 class="fw-bold mt-3 mb-0">Kategori</h6>
                                            </div>
                                            <div class="px-2 pb-2 pb-md-0 text-center">
                                                <div id="circles-3"></div>
                                                <h6 class="fw-bold mt-3 mb-0">Total Stok Barang</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card full-height">
                                    <div class="card-body">
                                        <div class="card-title">Jumlah Barang yang terbanyak & Tersedikit</div>
                                        <div class="row py-3">
                                            <div class="col-md-8">
                                                <div id="chart-container">
                                                    <canvas id="totalIncomeChart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-head-row">
                                            <div class="card-title">Statistics Kategori</div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div id="container"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <div class="card-title">Daily Sales</div>
                                        <div class="card-category">March 25 - April 02</div>
                                    </div>
                                    <div class="card-body pb-0">
                                        <div class="mb-4 mt-2">
                                            <h1>$4,578.58</h1>
                                        </div>
                                        <div class="pull-in">
                                            <canvas id="dailySalesChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body pb-0">
                                        <div class="h1 fw-bold float-right text-warning">+7%</div>
                                        <h2 class="mb-2">213</h2>
                                        <p class="text-muted">Transactions</p>
                                        <div class="pull-in sparkline-fix">
                                            <div id="lineChart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card-secondary">
                                    <div class="card-body skew-shadow mb-4">
                                        <h1 id="totalSupplier"></h1>
                                        <h5 class="op-8">Total Supplier Saat Ini </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-dark bg-secondary-gradient">
                                    <div class="card-body bubble-shadow">
                                        <h1>188</h1>
                                        <h5 class="op-8">Total Sales</h5>
                                        <div class="pull-right">
                                            <h3 class="fw-bold op-8">25%</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-dark bg-secondary2">
                                    <div class="card-body curves-shadow">
                                        <h1>12</h1>
                                        <h5 class="op-8">New Users</h5>
                                        <div class="pull-right">
                                            <h3 class="fw-bold op-8">70%</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        @section('home')
            <script>
                $.ajax({
                    url: "{{ route('home.getTopBarang') }}",
                    method: 'GET',
                    success: function(data) {
                        console.log(data); // Cek data yang diterima

                        // Ekstrak labels (nama barang) dan data (jumlah) dari response
                        var labels = data.map(function(item) {
                            return item.name;
                        });

                        var jumlahData = data.map(function(item) {
                            return item.y;
                        });

                        var totalIncomeChart = document.getElementById("totalIncomeChart").getContext("2d");

                        var mytotalIncomeChart = new Chart(totalIncomeChart, {
                            type: "bar",
                            data: {
                                labels: labels, // Mengisi labels dengan nama barang
                                datasets: [{
                                    label: "Total Barang",
                                    backgroundColor: "#ff9e27",
                                    borderColor: "rgb(23, 125, 255)",
                                    data: jumlahData, // Mengisi data dengan jumlah barang
                                }],
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                legend: {
                                    display: false,
                                },
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            display: false, // Menghilangkan label y-axis
                                        },
                                        gridLines: {
                                            drawBorder: false,
                                            display: false,
                                        },
                                    }],
                                    xAxes: [{
                                        gridLines: {
                                            drawBorder: false,
                                            display: false,
                                        },
                                    }],
                                },
                            },
                        });
                    }
                });


                $(document).ready(function() {

                    $.ajax({
                        url: "{{ route('home.statistik') }}", // URL rute yang mengarah ke metode getStatistik
                        type: 'GET',
                        success: function(data) {
                            console.log(data);
                            Circles.create({
                                id: "circles-1",
                                radius: 45,
                                value: data.nama_barang,
                                maxValue: 100,
                                width: 7,
                                text: data.nama_barang,
                                colors: ["#f1f1f1", "#FF9E27"],
                                duration: 400,
                                wrpClass: "circles-wrp",
                                textClass: "circles-text",
                                styleWrapper: true,
                                styleText: true,
                            });

                            Circles.create({
                                id: "circles-2",
                                radius: 45,
                                value: data.kategori,
                                maxValue: 100,
                                width: 7,
                                text: data.kategori,
                                colors: ["#f1f1f1", "#2BB930"],
                                duration: 400,
                                wrpClass: "circles-wrp",
                                textClass: "circles-text",
                                styleWrapper: true,
                                styleText: true,
                            });

                            Circles.create({
                                id: "circles-3",
                                radius: 45,
                                value: data.jumlah,
                                maxValue: 100,
                                width: 7,
                                text: data.jumlah,
                                colors: ["#f1f1f1", "#F25961"],
                                duration: 400,
                                wrpClass: "circles-wrp",
                                textClass: "circles-text",
                                styleWrapper: true,
                                styleText: true,
                            });
                        },
                        error: function(xhr) {
                            console.error('Terjadi kesalahan:', xhr);
                        }
                    });
                });



                $(document).ready(function() {

                    $.ajax({
                        url: '{{ route('home.supplier') }}',
                        method: 'GET',
                        success: function(response) {
                            $('#totalSupplier').text(response.totalSupplier);
                        },
                        error: function() {
                            $('#totalSupplier').text('Error loading data');
                        }
                    });
                });
            </script>
        @endsection
    @endsection
