<?php

/**
 * The file that defines the MoviesShortcode class.
 *
 * @package Movies\Shortcode;
 */

declare(strict_types=1);

namespace Movies\Shortcode;

use MoviesVendor\EightshiftLibs\Services\ServiceInterface;
use WP_Query;

/**
 * MoviesShortcode class.
 */
class DisplayMovies implements ServiceInterface
{
	/**
	 * Register all the hooks
	 *
	 * @return void
	 */
	public function register(): void
	{
		\add_shortcode('movies_list', [$this, 'renderMoviesShortcode']);
	}

	/**
	 * Render the movies list shortcode
	 *
	 * @param array<string, mixed> $atts Shortcode attributes.
	 *
	 * @return string
	 */
	public function renderMoviesShortcode($atts): string
	{
		$movieArchiveClass = 'archive-movie-template';

		// Parse shortcode attributes with defaults.
		$atts = \shortcode_atts(
			[
				'genre' => '', // Default to no genre filter.
				'number' => 100, // Default number of movies to display.
			],
			$atts,
			'movies_list'
		);

		// Query arguments.
		$args = [
			'post_type' => 'movie',
			'posts_per_page' => (int) $atts['number'],
			'tax_query' => [],
		];

		// Add taxonomy filter if 'genre' is provided.
		if (!empty($atts['genre'])) {
			$args['tax_query'][] = [
				'taxonomy' => 'genre',
				'field'    => 'slug',
				'terms'    => $atts['genre'],
			];
		}

		// Query movies.
		$query = new WP_Query($args);

		// Start output buffering.
		\ob_start();

		if (!$query->have_posts()) {
			echo '<p class="movie-list__empty">No movies found.</p>';
		} else { ?>
		<article class="<?php echo \esc_attr($movieArchiveClass); ?>">
			<?php
			while ($query->have_posts()) {
					$query->the_post(); ?>

				<a href="<?php echo \esc_url(\get_permalink()); ?>" class="<?php echo \esc_attr($movieArchiveClass); ?>__card">
					<div class="<?php echo \esc_attr($movieArchiveClass); ?>__card-image">
						<img src="<?php echo \esc_url(\get_the_post_thumbnail_url(\get_the_ID(), 'large')); ?>"
							 alt="<?php echo \esc_attr(\get_the_title()); ?>">
					</div>
					<h2 class="<?php echo \esc_attr($movieArchiveClass); ?>__card-title"><?php echo \esc_attr(\get_the_title()); ?></h2>
				</a>

			<?php } ?>
		</article>
			<?php
		}

		// Reset post data.
		\wp_reset_postdata();

		// Return the output.
		return \ob_get_clean();
	}
}
