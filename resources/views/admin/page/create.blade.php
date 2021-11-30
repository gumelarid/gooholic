@extends('admin.template.index')

@section('content')
<link href="{{ url('assets/plugin/ckeditor/plugins/codesnippet/lib/highlight/styles/default.css') }}" rel="stylesheet">

    <div class="card-body">
        <form method="POST" action="{{ url('dashboard/page/store') }}">
        @csrf
        <div class="row">
            <div class="col-md-8">
                @error('slug')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group form-floating-label">
                    <input name="slug" id="slug" type="text" class="form-control input-border-bottom text-primary font-italic" required>
                    <label for="inputFloatingLabel" class="placeholder">url</label>
                </div>

                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group form-floating-label">
					<input name="title" id="title" type="text" class="form-control input-border-bottom" required onkeyup="createTextSlug()" autofocus>
					<label for="inputFloatingLabel" class="placeholder">Title Page</label>
				</div>

              
                
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    <a href="{{ url('dashboard/page') }}" class="btn btn-sm btn-danger">Back</a>
                </div>

                @error('status')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group form-floating-label">
                    <select name="status" class="form-control input-border-bottom">
                        <option>---- Select Status ----</option>
                        <option value="0">Draf</option>
                        <option value="1">Publish</option>
                    </select>
				</div>
            </div>
            
            <div class="col-md-12 mt-5">
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="inputFloatingLabel" class="placeholder">Description</label>
                    <textarea name="description" id="editor" class="form-control input-border-bottom"></textarea>
				</div>
            </div>
        </div>
        </form>
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