
@extends('layouts.admin')


@section('content')

    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Page Heading -->
                <div class="container-fluid">
                    <div class="alert alert-light border-warning">
                        <div class="row">
                            <div class="col-lg-4 ">
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                   <h6 class="{{$failCount >= $passCount ? 'text-danger' : 'text-success'}}">{{$failCount >= $passCount ? 'You need to work harder to Improve on your result' : 'Good result keep it up'}}</h6>
                                   <h6>Subjects Taken <span class="badge badge-info"> {{count($results)}}</span></h6>
                                   <h6>Subjects Failed <span class="badge  {{$failCount >= 1 ? 'badge-danger' : 'badge-info'}}">{{$failCount}} </span></h6>
                                   <h6>Subjects Passed <span class="badge badge-info">{{$passCount}} </span></h6>
                                   <h6>Max Score <span class="badge badge-success">{{$maxCount}}% </span></h6>
                                   <h6>Total Average Score <span class="badge {{$avgCount <= 49 ? 'badge-danger' : 'badge-info'}}">{{$avgCount}}% </span></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card-body">
                                    <div class="chart-area pt-4 pb-2">

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card-body">
                                    <div class="chart-bar pt-4 pb-2">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 " >
                        <h1 class="h3 ml-4 mt-5 mb-0 text-gray-800">Result Sheets For Courses Taken By <span class="badge badge-info">{{ Auth::user()->name }}</span> </h1>
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
                        <div class="table-responsive">
                            <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                                <thead class=" text-primary text-bold">
                                <tr>
                                    <th>course Name</th>
                                    <th>Code</th>
                                    <th>Unit</th>
                                    <th>Student Name</th>
                                    <th>Level</th>
                                    <th>Semesters</th>
                                    <th>Marks</th>
                                </tr>
                                </thead>
                                <tfoot class="text-primary text-bold">
                                <tr>
                                    <th>Course Name</th>
                                    <th>Code</th>
                                    <th>Unit</th>
                                    <th>Student Name</th>
                                    <th>Level</th>
                                    <th>Semesters</th>
                                    <th>Marks</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($results->sortBy('course_code') as $result)
                                    @if ($result->enrolled === 1 && $result->name === auth()->user()->name)
                                        <tr>
                                            <td>{{$result->course_name}}</a></td>
                                            <td>{{ $result->course_code}}</span></td>
                                            <td><span class="badge badge-danger">{{$result->credit_unit}}</span> Unit</td>
                                            <td>{{$result->name}}</td>
                                            <td><span class="badge badge-danger">{{$result->level_id}}00</span> Level</td>
                                            <td><span><i class=""></i>{{ $result->semesters === 0 ? 'First' : 'second' }} </span></td>
                                            <td><a  class="{{$result->grades <= 45 ? 'text-danger' : 'text-success'}}" >{{$result->grades === null ? 'N-A' : $result->grades . '%' }}</a></td>
                                        </tr>
                                    @endif
                                    <!--       Modal -->
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
