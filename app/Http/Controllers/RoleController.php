<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RoleController extends Controller
{
    public function index()
    {
        return view('role.index', [
            'users' => User::all(),
            "roles" => \Spatie\Permission\Models\Role::all(),
            "title" => "Role",
        ]);
    }

    public function update(Request $request, User $user)
    {
        $user->syncRoles($request->roles);
        return response()->json([
            "user" => $user,
            "request" => $request->roles,
            "message" => "Role berhasil diubah",
        ]);
    }
}
