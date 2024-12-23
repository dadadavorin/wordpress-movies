<?php

/**
 * Archive Movie template file
 *
 * @package Movies
 */

get_header();
?>

    <article class="archive-movie-template">
		<?php
		if (have_posts()) {
			while (have_posts()) {
				the_post();

				?>

                <a href="<?php the_permalink(); ?>" class="archive-movie-template__card">
                    <div class="archive-movie-template__card-image">
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>"
                             alt="<?php echo esc_attr(get_the_title()); ?>">
                    </div>
                    <h2 class="archive-movie-template__card-title"><?php the_title(); ?></h2>
                    <div class="archive-movie-template__card-content">
						<?php the_content(); ?>
                    </div>
                </a>
				<?php
			}
		}
		?>
    </article>

<?php
get_footer();