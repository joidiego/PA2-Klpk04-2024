@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Dashboard') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->    
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">
                                {{ __('Anda berhasil Login, Semangat Kerja!!') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Grafik Penjualan </div>
                            <div class="card-body">
                                <div id="grafik"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script type="text/javascript">
                var pendapatan = @json($total_penjualan);
                var hari = @json($hari);

                Highcharts.chart('grafik', {
                    title: {
                        text: 'Grafik Pendapatan Bulan'
                    },
                    xAxis: {
                        categories: hari
                    },
                    yAxis: {
                        title: {
                            text: 'Nominal Pendapatan Bulanan'
                        }
                    },
                    plotOptions: {
                        series: {
                            allowPointSelect: true
                        }
                    },
                    series: [{
                        name: 'Nominal Pendapatan',
                        data: pendapatan
                    }]
                });
            </script>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
