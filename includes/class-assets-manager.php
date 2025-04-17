<?php
/**
 * Assets Manager Class.
 *
 * @package GutenbergCustomBlocks
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class GCB_Assets_Manager
 */
class GCB_Assets_Manager {

    /**
     * Initialize the class.
     */
    public function init() {
        add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_editor_assets' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_assets' ) );
        add_action( 'enqueue_block_assets', array( $this, 'enqueue_block_styles' ) );
    }

    /**
     * Enqueue editor assets.
     */
    public function enqueue_editor_assets() {
        // Editor script.
        wp_enqueue_script(
            'gcb-editor-script',
            GCB_PLUGIN_URL . 'assets/js/blocks/index.js',
            array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components' ),
            GCB_VERSION,
            true
        );

        // Add translations.
        if ( function_exists( 'wp_set_script_translations' ) ) {
            wp_set_script_translations( 'gcb-editor-script', 'gutenberg-custom-blocks', GCB_PLUGIN_DIR . 'languages' );
        }

        // Font Awesome pour les icônes
        wp_enqueue_style(
            'font-awesome',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css',
            array(),
            '5.15.4'
        );

        // Enqueue Tailwind CSS avec une priorité plus élevée
        wp_enqueue_style(
            'gcb-tailwind-styles',
            'https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css',
            array(),
            '2.2.19'
        );

        // Enqueue editor styles en dernier pour surcharger si nécessaire
        wp_enqueue_style(
            'gcb-editor-styles',
            GCB_PLUGIN_URL . 'assets/css/editor.css',
            array( 'wp-edit-blocks', 'gcb-tailwind-styles' ),
            GCB_VERSION
        );
        
        // Enqueue les styles spécifiques pour chaque bloc
        $this->enqueue_block_editor_styles();
    }
    
    /**
     * Enqueue les styles spécifiques pour chaque bloc dans l'éditeur
     */
    private function enqueue_block_editor_styles() {
        $blocks = array(
            'hero-section',
            'why-choose-us',
            'digital-agency',
            'increase-traffic',
            'best-solutions',
            'pricing-plans',
            'testimonials-section',
            'contact-form',
            'fast-agency',
        );
        
        foreach ($blocks as $block) {
            $style_url = GCB_PLUGIN_URL . 'assets/js/blocks/' . $block . '/editor.css';
            $style_file_path = GCB_PLUGIN_DIR . 'assets/js/blocks/' . $block . '/editor.css';
            
            if (file_exists($style_file_path)) {
                wp_enqueue_style(
                    'gcb-' . $block . '-editor-style',
                    $style_url,
                    array('gcb-editor-styles'),
                    GCB_VERSION
                );
            }
        }
    }

    /**
     * Enqueue block assets for both frontend & backend.
     */
    public function enqueue_block_styles() {
        // Ces styles sont chargés à la fois dans l'éditeur et sur le frontend
    }

    /**
     * Enqueue frontend assets.
     */
    public function enqueue_frontend_assets() {
        // Skip admin.
        if ( is_admin() ) {
            return;
        }

        // Font Awesome pour les icônes
        wp_enqueue_style(
            'font-awesome',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css',
            array(),
            '5.15.4'
        );

        // Enqueue Tailwind CSS
        wp_enqueue_style(
            'gcb-tailwind-styles',
            'https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css',
            array(),
            '2.2.19'
        );
        
        // Enqueue animations CSS
        wp_enqueue_style( 
            'gcb-frontend-animations',
            GCB_PLUGIN_URL . 'assets/css/frontend.css',
            array( 'gcb-tailwind-styles' ),
            GCB_VERSION
        );
    }
}
