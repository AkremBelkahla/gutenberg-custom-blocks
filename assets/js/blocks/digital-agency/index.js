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
registerBlockType('gcb/digital-agency', {
    title: __('Agence Digitale', 'gutenberg-custom-blocks'),
    description: __('Section avec titre et icu00f4nes coloru00e9es', 'gutenberg-custom-blocks'),
    category: 'gcb',
    icon: 'admin-site',
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
                
                <div className="gcb-digital-agency-editor">
                    <div className="gcb-agency-content">
                        <h2 className="gcb-section-title">{__('Agence Digitale pour vos Solutions d\'Entreprise', 'gutenberg-custom-blocks')}</h2>
                        <p className="gcb-section-description">{__('Configurez cette section via les champs ACF', 'gutenberg-custom-blocks')}</p>
                    </div>
                    
                    <div className="gcb-icons-grid">
                        <div className="gcb-icon-box gcb-orange">
                            <div className="gcb-icon-placeholder"></div>
                            <span>SEO</span>
                        </div>
                        <div className="gcb-icon-box gcb-purple">
                            <div className="gcb-icon-placeholder"></div>
                            <span>SEM</span>
                        </div>
                        <div className="gcb-icon-box gcb-blue">
                            <div className="gcb-icon-placeholder"></div>
                            <span>SMM</span>
                        </div>
                        <div className="gcb-icon-box gcb-green">
                            <div className="gcb-icon-placeholder"></div>
                            <span>Web</span>
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
