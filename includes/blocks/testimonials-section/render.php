<?php
/**
 * Testimonials Section Block Template.
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
$class_name = 'gcb-testimonials-section bg-gray-50 py-20 max-w-full';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

// Get ACF fields
$section_title = get_field( 'testimonials_title' );
$section_description = get_field( 'testimonials_description' );
$testimonials = get_field( 'testimonials' );

// Default values if ACF fields are empty
if ( empty( $section_title ) ) {
    $section_title = __( 'Ce que nos clients disent', 'gutenberg-custom-blocks' );
}

if ( empty( $section_description ) ) {
    $section_description = __( 'Découvrez les témoignages de nos clients satisfaits', 'gutenberg-custom-blocks' );
}

// Default testimonials if none are set
if ( empty( $testimonials ) ) {
    $testimonials = [
        [
            'quote' => __( '"Une équipe professionnelle et réactive. Je recommande vivement leurs services pour tout projet digital."', 'gutenberg-custom-blocks' ),
            'author_name' => __( 'Sophie Dubois', 'gutenberg-custom-blocks' ),
            'author_title' => __( 'CEO, StartupXYZ', 'gutenberg-custom-blocks' ),
            'author_image' => '',
        ],
        [
            'quote' => __( '"Leur équipe a transformé notre présence en ligne. Nous avons maintenant un site web magnifique et des résultats concrets."', 'gutenberg-custom-blocks' ),
            'author_name' => __( 'Jean Martin', 'gutenberg-custom-blocks' ),
            'author_title' => __( 'Directeur Marketing, Company ABC', 'gutenberg-custom-blocks' ),
            'author_image' => '',
        ],
        [
            'quote' => __( '"Un excellent partenaire digital qui comprend vraiment nos besoins et propose des solutions innovantes."', 'gutenberg-custom-blocks' ),
            'author_name' => __( 'Marie Laurent', 'gutenberg-custom-blocks' ),
            'author_title' => __( 'Directrice Générale, TechPro', 'gutenberg-custom-blocks' ),
            'author_image' => '',
        ],
    ];
}

// Output the block
?>
<section id="gcb-testimonials-section" <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name ); ?>">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="font-outfit text-4xl font-bold mb-6 text-gray-800"><?php echo esc_html( $section_title ); ?></h2>
            <?php if ( $section_description ) : ?>
                <p class="text-lg text-gray-600"><?php echo esc_html( $section_description ); ?></p>
            <?php endif; ?>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mx-auto">
            <?php foreach ( $testimonials as $testimonial ) : 
                $quote = isset($testimonial['testimonial_quote']) ? $testimonial['testimonial_quote'] : '';
                $author_name = isset($testimonial['testimonial_author_name']) ? $testimonial['testimonial_author_name'] : '';
                $author_title = isset($testimonial['testimonial_author_title']) ? $testimonial['testimonial_author_title'] : '';
                $author_image = isset($testimonial['testimonial_author_image']) ? $testimonial['testimonial_author_image'] : '';
            ?>
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <div class="mb-6">
                        <i class="fas fa-quote-left text-4xl text-cyan-500 opacity-25"></i>
                        <p class="mt-4 text-gray-600 italic"><?php echo esc_html( $quote ); ?></p>
                    </div>
                    <div class="flex items-center">
                        <?php if ( $author_image ) : ?>
                            <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                                <img src="<?php echo esc_url( $author_image ); ?>" alt="<?php echo esc_attr( $author_name ); ?>" class="w-full h-full object-cover">
                            </div>
                        <?php endif; ?>
                        <div>
                            <h4 class="font-outfit font-bold text-gray-800"><?php echo esc_html( $author_name ); ?></h4>
                            <?php if ( $author_title ) : ?>
                                <p class="text-sm text-gray-600"><?php echo esc_html( $author_title ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
