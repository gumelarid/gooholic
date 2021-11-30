@extends('admin.template.index')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <button class="btn btn-sm btn-primary" onclick="add();" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-plus"></i> Add Category</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatables" class="display table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th>slug</th>
                            <th>Category</th>
                            <th>#</th>
                        </tr>
                    </thead>
                   
                    <tbody>
                        @foreach ($category as $value)
                            <tr>
                                <td><a href="#"><span class="font-italic">{{ $value->slug_category }}</span></a></td>
                                <td>{{ $value->category }}</td>
                                <td>
                                    <div class="btn-group dropdown">
                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="btn-label">
                                                <i class="fas fa-edit"></i> Action
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 32px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <li>
                                                <a class="dropdown-item" href="{{ url('dashboard/category/'.$value->id_category) }}" data-toggle="modal" data-target="#exampleModalCenter" onclick="edit('<?php echo $value->id_category;?>');">Edit</a>
                                                <a class="dropdown-item " onclick="return confirm('Delete Data ?')" href="{{ url('dashboard/category/delete/'.$value->id_category) }}">Delete</a>
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

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="form-edit">
            
        </div>
      </div>
    </div>
  </div>

<div id="hasil"></div>
<meta name="csrf_token" content="{{ csrf_token() }}">
<script>

function edit(id_category) {
    $('#exampleModalLongTitle').text('Edit Category')
    
    var req = $.ajax({
        url: "{{ URL::to('dashboard/category/show') }}",
        data: "id_category="+id_category,
        type: "get",
        dataType: "html"
    });

    req.done(function(output){
        $('#form-edit').html(output)
    })
}
function add() {
    $('#exampleModalLongTitle').text('Add Category')
    $('#form-edit').html(`
            <form method="POST" action="{{ url('dashboard/category/store') }}">
                @csrf
                <div class="col-md-12">
                    @error('category')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="category">Category Name</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="category" id="category" class="form-control" placeholder="Enter your category">
                        </div>
                    </div>
                </div>
                <br>
                <div class="com-md-12">
                    <input type="submit" value="Save category" class="btn btn-primary m-t-15 waves-effect">
                    <a href="{{ url('dashboard/category') }}"  class="btn btn-danger m-t-15 waves-effect"> Back</a>
                </div>
            </form>
    `)
}

</script>

@endsection

