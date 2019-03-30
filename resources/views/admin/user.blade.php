+@extends('layouts.app')
@section('content')
    <div class="card">

        <div class="card-header">Users </div>

        <div class="card-body">

            <table class="table table-borderless table-striped table-hover">
            <thead>
            <tr>
                <th>User Name</th>
                <th>User Email</th>
                <th>User Type</th>
                <th>Created Date</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>

            <tr>
                <td> <a href="#">

                            <img src="https://loremflickr.com/320/24" class="img-thumbnail mr-1 p-0" style="max-width: 27px;max-height: 27px;padding: 1px !important;" >
                      #######</a></td>
                <td>#</td>
                <td>#</td>
                <td>#</td>
                <td>

                        <a href="#" onclick="if(!confirm('Do you Delete This User ?')) return false"> <i class="fa fa-trash"></i></a>

                        </td>
            </tr>

            </tbody>
        </table>
    </div>

    </div>
@endsection