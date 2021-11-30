@extends('front.template.index')

@section('content')
<div class="col-lg-12 mb-5">
    <div class="single-blog-item">

        <div class="blog-item-content mt-5">

            <h2 class="mb-4 text-md"><a href="{{ url('/blog/'.$page->slug_page) }}">{{ $page->title }}</a></h2>

            <div>{!! $page->description !!}</div>

        </div>
    </div>
</div>

@endsection