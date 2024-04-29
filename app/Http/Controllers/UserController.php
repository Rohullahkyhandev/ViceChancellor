<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionResource;
use App\Http\Resources\UserResource;
use App\Models\permission;
use App\Models\User;
use App\Models\UserDepartments;
use App\Models\userpermission;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Validator;

class UserController extends Controller
{

    public function validation()
    {
        $rules = [
            'name' => 'required|max:100|string',
            'photo' => 'nullable|image',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|string|confirmed',
            'position' => 'required|string|max:100',
            'user_type' => 'required',

        ];

        return $rules;
    }

    public function index()
    {

        $per_page =  request('per_page', 10);
        $sortDirection = request('sortDirection', 'DESC');
        $sortField = request('sortField', 'id');
        $search = request('search', '');
        $data = User::query()
            ->where('users.name', 'like', "%{$search}%")
            ->join('user_departments', 'users.user_departments_id', 'user_departments.id')
            ->select('users.*', 'user_departments.display_name as dname')
            ->orderBy("users.$sortField", $sortDirection)
            ->paginate($per_page);

        return UserResource::collection($data);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // return $request->all();

        $rules = $this->validation();
        Validator::make($request->all(), $rules)->validate();
        $path = '';
        if ($request->file('photo')) {
            $path = $request->file('photo')->store('/', 'users');
            $photo_path = asset(Storage::url('users/' . $path));
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->position = $request->position;
        $user->photo = $path;
        $user->photo_path = $photo_path;
        $user->user_departments_id = $request->user_type;
        $user->user_type = $request->user_type;
        $user->password = $request->password;
        $result = $user->save();
        if ($result) {
            return response()->json([
                'res' => 'یوزر موفقانه راجستر گردید'
            ]);
        }
    }

    public function edit($id = '')
    {
        return User::find($id);
    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required|max:100|string',
            'photo' => 'nullable|image',
            'email' => 'required|email',
            'password' => 'nullable|min:8|string|confirmed',
            'position' => 'required|string|max:100',
            'user_type' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $user = User::find($request->id);
            $photo = $user->photo;
            $photo_path = $user->photo_path;
            $password = $user->password;
            if ($request->photo != '') {
                if (is_file(storage_path('/app/public/users/' . $photo))) {
                    unlink(storage_path('/app/public/users/' . $photo));
                }
                $photo = $request->photo->store('/', 'users');
                $photo_path = asset(Storage::url('users/' . $photo));
            }
            if ($request->password != '') {
                $password = bcrypt($request->password);
            }
            $result = User::find($request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'position' => $request->position,
                'photo' => $photo,
                'photo_path' => $photo_path,
                'user_type' => $request->user_type,
                'user_departments_id' => $request->user_type,
                'password' => $password,
            ]);
            DB::commit();
        } catch (Exception $e) {
            $result = 0;
            return $e;
            DB::rollBack();
        }
        if ($result) {
            return response()->json([
                'message' => 'یوزر موفقانه ویرایش گردید'
            ]);
        }
    }


    public function storePermission(Request $request)
    {
        $result = 0;
        $request->validate([
            'permission_id' => ['required'],
        ]);
        $check_permission = userpermission::where('permission_id', '=', $request->permission_id)->where('user_id', '=', $request->user_id)->get()->first();
        if ($check_permission != '') {
            return response([
                'res' => 'صلاحیت قبلا وجود دارد'
            ], 200);
        }
        $permission = new userpermission();
        $permission->permission_id = $request->permission_id;
        $permission->user_id = $request->user_id;
        $result = $permission->save();
        if ($result) {
            return response([
                'message' => 'درخواست موافقانه انجام شد'
            ], 200);
        } else {
            return response([
                'error' => 'درخواست موافقانه انجام نشد !'
            ], 304);
        }
    }

    ///  list user permission
    public function get_user_permission($user_id = '')
    {
        $permissions = permission::query()
            ->orderBy('id', 'ASC')
            ->get();

        $result = [];
        foreach ($permissions as $permission) {
            $userPermission = userpermission::where('permission_id', '=', $permission->id)->where('user_id', '=', $user_id)->orderBy('id', 'ASC')->get()->first();
            if ($userPermission != '') {
                continue;
            }
            $result[] = (object) array('id' => $permission->id, 'name' => $permission->permission_name, 'display_name' => $permission->display_name);
        }


        return $result;
    }

    public function user_permission_list()
    {
        $id = request('id');
        $per_page = request('per_page', 10);
        $permissions =  userpermission::query()
            ->join('users', 'userpermissions.user_id', '=', 'users.id')
            ->join('permissions', 'userpermissions.permission_id', '=', 'permissions.id')
            ->where('userpermissions.user_id', '=', $id)
            ->select('userpermissions.*', 'users.name as uname', 'permissions.display_name')
            ->paginate($per_page);
        return  PermissionResource::collection($permissions);
    }


    public function delete_permission($id = '')
    {
        $result = userpermission::where('user_id', '=', $id)->delete();
        return $result;
    }


    public function delete_user($id = '')
    {
        $user = User::find($id);
        $result = User::destroy($id);
        if (is_file(storage_path('/app/public/users/' . $user->photo))) {
            unlink(storage_path('/app/public/users/' . $user->photo));
        }
        return $result;
    }

    // get user department

    public function getUserDepartment()
    {
        return UserDepartments::all();
    }


    public function deletePermission($id = '')
    {

        $result = userpermission::destroy($id);
        return $result;
    }
}
