<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller       
{
    public function index()
    {
       $users = User::paginate(6);
       return view("home", compact('users'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("adduser");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //First Method**********************************
        // $user = new User;

        // $user->name = $request->username;
        // $user->email = $request->useremail;
        // $user->age = $request->userage;
        // $user->city = $request->usercity;

        // $user->save();

        //Second Method*******Mass Assignment*************




        $request->validate([
            'username'=>'required|string',
            'useremail'=>'required|email',
            'userage'=>'required|numeric',
            'usercity'=>'required|alpha',
        ]);


        User::create([
            'name'=>$request->username,
            'email' => $request->useremail,
            'age' => $request->userage,
            'city' => $request->usercity,
        ]);

        return redirect()->route('user.index')
                         ->with('status', 'New User Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        $users = User::find($id);
        return view("viewuser", compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $users = User::find($user->id);
        return view("updateuser", compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $users = User::find($id);

        // $users->name = $request->username;
        // $users->email = $request->useremail;
        // $users->age = $request->userage;
        // $users->city = $request->usercity;

        // $users->save();

        $request->validate([
            'username'=>'required|string',
            'useremail'=>'required|email',
            'userage'=>'required|numeric',
            'usercity'=>'required|alpha',
        ]);


        $user =User::where('id', $id)
                    ->update([
                        'name'=>$request->username,
                        'email' => $request->useremail,
                        'age' => $request->userage,
                        'city' => $request->usercity,
                    ]);

        return redirect()->route('user.index')
                         ->with('status', 'User updated Successfully');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $users=User::find($id);
        // $users->delete();

        User::destroy($id);


        return redirect()->route('user.index')
        ->with('status', 'Deleted Successfully');
    }
}
