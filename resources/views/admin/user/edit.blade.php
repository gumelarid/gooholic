@extends('admin.template.index')

@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Edit Users
                    </h2>
                </div>
                <div class="body">
                    <form method="post" action="{{ url('dashboard/user/update') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id_user }}">
                        <div class="col-md-6">
                           
                            <label for="name">Name</label>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter your Name" value="{{ $user->name }}">
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-md-6">
                            
                            <label for="email">Email</label>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email address" value="{{ $user->email }}" >
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            
                            <label for="password">New Password</label>
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password min 8 character">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            
                            <label for="password">Role</label>
                            @error('role')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <select name="role" class="form-control">
                                @if ($user->role == '0')
                                    <option value="0" selected>Admin</option>
                                    <option value="1" >User</option>
                                @else
                                    <option value="0">Admin</option>
                                    <option value="1" selected>User</option>
                                @endif
                            </select>
                        </div>

                        <br>
                        <input type="submit" value="Update User" class="btn btn-primary m-t-15 waves-effect">
                        <a href="{{ url('dashboard/user') }}"  class="btn btn-danger m-t-15 waves-effect"> Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection