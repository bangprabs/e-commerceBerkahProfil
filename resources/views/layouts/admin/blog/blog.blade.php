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
                                <h5 style="margin-top: 10px">List Blog</h5>
                                <a href="{{ url('admin/add-edit-blog')}}" class="btn btn-success" style="float: right; margin-top: -35px;">Add Blog</a>
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
                                <div class="table-responsive table-bordered">
                                    <table class="display" id="blog">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Blog Author</th>
                                                <th>Created At</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($blogs as $blog)
                                            <tr>
                                                <td>{{$blog->id}}</td>
                                                <td>{{$blog->blog_title}}</td>
                                                <td>{{$blog->blog_author}}</td>
                                                <td>{{$blog->blog_date}}</td>
                                                <td>
                                                    @if ($blog->status == 1)
                                                    <a class="updateBlogStatus btn btn-primary btn-block w-100" id="blog-{{$blog->id}}"
                                                    blog_id="{{$blog->id}}" href="javascript:void(0)">Active</a>
                                                    @else
                                                    <a class="updateBlogStatus btn btn-danger btn-block w-100"
                                                        id="blog-{{$blog->id}}" blog_id="{{$blog->id}}"
                                                        href="javascript:void(0)">Inactive</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a title="Edit Blog" href="{{ url('admin/add-edit-blog/'.$blog->id)}}" class="btn btn-success m-1"><i data-feather="edit"></i></a>
                                                    <a title="Delete Blog" href="javascript:void(0)" record="blog" recordid="{{ $blog->id }}" class="confirmDelete btn btn-danger m-1"><i data-feather="delete"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Blog Author</th>
                                                <th>Created At</th>
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
