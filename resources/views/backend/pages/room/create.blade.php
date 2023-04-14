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
                        <a href="{{route('room.index')}}" class="btn btn-success mb-xxl-0 mb-4 ">
                            <i class="fa fa-list-alt" aria-hidden="true"></i> List of rooms
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

                                <form action="{{route('room.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="container mt-4">
                                        <div class="row mb-3">
                                            @foreach($amenities as $amenity)
                                                <di class="col-md-4">
                                                    <label>
                                                        <input type="checkbox" name="amenity[]"
                                                               value="{{$amenity->parentAmenity->id}}">
                                                        {{$amenity->title}}
                                                    </label><br>
                                                </di>
                                            @endforeach
                                            @error('amenity.*')
                                            <p class="text-danger mb-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        Main Image<br>
                                        <input type="file" name="main_image" class="form-control mb-3" required>
                                        @error('main_image')
                                        <p class="text-danger mb-1">{{ $message }}</p>
                                        @enderror

                                        Images<br>
                                        <input type="file" multiple name="images[]" class="form-control mb-3">
                                        @error('images.*')
                                        <p class="text-danger mb-1">{{ $message }}</p>
                                        @enderror

                                        Room type<br>
                                        <select class="custom-select form-control mb-3" id="type" name="type">
                                            @foreach($room_types as $type)
                                                <option
                                                    value="{{$type->parentRoomType->id}}">{{$type->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('type')
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

                                        Price<br>
                                        <input type="number" name="price" class="form-control" min="0" value="0"
                                               step="0.01" required>
                                        @error('price')
                                        <p class="text-danger mb-1">{{ $message }}</p>
                                        @enderror

                                        Number of rooms<br>
                                        <input type="number" name="number_of_rooms" class="form-control" min="0" value="0">
                                        @error('number_of_rooms')
                                        <p class="text-danger mb-1">{{ $message }}</p>
                                        @enderror

                                        Adults<br>
                                        <input type="number" name="adult" class="form-control" min="0" value="0" required>
                                        @error('adult')
                                        <p class="text-danger mb-1">{{ $message }}</p>
                                        @enderror

                                        Children<br>
                                        <input type="number" name="child" class="form-control" min="0" value="0">
                                        @error('child')
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
                                                Slug ({{strtoupper($language)}})<br>
                                                <input type="text" name="slug[]" class="form-control mb-3" required
                                                       id="{{'slug_'.$language}}" value="{{old('slug.'.$key)}}">
                                                @error('slug.*')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror
                                                Overview ({{strtoupper($language)}})<br>
                                                <textarea class="form-control" name="overview[]" required
                                                          id="{{'overview_'.$language}}">{{old('overview.'.$key)}}</textarea>
                                                @error('overview.*')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror
                                                <br>
                                                Rules ({{strtoupper($language)}})<br>
                                                <textarea class="form-control" name="rules[]" required
                                                          id="{{'rules_'.$language}}">{{old('rules.'.$key)}}</textarea>
                                                @error('rules.*')
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

    @foreach($languages as $language)
        <script>
            CKEDITOR.replace({{'overview_'.$language}});
            CKEDITOR.replace({{'rules_'.$language}});
        </script>


        <script>
            $("{{'#title_'.$language}}").change(function (e) {
                $.get('{{ url('backend/blog_slug') }}',
                    {'title': $(this).val()},
                    function (data) {
                        $("{{'#slug_'.$language}}").val(data.slug);
                    }
                );
            });
        </script>

        <script>
            $("{{'#slug_'.$language}}").change(function (e) {
                $.get('{{ url('backend/blog_slug') }}',
                    {'title': $(this).val()},
                    function (data) {
                        $("{{'#slug_'.$language}}").val(data.slug);
                    }
                );
            });
        </script>
    @endforeach
@endsection
