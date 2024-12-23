<?php

/**
 * The GenreTaxonomy specific functionality.
 *
 * @package Movies\CustomTaxonomy
 */

declare(strict_types=1);

namespace Movies\CustomTaxonomy;

use Movies\CustomPostType\MoviesPostType;
use MoviesVendor\EightshiftLibs\CustomTaxonomy\AbstractTaxonomy;

/**
 * Class GenreTaxonomy
 */
class GenreTaxonomy extends AbstractTaxonomy
{
	/**
	 * Taxonomy slug constant.
	 *
	 * @var string
	 */
	public const TAXONOMY_SLUG = 'genre';

	/**
	 * Rest API Endpoint slug constant.
	 *
	 * @var string
	 */
	public const REST_API_ENDPOINT_SLUG = 'genre';

	/**
	 * Get the slug of the custom taxonomy
	 *
	 * @return string Custom taxonomy slug.
	 */
	protected function getTaxonomySlug(): string
	{
		return static::TAXONOMY_SLUG;
	}

	/**
	 * Get the post type slug(s) that use the taxonomy.
	 *
	 * @return string|array<string> Custom post type slug or an array of slugs.
	 */
	protected function getPostTypeSlug()
	{
		return MoviesPostType::POST_TYPE_SLUG;
	}

	/**
	 * Get the arguments that configure the custom taxonomy.
	 *
	 * @return array<mixed> Array of arguments.
	 */
	protected function getTaxonomyArguments(): array
	{
		return [
			'hierarchical' => true,
			'label' => \esc_html__('Genre', 'productive'),
			'show_ui' => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => false,
			'public' => true,
			'show_in_rest' => true,
			'query_var' => true,
			'rest_base' => static::REST_API_ENDPOINT_SLUG,
			'rewrite' => [
				'hierarchical' => true,
				'with_front' => false,
			],
		];
	}
}
