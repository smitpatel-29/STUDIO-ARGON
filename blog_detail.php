<?php 
require_once 'includes/db.php';
require_once 'includes/config.php';
require_once 'includes/functions.php';

if (isset($_GET['slug'])) {
    $slug = $_GET['slug'];
    $stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE slug = ?");
    $stmt->execute([$slug]);
    $post = $stmt->fetch();
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE id = ?");
    $stmt->execute([$id]);
    $post = $stmt->fetch();
} else {
    header('Location: ' . BASE_URL . 'blog.php');
    exit();
}

if (!$post) {
    header('Location: ' . BASE_URL . 'blog.php');
    exit();
}

$page_title = $post['title'];
$page_description = $post['excerpt'];

include 'includes/head.php';
include 'includes/header.php';
?>

<!-- PAGE HERO: BLOG POST -->
<section class="page-hero">
  <div class="page-hero-bg" style="background-image:url('<?php echo BASE_URL . $post['image']; ?>')"></div>
  <div class="page-hero-overlay" style="background: linear-gradient(to bottom, rgba(15, 23, 42, 0.4), rgba(15, 23, 42, 0.9));"></div>
  <div class="page-hero-content">
    <p class="section-label" style="display: inline-block; background: var(--red); color: white; padding: 4px 12px; margin-bottom: 2rem;"><?php echo strtoupper($post['tag']); ?></p>
    <h1 style="font-size: clamp(2rem, 5vw, 3.5rem); line-height: 1.1; margin: 0 auto; max-width: 1000px;"><?php echo $post['title']; ?></h1>
    <div class="blog-meta" style="margin-top: 2.5rem; display: flex; align-items: center; justify-content: center; gap: 2rem; border-top: 1px solid rgba(255,255,255,0.15); padding-top: 2rem;">
        <div style="display: flex; align-items: center; gap: 0.8rem;">
            <img src="<?php echo BASE_URL . $post['author_img']; ?>" alt="Author" style="width: 45px; height: 45px; border-radius: 50%; border: 2px solid var(--red);">
            <span style="font-weight: 500; font-size: 0.95rem;">By <?php echo $post['author']; ?></span>
        </div>
        <span style="font-size: 0.95rem; opacity: 0.8;"><i class="bi bi-calendar3" style="color: var(--red); margin-right: 5px;"></i> <?php echo $post['date']; ?></span>
    </div>
  </div>
</section>

<style>
    .blog-article-content h2 { font-size: 2.2rem; margin: 3rem 0 1.5rem; color: #000; text-transform: none; font-weight: 700; letter-spacing: -0.02em; }
    .blog-article-content h3 { font-size: 1.8rem; margin: 2.5rem 0 1.2rem; color: #000; text-transform: none; font-weight: 700; letter-spacing: -0.01em; }
    .blog-article-content p { margin-bottom: 2rem; }
    .blog-article-content img { border-radius: 12px; margin: 2.5rem 0; width: 100%; height: auto; }
    .blog-article-content blockquote { border-left: 5px solid var(--red); padding-left: 2rem; font-style: italic; font-size: 1.5rem; margin: 3rem 0; color: #555; }
</style>

<!-- BLOG CONTENT -->
<section class="section" style="background: white; color: #111;">
    <div class="container" style="max-width: 850px;">
        <div class="blog-article-content" style="font-size: 1.25rem; line-height: 1.9; letter-spacing: -0.01em;">
            <?php echo $post['content']; ?>
        </div>

        <!-- SHARE & NAVIGATION -->
        <div class="blog-post-footer" style="margin-top: 6rem; padding: 3rem 0; border-top: 1px solid #EEE; display: flex; justify-content: space-between; align-items: center;">
            <a href="<?php echo BASE_URL; ?>blog.php" class="btn-primary btn-outline" style="text-decoration: none; color: #111;">← Back to Journal</a>
            <div class="share-group" style="display: flex; gap: 1rem; align-items: center;">
                <span style="font-size: 0.8rem; font-weight: 800; color: #999;">SHARE THIS CASE</span>
                <div style="display: flex; gap: 1.5rem; font-size: 1.2rem;">
                    <a href="#" style="color: #111;"><i class="bi bi-facebook"></i></a>
                    <a href="#" style="color: #111;"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" style="color: #111;"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
include 'includes/footer.php';
include 'includes/scripts.php';
?>
