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
                        <a href="{{route('team.index')}}" class="btn btn-success mb-xxl-0 mb-4 ">
                            <i class="fa fa-list-alt" aria-hidden="true"></i> List of teams
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

                                <form action="{{route('team.store')}}" method="post" enctype="multipart/form-data">
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

                                        Email<br>
                                        <input type="email" name="email" class="form-control mb-3"
                                                value="{{ old('email') }}">
                                        @error('email')
                                        <p class="text-danger mb-1">{{ $message }}</p>
                                        @enderror

                                        Facebook<br>
                                        <input type="url" name="facebook" class="form-control mb-3"
                                                value="{{ old('facebook') }}">
                                        @error('facebook')
                                        <p class="text-danger mb-1">{{ $message }}</p>
                                        @enderror

                                        Twitter<br>
                                        <input type="url" name="twitter" class="form-control mb-3"
                                                value="{{ old('twitter') }}">
                                        @error('twitter')
                                        <p class="text-danger mb-1">{{ $message }}</p>
                                        @enderror

                                        Linkedin<br>
                                        <input type="url" name="linkedin" class="form-control mb-3"
                                                value="{{ old('linkedin') }}">
                                        @error('linkedin')
                                        <p class="text-danger mb-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        @foreach($languages as $key => $language)
                                            <div id="{{$language}}"
                                                 class="container tab-pane mb-5 mt-0 {{$loop->first ? 'active' : ''}}">
                                                <br>
                                                Full Name ({{strtoupper($language)}})<br>
                                                <input type="text" name="full_name[]" class="form-control mb-3"
                                                       id="{{'full_name'.$language}}"
                                                       value="{{ old('full_name.'.$key) }}">
                                                @error('full_name.*')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror
                                                Position ({{strtoupper($language)}})<br>
                                                <input type="text" name="position[]" class="form-control mb-3"
                                                       id="{{'position_'.$language}}" value="{{old('position.'.$key)}}">
                                                @error('position.*')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror
                                                <br>

                                                <button type="submit"
                                                        class="btn btn-primary mt-4" {{$loop->last ? '' : 'hidden'}}>
                                                    Create
                                                </button>
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

    @foreach($languages as $language)
        <script>
            CKEDITOR.replace({{'about_'.$language}});
        </script>
    @endforeach
@endsection
