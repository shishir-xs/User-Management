<div class="wrap">
    <h1 class="wp-heading-inline">User Management Dashboard</h1>
    <a href="<?php echo admin_url('admin.php?page=roxnor-user&action=create'); ?>" class="page-title-action">Add New</a>
    <hr class="wp-header-end">

    <div class="welcome-panel">
        <div class="welcome-panel-content">
            <h2>Welcome to User Management</h2>
            <p class="about-description">Manage your users efficiently with our comprehensive user management system.</p>
            <div class="welcome-panel-column-container">
                <div class="welcome-panel-column">
                    <h3>Get Started</h3>
                    <a class="button button-primary button-hero" href="<?php echo admin_url('admin.php?page=roxnor-user&action=create'); ?>">Add Your First User</a>
                    <p>or, <a href="<?php echo admin_url('admin.php?page=roxnor-user&action=list'); ?>">view all users</a></p>
                </div>
                <div class="welcome-panel-column">
                    <h3>Quick Actions</h3>
                    <ul>
                        <li><a href="<?php echo admin_url('admin.php?page=roxnor-user&action=list'); ?>" class="welcome-icon-view-site">View All Users</a></li>
                        <li><a href="<?php echo admin_url('admin.php?page=roxnor-import-export'); ?>" class="welcome-icon-customize">Import/Export Data</a></li>
                    </ul>
                </div>
                <div class="welcome-panel-column welcome-panel-last">
                    <h3>Statistics</h3>
                    <ul>
                        <li><strong><?php echo $total_users; ?></strong> Total Users</li>
                        <li><strong><?php echo count($recent_users); ?></strong> Recent Users</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($recent_users)): ?>
    <div class="postbox">
        <div class="postbox-header">
            <h2 class="hndle">Recent Users</h2>
        </div>
        <div class="inside">
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date Added</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recent_users as $user): ?>
                    <tr>
                        <td><strong><?php echo esc_html($user->name); ?></strong></td>
                        <td><?php echo esc_html($user->email); ?></td>
                        <td><?php echo esc_html($user->phone ?: '—'); ?></td>
                        <td><?php echo date('Y/m/d', strtotime($user->created_at)); ?></td>
                        <td>
                            <a href="<?php echo admin_url('admin.php?page=roxnor-user&action=show&id=' . $user->id); ?>" class="button button-small">View</a>
                            <a href="<?php echo admin_url('admin.php?page=roxnor-user&action=edit&id=' . $user->id); ?>" class="button button-small">Edit</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>
</div>