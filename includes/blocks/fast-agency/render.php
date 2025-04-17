<?php
/**
 * Fast Agency Block Template.
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
$class_name = 'relative py-20 max-w-full';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

// Get ACF fields
$section_title = get_field( 'agency_fast_title' );
$section_description = get_field( 'agency_fast_description' );
$stats = get_field( 'agency_fast_stats' );
$cta_text = get_field( 'agency_fast_cta_text' );
$cta_url = get_field( 'agency_fast_cta_url' );

// Default values if ACF fields are empty
if ( empty( $section_title ) ) {
    $section_title = __( 'Agence Digitale Rapide et Efficace', 'gutenberg-custom-blocks' );
}

if ( empty( $section_description ) ) {
    $section_description = __( 'Notre agence offre des solutions digitales rapides et efficaces pour votre entreprise', 'gutenberg-custom-blocks' );
}

if ( empty( $cta_text ) ) {
    $cta_text = __( 'Commencer un Projet', 'gutenberg-custom-blocks' );
}

if ( empty( $cta_url ) ) {
    $cta_url = '#contact';
}

// Default stats if none are set
if ( empty( $stats ) ) {
    $stats = [
        [
            'number' => '500+',
            'label' => __( 'Projets Réalisés', 'gutenberg-custom-blocks' ),
        ],
        [
            'number' => '98%',
            'label' => __( 'Clients Satisfaits', 'gutenberg-custom-blocks' ),
        ],
        [
            'number' => '15+',
            'label' => __( 'Années d\'Expérience', 'gutenberg-custom-blocks' ),
        ],
        [
            'number' => '24/7',
            'label' => __( 'Support Client', 'gutenberg-custom-blocks' ),
        ],
    ];
}

// Output the block
?>
<section id="gcb-fast-agency" <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name ); ?>">
    <!-- Background avec overlay -->
    <div class="absolute inset-0 z-0">
        <img src="<?php echo esc_url( plugin_dir_url( dirname( dirname( dirname( __FILE__ ) ) ) ) . 'assets/images/hero-bg-4.jpg' ); ?>" alt="Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-cyan-900 bg-opacity-85"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="font-outfit text-4xl font-bold mb-6 text-white"><?php echo esc_html( $section_title ); ?></h2>
            <?php if ( $section_description ) : ?>
                <p class="text-lg text-white text-opacity-90"><?php echo esc_html( $section_description ); ?></p>
            <?php endif; ?>
        </div>
        
        <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16">
            <?php foreach ( $stats as $stat ) : 
                $number = isset($stat['stat_number']) ? $stat['stat_number'] : '';
                $label = isset($stat['stat_label']) ? $stat['stat_label'] : '';
            ?>
                <div class="text-center px-4">
                    <div class="text-4xl font-bold text-white mb-2"><?php echo esc_html( $number ); ?></div>
                    <div class="text-white text-opacity-90"><?php echo esc_html( $label ); ?></div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- CTA Section -->
        <div class="text-center mt-12">
            <a href="<?php echo esc_url( $cta_url ); ?>" class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-4 px-8 rounded-full transition duration-300 inline-block">
                <?php echo esc_html( $cta_text ); ?>
            </a>
        </div>
    </div>
</section>
