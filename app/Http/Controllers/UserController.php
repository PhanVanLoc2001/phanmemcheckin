<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StoreUserRequest;
use DB;
use Hash;
use Illuminate\Support\Arr;
class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $users = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('users'));

    }


    public function create()
    {
        if(auth()->user()->hasRole('Super-Admin')){
            $roles = Role::pluck('name','name')->all();
        }else{
            $roles = Role::pluck('name','name')->except(['name', 'Super-Admin']);
        }

        return view('users.create',compact('roles'));
    }


    public function store(StoreUserRequest $request)
    {
        $input = $request->validated();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        session()->flash('success', 'User đã được tạo thành công!');
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        if($user->hasRole('Super-Admin')){
            $notification = array(
                'message' => "You have no permission for edit this user",
                'alert-type' => 'error'
            );
            return redirect()->route('users.index')
                ->with($notification);
        }
        if(auth()->user()->hasRole('Super-Admin')){
            $roles = Role::pluck('name','name')->all();
        }else{
            $roles = Role::pluck('name','name')->except(['name', 'Super-Admin']);
        }
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));

        session()->flash('success', 'User đã cập nhật thành công!');
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if(auth()->id() == $id){
            return redirect()->route('users.index');
        }
        if($user->hasRole('Super-Admin')){
            $notification = array(
                'message' => "You have no permission for delete this user",
                'alert-type' => 'error'
            );
            return redirect()->route('users.index')
                ->with($notification);
        }
        $user->delete();
        return redirect()->route('users.index');
    }
    public function editPermissions($id)
    {
        // Lấy thông tin người dùng cần sửa quyền
        $user = User::find($id);

        // Lấy danh sách các quyền hiện có của người dùng
        $userPermissions = $user->getAllPermissions()->pluck('id')->toArray();
//        dd($userPermissions);

        // Lấy danh sách tất cả các quyền
        $permissions = Permission::all();
        $parents = Permission::where('parents', 0)->get();

        return view('users.edit_permissions', compact('user', 'userPermissions', 'permissions', 'parents'));
    }

    public function updatePermissions(Request $request, $id)
    {
        // Lấy thông tin người dùng cần sửa quyền
        $user = User::find($id);

        // Lấy danh sách quyền mới
        $permissions = $request->input('permissions');

        // Cập nhật danh sách quyền của người dùng
        $user->syncPermissions($permissions);
//        dd($user);
        return redirect()->route('users.index');
    }

}
