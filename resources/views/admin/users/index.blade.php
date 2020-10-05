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
                        <h1 class="h3 mb-0 text-gray-800">users</h1>
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
                                  <th scope="col">Id</th>
                                  <th scope="col">Photo</th>
                                  <th scope="col">Name</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Role</th>
                                  <th scope="col">Email</th>
                                  <th scope="col">Created</th>
                                  <th scope="col">Delete</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($users as $user)

                              <tr>
                                  <th scope="row">{{$user->id}}</th>
                                  <td><img height="50" src="{{$user->avatar ? asset('/storage/images/'. $user->avatar ) : '/storage/images/150.jpg' }}" alt=""></td>
                                  <td><a href="{{route('admin.users.profile', $user->id)}}">{{$user->name}}</a></td>
                                  <td>{{$user->is_active ? 'Active' : 'In-Active'}}</td>
                                  <td>{{ $user->role ? $user->role->name : 'None'}}</td>
                                  <td>{{ $user->email }}</td>
                                  <td>{{ $user->created_at->diffForHumans() }} <small><i class="far fa-clock"></i></small></td>
                                  <td>
                                      <form action="{{ route('destroy',$user->id) }}" method="post" enctype="multipart/form-data">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-danger {{Auth()->user()->role_id !== 1 ? 'disabled' : ''}}" ><span><i class="far fa-trash-alt"></i></span></button>
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
@endsection
