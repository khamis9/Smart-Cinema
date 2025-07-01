document.addEventListener("DOMContentLoaded", () => {
    const user = JSON.parse(localStorage.getItem("user"));
    if (!user) {
        window.location.href = "login.html";
        return;
    }

    const nameInput = document.getElementById("name");
    const emailInput = document.getElementById("email");
    const phoneInput = document.getElementById("phone");
    const form = document.getElementById("profile-form");

    document.getElementById("logout-btn").addEventListener("click", () => {
        localStorage.removeItem("user");
        window.location.href = "../index.html";
    });

    // Load current profile
    axios.get(`http://localhost/backend/profile.php`)
        .then(res => {
        const data = res.data;
        nameInput.value = data.name;
        emailInput.value = data.email;
        phoneInput.value = data.phone;
        });

    // Update profile
    form.addEventListener("submit", e => {
        e.preventDefault();
        const body = {
        name: nameInput.value,
        email: emailInput.value,
        phone: phoneInput.value
        };

        axios.post("http://localhost/backend/profileUpdate.php", body)
        .then(() => alert("Profile updated."))
        .catch(err => {
            alert("Failed to update profile.");
            console.error(err);
        });
    });
});
