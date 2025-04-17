<?php
/**
 * Hero Section Block Template.
 *
 * @param array $attributes Block attributes.
 * @param string $content Block content.
 * @param WP_Block $block Block instance.
 * @return string Rendered block HTML.
 *
 * @package GutenbergCustomBlocks
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'bg-custom-gradient text-white py-24 relative max-w-full';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

// Get ACF fields
$hero_title = get_field( 'hero_title' );
$hero_subtitle = get_field( 'hero_subtitle' );
$hero_button_text = get_field( 'hero_button_text' );
$hero_button_url = get_field( 'hero_button_url' );
$hero_image = get_field( 'hero_image' );

// Default values if ACF fields are empty
if ( empty( $hero_title ) ) {
    $hero_title = __( 'Agence Digitale Spécialisée en Création de Sites Web', 'gutenberg-custom-blocks' );
}

if ( empty( $hero_subtitle ) ) {
    $hero_subtitle = __( 'Nous créons des sites web performants et optimisés pour le référencement naturel. Contactez-nous pour discuter de votre projet.', 'gutenberg-custom-blocks' );
}

if ( empty( $hero_button_text ) ) {
    $hero_button_text = __( 'Contactez-nous', 'gutenberg-custom-blocks' );
}

if ( empty( $hero_button_url ) ) {
    $hero_button_url = '#contact';
}

// Traitement de l'image héro
$hero_image_url = '';
if (empty($hero_image)) {
    // Image par défaut si aucune image n'est sélectionnée
    $hero_image_url = plugin_dir_url( dirname( dirname( dirname( __FILE__ ) ) ) ) . 'assets/images/hero-bg-1.jpg';
} else if (is_array($hero_image) && isset($hero_image['url'])) {
    // Si $hero_image est un tableau (comme dans le cas d'un champ ACF image), récupérer l'URL
    $hero_image_url = $hero_image['url'];
} else if (is_string($hero_image)) {
    // Si c'est déjà une chaîne, l'utiliser directement
    $hero_image_url = $hero_image;
}

// Output the block
?>
<section id="gcb-hero-section" <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name ); ?>">
    <!-- Background Image avec overlay -->
    <div class="absolute inset-0 z-0">
        <img src="<?php echo esc_url( $hero_image_url ); ?>" alt="Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-cyan-900 bg-opacity-80"></div>
    </div>

    <div class="container mx-auto px-4 relative z-1">
        <div class="flex flex-wrap items-center">
            <!-- Contenu principal -->
            <div class="w-full lg:w-1/2 px-4 mb-12 lg:mb-0">
                <div class="max-w-lg">
                    <h1 class="font-outfit text-4xl md:text-5xl text-white font-bold mb-6 !leading-tight"><?php echo esc_html( $hero_title ); ?></h1>
                    <p class="text-lg text-white mb-8"><?php echo esc_html( $hero_subtitle ); ?></p>
                    <div class="mt-8">
                        <a href="<?php echo esc_url( $hero_button_url ); ?>" class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-4 px-8 rounded-full transition duration-300 inline-block">
                            <?php echo esc_html( $hero_button_text ); ?>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Images flottantes -->
            <div class="w-full lg:w-1/2 px-4 relative">
                <div class="relative h-96">
                    <img src="<?php echo esc_url( plugin_dir_url( dirname( dirname( dirname( __FILE__ ) ) ) ) . 'assets/images/hero-app_development_03.svg' ); ?>" alt="Laptop" class="laptop-image absolute bottom-0 right-0 w-1/5 max-w-xs z-10">
                    <img src="<?php echo esc_url( plugin_dir_url( dirname( dirname( dirname( __FILE__ ) ) ) ) . 'assets/images/hero-app_development_02.svg' ); ?>" alt="Code Screen" class="code-screen absolute top-10 right-20 max-w-sm z-0">
                    <img src="<?php echo esc_url( plugin_dir_url( dirname( dirname( dirname( __FILE__ ) ) ) ) . 'assets/images/hero-app_development_01.svg' ); ?>" alt="UI Element" class="ui-element absolute bottom-24 left-[15rem] w-1/5 max-w-xs z-20">
                </div>
            </div>
        </div>

        <!-- Trusted By Section -->
        <div class="mt-16 text-center">
            <p class="text-white text-lg mb-8 opacity-80"><?php _e('Fait confiance par :', 'gutenberg-custom-blocks'); ?></p>
            <div class="flex justify-center items-center space-x-12">
                <i class="fab fa-airbnb text-white text-4xl opacity-70 hover:opacity-100 transition-opacity"></i>
                <i class="fab fa-paypal text-white text-4xl opacity-70 hover:opacity-100 transition-opacity"></i>
                <i class="fab fa-slack text-white text-4xl opacity-70 hover:opacity-100 transition-opacity"></i>
                <i class="fab fa-spotify text-white text-4xl opacity-70 hover:opacity-100 transition-opacity"></i>
            </div>
        </div>
    </div>

    <!-- Waves Separator -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden z-10">
        <svg class="relative block w-full" style="transform: translateY(1px);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100">
            <path fill="#ffffff" d="M0,32L60,42.7C120,53,240,75,360,74.7C480,75,600,53,720,48C840,43,960,53,1080,58.7C1200,64,1320,64,1380,64L1440,64L1440,100L1380,100C1320,100,1200,100,1080,100C960,100,840,100,720,100C600,100,480,100,360,100C240,100,120,100,60,100L0,100Z"></path>
        </svg>
    </div>
</section>
