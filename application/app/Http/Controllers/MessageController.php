<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\SendMessageRequest;
use App\Notifications\MessageNotification;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function sendMessage(SendMessageRequest $request)
    {
        if ($request->has('attachment')) {
            if (!empty($request->attachment)) {
                $old_img = '';

                $attachment = fileUpload($request['attachment'], path_message_attachment(), $old_img); // upload file
            }
            $send_message = Message::create([
                'subject' => $request->subject,
                'message' => $request->message,
                'user_id' => Auth::id(),
                'attachment' => $attachment,
            ]);
        }else{
            $send_message = Message::create([
                'subject' => $request->subject,
                'message' => $request->message,
                'user_id' => Auth::id(),
            ]);
        }


        auth()->user()->notify(New MessageNotification($send_message));

        if($send_message) {
            Session::flash('message', 'Message Successfully Send');

            Toastr::success('', 'Message Successfully Send');

            return redirect()->back()->with('success', 'Message Successfully Send');
        }
    }
}
