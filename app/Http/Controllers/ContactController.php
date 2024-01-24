<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('id', 'DESC')->paginate(50);
        return view('contacts.index',compact('contacts'));
    }

    public function sendEmail(Request $request)
    {
        // Lưu dữ liệu vào cơ sở dữ liệu
        $contact = new Contact;
        $contact->contact_title = $request->input('subject');
        $contact->contact_phone = $request->input('phone');
        $contact->contact_content = $request->input('message');
        $contact->save();

        // Gửi email
        $data = [
            'fullname' => $request->input('fullname'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'phone' => $request->input('phone'),
            'message' => $request->input('message')
        ];

        Mail::send('contacts.contact', ['data' => $data], function ($message) use ($data) {
            $message->to('shiudokun@gmail.com', 'Phan Van Loc')
                ->subject('New Contact Form Submission');
            $message->from($data['email'], $data['fullname']);
        });

        // Redirect hoặc hiển thị thông báo thành công
        return redirect()->back()->with('success', 'Email đã được gửi và dữ liệu đã được lưu thành công.');
    }
}
