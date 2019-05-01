@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Update Profile</h2>

        <form action="#" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label>Full Name<span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" required  >
            </div>

            <div class="form-group">
                <label>E-mail<span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control" required  >
            </div>

            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="password" class="form-control" >
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" >
            </div>

            <div class="form-group">
                <label>User Image</label>
                <input type="file" class="" name="user_image">
            </div>

            <input type="submit" class="btn btn-primary btn-light" value="Update">
        </form>
    </div>
@endsection
