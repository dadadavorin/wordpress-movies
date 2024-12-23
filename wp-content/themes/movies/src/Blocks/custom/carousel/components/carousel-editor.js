import React from 'react';
import { InnerBlocks } from '@wordpress/block-editor';
import { checkAttr, selector, props, classnames } from '@eightshift/frontend-libs/scripts';
import { HeadingEditor } from '../../../components/heading/components/heading-editor';
import { IconEditor } from '../../../components/icon/components/icon-editor';
import manifest from '../manifest.json';

export const CarouselEditor = ({ attributes, setAttributes }) => {
	const {
		blockClass,
		blockJsClass,
	} = attributes;

	const carouselAllowedBlocks = checkAttr('carouselAllowedBlocks', attributes, manifest);
	const carouselIsLoop = checkAttr('carouselIsLoop', attributes, manifest);

	const carouselClass = classnames(
		blockClass,
		blockJsClass,
	);

	const carouselTopBarClass = selector(blockClass, blockClass, 'top-bar');

	return (
		<div
			className={carouselClass}
			data-is-loop={carouselIsLoop}
		>
			<div className={carouselTopBarClass}>
				<HeadingEditor
					{...props('heading', attributes)}
					setAttributes={setAttributes}
				/>

				<IconEditor
					{...props('chevron', attributes, {
						iconName: 'arrow-chevron-back',
						selectorClass: 'prev-button'
					})}
					setAttributes={setAttributes}
				/>

				<IconEditor
					{...props('chevron', attributes, {
						iconName: 'arrow-chevron-forward',
						selectorClass: 'next-button'
					})}
					setAttributes={setAttributes}
				/>
			</div>

			<InnerBlocks
				orientation={'horizontal'}
				allowedBlocks={carouselAllowedBlocks}
			/>
		</div>
	);
};
