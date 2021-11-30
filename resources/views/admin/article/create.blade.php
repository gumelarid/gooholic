@extends('admin.template.index')

@section('content')
<link href="{{ url('assets/plugin/ckeditor/plugins/codesnippet/lib/highlight/styles/default.css') }}" rel="stylesheet">

    <div class="card-body">
        @error('category')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <form method="POST" action="{{ url('dashboard/article/store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-7">
                @error('slug')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group form-floating-label">
                    <input name="slug" id="slug" type="text" class="form-control input-border-bottom text-primary font-italic" value="{{ old('slug') }}" required>
                    <label for="inputFloatingLabel" class="placeholder">url</label>
                </div>

                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group form-floating-label">
					<input name="title" id="title" type="text" class="form-control input-border-bottom" required onkeyup="createTextSlug()" value="{{ old('title') }}" autofocus>
					<label for="inputFloatingLabel" class="placeholder">Judul</label>
				</div>

                
                <div class="form-group">
                    <label for="inputFloatingLabel" class="placeholder">Description</label>
                    <textarea name="description" id="editor" class="form-control input-border-bottom">{{ old('description') }}</textarea>
                </div>
              
                
            </div>
            <div class="col-md-5">
                
                <div class="form-group">
                    <label for="exampleFormControlFile1">Cover</label>
                    @error('file')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="col-md-12 mb-2">
                        <img id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                            alt="preview image" style="max-height:230px">
                    </div>
                    <input value="{{ old('file') }}" type="file" name="file" class="form-control-file" id="image" required>
                </div>
                <div class="form-group">
                    <label for="inputFloatingLabel" class="placeholder">Keterangan Singkat</label>
                    <textarea name="subject" class="form-control input-border-bottom" maxlength="250">{{ old('subject') }}</textarea>
                </div>

                <div class="form-group form-floating-label">
                    <label>Status</label>
                    @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <select name="status" class="form-control input-border-bottom" required>
                        <option>---- Pilih Status ----</option>
                        <option value="0">Draf</option>
                        <option value="1">Publish</option>
                    </select>
				</div>
                
                <div class="form-group form-floating-label">
                    <label>Categori</label> <a href="#" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-plus"></i></a>
                    @error('category')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <select name="category" class="form-control input-border-bottom" required>
                        <option>---- Pilih Category ----</option>
                        @foreach ($category as $item)
                            <option value="{{ $item->id_category }}">{{ $item->category }}</option>
                        @endforeach
                    </select>
				</div>

                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    <a href="{{ url('dashboard/article') }}" class="btn btn-sm btn-danger">Back</a>
                </div>
            </div>
            
            
        </div>
        </form>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Categori</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ url('dashboard/article/category') }}">
                @csrf
                <div class="col-md-12">
                    <div class="form-group form-floating-label">
                        <input name="category" id="category" type="text" class="form-control input-border-bottom text-primary font-italic" required>
                        <label for="inputFloatingLabel" class="placeholder">Categori</label>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Save category" class="btn btn-sm btn-primary m-t-15 waves-effect">
                    </div>
                </div>
            </form>
            <hr>
            <div class="table-responsive mt-3">
                <table id="datatables" class="display table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th>slug</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                   
                    <tbody>
                        @foreach ($category as $value)
                            <tr>
                                <td><a href="#"><span class="font-italic">{{ $value->slug_category }}</span></a></td>
                                <td>{{ $value->category }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>


 

{{-- ckeditor --}}
<script src="{{url('assets/plugins/ckeditor/ckeditor.js')}}"></script>

<script src="{{  url('assets/plugin/ckeditor/codesnippet/lib/highlight/highlight.pack.js') }}"></script>
<script>hljs.initHighlightingOnLoad();</script>



<script>
    // slug

    function createTextSlug()
    {
        var title = document.getElementById("title").value;
        document.getElementById("slug").value = generateSlug(title);
    }
    function generateSlug(text)
    {
        return text.toString().toLowerCase()
            .replace(/^-+/, '')
            .replace(/-+$/, '')
            .replace(/\s+/g, '-')
            .replace(/\-\-+/g, '-')
            .replace(/[^\w\-]+/g, '');
    }

     // ckeditor
     CKEDITOR.replace('editor', {
            // filebrowserImageBrowseUrl : "{{ url('assets/plugins/kcfinder/browse.php') }}",
            filebrowserUploadUrl: "{{ route('upload.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
            height: '250px'
        });
   
</script>
@endsection