@extends('layouts.admin_layouts.admin_layout')
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>
                        Edit Shipping Charges</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"> <i data-feather="user"></i></a></li>
                        <li class="breadcrumb-item">Catalogue</li>
                        <li class="breadcrumb-item active">Shipping Charges </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        @if (Session::has('error_message'))
                        <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
                            {{ Session::get('error_message')}}
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (Session::has('success_message'))
                        <div class="alert alert-success dark alert-dismissible fade show" style="margin: 15px;"
                            role="alert">
                            {{ Session::get('success_message')}}
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php Session::forget('success_message')  ?>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
                            @foreach ($errors->all() as $error)
                            {{ $error }} <br>
                            @endforeach
                        </div>
                        @endif
                        <div class="form theme-form">
                            <form
                                action="{{ url('admin/edit-shipping-charges/'.$shippingDetails['id'])}}"
                            enctype="multipart/form-data" name="blogForm" id="blogForm" method="post">@csrf
                            @csrf
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label style="font-weight:bold;" for="city">Kota Pengiriman</label>
                                            <input class="form-control" value="{{ $shippingDetails['city'] }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label style="font-weight:bold;" for="0-1000g">Biaya Pengiriman (Berat 0Kg - 1Kg)</label>
                                            <input class="form-control" id="0-1000g" name="0-1000g"
                                                placeholder="Enter Cost" @if(!empty($shippingDetails['0-1000g'])) {
                                                value="{{ $shippingDetails['0-1000g'] }}" } @else {
                                                value="{{ old('0-1000g') }}" } @endif>
                                        </div>
                                        <div class="mb-3">
                                            <label style="font-weight:bold;" for="1001-10000g">Biaya Pengiriman (Berat 1Kg - 10Kg)</label>
                                            <input class="form-control" id="1001-10000g" name="1001-10000g"
                                                placeholder="Enter Cost" @if(!empty($shippingDetails['1001-10000g'])) {
                                                value="{{ $shippingDetails['1001-10000g'] }}" } @else {
                                                value="{{ old('0-1000g') }}" } @endif>
                                        </div>
                                        <div class="mb-3">
                                            <label style="font-weight:bold;" for="10001-20000g">Biaya Pengiriman (Berat 10Kg - 20Kg)</label>
                                            <input class="form-control" id="10001-20000g" name="10001-20000g"
                                                placeholder="Enter Cost" @if(!empty($shippingDetails['10001-20000g'])) {
                                                value="{{ $shippingDetails['10001-20000g'] }}" } @else {
                                                value="{{ old('10001-20000g') }}" } @endif>
                                        </div>
                                        <div class="mb-3">
                                            <label style="font-weight:bold;" for="20001-30000g">Biaya Pengiriman (Berat 20Kg - 30Kg)</label>
                                            <input class="form-control" id="20001-30000g" name="20001-30000g"
                                                placeholder="Enter Cost" @if(!empty($shippingDetails['20001-30000g'])) {
                                                value="{{ $shippingDetails['20001-30000g'] }}" } @else {
                                                value="{{ old('20001-30000g') }}" } @endif>
                                        </div>
                                        <div class="mb-3">
                                            <label style="font-weight:bold;" for="30001-40000g">Biaya Pengiriman (Berat 30Kg - 40Kg)</label>
                                            <input class="form-control" id="30001-40000g" name="30001-40000g"
                                                placeholder="Enter Cost" @if(!empty($shippingDetails['30001-40000g'])) {
                                                value="{{ $shippingDetails['30001-40000g'] }}" } @else {
                                                value="{{ old('30001-40000g') }}" } @endif>
                                        </div>
                                        <div class="mb-3">
                                            <label style="font-weight:bold;" for="40001-50000g">Biaya Pengiriman (Berat 40Kg - 50Kg)</label>
                                            <input class="form-control" id="40001-50000g" name="40001-50000g"
                                                placeholder="Enter Cost" @if(!empty($shippingDetails['40001-50000g'])) {
                                                value="{{ $shippingDetails['40001-50000g'] }}" } @else {
                                                value="{{ old('40001-50000g') }}" } @endif>
                                        </div>
                                        <div class="mb-3">
                                            <label style="font-weight:bold;" for="above_50000g">Biaya Pengiriman (Berat Diatas 50 Kg)</label>
                                            <input class="form-control" id="above_50000g" name="above_50000g"
                                                placeholder="Enter Cost" @if(!empty($shippingDetails['above_50000g'])) {
                                                value="{{ $shippingDetails['above_50000g'] }}" } @else {
                                                value="{{ old('above_50000g') }}" } @endif>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="text-end"><button type="submit"
                                                class="btn btn-success">Edit Shipping Charges</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
