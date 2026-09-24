(() => {
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // Hero entrance
  const heroCopy = document.querySelector('[data-lp-hero-copy]');
  if (heroCopy) {
    requestAnimationFrame(() => heroCopy.classList.add('is-ready'));
  }

  // Sticky nav
  const nav = document.querySelector('[data-lp-nav]');
  const onScroll = () => {
    if (!nav) return;
    nav.classList.toggle('is-scrolled', window.scrollY > 24);
  };
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });

  // Mobile menu
  const burger = document.getElementById('lpBurger');
  const mobileMenu = document.getElementById('lpMobileMenu');
  const closeMobile = () => {
    if (!burger || !mobileMenu) return;
    burger.classList.remove('is-open');
    burger.setAttribute('aria-expanded', 'false');
    mobileMenu.classList.remove('is-open');
    mobileMenu.hidden = true;
  };
  const openMobile = () => {
    if (!burger || !mobileMenu) return;
    burger.classList.add('is-open');
    burger.setAttribute('aria-expanded', 'true');
    mobileMenu.hidden = false;
    mobileMenu.classList.add('is-open');
  };
  if (burger && mobileMenu) {
    burger.addEventListener('click', () => {
      const open = burger.getAttribute('aria-expanded') === 'true';
      open ? closeMobile() : openMobile();
    });
    mobileMenu.querySelectorAll('[data-lp-mobile-link]').forEach((link) => {
      link.addEventListener('click', closeMobile);
    });
  }

  // Smooth anchors (native + close mobile)
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener('click', (e) => {
      const id = anchor.getAttribute('href');
      if (!id || id === '#') return;
      const target = document.querySelector(id);
      if (!target) return;
      e.preventDefault();
      target.scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth', block: 'start' });
      closeMobile();
    });
  });

  // Scroll reveal
  const reveals = document.querySelectorAll('.lp-reveal');
  if (reduceMotion) {
    reveals.forEach((el) => el.classList.add('is-visible'));
  } else if ('IntersectionObserver' in window) {
    const io = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            io.unobserve(entry.target);
          }
        });
      },
      { rootMargin: '0px 0px -8% 0px', threshold: 0.12 }
    );
    reveals.forEach((el) => io.observe(el));
  } else {
    reveals.forEach((el) => el.classList.add('is-visible'));
  }

  // FAQ accordion
  const faq = document.querySelector('[data-lp-faq]');
  if (faq) {
    faq.querySelectorAll('.lp-faq__item').forEach((item) => {
      const btn = item.querySelector('.lp-faq__q');
      if (!btn) return;
      btn.addEventListener('click', () => {
        const isOpen = item.classList.contains('is-open');
        faq.querySelectorAll('.lp-faq__item').forEach((other) => {
          other.classList.remove('is-open');
          const otherBtn = other.querySelector('.lp-faq__q');
          if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
        });
        if (!isOpen) {
          item.classList.add('is-open');
          btn.setAttribute('aria-expanded', 'true');
        }
      });
    });
  }
})();
