@extends('layouts.admin')


@section('content')

    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
               @include('includes.lecdashboard')
                <!-- Page Heading -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 " >
                        <h1 class="h3 ml-4 mt-5 mb-0 text-gray-800"> <span class="badge badge-info">{{ Auth::user()->name }}</span> Blackboard <i class="fas fa-chalkboard-teacher ml-3"></i></h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
                    @include('includes.alerts')
                    <div class="card-body">
                        <div class="card-header">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
