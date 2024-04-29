<?php

namespace App\Http\Controllers;

use App\Graduated_Student;
use App\Http\Resources\GraduatedStudentResource;
use Illuminate\Http\Request;

class GraduatedStudentController extends Controller
{




    public function index()
    {
        $sortField =  request("sortField", 'id');
        $sortDirection =  request("sortDirection", 'DESC');
        $search =  request("");
        $per_page =  request(10);

        $data = Graduated_Student::query()
            ->where('name', 'like', "%$search%")
            ->orWhere('student_id', 'like', "%$search%")
            ->orWhere('graduated_year', '=', "$search")
            ->join("users", 'graduated_students.user_id', 'users.id')
            ->select("graduated_students.*", 'users.name as uname')
            ->orderBy("graduated_students.$sortField", $sortDirection)
            ->paginate($per_page);

        return  GraduatedStudentResource::collection($data);
    }
}
