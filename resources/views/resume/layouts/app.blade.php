<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" data-theme="dark">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <script>
      (function () {
        try {
          var saved = localStorage.getItem('portfolio-theme');
          var theme = saved === 'light' || saved === 'dark'
            ? saved
            : (window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark');
          document.documentElement.setAttribute('data-theme', theme);
        } catch (e) {
          document.documentElement.setAttribute('data-theme', 'dark');
        }
      })();
    </script>

    <title>{{ tenant()->user->first_name }} {{ tenant()->user->second_name }} | {{ config('app.name') }}</title>
    <meta name="description" content="Build a stunning online portfolio and resume in minutes. Showcase your projects, highlight your skills, and download a professional CV instantly.">
    <meta name="keywords" content="portfolio, resume, cv, online cv, {{ tenant()->user->first_name }} {{ tenant()->user->second_name }}, portfolio, resume, cv, professional profile">
    <meta name="robots" content="index, follow" />

    <meta property="og:title" content="{{ tenant()->user->first_name }} {{ tenant()->user->second_name }} - {{ tenant()->user->job_title??__('app.portfolio') }}" />
    <meta property="og:description" content="Build a stunning online portfolio and resume in minutes. Showcase your projects, highlight your skills, and download a professional CV instantly." />
    <meta property="og:image" content="{{ tenant()->user->getFirstMediaUrl('logo')}}" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:image:secure_url" content="{{ tenant()->user->getFirstMediaUrl('logo')}}" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta name="twitter:image" content="{{ tenant()->user->getFirstMediaUrl('logo')}}" />
    <meta property="fb:app_id" content="1147733860574178" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ tenant()->user->first_name }} {{ tenant()->user->second_name }} - {{ tenant()->user->job_title??__('app.portfolio') }}" />
    <meta name="twitter:description" content="Build a stunning online portfolio and resume in minutes. Showcase your projects, highlight your skills, and download a professional CV instantly." />
    <meta name="twitter:image" content="{{ tenant()->user->getFirstMediaUrl('logo') }}" />

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo/logo.png') }}" />
    <link rel="canonical" href="{{ url()->current() }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    
  </head>
  <body>
    @php
      $domain = tenant()->user->domain;
      $currentRoute = request()->route()?->getName();
    @endphp

    <header class="site-header">
      <a class="brand" href="{{ route('portfolio.home', ['domain' => $domain]) }}">
        <span>{{ ucwords(tenant()->user->first_name) }}</span> {{ ucwords(tenant()->user->second_name) }}
      </a>

      @if(!auth('sanctum')->check())
        <div class="cta-message">
          {{ __('app.new_on_platform') }}
          <a href="{{ route('register') }}">{{ __('app.create_account') }}</a>
        </div>
      @endif

      <nav class="nav" aria-label="Primary">
        @if(auth('sanctum')->check())
          <a href="{{ auth('sanctum')->user()->type === \App\Enums\UserType::CLIENT->value ? route('clients.index') : route('admins.index') }}" class="nav-link">{{ __('app.dashboard') }}</a>
        @endif
        <a href="{{ route('portfolio.home', ['domain' => $domain]) }}" class="nav-link {{ $currentRoute === 'portfolio.home' ? 'active' : '' }}">{{ __('app.home') }}</a>
        @if (tenant()->is_show_project)
          <a href="{{ route('portfolio.projects', ['domain' => $domain]) }}" class="nav-link {{ $currentRoute === 'portfolio.projects' ? 'active' : '' }}">{{ __('app.projects') }}</a>
        @endif
        <a href="{{ route('portfolio.resume', ['domain' => $domain]) }}" class="nav-link {{ $currentRoute === 'portfolio.resume' ? 'active' : '' }}">{{ __('app.resume') }}</a>
        @if (tenant()->is_show_contact)
          <a href="{{ route('portfolio.contact', ['domain' => $domain]) }}" class="nav-link {{ $currentRoute === 'portfolio.contact' ? 'active' : '' }}">{{ __('app.contact') }}</a>
        @endif
      </nav>

      <div class="header-actions">
        <div class="locale-switch" style="display:inline-flex;gap:.35rem;align-items:center;">
          <a class="btn {{ app()->getLocale() === 'en' ? 'primary' : '' }}" style="padding:.45rem .7rem;font-size:.8rem;" href="{{ route('locale.switch', 'en') }}">EN</a>
          <a class="btn {{ app()->getLocale() === 'ar' ? 'primary' : '' }}" style="padding:.45rem .7rem;font-size:.8rem;" href="{{ route('locale.switch', 'ar') }}">ع</a>
        </div>
        <button class="theme-toggle" type="button" aria-label="{{ __('app.toggle_theme') }}" title="{{ __('app.toggle_theme') }}">
          <i class="bi bi-moon-stars icon-moon" aria-hidden="true"></i>
          <i class="bi bi-sun icon-sun" aria-hidden="true"></i>
        </button>
        <button class="nav-toggle" type="button" aria-label="{{ __('app.toggle_nav') }}" aria-expanded="false">
          <i class="bi bi-list"></i>
        </button>
      </div>

      <div class="nav-overlay" hidden></div>
    </header>

    <main class="site-main">
      @yield('content')
    </main>

    <footer class="site-footer">
      <p>© <span id="year"></span> {{ ucwords(tenant()->user->name) }}. {{ __('app.all_rights_reserved') }}</p>

      @if (tenant()->is_show_link)
        <div class="socials">
          @foreach (tenant()->links as $link)
            <a href="{{ $link->link }}" target="_blank" rel="noopener" aria-label="Social link" @if(!empty($link->color) && !in_array(strtolower($link->color), ['#fff', '#ffffff', 'white'], true)) style="color: {{ $link->color }};" @endif>
              <i class="{{ $link->icon }}"></i>
            </a>
          @endforeach
        </div>
      @endif
    </footer>

    @include('partials.sweetalert')
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
      AOS.init({ duration: 650, once: true, easing: 'ease-out-cubic', offset: 40 });
      document.getElementById('year').textContent = new Date().getFullYear();

      (function () {
        const root = document.documentElement;
        const themeBtn = document.querySelector('.theme-toggle');

        const setTheme = (theme) => {
          root.setAttribute('data-theme', theme);
          try { localStorage.setItem('portfolio-theme', theme); } catch (e) {}
          if (themeBtn) {
            themeBtn.setAttribute('aria-label', theme === 'light' ? 'Switch to dark theme' : 'Switch to light theme');
            themeBtn.setAttribute('title', theme === 'light' ? 'Switch to dark' : 'Switch to light');
          }
        };

        if (themeBtn) {
          themeBtn.addEventListener('click', () => {
            const next = root.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
            setTheme(next);
          });
          setTheme(root.getAttribute('data-theme') || 'dark');
        }
      })();

      (function () {
        const toggle = document.querySelector('.nav-toggle');
        const nav = document.querySelector('.nav');
        const overlay = document.querySelector('.nav-overlay');
        const icon = toggle?.querySelector('i');

        if (!toggle || !nav) return;

        const setOpen = (open) => {
          nav.classList.toggle('show', open);
          overlay?.classList.toggle('show', open);
          if (overlay) overlay.hidden = !open;
          document.body.classList.toggle('nav-open', open);
          toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
          if (icon) {
            icon.className = open ? 'bi bi-x-lg' : 'bi bi-list';
          }
        };

        toggle.addEventListener('click', () => setOpen(!nav.classList.contains('show')));
        overlay?.addEventListener('click', () => setOpen(false));
        nav.querySelectorAll('a').forEach((link) => {
          link.addEventListener('click', () => setOpen(false));
        });
        window.addEventListener('resize', () => {
          if (window.innerWidth > 900) setOpen(false);
        });
      })();
    </script>
    <script>
      @if(session('success'))
        PortfolioToast.fire({ icon: 'success', title: @json(session('success')) });
      @endif
      @if($errors->any())
        PortfolioToast.fire({ icon: 'error', title: @json($errors->first()) });
      @endif
    </script>
  </body>
</html>
