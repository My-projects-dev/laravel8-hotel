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
                        <a href="{{route('near.index')}}" class="btn btn-success mb-xxl-0 mb-4 ">
                            <i class="fa fa-list-alt" aria-hidden="true"></i> List of nearby
                        </a>
                        <a href="{{route('near.create')}}" class="btn btn-primary mb-xxl-0 mb-4 "><i
                                class="fa fa-plus" aria-hidden="true"></i> Add near
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
                                    @foreach($nearbies as $key => $near)
                                        <div id="{{$languages[$key]}}"
                                             class="container tab-pane  mb-5 {{$loop->first ? 'active' : ''}}">
                                            <div class="text-center mt-5">
                                                <div class="text-center mt-5">
                                                    @if($near->parentNear->image)
                                                        <img class="border border-primary"
                                                             src="{{asset('uploads/nearbies/'.$near->parentNear->image)}}"
                                                             alt="{{$near->button_title}}"
                                                             height="300">
                                                    @endif
                                                </div>
                                            </div>
                                            <form action="{{route('near.update',$near->id)}}" method="POST"
                                                  enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf

                                                <div class="form-group mb-4">
                                                    <label for="images">Add new image</label>
                                                    <input type="file" name="image" class="form-control">
                                                    @error('image')
                                                    <p class="text-danger mb-1">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                Status <br>
                                                <select class="custom-select form-control mb-4" id="Status"
                                                        name="status">
                                                    <option
                                                        value="0" {{($near->parentNear->status == 0) ? 'selected' : ''}}>
                                                        Inactive
                                                    </option>
                                                    <option
                                                        value="1" {{($near->parentNear->status == 1) ? 'selected' : ''}}>
                                                        Active
                                                    </option>
                                                </select>
                                                @error('status')
                                                <p class="text-danger mb-1">{{$message}}</p>
                                                @enderror

                                                Button Title <br>
                                                <input type="text" name="button_title" class="form-control mb-4"
                                                       id="button_title" value="{{$near->button_title}}">
                                                @error('button_title')
                                                <p class="text-danger mb-1">{{$message}}</p>
                                                @enderror

                                                URL <br>
                                                <input type="url" name="button_url" class="form-control mb-4"
                                                       id="button_url" value="{{$near->button_url}}">
                                                @error('button_url')
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
