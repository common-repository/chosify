<?php
/**
 * Plugin Name: Chosify
 * Description: Integrate Chosify into your WordPress website.
 * Requires PHP: 7.3
 * Requires at least: 5.8
 * Version: 1.0.12
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Author: Chosify, Jesse Hendriks
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if (! file_exists($composer = __DIR__.'/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'chosify'));
}

require $composer;

use Chosify\Wordpress\Scripts;
use Chosify\Wordpress\ShortCode;
use Chosify\Wordpress\WooCommerce;

new Scripts();
new ShortCode();
new WooCommerce();
