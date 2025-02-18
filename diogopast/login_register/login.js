document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("login-form").addEventListener("submit", function (event) {
        event.preventDefault();

        let formData = new FormData(this);

        fetch("backend/login.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.sucesso) {
                window.location.href = "dashboard.html"; // Redireciona após login bem-sucedido
            } else {
                document.getElementById("mensagem-erro").textContent = "Usuário ou senha incorretos.";
            }
        })
        .catch(error => console.error("Erro ao processar login:", error));
    });
});
