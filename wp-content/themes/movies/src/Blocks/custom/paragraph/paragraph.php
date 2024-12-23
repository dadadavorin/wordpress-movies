<?php

/**
 * Template for the Paragraph Block view.
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
$paragraphParagraphUse = $attributes['paragraphParagraphUse'] ?? true;

if (!$paragraphParagraphUse) {
	return;
}

$unique = Components::getUnique();
?>

<div class="<?php echo esc_attr($blockClasses); ?>" data-id="<?php echo esc_attr($unique); ?>">
	<?php
	echo Components::outputCssVariables($attributes, $manifest, $unique, $globalManifest),
	Components::render('paragraph', Components::props('paragraph', $attributes));
	?>
</div>
