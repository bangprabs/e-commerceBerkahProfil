@extends('layouts.admin_layouts.admin_layout')
@section('content')
<!-- Zero Configuration  Starts-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>
                        {{ $title }}</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"> <i data-feather="user"></i></a></li>
                        <li class="breadcrumb-item">Tambah Edit CMS</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="container">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header bg-danger">
                                <h5 style="margin-top: 10px">{{$title}}</h5>
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
                                <div class="form theme-form">
                                    <form @if (empty($cmspage['id'])) action="{{ url('admin/add-edit-cms-page')}}" @else
                                    action="{{ url('admin/add-edit-cms-page/'.$cmspage['id'])}}" @endif name="cmsform" id="cmsform"
                                    method="post">@csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title"><b>Judul Halaman</b></label>
                                                    <input class="form-control" type="text" id="title" name="title" value="{{ $cmspage['title'] }}"
                                                        placeholder="Input Judul Halaman">
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="url"><b>URL</b></label>
                                                    <input class="form-control" type="text" id="url" name="url" value="{{ $cmspage['url'] }}"
                                                        placeholder="Input URL">
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="meta_title"><b>Meta Judul</b></label>
                                                    <input class="form-control" type="text" id="meta_title" name="meta_title" value="{{ $cmspage['meta_title'] }}"
                                                        placeholder="Input Meta Judul">
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="meta_description"><b>Meta Deskripsi</b></label>
                                                    <input class="form-control" type="text" id="meta_description" name="meta_description" value="{{ $cmspage['meta_description'] }}"
                                                        placeholder="Input Meta Deskripsi">
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="meta_keywords"><b>Meta Keywords</b></label>
                                                    <input class="form-control" type="text" id="meta_keywords" name="meta_keywords" value="{{ $cmspage['meta_keywords'] }}"
                                                        placeholder="Input Meta Keywords">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mt-3">
                                                    <label for="description"><b>CMS Description</b></label>
                                                    <textarea name="description" id="description"
                                                    class="ckeditor form-control" rows="3" placeholder="">
                                                        @if (!empty($cmspage['description']))
                                                            {{ $cmspage['description'] }}
                                                        @else
                                                            {{ old('description')}}
                                                        @endif
                                                        </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="text-end mt-5"><button type="submit"
                                                        class="btn btn-success">{{ $title }}</button>
                                                </div>
                                            </div>
                                        </div>

                                        @if (!empty($productdata['main_image']))
                                        <div class="modal fade" id="exampleModalCenterMain" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterMain" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Main Blog Image</h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img class="img-thumbnail rounded mx-auto d-block"
                                                            src="{{ asset('images/admin_images/product_images/large/' . $productdata['main_image']) }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-bs-dismiss="modal">Close</button>
                                                            <a href="javascript:void(0)" record="product-image"
                                                            recordid="{{ $productdata['id'] }}"
                                                            class="confirmDelete btn btn-danger">Delete Image</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        @if (!empty($productdata['product_video']))
                                        <div class="modal fade" id="exampleModalCenterVideo" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterMain" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Video Product</h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="embed-responsive embed-responsive-16by9 w-100">
                                                            <video controls style="width: 100%" src="{{ asset('videos/products_videos/' . $productdata['product_video'])}}"  />
                                                          </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-bs-dismiss="modal">Close</button>
                                                            <a href="javascript:void(0)" record="product-video"
                                                            recordid="{{ $productdata['id'] }}"
                                                            class="confirmDelete btn btn-danger">Delete Videos</a>
                                                        <a href="{{ url('videos/products_videos/' . $productdata['product_video']) }}" download=""
                                                        class="btn btn-success">Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </form>
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
