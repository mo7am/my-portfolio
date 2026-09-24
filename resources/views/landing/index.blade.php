@extends('landing.layouts.master')

@section('content')
@php
  $icons = [
    'globe' => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>',
    'layers' => '<path d="M12 2 2 7l10 5 10-5-10-5Z"/><path d="m2 17 10 5 10-5"/><path d="m2 12 10 5 10-5"/>',
    'file' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M8 13h8"/><path d="M8 17h6"/>',
    'languages' => '<path d="m5 8 6 6"/><path d="m4 14 6-6 2-3"/><path d="M2 5h12"/><path d="M7 2h1"/><path d="m22 22-5-10-5 10"/><path d="M14 18h6"/>',
    'cloud' => '<path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"/>',
    'sliders' => '<path d="M4 21v-7"/><path d="M4 10V3"/><path d="M12 21v-9"/><path d="M12 8V3"/><path d="M20 21v-5"/><path d="M20 12V3"/><path d="M1 14h6"/><path d="M9 8h6"/><path d="M17 16h6"/>',
    'star' => '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>',
    'users' => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
    'zap' => '<polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>',
    'shield' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
    'heart' => '<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>',
    'briefcase' => '<rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/>',
  ];
  $contactEmail = $settings->contact_email ?: config('landing.contact_email');
  $socialLinks = $settings->socialLinks();
@endphp

@if($settings->hasAnnouncement())
  <div class="lp-announce">
    <div class="lp-announce__inner">
      @if($settings->announcement_url)
        <a href="{{ $settings->announcement_url }}">{{ $settings->announcement_text }}</a>
      @else
        <span>{{ $settings->announcement_text }}</span>
      @endif
    </div>
  </div>
@endif

<header class="lp-nav" id="lpNav" data-lp-nav>
  <div class="lp-nav__inner">
    <a href="#top" class="lp-brand">
      <img src="{{ asset('assets/logo/logo.png') }}" alt="{{ config('app.name') }}">
      <span>{{ config('app.name') }}</span>
    </a>

    <nav class="lp-nav__links" aria-label="Primary">
      @if($features->isNotEmpty())<a href="#features">{{ __('landing.nav.features') }}</a>@endif
      @if($steps->isNotEmpty())<a href="#how">{{ __('landing.nav.how') }}</a>@endif
      <a href="#preview">{{ __('landing.nav.preview') }}</a>
      @if($plans->isNotEmpty())<a href="#pricing">{{ __('landing.nav.pricing') }}</a>@endif
      @if($faqs->isNotEmpty())<a href="#faq">{{ __('landing.nav.faq') }}</a>@endif
    </nav>

    <div class="lp-nav__actions">
      <div class="lp-locale" aria-label="Language">
        <a href="{{ route('locale.switch', 'en') }}" class="{{ app()->getLocale() === 'en' ? 'is-active' : '' }}">EN</a>
        <a href="{{ route('locale.switch', 'ar') }}" class="{{ app()->getLocale() === 'ar' ? 'is-active' : '' }}">ع</a>
      </div>
      <a class="lp-nav__login" href="{{ route('login') }}">{{ __('landing.nav.login') }}</a>
      <a class="lp-btn lp-btn--primary lp-nav__cta" href="{{ route('register') }}">{{ __('landing.nav.get_started') }}</a>
      <button type="button" class="lp-burger" id="lpBurger" aria-expanded="false" aria-controls="lpMobileMenu" aria-label="{{ __('landing.nav.menu') }}">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</header>

