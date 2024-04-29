<?php

namespace App\Http\Controllers;

use App\Http\Resources\FaculteisResource;
use App\Http\Resources\FacultyResource;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\CssSelector\Node\FunctionNode;
use Validator;

class FacultyController extends Controller
{
    public function validation()
    {
        $rules = [
            'name' => 'required|string',
            'date' => 'required|date:max:100',
            'description' => 'required',
        ];

        return $rules;
    }

    public function index()
    {
        $per_page = request('per_page', 10);
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');
        $search = request('search', '');

        $data = Faculty::query()
            ->where('faculties.name', 'like', "%{$search}%")
            ->join('users', 'faculties.user_id', 'users.id')
            ->select('faculties.*', 'users.name as uname')
            ->orderBy("faculties.$sortField", $sortDirection)
            ->paginate($per_page);
        return FacultyResource::collection($data);
    }


    // get all the teacher according to the department and department
    public function store(Request $request)
    {

        $result = 0;
        $rules =  $this->validation();
        Validator::make($request->all(), $rules)->validate();

        $user_id = Auth::id();

        $faculty = new Faculty();
        $faculty->name = $request->name;
        $faculty->date = $request->date;
        $faculty->description = $request->description;
        $faculty->user_id = $user_id;
        $result = $faculty->save();

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




    public function update(Request $request)
    {

        $result = 0;
        $rules =  $this->validation();
        Validator::make($request->all(), $rules)->validate();
        $id = $request->id;
        $result = Faculty::find($id)->update([
            'name' => $request->name,
            'date' => $request->date,
            'description' => $request->description,
        ]);

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

    public function getFaculties()
    {
        $data = Faculty::query()
            ->select('faculties.name as fname', 'faculties.id as faculty_id')
            ->get();
        return FaculteisResource::collection($data);
    }

    function getFaculty($id = '')
    {
        return Faculty::find($id);
    }

    public function destroy($id = '')
    {
        $result = Faculty::fine($id)->delete();
        return $result;
    }
}
