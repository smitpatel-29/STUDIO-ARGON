/* ============================================
   STUDIO ARGON — animations.js
   Premium GSAP + Lenis Animation System
   ============================================ */
'use strict';

/* Tell main.js to stand down on loader + filter */
window.GSAP_LOADER = true;
window.GSAP_FLIP   = true;

/* ---- Register Plugins ---- */
if (typeof gsap !== 'undefined') {
  if (typeof ScrollTrigger !== 'undefined') gsap.registerPlugin(ScrollTrigger);
  if (typeof Flip !== 'undefined')          gsap.registerPlugin(Flip);
}

// Disable AOS to prevent conflict
window.AOS = { init: () => { console.log('AOS Disabled'); }, refresh: () => {} };

/* ---- Eases ---- */
const E = {
  out:   'power3.out',
  inOut: 'power3.inOut',
  snap:  'back.out(1.4)',
  expo:  'expo.out',
  circ:  'circ.out'
};

/* ================================================================
   1. LENIS SMOOTH SCROLL
   ================================================================ */
let lenis;
function initLenis() {
  if (typeof Lenis === 'undefined') return;
  lenis = new Lenis({ 
    duration: 1.4, 
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    smoothWheel: true, 
    touchMultiplier: 2 
  });
  if (typeof ScrollTrigger !== 'undefined') {
    lenis.on('scroll', ScrollTrigger.update);
    gsap.ticker.add(time => lenis.raf(time * 1000));
    gsap.ticker.lagSmoothing(0);
  }
}

/* ================================================================
   2. CUSTOM CURSOR
   ================================================================ */
function initCustomCursor() {
  const dot = document.getElementById('cursor');
  const outer = document.getElementById('cursor-outer');
  if (!dot || !outer) return;

  window.addEventListener('mousemove', (e) => {
    gsap.to(dot, { x: e.clientX, y: e.clientY, duration: 0.1 });
    gsap.to(outer, { x: e.clientX, y: e.clientY, duration: 0.3 });
  });

  document.querySelectorAll('a, button, .card-premium').forEach(el => {
    el.addEventListener('mouseenter', () => {
      gsap.to(dot, { scale: 3.5, background: 'rgba(255,255,255,0.2)' });
      gsap.to(outer, { scale: 1.8, borderColor: 'var(--red)' });
    });
    el.addEventListener('mouseleave', () => {
      gsap.to(dot, { scale: 1, background: 'var(--red)' });
      gsap.to(outer, { scale: 1, borderColor: 'rgba(255,255,255,0.2)' });
    });
  });
}



/* ================================================================
   3. SMART NAVBAR
   ================================================================ */
function initSmartNavbar() {
  // Disabled: Header float is handled by style.css sticky class `.scrolled` without hiding on scroll down.
}

/* ================================================================
   4. CINEMATIC LOADER
   ================================================================ */
function initCinematicLoader() {
  const screen = document.getElementById('loading-screen');
  if (!screen) return;

  const path = screen.querySelector('.logo-path');

  let count = 0;
  const interval = setInterval(() => {
    count += Math.floor(Math.random() * 3) + 1;
    if (count >= 100) {
      count = 100;
      clearInterval(interval);
      revealSite();
    }
  }, 40);

  function revealSite() {
    const tl = gsap.timeline({ delay: 0.5 });
    
    tl.to('.loader-content', { 
      opacity: 0, scale: 0.95, y: -20, duration: 0.8, ease: 'power3.inOut' 
    });

    tl.to(screen, {
      opacity: 0,
      duration: 1,
      ease: 'power2.inOut',
      onComplete: () => {
        screen.style.display = 'none';
        animateHeroIn();
      }
    }, '-=0.4');
  }

  // Safety Timeout: Force close after 6s
  setTimeout(() => {
    if (screen.style.display !== 'none') {
      clearInterval(interval);
      revealSite();
    }
  }, 6000);
}

/* ================================================================
   5. HERO ENTRANCE
   ================================================================ */
