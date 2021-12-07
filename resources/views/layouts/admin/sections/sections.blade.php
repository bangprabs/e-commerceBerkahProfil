@extends('layouts.admin_layouts.admin_layout')
@section('content')
<!-- Zero Configuration  Starts-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="container">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header bg-secondary">
                                <h5 style="margin-top: 10px">List Sections</h5>
                                <a href="{{ url('admin/add-edit-section')}}" class="btn btn-success"
                                    style="float: right; margin-top: -35px;">Add Sections</a>
                            </div>
                            @if (Session::has('error_message'))
                            <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
                                {{ Session::get('error_message')}}
                                <button class="btn-close" type="button" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif
                            @if (Session::has('success_message'))
                            <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                                {{ Session::get('success_message')}}
                                <button class="btn-close" type="button" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif

                            @if ($errors->any())
                            <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
                                @foreach ($errors->all() as $error)
                                {{ $error }} <br>
                                @endforeach
                            </div>
                            @endif
                            <div class="card-body">
                                <div class="table-responsive table-bordered">
                                    <table class="display" id="blog">
                                        <thead>
                                            <tr>
                                                <th>No. </th>
                                                <th>Section Name</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;?>
                                            @foreach ($sections as $section)
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{$section['name']}}</td>
                                                <td>
                                                    @if ($section['status'] == 1)
                                                    <a class="updateSectionStatus btn btn-primary btn-block w-100"
                                                        id="section-{{$section['id']}}" section_id="{{$section['id']}}"
                                                        href="javascript:void(0)">Active</a>
                                                    @else
                                                    <a class="updateSectionStatus btn btn-danger btn-block w-100"
                                                        id="section-{{$section['id']}}" section_id="{{$section['id']}}"
                                                        href="javascript:void(0)">Inactive</a>
                                                    @endif
                                                </td>
                                                <td style="text-align: center">
                                                    <a title="Edit Banner"
                                                        href="{{ url('admin/add-edit-section/'.$section['id'])}}"
                                                        class="btn btn-sm btn-pill btn-success btn-air-success"><i data-feather="edit"></i></a>
                                                    <a title="Delete Banner" href="javascript:void(0)" record="sections"
                                                        recordid="{{ $section['id'] }}"
                                                        class="confirmDelete btn btn-sm btn-pill btn-danger btn-air-danger ml-3"><i
                                                        data-feather="delete"></i></a>
                                                </td>
                                            </tr>
                                            <?php $no++?>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No. </th>
                                                <th>Section Name</th>
                                                <th>Status</th>
                                                <th>Actions</th>
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
