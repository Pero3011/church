<!-- filepath: resources/views/grade.blade.php -->
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>درجات الحضور والمواد</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    @if(auth()->check() || session('admin_name'))
        <div class="parent">
            <div class="container">
                <h2 class="headline" style="padding-top:2rem;">جدول الدرجات والحضور الاعتراف</h2>
                <table class="schedule-table">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>الاعتراف 1</th>
                            <th>الاعتراف 2</th>
                            <th>الاعتراف 3</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(session('admin_name')  && isset($users))
                            @foreach($users as $user)
                                <tr>
                                    <td data-label="الاسم">{{ $user->name }}</td>
                                    <td data-label="الاعتراف 1">{{ $user->confession1 ?? '0' }}</td>
                                    <td data-label="الاعتراف 2">{{ $user->confession2 ?? '0' }}</td>
                                    <td data-label="الاعتراف 3">{{ $user->confession3 ?? '0' }}</td>
                                </tr>
                            @endforeach
                        @elseif(auth()->check() && isset($user))
                            <tr>
                                <td data-label="الاسم">{{ $user->name }}</td>
                                <td data-label="الاعتراف 1">{{ $user->confession1 ?? '0' }}</td>
                                <td data-label="الاعتراف 2">{{ $user->confession2 ?? '0' }}</td>
                                <td data-label="الاعتراف 3">{{ $user->confession3 ?? '0' }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <table class="schedule-table">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>الحضور 1</th>
                            <th>الحضور 2</th>
                            <th>الحضور 3</th>
                            <th>الحضور الكلي</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(session('admin_name')  && isset($users))
                            @foreach($users as $user)
                                <tr>
                                    <td data-label="الاسم">{{ $user->name }}</td>
                                    <td data-label="الحضور 1">{{ $user->attendance1 ?? '0'}}</td>
                                    <td data-label="الحضور 2">{{ $user->attendance2 ?? '0' }}</td>
                                    <td data-label="الحضور 3">{{ $user->attendance3 ?? '0' }}</td>
                                    <td data-label="الحضور الكلي">
                                        {{
                                            round(
                                                (($user->attendance1 ?? 0) + ($user->attendance2 ?? 0) + ($user->attendance3 ?? 0)) / 90 * 100
                                            )
                                        }}%
                                    </td>
                                </tr>
                            @endforeach
                        @elseif(auth()->check() && isset($user))
                            <tr>
                                <td data-label="الاسم">{{ $user->name }}</td>
                                <td data-label="الحضور 1">{{ $user->attendance1 ?? '0'}}</td>
                                <td data-label="الحضور 2">{{ $user->attendance2 ?? '0' }}</td>
                                <td data-label="الحضور 3">{{ $user->attendance3 ?? '0' }}</td>
                                <td data-label="الحضور الكلي">
                                    {{
                                        round(
                                            (($user->attendance1 ?? 0) + ($user->attendance2 ?? 0) + ($user->attendance3 ?? 0)) / 90 * 100
                                        )
                                    }}%
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <table class="grades-table">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th> العقيده</th>
                            <th> تاريخ الكنيسه</th>
                            <th> تكوين</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(session('admin_name')  && isset($users))
                            @foreach($users as $user)
                                @php
                                    $total_grade = round(
                                        (($user->attendance1 ?? 0) + ($user->attendance2 ?? 0) + ($user->attendance3 ?? 0)) / 90 * 100
                                    );
                                    $subject1 = $user->subject1 ?? 0;
                                    $subject2 = $user->subject2 ?? 0;
                                    $subject3 = $user->subject3 ?? 0;

                                    $confession1 = $user->confession1 ?? 0;
                                    $confession2 = $user->confession2 ?? 0;
                                    $confession3 = $user->confession3 ?? 0;
                                @endphp
                                <tr>
                                    <td data-label="الاسم">{{ $user->name }}</td>
                                    <td data-label="الماده 1">{{ $subject1 }}</td>
                                    <td data-label="الماده 2">{{ $subject2 }}</td>
                                    <td data-label="الماده 3">{{ $subject3 }}</td>
                                </tr>
                            @endforeach
                        @elseif(auth()->check() && isset($user))
                            @php
                                $total_grade = round(
                                    (($user->attendance1 ?? 0) + ($user->attendance2 ?? 0) + ($user->attendance3 ?? 0)) / 90 * 100
                                );
                                $subject1 = $user->subject1 ?? 0;
                                $subject2 = $user->subject2 ?? 0;
                                $subject3 = $user->subject3 ?? 0;
                            @endphp
                            <tr>
                                <td data-label="الاسم">{{ $user->name }}</td>
                                <td data-label="الماده 1">{{ $subject1 }}</td>
                                <td data-label="الماده 2">{{ $subject2 }}</td>
                                <td data-label="الماده 3">{{ $subject3 }}</td>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <table class="grades-table">
                    <thead>
                        <tr>
                            <th>الحاله</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(session('admin_name')  && isset($users))
                            @foreach($users as $user)
                                @php
                                    $passed = !($total_grade < 80 || $subject1 < 60 || $subject2 < 60 || $subject3 < 60 || $confession1 < 2 || $confession2 < 2 || $confession3 < 2);
                                @endphp
                                <tr>
                                    <td data-label="الحاله" class="الحاله">
                                        @if($passed)
                                            <span>ناجح</span>
                                            <style>
                                                tbody tr:last-child td {
                                                    background-color: green;
                                                    color: white;
                                                    font-weight: bold;
                                                }
                                            </style>
                                        @else
                                            <span>غير ناجح</span>
                                            <style>
                                                tbody tr:last-child td 
                                                {
                                                    background-color: rgb(181, 0, 0);
                                                    color: white;
                                                    font-weight: bold;
                                                }
                                            </style>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @elseif(auth()->check() && isset($user))
                            @php
                                $passed = !($total_grade < 80 || $subject1 < 60 || $subject2 < 60 || $subject3 < 60);
                            @endphp
                            <tr>
                                <td data-label="الحاله" class="الحاله">
                                    @if($passed)
                                        <span>ناجح</span>
                                            <style>
                                                tbody .الحاله 
                                                {
                                                    background-color: green;
                                                    color: white;
                                                    font-weight: bold;
                                                }
                                            </style>
                                    @else
                                        <span style="font-weight:bold;">غير ناجح</span>
                                        <style>
                                            tbody  .الحاله{
                                                background-color: rgb(181, 0, 0);
                                                color: white;
                                                font-weight: bold;
                                            }
                                        </style>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <a href="{{ url('/') }}" class="nav-btn" style="margin-bottom:2rem;display:inline-block;">العودة للرئيسية</a>
            </div>
        </div>
    @endif
</body>
</html>