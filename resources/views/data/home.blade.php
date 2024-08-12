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
                    <div id="chart-jumlah">

                    </div>

                </div>
            </div>
        @section('footer')
            <script src="https://code.highcharts.com/highcharts.js"></script>
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
                        text: 'Jumlah Barang Berdasarkan Kategori'
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
            </script>
        @endsection
    @endsection
