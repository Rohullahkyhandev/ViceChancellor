<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Validator;

class StudentController extends Controller
{


    public function validation()
    {
        $rules = [
            'name' => 'required|string|max:100',
            'lname' => 'required|string|max:100',
            'fname' => 'required|string|max:100',
            'phone' => 'required|max:14',
            'email' => 'required|email:unique:students',
            'gender' => 'required',
            'kankor_id' => 'required|string|max:100',
            'kankor_mark' => 'required|string|max:100',
            'bachelor_field' => 'required|string|max:100',
            'nic' => 'required|string|max:100',
            'address' => 'required|string|max:100',
            'admission_date' => 'required|string|max:100',
            'blood_group' => 'required|string|max:100',
            'faculty_id' => 'required|string|max:100',
            'department_id' => 'required|string|max:100',
            'photo' => 'required|mimes:jpeg,png,jpg'
        ];

        return $rules;
    }

    public function index()
    {
        $per_page = request('per_page', 10);
        $search = request('search', '');
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');

        $data = Student::query()
            ->where('students.name', 'like', "%{$search}%")
            ->orWhere('students.lname', 'like', "%{$search}%")
            ->join('departments', 'students.department_id', 'departments.id')
            ->join('faculties', 'students.faculties_id', 'faculties_id')
            ->select('students.*', 'faculties.name as faculty', 'departments.name as department', 'users.name as user')
            ->orderBy("students.$sortField", $sortDirection)
            ->paginate($per_page);
        return StudentResource::collection($data);
    }


    public function store(Request $request)
    {

        $rules = $this->validation();
        Validator::make($request->all(), $rules)->validate();

        DB::beginTransaction();
        try {
            $photo = null;
            $photo_path = null;
            if ($request->photo != '') {
                $photo = $request->photo->store('/', 'students');
                $photo_path = asset(Storage::url('students/' . $photo));
            }

            $user_id = Auth::id();
            $student = new Student();
            $student->name  = $request->name;
            $student->lname = $request->lname;
            $student->fname = $request->fname;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->gender = $request->gender;
            $student->kankor_id = $request->kankor_id;
            $student->kankor_mark = $request->kankor_mark;
            $student->blood_group = $request->blood_group;
            $student->admission_date = $request->admission_date;
            $student->bachelor_field = $request->bachelor_field;
            $student->nic = $request->nic;
            $student->photo = $photo;
            $student->photo_path = $photo_path;
            $student->department_id = $request->department_id;
            $student->user_id = $user_id;
            $student->faculty_id = $request->faculty_id;
            $result = $student->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
        if ($result) {
            return response([
                'message' => 'درخواست موفقانه انجام شد'
            ], 200);
        }
    }

    public function getStudent($id = '')
    {
        return Student::find($id);
    }

    public function edit($id)
    {
        return Student::find($id);
    }

    public function update(Request $request)
    {
        $rules = $this->validation();
        Validator::make($request->all(), $rules)->validate();

        DB::beginTransaction();
        try {
            $student_id = $request->id;
            $student = Student::find($student_id);
            $photo = $student->photo;
            $photo_path = $student->photo_path;
            if ($request->photo != '') {
                if (is_file(storage_path('app/public/students/' . $student->photo))) {
                    unlink(storage_path('app/public/students/' . $photo));
                }
                $photo = $request->photo->store('/', 'students');
                $photo_path = asset(Storage::url('students/' . $photo));
            }
            $user_id = Auth::id();
            $student = new Student();
            $student->name  = $request->name;
            $student->lname = $request->lname;
            $student->fname = $request->fname;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->gender = $request->gender;
            $student->kanlor_id = $request->kanlor_id;
            $student->kankor_mark = $request->kankor_mark;
            $student->blood_group = $request->blood_group;
            $student->admission_date = $request->admission_date;
            $student->bachelor_field = $request->bachelor_field;
            $student->nic = $request->nic;
            $student->photo = $photo;
            $student->photo_path = $photo_path;
            $student->department_id = $request->department_id;
            $student->user_id = $user_id;
            $student->faculty_id = $request->faculty_id;
            $result = $student->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
        if ($result) {
            return response([
                'message' => ',درخواست موفقانه انجام شد'
            ]);
        }
    }

    public function destroy($id = '')
    {
        $student = Student::find($id);
        if (is_file(storage_path('app/public/students/' . $student->photo))) {
            unlink(storage_path('app/public/students'));
        }
        $result = Student::destroy($id);
        return $result;
    }
}
