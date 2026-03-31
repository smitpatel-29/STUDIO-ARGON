<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' | ' : ''; ?>Admin Panel - Studio Argon</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --bg: #F8FAFC;
            --sidebar-bg: #FFFFFF;
            --card-bg: #FFFFFF;
            --border: #E2E8F0;
            --accent: #E11D48; /* Premium Red (Rose 600) */
            --accent-hover: #BE123D;
            --text-primary: #0F172A;
            --text-secondary: #64748B;
            --sidebar-width: 280px;
            --header-height: 70px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--bg);
            color: var(--text-primary);
            font-family: 'Outfit', sans-serif;
            overflow-x: hidden;
        }

        /* Layout */
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 10px 0 30px rgba(0,0,0,0.02);
        }

        .sidebar-brand {
            height: var(--header-height);
            display: flex;
            align-items: center;
            padding: 0 2rem;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-brand img {
            height: 32px; /* Slightly smaller for cleaner look */
            width: auto;
            object-fit: contain;
        }

        .sidebar-menu {
            padding: 2rem 1.2rem;
            flex-grow: 1;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: var(--border) transparent;
        }

        .sidebar-menu::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 10px;
        }

        .menu-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-secondary);
            margin: 1.5rem 1rem 0.8rem;
            font-weight: 700;
            opacity: 0.6;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.9rem 1.2rem;
            color: var(--text-secondary);
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 0.4rem;
            transition: all 0.25s ease;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .menu-item i {
            margin-right: 1rem;
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .menu-item:hover {
            background: #FFF1F2;
            color: var(--accent);
        }

        .menu-item:hover i {
            transform: translateX(3px);
        }

        .menu-item.active {
            background: var(--accent);
            color: white;
            box-shadow: 0 4px 12px rgba(225, 29, 72, 0.2);
        }

        .menu-item.active i {
            color: white;
        }

        .user-profile {
            display: flex;
            align-items: center;
            padding: 0.4rem 0.8rem;
            text-decoration: none;
            color: var(--text-primary);
            border-radius: 10px;
            transition: all 0.3s;
            border: 1px solid transparent;
        }

        .user-profile:hover {
            background: #F1F5F9;
            border-color: var(--border);
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            background: var(--accent);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            margin-right: 1rem;
            font-size: 1.1rem;
            box-shadow: 0 4px 10px rgba(225, 29, 72, 0.15);
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-size: 0.95rem;
            font-weight: 700;
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            flex-grow: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        header.admin-header {
            height: var(--header-height);
            background: #FFFFFF;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem; /* Sync with sidebar padding */
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .page-title h1 {
            font-size: 1.4rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: var(--text-primary);
        }

        .header-actions {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .btn-logout {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.5rem 1rem;
            border-radius: 6px;
        }

        .btn-logout:hover {
            background: #FEF2F2;
            color: var(--accent);
        }

        .content-area {
            padding: 2.5rem;
            max-width: 1400px;
            width: 100%;
            margin: 0 auto;
        }

        /* Common Elements */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.8rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .btn {
            padding: 0.7rem 1.4rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            font-family: inherit;
        }

        .btn-primary {
            background: var(--accent);
            color: white;
            box-shadow: 0 4px 15px rgba(225, 29, 72, 0.2);
        }

        .btn-primary:hover {
            background: var(--accent-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(225, 29, 72, 0.3);
        }

        .btn-outline {
            background: white;
            border: 1px solid var(--border);
            color: var(--text-primary);
        }

        .btn-outline:hover {
            border-color: var(--accent);
            background: #FFF1F2;
            color: var(--accent);
        }

        .btn-danger {
            background: #FEF2F2;
            color: #E11D48;
            border: 1px solid #FECDD3;
        }

        .btn-danger:hover {
            background: #E11D48;
            color: white;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        th {
            text-align: left;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-secondary);
            padding: 1.2rem 1rem;
            border-bottom: 1px solid var(--border);
            font-weight: 700;
        }

        td {
            padding: 1.2rem 1rem;
            border-bottom: 1px solid var(--border);
            font-size: 0.95rem;
            color: var(--text-primary);
            vertical-align: middle;
        }

        tr:hover td {
            background: #F8FAFC;
        }

        .table-img {
            width: 55px;
            height: 55px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .badge {
            padding: 0.35rem 0.8rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .badge-accent {
            background: #FFF1F2;
            color: var(--accent);
        }

        .form-control {
            background: #F8FAFC;
            border: 1px solid var(--border);
            color: var(--text-primary);
            padding: 0.8rem 1.2rem;
            border-radius: 8px;
            width: 100%;
            font-family: inherit;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent);
            background: white;
            box-shadow: 0 0 0 4px rgba(225, 29, 72, 0.1);
        }

        @media (max-width: 1024px) {
            :root {
                --sidebar-width: 0px;
            }
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
                width: 250px;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-brand">
                <img src="../assets/uploads/logo%20black.png" alt="Studio Argon">
            </div>

            <nav class="sidebar-menu">
                <div class="menu-label">Main</div>
                <a href="dashboard.php" class="menu-item <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                
                <div class="menu-label">Content</div>
                <a href="pages_list.php" class="menu-item <?php echo strpos(basename($_SERVER['PHP_SELF']), 'pages') !== false || strpos(basename($_SERVER['PHP_SELF']), 'home_manage') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-stack"></i> Pages
                </a>
                <a href="portfolio_list.php" class="menu-item <?php echo strpos(basename($_SERVER['PHP_SELF']), 'portfolio') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-grid-3x3-gap"></i> Projects
                </a>
                <a href="blog_list.php" class="menu-item <?php echo strpos(basename($_SERVER['PHP_SELF']), 'blog_list') !== false || (strpos(basename($_SERVER['PHP_SELF']), 'blog_edit') !== false && !strpos(basename($_SERVER['PHP_SELF']), 'categories')) ? 'active' : ''; ?>">
                    <i class="bi bi-journal-text"></i> Blog Posts
                </a>
                <a href="blog_categories.php" class="menu-item <?php echo strpos(basename($_SERVER['PHP_SELF']), 'blog_categories') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-tags"></i> Blog Categories
                </a>
                <a href="media_manage.php" class="menu-item <?php echo basename($_SERVER['PHP_SELF']) == 'media_manage.php' ? 'active' : ''; ?>">
                    <i class="bi bi-images"></i> Media Library
                </a>

                <div class="menu-label">Communication</div>
                <a href="messages_list.php" class="menu-item <?php echo strpos(basename($_SERVER['PHP_SELF']), 'messages') !== false ? 'active' : ''; ?>">
                    <i class="bi bi-envelope"></i> Inquiries
                </a>
                
                <div class="menu-label">System</div>
                <a href="users_list.php" class="menu-item <?php echo basename($_SERVER['PHP_SELF']) == 'users_list.php' ? 'active' : ''; ?>">
                    <i class="bi bi-people"></i> Administrators
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="admin-header">
                <div class="page-title" style="display: flex; align-items: center; gap: 1rem;">
                    <button id="sidebar-toggle" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: var(--text-primary); display: none;">
                        <i class="bi bi-list"></i>
                    </button>
                    <h1><?php echo $page_title ?? 'Dashboard'; ?></h1>
                </div>

                <div class="header-actions">
                    <div class="user-profile">
                        <div class="user-avatar"><?php echo substr($_SESSION['admin_name'], 0, 1); ?></div>
                        <div class="user-info">
                            <span class="user-name"><?php echo $_SESSION['admin_name']; ?></span>
                            <span class="user-role" style="text-transform: capitalize;"><?php echo $_SESSION['admin_role'] ?? 'Administrator'; ?></span>
                        </div>
                    </div>
                    <a href="logout.php" class="btn-logout" title="Logout">
                        <i class="bi bi-box-arrow-right"></i>
                    </a>
                </div>
            </header>
            
            <script>
                document.getElementById('sidebar-toggle').addEventListener('click', function() {
                    document.getElementById('sidebar').classList.toggle('active');
                });
            </script>
            <style>
                @media (max-width: 1024px) {
                    #sidebar-toggle {
                        display: block !important;
                    }
                }
            </style>
            
            <div class="content-area">
