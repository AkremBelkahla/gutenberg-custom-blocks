<?php
/**
 * Best Solutions Block Template.
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
$class_name = 'bg-gray-50 py-20 max-w-full m-0';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

// Get ACF fields
$section_title = get_field( 'solutions_title' );
$section_description = get_field( 'solutions_description' );
$solutions = get_field( 'solutions_list' );

// Default values if ACF fields are empty
if ( empty( $section_title ) ) {
    $section_title = __( 'Nous avons les Meilleures Solutions pour Vous', 'gutenberg-custom-blocks' );
}

if ( empty( $section_description ) ) {
    $section_description = __( 'Nous proposons une gamme complète de services pour répondre à tous vos besoins digitaux', 'gutenberg-custom-blocks' );
}

// Default solutions if none are set
if ( empty( $solutions ) ) {
    $solutions = [
        [
            'icon' => 'fa-desktop',
            'title' => __( 'Conception de sites web responsifs', 'gutenberg-custom-blocks' ),
            'description' => __( 'Création de sites web adaptés à tous les appareils', 'gutenberg-custom-blocks' ),
        ],
        [
            'icon' => 'fa-search',
            'title' => __( 'Optimisation pour les moteurs de recherche', 'gutenberg-custom-blocks' ),
            'description' => __( 'Amélioration du référencement naturel', 'gutenberg-custom-blocks' ),
        ],
        [
            'icon' => 'fa-share-alt',
            'title' => __( 'Marketing sur les réseaux sociaux', 'gutenberg-custom-blocks' ),
            'description' => __( 'Gestion de vos réseaux sociaux', 'gutenberg-custom-blocks' ),
        ],
        [
            'icon' => 'fa-bullhorn',
            'title' => __( 'Publicité en ligne (PPC)', 'gutenberg-custom-blocks' ),
            'description' => __( 'Gestion de vos campagnes publicitaires', 'gutenberg-custom-blocks' ),
        ],
        [
            'icon' => 'fa-mobile-alt',
            'title' => __( 'Développement d\'applications mobiles', 'gutenberg-custom-blocks' ),
            'description' => __( 'Applications natives et hybrides', 'gutenberg-custom-blocks' ),
        ],
        [
            'icon' => 'fa-chart-bar',
            'title' => __( 'Analyse de données et rapports', 'gutenberg-custom-blocks' ),
            'description' => __( 'Suivi et analyse de vos performances', 'gutenberg-custom-blocks' ),
        ],
    ];
}

// Output the block
?>
<section id="gcb-best-solutions" <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name ); ?>">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="font-outfit text-4xl font-bold mb-6 text-gray-800"><?php echo esc_html( $section_title ); ?></h2>
            <?php if ( $section_description ) : ?>
                <p class="text-lg text-gray-600"><?php echo esc_html( $section_description ); ?></p>
            <?php endif; ?>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ( $solutions as $solution ) : 
                $icon = isset($solution['solution_icon']) ? $solution['solution_icon'] : 'fa-check';
                $title = isset($solution['solution']) ? $solution['solution'] : '';
                $description = isset($solution['description']) ? $solution['description'] : '';
            ?> 
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="w-12 h-12 bg-cyan-500 text-white rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-<?php echo esc_attr( $icon ); ?> text-xl"></i>
                    </div>
                    <h3 class="font-outfit text-xl font-bold mb-3 text-gray-800"><?php echo esc_html( $title ); ?></h3>
                    <p class="text-gray-600"><?php echo esc_html( $description ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
