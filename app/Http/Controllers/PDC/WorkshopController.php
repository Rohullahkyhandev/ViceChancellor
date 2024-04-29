<?php

namespace App\Http\Controllers\PDC;

use App\Http\Controllers\Controller;
use App\Http\Resources\WrokshopResource;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WorkshopController extends Controller
{

    // ----------------------------------------------------------------
    //  display list of workshop
    //----------------------------------------------------------------
    public function index()
    {
        $per_page = request('per_page', '');
        $search = request('search', '');
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection ', 'ASC');

        $data  = Workshop::query()
            ->where('workshops.topic', 'like', "%{$search}%")
            ->orWhere('workshops.start_time', 'like', "%{$search}%")
            ->join('users', 'workshops.user_id', 'users.id')
            ->select('workshops.*', 'users.name as uname')
            ->orderBy("workshops.$sortField", $sortDirection)
            ->paginate($per_page);
        // return the results as key value pairs
        return WrokshopResource::collection($data);
    }

    // ----------------------------------------------------------------
    //  Store the new workshop to the database
    //----------------------------------------------------------------
    public function store(Request $request)
    {
        $request->validate([
            'topic' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'description' => 'required',
            'document' => 'required',
        ], [
            'topic.required' => 'فلید موضوع الزامی می باشد.',
            'start_time.required' => 'فلید تاریخ شروع الزامی می باشد.',
            'end_time.required' => 'فلید تاریخ ختم الزامی می باشد.',
            'description.required' => 'فلید توضیحات الزامی می باشد.',
            'document.required' => 'فلید سند الزامی می باشد.',
        ]);


        $document = null;
        $document_path = null;

        if ($request->document != null) {
            $document = $request->document->store('/', 'workshop');
            $document_path = asset(Storage::url('app/public/workshop/' . $document));
        }

        $user_id = Auth::id();
        $workshop = new Workshop();
        $workshop->topic = $request->topic;
        $workshop->start_time = $request->start_time;
        $workshop->end_time = $request->end_time;
        $workshop->description = $request->description;
        $workshop->document = $document;
        $workshop->document_path = $document_path;
        $workshop->user_id = $user_id;
        $result = $workshop->save();

        if ($result) {
            return response([
                'message' => 'در خواست موفقانه انجام شد.'
            ], 200);
        } else {
            return response([
                'error' => 'در خواست موفقانه انجام نشد. دوباره تلاش نماید.'
            ], 304);
        }
    }

    public function edit($id)
    {
        $data  = Workshop::find($id);
        return $data;
    }

    public function update(Request $request, $id = null)
    {

        $request->validate([
            'topic' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'description' => 'required',
            'document' => 'nullable',
        ], [
            'topic.required' => 'فلید موضوع الزامی می باشد.',
            'start_time.required' => 'فلید تاریخ شروع الزامی می باشد.',
            'end_time.required' => 'فلید تاریخ ختم الزامی می باشد.',
            'description.required' => 'فلید توضیحات الزامی می باشد.',
        ]);

        $workshop_id = $request->id;
        $workshop  =  Workshop::find($workshop_id);
        $document = $workshop->document;
        $document_path = $workshop->document_path;

        if ($request->document !== null) {
            if (is_file(storage_path('app/public/workshop/' . $document))) {
                unlink(storage_path('app/public/workshop/' . $document));
            }
            $document = $request->document->store('/', 'workshop');
            $document_path  = asset(Storage::url('app/public/workshop/' . $document));
        }

        $workshop->topic = $request->topic;
        $workshop->start_time = $request->start_time;
        $workshop->end_time = $request->end_time;
        $workshop->description = $request->description;
        $workshop->document = $document;
        $workshop->document_path = $document_path;
        $result = $workshop->save();

        if ($result) {
            return response([
                'message' => ' ویرایش  موفقانه انجام شد.'
            ], 200);
        } else {
            return response([
                'error' => 'ویرایش  موفقانه انجام نشد. دوباره تلاش نماید.'
            ], 304);
        }
    }

    public function delete($id  = null)
    {
        $workshop = Workshop::find($id);
        if (is_file(storage_path('app/public/workshop/' . $workshop->document))) {
            unlink(storage_path('app/public/workshop/' . $workshop->document));
        }
        $result = Workshop::destroy($id);
        return response($result, 204);
    }
}
