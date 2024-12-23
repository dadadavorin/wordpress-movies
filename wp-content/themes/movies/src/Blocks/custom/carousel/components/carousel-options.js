import React from 'react';
import { __ } from '@wordpress/i18n';
import { PanelBody, ToggleControl } from '@wordpress/components';
import { props, checkAttr, getAttrKey } from '@eightshift/frontend-libs/scripts';
import { HeadingOptions } from '../../../components/heading/components/heading-options';
import manifest from './../manifest.json';

export const CarouselOptions = ({ attributes, setAttributes }) => {
	const {
		showCarouselLoop = true
	} = attributes;

	const carouselIsLoop = checkAttr('carouselIsLoop', attributes, manifest);
	
	return (
		<PanelBody title={__('Carousel Details', 'productive')}>
			{showCarouselLoop &&
				<>
					<div className='es-icon-toggle es-icon-toggle--reverse'>
						<ToggleControl
							label={__('Loop mode', 'productive')}
							help={__('Allows infinite scrolling', 'productive')}
							checked={carouselIsLoop}
							onChange={(value) => setAttributes({ [getAttrKey('carouselIsLoop', attributes, manifest)]: value })}
						/>
					</div>
				</>
			}

			<HeadingOptions
				{...props('heading', attributes)}
				setAttributes={setAttributes}
			/>
		</PanelBody>
	);
};
