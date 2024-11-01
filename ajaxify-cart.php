<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wordpress.org/plugins/ajaxify-cart
 * @since             1.0.0
 * @package           ajaxify-cart
 *
 * @wordpress-plugin
 * Plugin Name:       Ajaxify Cart
 * Plugin URI:        https://wordpress.org/plugins/ajaxify-cart
 * Description:       Ajaxify Cart is a plugin that allows you to transform the default behavior of the WooCommerce Add to Cart button to make it ajax instead of sending all the form.
 * Version:           1.0.2
 * Author:            Abderrahmane Oulmderat
 * Author URI:        https://profiles.wordpress.org/aoulmderat/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ajaxify-cart
 * Domain Path:       /languages
 * WC requires at least: 3.0
 * WC tested up to: 4.3.0
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('AJAXIFY_CART_VERSION', '1.0.2');

/**
 * Currently plugin name.
 */
define('AJAXIFY_CART_NAME', 'ajaxify-cart');

/* Custom styles and scripts go here */
function ajaxify_cart_scripts()
{
    $js_modified = filemtime(plugin_dir_path(__FILE__) . 'js/ajaxify-cart.js');
    wp_enqueue_script('ajaxify-cart-script', plugin_dir_url(__FILE__) . 'js/ajaxify-cart.js', array('jquery'), $js_modified, true);
}

add_action('wp_enqueue_scripts', 'ajaxify_cart_scripts', 12);
