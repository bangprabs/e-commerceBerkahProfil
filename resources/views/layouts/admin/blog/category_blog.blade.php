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
                            <div class="card-header bg-danger">
                                <h5>Category Blog</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="display" id="basic-1">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Status</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($category as $categories)
                                            <tr>
                                                <td>{{$categories->id}}</td>
                                                <td>{{$categories->name}}</td>
                                                <td>
                                                    @if ($categories->status == 1)
                                                    <a class="updateCatBlogStatus btn btn-primary btn-block w-100" id="catblog-{{$categories->id}}"
                                                    catblog_id="{{$categories->id}}" href="javascript:void(0)">Active</a>
                                                    @else
                                                    <a class="updateCatBlogStatus btn btn-danger btn-block w-100"
                                                        id="catblog-{{$categories->id}}" catblog_id="{{$categories->id}}"
                                                        href="javascript:void(0)">Inactive</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Status</th>
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
