document.getElementById("login-form").addEventListener("submit", function (e) {
    e.preventDefault();

    const data = {
        email: document.getElementById("email").value,
        password: document.getElementById("password").value
    };

    axios.post("http://localhost/cinema-server/controllers/login.php", data)
        .then(response => {
        if (response.data.status === 200) {
            localStorage.setItem("user", JSON.stringify(response.data.user));
            alert("Login successful");
            window.location.href = "../index.html";
        } else {
            alert(response.data.message);
        }
        })
        .catch(error => {
        alert("Login failed.");
        console.error(error);
        });
});
