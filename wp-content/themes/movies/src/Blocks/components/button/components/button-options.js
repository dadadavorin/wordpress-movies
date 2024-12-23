import React from 'react';
import { __ } from '@wordpress/i18n';
import { TextControl } from '@wordpress/components';
import {
	icons,
	getOption,
	checkAttr,
	getAttrKey,
	IconLabel,
	UseToggle,
	LinkEditComponent,
	OptionSelector,
	props,
	getOptions,
	Section,
	generateUseToggleConfig,
	ColorPicker,
} from '@eightshift/frontend-libs/scripts';
import { IconOptions } from '../../icon/components/icon-options';
import manifest from './../manifest.json';

export const ButtonOptions = (attributes) => {
	const {
		setAttributes,

		hideAriaLabel = false,
		hideId = false,
		hideUrl = false,
		hideVariantPicker = false,
		hideColorPicker = false,

		additionalControls,
	} = attributes;

	const buttonId = checkAttr('buttonId', attributes, manifest);
	const buttonAriaLabel = checkAttr('buttonAriaLabel', attributes, manifest);
	const buttonUrl = checkAttr('buttonUrl', attributes, manifest);
	const buttonIsNewTab = checkAttr('buttonIsNewTab', attributes, manifest);
	const buttonVariant = checkAttr('buttonVariant', attributes, manifest);
	const buttonColor = checkAttr('buttonColor', attributes, manifest);

	return (
		<UseToggle {...generateUseToggleConfig(attributes, manifest, 'buttonUse')}>
			{!hideUrl &&
				<LinkEditComponent
					url={buttonUrl}
					opensInNewTab={buttonIsNewTab}
					onChange={({ url, newTab, isAnchor }) => setAttributes({
						[getAttrKey('buttonUrl', attributes, manifest)]: url,
						[getAttrKey('buttonIsNewTab', attributes, manifest)]: newTab,
						[getAttrKey('buttonIsAnchor', attributes, manifest)]: isAnchor ?? false,
					})}
				/>
			}

			{!hideVariantPicker &&
				<OptionSelector
					icon={icons.genericShapesAlt}
					label={__('Style', 'Movies')}
					value={buttonVariant}
					onChange={(value) => setAttributes({ [getAttrKey('buttonVariant', attributes, manifest)]: value })}
					options={getOption('buttonVariant', attributes, manifest)}
					reducedBottomSpacing={!hideColorPicker}
					inlineLabel
					iconOnly
				/>
			}

			{!hideColorPicker &&
				<ColorPicker
					icon={icons.colorAlt}
					label={__('Color', 'Movies')}
					value={buttonColor}
					onChange={(value) => setAttributes({ [getAttrKey('buttonColor', attributes, manifest)]: value })}
					options={getOption('buttonColor', attributes, manifest)}
					colors={getOption('buttonColor', attributes, manifest, true)}
					tooltip={__('Color', 'Movies')}
					inlineLabel
					expanded
					border
				/>
			}

			{additionalControls}

			<IconOptions
				{...props('icon', attributes, {
					options: getOptions(attributes, manifest),
				})}
				noExpandButton
				hideSizePicker
			/>

			<Section showIf={!hideAriaLabel} icon={icons.a11y} label={__('Accessibility', 'Movies')} collapsable reducedBottomSpacing>
				<TextControl
					label={<IconLabel icon={icons.ariaLabel} label={__('ARIA label', 'Movies')} />}
					value={buttonAriaLabel}
					onChange={(value) => setAttributes({ [getAttrKey('buttonAriaLabel', attributes, manifest)]: value })}
					help={__('Description of the button.', 'Movies')}
				/>
			</Section>

			<Section showIf={!hideId} icon={icons.tools} label={__('Advanced', 'Movies')} collapsable noBottomSpacing>
				<TextControl
					label={<IconLabel icon={icons.id} label={__('Unique identifier', 'Movies')} />}
					value={buttonId}
					onChange={(value) => setAttributes({ [getAttrKey('buttonId', attributes, manifest)]: value })}
				/>
			</Section>
		</UseToggle>
	);
};
