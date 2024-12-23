<?php

/**
 * Class Blocks is the base class for Gutenberg blocks registration.
 * It provides the ability to register custom blocks using manifest.json.
 *
 * @package Movies\Blocks
 */

declare(strict_types=1);

namespace Movies\Blocks;

use MoviesVendor\EightshiftLibs\Blocks\AbstractBlocks;
use Movies\CustomPostType\MoviesPostType;
use WP_Block_Editor_Context;

/**
 * Class Blocks
 */
class Blocks extends AbstractBlocks
{
	/**
	 * Register all the hooks
	 *
	 * @return void
	 */
	public function register(): void
	{
		// Register all custom blocks.
		\add_action('init', [$this, 'getBlocksDataFullRaw'], 10);
		\add_action('init', [$this, 'registerBlocks'], 11);

		// Remove P tags from content.
		\remove_filter('the_content', 'wpautop');

		// Create new custom category for custom blocks.
		\add_filter('block_categories_all', [$this, 'getCustomCategory'], 10, 2);

		// Register custom theme support options.
		\add_action('after_setup_theme', [$this, 'addThemeSupport'], 25);

		// Register custom project color palette.
		\add_action('after_setup_theme', [$this, 'changeEditorColorPalette'], 11);

		// Filter block content.
		\add_filter('render_block_data', [$this, 'filterBlocksContent'], 10, 2);

		// Output inline css variables.
		\add_action('wp_footer', [$this, 'outputCssVariablesInline']);

		// Only allow custom built blocks and limit blocks for Movies CPT.
		\add_filter('allowed_block_types_all', [$this, 'allowOnlyCustomBlocks'], 21, 2);
	}

	/**
	 * Only allow our custom blocks in editor, minus the ones listed in:
	 * $this->blocksDisallowedByDefault().
	 *
	 * @param  bool|array<bool|string> $allowedBlocks Array of block type slugs, or boolean to enable/disable all.
	 * @param WP_Block_Editor_Context $blockEditorContext The post resource data.
	 *
	 * @return bool|array<bool|string>
	 */
	public function allowOnlyCustomBlocks($allowedBlocks, WP_Block_Editor_Context $blockEditorContext)
	{
		// If all blocks are allowed, $allowedBlocks will be === true. If this is the case, we only
		// wish to allow our custom blocks.
		if (!\is_array($allowedBlocks)) {
			$allowedBlocks = \array_merge(
				(array) $this->getAllBlocksList([], $blockEditorContext),
			);
		}

		// Don't allow blocks which are specific to MoviesPostType on other post types.
		if ($blockEditorContext->post && $blockEditorContext->post->post_type !== MoviesPostType::POST_TYPE_SLUG) {
			$allowedBlocks = $this->unsetBlocks($allowedBlocks, $this->moviesCptOnlyBlocks());
		}

		return \is_array($allowedBlocks) ? \array_values($allowedBlocks) : $allowedBlocks;
	}

	/**
	 * Removes blocks from $original array
	 *
	 * @param  array<bool|string>|bool $original Array of blocks.
	 * @param array<bool> $toRemove Array of blocks to remove.
	 *
	 * @return array<bool|string>|bool
	 */
	protected function unsetBlocks($original, array $toRemove)
	{
		if (!\is_array($original)) {
			return $original;
		}

		return \array_values(\array_filter($original, function ($blockName) use ($toRemove) {
			return !isset($toRemove[$blockName]);
		}));
	}

	/**
	 * Blocks which are only registered in Movies CPT.
	 *
	 * @return array<string, bool>
	 */
	protected function moviesCptOnlyBlocks(): array
	{
		return [
			'eightshift-boilerplate/quote' => true,
		];
	}
}
