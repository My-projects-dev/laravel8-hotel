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
                        <a href="{{route('amenity.index')}}" class="btn btn-success mb-xxl-0 mb-4 ">
                            <i class="fa fa-list-alt" aria-hidden="true"></i> List of room amenity
                        </a>
                        <a href="{{route('amenity.create')}}" class="btn btn-primary mb-xxl-0 mb-4 "><i
                                class="fa fa-plus" aria-hidden="true"></i> Add room amenity
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

                                    @foreach($amenities as $key=>$amenity)
                                        <div id="{{$languages[$key]}}"
                                             class="container tab-pane  mb-5 {{$loop->first ? 'active' : ''}}">
                                                <div class="col-xs-6 col-sm-2">
                                                    <figure>
                                                        <figcaption>
                                                            <span class="{{$amenity->parentAmenity->icon}} fa-5x"></span>
                                                        </figcaption>
                                                    </figure>
                                                </div>
                                            <form action="{{route('amenity.update',$amenity->id)}}" method="POST"
                                                  enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf

                                                Icon<br>
                                                <input type="text" name="icon" value="{{$amenity->parentAmenity->icon}}"
                                                       class="form-control mb-2">
                                                @error('icon')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror
                                                Title<br>
                                                <input type="text" name="title" value="{{$amenity->title}}"
                                                       class="form-control mb-2">
                                                @error('title')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror
                                                Status<br>
                                                <select class="custom-select form-control" id="Status" name="status">
                                                    <option
                                                        value="0" {{($amenity->parentAmenity->status==0) ? 'selected' : ''}}>
                                                        Inactive
                                                    </option>
                                                    <option
                                                        value="1" {{($amenity->parentAmenity->status==1) ? 'selected' : ''}}>
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
