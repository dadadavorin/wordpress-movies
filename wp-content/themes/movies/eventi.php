<?php

/**
 * Template Name: Eventi
 *
 * @package Movies
 */

get_header();

if (have_posts()) {
	while (have_posts()) {
		the_post();
		the_content();
	}
}

?>

<?php
if (have_rows('event')) { ?>

	<!-- Slider main container -->
	<main class="main-content" id="main-content">
		<!-- Additional required wrapper -->
		<div class="eventi">

			<!-- Slider content -->
			<?php
			while (have_rows('event')): the_row(); ?>

				<!-- Slides -->
				<div class="event__wrapper">
					<img class="event__slika" src="<?php the_sub_field('slika') ?>" alt="slika-eventa" />
                    <div class="event__content">
                        <h2 class="event__naziv">
							<?php if(get_sub_field('naziv_eventa')): ?>
								<?php the_sub_field('naziv_eventa'); ?>
							<?php endif; ?>
                        </h2>
                        <div class="event__meta event__meta--date">
							<?php if(get_sub_field('datum')): ?>
								<?php the_sub_field('datum'); ?>
							<?php endif; ?>
                        </div>
                        <div class="event__meta event__meta--location">
							<?php if(get_sub_field('lokacija')): ?>
								<?php the_sub_field('lokacija'); ?>
							<?php endif; ?>
                        </div>
                        <div class="event__opis">
							<?php if(get_sub_field('opis_eventa')): ?>
								<?php the_sub_field('opis_eventa'); ?>
							<?php endif; ?>
                        </div>
						<?php if(get_sub_field('link_event')): ?>
                            <a class="event__button event__link wp-block-button__link wp-element-button" href="<?php the_sub_field('link_event'); ?>" target="_blank">Link na event</a>
						<?php endif; ?>
						<?php if(get_sub_field('link_ulaznice')): ?>
                            <a class="event__button event__ulaznice wp-block-button__link wp-element-button" href="<?php the_sub_field('link_ulaznice'); ?>" target="_blank">Ulaznice</a>
						<?php endif; ?>
                    </div>

                </div>

			<?php
			endwhile; ?>
		</div>
	</main>

	<?php
} ?>




<?php

get_footer();
