<?php

/**
 * Archive Movie template file
 *
 * @package Movies
 */

get_header();

$movieArchiveClass = 'archive-movie-template';
?>

    <article class="<?php echo esc_attr($movieArchiveClass); ?>">
		<?php
		if (have_posts()) {
			while (have_posts()) {
				the_post();

				?>

                <a href="<?php the_permalink(); ?>" class="<?php echo esc_attr($movieArchiveClass); ?>__card">
                    <div class="<?php echo esc_attr($movieArchiveClass); ?>__card-image">
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>"
                             alt="<?php echo esc_attr(get_the_title()); ?>">
                    </div>
                    <h2 class="<?php echo esc_attr($movieArchiveClass); ?>__card-title"><?php echo esc_attr(get_the_title()); ?></h2>
                    <div class="<?php echo esc_attr($movieArchiveClass); ?>__card-content">
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