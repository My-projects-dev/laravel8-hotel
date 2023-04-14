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
                        <a href="{{route('menu.index')}}" class="btn btn-success mb-xxl-0 mb-4 ">
                            <i class="fa fa-list-alt" aria-hidden="true"></i> List of menus
                        </a>
                    </div>
                    <div class="tab-content">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs" role="tablist">
                                    @foreach($languages as $key=>$language)
                                    <li class="nav-item">
                                        <a class="nav-link {{$loop->first ? 'active' : ''}}" data-toggle="tab"  href="{{'#'.$language}}">{{strtoupper($language)}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-body">
                                <!-- Nav tabs -->

                                <form action="{{route('menu.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="container mt-4">
                                        Image<br>
                                        <input type="file" name="image" class="form-control mb-3">
                                        @error('image')
                                        <p class="text-danger mb-1">{{ $message }}</p>
                                        @enderror

                                        Status<br>
                                        <select class="custom-select form-control mb-3" id="status" name="status">
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
                                                Button Title ({{strtoupper($language)}})<br>
                                                <input type="text" name="button_title[]" class="form-control mb-3"
                                                       id="{{'button_title_'.$language}}" value="{{ old('button_title.'.$key) }}">
                                                @error('button_title.*')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror
                                                URL ({{strtoupper($language)}})<br>
                                                <input type="url" name="button_url[]" class="form-control mb-3"
                                                       id="{{'button_url_'.$language}}" value="{{old('button_url.'.$key)}}">
                                                @error('button_url.*')
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
