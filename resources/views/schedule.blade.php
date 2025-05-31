<!-- filepath: resources/views/schedule.blade.php -->
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>جدول العمل السنوي</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <div class="parent">
        <div class="container">
            <h2 class="headline" style="padding-top:2rem;">جدول العمل السنوي</h2>
            <table class="schedule-table">
                <thead>
                    <tr>
                        <th>التاريخ</th>
                        <th>الحدث</th>
                        <th>المكان</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($schedules as $schedule)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($schedule->date)->format('Y-m-d') }}</td>
                            <td>{{ $schedule->event }}</td>
                            <td>{{ $schedule->location }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ url('/') }}" class="nav-btn" style="margin-bottom:2rem;display:inline-block;">العودة للرئيسية</a>
        </div>
    </div>
</body>
</html>