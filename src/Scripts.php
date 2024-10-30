<?php

namespace Chosify\Wordpress;

class Scripts
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'registerScript']);
    }

    public function registerScript()
    {
        global $wp_version;

        // If >= 6.3, re-use wrapper function signature.
        if (version_compare($wp_version, '6.3', '>=')) {
            wp_register_script(
                'chosify-script',
                'https://integration.chosify.com/assets/index.js',
                [],
                false,
            );
        } else {
            // Extract in_footer value for older version usage.
            wp_register_script(
                'chosify-script',
                'https://integration.chosify.com/assets/index.js',
                [],
                false,
            );
        }

        wp_enqueue_script('chosify-script');
    }
}