<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentResource;
use App\Http\Resources\DepartmentsResource;
use App\Http\Resources\TeacherDepartmentResource;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class DepartmentController extends Controller
{




    public function getFacultyDepartment()
    {
        $id = request('id');
        $per_page = request('per_page', 10);
        $search = request('search', '');
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');

        $data =  Department::query()
            ->where('departments.faculty_id', '=', $id)
            ->where('departments.name', 'like', "%{$search}%")
            ->join('faculties', 'departments.faculty_id', 'faculties.id')
            ->join('users', 'departments.user_id', 'users.id')
            ->select('departments.*', 'users.name as uname', 'faculties.name as fname')
            ->orderBy("departments.$sortField", $sortDirection)
            ->paginate($per_page);
        return DepartmentResource::collection($data);
    }

    public function getDepartmentTeacher()
    {
        $search = request('search', '');
        $per_page = request('per_page', 10);
        $id = request('id');

        $data = Department::query()
            ->where('departments.id', $id)
            ->where('departments.name', $search)
            ->join('teachers', 'departments.id', 'teachers.department_id')
            ->select('departments.*', 'teachers.name as tname', 'teachers.email as temail', 'teachers.academic_rank as arank', 'teachers.photo_path as photo')
            ->paginate($per_page);
        return TeacherDepartmentResource::collection($data);
    }

    public function store(Request $request, $id = '')
    {
        $result = 0;
        $request->validate([
            'name' => 'required',
            'date' => 'date',
            'description' => 'required|string',
        ]);

        $user_id = Auth::id();

        $department = new Department();
        $department->name = $request->name;
        $department->description = $request->description;
        $department->date = $request->date;
        $department->faculty_id = $id;
        $department->user_id = $user_id;
        $result = $department->save();
        if ($result) {
            return response([
                'message' => 'موفقانه ذخیره شد'
            ], 200);
        } else {
            return response([
                'message' => 'دیتا ذخیره نشد دوباره تلاش نماید'
            ], 403);
        }
    }

    public function getDepartments($id = '')
    {
        $data = Department::query()
            ->where('departments.faculty_id', '=', $id)
            ->select('departments.name as department_name', 'departments.id as department_id')
            ->get();
        return DepartmentsResource::collection($data);
    }

    public function getDepartment($id)
    {
        $data  = Department::find($id);
        return $data;
    }

    public function update(Request $request)
    {

        $result = 0;
        $request->validate([
            'name' => 'required',
            'date' => 'date',
            'description' => 'required|string',
        ]);

        $department_id = $request->id;
        $department = Department::find($department_id);

        $department->name = $request->name;
        $department->date = $request->date;
        $department->description = $request->description;
        $result = $department->save();

        if ($result) {
            return response([
                'message' => 'ویراش موفقانه انجام شد'
            ], 200);
        } else {
            return response([
                'message' => 'ویرایش موفقانه انجام نشد'
            ], 304);
        }
    }


    public function destroy($id = '')
    {
        $result = Department::destroy($id);
        return $result;
    }
}
