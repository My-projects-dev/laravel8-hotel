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
                        <a href="{{route('slider.index')}}" class="btn btn-success mb-xxl-0 mb-4 ">
                            <i class="fa fa-list-alt" aria-hidden="true"></i> List of slider
                        </a>
                        <a href="{{route('slider.create')}}" class="btn btn-primary mb-xxl-0 mb-4 "><i
                                class="fa fa-plus" aria-hidden="true"></i> Add slider
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

                                    @foreach($sliders as $key => $slider)
                                        <div id="{{$languages[$key]}}"
                                             class="container tab-pane  mb-5 {{$loop->first ? 'active' : ''}}">
                                            <div class="text-center mt-5">
                                                <div class="text-center mt-5">
                                                    @if($slider->parentSlider->image)
                                                        <img class="border border-primary"
                                                             src="{{asset('uploads/sliders/'.$slider->parentSlider->image)}}"
                                                             alt="{{$slider->title}}"
                                                             height="300">
                                                    @endif
                                                </div>
                                            </div>
                                            <form action="{{route('slider.update',$slider->id)}}" method="POST"
                                                  enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf

                                                Image<br>
                                                <input type="file" name="image" class="form-control mb-2">
                                                @error('image')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror

                                                Title<br>
                                                <input type="text" name="title" value="{{$slider->title}}"
                                                       class="form-control mb-2">
                                                @error('title')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror

                                                Sub title<br>
                                                <input type="text" name="subtitle" value="{{$slider->subtitle}}"
                                                       class="form-control mb-2">
                                                @error('subtitle')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror

                                                Button title<br>
                                                <input type="text" name="button_title"
                                                       value="{{$slider->button_title}}"
                                                       class="form-control mb-2">
                                                @error('button_title')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror

                                                URL<br>
                                                <input type="url" name="button_url" value="{{$slider->button_url}}"
                                                       class="form-control mb-2">
                                                @error('button_url')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror

                                                Star<br>
                                                <select class="custom-select form-control mb-3" id="star" name="star">
                                                    <option value="0" {{($slider->parentSlider->star == 0) ? 'selected' : ''}}>Chouse slider</option>
                                                    <option value="1" {{($slider->parentSlider->star == 1) ? 'selected' : ''}}>1</option>
                                                    <option value="2" {{($slider->parentSlider->star == 2) ? 'selected' : ''}}>2</option>
                                                    <option value="3" {{($slider->parentSlider->star == 3) ? 'selected' : ''}}>3</option>
                                                    <option value="4" {{($slider->parentSlider->star == 4) ? 'selected' : ''}}>4</option>
                                                    <option value="5" {{($slider->parentSlider->star == 5) ? 'selected' : ''}}>5</option>
                                                </select>
                                                @error('star')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror

                                                Status<br>
                                                <select class="custom-select form-control" id="Status" name="status">
                                                    <option
                                                        value="0" {{($slider->parentSlider->status==0) ? 'selected' : ''}}>
                                                        Passive
                                                    </option>
                                                    <option
                                                        value="1" {{($slider->parentSlider->status==1) ? 'selected' : ''}}>
                                                        Active
                                                    </option>
                                                </select>
                                                @error('status')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror

                                                <button type="submit" class="btn btn-warning mt-4">Edit</button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
