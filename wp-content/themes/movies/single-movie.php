<?php

/**
 * Movies single page
 *
 * @package Movies
 */

$movieTemplateClass = 'single-movie-template';

get_header();
?>

<article class="<?php echo esc_attr($movieTemplateClass); ?>">
	<!-- Movie featured image if exists, if not show a placeholder -->
    <picture class="<?php echo esc_attr($movieTemplateClass); ?>__image">
        <source srcset="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" media="(min-width: 768px)">
		<?php
		if (has_post_thumbnail()) {
			echo '<img src="' . esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium')) . '" alt="' . esc_attr(get_the_title()) . '">';
		} else {
			echo '<img src="' . esc_url(get_template_directory_uri()) . '/assets/images/placeholder.png" alt="' . esc_attr(get_the_title()) . '">';
		}
		?>
    </picture>

	<!-- Movie title -->
	<h1 class="<?php echo esc_attr($movieTemplateClass); ?>__title"><?php the_title(); ?></h1>
	<!-- Movie genre custom taxonomy -->
    <div class="<?php echo esc_attr($movieTemplateClass); ?>__genre">
		<?php
		$terms = get_the_terms(get_the_ID(), 'genre');
		if ($terms) {
			foreach ($terms as $term) {
				echo '<a href="' . esc_url(get_term_link($term)) . '" class="' . esc_attr($movieTemplateClass) . '__genre-link">' . esc_html($term->name) . '</a>';
			}
		}
		?>
    </div>
	<!-- Movie content -->
	<div class="<?php echo esc_attr($movieTemplateClass); ?>__content">
        <?php the_content(); ?>
    </div>
</article>

<?php
get_footer();
