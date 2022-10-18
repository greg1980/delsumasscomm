@extends('layouts.admin')


@section('content')
    @include('includes.tinyeditor')

    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Page Heading -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 ">
                        <h1 class="h3 ml-4 mt-5 mb-0 text-gray-800"><span
                                class="badge badge-info">{{ Auth::user()->name }}</span> Blackboard <i
                                class="fas fa-chalkboard-teacher ml-3"></i></h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
                    @include('includes.alerts')
                    <div class="row">
                        <div class="col-lg-6 col-xlg-9 col-md-7 ">
                            <div class="card shadow-sm mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Post Your Notes and Assignment</h6>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="/lecturer" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <input type="hidden" id="{{auth()->user()->id}}" name="author_id" value="{{auth()->user()->id}}">
                                            <label for="exampleFormControlInput1" class="font-weight-bold">Post
                                                Title:</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                   name="title" placeholder="Introduction Notes">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1" class="font-weight-bold">Students
                                                Level:</label>
                                            <select class="form-control" id="exampleFormControlSelect1" name="level_id">
                                                <option>select an option</option>
                                                @foreach ($levels as $level_id => $level)
                                                    <option value="{{$level->id}}">{{$level->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect2" class="font-weight-bold">Assigned
                                                Course:</label>
                                            <select class="form-control" id="exampleFormControlSelect2"
                                                    name="course_code">
                                                <option>select an option</option>
                                                @foreach(auth()->user()->courses as $course)
                                                    <option>{{$course->course_code}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1"
                                                   class="font-weight-bold">Deadline</label>
                                            <input type="date" class="form-control" id="exampleFormControlInput1"
                                                   name="dead_line" placeholder="Introduction Notes">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1"
                                                   class="font-weight-bold">Textarea:</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="8"
                                                      name="description"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-lg btn-primary mb-2">Post Notes</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-xlg-3 col-md-5">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Notes / Assignments</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered  table-hover  table-striped" id="notes-table"
                                               width="100%" cellspacing="0">
                                            <thead class=" text-primary text-bold">
                                            <tr>
                                                <th>Title</th>
                                                <th>Code</th>
                                                <th>Created At</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($lecturers as $lecturer )
                                                @if (auth()->user()->id === $lecturer->user_id && $lecturer->deleted_at === null)
                                                    <tr>
                                                        <td>
                                                            <a href="{{url('lecturer/update/'. $lecturer->id)}}"
                                                               data-level_id="{{$lecturer->level_id}}"
                                                               data-title="{{$lecturer->title}}"
                                                               data-lecturer_id="{{$lecturer->id}}"
                                                               data-course_code="{{$lecturer->course_code}}"
                                                               data-description="{{$lecturer->description}}"
                                                               data-dead_line="{{$lecturer->dead_line}}"
                                                               type="button"
                                                               data-toggle="modal"
                                                               data-target="#lecturerModal"
                                                               data-whatever="@mdo">
                                                                {{$lecturer->title}}
                                                            </a>
                                                        </td>
                                                        <td><span
                                                                class="badge badge-info">{{$lecturer->course_code}}</span>
                                                        </td>
                                                        <td><small><i class="far fa-clock text-danger"></i>
                                                            </small> {{  \Carbon\Carbon::parse($lecturer->created_at)->diffForHumans() }}
                                                        </td>
                                                        <td>
                                                            <a href="#" data-toggle="modal" data-target="#deleteModal"
                                                               class="btn btn-danger btn-xs"><span><i
                                                                        class="far fa-trash-alt"></i></span></a>
                                                        </td>
                                                    </tr>
                                                @endif

                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                                     aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete the note ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cancel
                                                                </button>
                                                                <form
                                                                    action="{{ route('lecturer.deleteNotes',$lecturer->id) }}"
                                                                    method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                            class="btn btn-danger btn-xs {{Auth()->user()->role_id !== 2 ? 'disabled' : ''}}">
                                                                        <span><i class="far fa-trash-alt"></i></span>
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end of Delete Modal -->

                                                <!--       Modal -->
                                                <div class="modal fade" id="lecturerModal" tabindex="-1"
                                                     aria-labelledby="lecturerModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-gradient-primary">
                                                                <h5 class="modal-title text-white"
                                                                    id="lecturerModalLabel">New message</h5>
                                                                <button type="button" class="close text-white"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{route('lecturer.updateNotes','test')}}"
                                                                      method="post">
                                                                    @csrf
                                                                    {{ method_field('PATCH') }}
                                                                    <input type="hidden" id="lecturer_id"
                                                                           name="lecturer_id">
                                                                    <div class="form-group">
                                                                        <label for="exampleFormControlInput1"
                                                                               class="font-weight-bold">
                                                                            Title:</label>
                                                                        <input type="text" class="form-control"
                                                                               id="title" name="title">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleFormControlSelect1"
                                                                               class="font-weight-bold">Students
                                                                            Level:</label>
                                                                        <select class="form-control" id="level_id"
                                                                                name="level_id">
                                                                            <option>select an option</option>
                                                                            @foreach ($levels as $level_id => $level)
                                                                                <option
                                                                                    value="{{$level->id}}">{{$level->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleFormControlSelect2"
                                                                               class="font-weight-bold">Assigned
                                                                            Course:</label>
                                                                        <select class="form-control" id="course_code"
                                                                                name="course_code">
                                                                            <option>select an option</option>
                                                                            @foreach(auth()->user()->courses as $course)
                                                                                <option>{{$course->course_code}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleFormControlInput1"
                                                                               class="font-weight-bold">Deadline</label>
                                                                        <input class="form-control"
                                                                               id="dead_line" name="dead_line"
                                                                               value="{{$lecturer->dead_line}}"
                                                                               placeholder="Introduction Notes">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="description"
                                                                               class="font-weight-bold">Textarea:</label>
                                                                        <textarea class="form-control" id="description"
                                                                                  rows="8"
                                                                        >{{$lecturer->description}}</textarea>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Close
                                                                        </button>
                                                                        <button type="submit"
                                                                                class="btn btn-primary modalButton">
                                                                            Update Notes
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
        </div>
    </div>
@endsection
