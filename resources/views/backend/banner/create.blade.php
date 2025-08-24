@extends('backend.layouts.app')
@section('title', 'Add Banner')

@push('styles')
<link rel="stylesheet" href="{{asset('public/vendor/pickadate/themes/default.css')}}">
<link rel="stylesheet" href="{{asset('public/vendor/pickadate/themes/default.date.css')}}">
@endpush

@section('content')

<div class="content-body">
    <div class="container-fluid">

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Add Banner</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('banner.index')}}">Banners</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('banner.create')}}">Add Banner</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-xxl-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Basic Info</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('banner.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" name="title"
                                            value="{{old('title')}}">
                                    </div>
                                    @if($errors->has('title'))
                                    <span class="text-danger"> {{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="Description" rows="2">{{old('Description')}}</textarea>
                                    </div>
                                    @if($errors->has('Description'))
                                    <span class="text-danger"> {{ $errors->first('Description') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Page</label>
                                        <select class="form-control" name="page">
                                            <option value="" disabled selected>Select Page</option>
                                            <option value="homepage" @if(old('page')=='homepage') selected @endif>Homepage</option>
                                            <option value="about" @if(old('page')=='about') selected @endif>About Us</option>
                                            <option value="services" @if(old('page')=='services') selected @endif>Services</option>
                                            <option value="contact" @if(old('page')=='contact') selected @endif>Contact Us</option>
                                            </select>
                                    </div>
                                    @if($errors->has('page'))
                                    <span class="text-danger"> {{ $errors->first('page') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Section</label>
                                        <select class="form-control" name="section">
                                            <option value="" disabled selected>Select Section</option>
                                            <option value="hero" @if(old('section')=='hero') selected @endif>Hero Section</option>
                                            <option value="middle-ad" @if(old('section')=='middle-ad') selected @endif>Middle Ad</option>
                                            <option value="sidebar" @if(old('section')=='sidebar') selected @endif>Sidebar</option>
                                            <option value="footer" @if(old('section')=='footer') selected @endif>Footer</option>
                                            </select>
                                    </div>
                                    @if($errors->has('section'))
                                    <span class="text-danger"> {{ $errors->first('section') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <select class="form-control" name="status">
                                            <option value="1" @if(old('status')==1) selected @endif>Active</option>
                                            <option value="0" @if(old('status')==0) selected @endif>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="form-label">Image</label>
                                    <div class="form-group fallback w-100">
                                        <input type="file" class="dropify" data-default-file="" name="image">
                                    </div>
                                    @if($errors->has('image'))
                                    <span class="text-danger"> {{ $errors->first('image') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{route('banner.index')}}" class="btn btn-light">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script src="{{asset('public/vendor/pickadate/picker.js')}}"></script>
<script src="{{asset('public/vendor/pickadate/picker.time.js')}}"></script>
<script src="{{asset('public/vendor/pickadate/picker.date.js')}}"></script>

<script src="{{asset('public/js/plugins-init/pickadate-init.js')}}"></script>
@endpush
