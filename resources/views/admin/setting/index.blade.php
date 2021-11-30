@extends('admin.template.index')

@section('content')
<form action="{{ url('dashboard/setting/save') }}" method="post" enctype="multipart/form-data">
    @csrf
<div class="card-body">
    <div class="row">
       
        <div class="col-md-4 col-lg-4">
            
            <div class="form-group">
                <label for="exampleFormControlFile1">Logo Image</label>
                @error('file')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
            </div>

            
            @if ($setting !== null && $setting->logo !== '' )
                <div class="form-group">
                    <img src="{{ url('assets/image/'.$setting->logo) }}" class="avatar-img">
                    <a  onclick="return confirm('Delete logo ?')" href="{{ url('dashboard/setting/delete/'.$setting->id_web) }}">Delete Logo</a>
                </div>

            @endif
          
        </div>
        <div class="col-md-8 col-lg-8">	
            <div class="form-group">
                @error('name_web')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="exampleFormControlFile1">Title Web</label>

                @if ($setting !== null)
                    <input type="text" name="name_web" class="form-control" value="{{ $setting->name_web }}" id="exampleFormControlFile1">
                @else
                    <input type="text" name="name_web" class="form-control" id="exampleFormControlFile1">
                @endif
               
            </div>
            
            <div class="form-group">
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="exampleFormControlFile1">Description</label>

                @if ($setting !== null)
                    <textarea class="form-control" name="description" cols="30" rows="10">{{ $setting->description }}</textarea>
                @else
                    <textarea class="form-control" name="description" cols="30" rows="10"></textarea>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
       
    </div>
</div>
</form>

@endsection
