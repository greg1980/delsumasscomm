@extends('layouts.admin')


@section('content')

    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Page Heading -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 " >
                        <h1 class="h3 ml-4 mt-5 mb-0 text-gray-800">Students Blackboard For <span class="badge badge-info">{{Auth::user() ? Auth::user()->level->name : ''}}</span> Level </h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
                   @include('includes.alerts')
                    <div class="card-body">
                        <div class="card-header">
                            <div class="col-lg-12 col-xlg-3 col-md-6">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Notes / Assignments</h6>
                                    </div>
                                        @foreach($notes as $note)
                                            @if (auth()->user()->level_id === $note->level_id && $note->deleted_at === null)
                                        <div class="card">
                                                <div class="card-header">
                                                    <b class="text-black-50">{{$note->title}}</b>
                                                </div>
                                                <div class="card-body mb">
                                                    <h6><small>Created {{\Carbon\Carbon::parse($note->created_at)->diffForHumans() }} <i class="far fa-clock text-danger"></i></small> </h6>
                                                    <h5 class="card-title">{{$note->course_code}}</h5>
                                                    <a href="{{ route('admin.students.note', $note->id)}}" class="btn btn-primary">View</a>
                                                </div>
                                        </div>
                                            @endif
                                        @endforeach
                                </div>
                                {{$notes->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
