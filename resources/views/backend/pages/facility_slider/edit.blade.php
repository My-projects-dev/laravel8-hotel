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
                            <i class="fa fa-list-alt" aria-hidden="true"></i> List of facility sliders
                        </a>
                        <a href="{{route('facility_slider.create')}}" class="btn btn-primary mb-xxl-0 mb-4 "><i
                                class="fa fa-plus" aria-hidden="true"></i> Add facility slider
                        </a>
                    </div>
                    <div class="tab-content">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center mt-5">
                                    <div class="text-center mt-5">
                                        @if($slider->image)
                                            <img class="border border-primary"
                                                 src="{{asset('uploads/facility_slider/'.$slider->image)}}"
                                                 alt=""
                                                 height="300">
                                        @endif
                                    </div>
                                </div>
                                <form action="{{route('facility_slider.update',$slider->id)}}" method="POST"
                                      enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf

                                    Image<br>
                                    <input type="file" name="image" class="form-control mb-2">
                                    @error('image')
                                    <p class="text-danger mb-1">{{ $message }}</p>
                                    @enderror

                                    Status<br>
                                    <select class="custom-select form-control" id="Status" name="status">
                                        <option
                                            value="0" {{($slider->status==0) ? 'selected' : ''}}>
                                            InActive
                                        </option>
                                        <option
                                            value="1" {{($slider->status==1) ? 'selected' : ''}}>
                                            Active
                                        </option>
                                    </select>
                                    @error('status')
                                    <p class="text-danger mb-1">{{ $message }}</p>
                                    @enderror

                                    <button type="submit" class="btn btn-warning mt-4">Edit</button>
                                </form>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
