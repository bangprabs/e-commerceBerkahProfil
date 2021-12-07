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
                            <div class="card-header bg-primary">
                                <h5 style="margin-top: 10px">List Categories</h5>
                                <a href="{{ url('admin/add-edit-category')}}" class="btn btn-success" style="float: right; margin-top: -35px;">Add Categories</a>
                            </div>

                            <div class="card-body">

                                @if (Session::has('error_message'))
                            <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
                                {{ Session::get('error_message')}}
                                <button class="btn-close" type="button" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif
                            @if (Session::has('success_message'))
                            <div class="p-3 alert alert-success dark alert-dismissible fade show" role="alert">
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

                                <div class="table w-100">
                                    <table style="width:100%" class="table table-scrollable table-striped table-responsive table-bordered table-striped" id="userlist">
                                        <thead>
                                            <tr>
                                                <th>Num. </th>
                                                <th>Category</th>
                                                <th>Parent Category</th>
                                                <th>URL</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;?>
                                            @foreach ($categories as $category)
                                                @if (!isset($category->parentcategory->category_name))
                                                    <?php $parent_category = "Root" ?>
                                                @else
                                                    <?php $parent_category = $category->parentcategory->category_name ?>
                                            @endif
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{$category->category_name}}</td>
                                                <td>{{$parent_category}}</td>
                                                <td>{{$category->url}}</td>
                                                <td>
                                                    @if ($categoryModule['edit_access'] == 1 || $categoryModule['full_access'] == 1)
                                                        @if ($category->status == 1)
                                                            <a class="updateCategoryStatus btn btn-primary btn-block w-100" id="category-{{$category->id}}"
                                                            category_id="{{$category->id}}" href="javascript:void(0)">Active</a>
                                                        @else
                                                            <a class="updateCategoryStatus btn btn-danger btn-block w-100"
                                                                id="category-{{$category->id}}" category_id="{{$category->id}}"
                                                                href="javascript:void(0)">Inactive</a>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($categoryModule['edit_access'] == 1 || $categoryModule['full_access'] == 1)
                                                        <a title="Edit Categories" href="{{ url('admin/add-edit-category/'.$category->id)}}" class="sm btn btn-success mr-1"><i class="fa fa-edit"></i></a>
                                                    @endif
                                                    @if ($categoryModule['full_access'] == 1)
                                                        <a title="Delete Categories" href="javascript:void(0)" record="category" recordid="{{ $category->id }}" class="confirmDelete sm btn btn-danger"><i class="fa fa-trash"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                            <?php $no++?>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Num. </th>
                                                <th>Category</th>
                                                <th>Parent Category</th>
                                                <th>URL</th>
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
