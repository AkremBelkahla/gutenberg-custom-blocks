<?php
/**
 * Pricing Plans Block Template.
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
$class_name = 'py-24 max-w-full';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

// Get ACF fields
$section_title = get_field('pricing_title');
$section_description = get_field('pricing_description');
$plans = get_field('pricing_plans');

// Default values if ACF fields are empty
if (empty($section_title)) {
    $section_title = 'Nos Forfaits Tarifaires';
}

if (empty($section_description)) {
    $section_description = 'Choisissez le forfait qui convient le mieux à vos besoins et à votre budget';
}

// Default pricing plans if none are set
if (empty($plans)) {
    $plans = [
        [
            'name' => 'Basique',
            'subtitle' => 'Pour les petits sites',
            'price' => '99',
            'period' => '/mois',
            'features' => [
                '1 site web',
                '5 pages',
                'Support par email'
            ],
            'button_text' => 'Choisir',
            'button_url' => '#contact',
            'is_popular' => false
        ],
        [
            'name' => 'Standard',
            'subtitle' => 'Pour les entreprises',
            'price' => '199',
            'period' => '/mois',
            'features' => [
                '5 sites web',
                '10 pages par site',
                'Support prioritaire'
            ],
            'button_text' => 'Choisir',
            'button_url' => '#contact',
            'is_popular' => true
        ],
        [
            'name' => 'Premium',
            'subtitle' => 'Pour les grandes entreprises',
            'price' => '299',
            'period' => '/mois',
            'features' => [
                '10 sites web',
                'Pages illimitées',
                'Support 24/7'
            ],
            'button_text' => 'Choisir',
            'button_url' => '#contact',
            'is_popular' => false
        ]
    ];
}

?>

<section id="gcb-pricing-plans" <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="font-outfit text-4xl font-bold mb-6 text-gray-800"><?php echo esc_html($section_title); ?></h2>
            <p class="text-lg text-gray-600"><?php echo esc_html($section_description); ?></p>
        </div>

        <div class="grid grid-cols-3 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <?php foreach ($plans as $plan) : 
                $name = isset($plan['plan_title']) ? $plan['plan_title'] : '';
                $subtitle = isset($plan['plan_subtitle']) ? $plan['plan_subtitle'] : '';
                $price = isset($plan['plan_price']) ? $plan['plan_price'] : '';
                $period = isset($plan['plan_period']) ? $plan['plan_period'] : '';
                $features = isset($plan['plan_features']) ? $plan['plan_features'] : [];
                $button_text = isset($plan['plan_button_text']) ? $plan['plan_button_text'] : '';
                $button_url = isset($plan['plan_button_url']) ? $plan['plan_button_url'] : '';
                $is_popular = isset($plan['plan_featured']) ? $plan['plan_featured'] : false;
            ?>
                <div class="relative bg-white rounded-2xl shadow-lg p-8 <?php echo $is_popular ? 'border-2 border-cyan-500' : ''; ?>">
                    <?php if ($is_popular) : ?>
                        <div class="absolute -top-3 right-8 bg-cyan-500 text-white px-4 py-1 rounded-full text-sm font-semibold">
                            <?php _e('Popular', 'gutenberg-custom-blocks'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="text-center mb-8">
                        <h3 class="font-outfit text-2xl font-bold mb-2"><?php echo esc_html($name); ?></h3>
                        <p class="text-gray-500 mb-6"><?php echo esc_html($subtitle); ?></p>
                        <div class="flex items-end justify-center">
                            <span class="text-4xl font-bold"><?php echo esc_html($price); ?>€</span>
                            <span class="text-gray-500 ml-1">/<?php echo esc_html($period); ?></span>
                        </div>
                    </div>

                    <ul class="space-y-4 mb-8">
                        <?php foreach ($features as $feature) :  ?>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <?php  echo esc_html($feature['feature']); ?> 
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="text-center">
                        <a href="<?php echo esc_url($button_url); ?>" 
                           class="block w-full bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-4 px-8 rounded-full transition duration-300">
                            <?php echo esc_html($button_text); ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
