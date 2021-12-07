<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="shortcut icon" href="{{asset('front_assets/images/favicon.ico')}}" type="image/x-icon">
    <title>Berkah Profil - Admin Area</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/font-awesome.css')}}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/vendors/icofont.css')}}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/vendors/themify.css')}}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/vendors/flag-icon.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/vendors/feather-icon.css')}}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/vendors/scrollbar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/vendors/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/vendors/chartist.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/vendors/date-picker.css')}}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/vendors/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('admin_assets/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/responsive.css')}}">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/af-2.3.5/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/date-1.0.3/fc-3.3.2/fh-3.1.8/kt-2.6.1/r-2.2.7/rg-1.1.2/rr-1.2.7/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.3/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/vendors/select2.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/vendors/sweetalert2.css')}}">

    {{-- Sweet Alert --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">



    <style>
        .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content>li .mega-menu-container .mega-box .link-section .submenu-content.opensubmegamenu li a:after {
            display: none;
        }

        .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content>li .mega-menu-container .mega-box .link-section .submenu-content.opensubmegamenu li a.actives {
            color: var(--theme-deafult);
        }

        .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content>li .mega-menu-container .mega-box .link-section .submenu-content ul li a {
            line-height: 1.9;
        }

        .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content>li .mega-menu-container .mega-box .link-section .submenu-content ul li a:hover {
            margin-left: 0;
        }

        .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content>li .sidebar-link {
            border-radius: 10px;
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
            display: block;
        }

        .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content>li .sidebar-link.actives {
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
            position: relative;
            margin-bottom: 10px;
            background-color: #dad6ff;
        }

        .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content>li .sidebar-link.actives .according-menu i {
            color: var(--theme-deafult);
        }

        .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content>li .sidebar-link.actives svg {
            color: var(--theme-deafult);
            -webkit-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }

        .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content>li .sidebar-link.actives span {
            color: var(--theme-deafult);
            -webkit-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }

        .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content>li .sidebar-submenu li a.actives {
            color: var(--theme-deafult);
        }

        .blocks {
            display: block !important;
            /* Hide */
        }

        .nones {
            display: none !important;
            /* Hide */
        }

    </style>
</head>


<style>
    @media print {
        body * {
            visibility: hidden;
        }

        .invo,
        .invo * {
            visibility: visible;
            margin: 0px !important;
            max-width: 100%;
        }

        .head {
            padding-bottom: 5mm;
            border-bottom: 1cm;
        }

        .heads {
            padding-top: 5mm;
            padding-bottom: 5mm;

        }

        .foots {
            padding-top: 5mm;
        }

        hr {
            height: 10cm;
        }
    }

</style>

<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <div class="page-body-wrapper">
        <!-- Zero Configuration  Starts-->
        <div class="page-body invo m-0">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-6">
                            <h3>Invoice</h3>
                            <button class="btn btn btn-primary me-2" type="button"
                                onclick="window.print();">Print</button>
                        </div>
                        <div class="col-6">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">ECommerce</li>
                                <li class="breadcrumb-item active">Invoice</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="invoice" id="invoice">
                                    <div>
                                        <div class="head">
                                            <div class="row">
                                                <div class="col-sm-6" style="align-self: center;">
                                                    <div class="media">
                                                        <div class="media-body m-l-20 text-right align-middle">
                                                            <h4 class="media-heading">
                                                                <img class="img-fluid" style="width: 32%;"
                                                                    src="{{url('/admin_assets/images/logo/logo.png')}}"
                                                                    alt="">
                                                            </h4>
                                                            <p>berkahprofil@gmail.com<br><span>0821-1098-4618</span></p>
                                                        </div>
                                                    </div>
                                                    <!-- End Info-->
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="text-md-end text-xs-center">
                                                        <h3>Invoice #<span
                                                                class="counter">{{$orderDetails['id']}}</span></h3>
                                                        <span class="pull-right">@php
                                                            echo '<img
                                                                src="data:image/png;base64,' . DNS1D::getBarcodePNG($orderDetails['id'], 'C39+', true) . '"
                                                                alt="barcode" />';
                                                            @endphp</span><br>
                                                        <br>
                                                        <p>Issued:
                                                            {{ date('j F, Y', strtotime($orderDetails['created_at'])) }}</span><br>
                                                            <strong>Metode Pembayaran</strong>:
                                                            {{$orderDetails['payment_method']}} </p>
                                                    </div>
                                                    <!-- End Title-->
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <!-- End InvoiceTop-->
                                        <div class="heads">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="media">
                                                        <div class="media-body m-l-20">
                                                            <h4 class="media-heading">{{$userDetail['name']}}</h4>
                                                            <p>{{$userDetail['email']}}<br><span>{{$userDetail['mobile']}}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="text-md-end" id="project">
                                                        <h6>Alamat Pengiriman</h6>
                                                        <p>{{$orderDetails['address']}}, {{$orderDetails['city']}},
                                                            {{$orderDetails['state']}}, {{$orderDetails['country']}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Invoice Mid-->
                                        <div>
                                            <div class="table-responsive invoice-table" id="table">
                                                <table class="table table-bordered table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <td class="item">
                                                                <h6 class="p-2 mb-0">Detail Item</h6>
                                                            </td>
                                                            <td class="Hours">
                                                                <h6 class="p-2 mb-0">Harga</h6>
                                                            </td>
                                                            <td class="Rate">
                                                                <h6 class="p-2 mb-0">Jumlah Produk</h6>
                                                            </td>
                                                            <td class="subtotal">
                                                                <h6 class="p-2 mb-0">Total Harga</h6>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            @php
                                                            $subTotal = 0;
                                                            @endphp
                                                            @foreach ($orderDetails['orders_products'] as $product)
                                                            <td>
                                                                <p class="m-0">
                                                                    Nama : {{ $product['product_name'] }}<br>
                                                                    Kode : {{ $product['product_code'] }}<br>
                                                                    Ukuran : {{ $product['product_size'] }}<br>
                                                                    Warna : {{ $product['product_color'] }}<br>
                                                                    @php
                                                                    echo '<img
                                                                        src="data:image/png;base64,' . DNS1D::getBarcodePNG($product['product_code'], 'C39+', true) . '"
                                                                        alt="barcode" />';
                                                                    @endphp
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p class="itemtext">@currency($product['product_price'])
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p class="itemtext">{{ $product['product_qty'] }}</p>
                                                            </td>
                                                            <td>
                                                                <p class="itemtext">@currency($product['product_price']
                                                                    * $product['product_qty'])</p>
                                                            </td>
                                                            @endforeach
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="Rate">
                                                                <h6 class="mb-0 p-2">Sub Total</h6>
                                                            </td>
                                                            <td class="payment">
                                                                <h6 class="mb-0 p-2">@currency($product['product_price']
                                                                    * $product['product_qty'])</h6>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            @if ($orderDetails['coupon_amount'] > 0)
                                                            <td></td>
                                                            <td></td>
                                                            <td class="Rate">
                                                                <h6 class="mb-0 p-2">Diskon</h6>
                                                            </td>
                                                            <td class="payment">
                                                                <h6 class="mb-0 p-2">
                                                                    @currency($orderDetails['coupon_amount'])</h6>
                                                            </td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="Rate">
                                                                <h6 class="mb-0 p-2">Biaya Pengiriman</h6>
                                                            </td>
                                                            <td class="payment">
                                                                <h6 class="mb-0 p-2">@currency($orderDetails['shipping_charges'])</h6>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="Rate">
                                                                <h6 class="mb-0 p-2">Total Keseluruhan</h6>
                                                            </td>
                                                            <td class="payment">
                                                                <h6 class="mb-0 p-2">
                                                                    @currency($orderDetails['grand_total'])</h6>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- End Table-->
                                            <div class="foots row">
                                                <div class="col-md-8">
                                                    <div>
                                                        <p class="legal"><strong>Terima kasih telah berbelanja dengan Kami !</strong>
                                                            Pembayaran tidak boleh lebih dari 1 bulan. Harap lakukan pembayaran dengan segera, Terima Kasih.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <form class="text-end">
                                                        <input type="image"
                                                            src="{{url('front_assets/images/icons/payment.png')}}"
                                                            name="submit"
                                                            alt="PayPal - The safer, easier way to pay online!">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End InvoiceBot-->
                                    </div>
                                    <!-- End Invoice-->
                                    <!-- End Invoice Holder-->
                                    <!-- Container-fluid Ends-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function printInfo(ele) {
        var openWindow = window.open("#invoice", "title", "attributes");
        openWindow.document.write(ele.previousSibling.innerHTML);
        openWindow.document.close();
        openWindow.focus();
        openWindow.print();
        openWindow.close();
    }

</script>

<!-- latest jquery-->
<script src="{{url('/admin_assets/js/jquery-3.5.1.min.js')}}"></script>
<!-- Bootstrap js-->
<script src="{{url('/admin_assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
<!-- feather icon js-->
<script src="{{url('/admin_assets/js/icons/feather-icon/feather.min.js')}}"></script>
<script src="{{url('/admin_assets/js/icons/feather-icon/feather-icon.js')}}"></script>
<!-- scrollbar js-->
<script src="{{url('/admin_assets/js/scrollbar/simplebar.js')}}"></script>
<script src="{{url('/admin_assets/js/scrollbar/custom.js')}}"></script>
<!-- Sidebar jquery-->
<script src="{{url('/admin_assets/js/config.js')}}"></script>
<!-- Plugins JS start-->
<script src="{{url('/admin_assets/js/sidebar-menu.js')}}"></script>
<script src="{{url('/admin_assets/js/chart/chartist/chartist.js')}}"></script>
<script src="{{url('/admin_assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
<script src="{{url('/admin_assets/js/chart/knob/knob.min.js')}}"></script>
<script src="{{url('/admin_assets/js/chart/knob/knob-chart.js')}}"></script>
<script src="{{url('/admin_assets/js/chart/apex-chart/apex-chart.js')}}"></script>
<script src="{{url('/admin_assets/js/chart/apex-chart/stock-prices.js')}}"></script>
<script src="{{url('/admin_assets/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="{{url('/admin_assets/js/dashboard/default.js')}}"></script>
<script src="{{url('/admin_assets/js/notify/index.js')}}"></script>
<script src="{{url('/admin_assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{url('/admin_assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{url('/admin_assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
<script src="{{url('/admin_assets/js/typeahead/handlebars.js')}}"></script>
<script src="{{url('/admin_assets/js/typeahead/typeahead.bundle.js')}}"></script>
<script src="{{url('/admin_assets/js/typeahead/typeahead.custom.js')}}"></script>
<script src="{{url('/admin_assets/js/typeahead-search/handlebars.js')}}"></script>
<script src="{{url('/admin_assets/js/typeahead-search/typeahead-custom.js')}}"></script>
<!-- DataTables  & Plugins -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript"
    src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/af-2.3.5/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/date-1.0.3/fc-3.3.2/fh-3.1.8/kt-2.6.1/r-2.2.7/rg-1.1.2/rr-1.2.7/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.3/datatables.min.js">
</script>
<script src="{{url('/js/admin_script.js')}}"></script>
<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{url('/admin_assets/js/script.js')}}"></script>

<script src="{{url('admin_assets/js/editor/ckeditor/ckeditor.js')}}"></script>
<script src="{{url('admin_assets/js/editor/ckeditor/adapters/jquery.js')}}"></script>
<script src="{{url('https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js')}}"></script>

{{-- <script src="{{url('admin_assets/js/editor/ckeditor/ckeditor.js')}}"></script>
<script src="{{url('admin_assets/js/editor/ckeditor/adapters/jquery.js')}}"></script>
<script src="{{url('admin_assets/js/editor/ckeditor/styles.js')}}"></script>
<script src="{{url('admin_assets/js/editor/ckeditor/ckeditor.custom.js')}}"></script> --}}

<script src="{{url('admin_assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{url('admin_assets/js/select2/select2-custom.js')}}"></script>

<script src="{{url('admin_assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{url('admin_assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{url('admin_assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
<script src="{{ url('admin_assets/inputmask/jquery.inputmask.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="{{ url('admin_assets/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
