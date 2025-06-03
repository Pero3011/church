<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsController extends Controller
{
    public function create()
    {
        return view('news_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only('title', 'body');

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('news_files', 'public');
        }
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('news_photos', 'public');
        }

        $news = News::create($data);

        // Notify all users by email
        foreach (User::all() as $user) {
            Mail::raw("خبر جديد: {$news->title}\n\n{$news->body}", function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('خبر جديد من الكنيسة');
            });
        }

        return redirect()->route('news')->with('success', 'تم إضافة الخبر وإرسال الإشعارات!');
    }

    public function index()
    {
        $news = News::latest()->get();
        return view('news', compact('news'));
    }
}
