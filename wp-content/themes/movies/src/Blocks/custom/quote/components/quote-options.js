import React from 'react';
import { __ } from '@wordpress/i18n';
import { PanelBody } from '@wordpress/components';
import { props } from '@eightshift/frontend-libs/scripts';
import { ParagraphOptions } from '../../../components/paragraph/components/paragraph-options';

export const QuoteOptions = ({ attributes, setAttributes }) => {
	return (
		<PanelBody title={__('Quote Details', 'productive')}>
			<ParagraphOptions
				{...props('paragraph', attributes)}
				setAttributes={setAttributes}
			/>
			<ParagraphOptions
				{...props('movie', attributes)}
				setAttributes={setAttributes}
			/>
			<ParagraphOptions
				{...props('author', attributes)}
				setAttributes={setAttributes}
			/>
		</PanelBody>
	);
};
