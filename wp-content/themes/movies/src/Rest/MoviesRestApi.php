<?php

/**
 * The file that defines the MoviesShortcode class.
 *
 * @package Movies\Rest;
 */

namespace Movies\Rest;

use MoviesVendor\EightshiftLibs\Services\ServiceInterface;
use WP_REST_Request;
use WP_REST_Response;
use WP_Query;

/**
 * MoviesRestApi class.
 */
class MoviesRestApi implements ServiceInterface
{
	/**
	 * Registers actions.
	 *
	 * @return void
	 */
	public function register(): void
	{
		\add_action('rest_api_init', [$this, 'registerRestRoutes']);
	}

	/**
	 * Registers the REST API routes.
	 *
	 * @return void
	 */
	public function registerRestRoutes(): void
	{
		\register_rest_route('movies/v1', '/filter', [
			'methods' => 'GET',
			'callback' => [$this, 'filterMoviesByGenre'],
			'permission_callback' => '__return_true',
		]);
	}

	/**
	 * Callback for the movies filter endpoint.
	 *
	 * @param WP_REST_Request $request The REST API request object.
	 *
	 * @return WP_REST_Response
	 */
	public function filterMoviesByGenre(WP_REST_Request $request): WP_REST_Response
	{
		$genre = \sanitize_text_field($request->get_param('genre'));

		$args = [
			'post_type' => 'movie',
			'posts_per_page' => -1,
		];

		if ($genre) {
			$args['tax_query'] = [
				[
					'taxonomy' => 'genre',
					'field'    => 'slug',
					'terms'    => $genre,
				],
			];
		}

		$query = new WP_Query($args);
		$movies = [];

		if ($query->have_posts()) {
			while ($query->have_posts()) {
				$query->the_post();
				$movies[] = [
					'title' => \get_the_title(),
					'permalink' => \get_permalink(),
					'thumbnail' => \get_the_post_thumbnail_url(\get_the_ID(), 'large'),
					'content' => \apply_filters('the_content', \get_the_content()),
				];
			}
		}

		\wp_reset_postdata();

		return new WP_REST_Response($movies, 200);
	}
}
