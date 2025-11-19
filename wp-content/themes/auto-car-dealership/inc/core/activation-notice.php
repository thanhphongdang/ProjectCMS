<?php
// Show the notice only once after theme activation
global $pagenow;
if ( is_admin() && 'themes.php' === $pagenow && isset( $_GET['activated'] ) ) {
    add_action( 'admin_notices', function () {
        ?>
        <div class="notice notice-success is-dismissible welcome-notice">
            <div class="notice-row">
                <div class="notice-text">
                    <p class="welcome-text1"><?php esc_html_e( '🎉 Welcome to VW Themes,', 'auto-car-dealership' ); ?></p>
                    <p class="welcome-text2"><?php esc_html_e( 'You are now using the Auto Car Dealership, a beautifully designed theme to kickstart your website.', 'auto-car-dealership' ); ?></p>
                    <p class="welcome-text3"><?php esc_html_e( 'To help you get started quickly, use the options below:', 'auto-car-dealership' ); ?></p>

                    <span class="import-btn">
                        <a href="javascript:void(0);" id="install-activate-button" class="button admin-button info-button">
                           <?php echo __('GET STARTED', 'auto-car-dealership'); ?>
                        </a>
                        <script type="text/javascript">
                            document.getElementById('install-activate-button').addEventListener('click', function () {
                                const auto_car_dealership_button = this;
                                const auto_car_dealership_redirectUrl = '<?php echo esc_url(admin_url("themes.php?page=auto-car-dealership-info")); ?>';
                                // First, check if plugin is already active
                                jQuery.post(ajaxurl, { action: 'check_plugin_activation' }, function (response) {
                                    if (response.success && response.data.active) {
                                        // Plugin already active — just redirect
                                        window.location.href = auto_car_dealership_redirectUrl;
                                    } else {
                                        // Show Installing & Activating only if not already active
                                        auto_car_dealership_button.textContent = 'Installing & Activating...';

                                        jQuery.post(ajaxurl, {
                                            action: 'install_and_activate_required_plugin',
                                            nonce: '<?php echo wp_create_nonce("install_activate_nonce"); ?>'
                                        }, function (response) {
                                            if (response.success) {
                                                window.location.href = auto_car_dealership_redirectUrl;
                                            } else {
                                                alert('Failed to activate the plugin.');
                                                auto_car_dealership_button.textContent = 'Try Again';
                                            }
                                        });
                                    }
                                });
                            });
                        </script>
                    </span>

                    <span class="demo-btn">
                        <a href="https://www.vwthemes.net/auto-car-dealership/" class="button button-primary" target="_blank">
                            <?php esc_html_e( 'VIEW DEMO', 'auto-car-dealership' ); ?>
                        </a>
                    </span>

                    <span class="upgrade-btn">
                        <a href="https://www.vwthemes.com/products/car-wordpress-theme" class="button button-primary" target="_blank">
                            <?php esc_html_e( 'UPGRADE TO PRO', 'auto-car-dealership' ); ?>
                        </a>
                    </span>

                    <span class="bundle-btn">
                        <a href="https://www.vwthemes.com/products/wp-theme-bundle" class="button button-primary" target="_blank">
                            <?php esc_html_e( 'BUNDLE OF 350+ THEMES', 'auto-car-dealership' ); ?>
                        </a>
                    </span>
                </div>

                <div class="notice-img1">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/images/arrow-notice.png' ); ?>" width="180" alt="<?php esc_attr_e( 'Auto Car Dealership', 'auto-car-dealership' ); ?>" />
                </div>

                <div class="notice-img2">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/images/bundle-notice.png' ); ?>" width="180" alt="<?php esc_attr_e( 'Auto Car Dealership', 'auto-car-dealership' ); ?>" />
                </div>
            </div>
        </div>
        <?php
    });
}
