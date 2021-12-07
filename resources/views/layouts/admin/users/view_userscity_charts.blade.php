@extends('layouts.admin_layouts.admin_layout')
@section('content')

<?php

    foreach ($getUserCity as $key => $value) {
        $dataPoints[$key]['label'] = $getUserCity[$key]['city'];
        $dataPoints[$key]['y'] = $getUserCity[$key]['count'];
    }

?>
<script>
    window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        exportEnabled: true,
        title:{
            text: "Pengguna Berdasarkan Kota"
        },
        subtitles: [{
            text: "Jumlah Pengguna"
        }],
        data: [{
            type: "pie",
            showInLegend: "true",
            legendText: "{label}",
            indexLabelFontSize: 16,
            indexLabel: "{label} - #percent%",
            yValueFormatString: "#,##0 Pengguna",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

    }
</script>

<!-- Zero Configuration  Starts-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="container">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header bg-danger">
                                <h5 style="margin-top: 10px">Grafik Pengguna Berdasarkan Kota</h5>
                            </div>

                            <div class="card-body">
                                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
