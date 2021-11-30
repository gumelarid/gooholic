<div class="comment">
    <div class="text-center">
        <h2>{{ $comment->title }}</h2>
    </div>
    <hr>
    <div class="media">
        <div class="media-body">
          <h5 class="mt-0"><strong>Name: </strong>  {{ $comment->name }} | <span><strong>Email: </strong> {{ $comment->email }}</span></h5>
          <strong>Comment: </strong> {!! $comment->comments !!}
        </div>
    </div>
    @if ($reply !== null)
    <br>
    <div class="ml-5 media">
        <div class="media-body">
            <h5 class="mt-0"><strong>Name: </strong>  {{ $reply->name }} | <span><strong>Email: </strong> {{ $reply->email }}</span></h5>
            <strong>reply: </strong> {!! $reply->comments !!}
          </div>
    </div>
    @endif
</div>
<hr>
<br>
@if ($reply == null)
<form method="POST" action="{{ url('dashboard/comment/reply') }}">
    @csrf
    <input type="hidden" name="id_article" class="form-control" value="{{ $comment->id_article }}">
    <input type="hidden" name="id_comment" class="form-control" value="{{ $comment->id_comments }}">
    <div class="col-md-12">
        @error('comment')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="comment">Comments</label>
        <div class="form-group">
            <div class="form-line">
                <textarea name="comment" id="comment" class="form-control" cols="30" rows="10" required></textarea>
            </div>
        </div>
    </div>
    <br>
    <div class="com-md-12">
        <input type="submit" value="Reply" class="btn btn-primary m-t-15 waves-effect">
        <a href="{{ url('dashboard/comment') }}"  class="btn btn-danger m-t-15 waves-effect"> Back</a>
    </div>
</form>
@endif

