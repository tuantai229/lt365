<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('contacts.index');
    }

    /**
     * Handle the contact form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'content' => 'required|string|max:5000',
        ]);

        if ($validator->fails()) {
            return redirect()->route('contact.index')
                ->withErrors($validator)
                ->withInput();
        }

        Contact::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'subject' => 'Yêu cầu tư vấn từ trang Liên hệ',
            'content' => $request->input('content'),
            'status' => 0, // 0 for new
        ]);

        return redirect()->route('contact.index')->with('success', 'Cảm ơn bạn đã gửi yêu cầu! Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.');
    }
}
