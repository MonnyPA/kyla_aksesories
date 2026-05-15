<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all()->sortBy('fullname');
        return view('customer.user.index', compact('users'));
    }

     public function create()
    {
        $roles = Role::all();
        return view('customer.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id'
        ],
        [
            'fullname.required' => 'The fullname is required',
            'username.required' => 'The username is required',
            'phone.required' => 'The phone number is required',
            'email.required' => 'The email address is required',
            'password.required' => 'The password is required',
            'role_id.required' => 'The role is required',
            'password.confirmed' => 'The password confirmation does not match',
        ]);

        //create a new user
        $validate['password'] = bcrypt($validate['password']);

        User::create($validate);

        return redirect()->route('users.index')->with('success', 'User : ' . $validate['fullname'] . ', created successfully.');
    }

    // public function show(User $user)
    // {
    //     return view('costumer.user.show', compact('user'));
    // }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('customer.user.edit', compact('user','roles'));
    }

    public function update(Request $request, User $user)
    {
        // Validate the request data
        $validate = $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => ['nullable','string','min:8','confirmed', function($attribute, $value, $fail) use ($user){
                if(Hash::check($value, $user->password)){
                    $fail("Password baru tidak boleh sama dengan Password lama");
                }
            },
            ],
            'role_id' => 'required|exists:roles,id',
        ],
        [
            'fullname.required' => 'The fullname is required',
            'username.required' => 'The username is required',
            'phone.required' => 'The phone number is required',
            'email.required' => 'The email address is required',
            'role_id.required' => 'The role is required',
            'password.confirmed' => 'The password confirmation does not match'
        ]);

        //create a new user
        $validate['password'] = bcrypt($validate['password']);

        $user->update($validate);

        return redirect()->route('users.index')->with('success', 'User : ' . $validate['fullname'] . ', Update successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User : ' . $user->fullname . ', Deleted successfully.');
    }
}
