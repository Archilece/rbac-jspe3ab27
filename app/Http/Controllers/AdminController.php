<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserInfo;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function manageUsers(){
        $users = User::select('id','name','email')->paginate(10);
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.manageUsers')->with(compact('users'));
    }
    public function updateUser($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.updateUser', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            // 'user_name' => 'required|string|max:255',
            // 'user_email' => 'required|email|max:255',
            // 'user_firstname' => 'required|string|max:255',
            // 'user_lastname' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($id);
        
        // $user->name = $request->input('user_name');
        // $user->email = $request->input('user_email');
        // $user->userInfo->user_firstname = $request->input('user_firstname');
        // $user->userInfo->user_lastname = $request->input('user_lastname');
        // $user->save();
        // $user->userInfo->save();

        //$user->user()->sync([$request->input('firstname')]);
        $user->roles()->sync([$request->input('role_id')]);

        return redirect()->route('usertool')->with('success', 'User updated successfully.');
    }
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('usertool')->with('success', 'User deleted successfully.');
    }
}
