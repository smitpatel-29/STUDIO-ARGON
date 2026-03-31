<?php 
require_once 'includes/db.php';
require_once 'includes/config.php';
require_once 'includes/functions.php';

$page_title = 'Portfolio — 1200+ 3D Rendering Projects';
$page_description = 'Browse Studio Argon\'s portfolio of 1200+ architectural visualization projects — exterior, interior, animation, floor plans, and real estate renders.';

$portfolio_db_items = get_portfolio_items();

include 'includes/head.php';
include 'includes/header.php';
?>

<!-- PAGE HERO -->
<section class="page-hero">
  <div class="page-hero-bg" style="background-image:url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=2070')"></div>
  <div class="page-hero-overlay"></div>
  <div class="page-hero-content">
    <p class="section-label">SELECTED WORKS</p>
    <h1>
      CRAFTING <span class="stroke-text">VISIONS</span> <br>
      INTO <span class="highlight-red">REALITY</span>
    </h1>
    <p>1200+ projects delivered across the globe. Precision rendering for world-class architecture.</p>
  </div>
</section>


<!-- FILTER TABS + GRID -->
<section class="section">
  <div class="container">
    <div class="filter-tabs">
      <button class="filter-tab active" data-filter="all">ALL WORKS</button>
      <button class="filter-tab" data-filter="exterior">EXTERIORS</button>
      <button class="filter-tab" data-filter="interior">INTERIORS</button>
      <button class="filter-tab" data-filter="animation">ANIMATION</button>
    </div>

    <div class="portfolio-grid">
      <?php foreach ($portfolio_db_items as $item): ?>
      <div class="card-premium tilt-card port-card" 
           data-category="<?php echo $item['category']; ?>"
           data-tools="<?php echo $item['tools']; ?>"
           data-year="<?php echo $item['year']; ?>"
           data-desc="<?php echo $item['description']; ?>">
        <div class="img-reveal-wrap">
          <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
        </div>
        <div class="portfolio-info">
          <span class="port-cat"><?php echo strtoupper($item['category']); ?></span>
          <h3><?php echo $item['title']; ?></h3>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- LIGHTBOX -->
<div id="lightbox">
  <div class="lightbox-inner">
    <div class="lightbox-img" style="position:relative">
      <img id="lb-img" src="" alt="">
      <button class="lightbox-nav" id="lb-prev">&#8592;</button>
      <button class="lightbox-nav" id="lb-next">&#8594;</button>
    </div>
    <div class="lightbox-info">
      <button id="lightbox-close" title="Close">✕</button>
      <h2 id="lb-title"></h2>
      <span class="service-tag" id="lb-category"></span>
      <p id="lb-desc" style="margin-top:12px"></p>
      <div class="lightbox-meta">
        <span><strong>Tools Used:</strong> <span id="lb-tools"></span></span>
        <span><strong>Year:</strong> <span id="lb-year"></span></span>
      </div>
      <a href="contact.php" class="btn-primary btn-red" style="margin-top:24px">Get Similar Quote →</a>
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
