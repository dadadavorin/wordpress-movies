<?php

/**
 * Template for the Card Block.
 *
 * @package Movies
 */

use MoviesVendor\EightshiftLibs\Helpers\Components;

echo Components::render('card', Components::props('card', $attributes));
