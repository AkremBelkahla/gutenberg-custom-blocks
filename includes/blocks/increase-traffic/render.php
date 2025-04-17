<?php
/**
 * Increase Traffic Block Template.
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
$class_name = 'text-white py-24 relative max-w-full';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

// Get ACF fields
$section_title = get_field( 'traffic_title' );
$section_description = get_field( 'traffic_description' );
$background_image = get_field( 'traffic_background_image' );
$button_text = get_field( 'traffic_button_text' );
$button_url = get_field( 'traffic_button_url' );

// Default values if ACF fields are empty
if ( empty( $section_title ) ) {
    $section_title = __( 'Augmentez le Trafic de Votre Entreprise', 'gutenberg-custom-blocks' );
}

if ( empty( $section_description ) ) {
    $section_description = __( 'Nous proposons des stratégies de marketing digital pour augmenter votre trafic web et vos conversions', 'gutenberg-custom-blocks' );
}

if ( empty( $button_text ) ) {
    $button_text = __( 'COMMENCEZ MAINTENANT', 'gutenberg-custom-blocks' );
}

if ( empty( $button_url ) ) {
    $button_url = '#contact';
}

// Output the block
?>
<section id="gcb-increase-traffic" <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name ); ?>">
    <!-- Background Image avec effet parallax -->
    <div class="absolute inset-0 z-0">
        <?php if ( $background_image ) : ?>
            <img src="<?php echo esc_url( $background_image['url'] ); ?>" alt="<?php echo esc_attr( $background_image['alt'] ); ?>" class="w-full h-full object-cover">
        <?php else : ?>
            <img src="<?php echo esc_url( plugin_dir_url( dirname( dirname( dirname( __FILE__ ) ) ) ) . 'assets/images/hero-bg-2.jpg' ); ?>" alt="Background" class="w-full h-full object-cover">
        <?php endif; ?>
        <div class="absolute inset-0 bg-cyan-900 bg-opacity-85"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="font-outfit text-white text-4xl font-bold mb-6"><?php echo esc_html( $section_title ); ?></h2>
            <?php if ( $section_description ) : ?>
                <p class="text-xl mb-8 opacity-90"><?php echo esc_html( $section_description ); ?></p>
            <?php endif; ?>
            
            <?php if ( $button_text && $button_url ) : ?>
                <div class="mt-8">
                    <a href="<?php echo esc_url( $button_url ); ?>" class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-4 px-8 rounded-full transition duration-300 inline-block">
                        <?php echo esc_html( $button_text ); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
