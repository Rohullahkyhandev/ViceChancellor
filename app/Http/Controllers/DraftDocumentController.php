<?php

namespace App\Http\Controllers;

use App\Models\DraftDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\CodeCleaner\FunctionContextPass;
use Symfony\Component\Mime\DraftEmail;
// validator class
use Validator;

class DraftDocumentController extends Controller
{


    public function index()
    {
    }


    public function store(Request $request)
    {
        // validation
        $request->validate([
            'source' => ['required', 'max:100'],
            'destination' => ['required', 'max:100'],
            'date' => ['required', 'max:100'],
            'subject' => ['required'],
            'content' => ['required'],
        ], [
            'source.required' => 'فیلد مبدا الزامی می باشد.',
            'source.max' => 'فیلد مبدا باید کمتر از 100 کارکتر  باشد.',
            'destination.required' => 'فیلد مقصد الزامی می باشد.',
            'source.max' => 'فیلد مقصد باید کمتر از 100 کارکتر  باشد.',
            'date.required' => 'فیلد تاریخ الزامی می باشد.',
            'subject.required' => 'فیلد موضوع الزامی می باشد.',
            'content.required' => 'فیلد متن الزامی می باشد.',
        ]);
        $draftDocument = new DraftDocument();
        $user_id = Auth::user()->id;
        $draftDocument->subject = $request->subject;
        $draftDocument->source = $request->source;
        $draftDocument->destination = $request->destination;
        $draftDocument->content = $request->content;
        $draftDocument->date = $request->date;
        $draftDocument->subject = $request->subject;
        $draftDocument->user_id = $user_id;
        $result = $draftDocument->save();
        if ($result) {
            return response([
                'message' => 'پیش نویس مکتوب  موفقانه ثبت گردید'
            ], 200);
        } else {
            return response([
                'message' => 'پیش نویس مکتوب  موفقانه ثبت نشد دوباره تلاش نماید'
            ], 304);
        }
    }


    public function updateStatus($id)
    {
        // if ($id && $type == 'approve') {
        //     DraftDocument::find($id)->update([
        //         'status' => 'approved'
        //     ]);
        // }
    }

    public function edit($id = '')
    {
        return DraftDocument::find($id);
    }

    public function update(Request $request)
    {

        // validation
        $request->validate([
            'source' => ['required', 'max:100'],
            'destination' => ['required', 'max:100'],
            'date' => ['required', 'max:100'],
            'subject' => ['required'],
            'content' => ['required'],
        ], [
            'source.required' => 'فیلد مبدا الزامی می باشد.',
            'source.max' => 'فیلد مبدا باید کمتر از 100 کارکتر  باشد.',
            'destination.required' => 'فیلد مقصد الزامی می باشد.',
            'source.max' => 'فیلد مقصد باید کمتر از 100 کارکتر  باشد.',
            'date.required' => 'فیلد تاریخ الزامی می باشد.',
            'subject.required' => 'فیلد موضوع الزامی می باشد.',
            'content.required' => 'فیلد متن الزامی می باشد.',
        ]);
        $draftID = $request->id;
        $draftDocument = DraftDocument::find($draftID);

        $draftDocument->subject = $request->subject;
        $draftDocument->source = $request->source;
        $draftDocument->destination = $request->destination;
        $draftDocument->date = $request->date;
        $draftDocument->content = $request->content;
        $result = $draftDocument->save();
        if ($result) {
            return response([
                'message' => '.پیش نویس مکتوب  موفقانه ویرایش گردید'
            ], 200);
        } else {
            return response([
                'message' => '!پیش نویس مکتوب  موفقانه ویرایش نشد. دوباره تلاش نماید'
            ], 304);
        }
    }

    public function destory($id = '')
    {
        $result = DraftDocument::destroy($id);
    }
}
