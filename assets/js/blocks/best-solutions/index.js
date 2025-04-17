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
registerBlockType('gcb/best-solutions', {
    title: __('Meilleures Solutions', 'gutenberg-custom-blocks'),
    description: __('Section avec titre et liste de solutions', 'gutenberg-custom-blocks'),
    category: 'gcb',
    icon: 'yes-alt',
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
                
                <div className="gcb-best-solutions-editor">
                    <div className="gcb-solutions-content">
                        <h2 className="gcb-section-title">{__('Nous avons les Meilleures Solutions pour Vous', 'gutenberg-custom-blocks')}</h2>
                        <p className="gcb-section-description">{__('Configurez cette section via les champs ACF', 'gutenberg-custom-blocks')}</p>
                    </div>
                    
                    <div className="gcb-solutions-grid">
                        <div className="gcb-solutions-list">
                            <div className="gcb-solution-item">
                                <div className="gcb-solution-icon"></div>
                                <div className="gcb-solution-text">{__('Conception de sites web responsifs', 'gutenberg-custom-blocks')}</div>
                            </div>
                            <div className="gcb-solution-item">
                                <div className="gcb-solution-icon"></div>
                                <div className="gcb-solution-text">{__('Optimisation pour les moteurs de recherche', 'gutenberg-custom-blocks')}</div>
                            </div>
                            <div className="gcb-solution-item">
                                <div className="gcb-solution-icon"></div>
                                <div className="gcb-solution-text">{__('Marketing sur les ru00e9seaux sociaux', 'gutenberg-custom-blocks')}</div>
                            </div>
                        </div>
                        <div className="gcb-solutions-list">
                            <div className="gcb-solution-item">
                                <div className="gcb-solution-icon"></div>
                                <div className="gcb-solution-text">{__('Publicitu00e9 en ligne (PPC)', 'gutenberg-custom-blocks')}</div>
                            </div>
                            <div className="gcb-solution-item">
                                <div className="gcb-solution-icon"></div>
                                <div className="gcb-solution-text">{__('Du00e9veloppement d\'applications mobiles', 'gutenberg-custom-blocks')}</div>
                            </div>
                            <div className="gcb-solution-item">
                                <div className="gcb-solution-icon"></div>
                                <div className="gcb-solution-text">{__('Analyse de donnu00e9es et rapports', 'gutenberg-custom-blocks')}</div>
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
