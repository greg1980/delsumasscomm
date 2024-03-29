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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 ">
                        <h1 class="h3 ml-4 mt-5 mb-0 text-gray-800">Result Sheets For Courses Lectured By <span
                                class="badge badge-info">{{ Auth::user()->name }}</span></h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
                    @include('includes.alerts')
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Exam Scores</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered  table-hover  table-striped" id="users-table"
                                       width="100%" cellspacing="0">
                                    <thead class=" text-primary text-bold">
                                    <tr>
                                        <th>Course Name</th>
                                        <th>Code</th>
                                        <th>Credit Unit</th>
                                        <th>Student Name</th>
                                        <th>Level name</th>
                                        <th>Semesters</th>
                                        <th>Marks</th>
                                    </tr>
                                    </thead>
                                    <tfoot class="text-primary text-bold">
                                    <tr>
                                        <th>Course Name</th>
                                        <th>Code</th>
                                        <th>Credit Unit</th>
                                        <th>Student Name</th>
                                        <th>Level name</th>
                                        <th>Semesters</th>
                                        <th>Marks</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($results->sortBy('course_code') as $result)
                                        @if ($result->enrolled === 1 && $result->user_id === auth()->user()->id)
                                            <tr>
                                                <td>{{$result->course_name}}</a></td>
                                                <td>{{ $result->course_code}}</span></td>
                                                <td><span class="badge badge-danger">{{$result->credit_unit}}</span>
                                                    Unit
                                                </td>
                                                <td>{{$result->name}}</td>
                                                <td><span class="badge badge-danger">{{$result->level_id}}00</span>
                                                    Level
                                                </td>
                                                <td><span><i class=""></i>{{ $result->semesters === 0 ? 'First' : 'second' }} </span>
                                                </td>
                                                <td>
                                                    <a href="{{url('lecturer/update'. $result->id)}}"
                                                       class="{{$result->grades <= 46 ? 'text-danger' : 'text-success'}}"
                                                       data-grades="{{$result->grades}}"
                                                       data-result_name="{{$result->name}}"
                                                       data-result_id="{{$result->id}}" type="button"
                                                       data-toggle="modal" data-target="#exampleModal"
                                                       data-whatever="@mdo">
                                                        {{$result->grades === null ? 'N-A' : $result->grades . '' . '%' }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                        <!--       Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-primary">
                                                        <h5 class="modal-title text-white" id="exampleModalLabel">New
                                                            message</h5>
                                                        <button type="button" class="close text-white"
                                                                data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('lecturer.update','test')}}"
                                                              method="post">
                                                            @csrf
                                                            {{ method_field('PATCH') }}
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-lg-9" id="result_name"><span
                                                                            class="badge badge-info">Level:</span> {{$result->level_id}}
                                                                        00
                                                                    </div>
                                                                    <br>
                                                                    <div class="col-lg-3"><span
                                                                            class="badge badge-danger mr-3">{{ $result->course_code}}</span>
                                                                    </div>
                                                                </div>
                                                                <label for="grades" class="col-form-label">Marks</label>
                                                                <input type="number" class="form-control" id="grades"
                                                                       name="grades">
                                                                <input type="hidden" id="result_id" name="result_id">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">Update
                                                                    Grades
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

