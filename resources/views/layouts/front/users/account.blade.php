@extends('layouts.front_layouts.front_layout')
@section('content')
<div class="col-sm-12 col-md-12 col-lg-12">
    <!-- Tab panes -->
    <div class="tab-content dashboard_content" data-aos="fade-up" data-aos-delay="200">
        @if (Session::has('error_message'))
        <div class="mr-3 ml-3">
            <div class="mt-4 alert alert-danger" role="alert">
                {{ Session::get('error_message')}}
            </div>
        </div>
        @endif

        @if (Session::has('success_message'))
        <div class="mr-3 ml-3">
            <div class="mt-4 alert alert-success" role="alert">
                {{ Session::get('success_message')}}
            </div>
        </div>
        @endif
        <div class="tab-pane fade show active" id="dashboard">
            <h4>Hi, {{$userDetails['name']}} !</h4>
            <p>From your account dashboard. you can easily check &amp; view your <a href="#">recent
                    orders</a>, manage your <a href="#">shipping and billing addresses</a> and <a href="#">Edit your password and account details.</a></p>
        </div>
        <div class="tab-pane fade" id="orders">
            <h4>Orders</h4>
            <div class="table_page table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Order ID</th>
                            <th>Order Products</th>
                            <th>Payment Method</th>
                            <th>Grand Total</th>
                            <th>Create On</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;?>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $order['id'] }}</td>
                                <td>
                                    @foreach ($order['orders_products'] as $pro)
                                        {{$pro['product_code']}}
                                    @endforeach
                                </td>
                                <td>{{ $order['payment_method'] }}</td>
                                <td>@currency($order['grand_total'])</td>
                                <td>{{ date('d-m-Y', strtotime($order['created_at'])) }}</td>
                                <td><a href="{{ url('/orders/'.$order['id']) }}">View Details</a></td>
                            </tr>
                            <?php $no++?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="downloads">
            <h4>Downloads</h4>
            <div class="table_page table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Downloads</th>
                            <th>Expires</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Shopnovilla - Free Real Estate PSD Template</td>
                            <td>May 10, 2018</td>
                            <td><span class="danger">Expired</span></td>
                            <td><a href="#" class="view">Click Here To Download Your File</a></td>
                        </tr>
                        <tr>
                            <td>Organic - ecommerce html template</td>
                            <td>Sep 11, 2018</td>
                            <td>Never</td>
                            <td><a href="#" class="view">Click Here To Download Your File</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane" id="address">
            <p>The following addresses will be used on the checkout page by default.</p>
            <h5 class="billing-address">Billing address, <h3 class="mb-2"><strong>{{ $userDetails['name'] }}</strong></h3></h5>

            <address>
                <span class="mb-1 d-inline-block"><strong>City:</strong> {{ $userDetails['city'] }}</span>,
                <br>
                <span class="mb-1 d-inline-block"><strong>State:</strong> {{ $userDetails['state'] }}</span>,
                <br>
                <span class="mb-1 d-inline-block"><strong>ZIP:</strong> {{ $userDetails['pincode'] }}</span>,
                <br>
                <span><strong>Country:</strong> {{$userDetails['country']}}</span>
            </address>
        </div>
        <div class="tab-pane fade" id="account-details">
            <h3>Account details </h3>
            @if (Session::has('error_message'))
                        <div class="mr-3 ml-3">
                            <div class="mt-4 alert alert-danger" role="alert">
                                {{ Session::get('error_message')}}
                            </div>
                        </div>
                        @endif

                        @if (Session::has('success_message'))
                        <div class="mr-3 ml-3">
                            <div class="mt-4 alert alert-success" role="alert">
                                {{ Session::get('success_message')}}
                            </div>
                        </div>
                        @endif
            <div class="login">
                <div class="login_form_container">
                    <div class="account_login_form">
                        <form id="accountForm" action="{{ url('/account') }}" method="post">@csrf
                            <p>Already have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#loginActive">Log in instead!</a></p>
                            <div class="default-form-box mb-20">
                                <label>Email</label>
                                <input class="span3" readonly value="{{ $userDetails['email'] }}" type="text" readonly>
                            </div>
                            <div class="default-form-box mb-20">
                                <label>Name</label>
                                <input class="span3" type="text" id="name" name="name" placeholder="Enter Name"
                                value="{{ $userDetails['name'] }}" required pattern="[A-Za-z]+">
                            </div>
                            <div class="default-form-box mb-20">
                                <label>Address</label>
                                <input class="span3" type="text" id="address" name="address" placeholder="Enter Address"
                                required value="{{ $userDetails['address'] }}">
                            </div>
                            <div class="default-form-box mb-20">
                                <label>City</label>
                                <select class="span3 w-100" id="city" name="city">
                                    <option value="">Select City</option>
                                    @foreach ($city as $cities)
                                    <option @if ($cities['city']==$userDetails['city']) selected @endif
                                        value="{{ $cities['city'] }}">{{$cities['city']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="default-form-box mb-20">
                                <label>Provinsi</label>
                                <select class="span3 w-100" id="city" name="state">
                                    <option value="">Select Province</option>
                                    @foreach ($province as $prov)
                                    <option @if ($prov['province']==$userDetails['state']) selected @endif
                                        value="{{ $prov['province'] }}">{{$prov['province']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="default-form-box mb-20">
                                <label>Country</label>
                                <select class="span3 w-100" id="country" name="country">
                                    <option value="">Select Contries</option>
                                    @foreach ($countries as $country)
                                    <option @if ($country['country_name']==$userDetails['country']) selected @endif
                                        value="{{ $country['country_name'] }}">{{$country['country_name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="default-form-box mb-20">
                                <label>ZIP Code</label>
                                <input class="span3" type="text" id="pincode" name="pincode" placeholder="Enter Pincode"
                                value="{{ $userDetails['pincode'] }}">
                            </div>
                            <div class="default-form-box mb-20">
                                <label>Mobile Phone</label>
                                <input class="span3" type="number" name="mobile" id="mobile" placeholder="Enter Mobile"
                                value="{{ $userDetails['mobile'] }}">
                            </div>
                            <br>
                            <div class="save_button mt-3">
                                <button class="btn" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="update-password">

            @if (Session::has('error_message'))
                        <div class="mr-3 ml-3">
                            <div class="mt-4 alert alert-danger" role="alert">
                                {{ Session::get('error_message')}}
                            </div>
                        </div>
                        @endif

                        @if (Session::has('success_message'))
                        <div class="mr-3 ml-3">
                            <div class="mt-4 alert alert-success" role="alert">
                                {{ Session::get('success_message')}}
                            </div>
                        </div>
                        @endif

            <h3>Update Password </h3>
            <hr/>
            <div class="login">
                <div class="login_form_container">
                    <div class="account_login_form">
                        <form id="passwordForm" action="{{ url('/update-password') }}" method="post">@csrf
                            <div class="default-form-box">
                                <label>Password</label>
                                <input class="span3" type="password" name="current_pwd" id="current_pwd"
                                placeholder="Enter Current Password"><br>
                                <span style="margin-top: -30px;" id="chkPwd"></span>
                            </div>
                            <div class="default-form-box mb-20" style="margin-top: -30px;">
                                <label>New Password</label>
                                <input class="span3" type="password" name="new_password" id="new_password"
                                placeholder="Enter New Password">
                            </div>
                            <div class="default-form-box mb-20">
                                <label>Confirm Password</label>
                                <input class="span3" type="password" name="confirm_password" id="confirm_password"
                                placeholder="Enter Confirm Password">
                            </div>
                            <br>
                            <div class="save_button mt-3">
                                <button class="btn" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
