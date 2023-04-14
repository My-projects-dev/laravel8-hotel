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
                        <a href="{{route('addition.index')}}" class="btn btn-success mb-xxl-0 mb-4 ">
                            <i class="fa fa-list-alt" aria-hidden="true"></i> List of additions
                        </a>
                    </div>
                    <div class="tab-content">
                        <div class="card">
                            <div class="card-body">
                                <!-- Nav tabs -->

                                <form action="{{route('addition.store')}}" method="post">
                                    @csrf
                                    Title<br>
                                    <input type="text" name="title" class="form-control mb-2" required>
                                    @error('title')
                                    <p class="text-danger mb-1">{{ $message }}</p>
                                    @enderror
                                    Value<br>
                                    <input type="text" name="price" class="form-control mb-2" required min="0" step="0.01" value="0">
                                    @error('price')
                                    <p class="text-danger mb-1">{{ $message }}</p>
                                    @enderror
                                    <button type="submit" class="btn btn-primary mt-3">Create</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
