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
registerBlockType('gcb/testimonials-section', {
    title: __('Section Tu00e9moignages', 'gutenberg-custom-blocks'),
    description: __('Section avec titre et tu00e9moignages clients', 'gutenberg-custom-blocks'),
    category: 'gcb',
    icon: 'format-quote',
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
                
                <div className="gcb-testimonials-editor">
                    <div className="gcb-testimonials-content">
                        <h2 className="gcb-section-title">{__('Ce que nos clients disent', 'gutenberg-custom-blocks')}</h2>
                        <p className="gcb-section-description">{__('Configurez cette section via les champs ACF', 'gutenberg-custom-blocks')}</p>
                    </div>
                    
                    <div className="gcb-testimonials-grid">
                        <div className="gcb-testimonial-card">
                            <div className="gcb-testimonial-quote">
                                <p>{__('"Incroyable service! Notre trafic web a augmentu00e9 de 200% en seulement 3 mois. Je recommande fortement cette agence."', 'gutenberg-custom-blocks')}</p>
                            </div>
                            <div className="gcb-testimonial-author">
                                <div className="gcb-author-avatar"></div>
                                <div className="gcb-author-info">
                                    <h4>{__('Marie Dupont', 'gutenberg-custom-blocks')}</h4>
                                    <p>{__('PDG, Entreprise XYZ', 'gutenberg-custom-blocks')}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div className="gcb-testimonial-card">
                            <div className="gcb-testimonial-quote">
                                <p>{__('"Leur u00e9quipe a transformu00e9 notre pru00e9sence en ligne. Nous avons maintenant un site web magnifique et des ru00e9sultats concrets."', 'gutenberg-custom-blocks')}</p>
                            </div>
                            <div className="gcb-testimonial-author">
                                <div className="gcb-author-avatar"></div>
                                <div className="gcb-author-info">
                                    <h4>{__('Jean Martin', 'gutenberg-custom-blocks')}</h4>
                                    <p>{__('Directeur Marketing, Company ABC', 'gutenberg-custom-blocks')}</p>
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
