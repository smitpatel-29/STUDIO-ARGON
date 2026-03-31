<?php
/**
 * Helper function to determine the active CSS class for a navigation link based on the current page.
 *
 * @param string $page_name The file name of the page to check.
 * @return string The CSS class name 'active' if it's the current page, otherwise empty.
 */
function is_active($page_name) {
    $current_page = basename($_SERVER['PHP_SELF']);
    return ($current_page == $page_name) ? 'active' : '';
}

/**
 * Sanitizes input values for security (if needed later for forms).
 */
function sanitize($input) {
    return htmlspecialchars(trim($input));
}

/**
 * Formats a project ID string appropriately for consistent display across the site.
 */
function format_id($id) {
    return str_pad($id, 2, '0', STR_PAD_LEFT);
}
/**
 * Fetch all portfolio items from the database.
 */
function get_portfolio_items($limit = null, $category = null) {
    global $pdo;
    $sql = "SELECT * FROM portfolio";
    $params = [];
    
    if ($category) {
        $sql .= " WHERE category = ?";
        $params[] = $category;
    }
    
    $sql .= " ORDER BY created_at DESC";
    
    if ($limit) {
        $sql .= " LIMIT " . (int)$limit;
    }
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

/**
 * Fetch all blog posts from the database.
 */
function get_blog_posts($limit = null) {
    global $pdo;
    $sql = "SELECT * FROM blog_posts ORDER BY created_at DESC";
    
    if ($limit) {
        $sql .= " LIMIT " . (int)$limit;
    }
    
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}
/**
 * Fetch dynamic page content (headings, text, images)
 */
function get_page_content($page, $section) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM site_content WHERE page_slug = ? AND section_slug = ?");
    $stmt->execute([$page, $section]);
    $res = $stmt->fetch();
    return $res ? $res : ['heading' => '', 'content' => '', 'image_url' => ''];
}
/**
 * Fetch Home Slides
 */
function get_home_slides() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM home_slides ORDER BY order_index ASC, id ASC");
    return $stmt->fetchAll();
}

/**
 * Fetch Home Clients
 */
function get_home_clients() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM home_clients ORDER BY order_index ASC, name ASC");
    return $stmt->fetchAll();
}

/**
 * Fetch Home Stats
 */
function get_home_stats() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM home_stats ORDER BY order_index ASC, id ASC");
    return $stmt->fetchAll();
}

/**
 * Fetch Home Testimonials
 */
function get_home_testimonials() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM home_testimonials ORDER BY order_index ASC, id ASC");
    return $stmt->fetchAll();
}
?>
