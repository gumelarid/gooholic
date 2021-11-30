<div class="col-lg-4">

    <?php $category = \App\Models\CategoryModel::get() ?>
    <?php $populer = \App\Models\ArticleModel::where('is_publish', '1')->orderBy('view', 'desc')->limit(4)->get() ?>

    <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
        <div class="sidebar-widget search  mb-3 ">
            <h5>Search Here</h5>
            <form action="{{ url('/search') }}" class="search-form">
                <input type="text" name="keyword" class="form-control" placeholder="search">
                <i class="ti-search"></i>
            </form>
        </div>


        <div class="sidebar-widget latest-post mb-3">
            <h5>Popular Posts</h5>
          
            @foreach ($populer as $pItem)
                <div class="py-2">
                    <span class="text-sm text-muted">{{ date("d M Y", strtotime($pItem->created_at)) }}</span>
                    <h6 class="my-2"><a href="{{ url('/blog/'.$pItem->slug_article) }}">{{ $pItem->title }}</a></h6>
                </div>
            @endforeach
           
        </div>

        <div class="sidebar-widget category mb-3">
            <h5 class="mb-4">Categories</h5>

            <ul class="list-unstyled">
                @foreach ($category as $item)
                    <li class="align-items-center">
                        <a href="{{ url('/category/'.$item->slug_category) }}">{{ $item->category }}</a>
                    </li>
                @endforeach
            </ul>
        </div>


        {{-- <div class="sidebar-widget tags mb-3">
            <h5 class="mb-4">Tags</h5>

            <a href="#">Doctors</a>
            <a href="#">agency</a>
            <a href="#">company</a>
            <a href="#">medicine</a>
            <a href="#">surgery</a>
            <a href="#">Marketing</a>
            <a href="#">Social Media</a>
            <a href="#">Branding</a>
            <a href="#">Laboratory</a>
        </div> --}}


        

    </div>
</div>   
