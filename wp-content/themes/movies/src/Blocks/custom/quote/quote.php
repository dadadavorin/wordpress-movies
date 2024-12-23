<?php

/**
 * Template for the Quote Block view.
 *
 * @package Movies
 */

use MoviesVendor\EightshiftLibs\Helpers\Components;

$globalManifest = Components::getSettings();
$manifest = Components::getManifest(__DIR__);
$blockName = $attributes['blockName'] ?? $manifest['blockName'];

$blockClasses = Components::classnames([
	Components::checkAttr('blockClass', $attributes, $manifest),
	$attributes['className'] ?? ''
]);

$unique = Components::getUnique();
echo Components::outputCssVariables($attributes, $manifest, $unique);
?>

<div
	class="<?php echo esc_attr($blockClasses); ?>"
	data-id="<?php echo esc_attr($unique); ?>"
>
	<?php
	echo Components::render(
		'paragraph',
		Components::props('paragraph', $attributes)
	),
	Components::render('paragraph', Components::props('movie', $attributes, [
		'selectorClass' => 'movie',
	])),
	Components::render('paragraph', Components::props('author', $attributes, [
		'selectorClass' => 'author',
	]));
	?>
</div>
