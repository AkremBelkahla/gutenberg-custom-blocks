<?php
/**
 * Plugin Name: Gutenberg Custom Blocks
 * Plugin URI: https://infinityweb.tn/gutenberg
 * Description: Custom Gutenberg blocks for WordPress editor
 * Version: 1.0.0
 * Author: Akrem Belkahla
 * Author URI: https://infinityweb.tn/
 * Text Domain: gutenberg-custom-blocks
 * Domain Path: /languages
 * Requires at least: 6.0
 * Requires PHP: 7.4
 *
 * @package GutenbergCustomBlocks
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define plugin constants.
define( 'GCB_VERSION', '1.0.0' );
define( 'GCB_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'GCB_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'GCB_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

// Include required files.
require_once GCB_PLUGIN_DIR . 'includes/class-blocks-loader.php';
require_once GCB_PLUGIN_DIR . 'includes/class-assets-manager.php';

/**
 * Initialize the plugin.
 *
 * @return void
 */
function gcb_init() {
    // Load text domain for internationalization.
    load_plugin_textdomain( 'gutenberg-custom-blocks', false, dirname( GCB_PLUGIN_BASENAME ) . '/languages' );
    
    // Initialize blocks.
    $blocks_loader = new GCB_Blocks_Loader();
    $blocks_loader->init();
    
    // Initialize assets.
    $assets_manager = new GCB_Assets_Manager();
    $assets_manager->init();
}
add_action( 'plugins_loaded', 'gcb_init' );

/**
 * Register activation hook.
 */
function gcb_activate() {
    // Activation tasks if needed.
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'gcb_activate' );

/**
 * Register deactivation hook.
 */
function gcb_deactivate() {
    // Deactivation tasks if needed.
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'gcb_deactivate' );
