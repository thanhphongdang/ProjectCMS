/**
 * ShopCar Header Customizer Preview
 * Live preview cho các thay đổi header trong Customizer
 */
(function($) {
    'use strict';

    // Preview Top Bar Background Color
    wp.customize('header_top_bar_bg', function(value) {
        value.bind(function(newColor) {
            $('.header-top-bar').css('background-color', newColor);
        });
    });

    // Preview Header Background Color
    wp.customize('header_bg_color', function(value) {
        value.bind(function(newColor) {
            $('.header.axil-header').css('background-color', newColor);
            $('.header.axil-header.sticky').css('background-color', newColor);
        });
    });

    // Preview Top Bar Phone
    wp.customize('header_top_bar_phone', function(value) {
        value.bind(function(newPhone) {
            var phoneLink = newPhone.replace(/[^0-9+]/g, '');
            $('.header-top-bar-left a[href^="tel:"]').attr('href', 'tel:' + phoneLink);
            $('.header-top-bar-left a[href^="tel:"] span').text('Hotline: ' + newPhone);
        });
    });

    // Preview Top Bar Email
    wp.customize('header_top_bar_email', function(value) {
        value.bind(function(newEmail) {
            $('.header-top-bar-left a[href^="mailto:"]').attr('href', 'mailto:' + newEmail);
            $('.header-top-bar-left a[href^="mailto:"] span').text(newEmail);
        });
    });

    // Preview Top Bar Enable/Disable
    wp.customize('header_top_bar_enable', function(value) {
        value.bind(function(isEnabled) {
            if (isEnabled) {
                $('.header-top-bar').show();
            } else {
                $('.header-top-bar').hide();
            }
        });
    });

    // Preview Top Bar Text Color
    wp.customize('header_top_bar_text_color', function(value) {
        value.bind(function(newColor) {
            $('.header-top-bar').css('color', newColor);
            $('.header-top-bar-left a, .header-top-bar-right a').css('color', newColor);
        });
    });

    // Preview Menu Text Color
    wp.customize('header_menu_text_color', function(value) {
        value.bind(function(newColor) {
            $('.header-nav .mainmenu li a').css('color', newColor);
        });
    });

    // Preview Menu Hover Color
    wp.customize('header_menu_hover_color', function(value) {
        value.bind(function(newColor) {
            $('.header-nav .mainmenu li a:hover').css('color', newColor);
        });
    });

    // Preview Menu Hover Background
    wp.customize('header_menu_hover_bg', function(value) {
        value.bind(function(newColor) {
            $('.header-nav .mainmenu li a:hover').css('background', newColor);
        });
    });

    // Preview Menu Font Size
    wp.customize('header_menu_font_size', function(value) {
        value.bind(function(newSize) {
            $('.header-nav .mainmenu li a').css('font-size', newSize + 'px');
        });
    });

    // Preview Search Placeholder
    wp.customize('header_search_placeholder', function(value) {
        value.bind(function(newPlaceholder) {
            $('.header-search-box input[type="search"]').attr('placeholder', newPlaceholder);
        });
    });

    // Preview Search Button Color
    wp.customize('header_search_button_color', function(value) {
        value.bind(function(newColor) {
            $('.header-search-box button').css('background', newColor);
        });
    });

    // Preview Cart Badge Color
    wp.customize('header_cart_badge_color', function(value) {
        value.bind(function(newColor) {
            $('.cart-count').css('background', newColor);
        });
    });

    // Preview Action Icons Color
    wp.customize('header_action_icons_color', function(value) {
        value.bind(function(newColor) {
            $('.action-list li a').css('color', newColor);
        });
    });

    // Preview Header Padding Top
    wp.customize('header_padding_top', function(value) {
        value.bind(function(newPadding) {
            $('.header.axil-header').css('padding-top', newPadding + 'px');
        });
    });

    // Preview Header Padding Bottom
    wp.customize('header_padding_bottom', function(value) {
        value.bind(function(newPadding) {
            $('.header.axil-header').css('padding-bottom', newPadding + 'px');
        });
    });

    // Preview Logo Height
    wp.customize('header_logo_height', function(value) {
        value.bind(function(newHeight) {
            $('.header-logo img').css('height', newHeight + 'px');
        });
    });

    // === FOOTER PREVIEWS ===
    wp.customize('footer_bg_color', function(value) {
        value.bind(function(newColor) {
            $('.axil-footer-area').css('background-color', newColor);
        });
    });

    wp.customize('footer_text_color', function(value) {
        value.bind(function(newColor) {
            $('.axil-footer-area').css('color', newColor);
            $('.axil-footer-area a').css('color', newColor);
        });
    });

    wp.customize('footer_address', function(value) {
        value.bind(function(newAddress) {
            $('.footer-address').text(newAddress);
        });
    });

    wp.customize('footer_email', function(value) {
        value.bind(function(newEmail) {
            $('.footer-email').attr('href', 'mailto:' + newEmail).text(newEmail);
        });
    });

    wp.customize('footer_phone', function(value) {
        value.bind(function(newPhone) {
            var phoneLink = newPhone.replace(/[^0-9+]/g, '');
            $('.footer-phone').attr('href', 'tel:' + phoneLink).text(newPhone);
        });
    });

    wp.customize('footer_copyright', function(value) {
        value.bind(function(newText) {
            $('.footer-copyright').text(newText);
        });
    });

    // === HOMEPAGE PREVIEWS ===
    wp.customize('homepage_slider_title', function(value) {
        value.bind(function(newTitle) {
            $('.main-slider-content .title').text(newTitle);
        });
    });

    wp.customize('homepage_slider_subtitle', function(value) {
        value.bind(function(newSubtitle) {
            $('.main-slider-content .subtitle').text(newSubtitle);
        });
    });

    wp.customize('homepage_slider_button_text', function(value) {
        value.bind(function(newText) {
            $('.main-slider-content .axil-btn').text(newText);
        });
    });

    wp.customize('homepage_categories_title', function(value) {
        value.bind(function(newTitle) {
            $('.axil-categorie-area .title').text(newTitle);
        });
    });

    wp.customize('homepage_products_title', function(value) {
        value.bind(function(newTitle) {
            $('.axil-product-area .title').text(newTitle);
        });
    });

    wp.customize('homepage_newsletter_title', function(value) {
        value.bind(function(newTitle) {
            $('.newsletter-content .title').text(newTitle);
        });
    });

    wp.customize('homepage_newsletter_placeholder', function(value) {
        value.bind(function(newPlaceholder) {
            $('.newsletter-input').attr('placeholder', newPlaceholder);
        });
    });

    // === COLOR SCHEME PREVIEWS ===
    wp.customize('color_primary', function(value) {
        value.bind(function(newColor) {
            $('body').css('--color-primary', newColor);
            $('.axil-btn.btn-primary').css('background-color', newColor);
        });
    });

    wp.customize('color_secondary', function(value) {
        value.bind(function(newColor) {
            $('body').css('--color-secondary', newColor);
        });
    });

    wp.customize('color_accent', function(value) {
        value.bind(function(newColor) {
            $('body').css('--color-accent', newColor);
        });
    });

    wp.customize('color_text', function(value) {
        value.bind(function(newColor) {
            $('body').css('color', newColor);
        });
    });

    wp.customize('color_background', function(value) {
        value.bind(function(newColor) {
            $('body').css('background-color', newColor);
        });
    });

    // === TYPOGRAPHY PREVIEWS ===
    wp.customize('typography_body_size', function(value) {
        value.bind(function(newSize) {
            $('body').css('font-size', newSize + 'px');
        });
    });

    wp.customize('typography_heading_size', function(value) {
        value.bind(function(newSize) {
            $('h1, h2, h3, h4, h5, h6').css('font-size', newSize + 'px');
        });
    });

    wp.customize('typography_font_family', function(value) {
        value.bind(function(newFont) {
            $('body').css('font-family', newFont);
        });
    });

})(jQuery);

