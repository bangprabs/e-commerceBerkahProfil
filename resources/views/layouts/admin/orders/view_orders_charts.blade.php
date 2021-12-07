@extends('layouts.admin_layouts.admin_layout')
@section('content')

<?php
    // echo "<pre>"; print_r($ordersCount); die;
    $months = array();
    $count = 0;
    while ($count <= 5) {
        $months[] = date('M Y', strtotime("-".$count."month"));
        $count++;
    }

    $dataPoints = array(
        array("y" => $ordersCount[5], "label" => $months[5]),
        array("y" => $ordersCount[4], "label" => $months[4]),
        array("y" => $ordersCount[3], "label" => $months[3]),
        array("y" => $ordersCount[2], "label" => $months[2]),
        array("y" => $ordersCount[1], "label" => $months[1]),
        array("y" => $ordersCount[0], "label" => $months[0])
    );
?>
<script>
    window.onload = function () {

    var chart = new CanvasJS.Chart("chartContainer", {
        theme: "light2",
        animationEnabled: true,
	    exportEnabled: true,
        title: {
            text: "Laporan Order Pelanggan"
        },
        axisY: {
            title: "Jumlah Order"
        },
        data: [{
            yValueFormatString: "#,##0.## Order",
            type: "column",
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
                            <div class="card-header bg-success">
                                <h5 style="margin-top: 10px">Grafik Order Pelanggan</h5>
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
