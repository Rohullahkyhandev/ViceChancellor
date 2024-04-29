<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\NewDocumentController;
use App\Http\Controllers\PDC\ArchiveController;
use App\Http\Controllers\PDC\PlanController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Models\Department;
use App\Models\ReceivedDocument;
use App\Models\SendDocument;
use App\Models\Teacher;
use App\Student;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum', 'admin'])->group(function () {

    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/current/user', [AuthController::class, 'getCurrentUser']);
    //Route::post('/current/permission', [AuthController::class, 'getCurrentPermission']);

    // user
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user_department', [UserController::class, 'getUserDepartment']);
    Route::post('/user/create', [UserController::class, 'store']);
    Route::get('/user/edit/{id}', [UserController::class, 'edit']);
    Route::post('/user/update', [UserController::class, 'update']);
    Route::get('/user/delete/{id}', [UserController::class, 'delete_user']);

    //  user permission
    Route::get('/permission/list/{id}', [UserController::class, 'get_user_permission']);
    Route::get('/permission', [UserController::class, 'user_permission_list']);
    Route::post('/permission/store', [UserController::class, 'storePermission']);
    Route::get('/permission/delete/{id}', [UserController::class, 'deletePermission']);
    Route::get('/user/current/permission', [AuthController::class, 'getCurrentPermission']);
    // end of user routes



    //  new document as common part of system
    Route::middleware(['auth:sanctum', 'create_document'])->group(function () {
        Route::post('/document/create', [NewDocumentController::class, 'store']);
        Route::get('/documents', [NewDocumentController::class, 'index']);
    });

    // pdc plan
    Route::middleware(['auth:sanctum', 'create_plan'])->group(function () {
        Route::post('/pdc/plan/create', [PlanController::class, 'store']);
    });
    Route::middleware(['auth:sanctum', 'view_plan'])->group(function () {
        Route::get('/plan', [PlanController::class, 'index']);
    });
    Route::middleware(['auth:sanctum', 'edit_plan'])->group(function () {
        Route::get('/pdc/plan/edit/{id}', [PlanController::class, 'edit']);
        Route::post('/pdc/plan/update', [PlanController::class, 'update']);
    });
    Route::middleware(['auth:sanctum', 'delete_plan'])->group(function () {

        Route::get('/pdc/plan/delete/{id}', [PlanController::class, 'destroy']);
    });

    // pdc archive file
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/archive', [ArchiveController::class, 'index']);
        Route::post('/pdc/archive/create', [ArchiveController::class, 'store']);
        Route::get('/pdc/archive/edit/{id}', [ArchiveController::class, 'edit']);
        Route::post('/pdc/archive/update', [ArchiveController::class, 'update']);
        Route::get('/pdc/archive/delete/{id}', [ArchiveController::class, 'destroy']);
    });

    // faculty
    Route::middleware(['auth:sanctum'])->group(function () {

        Route::get('/faculty', [FacultyController::class, 'index']);
        Route::get('/faculty/details/{id}', [FacultyController::class, 'getFaculty']);
        Route::post('/faculty/create', [FacultyController::class, 'store']);
        Route::get('/faculty/edit/{id}', [
            FacultyController::class, 'getFaculty'
        ]);
        Route::post('/faculty/update', [FacultyController::class, 'update']);
        Route::get('/faculty/delete/{id}', [FacultyController::class, 'destroy']);
        Route::get('/get/faculties', [FacultyController::class, 'getFaculties']);

        // department
        Route::get('/faculty/department', [DepartmentController::class, 'getFacultyDepartment']);
        Route::post('/faculty/department/create/{id}', [DepartmentController::class, 'store']);
        Route::get('/get/departments/{id}', [DepartmentController::class, 'getDepartments']);
        Route::get('/department/details/{id}', [DepartmentController::class, 'getDepartment']);
        Route::post('/department/update', [DepartmentController::class, 'update']);
        Route::get('/department/delete/{id}', [DepartmentController::class, 'destroy']);
    });

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/department/teacher', [DepartmentController::class, 'getDepartmentTeacher']);
    });

    // teacher
    Route::middleware(['auth:sanctum', 'create_teacher'])->group(function () {

        Route::get('/teacher', [TeacherController::class, 'index']);
        Route::post('/teacher/create', [TeacherController::class, 'store']);
        Route::get('/teacher/edit/{id}', [TeacherController::class, 'getTeacher']);
        Route::get('/faculty/department/get', [TeacherController::class, 'getFacultyDepartment']);
        Route::get('/teacher/details/{id}', [TeacherController::class, 'getTeacher']);
        // qualification
        Route::post('/teacher/qualification/create/{id}', [TeacherController::class, 'storeQualification']);
        Route::get('/teacher/qualification/{id}', [TeacherController::class, 'getQualify']);
        Route::post('/teacher/qualification/update/{id}', [TeacherController::class, 'updateQualification']);
        Route::get('/teacher/qualification/delete/{id}', [TeacherController::class, 'destroyQualification']);
        // documents
        Route::post('/teacher/document/create/{id}', [TeacherController::class, 'storeDocument']);
        Route::get('/teacher/document', [TeacherController::class, 'getDocument']);
        Route::get('/teacher/document/edit/{id}', [TeacherController::class, 'editDocument']);
        Route::post('/teacher/document/update/{id}', [TeacherController::class, 'updateDocument']);
        Route::get('/teacher/document/delete/{id}', [TeacherController::class, 'destroyDocument']);
        // article
        Route::post('/teacher/article/create/{id}', [TeacherController::class, 'storeArticle']);
        Route::get('/teacher/article', [TeacherController::class, 'getArticle']);
        Route::get('/teacher/article/edit/{id}', [TeacherController::class, 'editArticle']);
        Route::post('/teacher/article/update/{id}', [TeacherController::class, 'updateArticle']);
        Route::get('/teacher/article/delete/{id}', [TeacherController::class, 'destroyArticle']);

        // literature
        Route::post('/teacher/literature/create/{id}', [TeacherController::class, 'storeLiterature']);
        Route::get('/teacher/literature', [TeacherController::class, 'getLiterature']);
        Route::get('/teacher/literature/edit/{id}', [TeacherController::class, 'editLiterature']);
        Route::post('/teacher/literature/update/{id}', [TeacherController::class, 'updateLiterature']);
        Route::get('/teacher/literature/delete/{id}', [TeacherController::class, 'destroyLiterature']);

        // get all departments
        Route::get('/teacher/get_all_department', [TeacherController::class, 'getallDepartments']);
    });

    Route::middleware(['auth:sanctum', 'edit_teacher'])->group(function () {
        Route::post('/teacher/update', [TeacherController::class, 'update']);
    });
    Route::middleware(['auth:sanctum', 'delete_teacher'])->group(function () {
        Route::post('/teacher/delete/{id}', [TeacherController::class, 'destroy']);
    });

    // student
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/student', [StudentController::class, 'index']);
        Route::post('/student/create', [StudentController::class, 'store']);
        Route::get('/student/edit/{id}', [StudentController::class, 'edit']);
        Route::post('/student/update', [StudentController::class, 'update']);
        Route::get('/student/delete/{id}', [StudentController::class, 'delete']);
    });
});


Route::post('/login', [AuthController::class, 'login']);
