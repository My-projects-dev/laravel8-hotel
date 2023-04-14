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
                        <a href="{{route('testimonial.index')}}" class="btn btn-success mb-xxl-0 mb-4 ">
                            <i class="fa fa-list-alt" aria-hidden="true"></i> List of testimonials
                        </a>
                        <a href="{{route('testimonial.create')}}" class="btn btn-primary mb-xxl-0 mb-4 "><i
                                class="fa fa-plus" aria-hidden="true"></i> Add testimonial
                        </a>
                    </div>
                    <div class="tab-content">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs" role="tablist">
                                    @foreach($languages as $key=>$language)
                                        <li class="nav-item">
                                            <a class="nav-link {{$loop->first ? 'active' : ''}}" data-toggle="tab"
                                               href="{{'#'.$language}}">{{strtoupper($language)}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    @foreach($testimonials as $key => $testimonial)
                                        <div id="{{$languages[$key]}}"
                                             class="container tab-pane  mb-5 {{$loop->first ? 'active' : ''}}">
                                            <div class="text-center mt-5">
                                                <div class="text-center mt-5">
                                                    @if($testimonial->parentTestimonial->image)
                                                        <img class="border border-primary"
                                                             src="{{asset('uploads/testimonials/'.$testimonial->parentTestimonial->image)}}"
                                                             alt="{{$testimonial->full_name}}"
                                                             height="300">
                                                    @endif
                                                </div>
                                            </div>
                                            <form action="{{route('testimonial.update',$testimonial->id)}}"
                                                  method="POST"
                                                  enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf

                                                Status<br>
                                                <select class="custom-select form-control mb-3" id="star" name="star">
                                                    <option value="1" {{($testimonial->parentTestimonial->star == 1) ? 'selected' : ''}}>1</option>
                                                    <option value="2" {{($testimonial->parentTestimonial->star == 2) ? 'selected' : ''}}>2</option>
                                                    <option value="3" {{($testimonial->parentTestimonial->star == 3) ? 'selected' : ''}}>3</option>
                                                    <option value="4" {{($testimonial->parentTestimonial->star == 4) ? 'selected' : ''}}>4</option>
                                                    <option value="5" {{($testimonial->parentTestimonial->star == 5) ? 'selected' : ''}}>5</option>
                                                </select>
                                                @error('star')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror

                                                Status <br>
                                                <select class="custom-select form-control mb-4" id="Status"
                                                        name="status">
                                                    <option
                                                        value="0" {{($testimonial->parentTestimonial->status == 0) ? 'selected' : ''}}>
                                                        Inactive
                                                    </option>
                                                    <option
                                                        value="1" {{($testimonial->parentTestimonial->status == 1) ? 'selected' : ''}}>
                                                        Active
                                                    </option>
                                                </select>
                                                @error('status')
                                                <p class="text-danger mb-1">{{$message}}</p>
                                                @enderror

                                                Full name <br>
                                                <input type="text" name="full_name" class="form-control mb-4" required
                                                       id="full_name" value="{{$testimonial->full_name}}">
                                                @error('full_name')
                                                <p class="text-danger mb-1">{{$message}}</p>
                                                @enderror

                                                <br>
                                                Comment<br>
                                                <textarea class="form-control" name="comment" required
                                                          id="comment">{{$testimonial->comment}}</textarea>
                                                @error('comment')
                                                <p class="text-danger mb-1">{{$message}}</p>
                                                @enderror

                                                <button type="submit" class="btn btn-warning mt-2"> Edit</button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            {{--                            /.card--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
