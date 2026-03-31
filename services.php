<?php 
require_once 'includes/config.php';
require_once 'includes/functions.php';

$page_title = '3D Visualization Services';
$page_description = 'Explore Studio Argon\'s full range of 3D visualization services: exterior rendering, interior rendering, architectural animation, walkthroughs, floor plans, and real estate renders.';

include 'includes/head.php';
include 'includes/header.php';
?>

<!-- PAGE HERO -->
<section class="page-hero">
  <div class="page-hero-bg" style="background-image:url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=2070')"></div>
  <div class="page-hero-overlay"></div>
  <div class="page-hero-content">
    <p class="section-label">OUR EXPERTISE</p>
    <h1>BEYOND <span class="highlight-red">Visuals</span></h1>
    <p>Precision rendering and cinematic storytelling for global architecture.</p>
  </div>
</section>

<!-- SERVICES DETAIL GRID -->
<section class="section">
  <div class="container">
    <div class="section-header">
      <span class="section-label">WHAT WE OFFER</span>
      <h2 class="section-title">Complete 3D Visualization Solutions</h2>
      <p class="section-sub">From architecture drawings to cinematic renders — we deliver every format you need.</p>
    </div>
    <div class="services-detail-grid">

      <?php foreach ($services_list as $service): ?>
      <div class="service-detail-card">
        <img src="<?php echo $service['image']; ?>" alt="<?php echo $service['title']; ?>" loading="lazy">
        <div class="service-detail-body">
          <span class="service-tag"><?php echo $service['tag']; ?></span>
          <h3><?php echo $service['title']; ?></h3>
          <p><?php echo $service['desc']; ?></p>
          <?php if (isset($service['deliverables'])): ?>
          <ul class="deliverables">
            <?php foreach ($service['deliverables'] as $item): ?>
            <li><?php echo $item; ?></li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
          <a href="contact.php" class="btn-primary btn-red">Get Quote →</a>
        </div>
      </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>

<!-- WHO WE SERVE -->
<section class="section section-alt">
  <div class="container">
    <div class="section-header">
      <span class="section-label">OUR EXPERTISE</span>
      <h2 class="section-title">Who We Serve</h2>
    </div>
    <div class="serve-grid">
      <div class="serve-card">
        <div class="serve-icon">🏛️</div>
        <h3>Architects</h3>
        <p>From schematic design to construction documents, we help architects visualize and communicate their designs to clients with photorealistic clarity.</p>
      </div>
      <div class="serve-card">
        <div class="serve-icon">🛋️</div>
        <h3>Interior Designers</h3>
        <p>We bring interior concepts to life with accurate material representation, lighting studies, and furniture layouts that clients can truly experience.</p>
      </div>
      <div class="serve-card">
        <div class="serve-icon">🏗️</div>
        <h3>Real Estate Developers</h3>
        <p>Pre-sell units before construction begins with compelling renders that drive confidence, generate enquiries, and accelerate your sales cycle.</p>
      </div>
    </div>
  </div>
</section>

<!-- AI PROJECT ESTIMATOR -->
<section class="section estimator-section">
  <div class="container">
    <div class="section-header">
      <span class="section-label">AI TOOLS</span>
      <h2 class="section-title">Get an Instant Project Estimate</h2>
      <p class="section-sub">Powered by AI — get a realistic price range and timeline estimate in seconds.</p>
    </div>
    <div class="estimator-box">
      <div class="est-grid">
        <div class="form-group">
          <label for="est-service">Service Type</label>
          <select id="est-service" class="form-control">
            <?php foreach ($services_list as $service): ?>
            <option value="<?php echo $service['title']; ?>"><?php echo $service['title']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Project Scale</label>
          <div class="radio-group">
            <label class="radio-label"><input type="radio" name="scale" value="Small"> Small</label>
            <label class="radio-label"><input type="radio" name="scale" value="Medium" checked> Medium</label>
            <label class="radio-label"><input type="radio" name="scale" value="Large"> Large</label>
            <label class="radio-label"><input type="radio" name="scale" value="Complex"> Complex</label>
          </div>
        </div>
        <div class="form-group">
          <label for="est-views">Number of Views: <strong id="est-views-label">5</strong></label>
          <input type="range" id="est-views" min="1" max="20" value="5" class="form-control" style="padding:6px 0;background:none;border:none;cursor:pointer">
        </div>
        <div class="form-group">
          <label>Turnaround Time</label>
          <div class="radio-group">
            <label class="radio-label"><input type="radio" name="speed" value="Standard (7 days)" checked> Standard (7 days)</label>
            <label class="radio-label"><input type="radio" name="speed" value="Express (3 days)"> Express (3 days)</label>
            <label class="radio-label"><input type="radio" name="speed" value="Rush (24hrs)"> Rush (24hrs)</label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label>Add-ons</label>
        <div class="check-group">
          <label class="check-label"><input type="checkbox" name="addon" value="Night views (+20%)"> Night views (+20%)</label>
          <label class="check-label"><input type="checkbox" name="addon" value="Aerial view (+15%)"> Aerial view (+15%)</label>
          <label class="check-label"><input type="checkbox" name="addon" value="VR format (+25%)"> VR format (+25%)</label>
          <label class="check-label"><input type="checkbox" name="addon" value="Video animation (+40%)"> Video animation (+40%)</label>
        </div>
      </div>
      <button id="estimate-btn" class="btn-primary btn-red btn-magnetic" style="width:100%;justify-content:center;padding:14px">Estimate My Project</button>
      <div id="estimate-result" class="estimate-result"></div>
    </div>
  </div>
</section>

<!-- PROCESS (expanded) -->
<section class="section process-section">
  <div class="container">
    <div class="section-header">
      <span class="section-label">HOW IT WORKS</span>
      <h2 class="section-title">Our Project Process</h2>
    </div>
    <div class="process-steps">
      <div class="process-step">
        <div class="step-num">01</div>
        <h3>Discover &amp; Brief</h3>
        <p>We start by understanding your goals, brand, and audience through a structured briefing session with your project manager.</p>
        <ul><li>Project scope &amp; requirements</li><li>Reference &amp; inspiration collection</li><li>Timeline &amp; budget alignment</li></ul>
      </div>
      <div class="process-step">
        <div class="step-num">02</div>
        <h3>Create &amp; Refine</h3>
        <p>Our senior artists model, light, and render your scenes — bringing you into the process with structured review rounds.</p>
        <ul><li>3D modeling &amp; scene setup</li><li>Lighting, materials &amp; camera</li><li>Up to 3 revision rounds</li></ul>
      </div>
      <div class="process-step">
        <div class="step-num">03</div>
        <h3>Deliver &amp; Support</h3>
        <p>Approved files are exported in your required formats with full commercial rights, plus 30-day post-delivery support.</p>
        <ul><li>High-res file delivery (TIFF/PNG/MP4)</li><li>Multiple format exports</li><li>30-day minor revision support</li></ul>
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
