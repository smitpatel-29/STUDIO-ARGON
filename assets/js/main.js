/* ============================================
   STUDIO ARGON — main.js
   ============================================ */

/* ---------- THEME (Force Dark) ---------- */
(function initTheme() {
  document.documentElement.setAttribute('data-theme', 'dark');
})();

/* ---------- NAVBAR ---------- */
function initNavbar() {
  const navbar = document.getElementById('main-nav');
  if (!navbar) return;

  // scroll effect
  window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 40);
  });

  // active link
  const path = window.location.pathname.split('/').pop() || 'index.php';
  document.querySelectorAll('.nav-links a').forEach(link => {
    const href = link.getAttribute('href');
    if (href === path || (path === '' && href === 'index.php')) {
      link.classList.add('active');
    }
  });

  // hamburger
  const hamburger = document.getElementById('nav-hamburger');
  const overlay = document.getElementById('nav-overlay');
  const overlayClose = document.getElementById('overlay-close');

  if (hamburger && overlay) {
    hamburger.addEventListener('click', () => overlay.classList.add('open'));
    if (overlayClose) overlayClose.addEventListener('click', () => overlay.classList.remove('open'));
    overlay.querySelectorAll('a').forEach(a => {
      a.addEventListener('click', () => overlay.classList.remove('open'));
    });
  }
}

/* ---------- SCROLL PROGRESS BAR ---------- */
function initScrollProgress() {
  const bar = document.getElementById('progress-bar');
  if (!bar) return;
  window.addEventListener('scroll', () => {
    const scrolled = window.scrollY;
    const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
    bar.style.width = (scrolled / maxScroll * 100) + '%';
  });
}

/* ---------- PARALLAX HERO ---------- */
function initParallax() {
  const heroBg = document.querySelector('.hero-bg');
  if (!heroBg) return;
  window.addEventListener('scroll', () => {
    heroBg.style.transform = `translateY(${window.scrollY * 0.4}px)`;
  });
}

/* ---------- MAGNETIC BUTTONS ---------- */
function initMagnetic() {
  document.querySelectorAll('.btn-magnetic').forEach(btn => {
    btn.addEventListener('mousemove', e => {
      const rect = btn.getBoundingClientRect();
      const x = e.clientX - rect.left - rect.width / 2;
      const y = e.clientY - rect.top - rect.height / 2;
      btn.style.transform = `translate(${x * 0.2}px, ${y * 0.2}px)`;
    });
    btn.addEventListener('mouseleave', () => {
      btn.style.transform = '';
    });
  });
}

/* ---------- 3D TILT CARDS ---------- */
function initTilt() {
  document.querySelectorAll('.tilt-card').forEach(card => {
    card.addEventListener('mousemove', e => {
      const rect = card.getBoundingClientRect();
      const x = (e.clientX - rect.left) / rect.width - 0.5;
      const y = (e.clientY - rect.top) / rect.height - 0.5;
      card.style.transform = `perspective(1000px) rotateY(${x * 12}deg) rotateX(${-y * 12}deg) translateY(-6px)`;
    });
    card.addEventListener('mouseleave', () => {
      card.style.transform = '';
    });
  });
}

/* ---------- COUNTER ANIMATION ---------- */
function animateCounter(el) {
  const target = parseInt(el.dataset.target, 10);
  const duration = 2000;
  const start = performance.now();
  function step(now) {
    const elapsed = now - start;
    const progress = Math.min(elapsed / duration, 1);
    const eased = 1 - Math.pow(1 - progress, 3); // easeOut cubic
    el.textContent = Math.floor(eased * target).toLocaleString();
    if (progress < 1) requestAnimationFrame(step);
    else el.textContent = target.toLocaleString() + (el.dataset.suffix || '');
  }
  requestAnimationFrame(step);
}

function initCounters() {
  const counters = document.querySelectorAll('.counter');
  if (!counters.length) return;
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounter(entry.target);
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1 });
  counters.forEach(c => observer.observe(c));
}

/* ---------- SKILL BARS ---------- */
function initSkillBars() {
  const fills = document.querySelectorAll('.skill-fill');
  if (!fills.length) return;
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.width = entry.target.dataset.width + '%';
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.3 });
  fills.forEach(f => observer.observe(f));
}

/* ---------- PORTFOLIO FILTER ---------- */
function initPortfolioFilter() {
  const tabs = document.querySelectorAll('.filter-tab');
  const cards = document.querySelectorAll('.port-card');
  if (!tabs.length) return;

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
      const filter = tab.dataset.filter;
      cards.forEach(card => {
        const match = filter === 'all' || card.dataset.category === filter;
        card.style.opacity = match ? '1' : '0';
        card.style.transform = match ? '' : 'scale(0.95)';
        card.style.pointerEvents = match ? '' : 'none';
        card.style.position = match ? '' : 'absolute';
        card.style.visibility = match ? 'visible' : 'hidden';
      });
    });
  });
}

