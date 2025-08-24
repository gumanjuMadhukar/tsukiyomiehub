@extends('backend.layouts.app')
@section('title', 'Banner List')

@push('styles')
<link href="{{asset('public/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush

@section('content')

<div class="content-body">
    <div class="container-fluid">

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Banner List</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('banner.index')}}">Banners</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('banner.index')}}">All Banner</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-pills mb-3">
                    <li class="nav-item"><a href="#list-view" data-toggle="tab"
                            class="nav-link btn-primary mr-1 show active">List View</a></li>
                    <li class="nav-item"><a href="#grid-view" data-toggle="tab" class="nav-link btn-primary">Grid
                            View</a></li>
                </ul>
            </div>
            <div class="col-lg-12">
                <div class="row tab-content">
                    <div id="list-view" class="tab-pane fade active show col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Banners</h4>
                                <a href="{{route('banner.create')}}" class="btn btn-primary">+ Add new</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>{{__('#')}}</th>
                                                <th>{{__('Image')}}</th>
                                                <th>{{__('Title')}}</th>
                                                <th>{{__('Page')}}</th>
                                                <th>{{__('Section')}}</th>
                                                <th>{{__('Status')}}</th>
                                                <th>{{__('Action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($data as $d)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td><img class="rounded-circle" width="35" height="35"
                                                        src="{{asset('public/uploads/banners/'.$d->image)}}" alt="Banner Image"></td>
                                                <td><strong>{{$d->title}}</strong></td>
                                                <td>{{$d->page}}</td>
                                                <td>{{$d->section}}</td>
                                                <td>
                                                    <span class="badge {{ $d->status == 1 ? 'badge-success' : 'badge-danger' }}">
                                                        {{ $d->status == 1 ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{route('banner.edit', $d->id)}}"
                                                        class="btn btn-sm btn-primary" title="Edit"><i
                                                            class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                                                        title="Delete" onclick="event.preventDefault(); document.getElementById('delete-form-{{$d->id}}').submit();">
                                                        <i class="la la-trash-o"></i>
                                                    </a>
                                                    <form id="delete-form-{{$d->id}}"
                                                        action="{{route('banner.destroy', $d->id)}}"
                                                        method="post" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No Banner Found</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="grid-view" class="tab-pane fade col-lg-12">
                        <div class="row">
                            @forelse ($data as $d)
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-profile">
                                    <div class="card-header justify-content-end pb-0">
                                        <div class="dropdown">
                                            <button class="btn btn-link" type="button" data-toggle="dropdown">
                                                <span class="dropdown-dots fs--1"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right border py-0">
                                                <div class="py-2">
                                                    <a class="dropdown-item"
                                                        href="{{route('banner.edit', $d->id)}}">Edit</a>
                                                    <a class="dropdown-item text-danger"
                                                        href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('delete-form-grid-{{$d->id}}').submit();">
                                                        Delete
                                                    </a>
                                                    <form id="delete-form-grid-{{$d->id}}"
                                                        action="{{route('banner.destroy', $d->id)}}"
                                                        method="post" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-2">
                                        <div class="text-center">
                                            <div class="profile-photo">
                                                <img src="{{asset('public/uploads/banners/'.$d->image)}}" width="100"
                                                    height="100" class="rounded-circle" alt="Banner Image">
                                            </div>
                                            <h3 class="mt-4 mb-1">{{$d->title}}</h3>
                                            <p class="text-muted">{{$d->Description}}</p>
                                            <ul class="list-group mb-3 list-group-flush">
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span>Page :</span>
                                                    <strong>{{$d->page}}</strong>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span>Section :</span>
                                                    <strong>{{$d->section}}</strong>
                                                </li>
                                                <li class="list-group-item px-0 d-flex justify-content-between">
                                                    <span>Status :</span>
                                                    <span class="badge {{ $d->status == 1 ? 'badge-success' : 'badge-danger' }}">
                                                        {{ $d->status == 1 ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-lg-12">
                                <div class="card card-profile">
                                    <div class="card-body pt-2">
                                        <div class="text-center">
                                            <p class="mt-3 px-4">Banner Not Found</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script src="{{asset('public/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/js/plugins-init/datatables.init.js')}}"></script>

@endpush
