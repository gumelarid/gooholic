@extends('admin.template.index')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <a class="btn btn-sm btn-primary" href="{{ url('dashboard/user/add') }}"><i class="fas fa-plus"></i> Add User</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatables" class="display table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>#</th>
                        </tr>
                    </thead>
                   
                    <tbody>
                        @foreach ($user as $item)
                            <tr>
                                <td>
                                    <div class="avatar avatar-md">
                                        <img class="avatar-img rounded" src="{{ url('assets/image').'/'.$item->profile }}" alt="" srcset="">
                                    </div>
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    @if ($item->role == 0)
                                        <span class="badge badge-primary">Admin</span>
                                    @else
                                        <span class="badge badge-success">User</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->is_active == 0)
                                        <span class="badge badge-danger">Non Active</span>
                                    @else
                                        <span class="badge badge-success">Active</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group dropdown">
                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="btn-label">
                                                <i class="fas fa-edit"></i> Action
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 32px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <li>
                                                <a class="dropdown-item" href="{{ url('dashboard/user/'.$item->id_user) }}">Edit</a>
                                                <a class="dropdown-item " onclick="return confirm('Delete Data ?')" href="{{ url('dashboard/user/delete/'.$item->id_user) }}">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



@endsection

