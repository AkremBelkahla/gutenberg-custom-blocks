/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

/**
 * Internal dependencies
 */
import './editor.scss';

/**
 * Register block
 */
registerBlockType('gcb/hero-section', {
    title: __('Section Héro', 'gutenberg-custom-blocks'),
    description: __('Section principale avec titre, sous-titre, bouton et image', 'gutenberg-custom-blocks'),
    category: 'gcb',
    icon: 'cover-image',
    supports: {
        html: false,
        align: ['wide', 'full'],
    },
    attributes: {
        blockId: {
            type: 'string',
            default: '',
        },
    },
    
    edit: ({ attributes, setAttributes, clientId }) => {
        const { blockId } = attributes;
        const blockProps = useBlockProps();
        
        // Set a unique ID for ACF fields if not already set
        if (!blockId) {
            setAttributes({ blockId: clientId });
        }
        
        return (
            <div {...blockProps}>
                <InspectorControls>
                    <PanelBody title={__('Paramètres de la section Héro', 'gutenberg-custom-blocks')}>
                        <p>{__('Configurez les champs dans l\'onglet Document', 'gutenberg-custom-blocks')}</p>
                    </PanelBody>
                </InspectorControls>
                
                <div className="gcb-hero-section-editor">
                    <div className="gcb-hero-content">
                        <h2>{__('Section Héro', 'gutenberg-custom-blocks')}</h2>
                        <p>{__('Configurez cette section dans l\'onglet Document ou via les champs ACF', 'gutenberg-custom-blocks')}</p>
                        <div className="gcb-hero-placeholder">
                            <p>{__('Titre principal, sous-titre, bouton CTA et image', 'gutenberg-custom-blocks')}</p>
                        </div>
                    </div>
                </div>
            </div>
        );
    },
    
    save: () => {
        // Dynamic block, render handled by PHP
        return null;
    },
});
