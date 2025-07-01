document.addEventListener("DOMContentLoaded", () => {
    const showtimesList = document.getElementById("showtimes-list");

    function logout() {
        localStorage.removeItem("user");
        window.location.href = "../index.html";
    }
    document.getElementById("logout-btn").addEventListener("click", logout);

    if (!localStorage.getItem("user")) {
        window.location.href = "login.html";
        return;
    }

    // Get movie id from URL params
    const urlParams = new URLSearchParams(window.location.search);
    const movieId = urlParams.get("movie_id");

    if (!movieId) {
        alert("Movie ID missing.");
        window.location.href = "movies.html";
        return;
    }

    axios.get(`http://localhost/backend/controllers/get_showtimes.php?movie_id=${movieId}`)
        .then(res => {
        const showtimes = res.data;
        if (!Array.isArray(showtimes) || showtimes.length === 0) {
            showtimesList.textContent = "No showtimes available.";
            return;
        }

        showtimes.forEach(showtime => {
            const div = document.createElement("div");
            div.classList.add("showtime-item");

            div.innerHTML = `
            <div>Screen: ${showtime.screen_id}</div>
            <div>Start Time: ${new Date(showtime.start_time).toLocaleString()}</div>
            `;

            const bookBtn = document.createElement("button");
            bookBtn.textContent = "Book Seats";
            bookBtn.addEventListener("click", () => {
            window.location.href = `booking.html?showtime_id=${showtime.id}`;
            });

            div.appendChild(bookBtn);
            showtimesList.appendChild(div);
        });
        })
        .catch(err => {
        showtimesList.textContent = "Failed to load showtimes.";
        console.error(err);
        });
});
