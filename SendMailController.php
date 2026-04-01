<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContactMail;

class SendMailController extends Controller
{
    /**
     * Send Contact Mail
     */
    public function send(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'mobile'  => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Validation Failed
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Prepare Data
            $data = [
                'name'    => $request->name,
                'email'   => $request->email,
                'mobile'  => $request->mobile,
                'subject' => $request->subject,
                'message' => $request->message,
            ];

            // ✅ Direct Admin Email
            Mail::to('admin@microtechcnc.com.sg')->send(new ContactMail($data));

            return response()->json([
                'status' => true,
                'message' => 'Mail sent successfully'
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Mail sending failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