<div class="lp-mobile-menu" id="lpMobileMenu" hidden>
  @if($features->isNotEmpty())<a href="#features" data-lp-mobile-link>{{ __('landing.nav.features') }}</a>@endif
  @if($steps->isNotEmpty())<a href="#how" data-lp-mobile-link>{{ __('landing.nav.how') }}</a>@endif
  <a href="#preview" data-lp-mobile-link>{{ __('landing.nav.preview') }}</a>
  @if($plans->isNotEmpty())<a href="#pricing" data-lp-mobile-link>{{ __('landing.nav.pricing') }}</a>@endif
  @if($faqs->isNotEmpty())<a href="#faq" data-lp-mobile-link>{{ __('landing.nav.faq') }}</a>@endif
  <div class="lp-mobile-menu__cta">
    <a class="lp-btn lp-btn--ghost" href="{{ route('login') }}">{{ __('landing.nav.login') }}</a>
    <a class="lp-btn lp-btn--primary" href="{{ route('register') }}">{{ __('landing.nav.get_started') }}</a>
  </div>
</div>

<main id="top">
  <section class="lp-hero">
    <div class="lp-container lp-hero__grid">
      <div class="lp-hero__copy" data-lp-hero-copy>
        @if($settings->hero_eyebrow)
          <p class="lp-eyebrow lp-hero__eyebrow lp-reveal-item">{{ $settings->hero_eyebrow }}</p>
        @endif
        <h1 class="lp-hero__title lp-reveal-item">{{ $settings->hero_title ?: __('landing.hero.title') }}</h1>
        @if($settings->hero_subtitle)
          <p class="lp-hero__subtitle lp-reveal-item">{{ $settings->hero_subtitle }}</p>
        @endif
        <div class="lp-cta-row lp-reveal-item">
          <a class="lp-btn lp-btn--primary" href="{{ route('register') }}">{{ $settings->hero_cta_primary ?: __('landing.hero.cta_primary') }}</a>
          @if($steps->isNotEmpty())
            <a class="lp-btn lp-btn--ghost" href="#how">{{ $settings->hero_cta_secondary ?: __('landing.hero.cta_secondary') }}</a>
          @endif
        </div>
      </div>

      <div class="lp-hero__visual" aria-hidden="true">
        <div class="lp-mock">
          <div class="lp-mock__chrome">
            <span class="lp-mock__dot"></span>
            <span class="lp-mock__dot"></span>
            <span class="lp-mock__dot"></span>
            <span class="lp-mock__url">portfolio.app/you</span>
          </div>
          <div class="lp-mock__body">
            <div class="lp-mock__nav">
              <span>{{ __('landing.mock.nav_home') }}</span>
              <span>{{ __('landing.mock.nav_projects') }}</span>
              <span>{{ __('landing.mock.nav_resume') }}</span>
            </div>
            <div class="lp-mock__hero-line lp-mock__hero-line--lg"></div>
            <div class="lp-mock__hero-line"></div>
            <div class="lp-mock__hero-line lp-mock__hero-line--sm"></div>
            <span class="lp-mock__btn">{{ __('landing.mock.cta_view') }}</span>
            <div class="lp-mock__cards">
              <div class="lp-mock__card"></div>
              <div class="lp-mock__card"></div>
              <div class="lp-mock__card"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="lp-section lp-problem" id="overview">
    <div class="lp-container lp-problem__grid">
      <div class="lp-reveal">
        <p class="lp-eyebrow">{{ __('landing.problem.eyebrow') }}</p>
        <h2 class="lp-title">{{ __('landing.problem.title') }}</h2>
        <p class="lp-lead">{{ __('landing.problem.body') }}</p>
        <ul class="lp-checklist">
          <li>{{ __('landing.problem.point_1') }}</li>
          <li>{{ __('landing.problem.point_2') }}</li>
          <li>{{ __('landing.problem.point_3') }}</li>
        </ul>
      </div>
      <div class="lp-problem__visual lp-reveal" aria-hidden="true">
        <div class="lp-problem__stack">
          <div class="lp-problem__sheet"><strong>CV.docx</strong><span>outdated</span></div>
          <div class="lp-problem__sheet"><strong>projects.zip</strong><span>scattered</span></div>
          <div class="lp-problem__sheet lp-problem__sheet--accent"><strong>{{ config('app.name') }}</strong><span>one source</span></div>
        </div>
      </div>
    </div>
  </section>

  @if($features->isNotEmpty())
  <section class="lp-section" id="features">
    <div class="lp-container">
      <div class="lp-section-head lp-reveal">
        <p class="lp-eyebrow">{{ __('landing.features.eyebrow') }}</p>
        <h2 class="lp-title">{{ __('landing.features.title') }}</h2>
        <p class="lp-lead">{{ __('landing.features.subtitle') }}</p>
      </div>
      <div class="lp-features__list">
        @foreach ($features as $feature)
          <article class="lp-feature lp-reveal">
            <div class="lp-feature__icon">
              <svg viewBox="0 0 24 24" aria-hidden="true">{!! $icons[$feature->icon] ?? $icons['layers'] !!}</svg>
            </div>
            <h3 class="lp-feature__title">{{ $feature->title }}</h3>
            <p class="lp-feature__body">{{ $feature->body }}</p>
          </article>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  @if($steps->isNotEmpty())
  <section class="lp-section lp-how" id="how">
    <div class="lp-container">
      <div class="lp-section-head lp-reveal">
        <p class="lp-eyebrow">{{ __('landing.how.eyebrow') }}</p>
        <h2 class="lp-title">{{ __('landing.how.title') }}</h2>
      </div>
      <div class="lp-steps">
        @foreach ($steps as $step)
          <article class="lp-step lp-reveal">
            <div class="lp-step__num">{{ $step->meta ?: str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
            <h3>{{ $step->title }}</h3>
            <p>{{ $step->body }}</p>
          </article>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  <section class="lp-section" id="preview">
    <div class="lp-container">
      <div class="lp-section-head lp-reveal">
        <p class="lp-eyebrow">{{ __('landing.preview.eyebrow') }}</p>
        <h2 class="lp-title">{{ __('landing.preview.title') }}</h2>
        <p class="lp-lead">{{ __('landing.preview.subtitle') }}</p>
      </div>
      <div class="lp-preview__stage lp-reveal">
        <div class="lp-frame">
          <div class="lp-frame__label">{{ __('landing.preview.portfolio_label') }}</div>
          <div class="lp-frame__content">
            <div class="lp-skeleton lp-skeleton--title"></div>
            <div class="lp-skeleton lp-skeleton--wide"></div>
            <div class="lp-skeleton lp-skeleton--mid"></div>
            <div style="height:0.85rem"></div>
            <div class="lp-mock__cards">
              <div class="lp-skeleton lp-skeleton--block"></div>
              <div class="lp-skeleton lp-skeleton--block"></div>
              <div class="lp-skeleton lp-skeleton--block"></div>
            </div>
          </div>
        </div>
        <div>
          <div class="lp-frame lp-frame--resume" style="margin-bottom:1rem">
            <div class="lp-frame__label">{{ __('landing.preview.resume_label') }}</div>
            <div class="lp-frame__content">
              <div class="lp-skeleton lp-skeleton--title"></div>
              <div class="lp-skeleton lp-skeleton--wide"></div>
              <div class="lp-skeleton lp-skeleton--mid"></div>
              <div class="lp-skeleton lp-skeleton--wide"></div>
            </div>
          </div>
          <div class="lp-pdf-mock" aria-hidden="true">
            <div class="lp-pdf-mock__bar"></div>
            <div class="lp-pdf-mock__name">{{ __('landing.mock.pdf_title') }}</div>
            <div class="lp-skeleton lp-skeleton--mid"></div>
            <div style="height:0.5rem"></div>
            <div class="lp-skeleton lp-skeleton--wide"></div>
            <div class="lp-skeleton lp-skeleton--wide"></div>
            <div class="lp-skeleton lp-skeleton--mid"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  @if($benefits->isNotEmpty())
  <section class="lp-section lp-benefits" id="benefits">
    <div class="lp-container">
      <div class="lp-section-head lp-reveal">
        <p class="lp-eyebrow">{{ __('landing.benefits.eyebrow') }}</p>
        <h2 class="lp-title">{{ __('landing.benefits.title') }}</h2>
      </div>
      <div class="lp-benefits__grid">
        @foreach ($benefits as $benefit)
          <article class="lp-benefit lp-reveal">
            <h3>{{ $benefit->title }}</h3>
            <p>{{ $benefit->body }}</p>
          </article>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  @if($useCases->isNotEmpty())
  <section class="lp-section" id="use-cases">
    <div class="lp-container">
      <div class="lp-section-head lp-reveal">
        <p class="lp-eyebrow">{{ __('landing.use_cases.eyebrow') }}</p>
        <h2 class="lp-title">{{ __('landing.use_cases.title') }}</h2>
      </div>
      <div class="lp-usecases__grid">
        @foreach ($useCases as $useCase)
          <article class="lp-usecase lp-reveal">
            <h3>{{ $useCase->title }}</h3>
            <p>{{ $useCase->body }}</p>
          </article>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  @if($testimonials->isNotEmpty())
  <section class="lp-section lp-testimonials" id="testimonials">
    <div class="lp-container">
      <div class="lp-section-head lp-reveal">
        <p class="lp-eyebrow">{{ __('landing.testimonials.eyebrow') }}</p>
        <h2 class="lp-title">{{ __('landing.testimonials.title') }}</h2>
      </div>
      <div class="lp-quotes">
        @foreach ($testimonials as $item)
          <blockquote class="lp-quote lp-reveal">
            @if($item->photoUrl())
              <img class="lp-quote__photo" src="{{ $item->photoUrl() }}" alt="{{ $item->name }}" width="48" height="48">
            @endif
            <p>“{{ $item->quote }}”</p>
            <footer class="lp-quote__meta">
              <strong>{{ $item->name }}</strong>
              @if($item->role)<span>{{ $item->role }}</span>@endif
            </footer>
          </blockquote>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  @if($plans->isNotEmpty())
  <section class="lp-section" id="pricing">
    <div class="lp-container">
      <div class="lp-section-head lp-reveal">
        <p class="lp-eyebrow">{{ __('landing.plans.eyebrow') }}</p>
        <h2 class="lp-title">{{ __('landing.plans.title') }}</h2>
        <p class="lp-lead">{{ __('landing.plans.subtitle') }}</p>
      </div>
      <div class="lp-pricing__grid">
        @foreach ($plans as $plan)
          @php $price = (float) $plan->price_monthly; @endphp
          <article
            class="lp-plan lp-reveal {{ $plan->is_highlighted ? 'lp-plan--featured' : '' }}"
            data-plan-id="{{ $plan->code }}"
            data-price-monthly="{{ $plan->price_monthly }}"
            data-currency="{{ $plan->currency }}"
            @if($plan->billing_plan_id) data-billing-plan-id="{{ $plan->billing_plan_id }}" @endif
          >
            @if($plan->badge)
              <span class="lp-plan__badge">{{ $plan->badge }}</span>
            @endif
            <h3 class="lp-plan__name">{{ $plan->name }}</h3>
            @if($plan->description)
              <p class="lp-plan__desc">{{ $plan->description }}</p>
            @endif
            <div class="lp-plan__price">
              <span class="lp-plan__amount">${{ number_format($price, $price == floor($price) ? 0 : 2) }}</span>
              <span class="lp-plan__period">{{ $plan->period_label ?: __('landing.plans.period_month') }}</span>
            </div>
            @if(count($plan->featuresForLocale()) > 0)
              <ul class="lp-plan__features">
                @foreach ($plan->featuresForLocale() as $featureLine)
                  <li>{{ $featureLine }}</li>
                @endforeach
              </ul>
            @endif
            <a
              class="lp-btn {{ $plan->is_highlighted ? 'lp-btn--primary' : 'lp-btn--ink' }}"
              href="{{ $plan->ctaUrl() }}"
              data-plan-cta
            >{{ $plan->cta_label ?: __('landing.nav.get_started') }}</a>
          </article>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  @if($faqs->isNotEmpty())
  <section class="lp-section lp-how" id="faq">
    <div class="lp-container">
      <div class="lp-section-head lp-reveal">
        <p class="lp-eyebrow">{{ __('landing.faq.eyebrow') }}</p>
        <h2 class="lp-title">{{ __('landing.faq.title') }}</h2>
      </div>
      <div class="lp-faq__list" data-lp-faq>
        @foreach ($faqs as $i => $item)
          <div class="lp-faq__item {{ $i === 0 ? 'is-open' : '' }}">
            <button type="button" class="lp-faq__q" aria-expanded="{{ $i === 0 ? 'true' : 'false' }}">
              <span>{{ $item->question }}</span>
              <span class="lp-faq__icon" aria-hidden="true">+</span>
            </button>
            <div class="lp-faq__a">
              <div>
                <p>{{ $item->answer }}</p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  <section class="lp-section lp-final">
    <div class="lp-container lp-reveal">
      <h2 class="lp-title">{{ $settings->final_cta_title ?: __('landing.final_cta.title') }}</h2>
      @if($settings->final_cta_subtitle || ! $settings->final_cta_title)
        <p class="lp-lead">{{ $settings->final_cta_subtitle ?: __('landing.final_cta.subtitle') }}</p>
      @endif
      <div class="lp-cta-row">
        <a class="lp-btn lp-btn--primary" href="{{ route('register') }}">{{ $settings->final_cta_primary ?: __('landing.final_cta.cta') }}</a>
        <a class="lp-btn lp-btn--ghost" href="{{ route('login') }}">{{ $settings->final_cta_secondary ?: __('landing.final_cta.secondary') }}</a>
      </div>
    </div>
  </section>
</main>

<footer class="lp-footer">
  <div class="lp-container">
    <div class="lp-footer__grid">
      <div>
        <a href="#top" class="lp-footer__brand">
          <img src="{{ asset('assets/logo/logo.png') }}" alt="">
          <span>{{ config('app.name') }}</span>
        </a>
        <p class="lp-footer__tagline">{{ $settings->footer_tagline ?: __('landing.footer.tagline') }}</p>
        @if($socialLinks)
          <div class="lp-footer__social">
            @foreach($socialLinks as $network => $url)
              <a href="{{ $url }}" target="_blank" rel="noopener noreferrer">{{ ucfirst($network) }}</a>
            @endforeach
          </div>
        @endif
      </div>
      <div>
        <h4>{{ __('landing.footer.product') }}</h4>
        <ul>
          @if($features->isNotEmpty())<li><a href="#features">{{ __('landing.footer.features') }}</a></li>@endif
          @if($plans->isNotEmpty())<li><a href="#pricing">{{ __('landing.footer.pricing') }}</a></li>@endif
          @if($faqs->isNotEmpty())<li><a href="#faq">{{ __('landing.footer.faq') }}</a></li>@endif
        </ul>
      </div>
      <div>
        <h4>{{ __('landing.footer.company') }}</h4>
        <ul>
          <li><a href="{{ route('login') }}">{{ __('landing.footer.login') }}</a></li>
          <li><a href="{{ route('register') }}">{{ __('landing.footer.register') }}</a></li>
        </ul>
      </div>
      <div>
        <h4>{{ __('landing.footer.legal') }}</h4>
        <ul>
          @if($contactEmail)
            <li><a href="mailto:{{ $contactEmail }}">{{ __('landing.footer.email') }}</a></li>
            <li><a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a></li>
          @endif
          @if($settings->contact_phone)
            <li><a href="tel:{{ $settings->contact_phone }}">{{ $settings->contact_phone }}</a></li>
          @endif
        </ul>
      </div>
    </div>
    <div class="lp-footer__bottom">
      © {{ date('Y') }} {{ config('app.name') }}. {{ __('landing.footer.rights') }}
    </div>
  </div>
</footer>
@endsection
