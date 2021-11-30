
            <form method="POST" action="{{ url('dashboard/sosmed/update') }}">
                @csrf
                <input type="hidden" name="id_sosmed" class="form-control" value="{{ $sosmed->id_sosmed }}">
                <div class="col-md-12">
                    @error('icon')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="sosmed">icon Sosial Media</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="icon" id="sosmed" class="form-control" placeholder="Enter icon" value="{{ $sosmed->icon }}">
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    @error('sosmed')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="sosmed">Sosial Media</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="sosmed" id="sosmed" class="form-control" placeholder="Enter Name" value="{{ $sosmed->sosmed }}">
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    @error('url')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="sosmed">URL Sosial Media</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="url" id="sosmed" class="form-control" placeholder="Enter Url" value="{{ $sosmed->url }}">
                        </div>
                    </div>
                </div>
                <br>
                <div class="com-md-12">
                    <input type="submit" value="Update sosmed" class="btn btn-primary m-t-15 waves-effect">
                    <a href="{{ url('dashboard/sosmed') }}"  class="btn btn-danger m-t-15 waves-effect"> Back</a>
                </div>
            </form>
       