/* ---------- LIGHTBOX ---------- */
const projectsData = [
  { id: 0, title: 'Modern Villa Exterior', category: 'Exterior', img: 'https://placehold.co/900x600/1a1a1a/444444', desc: 'Photorealistic exterior rendering for a modern villa in Southern California, featuring dramatic lighting and lush landscaping.', tools: '3ds Max, V-Ray, Photoshop', year: '2025' },
  { id: 1, title: 'Mountain Retreat House', category: 'Exterior', img: 'https://placehold.co/900x600/1a1a1a/333333', desc: 'A cozy mountain retreat with warm wood finishes and panoramic views, rendered with natural lighting.', tools: 'Corona Renderer, Photoshop', year: '2025' },
  { id: 2, title: 'Beachfront Condo Complex', category: 'Exterior', img: 'https://placehold.co/900x600/111111/333333', desc: 'Aerial and street-level views of a luxury beachfront condominium complex.', tools: '3ds Max, V-Ray, Lumion', year: '2024' },
  { id: 3, title: 'Luxury Penthouse Interior', category: 'Interior', img: 'https://placehold.co/900x600/1a1a1a/444444', desc: 'High-end penthouse interior with designer furniture, marble finishes, and panoramic city views.', tools: '3ds Max, Corona Renderer', year: '2025' },
  { id: 4, title: 'Minimalist Office Interior', category: 'Interior', img: 'https://placehold.co/900x600/111111/222222', desc: 'Open-plan corporate office with biophilic design elements and natural light.', tools: 'V-Ray, Photoshop', year: '2024' },
  { id: 5, title: 'Hotel Lobby Rendering', category: 'Interior', img: 'https://placehold.co/900x600/1a1a1a/333333', desc: 'Grand hotel lobby with dramatic chandelier, marble floors, and warm ambient lighting.', tools: '3ds Max, V-Ray, Photoshop', year: '2025' },
  { id: 6, title: 'Commercial Campus Flythrough', category: 'Animation', img: 'https://placehold.co/900x600/1a1a1a/444444', desc: '4K animation flythrough of a 10-acre commercial campus with drone-style aerials.', tools: '3ds Max, V-Ray, After Effects', year: '2024' },
  { id: 7, title: 'Residential Walkthrough Tour', category: 'Animation', img: 'https://placehold.co/900x600/111111/333333', desc: 'Room-by-room walkthrough of a 4-bedroom residential property for pre-sale marketing.', tools: 'Lumion, Photoshop', year: '2025' },
  { id: 8, title: 'Mixed-Use Development Animation', category: 'Animation', img: 'https://placehold.co/900x600/1a1a1a/222222', desc: 'Dynamic animation showcasing a mixed-use retail and residential development.', tools: '3ds Max, V-Ray, After Effects', year: '2024' },
  { id: 9, title: '3-Bedroom Apartment Floor Plan', category: 'Floor Plans', img: 'https://placehold.co/900x600/1a1a1a/333333', desc: 'Color-coded 2D/3D floor plan with furniture layout for a 3-bedroom urban apartment.', tools: 'AutoCAD, Photoshop', year: '2025' },
  { id: 10, title: 'Villa Floor Plan with Pool', category: 'Floor Plans', img: 'https://placehold.co/900x600/111111/222222', desc: 'Luxury villa floor plan including outdoor pool area, guest house, and landscaping.', tools: 'AutoCAD, Photoshop', year: '2024' },
  { id: 11, title: 'Penthouse Duplex Floor Plan', category: 'Floor Plans', img: 'https://placehold.co/900x600/1a1a1a/444444', desc: 'Two-level penthouse duplex floor plan with rooftop terrace and private elevator.', tools: 'AutoCAD, 3ds Max, Photoshop', year: '2025' },
];

let currentLbIndex = 0;

function openLightbox(index) {
  currentLbIndex = index;
  const p = projectsData[index];
  const lb = document.getElementById('lightbox');
  if (!lb) return;
  document.getElementById('lb-img').src = p.img;
  document.getElementById('lb-title').textContent = p.title;
  document.getElementById('lb-category').textContent = p.category;
  document.getElementById('lb-desc').textContent = p.desc;
  document.getElementById('lb-tools').textContent = p.tools;
  document.getElementById('lb-year').textContent = p.year;
  lb.classList.add('open');
  document.body.style.overflow = 'hidden';
}

function closeLightbox() {
  const lb = document.getElementById('lightbox');
  if (lb) lb.classList.remove('open');
  document.body.style.overflow = '';
}

