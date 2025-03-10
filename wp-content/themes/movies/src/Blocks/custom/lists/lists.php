<?php

/**
 * Template for the Lists Block view.
 *
 * @package Movies
 */

use MoviesVendor\EightshiftLibs\Helpers\Components;

$globalManifest = Components::getManifest(dirname(__DIR__, 2));
$manifest = Components::getManifest(__DIR__);

$blockClass = $attributes['blockClass'] ?? '';

$unique = Components::getUnique();
?>

<div class="<?php echo esc_attr($blockClass); ?>" data-id="<?php echo esc_attr($unique); ?>">
	<?php
	echo Components::outputCssVariables($attributes, $manifest, $unique, $globalManifest),
	Components::render('lists', Components::props('lists', $attributes));
	?>
</div>
