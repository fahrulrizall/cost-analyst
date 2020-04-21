<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index($user){
        $user = DB::table('users')->where('name',$user)->get();
        //dd ($user);
        return view('users.index',compact('user'));
    }

    public function getuser(Request $request)
    {
        $id = $request->input('id');
        $profile = User::find($id);
        $output = array(
            'name' => $profile->name,
            'email' => $profile->email,
            'departement' => $profile->departement,
            'position' => $profile->position,
            'education' => $profile->education,
            'address' => $profile->address,
            'avatar' => $profile->avatar 
        );
        echo json_encode($output);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'avatar' => 'mimes:jpeg,png,jpg | max:4096'
        ]);
        $unique_name = md5($request->avatar. time());
        $update = User::find($id);
        $update->update($request->all());
        if ($request->hasFile('avatar')){
            $request->file('avatar')->move('adminlte/dist/img/users',$unique_name);
            $update->avatar = $unique_name;
            $update->save();
        }
        return redirect('/profile/'.$request->name)->with('status','Profile Updated');
    }
}
