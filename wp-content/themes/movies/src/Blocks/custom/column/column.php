<?php

/**
 * Template for the Column Block.
 *
 * @package Movies
 */

use MoviesVendor\EightshiftLibs\Helpers\Components;

$globalManifest = Components::getManifest(dirname(__DIR__, 2));
$manifest = Components::getManifest(__DIR__);

$blockClasses = Components::classnames([
    $attributes['blockClass'] ?? '',
    $attributes['className'] ?? '',
]);

$unique = Components::getUnique();
?>

<div class="<?php echo esc_attr($blockClasses); ?>" data-id="<?php echo esc_attr($unique) ?>">
	<?php
		echo Components::outputCssVariables($attributes, $manifest, $unique, $globalManifest), $innerBlockContent;
	?>
</div>