function animateHeroIn() {
  const heroContent = document.querySelector('.hero-content, .page-hero-content');
  const heroBg = document.querySelector('.hero-bg, .page-hero-bg');
  if (!heroContent) return;

  const tl = gsap.timeline();

  if (heroBg) {
    tl.from(heroBg, { 
      scale: 1.3, 
      filter: 'brightness(0) blur(20px)',
      duration: 2.5, 
      ease: 'expo.out' 
    }, 0);
  }

  const title = heroContent.querySelector('h1');
  const items = heroContent.querySelectorAll('.section-label, p, .hero-btns');
  
  if (title) {
    // Standard reveal without pop-up motion
    gsap.set(title, { opacity: 1, y: 0, rotateX: 0, scale: 1 });
  }

  tl.from(items, {
    y: 50, opacity: 0, stagger: 0.15, duration: 1, ease: 'power3.out'
  }, '-=0.8');

  const navbar = document.querySelector('.navbar');
  if (navbar) {
    tl.to(navbar, { 
      opacity: 1, 
      pointerEvents: 'all', 
      duration: 1, 
      ease: 'power2.out' 
    }, 0.5);
  }

  const scrollInd = document.querySelector('.scroll-indicator');
  if (scrollInd) tl.from(scrollInd, { opacity: 0, y: -20, duration: 1 }, '-=0.5');
}



/* ================================================================
   5. PORTFOLIO FILTER (GSAP FLIP)
   ================================================================ */
function initPortfolioFilter() {
  const grid = document.querySelector('.portfolio-grid');
  const tabs = document.querySelectorAll('.filter-tab');
  const items = document.querySelectorAll('.card-premium[data-category]');
  if (!grid || !tabs.length) return;

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      const filter = tab.getAttribute('data-filter');
      
      tabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');

      const state = Flip.getState(items);

      items.forEach(item => {
        const cat = item.getAttribute('data-category');
        if (filter === 'all' || cat === filter) {
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });

      Flip.from(state, {
        duration: 0.8,
        stagger: 0.05,
        ease: 'expo.out',
        onComplete: () => ScrollTrigger.refresh()
      });
    });
  });
}

/* ================================================================
   6. PAGE TRANSITIONS
   ================================================================ */
function initPageTransitions() {
  const overlay = document.getElementById('page-transition');
  if (!overlay) return;

  overlay.innerHTML = Array.from({ length: 5 }, () => `<div class="pt-bar"></div>`).join('');
  const bars = overlay.querySelectorAll('.pt-bar');

  // Page Reveal Sequence
  gsap.to(bars, {
    scaleX: 0, duration: 0.6, stagger: 0.05, ease: 'expo.inOut',
    onComplete: () => { overlay.style.pointerEvents = 'none'; }
  });

  // Links Intercept
  document.querySelectorAll('a[href]').forEach(link => {
    const href = link.getAttribute('href') || '';
    if (!href || href.startsWith('#') || href.startsWith('http')) return;

    link.addEventListener('click', e => {
      e.preventDefault();
      gsap.to(bars, {
        scaleX: 1, duration: 0.5, stagger: 0.05, transformOrigin: 'left',
        onComplete: () => { window.location.href = href; }
      });
    });
  });
}

/* ================================================================
   7. SCROLLTRIGGER ANIMATIONS
   ================================================================ */
function initScrollAnimations() {
  if (typeof ScrollTrigger === 'undefined') return;

  // Reveal Text
  gsap.utils.toArray('.section-title, .section-sub, .section-label').forEach(el => {
    if (el.closest('.hero')) return;
    gsap.from(el, {
      scrollTrigger: { trigger: el, start: 'top 90%', once: true },
      y: 50, opacity: 0, duration: 1, ease: 'power4.out'
    });
  });

  // Cards Reveal (SAFE)
  const cardGroups = [
    '.services-grid .card-premium',
    '.portfolio-grid .card-premium',
    '.team-grid .team-item',
    '.testimonials-grid .testimonial-card'
  ];

  cardGroups.forEach(sel => {
    const cards = gsap.utils.toArray(sel);
    if (!cards.length) return;
    gsap.from(cards, {
      scrollTrigger: { trigger: cards[0].parentElement, start: 'top 85%', once: true },
      y: 40, opacity: 0, scale: 0.98, duration: 1, stagger: 0.1, ease: 'power2.out',
      clearProps: 'all' // Returns to CSS defaults after animation
    });
  });

  // Image Parallax (Agina style)
  gsap.utils.toArray('.img-reveal-wrap img').forEach(img => {
    gsap.fromTo(img, 
      { scale: 1.3, yPercent: -15 },
      {
        scrollTrigger: { trigger: img.parentElement, start: 'top bottom', end: 'bottom top', scrub: true },
        scale: 1, yPercent: 0, ease: 'none'
      }
    );
  });

  // Stats Counter
  gsap.utils.toArray('.stat-num').forEach(num => {
    const target = parseInt(num.textContent);
    num.textContent = '0';
    gsap.to(num, {
      scrollTrigger: { trigger: num, start: 'top 90%', once: true },
      innerText: target,
      duration: 2,
      snap: { innerText: 1 },
      ease: 'power4.out'
    });
  });

  // Marquee Speed control (optional)
  const marquee = document.querySelector('.marquee-content');
  if (marquee) {
    gsap.to(marquee, {
      scrollTrigger: { trigger: '.marquee', start: 'top bottom', end: 'bottom top', scrub: true },
      xPercent: -20, ease: 'none'
    });
  }
}

