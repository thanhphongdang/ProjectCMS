jQuery(document).ready(function ($) {
    // Attach click event to the dismiss button
    $(document).on('click', '.notice[data-notice="get-start"] button.notice-dismiss', function () {
        // Dismiss the notice via AJAX
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'auto_car_dealership_dismissed_notice',
            },
            success: function () {
                // Remove the notice on success
                $('.notice[data-notice="example"]').remove();
            }
        });
    });
});

// Plugin – AI Content Writer plugin activation
document.addEventListener('DOMContentLoaded', function () {
    const auto_car_dealership_button = document.getElementById('install-activate-button');

    if (!auto_car_dealership_button) return;

    auto_car_dealership_button.addEventListener('click', function (e) {
        e.preventDefault();

        const auto_car_dealership_redirectUrl = auto_car_dealership_button.getAttribute('data-redirect');

        // Step 1: Check if plugin is already active
        const auto_car_dealership_checkData = new FormData();
        auto_car_dealership_checkData.append('action', 'check_plugin_activation');

        fetch(installPluginData.ajaxurl, {
            method: 'POST',
            body: auto_car_dealership_checkData,
        })
        .then(res => res.json())
        .then(res => {
            if (res.success && res.data.active) {
                // Plugin is already active → just redirect
                window.location.href = auto_car_dealership_redirectUrl;
            } else {
                // Not active → proceed with install + activate
                auto_car_dealership_button.textContent = 'Installing & Activating...';

                const auto_car_dealership_installData = new FormData();
                auto_car_dealership_installData.append('action', 'install_and_activate_required_plugin');
                auto_car_dealership_installData.append('_ajax_nonce', installPluginData.nonce);

                fetch(installPluginData.ajaxurl, {
                    method: 'POST',
                    body: auto_car_dealership_installData,
                })
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        window.location.href = auto_car_dealership_redirectUrl;
                    } else {
                        alert('Activation error: ' + (res.data?.message || 'Unknown error'));
                        auto_car_dealership_button.textContent = 'Try Again';
                    }
                })
                .catch(error => {
                    alert('Request failed: ' + error.message);
                    auto_car_dealership_button.textContent = 'Try Again';
                });
            }
        })
        .catch(error => {
            alert('Check request failed: ' + error.message);
        });
    });
});
