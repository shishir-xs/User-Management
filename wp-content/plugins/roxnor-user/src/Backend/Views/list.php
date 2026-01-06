<div class="wrap">
    <?php echo $message; ?>
    
    <h1 class="wp-heading-inline">Users</h1>
    <a href="<?php echo admin_url('admin.php?page=roxnor-user&action=create'); ?>" class="page-title-action">Add New</a>
    <hr class="wp-header-end">
    
    <div class="tablenav top">
        <div class="alignleft actions">
            <form method="GET" style="display: inline-flex; gap: 5px;">
                <input type="hidden" name="page" value="roxnor-user">
                <input type="hidden" name="action" value="list">
                <input type="search" name="search" value="<?php echo esc_attr($search); ?>" placeholder="Search users..." class="wp-filter-search">
                <input type="submit" class="button" value="Search Users">
                <?php if ($search): ?>
                    <a href="<?php echo admin_url('admin.php?page=roxnor-user&action=list'); ?>" class="button">Clear</a>
                <?php endif; ?>
            </form>
        </div>
        <br class="clear">
    </div>
    
    <?php if (empty($users)): ?>
        <div class="notice notice-info">
            <p>
                <?php if ($search): ?>
                    No users found matching "<?php echo esc_html($search); ?>". <a href="<?php echo admin_url('admin.php?page=roxnor-user&action=list'); ?>">View all users</a>
                <?php else: ?>
                    No users found. <a href="<?php echo admin_url('admin.php?page=roxnor-user&action=create'); ?>">Create your first user</a>.
                <?php endif; ?>
            </p>
        </div>
    <?php else: ?>
        <?php if ($search): ?>
            <div class="subsubsub">
                Found <?php echo count($users); ?> user(s) matching "<?php echo esc_html($search); ?>"
            </div>
        <?php endif; ?>
        
        <table class="wp-list-table widefat fixed striped table-view-list users">
            <thead>
                <tr>
                    <th scope="col" class="manage-column column-cb check-column">
                        <input type="checkbox" />
                    </th>
                    <th scope="col" class="manage-column column-username column-primary">Name</th>
                    <th scope="col" class="manage-column column-email">Email</th>
                    <th scope="col" class="manage-column column-phone">Phone</th>
                    <th scope="col" class="manage-column column-date">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <th scope="row" class="check-column">
                        <input type="checkbox" name="user[]" value="<?php echo $user->id; ?>" />
                    </th>
                    <td class="username column-username has-row-actions column-primary">
                        <strong><a href="<?php echo admin_url('admin.php?page=roxnor-user&action=show&id=' . $user->id); ?>"><?php echo esc_html($user->name); ?></a></strong>
                        <div class="row-actions">
                            <span class="view"><a href="<?php echo admin_url('admin.php?page=roxnor-user&action=show&id=' . $user->id); ?>">View</a> | </span>
                            <span class="edit"><a href="<?php echo admin_url('admin.php?page=roxnor-user&action=edit&id=' . $user->id); ?>">Edit</a> | </span>
                            <span class="delete"><a href="<?php echo wp_nonce_url(admin_url('admin-post.php?action=delete_user&id=' . $user->id), 'delete_user_' . $user->id, 'nonce'); ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a></span>
                        </div>
                        <button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button>
                    </td>
                    <td class="email column-email" data-colname="Email"><?php echo esc_html($user->email); ?></td>
                    <td class="phone column-phone" data-colname="Phone"><?php echo esc_html($user->phone ?: '—'); ?></td>
                    <td class="date column-date" data-colname="Date"><?php echo date('Y/m/d', strtotime($user->created_at)); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="tablenav bottom">
            <div class="alignleft actions">
                <p class="search-box">
                    Showing <?php echo count($users); ?> user(s)
                </p>
            </div>
        </div>
    <?php endif; ?>
</div>