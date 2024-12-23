import React from 'react';
import { __ } from '@wordpress/i18n';
import { PanelBody } from '@wordpress/components';
import { props } from '@eightshift/frontend-libs/scripts';
import { ImageOptions } from '../../../components/image/components/image-options';

export const SiteNavigationOptions = ({ attributes, setAttributes }) => {
	return (
		<PanelBody title={__('Site navigation', 'Movies')}>
			<ImageOptions
				{...props('logo', attributes, { setAttributes })}
				label={__('Logo', 'Movies')}
				hideFullSizeToggle
				hideRoundedCornersToggle
				noBottomSpacing
			/>
		</PanelBody>
	);
};
