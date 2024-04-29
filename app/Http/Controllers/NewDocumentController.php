<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocumentResource;
use App\Models\NewDocument;
use App\Models\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class NewDocumentController extends Controller
{


    public function index()
    {
        $pre_page = request('per_page', 10);
        $search = request('search', '');
        $sortField = request('sortField', 'id');
        $sortDirection = request('sortDirection', 'DESC');

        // this condition will check the user part and department to filter data according to the user_department belong the specific department
        $user_id = Auth::id();
        $user = User::find($user_id);

        $data = NewDocument::query()
            ->where('new_documents.date', 'like', "%{$search}%")
            ->orWhere('new_documents.source', 'like', "%{$search}%")
            ->orWhere('new_documents.destination', 'like', "%{$search}%")
            ->orWhere('new_documents.type', 'like', "%{$search}%")
            ->select('new_documents.*')
            ->where('new_documents.department_id', '=', $user->user_department_id)
            ->orderBy("new_documents.$sortField", $sortDirection)
            ->paginate($pre_page);

        return DocumentResource::collection($data);
    }



    public function store(Request $request)
    {

        $request->validate([
            'number' => 'required|max:100',
            'source' => 'required|string',
            'destination' => 'required|string',
            'type' => 'required|string',
            'date' => 'required',
            'remark' => 'nullable',
            'description' => 'nullable',
            'attachment' => 'required|mimes:jpg,png,pdf'
        ], [
            'number.required' => 'فلید نمبر الزامی می باشد.',
            'number.max' => 'این فلید حد اکثر 100 کارکتر می گیرد',
            'source.required' => 'فلید مبدا‌ٰ الزامی می باشد.',
            'destination.required' => 'فلید مرسل الیه الزامی می باشد.',
            'type.required' => 'فلید نوع مکتوب الزامی می باشد.',
            'date.required' => 'فلید تاریخ الزامی می باشد.',
            'attachment.required' => 'فلید اسکن مکتوب الزامی می باشد.',
            'attachment.mimes' => 'نوع اسکن فایل باید (png,jpg,pdf) باشد.'
        ]);

        //    for attachment of file
        $attachment = null;
        $attachment_path = null;

        if ($request->attachment != '') {
            $attachment = $request->attachment->store('/', 'documents');
            $attachment_path = asset(Storage::url('app/public/documents/' . $attachment));
        }

        $auth_user = Auth::user();
        $user_department_id = $auth_user->user_department_id;

        $newDocument = new NewDocument();
        $newDocument->number = $request->number;
        $newDocument->source = $request->source;
        $newDocument->destination = $request->destination;
        $newDocument->document_type = $request->type;
        $newDocument->attachment = $attachment;
        $newDocument->attachment_path = $attachment_path;
        $newDocument->date = $request->date;
        $newDocument->description = $request->description;
        $newDocument->user_id = $auth_user->id;
        $newDocument->department_id = $user_department_id;
        $result =  $newDocument->save();

        if ($result) {
            return response([
                'message' => 'مکتوب جدید موفقانه راجستر گردید'
            ], 200);
        } else {
            return response([
                'message' => 'درخواست موفقانه نبود دورباره تلاش نماید'
            ], 304);
        }
    }


    public function edit($id = '')
    {
        return NewDocument::find($id);
    }

    public function update(Request $request, $id = '')
    {

        $request->validate([
            'number' => 'required|max:100',
            'source' => 'required|string',
            'destination' => 'required|string',
            'type' => 'required|string',
            'remark' => 'nullable|string',
            'description' => 'nullable|string',
            'date' => 'required',

        ], [
            'number.required' => 'فلید نمبر الزامی می باشد.',
            'number.max' => 'این فلید حد اکثر 100 کارکتر می گیرد',
            'source.required' => 'فلید مبدا‌ٰ الزامی می باشد.',
            'destination.required' => 'فلید مرسل الیه الزامی می باشد.',
            'type.required' => 'فلید نوع مکتوب الزامی می باشد.',
            'date.required' => 'فلید تاریخ الزامی می باشد.',
            'attachment.required' => 'فلید اسکن مکتوب الزامی می باشد',
        ]);

        $newDocument = NewDocument::find($id);
        $attachment = $newDocument->attachment;
        $attachment_path = $newDocument->attachment_path;

        if (
            $request->attachment != ''
        ) {
            if (is_file(storage_path('app/public/documents/' . $attachment))) {
                unlink(storage_path('app/public/documents/' . $attachment));
            }
        }

        $newDocument->number = $request->number;
        $newDocument->source = $request->source;
        $newDocument->destination = $request->destination;
        $newDocument->document_type = $request->type;
        $newDocument->remark = $request->remark;
        $newDocument->description = $request->description;
        $newDocument->attachment = $attachment;
        $newDocument->attachment_path = $attachment_path;
        $newDocument->date = $request->date;
        $newDocument->status = $request->status;
        $newDocument->save();
    }

    public function destroy($id = '')
    {
        $new_document = NewDocument::find($id);
        if (is_file(storage_path('app/public/documents/' . $new_document->attachment))) {
            unlink(storage_path('app/public/documents/' . $new_document->attachment));
        }
        return NewDocument::destroy($id);
    }
}



