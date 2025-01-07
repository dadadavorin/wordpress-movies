# WordPress showcase website

Simple WordPress website to showcase building a custom theme, Gutenberg blocks and fetching via API.

This was done for testing purposes to show way of working on a WordPress development task.

Please go to the **Pull requests -> Closed** and follow from the #1 to #5th to check the flow.

## Task Requirements

The solution should be developed as either a custom theme or a plugin.

1. Custom post type and taxonomies
- Create custom post type “Movie”
- Create a taxonomy “Genre” and assign that taxonomy to “Movie” post type
- Create a single and archive page for “Movie” post type
- In a single page, print (title, movie thumbnail, genre, description)
- In a archive page, list all movies as cards (title, thumbnail and description)
- Note: You can style the single page, archive page, and movie cards as you prefer. Aim
for a responsive and visually appealing design.

2. Custom gutenberg block
- Create a block that shows favorite movie quotes
- Block should be assigned only to “movie” post type
- Fields that this block should have (quote, movie, author)
- Note: You may use ACF (Advanced Custom Fields) to create the block, or build it with
the native Gutenberg block development tools (e.g., React and @wordpress/scripts).

3. Create a shortcode that shows a list of movies
- Shortcode should have possibility to show movies based on “genre” taxonomy
and choose how many items you want to show

4. Slider section
- Create a section using swiper.js library
- Section needs to be responsive

5. Create custom REST API endpoint

- On archive page add select field and populate that field with “genre” taxonomies
- Using AJAX, filter movie list by calling your custom endpoint
- You should also change url so if you land on archive page with the genre
parameters you set, you should also show a filtered list of movies

## Getting Started

Download the website and run inside your theme folder:

`composer install`
`npm install`
`npm run dev`

This will install all the dependencies and compile the assets.