/* ================================================================
   7b. MAGNETIC BUTTONS (New)
   ================================================================ */
function initMagneticButtons() {
  const wraps = gsap.utils.toArray('.magnetic-wrap');
  wraps.forEach(wrap => {
    const btn = wrap.querySelector('.btn-magnetic');
    if (!btn) return;
    
    wrap.addEventListener('mousemove', (e) => {
      const { left, top, width, height } = wrap.getBoundingClientRect();
      const x = (e.clientX - left - width / 2) * 0.4;
      const y = (e.clientY - top - height / 2) * 0.4;
      gsap.to(btn, { x, y, duration: 0.3, ease: 'power2.out' });
    });

    wrap.addEventListener('mouseleave', () => {
      gsap.to(btn, { x: 0, y: 0, duration: 0.5, ease: 'elastic.out(1, 0.3)' });
    });
  });
}

/* ================================================================
   8. GSAP FLIP — PORTFOLIO FILTER
   ================================================================ */
function initFlipFilter() {
  if (typeof Flip === 'undefined') return;
  const tabs  = document.querySelectorAll('.filter-tab');
  const cards = document.querySelectorAll('.port-card');
  if (!tabs.length || !cards.length) return;

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
      const filter = tab.dataset.filter;
      const state  = Flip.getState(cards);

      cards.forEach(card => {
        const match = filter === 'all' || card.dataset.category === filter;
        card.classList.toggle('hidden', !match);
        card.style.visibility = match ? '' : 'hidden';
        card.style.position   = match ? '' : 'absolute';
        card.style.opacity    = match ? '1' : '0';
      });

      Flip.from(state, {
        duration: 0.55, ease: E.out, stagger: 0.04, absolute: true,
        onEnter: els => gsap.from(els, { opacity: 0, scale: 0.85, duration: 0.4, ease: E.snap }),
        onLeave: els => gsap.to(els,   { opacity: 0, scale: 0.85, duration: 0.3 })
      });
    });
  });
}

/* ================================================================
   9. DRAG SCROLL (Testimonials + Blog)
   ================================================================ */
function initDragScroll() {
  ['.testimonials-grid', '.blog-grid'].forEach(sel => {
    const el = document.querySelector(sel);
    if (!el) return;
    Object.assign(el.style, { cursor:'grab', userSelect:'none', overflowX:'auto', scrollbarWidth:'none' });
    el.style.msOverflowStyle = 'none';

    let down = false, startX = 0, scrollStart = 0;
    el.addEventListener('mousedown', e => {
      down = true; startX = e.pageX - el.offsetLeft; scrollStart = el.scrollLeft;
      el.style.cursor = 'grabbing';
    });
    window.addEventListener('mouseup', () => { down = false; if (el) el.style.cursor = 'grab'; });
    el.addEventListener('mousemove', e => {
      if (!down) return;
      e.preventDefault();
      el.scrollLeft = scrollStart - (e.pageX - el.offsetLeft - startX) * 1.4;
    });
  });
}

/* ================================================================
   INIT
   ================================================================ */
window.addEventListener('load', () => {
  if (typeof ScrollTrigger !== 'undefined') ScrollTrigger.refresh();
});

document.addEventListener('DOMContentLoaded', () => {
  initLenis();
  initCustomCursor();
  initSmartNavbar();
  initPageTransitions();
  initCinematicLoader();

  requestAnimationFrame(() => {
    initScrollAnimations();
    initMagneticButtons();
    initFlipFilter();
    initPortfolioFilter();
    initDragScroll();
  });
});
