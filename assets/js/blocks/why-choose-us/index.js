/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody } from '@wordpress/components';

/**
 * Internal dependencies
 */
import './editor.scss';

/**
 * Register block
 */
registerBlockType('gcb/why-choose-us', {
    title: __('Pourquoi Nous Choisir', 'gutenberg-custom-blocks'),
    description: __('Section avec titre et cartes explicatives', 'gutenberg-custom-blocks'),
    category: 'gcb',
    icon: 'thumbs-up',
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
                    <PanelBody title={__('Paramu00e8tres de la section', 'gutenberg-custom-blocks')}>
                        <p>{__('Configurez les champs dans l\'onglet Document', 'gutenberg-custom-blocks')}</p>
                    </PanelBody>
                </InspectorControls>
                
                <div className="gcb-why-choose-us-editor">
                    <h2 className="gcb-section-title">{__('Pourquoi Nous Choisir', 'gutenberg-custom-blocks')}</h2>
                    <p className="gcb-section-description">{__('Configurez cette section via les champs ACF', 'gutenberg-custom-blocks')}</p>
                    
                    <div className="gcb-cards-container">
                        <div className="gcb-card-placeholder">
                            <div className="gcb-card-icon"></div>
                            <h3>{__('Carte 1', 'gutenberg-custom-blocks')}</h3>
                            <p>{__('Description de la carte 1', 'gutenberg-custom-blocks')}</p>
                        </div>
                        
                        <div className="gcb-card-placeholder">
                            <div className="gcb-card-icon"></div>
                            <h3>{__('Carte 2', 'gutenberg-custom-blocks')}</h3>
                            <p>{__('Description de la carte 2', 'gutenberg-custom-blocks')}</p>
                        </div>
                        
                        <div className="gcb-card-placeholder">
                            <div className="gcb-card-icon"></div>
                            <h3>{__('Carte 3', 'gutenberg-custom-blocks')}</h3>
                            <p>{__('Description de la carte 3', 'gutenberg-custom-blocks')}</p>
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
