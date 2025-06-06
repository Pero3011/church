<!-- filepath: resources/views/grade.blade.php -->
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>درجات الحضور والمواد</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    @php
        $confession1 = $user->confession1 ?? 0;
        $confession2 = $user->confession2 ?? 0;
        $confession3 = $user->confession3 ?? 0;
        $confession4 = $user->confession4 ?? 0;
        $subject1 = $user->subject1 ?? 0;
        $subject2 = $user->subject2 ?? 0;
        $subject3 = $user->subject3 ?? 0;
        $total_grade = round((($user->attendance1 ?? 0) + ($user->attendance2 ?? 0) 
        + ($user->attendance3 ?? 0) + ($user->attendance4 ?? 0))/ 90 * 100);
        $passed = !($total_grade < 80 || $subject1 < 40 || $subject2 < 40 
        || $subject3 < 40 || $confession1 < 2 || $confession2 < 2 || $confession3 < 2);
    @endphp
    @if(auth()->check() || session('admin_name'))
        <div class="parent">
            <div class="container" id="confession">
                <h2 class="headline" style="padding-top:2rem;">جدول الدرجات والحضور الاعتراف</h2>
                <table class="schedule-table">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>الاعتراف (يناير - فبراير - مارس)</th>
                            <th>الاعتراف (ابريل - مايو - يونيو)</th>
                            <th>الاعتراف (يوليو - اغسطس - سبتمبر)</th>
                            <th>الاعتراف (اكتوبر - نوفمبر - ديسمبر)</th>
                            <th>الحاله</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(session('admin_name')  && isset($users))
                            @foreach($users as $user)
                                <tr>
                                    <td data-label="الاسم">{{ $user->name }}</td>
                                    <td data-label="الاعتراف 1">{{ $user->confession1 ?? '0' }}/3</td>
                                    <td data-label="الاعتراف 2">{{ $user->confession2 ?? '0' }}/3</td>
                                    <td data-label="الاعتراف 3">{{ $user->confession3 ?? '0' }}/3</td>
                                    <td data-label="الاعتراف 4">{{ $user->confession4 ?? '0' }}/3</td>
                                    @if ($confession1 < 2 || $confession2 < 2 || $confession3 < 2 || $confession4 < 2)
                                        <td data-label="الحاله" style="color: red">
                                            <span style="font-weight:bold;">غير ناجح</span>
                                        </td>
                                    @else
                                        <td data-label="الحاله" style="color: green">
                                            <span style="font-weight:bold;">ناجح</span>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @elseif(auth()->check() && isset($user))
                            <tr>
                                <td data-label="الاسم">{{ $user->name }}</td>
                                <td data-label="الاعتراف 1">{{ $user->confession1 ?? '0' }}/3</td>
                                <td data-label="الاعتراف 2">{{ $user->confession2 ?? '0' }}/3</td>
                                <td data-label="الاعتراف 3">{{ $user->confession3 ?? '0' }}/3</td>
                                <td data-label="الاعتراف 4">{{ $user->confession4 ?? '0' }}/3</td>

                                @if ($confession1 < 2 || $confession2 < 2 || $confession3 < 2 || $confession4 < 2)
                                    <td data-label="الحاله" style="color: red">
                                        <span style="font-weight:bold;">غير ناجح</span>
                                    </td>
                                @else
                                    <td data-label="الحاله" style="color: green">
                                        <span style="font-weight:bold;">ناجح</span>
                                    </td>
                                @endif
                            </tr>
                        @endif
                    </tbody>
                </table>
                <table class="schedule-table">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>الحضور (يناير - فبراير - مارس)</th>
                            <th>الحضور (ابريل - مايو - يونيو)</th>
                            <th>الحضور (يوليو - اغسطس - سبتمبر)</th>
                            <th>الحضور (اكتوبر - نوفمبر - ديسمبر)</th>
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
                                    <td data-label="الحضور 4">{{ $user->attendance4 ?? '0' }}</td>
                                    <td data-label="الحضور الكلي">{{$total_grade}}%</td>
                                </tr>
                            @endforeach
                        @elseif(auth()->check() && isset($user))
                            <tr>
                                <td data-label="الاسم">{{ $user->name }}</td>
                                <td data-label="الحضور 1">{{ $user->attendance1 ?? '0'}}</td>
                                <td data-label="الحضور 2">{{ $user->attendance2 ?? '0' }}</td>
                                <td data-label="الحضور 3">{{ $user->attendance3 ?? '0' }}</td>
                                <td data-label="الحضور 4">{{ $user->attendance4 ?? '0' }}</td>
                                <td data-label="الحضور الكلي">{{$total_grade}}%</td>
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
                            <th>الاسم</th>
                            <th>الحاله</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(session('admin_name')  && isset($users))
                            @foreach($users as $user)
                                <tr>
                                    <td data-label="الاسم">{{ $user->name }}</td>
                                @if($passed)
                                    <td data-label="الحاله" style="color: green" >
                                        <span style="font-weight:bold;">ناجح</span>
                                    </td>
                                @else
                                    <td data-label="الحاله" style="color: red">
                                        <span style="font-weight:bold;">غير ناجح</span>
                                    </td>
                                @endif
                                </tr>
                            @endforeach
                        @elseif(auth()->check() && isset($user))
                            <tr>
                                <td data-label="الاسم">{{ $user->name }}</td>
                                @if($passed)
                                    <td data-label="الحاله" style="background-color: green" >
                                        <span style="font-weight:bold; color: white; ">ناجح</span>
                                    </td>
                                @else
                                    <td data-label="الحاله" style="background-color: red">
                                        <span style="font-weight:bold;color: white;">غير ناجح</span>
                                    </td>
                                @endif
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