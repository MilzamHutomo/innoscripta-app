<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteUser;
use App\Http\Requests\PostUser;
use App\Http\Requests\UpdateUser;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::all());
    }

    public function find($id)
    {
        $check = User::where('id',$id)->first();
        if($check){
            return UserResource::make($check);
        }
        return response()->json([
            'success' => false,
            'message' => 'User not found'
        ],400);
    }

    public function store(PostUser $req)
    {
        $check = User::where('email',$req->email)->first();

        if(!$check){
            $create = User::create([
                'name' => $req->name,
                'email' => $req->email,
                'role' => $req->role,
                'password' => bcrypt("12345678")
            ]);
            return response()->json([
                'success' => true,
                'data' => UserResource::make($create)
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Email Already Exists'
        ],400);

    }

    public function update(UpdateUser $req, $id)
    {
        $check = User::where('id',$id)->first();
        if($check){
            $update = User::where('id',$id)->update($req->all());
            return response()->json([
                'success' => true,
                'data' => UserResource::make($check)
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'User not found'
        ],400);
    }

    public function delete(DeleteUser $req)
    {
        $users = User::find($req->ids);
        foreach($users as $user){
            $user->delete();
        }
        return response()->json([
            'success' => true,
            'message' => 'Delete Successfully'
        ]);
    }
}
