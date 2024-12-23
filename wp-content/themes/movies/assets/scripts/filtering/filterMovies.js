document.addEventListener('DOMContentLoaded', () => {
	const genreSelect = document.getElementById('movie-genre');
	const movieList = document.getElementById('movie-list');

	genreSelect.addEventListener('change', () => {
		const genre = genreSelect.value;
		const url = new URL(window.location.href);
		const params = new URLSearchParams(url.search);

		if (genre) {
			params.set('genre', genre);
		} else {
			params.delete('genre');
		}

		url.search = params.toString();
		window.history.pushState({}, '', url);

		fetch(`${window.location.origin}/wp-json/movies/v1/filter?genre=${genre}`)
		.then(response => response.json())
		.then(data => {
			movieList.innerHTML = data.map(movie => `
                    <a href="${movie.permalink}" class="archive-movie-template__card">
                        <div class="archive-movie-template__card-image">
                            <img src="${movie.thumbnail}" alt="${movie.title}">
                        </div>
                        <h2 class="archive-movie-template__card-title">${movie.title}</h2>
                        <div class="archive-movie-template__card-content">${movie.content}</div>
                    </a>
                `).join('');
		})
		.catch(error => console.error('Error fetching movies:', error));
	});

	// Check URL on load to pre-filter if genre param exists.
	const params = new URLSearchParams(window.location.search);
	if (params.has('genre')) {
		genreSelect.value = params.get('genre');
		genreSelect.dispatchEvent(new Event('change'));
	}
});