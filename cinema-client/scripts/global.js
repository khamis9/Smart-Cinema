document.addEventListener("DOMContentLoaded", () => {
    const authLink = document.getElementById("auth-link");
    const user = JSON.parse(localStorage.getItem("user"));

    if (user && user.id) {
        authLink.innerHTML = `<a href="#">Logout</a>`;
        authLink.addEventListener("click", (e) => {
            e.preventDefault();
            localStorage.removeItem("user");
            location.reload();
        });
    } else {
        authLink.innerHTML = `<a href="pages/login.html">Login</a>`;
    }
});