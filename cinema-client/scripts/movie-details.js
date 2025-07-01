document.addEventListener("DOMContentLoaded", () => {
    const movieTitle = document.getElementById("movie-title");
    const movieDesc = document.getElementById("movie-description");
    const movieGenres = document.getElementById("movie-genres");
    const movieRelease = document.getElementById("movie-release-date");
    const movieRating = document.getElementById("movie-rating");
    const trailerContainer = document.getElementById("trailer-container");
    const showtimesBtn = document.getElementById("showtimes-btn");

    function logout() {
        localStorage.removeItem("user");
        window.location.href = "../index.html";
    }
    document.getElementById("logout-btn").addEventListener("click", logout);

    // Check login
    if (!localStorage.getItem("user")) {
        window.location.href = "login.html";
        return;
    }

    // Get movie id from URL
    const urlParams = new URLSearchParams(window.location.search);
    const movieId = urlParams.get("id");

    if (!movieId) {
        alert("Movie ID is missing.");
        window.location.href = "movies.html";
        return;
    }

    axios.get(`http://localhost/backend/controllers/get_movie.php?id=${movieId}`)
        .then(res => {
        const movie = res.data;
        movieTitle.textContent = movie.title;
        movieDesc.textContent = movie.description;
        movieGenres.textContent = movie.genres.map(g => g.name).join(", ");
        movieRelease.textContent = movie.release_date;
        movieRating.textContent = movie.rating;

        if (movie.trailer_url) {
            const embedUrl = convertYoutubeUrlToEmbed(movie.trailer_url);
            trailerContainer.innerHTML = `<iframe src="${embedUrl}" allowfullscreen></iframe>`;
        }
        })
        .catch(err => {
        alert("Failed to load movie details.");
        console.error(err);
        window.location.href = "movies.html";
        });

    showtimesBtn.addEventListener("click", () => {
        window.location.href = `showtimes.html?movie_id=${movieId}`;
    });

    function convertYoutubeUrlToEmbed(url) {
        if (!url) return "";
        const videoIdMatch = url.match(/(?:youtu\.be\/|youtube\.com\/watch\?v=)([^&]+)/);
        return videoIdMatch ? `https://www.youtube.com/embed/${videoIdMatch[1]}` : url;
    }
});
