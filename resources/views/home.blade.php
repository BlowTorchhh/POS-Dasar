@extends('main')
@section('tittle', 'Dashboard')

@section('head')
    <style>
        .tengah{
            display: flex;
            justify-content: center;
        }
    </style>
@endsection

@section('breadcrumbs')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboarddd</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<div class="content mt-3">

    <div class="animated fadeIn">
        <div class="tengah">
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-flat-color-3">
                <div class="card-body pb-0">
                    <h4 class="mb-0">
                        <span class="count">{{ $produk }}</span>
                    </h4>
                    @if (auth()->user()->level == "1")
                    <a class="text-light" href="/produk/produk">Data Produk </a>
                    @endif
                    @if (auth()->user()->level == "2")
                    <p class="text-light" >Data Produk </p>
                    @endif

                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart2"></canvas>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-flat-color-4">
                <div class="card-body pb-0">
                    <h4 class="mb-0">
                        <span class="count">{{ $barangmasuk }}</span>
                    </h4>
                    @if (auth()->user()->level == "1")
                    <a class="text-light" href="/Barang-masuk/Barang-masuk"> Data Barang masuk</a> 
                    @endif
                    @if (auth()->user()->level == "2")
                    <p class="text-light" > Data Barang masuk</p>
                    @endif
                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart2"></canvas>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-flat-color-5">
                <div class="card-body pb-0">
                    <h4 class="mb-0">
                        <span class="count">{{ $pengeluaran }}</span>
                    </h4>
                    @if (auth()->user()->level == "1")
                    <a class="text-light" href="/pengeluaran"> Pengeluaran</a>
                    @endif
                    @if (auth()->user()->level == "2")
                    <p class="text-light" > Pengeluaran</p>
                    @endif
                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart2"></canvas>
                    </div>

                </div>
            </div>
        </div>
        
    </div>
    </div>
    <div class="content" id="chartData">

    </div>
        
</div> <!-- .content -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    Highcharts.setOptions({
    colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: {
                cx: 0.5,
                cy: 0.3,
                r: 0.7
            },
            stops: [
                [0, color],
                [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    })
});

// Build the chart
Highcharts.chart('chartData', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Jumlah semua data'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                connectorColor: 'silver'
            }
        }
    },
    series: [{
        name: 'Data',
        data: [
            { name: 'Produk', y: {{ $produk }} ,color: 'orange'},
            { name: 'Barang Masuk', y: {{ $barangmasuk }}, color: '#FB475E'},
            { name: 'Pengeluaran', y: {{ $pengeluaran }}, color: '#6EBD6D'},
        ]
    }]
});
</script>
@endsection