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
            <table class="served-table">
                <thead>
                    <tr>
                        <th>الاسم</th>
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
                        <td>{{ $user->year }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>{{ $user->email }}</td>
                        <td>0%</td>
                        <td>
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
        </div>
    </div>
</body>
</html>