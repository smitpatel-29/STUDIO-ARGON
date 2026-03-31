<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-col">
                <div class="footer-logo"><img src="<?php echo BASE_URL; ?>assets/uploads/secondary-logo.png" alt="<?php echo SITE_NAME; ?>"></div>
                <p class="footer-tagline">Transforming architectural blueprints into photorealistic visualizations. Trusted by 1000+ clients worldwide.</p>
                <div class="footer-social">
                    <?php if (isset($social_links)): ?>
                        <?php foreach ($social_links as $platform => $url): ?>
                            <a href="<?php echo $url; ?>" aria-label="<?php echo $platform; ?>">
                                <?php if ($platform == 'Instagram'): ?>
                                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                <?php elseif ($platform == 'LinkedIn'): ?>
                                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                <?php elseif ($platform == 'Behance'): ?>
                                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M22 7h-7V5h7v2zm1.726 10c-.442 1.297-2.029 3-5.101 3-3.074 0-5.564-1.729-5.564-5.675 0-3.91 2.325-5.92 5.466-5.92 3.082 0 4.964 1.782 5.375 4.426.078.506.109 1.188.095 2.14H15.97c.13 3.211 3.483 3.312 4.588 2.029H23.72zm-7.718-3.967c-.088-1.79-.973-2.58-2.148-2.58-1.26 0-2.183.796-2.348 2.58h4.496zM1 0h8.005c3.063 0 3.995 1.578 3.995 3.215 0 1.601-.947 2.503-2.119 2.809v.055c1.52.25 2.751 1.271 2.751 3.128C13.632 11.766 12.054 13 8.913 13H1V0zm6.995 5.151c1.39 0 2.004-.668 2.004-1.672 0-.971-.611-1.479-1.993-1.479H4v3.151h3.995zm.251 5.649c1.42 0 2.354-.565 2.354-1.872 0-1.359-.897-1.906-2.508-1.906H4v3.778h4.246z"/></svg>
                                <?php elseif ($platform == 'YouTube'): ?>
                                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>
                                <?php endif; ?>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="footer-col">
                <h4>Company</h4>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>about.php">About Us</a></li>
                    <li><a href="<?php echo BASE_URL; ?>portfolio.php">Portfolio</a></li>
                    <li><a href="<?php echo BASE_URL; ?>blog.php">Blog</a></li>
                    <li><a href="<?php echo BASE_URL; ?>contact.php">Careers</a></li>
                    <li><a href="<?php echo BASE_URL; ?>contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Services</h4>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>services.php">3D Exterior Rendering</a></li>
                    <li><a href="<?php echo BASE_URL; ?>services.php">3D Interior Rendering</a></li>
                    <li><a href="<?php echo BASE_URL; ?>services.php">Architectural Animation</a></li>
                    <li><a href="<?php echo BASE_URL; ?>services.php">3D Walkthrough</a></li>
                    <li><a href="<?php echo BASE_URL; ?>services.php">Floor Plan Rendering</a></li>
                    <li><a href="<?php echo BASE_URL; ?>services.php">Real Estate Renders</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Get In Touch</h4>
                <div class="footer-contact-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    <span><?php echo SITE_ADDRESS; ?></span>
                </div>
                <div class="footer-contact-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    <span><?php echo SITE_EMAIL; ?></span>
                </div>
                <div class="footer-contact-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l2.27-2.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                    <span><?php echo SITE_PHONE; ?></span>
                </div>

                <div class="footer-newsletter" style="margin-top:20px">
                    <input type="email" placeholder="Your email…" aria-label="Newsletter email">
                    <button>Subscribe</button>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. All rights reserved.</p>
            <div class="footer-bottom-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

<!-- Toast -->
<div id="toast" class="toast"></div>
