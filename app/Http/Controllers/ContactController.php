<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

   public function sendmail(Request $request){
        $name = $request->input('name');
        $email = $request->input('email');
        $tieude = $request->input('tieude');
        $message = $request->input('message');
    try {
        Mail::to($email)->send(new ContactEmail($name, $email, $tieude, $message));
        return redirect()->route('contact')->with('success', 'Đã gửi mail thành công!');
    } catch (\Exception $e) {
        return redirect()->route('contact')->with('error', 'Có lỗi xảy ra khi gửi email.');
    }
    }

}
