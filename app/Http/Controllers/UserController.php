<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\User;
use App\Post;
use Tymon\JWTAuth\JWTAuth;
use JWTAuthException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if(auth()->user()->type == 'admin') {
            $users = User::orderBy('created_at', 'desc')->paginate(5);
            return view('/admin/users', compact('users'));
        }else{
            return redirect()->back()->with('error', 'Un Authenticated');
        }
    }

}
