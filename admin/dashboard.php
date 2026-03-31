<?php
$page_title = 'Dashboard';
require_once 'includes/header.php';
require_once '../includes/analytics_helper.php';

// Fetch GA4 Stats (7 days)
$ga_data = getGA4AnalyticsData('7daysAgo');
$ga_total_visitors = 0;
$ga_total_sessions = 0;
$ga_total_unique = 0;
$chart_labels = [];
$chart_sessions = [];
$chart_visitors = [];

if ($ga_data && isset($ga_data['rows'])) {
    foreach ($ga_data['rows'] as $row) {
        $ga_total_sessions += (int)$row['metricValues'][0]['value'];
        $ga_total_visitors += (int)$row['metricValues'][1]['value'];
        $ga_total_unique += (int)$row['metricValues'][2]['value'];
        
        $date_raw = $row['dimensionValues'][0]['value'];
        $chart_labels[] = date('D', strtotime($date_raw));
        $chart_sessions[] = (int)$row['metricValues'][0]['value'];
        $chart_visitors[] = (int)$row['metricValues'][1]['value'];
    }
}

// Fetch stats
$total_projects = $pdo->query("SELECT COUNT(*) FROM portfolio")->fetchColumn();
$total_blog_posts = $pdo->query("SELECT COUNT(*) FROM blog_posts")->fetchColumn();
$total_inquiries = $pdo->query("SELECT COUNT(*) FROM contact_messages")->fetchColumn();
// Restore missing dashboard queries
$recent_projects = $pdo->query("SELECT * FROM portfolio ORDER BY created_at DESC LIMIT 5")->fetchAll();
$recent_blog = $pdo->query("SELECT * FROM blog_posts ORDER BY created_at DESC LIMIT 5")->fetchAll();
?>

<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    .stat-card {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 2rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 20px rgba(0,0,0,0.02);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        border-color: var(--accent);
        box-shadow: 0 10px 30px rgba(225, 29, 72, 0.08);
    }

    .stat-icon {
        width: 65px;
        height: 65px;
        background: #FFF1F2;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        font-size: 1.6rem;
        box-shadow: 0 4px 10px rgba(225, 29, 72, 0.1);
    }

    .stat-details h3 {
        font-size: 2.2rem;
        font-weight: 800;
        margin-bottom: 0.2rem;
        line-height: 1;
        color: var(--text-primary);
    }

    .stat-details p {
        color: var(--text-secondary);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-weight: 700;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }

    .activity-list {
        list-style: none;
    }

    .activity-item {
        display: flex;
        align-items: flex-start;
        gap: 1.2rem;
        padding: 1.5rem 0;
        border-bottom: 1px solid var(--border);
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: #F1F5F9;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        flex-shrink: 0;
        color: var(--text-secondary);
    }

    .activity-body p {
        font-size: 0.95rem;
        margin-bottom: 0.4rem;
        font-weight: 600;
    }

    .activity-time {
        font-size: 0.8rem;
        color: var(--text-secondary);
    }

    @media (max-width: 1200px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background: #e0f2fe; color: #0ea5e9;"><i class="bi bi-people"></i></div>
        <div class="stat-details">
            <h3 id="stat-visitors"><?php echo number_format($ga_total_visitors); ?></h3>
            <p>Total Visitors</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: #f0fdf4; color: #22c55e;"><i class="bi bi-clock-history"></i></div>
        <div class="stat-details">
            <h3 id="stat-sessions"><?php echo number_format($ga_total_sessions); ?></h3>
            <p>Total Sessions</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: #faf5ff; color: #a855f7;"><i class="bi bi-person-check"></i></div>
        <div class="stat-details">
            <h3 id="stat-unique"><?php echo number_format($ga_total_unique); ?></h3>
            <p>Unique Users</p>
        </div>
    </div>
</div>

<!-- Analytics Chart Section -->
<div class="card" style="margin-bottom: 2.5rem; padding: 2rem;">
    <div class="card-header" style="padding: 0; margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h2 class="card-title" style="font-size: 1.2rem; margin-bottom: 0.5rem;">Website Traffic Overview</h2>
            <p style="color: var(--text-secondary); font-size: 0.85rem;">Google Analytics Real-time data sync</p>
        </div>
        <div style="display: flex; gap: 10px;">
            <select class="form-control" style="width: auto; padding: 5px 15px; font-size: 0.8rem;">
                <option>Last 7 Days</option>
                <option>Last 30 Days</option>
                <option>This Month</option>
            </select>
        </div>
    </div>
    <div style="height: 350px; width: 100%; position: relative;">
        <canvas id="trafficChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('trafficChart').getContext('2d');
        
        // Dynamic data from Google Analytics API
        const labels = <?php echo json_encode($chart_labels ?: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']); ?>;
        const visitors = <?php echo json_encode($chart_visitors ?: [0,0,0,0,0,0,0]); ?>;
        const sessions = <?php echo json_encode($chart_sessions ?: [0,0,0,0,0,0,0]); ?>;

        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(225, 29, 72, 0.2)');
        gradient.addColorStop(1, 'rgba(225, 29, 72, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Sessions',
                        data: sessions,
                        borderColor: '#e11d48',
                        backgroundColor: gradient,
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3,
                        pointRadius: 4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#e11d48',
                        pointBorderWidth: 2
                    },
                    {
                        label: 'Visitors',
                        data: visitors,
                        borderColor: '#334155',
                        borderDash: [5, 5],
                        fill: false,
                        tension: 0.4,
                        borderWidth: 2,
                        pointRadius: 0
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        align: 'end',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: { size: 12, weight: '600' }
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: '#fff',
                        titleColor: '#000',
                        bodyColor: '#64748b',
                        borderColor: '#e2e8f0',
                        borderWidth: 1,
                        padding: 12,
                        boxPadding: 6,
                        usePointStyle: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [5, 5], color: '#e2e8f0' },
                        ticks: { font: { size: 11 }, padding: 10 }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 11 }, padding: 10 }
                    }
                }
            }
        });
    });
