@extends('admin.template.index')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <a class="btn btn-sm btn-primary" href="{{ url('dashboard/article/add') }}"><i class="fas fa-plus"></i> Add Page</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatables" class="display table table-striped table-hover" >
                    <thead>
                        <tr>
                            
                            <th>Owner</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Created_at</th>
                            <th>views</th>
                            <th>#</th>
                        </tr>
                    </thead>
                   
                    <tbody>
                        
                        @foreach ($article as $val)
                    
                        <tr>
                            
                            <td>{{ $val->name }}</td>
                            <td>
                                {{ $val->title }} <br>
                                Category : <span class="font-italic font-weight-bold"> {{ $val->category }}</span> 
                            </td>
                            <td>
                                @if ($val->is_publish == 0)
                                    <span class="badge badge-danger">Draf</span>
                                @else
                                    <span class="badge badge-success">Publish</span>
                                @endif
                            </td>
                            <td>{{ date('d M Y', strtotime($val->created_at)) }}</td>
                            <td>@if ($val->view == 0)
                                0
                            @else
                                {{ $val->view }}
                            @endif <i class="fas fa-eye"></i></td>
                            <td>
                                <div class="btn-group dropdown">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="btn-label">
                                            <i class="fas fa-edit"></i> Action
                                        </span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 32px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <li>
                                            <a class="dropdown-item" href="{{ url('dashboard/article/'.$val->id_article) }}">Edit</a>
                                            <a class="dropdown-item " onclick="return confirm('Delete Data ?')" href="{{ url('dashboard/article/delete/'.$val->id_article) }}">Delete</a>
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

