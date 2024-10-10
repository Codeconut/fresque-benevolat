<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    public function mail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        Mail::to($request->email)->send(new TestMail);

        return response()->json([
            'message' => 'Email sent',
        ]);
    }

    public function renderMail()
    {
        $mail = new TestMail;

        return $mail->render();
    }
}
