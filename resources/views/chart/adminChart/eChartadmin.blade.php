@extends('layouts.app')
@include('layouts.sidebaradmin')
@section('content')
<html>

<head>
  <script src="{{ asset('js/app.js') }}" defer></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {
      packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);
    google.charts.setOnLoadCallback(piechart);

    function drawChart() {
  var data1 = google.visualization.arrayToDataTable([
    ['Ket', 'Jumlah Anak'],
    <?php echo $chartData ?>
  ]);

  // Calculate total
  var total = 0;
  for (var i = 0; i < data1.getNumberOfRows(); i++) {
    total += data1.getValue(i, 1);
  }

  var options = {
    title: 'Lingkar Kepala',
    is3D: true,
    // Add data label for total
    pieSliceText: 'value',
    pieSliceTextStyle: {
      fontSize: 12,
      bold: true,
      color: 'white'
    },
    pieSliceBorderColor: 'white',
    pieSliceText: total.toFixed(2).toString()
  };

  var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
  chart.draw(data1, options);
}

  </script>
</head>

<body>
<h1 style="margin-left:750px">Data Anak Posyandu Kabupaten Bantul</h1>
<h1 style="margin-left:950px">Grafik Data Anak</h1>
  <div id="piechart_3d" style="width: 900px; height: 500px; margin-left:600px"></div>
  <button style="margin-left:616px" onClick="window.location.href='http://127.0.0.1:8000/achart';">
    Chart Berat Badan
  </button>
  <button style="margin-left:590px" onClick="window.location.href='http://127.0.0.1:8000/xchart';">
    Chart Tinggi Badan
  </button>
</body>

</html>