// Modern User Management JavaScript
(function($) {
    'use strict';

    // Initialize when document is ready
    $(document).ready(function() {
        initUserManagement();
    });

    function initUserManagement() {
        // Add loading states to buttons
        $('.roxnor-btn').on('click', function() {
            const $btn = $(this);
            if (!$btn.hasClass('roxnor-btn-danger')) {
                $btn.addClass('loading').prop('disabled', true);
                setTimeout(() => {
                    $btn.removeClass('loading').prop('disabled', false);
                }, 2000);
            }
        });

        // Smooth delete confirmation
        $('.roxnor-action-delete').on('click', function(e) {
            e.preventDefault();
            const $link = $(this);
            const userName = $link.closest('tr').find('.user-name').text();
            
            if (confirm(`Are you sure you want to delete "${userName}"? This action cannot be undone.`)) {
                window.location.href = $link.attr('href');
            }
        });

        // Auto-hide notifications
        $('.roxnor-notification').each(function() {
            const $notification = $(this);
            setTimeout(() => {
                $notification.fadeOut(300);
            }, 5000);
        });

        // Form validation
        $('.roxnor-form-input[required]').on('blur', function() {
            const $input = $(this);
            if (!$input.val().trim()) {
                $input.addClass('error');
            } else {
                $input.removeClass('error');
            }
        });

        // Search functionality
        $('#user-search').on('keyup', function() {
            const searchTerm = $(this).val().toLowerCase();
            $('.roxnor-table tbody tr').each(function() {
                const $row = $(this);
                const text = $row.text().toLowerCase();
                $row.toggle(text.includes(searchTerm));
            });
        });
    }

})(jQuery);