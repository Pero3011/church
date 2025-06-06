<?php

namespace App\Http\Controllers;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use App\Models\User;

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

        return redirect()->route('news')->with('success', 'تم إضافة الخبر وإرسال الإشعارات!');
    }

    public function index()
    {
               
        if (!session('admin_name') && !Auth::check()) {
            return redirect('/signin')->withErrors(['يجب تسجيل الدخول أولاً']);
        }

        $news = News::latest()->get();
        return view('news', compact('news'));


    }
    public function edit(News $news)
    {
        // Only admin can edit
        if (!session('admin_name')) {
            return redirect()->route('news')->withErrors(['غير مصرح']);
        }
        return view('news_edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        if (!session('admin_name')) {
            return redirect()->route('news')->withErrors(['غير مصرح']);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only('title', 'body');

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($news->file) Storage::disk('public')->delete($news->file);
            $data['file'] = $request->file('file')->store('news_files', 'public');
        }
        if ($request->hasFile('photo')) {
            if ($news->photo) Storage::disk('public')->delete($news->photo);
            $data['photo'] = $request->file('photo')->store('news_photos', 'public');
        }

        $news->update($data);

        return redirect()->route('news')->with('success', 'تم تحديث الخبر بنجاح!');
    }

    public function destroy(News $news)
    {
        if (!session('admin_name')) {
            return redirect()->route('news')->withErrors(['غير مصرح']);
        }
        // Delete files if exist
        if ($news->file) Storage::disk('public')->delete($news->file);
        if ($news->photo) Storage::disk('public')->delete($news->photo);
        $news->delete();

        return redirect()->route('news')->with('success', 'تم حذف الخبر بنجاح!');
    }
}
