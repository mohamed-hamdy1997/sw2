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
            </div>

        </div>

    </div>

@endsection
