<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use DB;

class RoleController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(50);
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $parentIds = DB::table('permissions')->where('parents', 0)->pluck('id');
        $parents = Permission::where('parents', 0)->get();
        $permission = Permission::whereIn('parents', $parentIds)->get();
        return view('roles.create', compact('permission', 'parents'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        session()->flash('success', 'User đã cập nhật thành công!');

        return redirect()->route('roles.index');
    }

    public function show($id)
    {
        return redirect()->route('roles.index');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        if ($role->name == 'Super-Admin') {
            $notification = array(
                'message' => "You have no permission for edit this role",
                'alert-type' => 'error'
            );
            return redirect()->route('roles.index')
                ->with($notification);
        }
        $parentIds = Permission::where('parents', 0)->pluck('id');
        $parents = Permission::where('parents', 0)->get();
        $permission = Permission::whereIn('parents', $parentIds)->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('roles.edit', compact('role', 'permission', 'rolePermissions', 'parents'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => [
                'required',
                Rule::unique('roles', 'name')->ignore($id)
            ],
            'permission' => 'required',
        ]);

        $role = Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));
        session()->flash('success', 'Vai trò đã cập nhật thành công!');

        return redirect()->route('roles.index');
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        if (auth()->user()->roles->find($id)) {
            $notification = array(
                'message' => 'You have no permission for delete this role',
                'alert-type' => 'error'
            );
            return redirect()->route('roles.index')
                ->with($notification);
        }
        if ($role->name == "Super-Admin") {
            $notification = array(
                'message' => 'You have no permission for delete Super-Admin role',
                'alert-type' => 'error'
            );
            return redirect()->route('roles.index')
                ->with($notification);
        }
        // Remove all related permissions from the role
        $role->permissions()->detach();

        // Delete the role
        $role->delete();
        return redirect()->route('roles.index');
    }
}
