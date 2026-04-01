<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'includes/db.php';
require_once 'includes/config.php';
require_once 'includes/functions.php';

$page_title = 'Photorealistic 3D Architectural Rendering Studio';
$page_description = 'Studio Argon is a premier 3D architectural visualization studio with 10+ years of experience. Photorealistic exterior, interior rendering, animation and walkthroughs for architects and developers worldwide.';

$portfolio_preview = get_portfolio_items(2);
$blog_preview = get_blog_posts(3);
$slides = get_home_slides();
$clients = get_home_clients();
$about_teaser = get_page_content('home', 'about_teaser');

include 'includes/head.php';
include 'includes/header.php';
?>
<!-- HERO SLIDER -->
<section class="hero hero-slider-container">
  <div class="hero-slider">
    <?php foreach ($slides as $index => $slide): ?>
    <div class="slide <?php echo $index === 0 ? 'active' : ''; ?>">
      <div class="hero-bg" style="background-image:url('<?php echo $slide['image_url']; ?>')"></div>
      <div class="hero-overlay"></div>
      <div class="hero-content">
        <h1><?php echo $slide['title']; ?></h1>
        <div class="hero-btns">
          <div class="magnetic-wrap"><a href="<?php echo $slide['button_link']; ?>" class="btn-primary btn-red btn-magnetic"><?php echo $slide['button_text']; ?></a></div>
          <?php if ($index === 0): ?>
          <div class="magnetic-wrap"><a href="portfolio.php" class="btn-primary btn-outline btn-magnetic">View Portfolio</a></div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  
  <!-- Slider Nav -->
  <div class="slider-nav">
    <button class="slider-prev" id="prev-slide">←</button>
    <button class="slider-next" id="next-slide">→</button>
  </div>
  <div class="slider-dots" id="slider-dots">
    <?php foreach ($slides as $index => $slide): ?>
    <span class="dot <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>"></span>
    <?php endforeach; ?>
  </div>
</section>

<!-- CLIENTS MARQUEE -->
<div class="marquee">
  <div class="marquee-content">
    <?php foreach ($clients as $client): ?>
    <div class="marquee-item">
      <?php if (!empty($client['logo_url'])): ?>
        <img src="<?php echo $client['logo_url']; ?>" alt="<?php echo $client['name']; ?>" class="marquee-logo">
      <?php else: ?>
        <span class="marquee-text"><?php echo $client['name']; ?></span>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>
    <!-- Duplicate for smooth loop -->
    <?php foreach ($clients as $client): ?>
    <div class="marquee-item">
      <?php if (!empty($client['logo_url'])): ?>
        <img src="<?php echo $client['logo_url']; ?>" alt="<?php echo $client['name']; ?>" class="marquee-logo">
      <?php else: ?>
        <span class="marquee-text"><?php echo $client['name']; ?></span>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- ABOUT TEASER REDESIGNED -->
<section class="section section-light">
  <div class="container">
    <div class="about-teaser-grid">
      <div class="about-teaser-img" data-aos="fade-right">
        <img src="<?php echo $about_teaser['image_url'] ?? 'assets/image/studio_space.jpg'; ?>" alt="Studio Space">
      </div>
      <div class="about-teaser-text" data-aos="fade-left">
        <span class="section-label"><?php echo $about_teaser['meta_info'] ?? 'EST. 2014'; ?></span>
        <h2 class="section-title"><?php echo $about_teaser['heading'] ?? 'Innovative 3D Visuals'; ?></h2>
        <div class="teaser-p"><?php echo nl2br($about_teaser['content'] ?? ''); ?></div>
        <div class="magnetic-wrap" style="margin-top: 1.5rem;"><a href="about.php" class="btn-primary btn-outline-red">Learn Our Story</a></div>
      </div>
    </div>
  </div>
</section>

<!-- SERVICES PREVIEW -->
<section class="section section-light">
  <div class="container">
    <div class="section-header center">
      <span class="section-label">SERVICES</span>
      <h2 class="section-title">Visualizing <span class="font-serif italic">Success</span> Through Quality</h2>
    </div>
    <div class="services-grid">
      <?php foreach ($services_list as $service): ?>
      <div class="card-premium tilt-card">
        <div class="img-reveal-wrap">
          <img src="<?php echo $service['image']; ?>" alt="<?php echo $service['title']; ?>">
        </div>
        <div class="card-body">
          <span class="card-num"><?php echo $service['id']; ?></span>
          <h3><?php echo $service['title']; ?></h3>
          <p><?php echo $service['desc']; ?></p>
          <a href="services.php" class="btn-text">VIEW DETAILS →</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- PROCESS -->
