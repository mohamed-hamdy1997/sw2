@extends('layouts.app')

@section('content')
    <div class="row container">

        <div class="col-sm-8" style="margin: auto;">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">title</h3>
                </div>
                <div class="panel-body">

                    <div class="text-center">
                        <p class="w-75 text-left m-auto"> body</p>


                        <img src="https://loremflickr.com/320/240" class="img-thumbnail m-auto d-block w-75 mh-60"  style="width:50%;height:50%" >


                        <video width="320" height="240" controls style="display: block;" class="m-auto d-block w-75">
                            <source src="http://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                            <source src="http://www.w3schools.com/html/mov_bbb.mp4" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>

                        <a href="#" class="m-auto d-block w-75">post file</a>
                    </div>

                    <div class="text-center" style="  display:block">
                        <span class="label label-danger">created at : 12:00  </span>
                        <span class="label label-info">  by name</span>


                        <div style="  display:inline-block">
                            <a href="/posts/{{$post->id}}/edit"><i class="fa fa-edit"></i></a>
                            <a href="{{ action('PostsController@destroy',$post->id),'/destroy' }}"onclick="if(!confirm('Do you Delete This Post ?')) return false"><i class="fa fa-trash"></i></a>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection
