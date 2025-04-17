<?php
/**
 * Template d'aperçu pour les blocs Gutenberg
 *
 * @package GutenbergCustomBlocks
 */

// Si nous sommes en mode aperçu
if (isset($block['example']['attributes']['mode']) && $block['example']['attributes']['mode'] === 'preview') :
    // Affichage de l'aperçu du bloc
?>
<div class="gcb-block-preview">
    <div style="padding:20px; background-color:#f8f9fa; text-align:center; font-family:sans-serif;">
        <strong><?php echo esc_html($block['title']); ?></strong>
        <p><?php _e('Un bloc personnalisé pour la landing page.', 'gutenberg-custom-blocks'); ?></p>
    </div>
</div>
<?php
return; // Arrêter l'exécution pour ne pas afficher le contenu réel du bloc
endif;
