@extends('layouts.admin_layouts.admin_layout')
@section('content')

<style>
    table {
      border-collapse: collapse;
      border-spacing: 0;
      width: 100%;
      border: 1px solid #ddd;
    }

    th, td {
      text-align: left;
      padding: 8px;
    }
    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
    tr:nth-child(even){background-color: #f2f2f2}
</style>
<!-- Zero Configuration  Starts-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="container">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h5 style="margin-top: 10px">List Shipping Charges</h5>
                            </div>

                            <div class="card-body">
                                <div class="table table-responsive table-scrollable w-100">
                                    <table style="width:100%" class="w-100 display nowrap table table-scrollable table-striped table-responsive table-bordered table-striped" id="blog">
                                        <thead>
                                            <tr>
                                                <th>No. </th>
                                                <th>Kota / Kabupaten</th>
                                                <th>0Kg - 1Kg</th>
                                                <th>1Kg - 10Kg</th>
                                                <th>10Kg - 20Kg</th>
                                                <th>20Kg - 30Kg</th>
                                                <th>30Kg - 40Kg</th>
                                                <th>40Kg - 50Kg</th>
                                                <th>50Kg - Lebih</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php $no = 1;?>
                                        @foreach ($shippingCharges as $city)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{$city['city']}}</td>
                                            <td>@currency($city['0-1000g'])</td>
                                            <td>@currency($city['1001-10000g'])</td>
                                            <td>@currency($city['10001-20000g'])</td>
                                            <td>@currency($city['20001-30000g'])</td>
                                            <td>@currency($city['30001-40000g'])</td>
                                            <td>@currency($city['40001-50000g'])</td>
                                            <td>@currency($city['above_50000g'])</td>
                                            <td class="align-middle">
                                                @if ($city['status'] == 1)
                                                <a class="updateShippingStatus btn btn-primary btn-block w-100" id="shipping-{{$city['id']}}"
                                                shipping_id="{{$city['id']}}" href="javascript:void(0)">Active</a>
                                                @else
                                                <a class="updateShippingStatus btn btn-danger btn-block w-100"
                                                    id="shipping-{{$city['id']}}" shipping_id="{{$city['id']}}"
                                                    href="javascript:void(0)">Inactive</a>
                                                @endif
                                            </td>
                                            <td style="width: 18%; text-align: center">
                                                <a title="Update Ongkos Kirim" href="{{ url('admin/edit-shipping-charges/'.$city['id'])}}" class="btn btn-success m-1"><i class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                        <?php $no++?>
                                        @endforeach
                                        <tfoot>
                                            <tr>
                                                <th>No. </th>
                                                <th>Kota / Kabupaten</th>
                                                <th>0Kg - 1Kg</th>
                                                <th>1Kg - 10Kg</th>
                                                <th>10Kg - 20Kg</th>
                                                <th>20Kg - 30Kg</th>
                                                <th>30Kg - 40Kg</th>
                                                <th>40Kg - 50Kg</th>
                                                <th>50Kg - Lebih</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
