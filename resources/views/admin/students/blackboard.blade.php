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
                        <h1 class="h3 ml-4 mt-5 mb-0 text-gray-800">Mass-Comm Department: <span class="badge badge-info">{{Auth::user() ? Auth::user()->level->name : ''}}</span>Level Blackboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
                    @if (Session::has('message'))
                        <div  class="balert balert-success ">
                            <h4 class="mt-5 mb-5 ml-5">
                                <span><i class="fas fa-check-circle"></i></span>
                                {{ Session::get('message') }}
                            </h4>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="card-header">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
