<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Like;
use App\User;
use App\Post;
use Tymon\JWTAuth\JWTAuth;
use JWTAuthException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $users =   User::orderBy('created_at','desc')->paginate(5);
        return  view('/admin/users',compact('users'));

    }

    public function getToken() {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    public function addUser(Request $request)
    {

        if(auth()->user()->type == 'admin'){

            $this->validate($request ,[
                'name' => 'required |string | max:50 | min:5',
                'email' => 'required |string|email|max:255| unique:users',
                'password'=>'required|confirmed|string|min:6',
                'password_confirmation'=>'sometimes|required_with:password',
                'user-type' => 'required'
            ]);
            $user = new User;
            $user->name = $request->input('name');
            $user->password = Hash::make($request->input('password'));
            $user->email = $request->input('email');
            $user->type = $request->input('user-type');
            $user->user_image ="profile_default_image.jpg";

            // send mail activation
            $token = $this->getToken();
            $request->request->add(['token' => $token]);
            $user->token= $token;
            $data = array('name' => $request['name'], 'email' => $request['email'],  'activation_link' => url('/activation/' . $token));

            Mail::send('emails.email', $data, function($message) use ($data) {
                $message->to($data['email'])
                    ->subject('Activate Your Account');
                $message->from('mohamedhamdy.o1997@gmail.com');
            });

            $user->save();

            $users =   User::paginate(5);
//            return view('admin/users' , compact('users'))->with('User Added');
            return redirect('/users-deatails')->with('success','User Added');
        }else{
            return with('error','Unauthorized');
        }

    }

//    delete user
    public function destroy( $id)
    {
        if (auth()->user()->id == $id)
        {
            return redirect('users')->with('You can\'t delete Your Self!!','');
        }
        Post::where('user_id' , $id)->delete();
        Like::where('user_id' , $id)->delete();
        User::findOrFail($id)->delete();

        $users =   User::paginate(5);
        return redirect('/users-deatails')->with('success','user deleted');

    }

//    view add user page
    public function viewAdd()
    {
        return view('admin/addUser');
    }

//    view user's posts
    public function userPosts($id)
    {
        $posts =   Post::orderBy('created_at','desc')->where('user_id',$id)->paginate(5);
        return view('/posts.index' , compact('posts'));
    }

    //update profile

    public function showUpdateProfilePage($id){
        $user = User::findOrFail($id);
        return view('admin.editProfile',compact('user'));

    }
    public function updateProfile(Request $request , $id){

        $this->validate($request ,[
            'name' => 'required |string | max:50 | min:5',
            'email' => 'required |string|email|max:255',
            'user_image' => 'image|nullable|max:1024 | mimes:jpg,png,jpeg,svg',
        ]);

        if ($request->input('password')) {
            $this->validate($request, [
                'password' => 'required|confirmed|string|min:6',
                'password_confirmation' => 'sometimes|required_with:password'
            ]);
        }

        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        if ($request->input('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->email = $request->input('email');
        //upload image
        if ($request->hasFile('user_image')) {

            $filenameWithExtention = $request->file('user_image')->getClientOriginalName();
            $fileName = pathinfo($filenameWithExtention, PATHINFO_FILENAME);
            $extension = $request->file('user_image')->getClientOriginalExtension();
            $fileNameStoreImage = $fileName . '_' . time() . '.' . $extension;

            $path = $request->file('user_image')->move(base_path() . '/public/uploaded/profile_images/', $fileNameStoreImage);
            $user->user_image = $fileNameStoreImage;
        }
        $user->update();

        return redirect('/')->with('success','User Updated');

    }

}
