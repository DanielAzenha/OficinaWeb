document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("agendar-form");

    form.addEventListener("submit", function (event) {
        event.preventDefault();

        const nome = document.getElementById("nome").value;
        const telefone = document.getElementById("telefone").value;
        const servico = document.getElementById("servico").value;
        const data = document.getElementById("data").value;

        if (!nome || !telefone || !servico || !data) {
            alert("Por favor, preencha todos os campos.");
            return;
        }

        alert(`Agendamento confirmado!\nNome: ${nome}\nTelefone: ${telefone}\nServiço: ${servico}\nData: ${data}`);
        form.reset();
    });
});
