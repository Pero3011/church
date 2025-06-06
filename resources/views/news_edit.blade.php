{{-- resources/views/news_edit.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل الخبر</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <div class="parent">
        <div class="container">
            <h2 class="headline" style="padding-top:2rem;">تعديل الخبر</h2>
            <form method="POST" action="{{ route('news.update', $news->id) }}" enctype="multipart/form-data" style="margin-bottom:2rem;" class="news-form">
                @csrf
                @method('PUT')
                <label>العنوان:</label>
                <input type="text" name="title" value="{{ $news->title }}" required>
                <label>المحتوى:</label>
                <textarea name="body" required>{{ $news->body }}</textarea>
                <label>ملف (اختياري):</label>
                <input type="file" name="file" class="file-input" accept=".pdf,.doc,.docx,.txt">
                <label>صورة (اختياري):</label>
                <input type="file" name="photo" accept="image/*" class="file-input">
                <button type="submit">تحديث الخبر</button>
            </form>
        </div>
    </div>
</body>
</html>

