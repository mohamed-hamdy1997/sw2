@extends('layouts.app')
@section('content')
    <div class="row container">
        <div class="col-sm-8" style="margin: auto;">

            <div class="panel panel-primary">
                <div class="panel-heading">

                    <h3 class="panel-title">{{$post->title}}</h3>
                </div>
                <div class="panel-body">

                    <div class="text-center">
                        <p class="w-75 text-left m-auto"> {{$post->body}}</p>

                        @if($post->post_image)
                            <img src="{{ URL::to('/') }}/uploaded/images/{{$post->post_image}}" class="img-thumbnail m-auto d-block w-75 mh-60" alt="{{$post->post_image}}" style="width:50%;height:50%" >
                        @endif

                        @if($post->post_video)

                            <video width="320" height="240" controls style="display: block;" class="m-auto d-block w-75">
                                <source src="{{ URL::to('/') }}/uploaded/videos/{{$post->post_video}}" type="video/mp4">
                                <source src="{{ URL::to('/') }}/uploaded/videos/{{$post->post_video}}" type="video/ogg">
                                Your browser does not support the video tag.
                            </video>
                        @endif

                        @if($post->post_file)
                            <a href="{{ URL::to('/') }}/uploaded/files/{{$post->post_file}}" class="m-auto d-block w-75">{{$post->post_file}}</a>
                            {{--<object data="{{ URL::to('/') }}/uploaded/files/{{$post->post_file}}" type="application/pdf" width="100%" height="700px" style="margin-top: 100px;">{{$post->post_file}}</object>--}}
                          @endif

                    </div>

                    <div class="text-center" style="  display:block">
                        <span class="label label-danger">created at : {{$post->created_at}}  </span>
                        <a href="/user/{{$post->user_id}}/posts"><span class="label label-info">  by {{$post->user->name}}</span></a>
                        @if (!\auth::guest())
                            @if((auth()->user()->id == $post->user_id) || (auth()->user()->type == 'admin') )

                                <div style="  display:inline-block">
                                    <a href="/posts/{{$post->id}}/edit"><i class="fa fa-edit"></i></a>
                                    <a href="{{ action('PostsController@destroy',$post->id),'/destroy' }}"onclick="if(!confirm('Do you Delete This Post ?')) return false"><i class="fa fa-trash"></i></a>
                                </div>
                    </div>
                             @endif
                        @endif
                </div>
                <hr>
                    <div class="mt-3 m-4">
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
                                   if ($like->like==1 && $like->user_id == Auth::user()->id){$like_status = "btn-success";}
                                   if ($like->like==0 && $like->user_id == Auth::user()->id){$dislike_status = "btn-danger";}
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

                        <button class="btn btn-secondary btn-sm ml-5"><a href="#addComment" class="text-white"> Add Comment </a></button>


                    </div>
                    {{--////////////////////--}}
                    <div class="mt-3 text-left">
                        @foreach($post->comments as $comment)
                            <div class=" bg-light p-3 rounded-12">
                                <h4>
                                    @if(Auth::user()->user_image)
                                        <img src="{{ URL::to('/') }}/uploaded/profile_images/{{$comment->user->user_image}}" class="img-thumbnail mr-1 p-0" style="max-width: 27px;max-height: 27px;padding: 1px !important;" >
                                    @endif
                                    <a href="/user/{{$comment->user_id}}/posts">{{$comment->user->name}} </a>:
                                    @if((auth()->user()->id == $post->user_id) || (auth()->user()->id == $comment->user_id) || (auth()->user()->type == 'admin') )
                                            <a href="{{ action('CommentController@destroyComment',$comment->id),'/destroyComment' }}" class="float-right" onclick="if(!confirm('Do you Delete This Comment ?')) return false"><i class="fa fa-trash"></i></a>
                                    @endif
                                </h4>
                                <p>{{$comment->comment_body}}</p>
                                <span class="text-secondary mark">{{$comment->created_at}}</span>

                            </div>
                            <hr>
                        @endforeach
                    </div>
                    <div>

                        <form action="/posts/{{$post->id}}/addComment" method="post">
                            {{csrf_field()}}
                            <div class="form-group m-lg-4">
                                <label for="usr">Add Comment</label>
                                <textarea name="body" id="addComment" cols="50" rows="2" class="form-control" required maxlength="100"></textarea>
                                <br>

                                <input type="submit" value="Add Comment" class="btn btn-primary">
                            </div>


                        </form>
                    </div>
                    {{--/////////////////////--}}

                </div>
            </div>

        </div>

    </div>

@endsection
