document.getElementById("signup-form").addEventListener("submit", function (e) {
    e.preventDefault();

    const data = {
        name: document.getElementById("name").value,
        email: document.getElementById("email").value,
        phone: document.getElementById("phone").value,
        password: document.getElementById("password").value
    };

    axios.post("http://localhost/cinema-server/controllers/register.php", data)
        .then(response => {
        alert(response.data.message);
        if (response.data.status === 200) {
            window.location.href = "login.html";
        }
        })
        .catch(error => {
        alert("Registration failed.");
        console.error(error);
        });
});