<section class="section section-dark process-section overflow-hidden">
  <div class="container">
    <div class="section-header center">
      <span class="section-label">OUR PIPELINE</span>
      <h2 class="section-title">The <span class="font-serif">Journey</span> to Excellence</h2>
    </div>
    
    <div class="process-line-wrap">
      <svg class="process-svg-line" viewBox="0 0 1200 200" fill="none" preserveAspectRatio="none">
        <path d="M0 100 C 300 100, 300 180, 600 100 C 900 20. 900 100, 1200 100" stroke="rgba(255,26,26,0.15)" stroke-width="2" stroke-dasharray="10 10" />
      </svg>
      
      <div class="process-steps">
        <div class="process-step" data-aos="fade-up">
          <div class="step-num">01</div>
          <span class="phase-tag">PHASE I</span>
          <h3>CONCEPT</h3>
          <p>The strategic foundation where architectural intent meets cinematic narrative. We define the mood, light, and camera choreography.</p>
          <ul>
            <li>Blueprint & BIM Digitization</li>
            <li>Lighting Sun-Study Analysis</li>
            <li>Camera Path Design (Cinematography)</li>
            <li>Volume & Context Block-outs</li>
          </ul>
        </div>
        
        <div class="process-step" data-aos="fade-up" data-aos-delay="200">
          <div class="step-num">02</div>
          <span class="phase-tag">PHASE II</span>
          <h3>CRAFT</h3>
          <p>The technical alchemy of 3D construction. We simulate reality using high-fidelity physics and hyper-realistic digital matter.</p>
          <ul>
            <li>Sub-D High-Poly Modeling</li>
            <li>PBR Material Calibration</li>
            <li>Ecosystem Scattering (Scatter 5)</li>
            <li>Volumetric Atmosphere Setup</li>
          </ul>
        </div>
        
        <div class="process-step" data-aos="fade-up" data-aos-delay="400">
          <div class="step-num">03</div>
          <span class="phase-tag">PHASE III</span>
          <h3>PERFECT</h3>
          <p>The final layer of polish. We compute raw data into 8K masterpieces, refined with global illumination and pixel-perfect grading.</p>
          <ul>
            <li>Master 8K Cluster Rendering</li>
            <li>Multi-Pass Compositing</li>
            <li>Professional Color Grading (ACES)</li>
            <li>Delivery for AR/VR & 360 Portals</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PORTFOLIO PREVIEW -->
<section class="section section-light">
  <div class="container">
    <div class="section-header left">
      <span class="section-label">PORTFOLIO</span>
      <h2 class="section-title">Selected <span class="stroke-text">Works</span></h2>
    </div>
    <div class="portfolio-grid">
      <?php foreach ($portfolio_preview as $project): ?>
      <div class="card-premium tilt-card">
        <div class="img-reveal-wrap">
          <img src="<?php echo $project['image']; ?>" alt="<?php echo $project['title']; ?>">
        </div>
        <div class="portfolio-info">
          <span class="port-cat"><?php echo strtoupper($project['category']); ?></span>
          <h3><?php echo $project['title']; ?></h3>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <div style="text-align:center;margin-top:60px">
      <div class="magnetic-wrap"><a href="portfolio.php" class="btn-primary btn-red btn-magnetic">Explore Full Portfolio</a></div>
    </div>
  </div>
</section>

<!-- BLOG SECTION -->
<section class="section section-dark">
  <div class="container">
    <div class="section-header left">
      <span class="section-label">JOURNAL</span>
      <h2 class="section-title">LATEST <span class="stroke-text">Inspiration</span></h2>
    </div>
    <div class="blog-grid">
      <?php foreach ($blog_preview as $post): ?>
      <div class="card-premium tilt-card">
        <div class="img-reveal-wrap"><img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>"></div>
        <div class="card-body">
          <span class="card-num"><?php echo strtoupper($post['date']); ?></span>
          <h3><?php echo $post['title']; ?></h3>
          <p><?php echo $post['excerpt']; ?></p>
          <a href="blog.php" class="btn-text">READ MORE</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<?php 
$testimonials = get_home_testimonials();
$stats = get_home_stats();
?>
<!-- TESTIMONIALS -->
<section class="section section-light">
  <div class="container">
    <div class="section-header center">
      <span class="section-label">TESTIMONIALS</span>
      <h2 class="section-title">What Clients <span class="font-serif italic">Say</span></h2>
    </div>
    <div class="testimonials-grid">
      <?php foreach ($testimonials as $t): ?>
      <div class="card-premium testimonial-card">
        <p><?php echo $t['testimonial']; ?></p>
        <div class="testimonial-author">
          <img src="<?php echo $t['client_avatar']; ?>" alt="<?php echo $t['client_name']; ?>">
          <div>
            <strong><?php echo strtoupper($t['client_name']); ?></strong>
            <em><?php echo strtoupper($t['client_role']); ?></em>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- STATS -->
<div class="stats-band">
  <div class="container">
    <div class="stats-grid">
      <?php foreach ($stats as $s): ?>
      <div class="stat-item">
        <span class="stat-num counter" data-target="<?php echo $s['value']; ?>" data-suffix="+">0</span>
        <span class="stat-label"><?php echo $s['label']; ?></span>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<!-- NEWSLETTER BAND -->
<section class="newsletter-band">
  <div class="container">
    <span class="section-label">THE JOURNAL</span>
    <h2>STAY INSPIRED</h2>
    <p>Subscribe to our newsletter for the latest trends, tips, and Studio Argon project reveals.</p>
    <div class="newsletter-form">
      <input type="email" placeholder="Enter your email address…" aria-label="Newsletter email">
      <button class="btn-primary btn-red">SUBSCRIBE →</button>
    </div>
  </div>
</section>

<?php 
include 'includes/footer.php';
include 'includes/scripts.php';
?>
