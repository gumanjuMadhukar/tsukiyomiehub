@extends('backend.layouts.app')
@section('title', 'Edit Banner')

@push('styles')
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/images/favicon.png')}}">
<link rel="stylesheet" href="{{asset('public/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}">
<link rel="stylesheet" href="{{asset('public/css/style.css')}}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-RzU/j8v9XFwD1B5NlP3wB8P3Ww1D/yJ2W8d0+H9OaW/zF90i0a8y0qW9/h+bF9W8Gg8cW8N5e" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')

<div class="content-body">
    <div class="container-fluid">

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Edit Banner</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('banner.index')}}">Banners</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">Edit Banner</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-xxl-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Banner Info</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('banner.update', $banner->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" name="title" value="{{old('title', $banner->title)}}">
                                    </div>
                                    @if($errors->has('title'))
                                    <span class="text-danger"> {{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Page</label>
                                        <input type="text" class="form-control" name="page" value="{{old('page', $banner->page)}}">
                                    </div>
                                    @if($errors->has('page'))
                                    <span class="text-danger"> {{ $errors->first('page') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Section</label>
                                        <input type="text" class="form-control" name="section" value="{{old('section', $banner->section)}}">
                                    </div>
                                    @if($errors->has('section'))
                                    <span class="text-danger"> {{ $errors->first('section') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <select class="form-control" name="status">
                                            <option value="1" @if(old('status', $banner->status) == 1) selected @endif>Active</option>
                                            <option value="0" @if(old('status', $banner->status) == 0) selected @endif>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="Description" rows="5">{{old('Description', $banner->Description)}}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="form-label">Image</label>
                                    <div class="form-group fallback w-100">
                                        <input type="file" class="dropify" data-default-file="{{asset('public/uploads/banners/'.$banner->image)}}" name="image">
                                    </div>
                                    @if($errors->has('image'))
                                    <span class="text-danger"> {{ $errors->first('image') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8So+F2s9o2T+5yXh7b4Cg2I6yKj6vN5n5V5s1+5u01yQ8g5F5w5/5w5/5w5/5w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('.dropify').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Ooops, something wrong happend.'
        }
    });
</script>
@endpush
