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
                        <a href="{{route('blog.index')}}" class="btn btn-success mb-xxl-0 mb-4 ">
                            <i class="fa fa-list-alt" aria-hidden="true"></i> List of blogs
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

                                <form action="{{route('blog.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="container mt-4">
                                        Image<br>
                                        <input type="file" name="image" class="form-control mb-3" required>
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
                                                <br>
                                                Content ({{strtoupper($language)}})<br>
                                                <textarea class="form-control" name="content[]" required
                                                          id="{{'content_'.$language}}">{{old('content.'.$key)}}</textarea>
                                                @error('content.*')
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
            CKEDITOR.replace({{'content_'.$language}});
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
