<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use PhpParser\Node\Stmt\TryCatch;


use DB;

class PermissionController extends Controller
{

    function __construct()
    {
        $this->middleware('role:Super-Admin');
    }

    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index(Request $request)
    {
        $permissions = Permission::orderBy('id', 'DESC')->paginate(50);
        $parents = Permission::where('parents', 0)->get();
        return view('permissions.index', compact('permissions', 'parents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        $permissions = Permission::where('parents', 0)->get();
        return view('permissions.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     *
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|unique:permissions',
            'show_name' => '',
            'parent' => ''
        ]);
        Permission::Create(
            [
                'name' => $request->name,
                'show_name' => $request->show_name,
                'parents' => $request->parents,
            ]
        );

        session()->flash('success', 'Permission đã tạo thành công!');


        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     *
     */
    public function edit(Permission $permission)
    {
        $permissions = Permission::where('parents', 0)->get();
        $selectedValue = $permission->parents;
        return view('permissions.edit', compact('permission', 'permissions', 'selectedValue'));
    }

    public function update(Request $request, Permission $permission)
    {
        $permission->update($request->all());
        session()->flash('success', 'Permission đã được cập nhật thành công!');

        return redirect()->route('permissions.index');
    }
    public function destroy($id)
    {
        $permission = Permission::find($id);
        if (auth()->id() == $id) {
            $notification = array(
                'message' => "You cannot delete yourself",
                'alert-type' => 'error'
            );
            return redirect()->route('permissions.index')
                ->with($notification);
        }
        if ($permission->hasRole('Super-Admin')) {
            $notification = array(
                'message' => "You have no permission for delete this permission",
                'alert-type' => 'error'
            );
            return redirect()->route('permissions.index')
                ->with($notification);
        }
        $permission->delete();

        return redirect()->route('permissions.index');
    }
}
