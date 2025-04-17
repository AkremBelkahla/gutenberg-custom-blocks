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
registerBlockType('gcb/fast-agency', {
    title: __('Agence Rapide', 'gutenberg-custom-blocks'),
    description: __('Section avec titre, description et statistiques', 'gutenberg-custom-blocks'),
    category: 'gcb',
    icon: 'performance',
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
                
                <div className="gcb-fast-agency-editor">
                    <div className="gcb-fast-agency-content">
                        <h2 className="gcb-section-title">{__('Agence Digitale Rapide et Efficace', 'gutenberg-custom-blocks')}</h2>
                        <p className="gcb-section-description">{__('Configurez cette section via les champs ACF', 'gutenberg-custom-blocks')}</p>
                    </div>
                    
                    <div className="gcb-stats-container">
                        <div className="gcb-stat-item">
                            <div className="gcb-stat-number">500+</div>
                            <div className="gcb-stat-label">{__('Projets Ru00e9alisu00e9s', 'gutenberg-custom-blocks')}</div>
                        </div>
                        <div className="gcb-stat-item">
                            <div className="gcb-stat-number">98%</div>
                            <div className="gcb-stat-label">{__('Clients Satisfaits', 'gutenberg-custom-blocks')}</div>
                        </div>
                        <div className="gcb-stat-item">
                            <div className="gcb-stat-number">15+</div>
                            <div className="gcb-stat-label">{__('Annu00e9es d\'Expu00e9rience', 'gutenberg-custom-blocks')}</div>
                        </div>
                        <div className="gcb-stat-item">
                            <div className="gcb-stat-number">24/7</div>
                            <div className="gcb-stat-label">{__('Support Client', 'gutenberg-custom-blocks')}</div>
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
