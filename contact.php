<?php 
require_once 'includes/db.php';
require_once 'includes/config.php';
require_once 'includes/functions.php';

$page_title = 'Contact Studio Argon — Get a Free Quote';
$page_description = 'Contact Studio Argon for a free project quote. Reach us by form, email, or phone. Houston, TX USA — serving clients worldwide.';

// Fetch dynamic content
$hero = get_page_content('contact', 'hero');
$enquiry = get_page_content('contact', 'enquiry');
$info = get_page_content('contact', 'info');
$details = get_page_content('contact', 'details');

include 'includes/head.php';
include 'includes/header.php';
?>

<!-- PAGE HERO -->
<section class="page-hero">
  <div class="page-hero-bg" style="background-image:url('<?php echo !empty($hero['image_url']) ? $hero['image_url'] : 'assets/uploads/exterior.png'; ?>')"></div>
  <div class="page-hero-overlay"></div>
  <div class="page-hero-content">
    <p class="section-label"><?php echo $hero['heading'] ?? 'GET IN TOUCH'; ?></p>
    <h1><?php echo $hero['content']; ?></h1>
  </div>
</section>

<!-- CONTACT FORM + INFO -->
<section class="section" id="contact-form-section">
  <div class="container">
    <div class="contact-grid">

      <!-- FORM -->
      <div class="contact-form-col">
        <span class="section-label"><?php echo $enquiry['content'] ?? 'ENQUIRY'; ?></span>
        <h2 class="section-title"><?php echo $enquiry['heading'] ?? 'Request a <span class="highlight-red">Quote</span>'; ?></h2>
        <form id="contact-form" novalidate>
          <div class="form-group">
            <label for="cf-name">Full Name *</label>
            <input type="text" id="cf-name" class="form-control" placeholder="John Smith" required>
            <span class="form-error">Please enter your full name.</span>
          </div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
            <div class="form-group">
              <label for="cf-email">Email *</label>
              <input type="email" id="cf-email" class="form-control" placeholder="john@email.com" required>
              <span class="form-error">Please enter a valid email.</span>
            </div>
            <div class="form-group">
              <label for="cf-phone">Phone</label>
              <input type="tel" id="cf-phone" class="form-control" placeholder="+1 234 567 8901">
            </div>
          </div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
            <div class="form-group">
              <label for="cf-service">Service Needed *</label>
              <select id="cf-service" class="form-control" required>
                <option value="">Select service…</option>
                <?php foreach ($services_list as $service): ?>
                <option><?php echo $service['title']; ?></option>
                <?php endforeach; ?>
                <option>Multiple Services</option>
              </select>
              <span class="form-error">Please select a service.</span>
            </div>
            <div class="form-group">
              <label for="cf-scale">Project Scale *</label>
              <select id="cf-scale" class="form-control" required>
                <option value="">Select scale…</option>
                <option>Small (1–3 renders)</option>
                <option>Medium (4–10 renders)</option>
                <option>Large (10+ renders)</option>
                <option>Full Project Suite</option>
              </select>
              <span class="form-error">Please select a scale.</span>
            </div>
          </div>
          <div class="form-group">
            <label for="cf-budget">Budget Range</label>
            <select id="cf-budget" class="form-control">
              <option value="">Select budget…</option>
              <option>Under $500</option>
              <option>$500 – $1,500</option>
              <option>$1,500 – $5,000</option>
              <option>$5,000 – $15,000</option>
              <option>$15,000+</option>
            </select>
          </div>
          <div class="form-group">
            <label for="cf-message">Project Details *</label>
            <textarea id="cf-message" class="form-control" placeholder="Tell us about your project — deadlines, special requirements, reference images, etc." required></textarea>
            <span class="form-error">Please describe your project.</span>
          </div>
          <button type="submit" class="btn-primary btn-red btn-magnetic" style="width:100%;justify-content:center;padding:16px;font-size:0.9rem">Send Message →</button>
        </form>
      </div>

      <!-- INFO -->
      <div class="contact-info-col">
        <span class="section-label">DIRECTIONS</span>
        <h2 class="section-title"><?php echo $info['heading'] ?? 'CONTACT INFO'; ?></h2>
        <div class="contact-info-item">
          <div class="contact-info-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
          </div>
          <div><h4>Location</h4><p><?php echo nl2br($info['content']); ?></p></div>
        </div>
        <div class="contact-info-item">
          <div class="contact-info-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
          </div>
          <div><h4>Email</h4><p><?php echo $details['heading'] ?? SITE_EMAIL; ?></p></div>
        </div>
        <div class="contact-info-item">
          <div class="contact-info-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l2.27-2.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
          </div>
          <div><h4>Phone</h4><p><?php echo $details['content'] ?? SITE_PHONE; ?></p></div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- FULL WIDTH MAP -->
<section style="width: 100%; height: 500px; display: block; overflow: hidden; line-height: 0; background-color: var(--surface);">
  <iframe src="https://maps.google.com/maps?q=<?php echo urlencode($info['content']); ?>&t=&z=6&ie=UTF8&iwloc=&output=embed" width="100%" height="100%" style="border:0; filter: invert(90%) hue-rotate(180deg) brightness(85%); pointer-events: auto;" allowfullscreen="" loading="lazy"></iframe>
</section>


<script>
document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = this;
    const btn = form.querySelector('button');
    const btext = btn.innerHTML;
    
    // Simple validation
    const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
    let valid = true;
    inputs.forEach(input => {
        if (!input.value.trim()) {
            valid = false;
            input.parentElement.classList.add('has-error');
        } else {
            input.parentElement.classList.remove('has-error');
        }
    });

    if (!valid) return;

    btn.disabled = true;
    btn.innerHTML = 'Sending...';

    const formData = new FormData();
    formData.append('name', document.getElementById('cf-name').value);
    formData.append('email', document.getElementById('cf-email').value);
    formData.append('phone', document.getElementById('cf-phone').value);
    formData.append('service', document.getElementById('cf-service').value);
    formData.append('message', document.getElementById('cf-message').value);

    fetch('includes/contact_handler.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            alert(data.message);
            form.reset();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(err => {
        console.error(err);
        alert('An unexpected error occurred. Please try again.');
    })
    .finally(() => {
        btn.disabled = false;
        btn.innerHTML = btext;
    });
});
</script>

<?php 
include 'includes/footer.php';
include 'includes/scripts.php';
?>