function navigateLightbox(dir) {
  currentLbIndex = (currentLbIndex + dir + projectsData.length) % projectsData.length;
  openLightbox(currentLbIndex);
}

function initLightbox() {
  const lb = document.getElementById('lightbox');
  if (!lb) return;
  document.getElementById('lightbox-close').addEventListener('click', closeLightbox);
  document.getElementById('lb-prev').addEventListener('click', () => navigateLightbox(-1));
  document.getElementById('lb-next').addEventListener('click', () => navigateLightbox(1));
  lb.addEventListener('click', e => { if (e.target === lb) closeLightbox(); });
  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });

  document.querySelectorAll('.port-card').forEach((card, i) => {
    card.addEventListener('click', () => openLightbox(i));
  });
}

/* ---------- BLOG SEARCH & FILTER ---------- */
function initBlogFilter() {
  const search = document.getElementById('blog-search');
  const pills = document.querySelectorAll('.filter-pill');
  const cards = document.querySelectorAll('.blog-card');

  function filterCards() {
    const query = search ? search.value.toLowerCase() : '';
    const active = document.querySelector('.filter-pill.active');
    const cat = active ? active.dataset.cat : 'all';
    cards.forEach(card => {
      const title = card.querySelector('h3')?.textContent.toLowerCase() || '';
      const cardCat = card.dataset.category || '';
      const matchSearch = !query || title.includes(query);
      const matchCat = cat === 'all' || cardCat === cat;
      card.style.display = matchSearch && matchCat ? '' : 'none';
    });
  }

  if (search) search.addEventListener('input', filterCards);
  pills.forEach(pill => {
    pill.addEventListener('click', () => {
      pills.forEach(p => p.classList.remove('active'));
      pill.classList.add('active');
      filterCards();
    });
  });
}

/* ---------- FAQ ACCORDION ---------- */
function initFaq() {
  document.querySelectorAll('.faq-item').forEach(item => {
    const btn = item.querySelector('.faq-question');
    btn.addEventListener('click', () => {
      const isOpen = item.classList.contains('open');
      document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
      if (!isOpen) item.classList.add('open');
    });
  });
}

/* ---------- CONTACT FORM ---------- */
function initContactForm() {
  const form = document.getElementById('contact-form');
  if (!form) return;
  form.addEventListener('submit', e => {
    e.preventDefault();
    let valid = true;
    form.querySelectorAll('[required]').forEach(field => {
      const err = field.nextElementSibling;
      if (!field.value.trim()) {
        field.classList.add('error');
        if (err && err.classList.contains('form-error')) err.classList.add('show');
        valid = false;
      } else {
        field.classList.remove('error');
        if (err && err.classList.contains('form-error')) err.classList.remove('show');
      }
    });
    if (valid) {
      showToast("Message sent! We'll get back to you within 24 hours. ✅");
      form.reset();
    }
  });
}

function showToast(msg) {
  let toast = document.getElementById('toast');
  if (!toast) {
    toast = document.createElement('div');
    toast.id = 'toast';
    toast.className = 'toast';
    document.body.appendChild(toast);
  }
  toast.textContent = msg;
  toast.classList.add('show');
  setTimeout(() => toast.classList.remove('show'), 4000);
}

/* ---------- LOADING SCREEN (removed duplicate — see initLoader below) ---------- */

/* ---------- CLAUDE AI HELPER ---------- */
const CLAUDE_API = 'https://api.anthropic.com/v1/messages';
const CLAUDE_MODEL = 'claude-opus-4-5';
const WIDGET_SYSTEM = "You are the helpful AI assistant for Studio Argon, a 3D architectural visualization studio. Help users understand our services (3D exterior/interior rendering, animation, walkthroughs, floor plans, real estate rendering), answer questions about pricing, timelines, and processes, and guide them to request a free quote. Be professional, warm, and concise.";

async function callClaude(messages, system) {
  const key = window.ANTHROPIC_KEY || prompt('Enter your Anthropic API key (stored locally):');
  if (!key) return null;
  window.ANTHROPIC_KEY = key;
  try {
    const res = await fetch(CLAUDE_API, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'x-api-key': key,
        'anthropic-version': '2023-06-01',
        'anthropic-dangerous-direct-browser-access': 'true'
      },
      body: JSON.stringify({ model: CLAUDE_MODEL, max_tokens: 1000, system, messages })
    });
    if (!res.ok) throw new Error('API error: ' + res.status);
    const data = await res.json();
    return data.content[0].text;
  } catch (err) {
    return 'Sorry, I encountered an error. Please try again. (' + err.message + ')';
  }
}


