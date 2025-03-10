<?php

/**
 * Template for the Group block.
 *
 * @package Movies
 */

$blockClass = $attributes['blockClass'] ?? '';

?>

<div class="<?php echo esc_attr($blockClass); ?>">
	<?php
	// phpcs:ignore Eightshift.Security.ComponentsEscape.OutputNotEscaped
	echo $innerBlockContent;
	?>
</div>
