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
registerBlockType('gcb/pricing-plans', {
    title: __('Forfaits Tarifaires', 'gutenberg-custom-blocks'),
    description: __('Section avec titre et cartes de prix', 'gutenberg-custom-blocks'),
    category: 'gcb',
    icon: 'money-alt',
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
                
                <div className="gcb-pricing-plans-editor">
                    <div className="gcb-pricing-content">
                        <h2 className="gcb-section-title">{__('Nos Forfaits Tarifaires', 'gutenberg-custom-blocks')}</h2>
                        <p className="gcb-section-description">{__('Configurez cette section via les champs ACF', 'gutenberg-custom-blocks')}</p>
                    </div>
                    
                    <div className="gcb-pricing-cards">
                        <div className="gcb-pricing-card">
                            <div className="gcb-pricing-card-header">
                                <h3 className="gcb-pricing-title">{__('Basique', 'gutenberg-custom-blocks')}</h3>
                                <div className="gcb-pricing-price">
                                    <span className="gcb-price">99€</span>
                                    <span className="gcb-period">/mois</span>
                                </div>
                            </div>
                            <div className="gcb-pricing-features">
                                <ul>
                                    <li>{__('1 site web', 'gutenberg-custom-blocks')}</li>
                                    <li>{__('5 pages', 'gutenberg-custom-blocks')}</li>
                                    <li>{__('Support par email', 'gutenberg-custom-blocks')}</li>
                                </ul>
                            </div>
                            <div className="gcb-pricing-footer">
                                <span className="gcb-pricing-button">{__('Choisir', 'gutenberg-custom-blocks')}</span>
                            </div>
                        </div>
                        
                        <div className="gcb-pricing-card gcb-featured">
                            <div className="gcb-pricing-card-header">
                                <h3 className="gcb-pricing-title">{__('Standard', 'gutenberg-custom-blocks')}</h3>
                                <div className="gcb-pricing-price">
                                    <span className="gcb-price">199€</span>
                                    <span className="gcb-period">/mois</span>
                                </div>
                            </div>
                            <div className="gcb-pricing-features">
                                <ul>
                                    <li>{__('3 sites web', 'gutenberg-custom-blocks')}</li>
                                    <li>{__('10 pages par site', 'gutenberg-custom-blocks')}</li>
                                    <li>{__('Support prioritaire', 'gutenberg-custom-blocks')}</li>
                                </ul>
                            </div>
                            <div className="gcb-pricing-footer">
                                <span className="gcb-pricing-button">{__('Choisir', 'gutenberg-custom-blocks')}</span>
                            </div>
                        </div>
                        
                        <div className="gcb-pricing-card">
                            <div className="gcb-pricing-card-header">
                                <h3 className="gcb-pricing-title">{__('Premium', 'gutenberg-custom-blocks')}</h3>
                                <div className="gcb-pricing-price">
                                    <span className="gcb-price">299€</span>
                                    <span className="gcb-period">/mois</span>
                                </div>
                            </div>
                            <div className="gcb-pricing-features">
                                <ul>
                                    <li>{__('10 sites web', 'gutenberg-custom-blocks')}</li>
                                    <li>{__('Pages illimitu00e9es', 'gutenberg-custom-blocks')}</li>
                                    <li>{__('Support 24/7', 'gutenberg-custom-blocks')}</li>
                                </ul>
                            </div>
                            <div className="gcb-pricing-footer">
                                <span className="gcb-pricing-button">{__('Choisir', 'gutenberg-custom-blocks')}</span>
                            </div>
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
