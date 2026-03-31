<?php 
require_once 'includes/db.php';
require_once 'includes/config.php';
require_once 'includes/functions.php';

$page_title = 'Blog — Ideas & Insights';
$page_description = 'Tips, trends, and inspiration from the world of 3D architectural visualization. Expert articles on rendering software, industry trends, and case studies.';

$blog_db_posts = get_blog_posts();

include 'includes/head.php';
include 'includes/header.php';
?>

<!-- PAGE HERO -->
<section class="page-hero">
  <div class="page-hero-bg" style="background-image:url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=2070')"></div>
  <div class="page-hero-overlay"></div>
  <div class="page-hero-content">
    <p class="section-label">THE JOURNAL</p>
    <h1>IDEAS & <span class="highlight-red">Insights</span></h1>
    <p>Exploring the intersection of architecture, technology, and storytelling.</p>
  </div>
</section>

<!-- BLOG CONTENT -->
<section class="section">
  <div class="container">

    <!-- FEATURED POST -->
    <?php if (!empty($blog_db_posts)): $featured = $blog_db_posts[0]; ?>
    <div class="featured-post">
      <img src="<?php echo $featured['image']; ?>" alt="Featured article" loading="lazy">
      <div class="featured-post-overlay"></div>
      <div class="featured-post-content">
        <span class="featured-badge">Featured</span>
        <h2><?php echo $featured['title']; ?></h2>
        <p><?php echo $featured['excerpt']; ?></p>
        <a href="#" class="btn-primary btn-red">Read Article →</a>
      </div>
    </div>
    <?php endif; ?>

    <!-- SEARCH + FILTER -->
    <div class="blog-filter-bar">
      <input type="text" id="blog-search" class="blog-search" placeholder="Search articles…" autocomplete="off">
      <div class="filter-pills">
        <button class="filter-pill active" data-cat="all">All</button>
        <button class="filter-pill" data-cat="rendering-tips">Rendering Tips</button>
        <button class="filter-pill" data-cat="industry-trends">Industry Trends</button>
        <button class="filter-pill" data-cat="case-studies">Case Studies</button>
        <button class="filter-pill" data-cat="software-guides">Software Guides</button>
      </div>
    </div>

    <!-- BLOG GRID -->
    <div class="blog-grid">
      <?php foreach ($blog_db_posts as $post): ?>
      <div class="blog-card" data-category="<?php echo $post['category']; ?>">
        <img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>" loading="lazy">
        <div class="blog-card-body">
          <div class="blog-meta">
            <span class="cat-tag"><?php echo $post['tag']; ?></span>
            <span class="blog-date"><?php echo $post['date']; ?></span>
          </div>
          <div class="blog-author">
            <img src="<?php echo $post['author_img']; ?>" alt="Author">
            <span><?php echo $post['author']; ?></span>
          </div>
          <h3><a href="blogs/<?php echo $post['slug']; ?>" style="text-decoration: none; color: inherit;"><?php echo $post['title']; ?></a></h3>
          <p><?php echo $post['excerpt']; ?></p>
          <a href="blogs/<?php echo $post['slug']; ?>" class="read-more">Read More →</a>
        </div>
      </div>
      <?php endforeach; ?>
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
