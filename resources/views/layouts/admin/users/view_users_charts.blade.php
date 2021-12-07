@extends('layouts.admin_layouts.admin_layout')
@section('content')

<?php
    $months = array();
    $count = 0;
    while ($count <= 3) {
        $months[] = date('M Y', strtotime("-".$count."month"));
        $count++;
    }

    $dataPoints = array(
        array("y" => $usersCount[3], "label" => $months[3]),
        array("y" => $usersCount[2], "label" => $months[2]),
        array("y" => $usersCount[1], "label" => $months[1]),
        array("y" => $usersCount[0], "label" => $months[0])
    );
?>
<script>
    window.onload = function () {

    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
	    exportEnabled: true,
        title: {
            text: "Pengguna Aplikasi E-commerce Berkah Profil"
        },
        axisY: {
            title: "Jumlah Pengguna"
        },
        data: [{
            type: "spline",
            yValueFormatString: "#,##0.## Pengguna",
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
                            <div class="card-header bg-primary">
                                <h5 style="margin-top: 10px">Grafik Pengguna Aplikasi</h5>
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
