<?php 
require_once 'includes/db.php';
require_once 'includes/config.php';
require_once 'includes/functions.php';

$page_title = 'About Us | Global 3D Visualization Studio';
$page_description = 'Discover the story behind Studio Argon. A team of dedicated 3D artists and architects transforming the world of visual communication with photorealistic architectural rendering.';

// Fetch dynamic content
$hero = get_page_content('about', 'hero');

include 'includes/head.php';
include 'includes/header.php';
?>

<!-- PAGE HERO -->
<section class="page-hero">
  <div class="page-hero-bg" style="background-image:url('<?php echo !empty($hero['image_url']) ? $hero['image_url'] : 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&q=80&w=2070'; ?>')"></div>
  <div class="page-hero-overlay"></div>
  <div class="page-hero-content">
    <p class="section-label">SINCE 2014</p>
    <h1><?php echo $hero['heading']; ?></h1>
    <p><?php echo $hero['content']; ?></p>
  </div>
</section>

<!-- THE STORY SECTION -->
<section class="section">
  <div class="container">
    <div class="story-grid">
      <div class="story-text" data-aos="fade-right">
        <span class="section-label">EST. 2014</span>
        <h2>Precision in every pixel.<br>Passion in every frame.</h2>
        <p>Founded by a group of architects and digital artists, Studio Argon was born from a simple belief: that architecture shouldn't just be seen—it should be felt. For over ten years, we've bridged the gap between blueprints and believable reality, helping global firms articulate their boldest visions.</p>
        <p>Our process is deeply rooted in architectural theory. We don't just 'render'—we lighting-orient, material-test, and context-build until the digital twin is indistinguishable from the finished structure.</p>
        
        <div class="story-stats">
          <div class="stat-item">
            <h4 class="counter" data-target="120">0</h4>
            <p>Global Clients</p>
          </div>
          <div class="stat-item">
            <h4 class="counter" data-target="850">0</h4>
            <p>Projects Delivered</p>
          </div>
          <div class="stat-item">
            <h4 class="counter" data-target="15">0</h4>
            <p>Award Wins</p>
          </div>
        </div>
      </div>
      
      <div class="story-image-group" data-aos="fade-left">
        <div class="story-image-main">
          <img src="assets/uploads/about_main.jpg" alt="Studio Studio" class="premium-shadow">
        </div>
        <div class="story-image-accent">
          <img src="assets/uploads/about_accent.jpg" alt="Architectural Detail">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- MISSION & VISION -->
<section class="section section-alt">
  <div class="container">
    <div class="section-header center">
      <span class="section-label">OUR PURPOSE</span>
      <h2 class="section-title">Driving Visual Innovation</h2>
    </div>
    <div class="values-grid">
      <div class="value-card" data-aos="fade-up">
        <div class="bg-glow"></div>
        <div class="value-icon">🎯</div>
        <h3>Our Mission</h3>
        <p>To empower architects and developers with cinematic-grade visualizations that inspire confidence, accelerate approvals, and define the future of the built environment.</p>
      </div>
      <div class="value-card" data-aos="fade-up" data-aos-delay="100">
        <div class="bg-glow"></div>
        <div class="value-icon">👁️</div>
        <h3>Our Vision</h3>
        <p>To become the world's most trusted partner for architectural storytelling, setting new industry benchmarks for photorealism and creative collaboration.</p>
      </div>
    </div>
  </div>
</section>

<!-- OUR VALUES -->
<section class="section">
  <div class="container">
    <div class="section-header center">
      <span class="section-label">THE STUDIO PHILOSOPHY</span>
      <h2 class="section-title">Values that define us</h2>
      <p class="section-sub">At the intersection of logic and imagination, these principles guide every frame we deliver.</p>
    </div>
    <div class="values-grid">
      <div class="value-card" data-aos="fade-up">
        <div class="bg-glow"></div>
        <div class="value-icon">💎</div>
        <h3>Radical Realism</h3>
        <p>We push for photorealistic excellence that leaves nothing to the imagination. Every texture and shadow is accounted for.</p>
      </div>
      <div class="value-card" data-aos="fade-up" data-aos-delay="100">
        <div class="bg-glow"></div>
        <div class="value-icon">📐</div>
        <h3>Architectural Depth</h3>
        <p>We don't just "paint" over models. We understand blueprints, BIM, and the physics of the built environment.</p>
      </div>
      <div class="value-card" data-aos="fade-up" data-aos-delay="200">
        <div class="bg-glow"></div>
        <div class="value-icon">🚀</div>
        <h3>Technical Scale</h3>
        <p>From single villas to 500-acre masterplans, our pipeline is built to handle complexity without compromising on speed.</p>
      </div>
      <div class="value-card" data-aos="fade-up" data-aos-delay="300">
        <div class="bg-glow"></div>
        <div class="value-icon">🤝</div>
        <h3>Global Partnership</h3>
        <p>We work as an extension of your team, providing 24/7 support and seamless communication across timezones.</p>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-header">
      <span class="section-label">THE COLLECTIVE</span>
      <h2 class="section-title">Senior Leadership</h2>
      <p class="section-sub">A diverse collective of architects, CG supervisors, and lighting specialists.</p>
    </div>
    <div class="team-grid">
      <div class="team-card" data-aos="zoom-in">
        <div class="team-image"><img src="assets/uploads/team/marcus.jpg" alt="Founder"></div>
        <div class="team-info">
          <h4>Marcus Thorne</h4>
          <p>FOUNDER & CREATIVE DIRECTOR</p>
        </div>
      </div>
      <div class="team-card" data-aos="zoom-in" data-aos-delay="100">
        <div class="team-image"><img src="assets/uploads/team/elena.jpg" alt="Head of CG"></div>
        <div class="team-info">
          <h4>Elena Rossi</h4>
          <p>HEAD OF CG OPERATIONS</p>
        </div>
      </div>
      <div class="team-card" data-aos="zoom-in" data-aos-delay="200">
        <div class="team-image"><img src="assets/uploads/team/david.jpg" alt="Tech Lead"></div>
        <div class="team-info">
          <h4>David Chen</h4>
          <p>TECHNICAL DIRECTOR</p>
        </div>
      </div>
      <div class="team-card" data-aos="zoom-in" data-aos-delay="300">
        <div class="team-image"><img src="assets/uploads/team/sarah.jpg" alt="Lead Architect"></div>
        <div class="team-info">
          <h4>Sarah Jenkins</h4>
          <p>LEAD PROJECT ARCHITECT</p>
        </div>
      </div>
    </div>
  </div>
</section>

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
