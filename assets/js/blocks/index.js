/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';


// Landing Page Blocks
import './hero-section';
import './why-choose-us';
import './digital-agency';
import './increase-traffic';
import './best-solutions';
import './pricing-plans';
import './testimonials-section';
import './contact-form';
import './fast-agency';

// Register custom category for our blocks
wp.blocks.updateCategory( 'gcb', {
    title: __( 'Blocs Personnalisés', 'gutenberg-custom-blocks' ),
    icon: 'block-default',
} );
