document.addEventListener("DOMContentLoaded", () => {
    const bookingsContainer = document.getElementById("bookings-container");

    document.getElementById("logout-btn").addEventListener("click", () => {
        localStorage.removeItem("user");
        window.location.href = "../index.html";
    });

    const user = JSON.parse(localStorage.getItem("user"));
    if (!user) {
        window.location.href = "login.html";
        return;
    }

    axios.get(`http://localhost/backend/controllers/get_user_bookings.php?user_id=${user.id}`)
        .then(res => {
        const bookings = res.data;
        if (bookings.length === 0) {
            bookingsContainer.textContent = "No bookings found.";
            return;
        }

        bookings.forEach(b => {
            const div = document.createElement("div");
            div.classList.add("booking-card");

            div.innerHTML = `
            <div><strong>Showtime ID:</strong> ${b.showtime_id}</div>
            <div><strong>Total:</strong> $${b.total_price}</div>
            <div><strong>Status:</strong> ${b.status}</div>
            <div><strong>Time:</strong> ${b.booking_time}</div>
            `;

            bookingsContainer.appendChild(div);
        });
        })
        .catch(err => {
        bookingsContainer.textContent = "Error loading bookings.";
        console.error(err);
        });
});
