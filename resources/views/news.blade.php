<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الاخبار</title>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d64dc76508.js" crossorigin="anonymous" defer></script>
    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="parent">
    <div class="container">
        <h2 class="headline" style="padding-top:2rem;">الاخبار</h2>
        @if (session('admin_name'))
            <form method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data">
                @csrf
                <label>العنوان:</label>
                <input type="text" name="title" required>
                <label>المحتوى:</label>
                <textarea name="body" required></textarea>
                <label>ملف (اختياري):</label>
                <input type="file" name="file" class="file-input" accept=".pdf,.doc,.docx,.txt">
                <label>صورة (اختياري):</label>
                <input type="file" name="photo" accept="image/*" class="file-input">
                <button type="submit">إضافة الخبر</button>
            </form>
        @endif

        @if($news->isEmpty())
            <div class="news-empty-message">
                لا توجد أخبار متاحة حالياً.
            </div>
        @else
            @foreach($news as $item)
                <div class="news-item">
                    <div class="text">
                        <h2>{{ $item->title }}</h2>
                        <p>{{ $item->body }}</p>
                    </div>
                    @if($item->photo)
                        <img src="{{ asset('storage/' . $item->photo) }}" alt="صورة الخبر" style="max-width:200px;">
                    @endif
                    @if($item->file)
                        <a href="{{ asset('storage/' . $item->file) }}" download>تحميل الملف</a>
                    @endif
                    <hr>
                </div>
            @endforeach
        @endif
                    <a href="{{ url('/') }}" class="nav-btn" style="margin:2rem 0;display:inline-block;">العودة للرئيسية</a>
    </div>
</div>

</body>
</html>