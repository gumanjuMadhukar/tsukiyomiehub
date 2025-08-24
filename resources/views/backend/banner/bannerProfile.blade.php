@extends('backend.layouts.app')
@section('title', 'Banner Profile')

@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Manage Banner</h4>
                    <p class="mb-0">Edit and update your banner details</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">App</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Banner</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-tab">
                            <div class="custom-tab-1">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a href="#banner-details" data-toggle="tab" class="nav-link active show">Banner Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#edit-banner" data-toggle="tab" class="nav-link">Edit Banner</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    {{-- Banner Details Tab --}}
                                    <div id="banner-details" class="tab-pane fade active show">
                                        <div class="profile-about-me pt-4 border-bottom-1 pb-4">
                                            <h4 class="text-primary">Banner Information</h4>

                                            {{-- Display Banner Image --}}
                                            <div class="banner-image text-center mb-4">
                                                <img src="{{ asset('public/uploads/banners/' . $banner->image) }}" alt="Banner Image" class="img-fluid rounded" style="max-height: 300px;">
                                            </div>

                                            {{-- Display Banner Title and Description --}}
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <h5 class="f-w-500">Title <span class="pull-right">:</span></h5>
                                                </div>
                                                <div class="col-md-9">
                                                    <span>{{ $banner->title }}</span>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <h5 class="f-w-500">Description <span class="pull-right">:</span></h5>
                                                </div>
                                                <div class="col-md-9">
                                                    <span>{{ $banner->description }}</span>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <h5 class="f-w-500">Status <span class="pull-right">:</span></h5>
                                                </div>
                                                <div class="col-md-9">
                                                    <span>{{ $banner->status == 1 ? 'Active' : 'Inactive' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Edit Banner Tab --}}
                                    <div id="edit-banner" class="tab-pane fade">
                                        <div class="pt-3">
                                            <div class="settings-form">
                                                <h4 class="text-primary">Update Banner</h4>
                                                <form action="{{ route('banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="bannerTitle">Banner Title</label>
                                                        <input type="text" name="title" id="bannerTitle" class="form-control" value="{{ old('title', $banner->title) }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="bannerDescription">Description</label>
                                                        <textarea name="description" id="bannerDescription" rows="5" class="form-control">{{ old('description', $banner->description) }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="bannerImage">Banner Image</label>
                                                        <input type="file" name="image" id="bannerImage" class="form-control-file">
                                                        <small class="form-text text-muted">Upload a new image to replace the current one.</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="bannerStatus">Status</label>
                                                        <select name="status" id="bannerStatus" class="form-control">
                                                            <option value="1" {{ $banner->status == 1 ? 'selected' : '' }}>Active</option>
                                                            <option value="0" {{ $banner->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Update Banner</button>
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
        </div>
    </div>
</div>

@endsection

@push('scripts')
{{-- You can add any necessary scripts here, e.g., for form validation or dynamic content. --}}
@endpush
