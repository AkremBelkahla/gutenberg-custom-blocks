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
registerBlockType('gcb/increase-traffic', {
    title: __('Augmentez le Trafic', 'gutenberg-custom-blocks'),
    description: __('Section avec titre, description et bouton CTA', 'gutenberg-custom-blocks'),
    category: 'gcb',
    icon: 'chart-line',
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
                
                <div className="gcb-increase-traffic-editor">
                    <div className="gcb-traffic-content">
                        <h2 className="gcb-section-title">{__('Augmentez le Trafic de Votre Entreprise', 'gutenberg-custom-blocks')}</h2>
                        <p className="gcb-section-description">{__('Nous proposons des stratu00e9gies de marketing digital pour augmenter votre trafic web et vos conversions', 'gutenberg-custom-blocks')}</p>
                        <div className="gcb-traffic-cta">
                            <span className="gcb-button">{__('COMMENCEZ MAINTENANT', 'gutenberg-custom-blocks')}</span>
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
