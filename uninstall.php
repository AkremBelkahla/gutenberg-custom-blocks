<?php
/**
 * Uninstall file for Gutenberg Custom Blocks.
 *
 * @package GutenbergCustomBlocks
 */

// Exit if accessed directly.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

// Perform uninstall actions here.
// For example, delete plugin options.
delete_option( 'gcb_settings' );
