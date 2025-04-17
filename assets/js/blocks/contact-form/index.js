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
registerBlockType('gcb/contact-form', {
    title: __('Formulaire de Contact', 'gutenberg-custom-blocks'),
    description: __('Section avec formulaire de contact', 'gutenberg-custom-blocks'),
    category: 'gcb',
    icon: 'email',
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
                    <PanelBody title={__('Paramu00e8tres du formulaire', 'gutenberg-custom-blocks')}>
                        <p>{__('Configurez les champs dans l\'onglet Document', 'gutenberg-custom-blocks')}</p>
                    </PanelBody>
                </InspectorControls>
                
                <div className="gcb-contact-form-editor">
                    <div className="gcb-contact-content">
                        <h2 className="gcb-section-title">{__('Contactez-nous', 'gutenberg-custom-blocks')}</h2>
                        <p className="gcb-section-description">{__('Configurez cette section via les champs ACF', 'gutenberg-custom-blocks')}</p>
                    </div>
                    
                    <div className="gcb-form-container">
                        <div className="gcb-form-preview">
                            <div className="gcb-form-row">
                                <div className="gcb-form-group">
                                    <label>{__('Nom', 'gutenberg-custom-blocks')}</label>
                                    <input type="text" className="gcb-form-control" disabled />
                                </div>
                                <div className="gcb-form-group">
                                    <label>{__('Email', 'gutenberg-custom-blocks')}</label>
                                    <input type="email" className="gcb-form-control" disabled />
                                </div>
                            </div>
                            <div className="gcb-form-group">
                                <label>{__('Sujet', 'gutenberg-custom-blocks')}</label>
                                <input type="text" className="gcb-form-control" disabled />
                            </div>
                            <div className="gcb-form-group">
                                <label>{__('Message', 'gutenberg-custom-blocks')}</label>
                                <textarea className="gcb-form-control" rows="5" disabled></textarea>
                            </div>
                            <div className="gcb-form-submit">
                                <button className="gcb-submit-button" disabled>{__('Envoyer', 'gutenberg-custom-blocks')}</button>
                            </div>
                        </div>
                        <div className="gcb-contact-info">
                            <div className="gcb-info-item">
                                <div className="gcb-info-icon"></div>
                                <div className="gcb-info-content">
                                    <h4>{__('Adresse', 'gutenberg-custom-blocks')}</h4>
                                    <p>{__('123 Rue Exemple, 75000 Paris', 'gutenberg-custom-blocks')}</p>
                                </div>
                            </div>
                            <div className="gcb-info-item">
                                <div className="gcb-info-icon"></div>
                                <div className="gcb-info-content">
                                    <h4>{__('Tu00e9lu00e9phone', 'gutenberg-custom-blocks')}</h4>
                                    <p>{__('01 23 45 67 89', 'gutenberg-custom-blocks')}</p>
                                </div>
                            </div>
                            <div className="gcb-info-item">
                                <div className="gcb-info-icon"></div>
                                <div className="gcb-info-content">
                                    <h4>{__('Email', 'gutenberg-custom-blocks')}</h4>
                                    <p>{__('contact@exemple.com', 'gutenberg-custom-blocks')}</p>
                                </div>
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