</script>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon"><i class="bi bi-envelope"></i></div>
        <div class="stat-details">
            <h3><?php echo $total_inquiries; ?></h3>
            <p>New Inquiries</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon"><i class="bi bi-grid-3x3-gap"></i></div>
        <div class="stat-details">
            <h3><?php echo $total_projects; ?></h3>
            <p>Total Projects</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon"><i class="bi bi-journal-text"></i></div>
        <div class="stat-details">
            <h3><?php echo $total_blog_posts; ?></h3>
            <p>Blog Posts</p>
        </div>
    </div>
</div>

<div class="dashboard-grid">
    <!-- Recent Projects -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Recent Portfolio Projects</h2>
            <a href="portfolio_list.php" class="btn btn-outline btn-sm">View All</a>
        </div>
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th width="80">Image</th>
                        <th>Project Title</th>
                        <th>Category</th>
                        <th>Added On</th>
                        <th width="100">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($recent_projects)): ?>
                        <tr><td colspan="5" align="center">No projects found.</td></tr>
                    <?php else: ?>
                        <?php foreach($recent_projects as $project): ?>
                        <tr>
                            <td>
                                <img src="../<?php echo $project['image']; ?>" class="table-img" alt="" onerror="this.src='https://placehold.co/100x100?text=No+Image'">
                            </td>
                            <td><strong><?php echo $project['title']; ?></strong></td>
                            <td><span class="badge badge-accent"><?php echo $project['category']; ?></span></td>
                            <td><?php echo date('M d, Y', strtotime($project['created_at'])); ?></td>
                            <td>
                                <div class="actions-cell">
                                    <a href="portfolio_edit.php?id=<?php echo $project['id']; ?>" class="btn btn-outline btn-sm" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Activity / Recent Blog -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Recent Blog</h2>
            <a href="blog_list.php" class="btn btn-outline btn-sm">View All</a>
        </div>
        
        <ul class="activity-list">
            <?php if (empty($recent_blog)): ?>
                <li class="activity-item">No blog posts found.</li>
            <?php else: ?>
                <?php foreach($recent_blog as $post): ?>
                <li class="activity-item">
                    <div class="activity-icon"><i class="bi bi-file-text"></i></div>
                    <div class="activity-body">
                        <p><strong><?php echo $post['title']; ?></strong></p>
                        <span class="badge badge-accent" style="margin-bottom: 5px; display: inline-block; font-size: 0.6rem;"><?php echo $post['tag']; ?></span>
                        <div class="activity-time"><?php echo $post['date']; ?></div>
                    </div>
                </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
        
        <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--border);">
            <div class="card-header" style="margin-bottom: 1rem; padding: 0;">
                <h2 class="card-title" style="font-size: 0.9rem;">Quick Add</h2>
            </div>
            <div style="display: flex; gap: 0.8rem; flex-wrap: wrap;">
                <a href="portfolio_add.php" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.8rem;"><i class="bi bi-plus-lg"></i> New Project</a>
                <a href="blog_add.php" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.8rem;"><i class="bi bi-plus-lg"></i> New Blog</a>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
