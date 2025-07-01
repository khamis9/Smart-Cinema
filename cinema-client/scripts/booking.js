document.addEventListener("DOMContentLoaded", () => {
    const seatsContainer = document.getElementById("seats-container");
    const snacksContainer = document.getElementById("snacks-container");
    const totalPriceSpan = document.getElementById("total-price");
    const confirmBookingBtn = document.getElementById("confirm-booking-btn");

    function logout() {
        localStorage.removeItem("user");
        window.location.href = "../index.html";
    }
    document.getElementById("logout-btn").addEventListener("click", logout);

    if (!localStorage.getItem("user")) {
        window.location.href = "login.html";
        return;
    }

    const urlParams = new URLSearchParams(window.location.search);
    const showtimeId = urlParams.get("showtime_id");

    if (!showtimeId) {
        alert("Showtime ID missing.");
        window.location.href = "movies.html";
        return;
    }

    let selectedSeats = new Set();
    let selectedSnacks = new Map(); // snackId -> quantity

    let snacksData = [];

    function calculateTotal() {
        let total = 0;
        total += selectedSeats.size * 10; // Assume seat price = $10 fixed for simplicity

        selectedSnacks.forEach((qty, snackId) => {
        const snack = snacksData.find(s => s.id == snackId);
        if (snack) total += snack.price * qty;
        });

        totalPriceSpan.textContent = total.toFixed(2);
    }

    // Load seats for showtime
    axios.get(`http://localhost/backend/controllers/get_seats.php?showtime_id=${showtimeId}`)
        .then(res => {
        seatsContainer.innerHTML = "";
        const seats = res.data;
        if (!Array.isArray(seats) || seats.length === 0) {
            seatsContainer.textContent = "No seats available.";
            return;
        }

        seats.forEach(seat => {
            const seatEl = document.createElement("div");
            seatEl.classList.add("seat");
            if (seat.status !== "available") seatEl.style.opacity = "0.4";
            seatEl.textContent = `${seat.row_number}${seat.seat_number}`;
            if (seat.status === "available") {
            seatEl.addEventListener("click", () => {
                if (selectedSeats.has(seat.id)) {
                selectedSeats.delete(seat.id);
                seatEl.classList.remove("selected");
                } else {
                selectedSeats.add(seat.id);
                seatEl.classList.add("selected");
                }
                calculateTotal();
            });
            }
            seatsContainer.appendChild(seatEl);
        });
        })
        .catch(err => {
        seatsContainer.textContent = "Failed to load seats.";
        console.error(err);
        });

    // Load snacks
    axios.get("http://localhost/backend/controllers/get_snacks.php")
        .then(res => {
        snacksContainer.innerHTML = "";
        snacksData = res.data;
        if (!Array.isArray(snacksData) || snacksData.length === 0) {
            snacksContainer.textContent = "No snacks available.";
            return;
        }

        snacksData.forEach(snack => {
            const div = document.createElement("div");
            div.classList.add("snack-item");

            const checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.id = `snack-${snack.id}`;
            checkbox.addEventListener("change", () => {
            if (checkbox.checked) {
                selectedSnacks.set(snack.id, 1);
                quantityInput.disabled = false;
                quantityInput.value = 1;
            } else {
                selectedSnacks.delete(snack.id);
                quantityInput.disabled = true;
                quantityInput.value = 0;
            }
            calculateTotal();
            });

            const label = document.createElement("label");
            label.htmlFor = checkbox.id;
            label.textContent = `${snack.name} ($${snack.price.toFixed(2)})`;

            const quantityInput = document.createElement("input");
            quantityInput.type = "number";
            quantityInput.min = 1;
            quantityInput.value = 0;
            quantityInput.disabled = true;
            quantityInput.style.width = "50px";
            quantityInput.addEventListener("input", () => {
            const val = parseInt(quantityInput.value) || 1;
            selectedSnacks.set(snack.id, val);
            calculateTotal();
            });

            div.appendChild(checkbox);
            div.appendChild(label);
            div.appendChild(quantityInput);

            snacksContainer.appendChild(div);
        });
        })
        .catch(err => {
        snacksContainer.textContent = "Failed to load snacks.";
        console.error(err);
        });

    confirmBookingBtn.addEventListener("click", () => {
        if (selectedSeats.size === 0) {
        alert("Please select at least one seat.");
        return;
        }

        // Prepare booking data
        const bookingData = {
        user_id: JSON.parse(localStorage.getItem("user")).id,
        showtime_id: parseInt(showtimeId),
        seats: Array.from(selectedSeats),
        snacks: Array.from(selectedSnacks.entries()),
        };

        axios.post("http://localhost/backend/controllers/confirm_booking.php", bookingData)
    .then(res => {
        alert("Booking successful!");
        window.location.href = "bookings.html";
    })
    .catch(err => {
        alert("Failed to confirm booking.");
        console.error(err);
    });
    });
});