<?php
$page_title = "Manage Home Page";
require_once 'includes/header.php';

// Handle form submissions for different sections
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add_slide':
                $stmt = $pdo->prepare("INSERT INTO home_slides (title, image_url, button_text, button_link) VALUES (?, ?, ?, ?)");
                $stmt->execute([$_POST['title'], $_POST['image_url'], $_POST['button_text'], $_POST['button_link']]);
                $message = "Slide added successfully.";
                break;
            case 'delete_slide':
                $stmt = $pdo->prepare("DELETE FROM home_slides WHERE id = ?");
                $stmt->execute([$_POST['id']]);
                $message = "Slide deleted.";
                break;
            case 'update_stats':
                foreach ($_POST['stats'] as $id => $val) {
                    $stmt = $pdo->prepare("UPDATE home_stats SET value = ? WHERE id = ?");
                    $stmt->execute([$val, $id]);
                }
                $message = "Stats updated.";
                break;
            case 'add_client':
                $stmt = $pdo->prepare("INSERT INTO home_clients (name, logo_url) VALUES (?, ?)");
                $stmt->execute([$_POST['name'], $_POST['logo_url']]);
                $message = "Client added.";
                break;
            case 'delete_client':
                $stmt = $pdo->prepare("DELETE FROM home_clients WHERE id = ?");
                $stmt->execute([$_POST['id']]);
                $message = "Client removed.";
                break;
             case 'add_testimonial':
                $stmt = $pdo->prepare("INSERT INTO home_testimonials (client_name, client_role, testimonial, client_avatar) VALUES (?, ?, ?, ?)");
                $stmt->execute([$_POST['client_name'], $_POST['client_role'], $_POST['testimonial'], $_POST['client_avatar']]);
                $message = "Testimonial added.";
                break;
            case 'delete_testimonial':
                $stmt = $pdo->prepare("DELETE FROM home_testimonials WHERE id = ?");
                $stmt->execute([$_POST['id']]);
                $message = "Testimonial removed.";
                break;
        }
    }
}

// Fetch data
$slides = get_home_slides();
$clients = get_home_clients();
$stats = get_home_stats();
$testimonials = get_home_testimonials();
?>

<?php if ($message): ?>
    <div class="alert alert-success" style="padding: 1rem; background: #d1fae5; color: #065f46; border-radius: 8px; margin-bottom: 2rem;">
        <i class="bi bi-check-circle-fill"></i> <?php echo $message; ?>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Hero Slider</h2>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($slides as $slide): ?>
                <tr>
                    <td><img src="../<?php echo $slide['image_url']; ?>" style="height: 50px; border-radius: 4px;"></td>
                    <td><?php echo $slide['title']; ?></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="action" value="delete_slide">
                            <input type="hidden" name="id" value="<?php echo $slide['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete slide?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <hr style="margin: 2rem 0; border: none; border-top: 1px solid var(--border);">
    <h3>Add New Slide</h3>
    <form method="POST" style="margin-top: 1rem;">
        <input type="hidden" name="action" value="add_slide">
        <div class="row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required placeholder="e.g. ULTIMATE PRECISION">
            </div>
            <div class="form-group">
                <label>Image URL</label>
                <div style="display: flex; gap: 0.5rem;">
                    <input type="text" name="image_url" id="slide-path" class="form-control" required placeholder="Select from media library...">
                    <button type="button" class="btn btn-primary" onclick="openMediaModal('slide-path')" style="white-space: nowrap; font-size: 0.8rem;">Select from Media</button>
                </div>
            </div>
            <div class="form-group">
                <label>Button Text</label>
                <input type="text" name="button_text" class="form-control" value="Our Works">
            </div>
            <div class="form-group">
                <label>Button Link</label>
                <input type="text" name="button_link" class="form-control" value="portfolio.php">
            </div>
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 1rem;">Add Slide</button>
    </form>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
    <!-- Stats Manage -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Performance Stats</h2>
        </div>
        <form method="POST">
            <input type="hidden" name="action" value="update_stats">
            <?php foreach ($stats as $s): ?>
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label><?php echo $s['label']; ?></label>
                <input type="number" name="stats[<?php echo $s['id']; ?>]" value="<?php echo $s['value']; ?>" class="form-control">
            </div>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-primary">Update Stats</button>
        </form>
    </div>

    <!-- Clients Manage -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Partner Logos</h2>
        </div>
        <div style="max-height: 400px; overflow-y: auto; margin-bottom: 1.5rem;">
            <div class="table-responsive">
                <table>
                    <tbody>
                        <?php foreach ($clients as $c): ?>
                        <tr>
                            <td style="width: 60px;">
                                <?php if ($c['logo_url']): ?>
                                    <img src="../<?php echo $c['logo_url']; ?>" style="height: 30px; border-radius: 2px;">
                                <?php else: ?>
                                    <span style="font-size: 0.7rem; color: #999;">TEXT</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $c['name']; ?></td>
                            <td style="text-align: right;">
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete_client">
                                    <input type="hidden" name="id" value="<?php echo $c['id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-x"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <form method="POST" style="display: flex; flex-direction: column; gap: 0.75rem; border-top: 1px solid var(--border); padding-top: 1rem;">
            <input type="hidden" name="action" value="add_client">
            <div class="form-group">
                <label style="font-size: 0.8rem;">Partner Name</label>
                <input type="text" name="name" class="form-control" placeholder="e.g. Gensler" required>
            </div>
            <div class="form-group">
                <label style="font-size: 0.8rem;">Logo URL</label>
                <div style="display: flex; gap: 0.5rem;">
                    <input type="text" name="logo_url" id="client-logo-path" class="form-control" placeholder="Select image...">
                    <button type="button" class="btn btn-primary" onclick="openMediaModal('client-logo-path')" style="white-space: nowrap; font-size: 0.7rem;">Select</button>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Partner</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Client Testimonials</h2>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Author</th>
                    <th>Role</th>
                    <th>Testimonial</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($testimonials as $t): ?>
                <tr>
                    <td><?php echo $t['client_name']; ?></td>
                    <td><?php echo $t['client_role']; ?></td>
                    <td style="font-size: 0.85rem; max-width: 300px;"><?php echo substr($t['testimonial'], 0, 100); ?>...</td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="action" value="delete_testimonial">
                            <input type="hidden" name="id" value="<?php echo $t['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete testimonial?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <hr style="margin: 2rem 0; border: none; border-top: 1px solid var(--border);">
    <h3>Add Testimonial</h3>
    <form method="POST" style="margin-top: 1rem;">
        <input type="hidden" name="action" value="add_testimonial">
        <div class="row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group">
                <label>Client Name</label>
                <input type="text" name="client_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Role</label>
                <input type="text" name="client_role" class="form-control">
            </div>
        </div>
        <div class="form-group" style="margin-top: 1rem;">
            <label>Avatar</label>
            <div style="display: flex; gap: 0.5rem;">
                <input type="text" name="client_avatar" id="avatar-path-home" class="form-control" placeholder="Select from media library...">
                <button type="button" class="btn btn-primary" onclick="openMediaModal('avatar-path-home')" style="white-space: nowrap; font-size: 0.8rem;">Select from Media</button>
            </div>
        </div>
        <div class="form-group" style="margin-top: 1rem;">
            <label>Testimonial Text</label>
            <textarea name="testimonial" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 1rem;">Save Testimonial</button>
    </form>
</div>

<?php 
require_once 'includes/media_modal.php';
require_once 'includes/footer.php'; 
?>
