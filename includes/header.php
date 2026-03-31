<!-- NAVBAR -->
<nav class="navbar" id="main-nav">
    <a href="<?php echo BASE_URL; ?>index.php" class="nav-logo">
        <img src="<?php echo BASE_URL; ?>assets/uploads/secondary-logo.png" alt="<?php echo SITE_NAME; ?> Logo">
    </a>
    <div class="nav-links">
        <?php foreach ($nav_menu as $name => $url): ?>
            <a href="<?php echo BASE_URL . $url; ?>" class="<?php echo is_active($url); ?>"><?php echo $name; ?></a>
        <?php endforeach; ?>
    </div>
    <div class="nav-right">
        <a href="<?php echo BASE_URL; ?>contact.php" class="btn-primary btn-red btn-magnetic">Get Free Quote</a>
    </div>
    <button class="nav-hamburger" id="nav-hamburger" aria-label="Open menu">
        <span></span><span></span><span></span>
    </button>
</nav>

<!-- Mobile Overlay -->
<div class="nav-overlay" id="nav-overlay">
    <button class="overlay-close" id="overlay-close">✕</button>
    <?php foreach ($nav_menu as $name => $url): ?>
        <a href="<?php echo BASE_URL . $url; ?>" class="<?php echo is_active($url); ?>"><?php echo $name; ?></a>
    <?php endforeach; ?>
    <a href="<?php echo BASE_URL; ?>contact.php" class="btn-primary btn-red" style="margin-top:20px;width:auto;padding:12px 30px">Get Free Quote</a>
</div>
