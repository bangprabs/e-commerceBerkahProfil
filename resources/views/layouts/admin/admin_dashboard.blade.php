@extends('layouts.admin_layouts.admin_layout')
@section('content')
<div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-6">
            <h3>Admin Dashboard</h3>
          </div>
          <div class="col-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">                                       <i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Dashboard</li>
              <li class="breadcrumb-item active">Admin Dashboard      </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->

    @if (Session::has('error_message'))
    <div class="mt-3 alert alert-danger dark alert-dismissible fade show" role="alert">
        {{ Session::get('error_message')}}
        <button class="btn-close" type="button" data-bs-dismiss="alert"
            aria-label="Close"></button>
    </div>
    @endif

    <div class="container-fluid">
      <div class="row second-chart-list third-news-update">
        <div class="col-xl-4 col-lg-12 xl-50 morning-sec box-col-12">
          <div class="card o-hidden profile-greeting">
            <div class="card-body">
              <div class="media">
                <div class="badge-groups w-100">
                  <div class="badge f-12"><i class="me-1" data-feather="clock"></i><span id="txt"></span></div>
                  <div class="badge f-12"><i class="fa fa-spin fa-cog f-14"></i></div>
                </div>
              </div>
              <div class="greeting-user text-center">
                <div class="profile-vector"><img class="img-fluid" style="width:26%; border-top-left-radius: 20%; border-bottom-left-radius: 20%; border-top-right-radius: 20%;" src="{{url('images/admin_images/admin_photos/'.Auth::guard('admin')->user()->image)}}" alt=""></div>
                <h4 class="f-w-400"><span id="greeting">Good Morning</span> <span class="right-circle"><i class="fa fa-check-circle f-14 middle"></i></span></h4>
                <h4 style="margin-top: -10px" class="f-w-600"><span id="greeting">{{ ucwords(Auth::guard('admin')->user()->name) }}</span> </h4>
                <p><span> Today's earrning is $405 & your sales increase rate is 3.7 over the last 24 hours</span></p>
                <div class="left-icon"><i class="fa fa-bell"> </i></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-12 xl-50 calendar-sec box-col-6">
            <div class="card gradient-primary o-hidden">
              <div class="card-body">
                <div class="setting-dot">
                  <div class="setting-bg-primary date-picker-setting position-set pull-right"><i class="fa fa-spin fa-cog"></i></div>
                </div>
                <div class="default-datepicker">
                  <div class="datepicker-here" data-language="en"></div>
                </div><span class="default-dots-stay overview-dots full-width-dots"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small">                </span></span></span>
              </div>
            </div>
          </div>
        <div class="col-xl-9 xl-100 chart_data_left box-col-12">
          <div class="card">
            <div class="card-body p-0">
              <div class="row m-0 chart-main">
                <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                  <div class="media align-items-center">
                    <div class="hospital-small-chart">
                      <div class="small-bar">
                        <div class="small-chart flot-chart-container"></div>
                      </div>
                    </div>
                    <div class="media-body">
                      <div class="right-chart-content">
                        <h4>{{Auth::guard('admin')->user()->count()}}</h4><span>Pengguna Web </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                  <div class="media align-items-center">
                    <div class="hospital-small-chart">
                      <div class="small-bar">
                        <div class="small-chart1 flot-chart-container"></div>
                      </div>
                    </div>
                    <div class="media-body">
                      <div class="right-chart-content">
                        <h4>1005</h4><span>Sales</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                  <div class="media align-items-center">
                    <div class="hospital-small-chart">
                      <div class="small-bar">
                        <div class="small-chart2 flot-chart-container"></div>
                      </div>
                    </div>
                    <div class="media-body">
                      <div class="right-chart-content">
                        <h4>100</h4><span>Sales return</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                  <div class="media border-none align-items-center">
                    <div class="hospital-small-chart">
                      <div class="small-bar">
                        <div class="small-chart3 flot-chart-container"></div>
                      </div>
                    </div>
                    <div class="media-body">
                      <div class="right-chart-content">
                        <h4>101</h4><span>Purchase ret</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid Ends-->
  </div>
  @endsection
