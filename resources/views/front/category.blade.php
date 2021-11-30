@extends('front.template.index')

@section('pageTitle')
<section class="page-title bg-1">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="block text-center">
            <h1 class="text-capitalize mb-5 text-lg">{{ $title }}</h1>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('content')
<div class="row">
    @foreach ($article as $post)
        <div class="col-lg-12 col-md-12 mb-5">
            <div class="blog-item">
                <div class="blog-thumb">
                    <img src="{{ url('assets/') }}/image/article/{{ $post->cover }}" alt="" class="img-fluid ">
                </div>

                <div class="blog-item-content">
                    <div class="blog-item-meta mb-3 mt-4">
                        <span class="text-muted text-capitalize mr-3"><a href="{{ url('/category/'.$post->slug_category) }}"><i class="icofont-tag mr-1"></i> {{ $post->category }}</a></span>
                        <span class="text-muted text-capitalize mr-3"><i class="icofont-eye mr-2"></i>0 View</span>
                        <span class="text-black text-capitalize mr-3"><i class="icofont-calendar mr-1"></i> {{ date("d M Y", strtotime($post->created_at)) }}</span>
                    </div> 

                    <h2 class="mt-3 mb-3"><a href="{{ url('/blog/'.$post->slug_article) }}">{{ $post->title }}</a></h2>

                    <p class="mb-4">{!! (str_word_count($post->description) > 300 ? substr($post->description,0,200)."..." : $post->description) !!}</p>

                    <a href="{{ url('/blog/'.$post->slug_article) }}" class="btn btn-main btn-icon btn-round-full">Read More <i class="icofont-simple-right ml-2  "></i></a>
                </div>
            </div>
        </div>
    @endforeach
    
</div>
@endsection


