document.addEventListener("DOMContentLoaded", () => {
    const moviesList = document.getElementById("movies-list");

    function logout() {
        localStorage.removeItem("user");
        window.location.href = "../index.html";
    }
    document.getElementById("logout-btn").addEventListener("click", logout);

    // Check if user is logged in, else redirect
    if (!localStorage.getItem("user")) {
        window.location.href = "login.html";
        return;
    }

    axios.get("http://localhost/backend/controllers/get_movies.php")
        .then(res => {
        const movies = res.data;
        if (!Array.isArray(movies)) {
            moviesList.textContent = "No movies available.";
            return;
        }

        movies.forEach(movie => {
            const div = document.createElement("div");
            div.classList.add("movie-card");

            const title = document.createElement("div");
            title.classList.add("movie-title");
            title.textContent = movie.title;

            const desc = document.createElement("div");
            desc.classList.add("movie-description");
            desc.textContent = movie.description;

            const genres = document.createElement("div");
            genres.classList.add("movie-genres");
            genres.textContent = "Genres: " + movie.genres.map(g => g.name).join(", ");

            const detailsLink = document.createElement("a");
            detailsLink.classList.add("movie-link");
            detailsLink.textContent = "View Details";
            detailsLink.href = `movie-details.html?id=${movie.id}`;

            div.appendChild(title);
            div.appendChild(desc);
            div.appendChild(genres);
            div.appendChild(detailsLink);

            moviesList.appendChild(div);
        });
        })
        .catch(err => {
        moviesList.textContent = "Failed to load movies.";
        console.error(err);
        });
});
