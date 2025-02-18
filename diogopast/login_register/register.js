document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("register-form").addEventListener("submit", function (event) {
        event.preventDefault();

        let formData = new FormData(this);

        fetch("backend/register.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.sucesso) {
                alert("Registro concluído! Agora faça login.");
                window.location.href = "login.html";
            } else {
                document.getElementById("mensagem-registro").textContent = data.mensagem;
            }
        })
        .catch(error => console.error("Erro ao registrar:", error));
    });
});