/* ---------- AI ESTIMATOR (Services page) ---------- */
function initEstimator() {
  const btn = document.getElementById('estimate-btn');
  const result = document.getElementById('estimate-result');
  if (!btn || !result) return;

  const ESTIMATOR_SYSTEM = "You are a pricing estimator for Studio Argon 3D rendering studio. Based on the project details provided, give a realistic price range estimate in USD, estimated delivery time, and 3 tips to optimize the project scope. Be concise and professional. Format with clear sections.";

  btn.addEventListener('click', async () => {
    const service = document.getElementById('est-service')?.value || '';
    const scale   = document.querySelector('[name="scale"]:checked')?.value || 'Medium';
    const views   = document.getElementById('est-views')?.value || '5';
    const speed   = document.querySelector('[name="speed"]:checked')?.value || 'Standard';
    const addons  = [...document.querySelectorAll('[name="addon"]:checked')].map(c => c.value).join(', ') || 'None';

    const prompt = `Service: ${service}\nProject Scale: ${scale}\nNumber of Views: ${views}\nTurnaround: ${speed}\nAdd-ons: ${addons}`;
    result.classList.add('show');
    result.innerHTML = '<div style="display:flex;align-items:center;gap:10px;color:var(--subtext)"><span class="spinner"></span> Calculating your estimate…</div>';

    const reply = await callClaude([{ role: 'user', content: prompt }], ESTIMATOR_SYSTEM);
    result.innerHTML = '<h4>📊 Your Estimate</h4><p style="white-space:pre-wrap">' + (reply || 'Unable to generate estimate.') + '</p>';
  });
}





/* ---------- AOS INIT ---------- */
function initAos() {
  if (typeof AOS !== 'undefined') {
    AOS.init({ duration: 700, once: true, offset: 60 });
  }
}

/* ---------- LOADING SCREEN ---------- */
function initLoader() {
  const screen = document.getElementById('loading-screen');
  if (!screen) return;
  // Hide at 2s, then fully remove from layout after transition (0.5s)
  const hide = () => {
    screen.classList.add('done');
    setTimeout(() => { screen.style.display = 'none'; }, 600);
  };
  setTimeout(hide, 2000);
  // Absolute failsafe: force-hide after 4s no matter what
  setTimeout(() => {
    screen.style.display = 'none';
    screen.style.pointerEvents = 'none';
  }, 4000);
}

/* ---------- VIEWS SLIDER LABEL ---------- */
function initViewsSlider() {
  const slider = document.getElementById('est-views');
  const label = document.getElementById('est-views-label');
  if (!slider || !label) return;
  label.textContent = slider.value;
  slider.addEventListener('input', () => { label.textContent = slider.value; });
}

/* ---------- INIT ALL ---------- */
// Run loader immediately — don't wait for DOMContentLoaded
(function() {
  // Defer to animations.js if present
  if (window.GSAP_LOADER) return;
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initLoader);
  } else {
    initLoader();
  }
})();

document.addEventListener('DOMContentLoaded', () => {
  // setTheme('dark') is already handled by the self-invoking function at the top.
  initNavbar();
  initScrollProgress();
  initParallax();
  initMagnetic();
  initTilt();
  initCounters();
  initSkillBars();
  if (!window.GSAP_FLIP) initPortfolioFilter();
  initLightbox();
  initBlogFilter();
  initFaq();
  initContactForm();
  initEstimator();
  initAos();
  initViewsSlider();
  initHeroSlider();
});

/* ---------- HERO SLIDER ---------- */
function initHeroSlider() {
  const container = document.querySelector('.hero-slider-container');
  if (!container) return;

  const slides = container.querySelectorAll('.slide');
  const dots = container.querySelectorAll('.dot');
  const prevBtn = document.getElementById('prev-slide');
  const nextBtn = document.getElementById('next-slide');
  let currentIdx = 0;
  let interval;

  function setSlide(index) {
    slides.forEach(s => s.classList.remove('active'));
    dots.forEach(d => d.classList.remove('active'));
    
    currentIdx = (index + slides.length) % slides.length;
    slides[currentIdx].classList.add('active');
    if (dots[currentIdx]) dots[currentIdx].classList.add('active');
  }

  const next = () => setSlide(currentIdx + 1);
  const prev = () => setSlide(currentIdx - 1);

  if (nextBtn) nextBtn.addEventListener('click', () => { next(); reset(); });
  if (prevBtn) prevBtn.addEventListener('click', () => { prev(); reset(); });

  dots.forEach((dot, idx) => {
    dot.addEventListener('click', () => { setSlide(idx); reset(); });
  });

  const start = () => { interval = setInterval(next, 7000); };
  const reset = () => { clearInterval(interval); start(); };

  start();
}
