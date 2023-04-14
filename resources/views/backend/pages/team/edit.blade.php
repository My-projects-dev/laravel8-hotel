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
                        <a href="{{route('team.create')}}" class="btn btn-primary mb-xxl-0 mb-4 "><i
                                class="fa fa-plus" aria-hidden="true"></i> Add team
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
                                    @foreach($teams as $key => $team)
                                        <div id="{{$languages[$key]}}"
                                             class="container tab-pane  mb-5 {{$loop->first ? 'active' : ''}}">
                                            <div class="text-center mt-5">
                                                <div class="text-center mt-5">
                                                    @if($team->parentTeam->image)
                                                        <img class="border border-primary"
                                                             src="{{asset('uploads/teams/'.$team->parentTeam->image)}}"
                                                             alt="{{$team->full_name}}"
                                                             height="300">
                                                    @endif
                                                </div>
                                            </div>
                                            <form action="{{route('team.update',$team->id)}}" method="POST"
                                                  enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf

                                                <div class="form-group mb-4">
                                                    <label for="images">Change image</label>
                                                    <input type="file" name="image" class="form-control">
                                                    @error('image')
                                                    <p class="text-danger mb-1">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                Status <br>
                                                <select class="custom-select form-control mb-4" id="Status"
                                                        name="status">
                                                    <option
                                                        value="0" {{($team->parentTeam->status == 0) ? 'selected' : ''}}>
                                                        Inactive
                                                    </option>
                                                    <option
                                                        value="1" {{($team->parentTeam->status == 1) ? 'selected' : ''}}>
                                                        Active
                                                    </option>
                                                </select>
                                                @error('status')
                                                <p class="text-danger mb-1">{{$message}}</p>
                                                @enderror

                                                Email<br>
                                                <input type="email" name="email" class="form-control mb-3"
                                                       value="{{$team->parentTeam->email ?? ''}}">
                                                @error('email')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror

                                                Facebook<br>
                                                <input type="url" name="facebook" class="form-control mb-3"
                                                       value="{{$team->parentTeam->facebook ?? ''}}">
                                                @error('facebook')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror

                                                Twitter<br>
                                                <input type="url" name="twitter" class="form-control mb-3"
                                                       value="{{$team->parentTeam->twitter ?? ''}}">
                                                @error('twitter')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror

                                                Linkedin<br>
                                                <input type="url" name="linkedin" class="form-control mb-3"
                                                       value="{{$team->parentTeam->linkedin ?? ''}}">
                                                @error('linkedin')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror

                                                Full Name <br>
                                                <input type="text" name="full_name" class="form-control mb-4"
                                                       id="full_name" value="{{$team->full_name}}">
                                                @error('full_name')
                                                <p class="text-danger mb-1">{{$message}}</p>
                                                @enderror

                                                Position <br>
                                                <input type="text" name="position" class="form-control mb-4"
                                                       id="position" value="{{$team->position}}">
                                                @error('position')
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

    <script>
        @foreach($languages as $language)
        CKEDITOR.replace({{'about_'.$language}});
        @endforeach
    </script>
@endsection
