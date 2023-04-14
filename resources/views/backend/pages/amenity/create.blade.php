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
                            <i class="fa fa-list-alt" aria-hidden="true"></i> List of room amenities
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
                                <!-- Nav tabs -->

                                <form action="{{route('amenity.store')}}" method="post">
                                    @csrf

                                    <div class="container mt-4">
                                        Icon<br>
                                        <input type="text" name="icon" class="form-control mb-2">
                                        @error('icon')
                                        <p class="text-danger mb-1">{{ $message }}</p>
                                        @enderror
                                        Status<br>
                                        <select class="custom-select form-control" id="Status" name="status">
                                            <option value="0">Inactive</option>
                                            <option value="1">Active</option>
                                        </select>
                                        @error('status')
                                        <p class="text-danger mb-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        @foreach($languages as $key => $language)
                                            <div id="{{$language}}"
                                                 class="container tab-pane mb-5 mt-0 {{$loop->first ? 'active' : ''}}">
                                                <br>
                                                Title ({{strtoupper($language)}})<br>
                                                <input type="text" name="title[]" class="form-control mb-3" required
                                                       id="{{'title_'.$language}}" value="{{ old('title.'.$key) }}">
                                                @error('title.*')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror
                                                <button type="submit" class="btn btn-primary mt-4" {{$loop->last ? '' : 'hidden'}}>Create</button>
                                            </div>
                                        @endforeach
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
