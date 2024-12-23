import React, { useMemo } from 'react';
import { outputCssVariables, getUnique, props } from '@eightshift/frontend-libs/scripts';
import { ParagraphEditor } from '../../../components/paragraph/components/paragraph-editor';
import manifest from '../manifest.json';
import globalManifest from '../../../manifest.json';

export const QuoteEditor = ({ attributes, setAttributes }) => {
	const unique = useMemo(() => getUnique(), []);

	const {
		blockClass
	} = attributes;

	return (
		<>
			{outputCssVariables(attributes, manifest, unique, globalManifest)}

			<div className={blockClass} data-id={unique}>
				<ParagraphEditor
					{...props('paragraph', attributes, {
						selectorClass: 'paragraph',
						setAttributes,
					})}
				/>
				<ParagraphEditor
					{...props('movie', attributes, {
						selectorClass: 'movie',
						setAttributes,
					})}
				/>
				<ParagraphEditor
					{...props('author', attributes, {
						selectorClass: 'author',
						setAttributes,
					})}
				/>
			</div>
		</>
	);
};
