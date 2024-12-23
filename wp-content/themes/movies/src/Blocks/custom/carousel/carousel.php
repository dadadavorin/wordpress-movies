<?php

/**
 * Template for the Carousel Block.
 *
 * @package Movies
 */

use MoviesVendor\EightshiftLibs\Helpers\Components;

$manifest = Components::getManifest(__DIR__);

$blockClass = $attributes['blockClass'] ?? '';
$blockJsClass = $attributes['blockJsClass'] ?? '';

$carouselIsLoop = Components::checkAttr('carouselIsLoop', $attributes, $manifest);

$carouselClass = Components::classnames([
	$blockClass,
	$blockJsClass,
	'swiper',
	$attributes['className'] ?? ''
]);

$carouselTopBarClass = Components::selector($blockClass, $blockClass, 'top-bar');

?>


<div
	class="<?php echo esc_attr($carouselClass); ?>"
	data-swiper-loop="<?php echo esc_attr($carouselIsLoop); ?>"
>

    <div class="<?php echo esc_attr($carouselTopBarClass); ?>">
		<?php
		echo Components::render(
			'heading',
			array_merge(
				Components::props('heading', $attributes),
				[]
			)
		),
		Components::render(
			'icon',
			Components::props('icon', $attributes, [
				'iconName' => 'arrow-chevron-back',
				'selectorClass' => 'prev-button',
				'additionalClass' => "{$blockJsClass}-prev"
			])
		),
		Components::render(
			'icon',
			Components::props('icon', $attributes, [
				'iconName' => 'arrow-chevron-forward',
				'selectorClass' => 'next-button',
				'additionalClass' => "{$blockJsClass}-next"
			])
		);
		?>
    </div>

	<div class="<?php echo esc_attr('swiper-wrapper'); ?>">
		<?php echo $innerBlockContent; // phpcs:ignore Eightshift.Security.ComponentsEscape.OutputNotEscaped ?>
	</div>
</div>
