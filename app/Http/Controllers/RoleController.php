<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('customer.role.index', compact('roles'));
    }

    public function create()
    {
        return view('customer.role.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'role_name' => 'required|string',
            'description' => 'required|string'
        ]);

        // Jika berhasil

        Role::create($validate);

        return redirect()->route('roles.index')->with('success', 'Role : ' . $validate['role_name'] . ', created successfully.');
    }

    public function edit(Role $role)
    {
        return view('customer.role.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $validate = $request->validate([
            'role_name' => 'required|string',
            'description' => 'required|string'
        ]);

        // Jika berhasil validasi, maka update data

        $role->update($validate);

        return redirect()->route('roles.index')->with('success', 'Role : ' . $validate['role_name'] . ', updated successfully.');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role : ' . $role->role_name . ', Deleted successfully.');
    }
}
