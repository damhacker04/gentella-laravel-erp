<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::withCount(['permissions', 'users'])->orderBy('name')->get();
        return view('settings.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissionGroups = Permission::all()->groupBy(function ($p) {
            return explode('.', $p->name)[0] ?? 'other';
        });
        return view('settings.roles.create', compact('permissionGroups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array|min:1',
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('settings.roles.index')->with('success', 'Role berhasil ditambahkan.');
    }

    public function edit(Role $role)
    {
        $permissionGroups = Permission::all()->groupBy(function ($p) {
            return explode('.', $p->name)[0] ?? 'other';
        });
        return view('settings.roles.edit', compact('role', 'permissionGroups'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'required|array|min:1',
        ]);

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('settings.roles.index')->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy(Role $role)
    {
        abort_if($role->name === 'Admin', 403, 'Role Admin tidak dapat dihapus.');
        $role->delete();
        return redirect()->route('settings.roles.index')->with('success', 'Role dihapus.');
    }
}
