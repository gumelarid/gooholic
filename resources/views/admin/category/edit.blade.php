
            <form method="POST" action="{{ url('dashboard/category/update') }}">
                @csrf
                <input type="hidden" name="id_category" class="form-control" value="{{ $category->id_category }}">
                <div class="col-md-12">
                    @error('url')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="category">Url Category</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="url" id="url" class="form-control" placeholder="Enter slug category" value="{{ $category->slug_category }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    @error('category')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="category">Category Name</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="category" id="category" class="form-control" placeholder="Enter your category" value="{{ $category->category }}">
                        </div>
                    </div>
                </div>
                <br>
                <div class="com-md-12">
                    <input type="submit" value="Update category" class="btn btn-primary m-t-15 waves-effect">
                    <a href="{{ url('dashboard/category') }}"  class="btn btn-danger m-t-15 waves-effect"> Back</a>
                </div>
            </form>
       