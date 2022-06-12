<?php

namespace App\Http\Controllers;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(new UserCollection(User::get()), 200);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
       $user = new User;
       $user->title = $request['title'];
       $user->name = $request['first_name'];
       $user->last_name = $request['last_name'];
       $user->date_of_birth = $request['date_of_birth'];
       $user->password = Hash::make($request['password']);
       $user->email = $request['email'];
       $user->phone = $request['phone'];
       $user->save();

       return response(['success' => true, "id" => $user->id], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $user = User::where('id', $id)->first();
       if(!$user){return response(['message' => 'user not found!'], 400);}
       return response(new UserResource($user), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
       $user = User::where('id', $id)->first();
       if(!$user){return response(['message' => 'user not found!'], 400);}

       if($request['title']){$user->title = $request['title'];}
       if($request['first_name']){$user->name = $request['first_name'];}
       if($request['last_name']){$user->last_name = $request['last_name'];}
       if($request['phone']){$user->phone = $request['phone'];}

       $user->save();

       return response(['success' => true], 200);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $user = User::where('id', $id)->first();
       if(!$user){return response(['message' => 'user not found!'], 400);}
       if($user->id === 1){return response(['message' => 'Admin cannot be deleted!'], 400);}
       $user->delete();

       return response(['success' => true], 200);
    }
}