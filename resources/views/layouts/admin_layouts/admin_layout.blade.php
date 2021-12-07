<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="shortcut icon" href="{{asset('front_assets/images/favicon.ico')}}" type="image/x-icon">
    <title>Berkah Profil - Admin Area</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/af-2.3.5/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/date-1.0.3/fc-3.3.2/fh-3.1.8/kt-2.6.1/r-2.2.7/rg-1.1.2/rr-1.2.7/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.3/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/vendors/select2.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/vendors/sweetalert2.css')}}">

    {{-- Sweet Alert --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">



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
  <body onload="startTime()">
    <div class="loader-wrapper">
      <div class="loader-index"><span></span></div>
      <svg>
        <defs></defs>
        <filter id="goo">
          <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
          <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
        </filter>
      </svg>
    </div>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    @if (isset($page_name) && $page_name!="printInvoice")
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      @include('layouts.admin_layouts.admin_header')

      @include('layouts.front.breadcrumb.breadcrumb')
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">

        @include('sweet::alert')
        <!-- Page Sidebar Start-->
        @include('layouts.admin_layouts.admin_sidebar')
        <!-- Page Sidebar Ends-->
        @yield('content')
        <!-- footer start-->
       @include('layouts.admin_layouts.admin_footer')
        <!-- footer end-->
      </div>

    </div>
    @endif

    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <div class="page-body-wrapper">
          @yield('print')
        </div>
    </div>

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
    <script src="{{url('https://canvasjs.com/assets/script/canvasjs.min.js')}}"></script>
      <!-- DataTables  & Plugins -->
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/af-2.3.5/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/date-1.0.3/fc-3.3.2/fh-3.1.8/kt-2.6.1/r-2.2.7/rg-1.1.2/rr-1.2.7/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.3/datatables.min.js"></script>
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

    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
          var fileName = $(this).val().split("\\").pop();
          $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

          //Initialize Select2 Elements
     $('.select2').select2()
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });

        CKEDITOR.replace('editor', {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
            enterMode = CKEDITOR.ENTER_BR;
            shiftEnterMode = CKEDITOR.ENTER_BR;
        })
    </script>

    <script>
        $(function () {
        $('#basic-1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            { extend: 'print', title: 'Data', exportOptions: { columns: ':visible' } },
            { extend: 'pdfHtml5', title: 'PDF', download: 'open', exportOptions: { columns: ':visible' } },
            { extend: 'copyHtml5', exportOptions: { columns: ':visible' } },
            { extend: 'csvHtml5', title: 'CSV', exportOptions: { columns: ':visible' } },
            { extend: 'excelHtml5', title: 'Excel', exportOptions: { columns: ':visible' } },
            { extend: 'colvis', text: 'Visibility Column' }
        ]
        });

        $('#blog').DataTable( {
        responsive: true,
        "processing": true,
        "serverSide": false,
        "scrollX": true,
        dom: 'Bfrtip',
        buttons: [
            { extend: 'print', title: 'Data', exportOptions: { columns: ':visible' } },
            { extend: 'pdfHtml5', title: 'PDF', download: 'open', exportOptions: { columns: ':visible' } },
            { extend: 'copyHtml5', exportOptions: { columns: ':visible' } },
            { extend: 'csvHtml5', title: 'CSV', exportOptions: { columns: ':visible' } },
            { extend: 'excelHtml5', title: 'Excel', exportOptions: { columns: ':visible' } },
            { extend: 'colvis', text: 'Visibility Column' }
        ]
        });

        $('#userlist').DataTable( {
        responsive: true,
        "processing": true,
        "serverSide": false,
        "scrollX": true,
        dom: 'Bfrtip',
        buttons: [
            { extend: 'print', title: 'Data', exportOptions: { columns: ':visible' } },
            { extend: 'pdfHtml5', title: 'PDF', download: 'open', exportOptions: { columns: ':visible' } },
            { extend: 'copyHtml5', exportOptions: { columns: ':visible' } },
            { extend: 'csvHtml5', title: 'CSV', exportOptions: { columns: ':visible' } },
            { extend: 'excelHtml5', title: 'Excel', exportOptions: { columns: ':visible' } },
            { extend: 'colvis', text: 'Visibility Column' }
        ]
        });
    });

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()
    </script>
  </body>
</html>
