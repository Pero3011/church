<!-- resources/views/signin.blade.php -->
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
<div class="auth-bg">
    <div class="auth-card">
        <h2 class="headline">تسجيل الدخول</h2>
        @if ($errors->any())
            <div class="error">
                <ul style="margin:0;padding:0 1.2rem;">
                    @foreach ($errors->all() as $error)
                        <li style="margin-bottom:0.3rem;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ url('/signin') }}">
            @csrf
            <div>
                <label>البريد الإلكتروني:</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div>
                <label>كلمة المرور:</label>
                <div style="position:relative;">
                    <input type="password" name="password" id="signin_password" required style="padding-left:2.5rem;">
                    <button type="button" onclick="togglePassword('signin_password', this)" style="position:absolute; left:0.5rem; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer;">
                        👁️
                    </button>
                </div>
            </div>
            <button type="submit">دخول</button>
        </form>
    </div>
</div>
<script>
function togglePassword(fieldId, btn) {
    const input = document.getElementById(fieldId);
    if (input.type === "password") {
        input.type = "text";
        btn.textContent = "🙈";
    } else {
        input.type = "password";
        btn.textContent = "👁️";
    }
}
</script>
</body>
</html>