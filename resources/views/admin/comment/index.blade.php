@extends('admin.template.index')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="accordion" id="accordionExample">
                <div class="card">
                  <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                      <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        New Comment 
                        @if (count($unPublish) >= 1)
                            <span class="mr-2 badge bg-danger" style="color: white"> 
                                {{ count($unPublish) }}
                            </span>
                        @endif
                      </button>
                    </h2>
                  </div>
              
                  <div id="collapseOne" class="collapse <?= count($unPublish) >= 1 ?  'show' : '' ?>" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatables1" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Article</th>
                                        <th>Comment</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                               
                                <tbody>
                                    @foreach ($unPublish as $un)
                                        <tr>
                                            <td>{{ date('d M Y', strtotime($un->created_at)) }}</td>
                                            <td>{{ $un->title }}</td>
                                            <td>{{ $un->comments }}</td>
                                            <td>
                                                <div class="btn-group dropdown">
                                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="btn-label">
                                                            <i class="fas fa-edit"></i> Action
                                                        </span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 32px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <li>
                                                            <a class="dropdown-item" data-toggle="modal" data-target="#exampleModalCenter" onclick="view('<?php echo $un->id_comments;?>');">View</a>
                                                            <a class="dropdown-item " onclick="return confirm('Delete Data ?')" href="{{ url('dashboard/comment/delete/'.$un->id_comments) }}">Delete</a>
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
                <div class="card">
                  <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                      <button class="btn btn-link btn-block text-left collapsed"  type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        List Comment
                      </button>
                    </h2>
                  </div>
                  <div id="collapseTwo" class="collapse <?= count($unPublish) == 0 ?  'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatables" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Article</th>
                                        <th>Comment</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                               
                                <tbody>
                                    @foreach ($publish as $pb)
                                        <tr>
                                            <td>{{ date('d M Y', strtotime($pb->created_at)) }}</td>
                                            <td>{{ $pb->title }}</td>
                                            <td>{{ $pb->comments }}</td>
                                            <td>
                                                <div class="btn-group dropdown">
                                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="btn-label">
                                                            <i class="fas fa-edit"></i> Action
                                                        </span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 32px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <li>
                                                            <a class="dropdown-item" data-toggle="modal" data-target="#exampleModalCenter" onclick="viewRead('<?php echo $pb->id_comments;?>');">View</a>
                                                            <a class="dropdown-item " onclick="return confirm('Delete Data ?')" href="{{ url('dashboard/comment/delete/'.$pb->id_comments) }}">Delete</a>
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
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Comment</h5>
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
function view(id_comment) {
    
    var req = $.ajax({
        url: "{{ URL::to('dashboard/comment/show') }}",
        data: "id_comment="+id_comment,
        type: "get",
        dataType: "html"
    });

    req.done(function(output){
        $('#form-edit').html(output)
    })
}

function viewRead(id_comment) {
    
    var req = $.ajax({
        url: "{{ URL::to('dashboard/comment/showRead') }}",
        data: "id_comment="+id_comment,
        type: "get",
        dataType: "html"
    });

    req.done(function(output){
        $('#form-edit').html(output)
    })
}
</script>
@endsection

