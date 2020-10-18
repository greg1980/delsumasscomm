@extends('layouts.admin')

@section('content')

    <div class="page-wrapper">

        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 col-8 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Profile</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-11">
                    @if (Session::has('message'))

                        <div  class="balert balert-success ">
                            <h4 class="mt-5 mb-5 ml-5">
                                <span><i class="fas fa-check-circle"></i></span>
                                {{ Session::get('message') }}
                            </h4>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="palert palert-danger mt-5 mb-5">
                                <span><h4><i class="fas fa-exclamation-triangle mt-3 mb-4 ml-5"></i> Rectify the Following Errors </h4></span>
                                <ul class="ml-5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">

                <!-- Column -->
                <div class="col-lg-4 col-xlg-3 col-md-5">
                    <div class="card">
                        <div class="card-block">
                            <center class="p-4">
                                <img src="{{$user->avatar ? asset('/storage/images/'. $user->avatar ) : '/storage/images/150.jpg' }}" class="rounded-circle" width="150" />
                                <h4 class="card-title m-t-10 mt-3 text-muted">{{ $user->role_id === 2 ? $user->title.' ' .$user->name : $user->name  }}</h4>
                                <h6 class="card-subtitle text-dark">Department of Mass-Comm</h6>
                                <div class="row text-center justify-content-md-center">
                                    <div class="col-4 mt-2"><a class="text-lg text-white"><span class="badge badge-info"><b>{{ $user->role ? $user->role->name : 'None'}}</b></span></a></div>
                                    @if(Auth()->user()->role->name === 'Student')
                                        <div class="col-4 mt-2">
                                            <h3 class="text-lg text-white ">
                                                <span class="badge badge-danger">{{$user->level ? $user->level->name : ''}} Level</span>
                                            </h3>
                                        </div>
                                    @endif
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->

                <div class="col-lg-6 col-xlg-9 col-md-7">
                    <form class="form-horizontal form-material" method="POST" action="/admin/users/{{$user->id}}">
                        {{ method_field('PATCH') }}
                        @csrf
                        <div class="card mb-5 border-bottom-primary">
                            <div class="card-block">
                                <div class="form-group mr-5 ml-5">
                                    <label for="exampleInputEmail1" class="mt-3 sdanger">TITLE</label>
                                    <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="exampleInputEmail1" value="{{ $user->title }}">
                                </div>
                                <div class="form-group mr-5 ml-5">
                                    <label for="exampleInputEmail1" >FULL NAME</label>
                                    <input type="text" name="name" class="form-control {{$errors->has('name') ?'is-invalid': ''}}" id="exampleInputEmail1" value="{{ $user->name }}" readonly>
                                    <small id="helpId" class="text-muted">Name cant be changed</small>
                                </div>
                                <div class="form-group mr-5 ml-5">
                                    <label for="exampleInputEmail1" >GENDER</label>
                                    <select class="form-control {{$errors->has('gender') ?'is-invalid': ''}}"  name="gender" id="">
{{--                                        <option value="{{$user->gender ? 'Female' : 'Male' }}">{{$user->gender ? 'Female' : 'Male' }}</option>--}}
                                        @if ($user->gender)
                                            <option value="{{$user->gender }}" {{$user->gender ? 'selected' : ''}}>{{$user->gender === 0 ? 'Male' : 'Female' }}</option>
                                        @endif
                                        <option value="0">Male</option>
                                        <option value="1">Female</option>
                                    </select>
                                </div>
                                <div class="form-group mr-5 ml-5">
                                    <label for="exampleInputEmail1" >DOB</label>
                                    <input type="date" name="dateofbirth" class="form-control {{ $errors->has('dateofbirth') ? 'is-invalid':'' }}" id="exampleInputEmail1" value="{{$user->dateofbirth}}">
                                </div>
                                <div class="form-group mr-5 ml-5">
                                    <label for="exampleInputEmail1" >MOBILE</label>
                                    <input type="tel" class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}"  name="mobile" id="exampleInputEmail1" value="{{$user->mobile}}">
                                </div>
                                <div class="form-group mr-5 ml-5">
                                    <label for="exampleInputEmail1" >Email address</label>
                                    <input type="text" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="exampleInputEmail1" value="{{$user->email }} " readonly>
                                    <small id="helpId" class="text-muted">Email address cant be changed</small>
                                </div>
                                <div class="form-group mr-5 ml-5">
                                    <label for="exampleInputEmail1" >HOUSE NUMBER</label>
                                    <input type="text" class="form-control {{$errors->has('housenumber') ?'is-invalid': ''}}" id="exampleInputEmail1" name="housenumber" value="{{$user->housenumber}}" >
                                </div>
                                <div class="form-group mr-5 ml-5">
                                    <label for="exampleInputEmail1" >STREET</label>
                                    <input type="text" name="address" class="form-control {{$errors->has('address') ?'is-invalid': ''}}" id="exampleInputEmail1" value="{{$user->address}}">
                                </div>
                                <div class="form-group mr-5 ml-5">
                                    <label for="exampleInputEmail1" >CITY</label>
                                    <input type="text" name="city" class="form-control {{$errors->has('city') ?'is-invalid': ''}}" id="exampleInputEmail1" value="{{$user->city}}">
                                </div>

                                @if(Auth()->user()->role->id === 3)
                                    <div class="form-group mr-5 ml-5">
                                        <label for="exampleInputEmail1" >MAT NUMBER</label>
                                        <input type="text" name="matnumber" class="form-control {{$errors->has('matnumber') ?'is-invalid': ''}}" id="exampleInputEmail1" value="{{$user->matnumber}}">
                                    </div>
                                    <div class="form-group mr-5 ml-5">
                                        <label for="exampleInputEmail1" >User Level</label>
                                            <select class="form-control  {{$errors->has('level_id') ? 'is-invalid' : ''}}" name="level_id" id="">
                                                <option value="{{$user->level_id }}">Choose an option</option>
                                                @foreach ($levels as  $id => $name)
                                                    <option value="{{$id}}" {{ $id == $user->level_id ? 'selected' : '' }}>{{$name}} Level</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="form-group mr-5 ml-5">
                                        <label for="exampleInputEmail1" >YEAR OF ADMISSION</label>
                                        <input type="date" name="yearofadmission" class="form-control {{$errors->has('yearofadmission') ?'is-invalid': ''}}" id="exampleInputEmail1" value="{{$user->yearofadmission}}">
                                    </div>

                                    <div class="form-group mr-5 ml-5">
                                        <label for="exampleInputEmail1" >YEAR OF GRADUATION</label>
                                        <input type="date" name="yearofgrad" class="form-control {{$errors->has('yearofgrad') ?'is-invalid': ''}}" id="exampleInputEmail1" value="{{$user->yearofgrad}}">
                                        <small id="helpId" class="text-muted">Expected year of graduation</small>
                                    </div>
                                @endif

                                <div class="col ml-5 mt-5">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-primary text-"><b>Save</b></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        @if (Auth::user()->id)
                            <div class="col-sm-12">
                                <a href="{{ route('admin.users.profile', Auth::user()->id) }}"><button class="btn btn-info " ><i class="fas fa-backward mr-2"></i> BACK</button></a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

        </div>

    </div>
    <script>
        export default {
            data() {
                return {
                    elementVisible: true
                }
            },

            created() {
                setTimeout(() => this.elementVisible = false, 1000)
            }
        }
    </script>
@endsection
