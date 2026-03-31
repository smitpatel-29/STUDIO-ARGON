<?php
$page_title = 'Add New Blog Post';
require_once 'includes/header.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $tag = $_POST['tag'];
    // Default author info to session/site info
    $author = $_SESSION['admin_name'] ?? 'Studio Argon';
    $author_img = 'assets/uploads/logo-2.png'; // Default logo as avatar
    $image = $_POST['image'];
    $excerpt = $_POST['excerpt'];
    $content = $_POST['content'];
    $date = date('M d, Y');
    
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
    
    // Check if slug exists
    $check = $pdo->prepare("SELECT id FROM blog_posts WHERE slug = ?");
    $check->execute([$slug]);
    if ($check->fetch()) {
        $slug .= '-' . time();
    }
    
    if (!empty($title) && !empty($category) && !empty($image)) {
        $stmt = $pdo->prepare("INSERT INTO blog_posts (title, slug, date, excerpt, image, category, tag, author, author_img, content) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$title, $slug, $date, $excerpt, $image, $category, $tag, $author, $author_img, $content])) {
            $success = "Post published successfully!";
        } else {
            $error = "Error adding post.";
        }
    } else {
        $error = "Please fill in all required fields (Title, Category, Image).";
    }
}
?>

<div class="card" style="max-width: 1000px; margin: 0 auto;">
    <div class="card-header">
        <h2 class="card-title">New Blog Post</h2>
        <a href="blog_list.php" class="btn btn-outline btn-sm"><i class="bi bi-arrow-left"></i> Back to List</a>
    </div>

    <?php if ($error): ?>
        <div class="alert" style="background: rgba(220, 53, 69, 0.1); color: #ff6b6b; padding: 1rem; border-radius: 4px; margin-bottom: 2rem; border: 1px solid rgba(220, 53, 69, 0.2); font-size: 0.9rem;">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert" style="background: rgba(25, 135, 84, 0.1); color: #198754; padding: 1rem; border-radius: 4px; margin-bottom: 2rem; border: 1px solid rgba(25, 135, 84, 0.2); font-size: 0.9rem;">
            <?php echo $success; ?>
        </div>
    <?php endif; ?>

    <form method="POST" id="blogForm" style="display: grid; gap: 2rem;">
        <div class="form-group">
            <label style="display: block; margin-bottom: 0.6rem; font-size: 0.8rem; text-transform: uppercase;">Post Title*</label>
            <input type="text" name="title" class="form-control" placeholder="e.g. The Future of 3D Architectural Viz" required>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem;">
            <div class="form-group">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.6rem;">
                    <label style="font-size: 0.8rem; text-transform: uppercase;">Category*</label>
                    <a href="blog_categories.php" style="font-size: 0.7rem; color: var(--accent); text-transform: none;">+ Manage</a>
                </div>
                <select name="category" class="form-control" required>
                    <option value="">Select Category</option>
                    <?php
                    $cats = $pdo->query("SELECT * FROM blog_categories ORDER BY name ASC")->fetchAll();
                    foreach ($cats as $c) {
                        echo "<option value='{$c['slug']}'>{$c['name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label style="display: block; margin-bottom: 0.6rem; font-size: 0.8rem; text-transform: uppercase;">Display Tag*</label>
                <input type="text" name="tag" class="form-control" placeholder="e.g. Industry Trends" required>
            </div>
            <div class="form-group">
                <label style="display: block; margin-bottom: 0.6rem; font-size: 0.8rem; text-transform: uppercase;">Featured Image*</label>
                <div style="display: flex; gap: 0.5rem;">
                    <input type="text" name="image" id="thumbnail-path" class="form-control" placeholder="Select from media library..." required>
                    <button type="button" class="btn btn-primary" onclick="openMediaModal('thumbnail-path')" style="white-space: nowrap; font-size: 0.8rem;">Select Library</button>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label style="display: block; margin-bottom: 0.6rem; font-size: 0.8rem; text-transform: uppercase;">Excerpt (Short description)</label>
            <textarea name="excerpt" class="form-control" rows="2" placeholder="A brief summary for the blog listing..."></textarea>
        </div>

        <!-- WYSIWYG EDITOR -->
        <div class="form-group">
            <label style="display: block; margin-bottom: 0.6rem; font-size: 0.8rem; text-transform: uppercase;">Full Content</label>
            <div class="wysiwyg-container" style="border: 1px solid var(--border); border-radius: 12px; overflow: hidden; background: #fff;">
                <div class="wysiwyg-toolbar" style="padding: 10px; background: #f8fafc; border-bottom: 1px solid var(--border); display: flex; gap: 5px; flex-wrap: wrap;">
                    <button type="button" class="tool-btn" data-command="bold" title="Bold"><i class="bi bi-type-bold"></i></button>
                    <button type="button" class="tool-btn" data-command="italic" title="Italic"><i class="bi bi-type-italic"></i></button>
                    <button type="button" class="tool-btn" data-command="underline" title="Underline"><i class="bi bi-type-underline"></i></button>
                    <div style="width: 1px; background: #ddd; margin: 0 5px;"></div>
                    <button type="button" class="tool-btn" data-command="formatBlock" data-value="h2" title="Heading 2">H2</button>
                    <button type="button" class="tool-btn" data-command="formatBlock" data-value="h3" title="Heading 3">H3</button>
                    <button type="button" class="tool-btn" data-command="formatBlock" data-value="p" title="Paragraph">P</button>
                    <div style="width: 1px; background: #ddd; margin: 0 5px;"></div>
                    <button type="button" class="tool-btn" data-command="insertUnorderedList" title="Bullet List"><i class="bi bi-list-ul"></i></button>
                    <button type="button" class="tool-btn" data-command="insertOrderedList" title="Numbered List"><i class="bi bi-list-ol"></i></button>
                    <div style="width: 1px; background: #ddd; margin: 0 5px;"></div>
                    <button type="button" class="tool-btn" data-command="createLink" title="Insert Link"><i class="bi bi-link-45deg"></i></button>
                    <button type="button" class="tool-btn" data-command="unlink" title="Remove Link"><i class="bi bi-link"></i></button>
                    <button type="button" class="tool-btn" onclick="openMediaModal('editor-image')" title="Insert Image"><i class="bi bi-image"></i></button>
                    <button type="button" class="tool-btn" data-command="removeFormat" title="Clear Format"><i class="bi bi-eraser"></i></button>
                    <div style="width: 1px; background: #ddd; margin: 0 5px;"></div>
                    <div class="block-dropdown" style="position: relative;">
                        <button type="button" class="tool-btn" id="blockBtn" style="width: auto; padding: 0 10px; gap: 5px; font-size: 0.75rem; font-weight: 600;">BLOCKS <i class="bi bi-chevron-down"></i></button>
                        <div id="blockMenu" style="display: none; position: absolute; top: calc(100% + 5px); left: 0; background: #fff; border: 1px solid var(--border); border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); z-index: 100; min-width: 180px; padding: 8px;">
                            <a href="javascript:void(0)" onclick="insertBlock('section')" class="block-item"><i class="bi bi-box"></i> Styled Section (Div)</a>
                            <a href="javascript:void(0)" onclick="insertBlock('hr')" class="block-item"><i class="bi bi-dash-lg"></i> Horizontal Line</a>
                            <a href="javascript:void(0)" onclick="insertBlock('h2')" class="block-item"><i class="bi bi-type-h2"></i> Large Heading</a>
                            <a href="javascript:void(0)" onclick="insertBlock('h3')" class="block-item"><i class="bi bi-type-h3"></i> Medium Heading</a>
                            <a href="javascript:void(0)" onclick="insertBlock('p')" class="block-item"><i class="bi bi-text-paragraph"></i> New Paragraph</a>
                        </div>
                    </div>
                </div>
                <div id="editor" contenteditable="true" style="min-height: 400px; padding: 25px; outline: none; font-size: 1.1rem; line-height: 1.6;"></div>
                <textarea name="content" id="contentInput" style="display:none;"></textarea>
                <!-- Hidden input to receive media library image URL for editor -->
                <input type="hidden" id="editor-image" onchange="insertImageIntoEditor(this.value)">
            </div>
        </div>

        <style>
            .tool-btn {
                width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;
                border: 1px solid #e2e8f0; background: #fff; border-radius: 6px; cursor: pointer;
                color: #64748b; font-size: 1rem; transition: all 0.2s;
            }
            .tool-btn:hover { background: var(--accent); color: #fff; border-color: var(--accent); }
            
            .block-item {
                display: flex; align-items: center; gap: 10px; padding: 10px 12px;
                font-size: 0.85rem; color: #475569; text-decoration: none; border-radius: 6px;
                transition: all 0.2s;
            }
            .block-item:hover { background: #f1f5f9; color: var(--accent); }
            .block-item i { font-size: 1rem; color: #94a3b8; }
            
            #editor h2 { margin: 2rem 0 1rem; font-weight: 700; color: #000; }
            #editor h3 { margin: 1.5rem 0 0.8rem; font-weight: 700; color: #000; }
            #editor p { margin-bottom: 1.2rem; }
            #editor img { max-width: 100%; border-radius: 12px; margin: 2rem 0; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
            #editor hr { border: 0; border-top: 1px solid #eee; margin: 3rem 0; }
        </style>

        <script>
            // Toggle Block Menu
            const blockBtn = document.getElementById('blockBtn');
            const blockMenu = document.getElementById('blockMenu');
            
            if (blockBtn) {
                blockBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    blockMenu.style.display = blockMenu.style.display === 'none' ? 'block' : 'none';
                });
            }
            
            document.addEventListener('click', () => {
                if (blockMenu) blockMenu.style.display = 'none';
            });

            function insertBlock(type) {
                let html = '';
                if (type === 'section') {
                    html = '<div style="background: #f8fafc; padding: 2.5rem; border-radius: 15px; border: 1px dashed #cbd5e1; margin: 2.5rem 0;"><h3>Section Title</h3><p>Start typing your specialized section content here...</p></div>';
                } else if (type === 'hr') {
                    html = '<hr>';
                } else if (type === 'h2') {
                    html = '<h2>New Section Heading</h2>';
                } else if (type === 'h3') {
                    html = '<h3>Subsection Heading</h3>';
                } else if (type === 'p') {
                    html = '<p>Your new paragraph content goes here...</p>';
                }
                
                document.getElementById('editor').focus();
                document.execCommand('insertHTML', false, html);
                blockMenu.style.display = 'none';
            }
            document.querySelectorAll('.tool-btn[data-command]').forEach(btn => {
                btn.addEventListener('click', () => {
                    const command = btn.getAttribute('data-command');
                    const value = btn.getAttribute('data-value') || null;
                    
                    if (command === 'createLink') {
                        const url = prompt("Enter URL:");
                        if (url) document.execCommand(command, false, url);
                    } else {
                        document.execCommand(command, false, value);
                    }
                });
            });

            function insertImageIntoEditor(url) {
                if (url) {
                    const fullUrl = `../${url}`;
                    document.execCommand('insertImage', false, fullUrl);
                }
            }

            document.getElementById('blogForm').onsubmit = function() {
                document.getElementById('contentInput').value = document.getElementById('editor').innerHTML;
            };
        </script>

        <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 1rem;">
            <button type="submit" class="btn btn-primary">Publish Post</button>
        </div>
    </form>
</div>

<?php 
require_once 'includes/media_modal.php';
require_once 'includes/footer.php'; 
?>
