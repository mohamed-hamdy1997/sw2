+@extends('layouts.app')
@section('content')
    <div class="container">


        <h2>Add User</h2>

        <form action="/" method="post" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" required >
            </div>

            <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" class="form-control" required >
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Type</label>
                <select name="user-type" id="" required>
                    <option disabled selected >- User Type -</option>
                    <option value="admin">Admin</option>
                    <option value="User">User</option>
                </select>
            </div>
            <input type="submit" class="btn btn-primary btn-lg" value="Add">
        </form>
    </div>
    @endsection