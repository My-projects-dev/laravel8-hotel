@extends('layouts.backend.master')
@section('content')
    <!--**********************************
            Content body start
        ***********************************-->
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
                    <div class="tab-content">
                        <div class="tab-pane active show" id="All">
                            <div class="table-responsive">
                                <table
                                    class="table card-table default-table display mb-4 dataTablesCard table-responsive-xl "
                                    id="guestTable-all">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Readed</th>
                                        <th class="bg-none"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($comments as $comment)
                                        <tr>
                                             <td class="job-desk">
                                                <div>
                                                    <span>{{$comment->name}}</span>
                                                </div>
                                            </td>
                                            <td class="job-desk">
                                                <div>
                                                    <span>{{$comment->email}}</span>
                                                </div>
                                            </td>
                                            <td class="job-desk">
                                                <div>
                                                    <span>{{$comment->subject}}</span>
                                                </div>
                                            </td>
                                            <td class="job-desk">
                                                <div>
                                                    <span class="text-{{$comment->readed==1 ? 'success' : 'danger'}}">{{$comment->readed==1 ? 'read' : 'unread'}}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link"
                                                       data-bs-toggle="dropdown"
                                                       aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                                stroke="#262626" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"/>
                                                            <path
                                                                d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                                stroke="#262626" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"/>
                                                            <path
                                                                d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                                stroke="#262626" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"/>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                           href="{{route('comment.show',$comment->id)}}">Show</a>
                                                        <form
                                                            action="{{ route('comment.destroy',$comment->id) }}"
                                                            method="Post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item ai-icon">Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">{!! $comments->links() !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->
@endsection
