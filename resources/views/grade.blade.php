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
                <h2 class="headline" style="padding-top:2rem;">جدول الدرجات والحضور و الاعتراف</h2>
                <table class="grades-table">
                    <thead>
                        <tr>
                            <th>الاسم</th>                            
                            @if (\Carbon\Carbon::now()->month >= 1 && \Carbon\Carbon::now()->month <= 3)
                                <th colspan="5" style="text-align: center;">الاعتراف (يناير - فبراير - مارس)</th>
                            @elseif (\Carbon\Carbon::now()->month >= 4 && \Carbon\Carbon::now()->month <= 6)
                                <th style="text-align: center;">الاعتراف (يناير - فبراير - مارس)</th>
                                <th style="text-align: center;">الاعتراف (ابريل - مايو - يونيو)</th>
                            @elseif (\Carbon\Carbon::now()->month >= 7 && \Carbon\Carbon::now()->month <= 9)
                                <th style="text-align: center;">الاعتراف (يناير - فبراير - مارس)</th>
                                <th style="text-align: center;">الاعتراف (ابريل - مايو - يونيو)</th>                            
                                <th style="text-align: center;">الاعتراف (يوليو - اغسطس - سبتمبر)</th>
                            @elseif (\Carbon\Carbon::now()->month >= 10 && \Carbon\Carbon::now()->month <= 12)
                                <th style="text-align: center;">الاعتراف (يناير - فبراير - مارس)</th>
                                <th style="text-align: center;">الاعتراف (ابريل - مايو - يونيو)</th>                            
                                <th style="text-align: center;">الاعتراف (يوليو - اغسطس - سبتمبر)</th>                            
                                <th style="text-align: center;">الاعتراف (اكتوبر - نوفمبر - ديسمبر)</th>
                            @endif
                            <th>الحاله</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(session('admin_name')  && isset($users))
                            @foreach($users as $user)
                                @php
                                    $confession1 = $user->confession1 ?? 0;
                                    $confession2 = $user->confession2 ?? 0;
                                    $confession3 = $user->confession3 ?? 0;
                                    $confession4 = $user->confession4 ?? 0;
                                    $status = '';
                                    $color = '';
                                    $month = \Carbon\Carbon::now()->month;
                                @endphp
                                <tr>
                                    <td data-label="الاسم">{{ $user->name }}</td>
                                    @if ($month >= 1 && $month <= 3)
                                        <td data-label="الاعتراف 1">{{ $confession1 }}/3</td>
                                        @if ($confession1 < 2)
                                            <td data-label="الحاله" style="color: red"><span style="font-weight:bold;">غير ناجح</span></td>
                                        @else
                                            <td data-label="الحاله" style="color: green"><span style="font-weight:bold;">ناجح</span></td>
                                        @endif
                                    @elseif ($month >= 4 && $month <= 6)
                                        <td data-label="الاعتراف 1">{{ $confession1 }}/3</td>
                                        <td data-label="الاعتراف 2">{{ $confession2 }}/3</td>
                                        @if ($confession1 < 2 || $confession2 < 2)
                                            <td data-label="الحاله" style="color: red"><span style="font-weight:bold;">غير ناجح</span></td>
                                        @else
                                            <td data-label="الحاله" style="color: green"><span style="font-weight:bold;">ناجح</span></td>
                                        @endif
                                    @elseif ($month >= 7 && $month <= 9)
                                        <td data-label="الاعتراف 1">{{ $confession1 }}/3</td>
                                        <td data-label="الاعتراف 2">{{ $confession2 }}/3</td>
                                        <td data-label="الاعتراف 3">{{ $confession3 }}/3</td>
                                        <td></td>
                                        @if ($confession1 < 2 || $confession2 < 2 || $confession3 < 2)
                                            <td data-label="الحاله" style="color: red"><span style="font-weight:bold;">غير ناجح</span></td>
                                        @else
                                            <td data-label="الحاله" style="color: green"><span style="font-weight:bold;">ناجح</span></td>
                                        @endif
                                    @else
                                        <td data-label="الاعتراف 1">{{ $confession1 }}/3</td>
                                        <td data-label="الاعتراف 2">{{ $confession2 }}/3</td>
                                        <td data-label="الاعتراف 3">{{ $confession3 }}/3</td>
                                        <td data-label="الاعتراف 4">{{ $confession4 }}/3</td>
                                        @if ($confession1 < 2 || $confession2 < 2 || $confession3 < 2 || $confession4 < 2)
                                            <td data-label="الحاله" style="color: red"><span style="font-weight:bold;">غير ناجح</span></td>
                                        @else
                                            <td data-label="الحاله" style="color: green"><span style="font-weight:bold;">ناجح</span></td>
                                        @endif
                                    @endif
                                </tr>
                            @endforeach
                        @elseif(auth()->check() && isset($user))
                            <tr>
                                <td data-label="الاسم">{{ $user->name }}</td>
                                @if ($month >= 1 && $month <= 3)
                                    <td data-label="الاعتراف 1">{{ $confession1 }}/3</td>
                                    @if ($confession1 < 2)
                                        <td data-label="الحاله" style="color: red"><span style="font-weight:bold;">غير ناجح</span></td>
                                    @else
                                        <td data-label="الحاله" style="color: green"><span style="font-weight:bold;">ناجح</span></td>
                                    @endif
                                @elseif ($month >= 4 && $month <= 6)
                                    <td data-label="الاعتراف 1">{{ $confession1 }}/3</td>
                                    <td data-label="الاعتراف 2">{{ $confession2 }}/3</td>
                                    @if ($confession1 < 2 || $confession2 < 2)
                                        <td data-label="الحاله" style="color: red"><span style="font-weight:bold;">غير ناجح</span></td>
                                    @else
                                        <td data-label="الحاله" style="color: green"><span style="font-weight:bold;">ناجح</span></td>
                                    @endif
                                @elseif ($month >= 7 && $month <= 9)
                                    <td data-label="الاعتراف 1">{{ $confession1 }}/3</td>
                                    <td data-label="الاعتراف 2">{{ $confession2 }}/3</td>
                                    <td data-label="الاعتراف 3">{{ $confession3 }}/3</td>
                                    <td></td>
                                    @if ($confession1 < 2 || $confession2 < 2 || $confession3 < 2)
                                        <td data-label="الحاله" style="color: red"><span style="font-weight:bold;">غير ناجح</span></td>
                                    @else
                                        <td data-label="الحاله" style="color: green"><span style="font-weight:bold;">ناجح</span></td>
                                    @endif
                                @else
                                    <td data-label="الاعتراف 1">{{ $confession1 }}/3</td>
                                    <td data-label="الاعتراف 2">{{ $confession2 }}/3</td>
                                    <td data-label="الاعتراف 3">{{ $confession3 }}/3</td>
                                    <td data-label="الاعتراف 4">{{ $confession4 }}/3</td>
                                    @if ($confession1 < 2 || $confession2 < 2 || $confession3 < 2 || $confession4 < 2)
                                        <td data-label="الحاله" style="color: red"><span style="font-weight:bold;">غير ناجح</span></td>
                                    @else
                                        <td data-label="الحاله" style="color: green"><span style="font-weight:bold;">ناجح</span></td>
                                    @endif
                                @endif
                            </tr>
                        @endif
                    </tbody>
                </table>
                <table class="grades-table">
                    @php
                        $month = \Carbon\Carbon::now()->month;
                    @endphp
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            @if (\Carbon\Carbon::now()->month >= 1 && \Carbon\Carbon::now()->month <= 3)
                                <th colspan="5" style="text-align: center;">الحضور (يناير - فبراير - مارس)</th>
                            @elseif (\Carbon\Carbon::now()->month >= 4 && \Carbon\Carbon::now()->month <= 6)
                                <th style="text-align: center;">الحضور (يناير - فبراير - مارس)</th>
                                <th style="text-align: center;">الحضور (ابريل - مايو - يونيو)</th>
                            @elseif (\Carbon\Carbon::now()->month >= 7 && \Carbon\Carbon::now()->month <= 9)
                                <th style="text-align: center;">الحضور (يناير - فبراير - مارس)</th>
                                <th style="text-align: center;">الحضور (ابريل - مايو - يونيو)</th>                            
                                <th style="text-align: center;">الحضور (يوليو - اغسطس - سبتمبر)</th>
                            @elseif (\Carbon\Carbon::now()->month >= 10 && \Carbon\Carbon::now()->month <= 12)
                                <th style="text-align: center;">الحضور (يناير - فبراير - مارس)</th>
                                <th style="text-align: center;">الحضور (ابريل - مايو - يونيو)</th>                            
                                <th style="text-align: center;">الحضور (يوليو - اغسطس - سبتمبر)</th>                            
                                <th style="text-align: center;">الحضور (اكتوبر - نوفمبر - ديسمبر)</th>
                            @endif
                            <th>الحضور الكلي</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(session('admin_name')  && isset($users))
                            @foreach($users as $user)
                                <tr>
                                    <td data-label="الاسم">{{ $user->name }}</td>
                                    @if ($month >= 1 && $month <= 3)
                                        <td data-label="الحضور 1">{{ $user->attendance1 ?? '0'}}</td>
                                    @elseif ($month >= 4 && $month <= 6)
                                        <td data-label="الحضور 1">{{ $user->attendance1 ?? '0'}}</td>
                                        <td data-label="الحضور 2">{{ $user->attendance2 ?? '0' }}</td>
                                    @elseif ($month >= 7 && $month <= 9)
                                        <td data-label="الحضور 1">{{ $user->attendance1 ?? '0'}}</td>
                                        <td data-label="الحضور 2">{{ $user->attendance2 ?? '0' }}</td>
                                        <td data-label="الحضور 3">{{ $user->attendance3 ?? '0' }}</td>
                                    @else
                                        <td data-label="الحضور 1">{{ $user->attendance1 ?? '0'}}</td>                                    
                                        <td data-label="الحضور 2">{{ $user->attendance2 ?? '0' }}</td>
                                        <td data-label="الحضور 3">{{ $user->attendance3 ?? '0' }}</td>
                                        <td data-label="الحضور 4">{{ $user->attendance4 ?? '0' }}</td>
                                    @endif
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