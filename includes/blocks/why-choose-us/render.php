<?php
/**
 * Why Choose Us Block Template.
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
$class_name = 'wp-block-gcb-why-choose-us max-w-full';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

// Check if we're in the editor or preview mode
$is_preview = isset( $block['data']['preview'] );
$is_editor = defined( 'REST_REQUEST' ) && REST_REQUEST;

// Set default values for editor/preview mode
if ($is_preview || $is_editor) {
    $section_title = 'Pourquoi choisir Pilot\'in?';
    $section_description = 'Nous offrons des solutions complètes pour votre présence en ligne';
    $cards = array(
        array(
            'title' => 'Expertise Technique',
            'description' => 'Notre équipe possède une expertise technique avancée dans le développement web et le marketing digital.',
            'icon' => 'fa-code',
        ),
        array(
            'title' => 'Support Réactif',
            'description' => 'Nous offrons un support réactif et personnalisé pour répondre à tous vos besoins.',
            'icon' => 'fa-headset',
        ),
        array(
            'title' => 'Solutions Sur Mesure',
            'description' => 'Nous développons des solutions sur mesure adaptées à vos besoins spécifiques.',
            'icon' => 'fa-cogs',
        ),
        array(
            'title' => 'Résultats Mesurables',
            'description' => 'Nous nous engageons à fournir des résultats mesurables et à atteindre vos objectifs.',
            'icon' => 'fa-chart-line',
        ),
    );
} else {
    // Get ACF fields
    $section_title = get_field( 'why_choose_title' );
    $section_description = get_field( 'why_choose_description' );
    $reasons = get_field( 'why_choose_cards' );

    // Default values if ACF fields are empty
    if ( empty( $section_title ) ) {
        $section_title = __( 'Pourquoi nous choisir ?', 'gutenberg-custom-blocks' );
    }
    if ( empty( $section_description ) ) {
        $section_description = __( 'Découvrez les raisons pour lesquelles nos clients nous font confiance pour leurs projets digitaux.', 'gutenberg-custom-blocks' );
    }

    // Convertir reasons en cards pour maintenir la compatibilité
    $cards = [];
    if (!empty($reasons)) {
        foreach ($reasons as $reason) {
            $cards[] = [
                'title' => isset($reason['title']) ? $reason['title'] : '',
                'description' => isset($reason['description']) ? $reason['description'] : '',
                'icon' => isset($reason['icon']) ? $reason['icon'] : 'fa-check',
                'image' => isset($reason['image']) ? $reason['image'] : '',
            ];
        }
    }

    // Default cards if none are set
    if ( empty( $cards ) ) {
        $cards = [
            [
                'title' => __( 'Expertise Technique', 'gutenberg-custom-blocks' ),
                'description' => __( 'Notre équipe possède une expertise technique approfondie dans les dernières technologies web.', 'gutenberg-custom-blocks' ),
                'icon' => 'fa-code',
            ],
            [
                'title' => __( 'Support Réactif', 'gutenberg-custom-blocks' ),
                'description' => __( 'Nous offrons un support réactif et personnalisé pour répondre à tous vos besoins.', 'gutenberg-custom-blocks' ),
                'icon' => 'fa-headset',
            ],
            [
                'title' => __( 'Solutions Sur Mesure', 'gutenberg-custom-blocks' ),
                'description' => __( 'Nous développons des solutions sur mesure adaptées à vos besoins spécifiques.', 'gutenberg-custom-blocks' ),
                'icon' => 'fa-cogs',
            ],
            [
                'title' => __( 'Résultats Mesurables', 'gutenberg-custom-blocks' ),
                'description' => __( 'Nous nous engageons à fournir des résultats mesurables et à atteindre vos objectifs.', 'gutenberg-custom-blocks' ),
                'icon' => 'fa-chart-line',
            ],
        ];
    }
}

// Output the block
?>
<section id="gcb-why-choose-us" <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name ); ?>">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="font-outfit text-4xl font-bold mb-6 text-gray-800"><?php echo esc_html( $section_title ); ?></h2>
            <?php if ( $section_description ) : ?>
                <p class="text-lg text-gray-600"><?php echo esc_html( $section_description ); ?></p>
            <?php endif; ?>
        </div>
        
        <div class="flex flex-wrap -mx-4 justify-center">
            <?php foreach ( $cards as $card ) : 
                $title = isset($card['title']) ? $card['title'] : '';
                $description = isset($card['description']) ? $card['description'] : '';
                $icon = isset($card['icon']) ? $card['icon'] : 'fa-check';
                $img = isset($card['image']) ? $card['image'] : '';
            ?>
                <div class="w-full md:w-1/2 lg:w-1/4 px-4 mb-8">

                    <!-- content -->
                    <div class="bg-gray-50 rounded-lg p-6 h-full shadow-sm transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                        <!-- image ici -->
                        <?php if ( $img ) : ?>
                            <img src="<?php echo esc_url( $img['url'] ); ?>" alt="<?php echo esc_attr( $title ); ?>" class="w-full mb-6">
                        <?php endif; ?>
                         <div class="w-16 h-16 bg-cyan-500 text-white rounded-full flex items-center justify-center mb-6 mx-auto">
                            <i class="fas <?php echo esc_attr( $icon ); ?> text-2xl"></i>
                        </div>
                        <h3 class="font-outfit text-xl font-bold mb-3 text-center text-gray-800"><?php echo esc_html( $title ); ?></h3>
                        <p class="text-gray-600 text-center"><?php echo esc_html( $description ); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
