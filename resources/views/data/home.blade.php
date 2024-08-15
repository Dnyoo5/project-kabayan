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
                        <!-- Card -->
                        <h4 class="page-title">Card</h4>
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-primary card-round">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="flaticon-users"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Visitors</p>
                                                    <h4 class="card-title">1,294</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-info card-round">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="flaticon-interface-6"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Kategori</p>
                                                    <h4 class="card-title" id="kategori"></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-success card-round">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="flaticon-analytics"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Barang</p>
                                                    <h4 class="card-title" id="nama_barang"></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-secondary card-round">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="flaticon-success"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Total Barang</p>
                                                    <h4 class="card-title" id="jumlah"></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Data Barang Terbanyak</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <div id="container"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Jumlah Barang Berdasarkan Kategori</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <div id="chart-jumlah"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    @section('footer')
                        <script src="https://code.highcharts.com/highcharts.js"></script>
                        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

                        <script>
                            var data = @json($data);

                            // Check the data format
                            // Prepare data for Highcharts
                            var chartData = data.map(function(item) {
                                return {
                                    name: item.kategori,
                                    y: parseFloat(item.total)
                                };
                            });

                            console.log(chartData);



                            Highcharts.chart('chart-jumlah', {
                                chart: {
                                    type: 'pie'
                                },
                                title: {
                                    text: ''
                                },


                                plotOptions: {
                                    series: {
                                        allowPointSelect: true,
                                        cursor: 'pointer',
                                        dataLabels: [{
                                            enabled: true,
                                            distance: 20
                                        }, {
                                            enabled: true,
                                            distance: -40,
                                            format: '{point.percentage:.1f}%',
                                            style: {
                                                fontSize: '1.2em',
                                                textOutline: 'none',
                                                opacity: 0.7
                                            },
                                            filter: {
                                                operator: '>',
                                                property: 'percentage',
                                                value: 10
                                            }
                                        }]
                                    }
                                },
                                series: [{
                                    name: 'Jumlah',
                                    colorByPoint: true,
                                    data: chartData
                                }]
                            });

                            // 
                            $(document).ready(function() {
                                // Ambil data dari server
                                $.ajax({
                                    url: "{{ route('home.getTopBarang') }}",
                                    method: 'GET',
                                    success: function(data) {
                                        // Inisialisasi Highcharts
                                        console.log(data);
                                        Highcharts.chart('container', {
                                            chart: {
                                                type: 'column'
                                            },
                                            title: {
                                                align: 'left',
                                                text: ' '
                                            },

                                            xAxis: {
                                                type: 'category'
                                            },

                                            legend: {
                                                enabled: false
                                            },
                                            plotOptions: {
                                                series: {
                                                    borderWidth: 0,
                                                    dataLabels: {
                                                        enabled: true,

                                                    }
                                                }
                                            },


                                            series: [{
                                                name: 'Jumlah',
                                                colorByPoint: true,
                                                data: data
                                            }]
                                        });

                                    }
                                });
                            });

                            $(document).ready(function() {

                                $.ajax({
                                    url: "{{ route('home.statistik') }}", // URL rute yang mengarah ke metode getStatistik
                                    type: 'GET',
                                    success: function(data) {
                                        console.log(data);
                                        $('#nama_barang').text(data.nama_barang);
                                        $('#kategori').text(data.kategori);
                                        $('#jumlah').text(data.jumlah);
                                    },
                                    error: function(xhr) {
                                        console.error('Terjadi kesalahan:', xhr);
                                    }
                                });
                            });
                        </script>
                    @endsection
                @endsection
