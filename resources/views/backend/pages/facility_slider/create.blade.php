@extends('layouts.backend.master')
@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success pb-0">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger pb-0">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <a href="{{route('facility_slider.index')}}" class="btn btn-success mb-xxl-0 mb-4 ">
                            <i class="fa fa-list-alt" aria-hidden="true"></i> List of facilitysliders
                        </a>
                    </div>
                    <div class="tab-content">
                        <div class="card">
                            <div class="card-body">
                                <!-- Nav tabs -->

                                <form action="{{route('facility_slider.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="container mt-4">

                                        Image<br>
                                        <input type="file" name="image" class="form-control mb-3">
                                        @error('image')
                                        <p class="text-danger mb-1">{{ $message }}</p>
                                        @enderror

                                        Status<br>
                                        <select class="custom-select form-control mb-3" id="Status" name="status">
                                            <option value="0">Inactive</option>
                                            <option value="1">Active</option>
                                        </select>
                                        @error('status')
                                        <p class="text-danger mb-1">{{ $message }}</p>
                                        @enderror
                                        <button type="submit" class="btn btn-primary mt-4">Create</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
