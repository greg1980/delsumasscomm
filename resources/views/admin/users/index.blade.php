@extends('layouts.admin')


@section('content')

    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Page Heading -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-5 text-gray-800">Registered Users</h1>
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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Users Table</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover  table-striped" id="users-table" width="100%" cellspacing="0">
                                    <thead class=" text-primary text-bold">
                                    <tr>
                                        <th>Id</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Role</th>
                                        <th>Email</th>
                                        <th>Created</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tfoot class=" text-primary text-bold">
                                    <tr>
                                        <th>Id</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Role</th>
                                        <th>Email</th>
                                        <th>Created</th>
                                        <th>Delete</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td><img height="50" src="{{$user->avatar ? asset('/storage/images/'. $user->avatar ) : '/storage/images/150.jpg' }}" alt=""></td>
                                            <td><a href="{{route('admin.users.profile', $user->id)}}">{{$user->name}}</a></td>
                                            <td class="{{$user->email_verified_at ? 'text-success' : 'text-danger'}}">{{$user->email_verified_at ? 'Active' : 'In-Active'}}</td>
                                            <td>{{ $user->role ? $user->role->name : 'None'}}</td>
                                            <td>{{ $user->email }}</td>
                                            <td> <small><i class="far fa-clock text-danger"></i></small> {{ $user->created_at->diffForHumans() }}</td>
                                            <td>
                                                <form action="{{ route('destroy',$user->id) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger {{Auth()->user()->role_id !== 2 ? 'disabled' : ''}}" ><span><i class="far fa-trash-alt"></i></span></button>
                                                </form>
                                            </td>
                                        </tr>
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

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

    </div>

@endsection
