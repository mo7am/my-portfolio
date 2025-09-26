<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Work Up And Zealously Exhibit" />
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo/logo.png') }}" />
  <title>{{ config('app.name') }} | @yield('title')</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    main {
      flex: 1;
    }

    /* ---- Personal Info ---- */
    .personal-info .info-wrapper {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      gap: 20px;
    }

    .personal-info .info-text { flex: 1; }

    .personal-info .info-photo { flex-shrink: 0; }

    .personal-info .info-photo img {
      width: 200px;
      height: 200px;
      object-fit: cover;
      border: 3px solid #eee;
      box-shadow: 0 4px 8px rgba(0,0,0,.1);
    }

    .square-image {
      aspect-ratio: 1 / 1;
      object-fit: cover;
      border-radius: 8px;
    }

    img, .hero-visual img {
      max-width: 100%;
      height: auto;
    }

    /* ---- Responsive Hero ---- */
    @media (max-width: 860px){
      .hero { grid-template-columns: 1fr; text-align: center; }
      .hero-visual img { max-width: 80%; margin: 0 auto; display: block; }
    }

    /* ---- Navbar ---- */
    .nav-toggle {
      display: none;
      background: none;
      border: none;
      color: var(--text);
      font-size: 26px;
      cursor: pointer;
    }

    @media (max-width: 768px) {
      .nav {
        flex-direction: column;
        gap: 8px;
        position: absolute;
        top: 64px;
        left: 0;
        right: 0;
        background: var(--panel);
        padding: 10px;
        display: none;
      }
      .nav.show { display: flex; }
      .nav-link { text-align: center; padding: 12px; }
      .nav-toggle { display: block; }
      .container h1 { margin-top: -10px; }
    }

    /* ---- Timeline ---- */
    .timeline li { grid-template-columns: 80px 1fr; gap: 16px; }
    @media (max-width: 600px){ .timeline li { grid-template-columns: 1fr; gap: 8px; } }

    /* ---- Padding Mobile ---- */
    @media (max-width: 600px){
      .container, .hero, .cards, .resume-section, .project { padding: 12px; }
      .personal-info .info-photo img {
        width: 100px; height: 150px; margin-top: 29px;
      }
    }
    
    * {
      overflow-wrap: break-word;
    }
    /* ---- Project ---- */
    .project { max-width: 100%; overflow-x: hidden; 
      word-wrap: break-word;
      overflow-wrap: break-word;
    }
    .project * { max-width: 100%; box-sizing: border-box; }
    .cards { margin-bottom: 50px; }

    /* ---- Footer ---- */
    .site-footer {
      background: #0b0f17;
      color: #fff;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 20px;
      margin-top: auto;
    }

    .site-footer p { margin: 0; }

    .site-footer .socials {
      display: flex;
      gap: 15px;
      font-size: 20px;
    }

    .site-footer .socials a { color: var(--text); }

    @media (max-width: 600px) {
      .site-footer {
        flex-direction: column;
        text-align: center;
        gap: 10px;
        height: auto;
        padding: 1px;
      }
      .site-footer .socials { justify-content: center; }

      .socials {
          margin-bottom: 13px !important;
          margin-top: -7px !important;
      }

      .cta {
        display: flex;
        justify-content: center;
        gap: 10px;
        flex-wrap: wrap; 
      }
    }

    @media (max-width: 768px) {
      .personal-info .info-wrapper {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }

      .personal-info .info-photo {
        order: -1;
        margin-bottom: -15px;
      }

      .personal-info .info-text {
        width: 100%;
      }

      .cta {
        display: flex;
        justify-content: center;
        gap: 10px;
        flex-wrap: wrap; 
      }
    }
  </style>
</head>
<body>
  <header>
    <div class="site-header">
      <a class="brand" href="{{ route('portfolio.home', ['domain' => tenant()->user->domain]) }}">
        <span>{{ tenant()->user->first_name }}</span> {{ tenant()->user->second_name }}
      </a>
      <button class="nav-toggle"><i class="bi bi-list"></i></button>
      <nav class="nav">
        @if(auth('sanctum')->check())
          <a href="{{ auth('sanctum')->user()->type === \App\Enums\UserType::CLIENT->value ? route('clients.index') :  route('admins.index')}}" class="nav-link">Dashboard</a>
        @endif
        <a href="{{ route('portfolio.home', ['domain' => tenant()->user->domain]) }}" class="nav-link">Home</a>
        @if (tenant()->is_show_project)
          <a href="{{ route('portfolio.projects', ['domain' => tenant()->user->domain]) }}" class="nav-link">Projects</a>
        @endif
        <a href="{{ route('portfolio.resume', ['domain' => tenant()->user->domain]) }}" class="nav-link">Resume</a>
        @if (tenant()->is_show_contact)
          <a href="{{ route('portfolio.contact', ['domain' => tenant()->user->domain]) }}" class="nav-link">Contact</a>
        @endif
      </nav>
    </div>
  </header>

  <main>
    @yield('content')
  </main>

  <footer class="site-footer">
    <p style="font-size: 15px;">© <span id="year"></span> {{ tenant()->user->name }}. All rights reserved.</p>
  
    @if (tenant()->is_show_link)
      <div class="socials">
        @foreach (tenant()->links as $link)
          <a href="{{ $link->link }}" target="_blank" rel="noopener" style="color: {{ $link->color ?? '#fff' }};">
            <i class="{{ $link->icon }}"></i>
          </a>
        @endforeach
      </div>
    @endif
  </footer>

  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>AOS.init({duration:700, once:true});</script>
  <script>document.getElementById("year").textContent = new Date().getFullYear();</script>
  <script>
    @if(session('success'))
      Swal.fire({ icon: 'success', title: 'Success', text: '{{ session('success') }}' });
    @endif
    @if($errors->any())
      Swal.fire({ icon: 'error', title: 'Validation Error', html: '{!! implode('<br>', $errors->all()) !!}' });
    @endif
  </script>
  <script>
    document.querySelector('.nav-toggle').addEventListener('click', () => {
      document.querySelector('.nav').classList.toggle('show');
    });
  </script>
</body>
</html>
