@extends('front.template.index')

@section('content')
<?php $reply = \App\Models\CommentModel::where('is_publish', '1')->where('id_article', $article->id_article)->get(); ?>
<div class="col-lg-12 mb-5">
    <div class="single-blog-item">
        <img src="{{ url('assets/') }}/image/article/{{ $article->cover }}" alt="" class="img-fluid">

        <div class="blog-item-content mt-5">
            <div class="blog-item-meta mb-3">
                <span class="text-color-2 text-capitalize mr-3"><a href="{{ url('/category/'.$article->slug_category) }}"><i class="icofont-tag mr-1"></i> {{ $article->category }}</a></span>
                <span class="text-muted text-capitalize mr-3"><i class="icofont-eye mr-2"></i>{{ $article->view }} views</span>
                <span class="text-black text-capitalize mr-3"><i class="icofont-calendar mr-2"></i> {{ date("d M Y", strtotime($article->created_at)) }}</span>
            </div> 

            <h2 class="mb-4 text-md"><a href="{{ url('/blog/'.$article->slug_article) }}">{{ $article->title }}</a></h2>

            <div>{!! $article->description !!}</div>

            <div class="mt-5 clearfix">
                {{-- <ul class="float-left list-inline tag-option"> 
                    <li class="list-inline-item"><a href="#">Advancher</a></li>
                    <li class="list-inline-item"><a href="#">Landscape</a></li>
                    <li class="list-inline-item"><a href="#">Travel</a></li>
                </ul>         --}}

                <ul class="float-right list-inline">
                    <li class="list-inline-item"> Share: </li>
                    <li class="list-inline-item"><a href="#" target="_blank"><i class="icofont-facebook" aria-hidden="true"></i></a></li>
                    <li class="list-inline-item"><a href="#" target="_blank"><i class="icofont-twitter" aria-hidden="true"></i></a></li>
                    <li class="list-inline-item"><a href="#" target="_blank"><i class="icofont-pinterest" aria-hidden="true"></i></a></li>
                    <li class="list-inline-item"><a href="#" target="_blank"><i class="icofont-linkedin" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="comment-area mt-4 mb-5">
        <h4 class="mb-4">{{ $comments == null ? 0 : count($comments) }} Comments </h4>
        <ul class="comment-tree list-unstyled">
            @foreach ($comments as $com)
                <?php 
                    if($com->id_parent !== '' || $com->id_comments == $com->id_parent ){
                        $id = $com->id_parent;
                        $nm = $com->name;
                        $em = $com->email;
                        $dt = date("d M Y", strtotime($com->created_at));
                        $cm = $com->comments;
                    }
                
                ?>
                @if ($com->id_parent == '')
                    <li class="mb-5">
                        <div class="comment-area-box">
                            <div class="comment-thumb float-left">
                                <img alt="" src="{{ url('/front') }}/images/blog/testimonial1.jpg" class="img-fluid">
                            </div>

                            <div class="comment-info">
                                <h5 class="mb-1">{{ $com->name }}</h5>
                                <span>{{ $com->email }}</span>
                                <span class="date-comm">| Posted {{ date("d M Y", strtotime($com->created_at)) }}</span>
                            </div>
                            {{-- <div class="comment-meta mt-2">
                                <a href="#"><i class="icofont-reply mr-2 text-muted"></i>Reply</a>
                            </div> --}}

                            <div class="comment-content mt-3">
                                {!! $com->comments !!}
                            </div>
                        </div>

                        @if ($id == $com->id_comments)
                        <hr>
                        <ul class="ml-5 comment-tree list-unstyled">
                            <li class="mb-5">
                                <div class="comment-area-box">
                                    <div class="comment-thumb float-left">
                                        <img alt="" src="{{ url('/front') }}/images/blog/testimonial1.jpg" class="img-fluid">
                                    </div>
            
                                    <div class="comment-info">
                                        <h5 class="mb-1">{{ $nm }}</h5>
                                        <span>{{ $em }}</span>
                                        <span class="date-comm">| Reply {{ $dt }}</span>
                                    </div>
            
                                    <div class="comment-content mt-3">
                                        {!! $cm !!}
                                    </div>
                                </div>
                            </li>
                        </ul>
                        @endif
                    </li>        
                @endif
            @endforeach
        </ul>
    </div>
</div>


<div class="col-lg-12">

    @if(Session::has('message'))
        <h4>{{ Session::get('message') }}</h3> 
    @endif

    <form action="{{ url('/comment') }}" method="POST" class="comment-form my-5" id="comment-form">
        @csrf
        <input type="hidden" name="id_article" value="{{ $article->id_article }}">
        <h4 class="mb-4">Write a comment</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input class="form-control" type="text" name="name" id="name" placeholder="Name:" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input class="form-control" type="email" name="mail" id="mail" placeholder="Email:" required>
                </div>
            </div>
        </div>


        <textarea class="form-control mb-4" name="comment" id="comment" cols="30" rows="5" placeholder="Comment"></textarea>

        <input class="btn btn-main-2 btn-round-full" type="submit" name="submit-contact" id="submit_contact" value="Submit Message">
    </form>
</div>
@endsection