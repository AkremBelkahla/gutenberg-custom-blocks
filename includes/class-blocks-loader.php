<?php
/**
 * Blocks Loader Class.
 *
 * @package GutenbergCustomBlocks
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class GCB_Blocks_Loader
 */
class GCB_Blocks_Loader {

    /**
     * Available blocks.
     *
     * @var array
     */
    private $blocks = array(
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

    /**
     * Initialize the class.
     */
    public function init() {
        add_action( 'init', array( $this, 'register_blocks' ) );
        add_filter( 'block_categories_all', array( $this, 'register_block_categories' ), 10, 1 );
        add_filter( 'acf/blocks/preview/allow_tabs', '__return_true' );
        add_filter( 'acf/blocks/preview/allow_block_modes', '__return_true' );
    }

    /**
     * Register custom block categories.
     *
     * @param array $categories Block categories.
     * @return array Modified block categories.
     */
    public function register_block_categories( $categories ) {
        return array_merge(
            array(
                array(
                    'slug'  => 'gcb',
                    'title' => __( 'Pilot\'in : Landing Page Blocks', 'gutenberg-custom-blocks' ),
                    'icon'  => 'layout',
                ),
            ),
            $categories
        );
    }

    /**
     * Register all blocks.
     */
    public function register_blocks() {
        // Check if Gutenberg is active.
        if ( ! function_exists( 'register_block_type' ) ) {
            return;
        }

        // Vérifier si ACF PRO est activé
        if ( ! function_exists( 'acf_register_block_type' ) ) {
            return;
        }

        foreach ( $this->blocks as $block ) {
            $this->register_single_block( $block );
        }
    }

    /**
     * Register a single block.
     *
     * @param string $block_name Block name.
     */
    private function register_single_block( $block_name ) {
        $block_path = GCB_PLUGIN_DIR . 'includes/blocks/' . $block_name;
        
        // Skip if block directory doesn't exist.
        if ( ! file_exists( $block_path ) ) {
            return;
        }

        // Convertir le nom du bloc en format titre
        $block_title = str_replace('-', ' ', $block_name);
        $block_title = ucwords($block_title);
        $block_title = "Pilot'in : " . $block_title;
        
        // Définir les exemples et aperçus pour chaque bloc
        $example_data = $this->get_block_example_data($block_name);

        // Register block with ACF
        acf_register_block_type(array(
            'name'              => 'acf/' . $block_name,
            'title'            => $block_title,
            'description'      => __( 'Un bloc personnalisé pour la landing page.', 'gutenberg-custom-blocks' ),
            'render_template'  => 'includes/blocks/' . $block_name . '/render.php',
            'category'         => 'gcb',
            'icon'             => $this->get_block_icon($block_name),
            'keywords'         => array( 'landing', 'page', 'pilotin', $block_name ),
            'supports'         => array(
                'align' => array( 'wide', 'full' ),
                'mode'  => true,
                'jsx'   => true,
                'anchor' => true,
                'color' => array(
                    'background' => true,
                    'text' => true
                )
            ),
            'example'          => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => $example_data
                )
            ),
            //'enqueue_style'    => GCB_PLUGIN_URL . 'assets/css/blocks.css',
            'enqueue_assets'   => function() {
                wp_enqueue_style('dashicons');
            },
            'render_callback'  => function($block, $content = '', $is_preview = false) use ($block_name, $example_data) {
                // Inclure le fichier de rendu
                include GCB_PLUGIN_DIR . 'includes/blocks/' . $block_name . '/render.php';
            }
        ));
    }
    
    /**
     * Get block icon.
     *
     * @param string $block_name Block name.
     * @return string Block icon.
     */
    private function get_block_icon($block_name) {
        $icons = array(
            'hero-section' => 'cover-image',
            'why-choose-us' => 'awards',
            'digital-agency' => 'admin-site-alt3',
            'increase-traffic' => 'chart-line',
            'best-solutions' => 'list-view',
            'pricing-plans' => 'money-alt',
            'testimonials-section' => 'format-quote',
            'contact-form' => 'email-alt',
            'fast-agency' => 'performance',
        );
        
        return isset($icons[$block_name]) ? $icons[$block_name] : 'layout';
    }
    
    /**
     * Get example data for block preview.
     *
     * @param string $block_name Block name.
     * @return array Example data.
     */
    private function get_block_example_data($block_name) {
        $example_data = array();
        
        switch ($block_name) {
            case 'hero-section':
                $example_data = array(
                    'hero_title' => 'Bienvenue sur notre site',
                    'hero_subtitle' => 'Nous créons des expériences digitales exceptionnelles',
                    'hero_button_text' => 'En savoir plus',
                    'hero_button_url' => '#',
                    'hero_image' => plugin_dir_url( dirname( dirname( __FILE__ ) ) ) . 'assets/images/hero-bg-1.jpg',
                );
                break;
                
            case 'why-choose-us':
                $example_data = array(
                    'why_choose_title' => 'Pourquoi nous choisir',
                    'why_choose_description' => 'Découvrez les raisons pour lesquelles nos clients nous font confiance pour leurs projets digitaux.',
                    'why_choose_cards' => array(
                        array(
                            'title' => 'Expertise',
                            'description' => 'Notre équipe possède une expertise approfondie dans le domaine',
                            'icon' => 'check',
                            'image' => array(
                                'url' => plugin_dir_url( dirname( dirname( __FILE__ ) ) ) . 'assets/images/placeholder-icon.png'
                            )
                        ),
                        array(
                            'title' => 'Qualité',
                            'description' => 'Nous nous engageons à fournir des services de la plus haute qualité',
                            'icon' => 'check',
                            'image' => array(
                                'url' => plugin_dir_url( dirname( dirname( __FILE__ ) ) ) . 'assets/images/placeholder-icon.png'
                            )
                        ),
                        array(
                            'title' => 'Support',
                            'description' => 'Notre support client est disponible 24/7 pour répondre à vos questions',
                            'icon' => 'check',
                            'image' => array(
                                'url' => plugin_dir_url( dirname( dirname( __FILE__ ) ) ) . 'assets/images/placeholder-icon.png'
                            )
                        ),
                    ),
                );
                break;
                
            case 'digital-agency':
                $example_data = array(
                    'agency_title' => 'Agence Digitale',
                    'agency_description' => 'Nous sommes une agence digitale spécialisée dans la création de solutions web innovantes',
                    'agency_stats' => array(
                        array(
                            'stat_value' => '250+',
                            'stat_label' => 'Projets Réalisés',
                        ),
                        array(
                            'stat_value' => '15+',
                            'stat_label' => "Années d'Expérience",
                        ),
                        array(
                            'stat_value' => '99%',
                            'stat_label' => 'Clients Satisfaits',
                        ),
                        array(
                            'stat_value' => '24/7',
                            'stat_label' => 'Support Client',
                        ),
                    ),
                    'agency_button_text' => 'Contactez-nous',
                    'agency_button_url' => '#contact',
                );
                break;
                
            case 'increase-traffic':
                $example_data = array(
                    'traffic_title' => 'Augmentez votre trafic web',
                    'traffic_description' => 'Nos solutions de marketing digital vous aideront à augmenter votre trafic et vos conversions',
                    'traffic_button_text' => 'Commencer maintenant',
                    'traffic_button_url' => '#',
                    'traffic_image' => plugin_dir_url( dirname( dirname( __FILE__ ) ) ) . 'assets/images/traffic-image.jpg',
                );
                break;
                
            case 'best-solutions':
                $example_data = array(
                    'solutions_title' => 'Nos meilleures solutions',
                    'solutions_description' => 'Découvrez nos solutions adaptées à vos besoins',
                    'solutions' => array(
                        array(
                            'solution' => 'Création de site web responsive',
                            'solution_icon' => 'desktop',
                            'description' => 'Des sites web adaptés à tous les appareils',
                        ),
                        array(
                            'solution' => 'Optimisation SEO',
                            'solution_icon' => 'search',
                            'description' => 'Améliorez votre visibilité sur les moteurs de recherche',
                        ),
                        array(
                            'solution' => 'Campagnes publicitaires',
                            'solution_icon' => 'megaphone',
                            'description' => 'Atteignez votre audience cible efficacement',
                        ),
                    ),
                );
                break;
                
            case 'pricing-plans':
                $example_data = array(
                    'pricing_title' => 'Nos forfaits',
                    'pricing_description' => 'Choisissez le forfait qui correspond le mieux à vos besoins',
                    'pricing_plans' => array(
                        array(
                            'plan_title' => 'Basique',
                            'plan_subtitle' => 'Pour démarrer',
                            'plan_price' => '29€',
                            'plan_period' => 'mois',
                            'plan_features' => array(
                                array('feature' => 'Site web responsive'),
                                array('feature' => 'Support par email'),
                                array('feature' => 'Mises à jour gratuites'),
                            ),
                            'plan_button_text' => 'Choisir',
                            'plan_button_url' => '#',
                            'plan_featured' => false,
                        ),
                        array(
                            'plan_title' => 'Pro',
                            'plan_subtitle' => 'Le plus populaire',
                            'plan_price' => '59€',
                            'plan_period' => 'mois',
                            'plan_features' => array(
                                array('feature' => 'Site web responsive'),
                                array('feature' => 'Support prioritaire'),
                                array('feature' => 'Mises à jour gratuites'),
                                array('feature' => 'SEO optimisé'),
                            ),
                            'plan_button_text' => 'Choisir',
                            'plan_button_url' => '#',
                            'plan_featured' => true,
                        ),
                    ),
                );
                break;
                
            case 'testimonials-section':
                $example_data = array(
                    'testimonials_title' => 'Ce que disent nos clients',
                    'testimonials_description' => 'Découvrez les témoignages de nos clients satisfaits',
                    'testimonials' => array(
                        array(
                            'testimonial_quote' => 'Excellent service ! L\'équipe a été très professionnelle et réactive.',
                            'testimonial_author_name' => 'Jean Dupont',
                            'testimonial_author_title' => 'CEO, Entreprise XYZ',
                            'testimonial_author_image' => array(
                                'url' => plugin_dir_url( dirname( dirname( __FILE__ ) ) ) . 'assets/images/avatar-placeholder.png'
                            ),
                        ),
                        array(
                            'testimonial_quote' => 'Je recommande vivement leurs services. Ils ont dépassé toutes mes attentes.',
                            'testimonial_author_name' => 'Marie Martin',
                            'testimonial_author_title' => 'Directrice Marketing, ABC Inc',
                            'testimonial_author_image' => array(
                                'url' => plugin_dir_url( dirname( dirname( __FILE__ ) ) ) . 'assets/images/avatar-placeholder.png'
                            ),
                        ),
                    ),
                );
                break;
                
            case 'contact-form':
                $example_data = array(
                    'contact_title' => 'Contactez-nous',
                    'contact_description' => 'Nous sommes là pour répondre à toutes vos questions',
                    'contact_info' => array(
                        array(
                            'contact_info_title' => 'Adresse',
                            'contact_info_content' => '123 Rue Exemple, 75000 Paris',
                            'contact_info_icon' => 'map-marker-alt'
                        ),
                        array(
                            'contact_info_title' => 'Téléphone',
                            'contact_info_content' => '+33 1 23 45 67 89',
                            'contact_info_icon' => 'phone'
                        ),
                        array(
                            'contact_info_title' => 'Email',
                            'contact_info_content' => 'contact@example.com',
                            'contact_info_icon' => 'envelope'
                        )
                    ),
                );
                break;
                
            case 'fast-agency':
                $example_data = array(
                    'fast_agency_title' => 'Agence Rapide et Efficace',
                    'fast_agency_description' => 'Nous livrons des résultats rapides et efficaces pour votre entreprise',
                    'fast_agency_button_text' => 'Commencer un Projet',
                    'fast_agency_button_url' => '#contact',
                    'fast_agency_image' => plugin_dir_url( dirname( dirname( __FILE__ ) ) ) . 'assets/images/plant-image.jpg',
                    'fast_agency_stats' => array(
                        array(
                            'stat_number' => '250+',
                            'stat_label' => 'Projets Réalisés',
                        ),
                        array(
                            'stat_number' => '15+',
                            'stat_label' => "Années d'Expérience",
                        ),
                        array(
                            'stat_number' => '99%',
                            'stat_label' => 'Clients Satisfaits',
                        ),
                    ),
                );
                break;
                
            default:
                // Données par défaut
                $example_data = array(
                    'title' => 'Titre du bloc',
                    'description' => 'Description du bloc personnalisé',
                );
                break;
        }
        
        return $example_data;
    }
}
