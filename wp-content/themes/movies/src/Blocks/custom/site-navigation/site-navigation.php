<?php

/**
 * Template for the Site navigation block.
 *
 * @package Movies
 */

use MoviesVendor\EightshiftLibs\Helpers\Components;

$manifest = Components::getManifest(__DIR__);

$blockClass = $attributes['blockClass'] ?? '';
$blockJsClass = $attributes['blockJsClass'] ?? '';

$siteNavigationLinks = Components::checkAttr('siteNavigationLinks', $attributes, $manifest) ?? [];

if (!empty($siteNavigationLinks)) {
	$siteNavigationLinks = array_filter($siteNavigationLinks, fn($item) => !empty($item['text']) && !empty($item['url'])); // @phpstan-ignore-line
}

$navbarClass = Components::classnames([
	$blockClass,
	$blockJsClass,
]);

$linksClass = Components::selector($blockClass, $blockClass, 'links');
$linkClass = Components::selector($blockClass, $blockClass, 'link');

$linksToShow = '';

if (!empty($siteNavigationLinks)) {
	foreach ($siteNavigationLinks as $navbarLink) {
		$url = esc_url($navbarLink['url']);
		$text = esc_attr($navbarLink['text']);

		$linksToShow .= "<a class='{$linkClass}' href='{$url}'>{$text}</a>";
	}
}
?>

<nav class="<?php echo esc_attr($navbarClass); ?>">
	<?php
	echo Components::render('image', Components::props('logo', $attributes, [
		'blockClass' => $blockClass,
		'selectorClass' => 'logo',
	]));
	?>

	<?php if (!empty($linksToShow)) { ?>
		<div class="<?php echo esc_attr($linksClass); ?>">
			<?php
			// phpcs:ignore Eightshift.Security.ComponentsEscape.OutputNotEscaped
			echo $linksToShow;
			?>
		</div>
	<?php } ?>

	<?php
	echo Components::render('hamburger', [
		'blockClass' => $blockClass,
	]);
	?>
</nav>

<?php
echo Components::render('drawer', [
	'drawerTrigger' => 'js-hamburger',
	'drawerMenu' => $linksToShow,
]);
