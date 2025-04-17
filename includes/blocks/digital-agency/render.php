<?php
/**
 * Digital Agency Block Template.
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
$class_name = 'bg-gray-50 py-24 max-w-full';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

// Get ACF fields
$section_title = get_field('agency_title');
$section_description = get_field('agency_description');
$services = get_field('agency_services');

// Default values if ACF fields are empty
if (empty($section_title)) {
    $section_title = 'Agence Digitale Spécialisée';
}

if (empty($section_description)) {
    $section_description = 'Nous sommes une agence digitale spécialisée dans la création de sites web et d\'applications mobiles. Nous vous accompagnons dans la réalisation de vos projets digitaux.';
}

// Default services if none are set
if (empty($services)) {
    $services = [
        [
            'icon' => 'code',
            'title' => 'Développement Web',
            'description' => 'Création de sites web sur mesure avec les dernières technologies.',
            'color' => 'cyan'
        ],
        [
            'icon' => 'pencil-alt',
            'title' => 'Design UX/UI',
            'description' => 'Conception d\'interfaces utilisateur intuitives et esthétiques.',
            'color' => 'cyan'
        ],
        [
            'icon' => 'chart-line',
            'title' => 'Marketing Digital',
            'description' => 'Stratégies de marketing digital pour augmenter votre visibilité en ligne.',
            'color' => 'cyan'
        ],
        [
            'icon' => 'headset',
            'title' => 'Support Technique',
            'description' => 'Assistance technique et maintenance de vos projets digitaux.',
            'color' => 'cyan'
        ]
    ];
}

// Output the block
?>
<section id="gcb-digital-agency" <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap items-center">
            <!-- Contenu principal -->
            <div class="w-full lg:w-1/2 pr-0 lg:pr-20 mb-12 lg:mb-0">
                <h2 class="font-outfit text-4xl font-bold mb-6 text-center lg:text-left text-gray-800"><?php echo esc_html($section_title); ?></h2>
                <p class="text-lg text-gray-600 mb-12 text-center lg:text-left"><?php echo esc_html($section_description); ?></p>

                <!-- Statistiques -->
                <div class="bg-white rounded-xl shadow-lg p-8 relative">
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="text-center relative">
                            <div class="text-cyan-500 text-2xl font-bold mb-1">250+</div>
                            <div class="text-sm text-gray-600">Projets Réalisés</div>
                            <div class="absolute right-0 top-1/2 transform -translate-y-1/2 h-12 w-px bg-gray-200 hidden lg:block"></div>
                        </div>
                        <div class="text-center relative">
                            <div class="text-cyan-500 text-2xl font-bold mb-1">15+</div>
                            <div class="text-sm text-gray-600">Années d'Expérience</div>
                            <div class="absolute right-0 top-1/2 transform -translate-y-1/2 h-12 w-px bg-gray-200 hidden lg:block"></div>
                        </div>
                        <div class="text-center relative">
                            <div class="text-cyan-500 text-2xl font-bold mb-1">99%</div>
                            <div class="text-sm text-gray-600">Clients Satisfaits</div>
                            <div class="absolute right-0 top-1/2 transform -translate-y-1/2 h-12 w-px bg-gray-200 hidden lg:block"></div>
                        </div>
                        <div class="text-center">
                            <div class="text-cyan-500 text-2xl font-bold mb-1">24/7</div>
                            <div class="text-sm text-gray-600">Support Client</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Services -->
            <div class="w-full lg:w-1/2">
                <div class="relative">
                    <div class="grid grid-cols-2 gap-6">
                        <?php foreach ($services as $index => $service) : 
                            $icon = isset($service['icon']) ? $service['icon'] : 'check';
                            $title = isset($service['title']) ? $service['title'] : '';
                            $description = isset($service['description']) ? $service['description'] : '';
                            $translateY = $index % 2 === 0 ? 'translate-y-6' : '-translate-y-6';
                            $zIndex = 4 - $index; // Plus grand z-index pour les premières cartes
                        ?>
                            <div class="<?php echo $translateY; ?> transition-all duration-300 hover:-translate-y-2" style="z-index: <?php echo $zIndex; ?>;">
                                <div class="bg-white p-6 rounded-lg shadow-lg relative">
                                    <div class="bg-cyan-100 rounded-lg p-3 inline-block mb-4">
                                        <i class="fas fa-<?php echo esc_attr($icon); ?> text-cyan-500 text-xl"></i>
                                    </div>
                                    <h3 class="font-outfit text-xl font-semibold mb-2 text-gray-800"><?php echo esc_html($title); ?></h3>
                                    <p class="text-gray-600"><?php echo esc_html($description); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
