@extends('admin.template.index')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <button class="btn btn-sm btn-primary" onclick="add();" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-plus"></i> Add Sosmed</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatables" class="display table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Url</th>
                            <th>#</th>
                        </tr>
                    </thead>
                   
                    <tbody>
                        @foreach ($sosmed as $value)
                            <tr>
                                <td><i class="{{ $value->icon }}"></i> {{ $value->sosmed }}</td>
                                <td><a href="{{ url($value->url)  }}">{{ $value->url }}</a></td>
                                <td>
                                    <div class="btn-group dropdown">
                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="btn-label">
                                                <i class="fas fa-edit"></i> Action
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 32px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <li>
                                                <a class="dropdown-item" href="{{ url('dashboard/sosmed/'.$value->id_sosmed) }}" data-toggle="modal" data-target="#exampleModalCenter" onclick="edit('<?php echo $value->id_sosmed;?>');">Edit</a>
                                                <a class="dropdown-item " onclick="return confirm('Delete Data ?')" href="{{ url('dashboard/sosmed/delete/'.$value->id_sosmed) }}">Delete</a>
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
          <h5 class="modal-title" id="exampleModalLongTitle">Add Sosial Media</h5>
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

function edit(id_sosmed) {
    $('#exampleModalLongTitle').text('Edit Sosial Media')
    
    var req = $.ajax({
        url: "{{ URL::to('/dashboard/sosmed/show') }}",
        data: "id_sosmed="+id_sosmed,
        type: "get",
        dataType: "html"
    });

    req.done(function(output){
        $('#form-edit').html(output)
    })
}
function add() {
    $('#exampleModalLongTitle').text('Add Sosial Media')
    $('#form-edit').html(`
            <form method="POST" action="{{ url('dashboard/sosmed/store') }}">
                @csrf

                <div class="col-md-12">
                    @error('icon')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="category">icon Sosial Media</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="icon" id="category" class="form-control" placeholder="Enter icon">
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    @error('sosmed')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="category">Sosial Media</label>
                    <div class="form-group">
                        <select name="sosmed" class="form-control">
                            <option>-- Selected --</option>
                            <option value="Facebook">Facebook</option>
                            <option value="Twitter">Twitter</option>
                            <option value="Linkedin">Linkedin</option>
                            <option value="Github">Github</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12">
                    @error('url')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="category">URL Sosial Media</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="url" id="category" class="form-control" placeholder="Enter Url">
                        </div>
                    </div>
                </div>
                <br>
                <div class="com-md-12">
                    <input type="submit" value="Save Sosial media" class="btn btn-primary m-t-15 waves-effect">
                    <a href="{{ url('dashboard/sosmed') }}"  class="btn btn-danger m-t-15 waves-effect"> Back</a>
                </div>
            </form>
    `)
}

</script>

@endsection

