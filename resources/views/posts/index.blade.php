@extends('layouts.app')
@section('content')

            <div class="content">
                <div class="container">
                <h1>Posts</h1>

@if(count($posts) >0)

 <div class="row container">
    @foreach($posts as $post)
  <div class="col-sm-4">

  <div class="panel panel-primary" style="overflow: hidden;">
  <div class="panel-heading">
    <h3 class="panel-title">{{$post->title}}</h3>
  </div>
  <div class="panel-body">
    <p>{{substr($post->body,0,50)}}</p>

      @if($post->post_image)
 <img src="{{ URL::to('/') }}/uploaded/images/{{$post->post_image}}" class="img-thumbnail" alt="{{$post->post_image}}" style="width:50%;height:50%" >
      @endif

   <span class="label label-danger">created at : {{$post->created_at}}  </span>
     <span class="label label-info"> <a href="/user/{{$post->user->id}}/posts" class="text-white"> by {{$post->user->name}}</a></span>

      {{--<a href="/posts/{{$post->id}}/view" class="float-right">View Post</a>--}}

      {{---------start like -------}}
      <div class="mt-3">
          {{--Like--}}

          @php
              $like_count=0;
              $dislike_count = 0;
              $like_status = "btn-secondry";
              $dislike_status = "btn-secondry";
          @endphp

          @foreach($post->likes as $like)
              @php
                  if ($like->like==1){$like_count++;}
                  if ($like->like==0){$dislike_count++;}
                  if(auth()->user()){
                      if ($like->like==1 && $like->user_id == Auth::user()->id){$like_status = "btn-success";}
                      if ($like->like==0 && $like->user_id == Auth::user()->id){$dislike_status = "btn-danger";}
                  }
              @endphp

          @endforeach
          {{--like button --}}
          <button type="button" data-postid="{{$post->id}}_l" data-like="{{$like_status}}"  class="like btn {{$like_status}}">

              <span class="fa fa-thumbs-up"></span>
              <b>
                  <span class="like_count">{{$like_count}}</span>
              </b>
          </button>

          <button type="button" data-postid="{{$post->id}}_d" data-like="{{$dislike_status}}" class="dislike btn {{$dislike_status}}">

              <span class="fa fa-thumbs-down"></span>
              <b>
                  <span class="dislike_count">{{$dislike_count}}</span>
              </b>
          </button>

          <a href="/posts/{{$post->id}}/view" class="float-right">View Post</a>

      </div>
      {{-------------------- end like ----------}}
  </div>

</div>

  </div>


  @endforeach


</div>

</div>

</div>
            {{$posts->links()}}

@else


<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Oh  !</strong> <a href="#" class="alert-link">No posts !</a> and try submitting again.
</div>



@endif

           @endsection
