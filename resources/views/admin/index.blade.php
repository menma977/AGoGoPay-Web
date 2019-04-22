@extends('layouts.admin.master') 
@section('contentHeader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Halaman Utama</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">Halaman Utama</li>
            </ol>
        </div>
    </div>
</div>
@endsection
 
@section('content')
<div class="row">
    <div class="col-lg-4 col-4">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalUser }}</h3>

                <p>Total User</p>
            </div>
            <div class="icon">
                <i class="fa fa-address-book-o"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-4">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalUserToday }}</h3>

                <p>Total User hari ini</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-4">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $userX }}</h3>

                <p>Total Calon User</p>
            </div>
            <div class="icon">
                <i class="fa fa-user-plus"></i>
            </div>
        </div>
    </div>
</div>
<div class="card card-danger">
    <div class="card-header">
        <h3 class="card-title">Chart Invest Dan Penarikan</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.find') }}" method="POST">
            {{ csrf_field() }}
            <label>Find By Range:</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="text" class="form-control float-right" id="reservation" name="date" value="{{ old('date') ? old('date') : $date }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-block btn-success "><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </form>
        <div class="chart">
            <canvas id="areaChart" style="height:250px"></canvas>
        </div>
        <hr>
        <div class="row">
            <div class="col-6">
                <button class="btn btn-block btn-success ">Infes</button>
            </div>
            <div class="col-6">
                <button class="btn btn-block btn-danger ">Penarikan</button>
            </div>
        </div>
    </div>
</div>
@endsection
 
@section('afterScript')
<!-- ChartJS 1.0.1 -->
<script src="{{ asset('adminLTE/plugins/chartjs-old/Chart.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('adminLTE/plugins/fastclick/fastclick.js') }}"></script>
<script>
    $(function () {
        $('#reservation').daterangepicker({
            format : 'YYYY/MM/DD'
        })
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });

        var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
        var areaChart       = new Chart(areaChartCanvas)
        var date    = [];
        var data1   = [];
        var data2   = [];
        @foreach ($halfUser as $item)
            date.push('{{ $item["date"] }}');
        @endforeach
        @foreach ($halfUser as $item)
            data1.push('{{ $item["paket"] }}');
        @endforeach
        @foreach ($wdBon as $item)
            data2.push('{{ $item["nilaicoin"] }}');
        @endforeach
        var areaChartData = {
            labels  : date,
            datasets: [
                {
                    label                   : 'Infes',
                    fillColor               : '#28a745',
                    strokeColor             : '#28a745',
                    pointColor              : '#28a745',
                    pointStrokeColor        : '#28a745',
                    pointHighlightFill      : '#fff',
                    pointHighlightStroke    : '#28a745',
                    data                    : data1
                    // data                : [65, 59, 80, 81, 56, 55, 40]
                },
                {
                    label                   : 'Penarikan',
                    fillColor               : '#dc3545',
                    strokeColor             : '#dc3545',
                    pointColor              : '#dc3545',
                    pointStrokeColor        : '#dc3545',
                    pointHighlightFill      : '#fff',
                    pointHighlightStroke    : '#dc3545',
                    data                    : data2
                    // data                : [28, 48, 40, 19, 86, 27, 90]
                }
            ]
        }

        var areaChartOptions = {
            //Boolean - If we should show the scale at all
            showScale               : true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines      : true,
            //String - Colour of the grid lines
            scaleGridLineColor      : 'rgba(0,0,0,.05)',
            //Number - Width of the grid lines
            scaleGridLineWidth      : 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines  : true,
            //Boolean - Whether the line is curved between points
            bezierCurve             : true,
            //Number - Tension of the bezier curve between points
            bezierCurveTension      : 0.3,
            //Boolean - Whether to show a dot for each point
            pointDot                : true,
            //Number - Radius of each point dot in pixels
            pointDotRadius          : 4,
            //Number - Pixel width of point dot stroke
            pointDotStrokeWidth     : 1,
            //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius : 20,
            //Boolean - Whether to show a stroke for datasets
            datasetStroke           : true,
            //Number - Pixel width of dataset stroke
            datasetStrokeWidth      : 2,
            //Boolean - Whether to fill the dataset with a color
            datasetFill             : false,
            //String - A legend template
            legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
            //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio     : true,
            //Boolean - whether to make the chart responsive to window resizing
            responsive              : true
        }

        //Create the line chart
        areaChart.Line(areaChartData, areaChartOptions);
  })

</script>
@endsection