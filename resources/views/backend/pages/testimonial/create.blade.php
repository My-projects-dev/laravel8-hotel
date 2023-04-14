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

                                <form action="{{route('testimonial.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="container mt-4">
                                        Star<br>
                                        <select class="custom-select form-control mb-3" id="star" name="star">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        @error('star')
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
                                                Full Name ({{strtoupper($language)}})<br>
                                                <input type="text" name="full_name[]" class="form-control mb-3" required
                                                       id="{{'full_name_'.$language}}" value="{{ old('full_name.'.$key) }}">
                                                @error('full_name.*')
                                                <p class="text-danger mb-1">{{ $message }}</p>
                                                @enderror
                                                <br>
                                                Comment ({{strtoupper($language)}})<br>
                                                <textarea class="form-control" name="comment[]" required
                                                          id="{{'comment'.$language}}">{{old('comment.'.$key)}}</textarea>
                                                @error('comment.*')
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
            CKEDITOR.replace({{'comment_'.$language}});
        </script>
    @endforeach
@endsection
