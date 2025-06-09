<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>edit user table</title>
        <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <div class="parent">
        <div class="container">
            <h2 style="padding-top: 2rem; ">قائمة المستخدمين</h2>
            <form method="GET" action="{{ route('served') }}" style="margin: 1rem 0rem; display: flex; align-items: center; gap: 1rem;">
                <label style="font-weight: bold; font-size: 1.1rem;">السنة الدراسيه:</label>
                <select name="year" onchange="this.form.submit()" style="padding: 0.5rem 1.2rem; border-radius: 8px; border: 1px solid #ccc; font-size: 1rem; background: #fff; color: #003049;">
                    <option value="">كل السنوات</option>
                    <option value="الأولى" {{ request('year') == 'الأولى' ? 'selected' : '' }}>الأولى</option>
                    <option value="الثانية" {{ request('year') == 'الثانية' ? 'selected' : '' }}>الثانية</option>
                </select>
            </form>
            <table class="served-table">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>السنه الدراسيه</th>
                        <th>رقم الهاتف</th>
                        <th>الايميل</th>
                        <th>الحاله</th>
                        <th>التعديل</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->year ?? '-'}}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>{{ $user->email }}</td>
                        <td>0%</td>
                        <td style="display: flex; justify-content: center; margin-top: 1rem;">
                            <div class="news-actions" style="margin-bottom: 1rem; display: flex; align-items: center; gap: 10px;">
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="nav-btn" style="background: #a30000;" onclick="return confirm('هل أنت متأكد من حذف المستخدم؟')">حذف</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a href="{{ url('/') }}" class="nav-btn" style="margin-bottom:2rem;display:inline-block;">العودة للرئيسية</a>
        </div>
    </div>
</body>
</html>