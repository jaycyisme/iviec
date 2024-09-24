<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UpdateUserRequest;

class UsersController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function show(User $user) 
    {
        return view('users.show', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray()
        ]);
    }

    public function edit(User $user) 
    {
        return view('users.edit', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => Role::latest()->get()
        ]);
    }

    public function update(User $user, UpdateUserRequest $request) 
    {
        $user->update($request->validated());
        $user->syncRoles($request->get('role'));
        return redirect()->route('users.index')->withSuccess('Tài khoản đã được cập nhật thành công.');
    }

    public function destroy(User $user) 
    {
        $user->delete();
        return redirect()->route('users.index')->withSuccess('Tài khoản đã được xóa thành công.');
    }
}
