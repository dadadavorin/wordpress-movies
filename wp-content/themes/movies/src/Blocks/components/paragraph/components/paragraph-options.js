import React from 'react';
import { __ } from '@wordpress/i18n';
import { checkAttr, getAttrKey, getOption, UseToggle, ColorPicker, ucfirst, Select, generateUseToggleConfig, Section } from '@eightshift/frontend-libs/scripts';
import manifest from './../manifest.json';

export const ParagraphOptions = (attributes) => {
	const {
		setAttributes,

		hideColor = false,
		hideSize = false,
		hideWeight = false,

		additionalControls,
	} = attributes;

	const paragraphColor = checkAttr('paragraphColor', attributes, manifest);
	const [fontSize, fontWeight] = checkAttr('paragraphSize', attributes, manifest)?.split(':') ?? '';

	const fontSizes = getOption('paragraphSize', attributes, manifest).reduce((all, { label, value, weights }) => ({
		...all,
		[value]: {
			label: label,
			value: value,
			weights: weights,
			weightOptions: weights.map((weight) => ({ label: ucfirst(weight), value: weight })),
		},
	}), {});

	return (
		<UseToggle {...generateUseToggleConfig(attributes, manifest, 'paragraphUse')}>
			<Section
				showIf={!hideColor || !hideSize || !hideWeight}
				reducedBottomSpacing={additionalControls}
				noBottomSpacing={!additionalControls}
				additionalClasses='es-h-spaced'
			>
				{!hideColor &&
					<ColorPicker
						colors={getOption('paragraphColor', attributes, manifest, true)}
						value={paragraphColor}
						onChange={(value) => setAttributes({ [getAttrKey('paragraphColor', attributes, manifest)]: value })}
						type='textColor'
						noBottomSpacing
						border
					/>
				}

				{!hideSize &&
					<Select
						value={fontSize}
						options={Object.values(fontSizes)}
						onChange={(value) => setAttributes({
							[getAttrKey('paragraphSize', attributes, manifest)]: `${value}:${fontSizes[value]?.weights[0] ?? 'bold'}`,
						})}
						additionalSelectClasses='es-w-16'
						placeholder={__('Size', 'Movies')}
						noBottomSpacing
						simpleValue
						noSearch
					/>
				}

				{!hideWeight && fontSizes[fontSize]?.weightOptions?.length > 0 &&
					<Select
						value={fontWeight}
						options={fontSizes[fontSize]?.weightOptions}
						onChange={(value) => setAttributes({ [getAttrKey('paragraphSize', attributes, manifest)]: `${fontSize}:${value}` })}
						additionalSelectClasses='es-w-22 es-flex-shrink-0 es-flex-grow-1'
						placeholder={__('Weight', 'Movies')}
						noBottomSpacing
						simpleValue
						noSearch
					/>
				}
			</Section>

			{additionalControls}
		</UseToggle>
	);
};
