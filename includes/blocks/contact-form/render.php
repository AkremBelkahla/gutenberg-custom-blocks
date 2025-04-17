<?php
/**
 * Contact Form Block Template.
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
$section_title = get_field('contact_title');
$section_description = get_field('contact_description');
$contact_info = get_field('contact_info');

// Default values if ACF fields are empty
if (empty($section_title)) {
    $section_title = 'Contactez-nous';
}

if (empty($section_description)) {
    $section_description = 'Envoyez-nous un message et nous vous répondrons dans les plus brefs délais';
}

?>

<section id="gcb-contact-form" <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="font-outfit text-4xl font-bold mb-6 text-gray-800"><?php echo esc_html($section_title); ?></h2>
            <p class="text-lg text-gray-600"><?php echo esc_html($section_description); ?></p>
        </div>

        <div class="max-w-5xl mx-auto">
            <form action="#" method="POST" class="grid grid-cols-3 md:grid-cols-2 gap-8">
                <!-- Colonne gauche -->
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                        <input type="text" name="name" id="name" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" id="email" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Sujet</label>
                        <input type="text" name="subject" id="subject" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                    </div>
                </div>

                <!-- Colonne droite -->
                <div class="space-y-6">
                    <div class="h-full flex flex-col">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                        <textarea name="message" id="message" rows="4" class="flex-grow w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-cyan-500 focus:border-transparent mb-6"></textarea>
                        <button type="submit" class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-4 px-8 rounded-full transition duration-300">
                            Envoyer
                        </button>
                    </div>
                </div>
            </form>

            <!-- Informations de contact -->
            <div class="mt-16 grid grid-cols-3 md:grid-cols-3 gap-8">
                <?php if (have_rows('contact_info')) : ?>
                    <?php while (have_rows('contact_info')) : the_row(); ?>
                        <div class="flex items-center space-x-4">
                            <div class="bg-cyan-100 p-3 rounded-lg">
                                <i class="fas fa-<?php echo esc_attr(get_sub_field('contact_info_icon')); ?> text-cyan-500"></i>
                            </div>
                            <div>
                                <h4 class="font-outfit font-medium text-gray-900 mb-1"><?php echo esc_html(get_sub_field('contact_info_title')); ?></h4>
                                <p class="text-gray-600"><?php echo esc_html(get_sub_field('contact_info_content')); ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <!-- Informations de contact par défaut -->
                    <div class="flex items-center space-x-4">
                        <div class="bg-cyan-100 p-3 rounded-lg">
                            <i class="fas fa-map-marker-alt text-cyan-500"></i>
                        </div>
                        <div>
                            <h4 class="font-outfit font-medium text-gray-900 mb-1">Adresse</h4>
                            <p class="text-gray-600">123 Rue Exemple, 75000 Paris</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="bg-cyan-100 p-3 rounded-lg">
                            <i class="fas fa-phone text-cyan-500"></i>
                        </div>
                        <div>
                            <h4 class="font-outfit font-medium text-gray-900 mb-1">Téléphone</h4>
                            <p class="text-gray-600">01 23 45 67 89</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="bg-cyan-100 p-3 rounded-lg">
                            <i class="fas fa-envelope text-cyan-500"></i>
                        </div>
                        <div>
                            <h4 class="font-outfit font-medium text-gray-900 mb-1">Email</h4>
                            <p class="text-gray-600">contact@exemple.com</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
