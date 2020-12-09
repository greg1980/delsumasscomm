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
                        <h1 class="h3 ml-4 mt-5 mb-0 text-gray-800"><span class="badge badge-danger">{{Auth::user() ? Auth::user()->level->name : ''}}</span> Level Notes For <span class="badge badge-info">{{$notes->course_code}}</span></h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
                   @include('includes.alerts')
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="card-header">
                                 <div class="card-title">
                                     <h2>{{$notes->title}}</h2>
                                 </div>
                                <div class="card-subtitle">
                                    <em>
                                        <small>Posted {{\Carbon\Carbon::parse($notes->created_at)->diffForHumans() }} <i class="far fa-clock text-danger"></i></small>
                                    </em>
                                </div>
                            </div>
                            <div class="card-body">
                                    <p class="card-text">{!! $notes->description !!}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
