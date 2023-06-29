<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContact;

use App\Models\Lead;

class LeadController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        $success = true;


        $validator = Validator::make(
            $data,
            [
                'name' => 'required|min:3|max:255',
                'mail' => 'required|min:3|max:255',
                'message' => 'required|min:3'
            ],
            [
                'name.required' => 'Name is required',
                'name.min' => 'Minimum length for Name is :min',
                'name.max' => 'Max length for Name is :max',
                'mail.required' => 'Mail is required',
                'mail.min' => 'Minimum length for Mail is :min',
                'mail.max' => 'Max length for Mail is :max',
                'message.required' => 'Message is required',
                'message.min' => 'Minimum length for Message is :min',

            ]
        );
        if($validator->fails()){
            $success = false;
            $errors = $validator->errors();
            return response()->json(compact('success', 'errors'));
        }

        $new_lead = Lead::create($data);
        Mail::to('muresupietro66@gmail.com')->send(new NewContact($new_lead));

        return response()->json($data);
    }
}
