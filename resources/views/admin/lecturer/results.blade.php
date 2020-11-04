
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
                        <h1 class="h3 ml-4 mt-5 mb-0 text-gray-800">Result Sheets For Courses Lectured By <span class="badge badge-info">{{ Auth::user()->name }}</span> </h1>
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
                            <table class="table table-striped">
                                <thead class="bg-gradient-primary text-white">
                                <tr>
                                    <th scope="col">course Name</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Credit Unit</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Level name</th>
                                    <th scope="col">Semesters</th>
                                    <th scope="col">Marks</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($results->sortBy('course_code') as $result)
                                      @if ($result->enrolled === 1 && $result->user_id === auth()->user()->id)
                                          <tr>
                                              <td>{{$result->course_name}}</a></td>
                                              <td>{{ $result->course_code}}</span></td>
                                              <td><span class="badge badge-danger">{{$result->credit_unit}}</span> Unit</td>
                                              <td>{{$result->name}}</td>
                                              <td><span class="badge badge-danger">{{$result->level_id}}00</span> Level</td>
                                              <td><span><i class=""></i>{{ $result->semesters === 0 ? 'First' : 'second' }} </span></td>
                                              <td><a href="#">{{$result->grades === null ? 'N-A' : $result->grades }}</a></td>
                                          </tr>
                                      @endif
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
