<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function index()
    {   
        // $permissions = Permission::orderBy('id','ASC')->paginate(5);
        /*return view('permissions.index', [
            'permissions' => $permissions
        ]);*/
        
        return view('permissions.index');
    }

    public function create() 
    {   
        return view('permissions.create');
    }

    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required|unique:permissions'
        ]);
        Permission::create($request->only('name'));
        return redirect()->route('permissions.index')->withSuccess("Tạo quyền thành công");
    }

    public function edit(Permission $permission)
    {
        return view('permissions.edit', [
            'permission' => $permission
        ]);
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,'.$permission->id
        ]);
        $permission->update($request->only('name'));
        return redirect()->route('permissions.index')->withSuccess("Sửa quyền thành công");
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->withSuccess("Xóa quyền thành công");
    }
}
