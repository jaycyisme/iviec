<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    public function index()
    {   
        return view('roles.index');
    }

    public function create()
    {
        $permissions = Permission::get();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['name' => $request->get('name')]);
        $role->syncPermissions($request->get('permission'));
    
        return redirect()->route('roles.index')->with('success','Vai trò đã được tạo thành công');
    }

    public function show(Role $role)
    {
        $role = $role;
        $rolePermissions = $role->permissions;
    
        return view('roles.show', compact('role', 'rolePermissions'));
    }

    public function edit(Role $role)
    {
        $role = $role;
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $permissions = Permission::get();
    
        return view('roles.edit', compact('role', 'rolePermissions', 'permissions'));
    }

    public function update(Role $role, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'permission' => 'required',
        ]);
        
        $role->update($request->only('name'));
        $role->syncPermissions($request->get('permission'));
        return redirect()->route('roles.index')->with('success','Vai trò đã được cập nhật thành công');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success','Vai trò đã được xóa thành thành công');
    }
}
