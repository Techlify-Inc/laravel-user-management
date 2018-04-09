<?php

namespace TechlifyInc\LaravelUserManagement\Controllers;

use App\User;
use App\Http\Controllers\Controller;

use TechlifyInc\LaravelRbac\Models\Role;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->hasPermission("user_read"))
        {
            return response()->json(['error' => "You are unauthorized to perform this action. "], 401);
        }

        $users = User::with('roles')->get();

        return array("items" => $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->hasPermission("user_create"))
        {
            return response()->json(['error' => "You are unauthorized to perform this action. "], 401);
        }

        $this->validate(request(), [
            "name" => "required",
            "email" => "required|email",
            "password" => "required",
        ]);

        $user = new User();
        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        if (!$user->save())
        {
            return response()->json(['error' => "Failed to add the new user. "], 422);
        }

        $roles = request('roles') ?: array();
        if (is_array($roles))
        {
            foreach ($roles as $rid => $selected)
            {
                if (!$selected)
                {
                    continue;
                }
                $role = Role::find($rid);
                $user->assignRole($role->slug);
            }
        }

        return array("item" => $user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (!auth()->user()->hasPermission("user_read"))
        {
            return response()->json(['error' => "You are unauthorized to perform this action. "], 401);
        }

        return array("item" => $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (!auth()->user()->hasPermission("user_update"))
        {
            return response()->json(['error' => "You are unauthorized to perform this action. "], 401);
        }

        $this->validate(request(), [
            "name" => "required",
            "email" => "required",
        ]);

        $user->name = request('name');
        $user->email = request('email');

        if (request('password') && "" != trim(request("password")) && null != request("password"))
        {
            $user->password = bcrypt(request('password'));
        }

        if (!$user->save())
        {
            return response()->json(['error' => "Failed to add the new user. "], 422);
        }

        $user->roles()->detach();

        $roles = request('roles') ?: array();
        if (is_array($roles))
        {
            foreach ($roles as $rid => $selected)
            {
                if (!$selected)
                {
                    continue;
                }
                $role = Role::find($rid);
                $user->assignRole($role->slug);
            }
        }

        return array("item" => $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (!auth()->user()->hasPermission("user_delete"))
        {
            return response()->json(['error' => "You are unauthorized to perform this action. "], 401);
        }

        /* Delete all related objects */
        $user->roles()->detach();

        /* Delete the user object */
        $deleted = $user->delete();

        return array("item" => $user, "success" => $deleted);
    }

    /**
     * Change the the current user password
     * 
     * @todo Check if the logged in user is the same as the user changing the password
     * 
     */
    public function user_password_change_own()
    {
        $this->validate(request(), [
            "newPassword" => "required",
            "currentPassword" => "required",
        ]);

        $user = User::find(auth()->id());

        /* Check if the current password entered is the actual current password */
        if (!Hash::check(request('currentPassword'), $user->password))
        {
            return response()->json(['error' => "Invalid current password entered. "], 422);
        }

        $user->password = bcrypt(request('newPassword'));

        if (!$user->save())
        {
            return response()->json(['error' => "Failed to add the new user. "], 422);
        }

        return array("item" => $user, "success" => true);
    }

}