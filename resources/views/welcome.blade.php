<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="الموقع الرسمي لكنيسة الرسولين بطرس وبولس البطرسية بالعباسية">
    <title>الكنيسة البطرسية</title>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d64dc76508.js" crossorigin="anonymous" defer></script>
    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!--Main container-->
    <div class="parent">
        <div class="container"> 
            <!-- Navbar -->
            <nav aria-label="القائمة الرئيسية"> 
                <div class="bars-icon" id="bars-icon" aria-label="فتح القائمة">
                    <i class="fa-solid fa-bars" aria-hidden="true"></i>
                </div>
                <div class="nav-links">
                    
                    @auth
                        <div class="account desktop-account">
                            <img src="../images/user profile pic background removed.png" alt="صورة المستخدم" width="40" height="40">
                            <h4 style="font-size:1.1rem; margin:0 0.5rem;">
                                {{ auth()->user()->name ?? session('admin_name') }}
                            </h4>
                        </div>
                    @endauth
                    @if(session('admin_name') && !auth()->check())
                        <div class="account desktop-account">
                            <img src="../images/user profile pic background removed.png" alt="صورة المستخدم" width="40" height="40">
                            <h4 style="font-size:1.1rem; margin:0 0.5rem;">
                                {{ session('admin_name') }}
                            </h4>
                        </div>
                    @endif
                                            @auth
                            <li>
                                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="logout-btn nav-btn" id="btn">تسجيل الخروج</button>
                                </form>
                            </li>
                        @else
                            <li>
                                <a href="{{ url('/signup') }}" class="signup-btn nav-btn" id="btn">تسجيل جديد</a>
                            </li>
                            <li>
                                <a href="{{ url('/signin') }}" class="signin-btn nav-btn" id="btn">تسجيل الدخول</a>
                            </li>
                        @endauth
                    <ul class="nav-center">
                        <li><a href="#about">الاخبار</a></li>
                        <li><a href="#services">الخدمات</a></li>
                        <li class="active"><a href="#">الرئيسية</a></li>
                    </ul>
                </div>
                <!-- Logo on the left -->
                <div class="navbar-logo">
                    <img src="{{ asset('images/white logo.png') }}" alt="شعار الكنيسة" style="height:75px; width:auto;">
                </div>
            </nav>
            <div class="sidebar-overlay" id="sidebar-overlay"></div>

            <!--Homepage-->
            <main id="main-content" class="homepage"> 
                <div class="img">
                    <img src="../images/IMG_20220422_130145.jpg" alt="الكنيسة البطرسية" width="400" height="400">
                </div>
                <div class="RHS">
                    <div class="text">
                        <h1 class="title">أسرة إعداد خدام بكنيسة الرسولين بطرس وبولس</h1>
                        <p class="verse">"اعْمَلْ عَمَلَ الْمُبَشِّرِ. تَمِّمْ خِدْمَتَكَ." (2 تي 4: 5)</p>
                    </div>
                    <div class="icons">
                        <i class="fa-solid fa-book" aria-hidden="true"></i>
                        <i class="fa-solid fa-church" aria-hidden="true"></i>
                        <i class="fa-solid fa-cross" aria-hidden="true"></i>
                    </div>
                </div>
            </main>  
        </div>
    </div>

    <!--Services Section-->
    <section id="services" class="services" aria-labelledby="services-heading">
        <div class="container">
            <div class="header">
                <h2 id="services-heading" class="headline">الخدمات الخاصة بالكنيسة</h2>
            </div>
            <div class="contents">
                <article class="service-card">
                    <div class="service-icon">
                        <i class="fa-solid fa-mountain-sun" aria-hidden="true"></i>
                    </div>
                    <h3 class="service-title">الخلوات والمؤتمرات</h3>
                    <p class="service-description">
                        هنا يمكن معرفة مواعيد الخلوات والمؤتمرات والاطلاع على الملفات الخاصة ببرنامج الخلوة أو المؤتمر والمنشورات الخاصة بهم
                    </p>
                    <a href="{{ route('schedule') }}" class="service-link">
                        المزيد من التفاصيل
                        <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                    </a>
                </article>

                <article class="service-card">
                    <div class="service-icon">
                        <i class="fa-solid fa-clipboard-check" aria-hidden="true"></i>
                    </div>
                    <h3 class="service-title">الحضور والنتائج</h3>
                    <p class="service-description">
                        هنا يمكنك الوصول إلى الحضور والنتائج الخاصة بالامتحانات والاعتراف التي تتوافر كل ثلاثة
                    </p>
                    <a href="{{ route('grade') }}" class="service-link">
                        المزيد من التفاصيل
                        <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                    </a>
                </article>

                <article class="service-card">
                    <div class="service-icon">
                        <i class="fa-solid fa-hands-praying" aria-hidden="true"></i>
                    </div>
                    <h3 class="service-title">الصلوات والقداسات</h3>
                    <p class="service-description">
                        جدول مواعيد الصلوات والقداسات الأسبوعية والسنوية، مع إمكانية الحصول على الكتب الطقسية ونصوص الصلوات
                    </p>
                    <a href="#" class="service-link">
                        المزيد من التفاصيل
                        <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                    </a>
                </article>
            </div>
        </div>
    </section>
  
    <!-- About the church -->
    <section class="about" id="about" aria-labelledby="about-heading">
        <h2 id="about-heading" class="headline">عن الكنيسة البطرسية</h2>
        <div class="aboutcontainer">
            <article class="establishment">
                <div class="LHS">
                    <img src="../images/establishment.jpg" alt="صورة تأسيس الكنيسة" width="400" height="300">
                </div>
                <div class="RHS">
                    <h3>تأسيس الكنيسة</h3>
                    <div class="date">1911</div>
                    <p>
                        تولى بناءها عائلة "بطرس غالي باشا"، رئيس وزراء مصر الأسبق، وبُنيت فوق مدفن العائلة سنة 1911، تخليدًا لذكراه، وسُميت بطرسية نسبةً لهم.
                        افتتحها البابا كيرلس الخامس، في حفل حضره مندوب الخديوى عباس حلمى وكبار رجال الدولة والطائفة.
                    </p>
                </div>
            </article>

            <article class="accident">
                <div class="LHS">
                    <img src="../images/accident.jpg" alt="صورة الكنيسة بعد الحادث" width="400" height="300">
                </div>
                <div class="RHS">
                    <h3>الحادث</h3>
                    <div class="date">2016</div>
                    <p>
                        وقع يوم الأحد 11 ديسمبر 2016، انتقل فيها 28 شخص وأصيب 31 مصابًا. توصلت الأجهزة الأمنية المصرية أن المتسبب هو الانتحاري محمود شفيق محمد مصطفى الذي عمره 22 سنة وكان يحمل حزام متفجر.
                    </p>
                </div>
            </article>

            <article class="about-church">
                <div class="LHS">
                    <img src="../images/church.jpg" alt="صورة الكنيسة الحالية" width="400" height="300">
                </div>
                <div class="RHS">
                    <h3>عن الكنيسة</h3>
                    <div class="date">1911</div>
                    <p>
                        الكنيسة البطرسية هي من أشهر الكنائس التي أُكرست على اسم الرسولين "بطرس" و"بولس" وتقع الكنيسة في شارع رمسيس بالعباسية ملاصقة للكاتدرائية المرقسية.
                    </p>
                </div>
            </article>
        </div>
    </section>
    
    <!-- Footer -->
    <footer>
        <div class="social-icons">
            <a href="#" aria-label="فيسبوك"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" aria-label="يوتيوب"><i class="fa-brands fa-youtube"></i></a>
            <a href="#" aria-label="تويتر"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="#" aria-label="إنستجرام"><i class="fa-brands fa-instagram"></i></a>
        </div>
        <div class="copyrights">
            <p>&copy; <span id="year"></span> جميع الحقوق محفوظة لكنيسة الرسولين بطرس وبولس البطرسية</p>
        </div>
    </footer>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const barsIcon = document.getElementById('bars-icon');
    const closeSidebar = document.getElementById('close-sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    const navLinks = document.querySelector('.nav-links');

    // Open sidebar
    if (barsIcon) {
        barsIcon.addEventListener('click', function() {
            navLinks.classList.add('open');
            sidebarOverlay.classList.add('active');
        });
    }

    // Close sidebar on overlay click
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', function() {
            navLinks.classList.remove('open');
            sidebarOverlay.classList.remove('active');
        });
    }

    // Close sidebar on close button click
    if (closeSidebar) {
        closeSidebar.addEventListener('click', function() {
            navLinks.classList.remove('open');
            sidebarOverlay.classList.remove('active');
        });
    }

    // Update copyright year
    const yearSpan = document.getElementById('year');
    if (yearSpan) {
        yearSpan.textContent = new Date().getFullYear();
    }
});
</script>
</body>
</html>