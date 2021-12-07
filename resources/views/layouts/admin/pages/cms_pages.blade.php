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
                                <h5 style="margin-top: 10px">Daftar Halaman</h5>
                                <a href="{{ url('admin/add-edit-cms-page')}}" class="btn btn-success" style="float: right; margin-top: -35px;">Tambah Halaman </a>
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
                                                <th>No. </th>
                                                <th>Nama</th>
                                                <th>URL</th>
                                                <th>Created At</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <?php $no = 1;?>
                                        @foreach ($cms_pages as $page)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{$page['title']}}</td>
                                            <td>{{$page['url']}}</td>
                                            <td>{{$page['created_at']}}</td>
                                            <td>
                                                @if ($page['status'] == 1)
                                                <a class="updatePageStatus btn btn-primary btn-block"
                                                    id="page-{{$page['id']}}" page_id="{{$page['id']}}"
                                                    href="javascript:void(0)">Active</a>
                                                @else
                                                <a class="updatePageStatus btn btn-danger btn-block"
                                                    id="page-{{$page['id']}}" page_id="{{$page['id']}}"
                                                    href="javascript:void(0)">Inactive</a>
                                                @endif
                                            </td>
                                            <td style="text-align: center">
                                                <a title="Edit page" href="{{ url('admin/add-edit-cms-page/'.$page['id'])}}" class="btn btn-success "><i class="fa fa-edit"></i></a>
                                                <a title="Delete page" href="javascript:void(0)" record="page" recordid="{{ $page['id'] }}" class="confirmDelete btn btn-danger ml-3"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php $no++?>
                                        @endforeach
                                        <tfoot>
                                            <tr>
                                                <th>No. </th>
                                                <th>Nama</th>
                                                <th>URL</th>
                                                <th>Created At</th>
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
