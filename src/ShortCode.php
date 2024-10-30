<?php

namespace Chosify\Wordpress;

class ShortCode
{
    public function __construct()
    {
        add_action('init', [$this, 'initShortcode']);
    }

    public function initShortcode(): void
    {
        add_shortcode('chosify-widget', [$this, 'shortcode']);
    }

    public function shortcode($atts = [], $content = null, $tag = ''): string
    {
        // normalize attribute keys, lowercase
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );

        $flowId = $atts['flow-id'] ?? null;
        $variant = $atts['variant'] ?? null;

        if (!$flowId) {
            return '<div>'.__('Missing required parameter', 'chosify') .' <code>flow-id</code></div>';
        }

        $output = '<div data-chosify-flow-id="' . $flowId . '"';
        if ($variant ) {
            $output .= 'data-chosify-variant="' . $variant . '"';
        }
        $output .= '></div>';

        return $output;
    }
}