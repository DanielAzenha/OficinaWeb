
        document.addEventListener("DOMContentLoaded", function() {
            fetch("backend/get_servicos.php")
                .then(response => response.json())
                .then(data => {
                    let lista = document.getElementById("lista-servicos");
                    let select = document.getElementById("servico");
                    
                    lista.innerHTML = "";
                    select.innerHTML = "<option value='' disabled selected>Selecione um serviço</option>";
                    
                    if (!Array.isArray(data) || data.length === 0) {
                        lista.innerHTML = "<p>Nenhum serviço disponível no momento.</p>";
                        return;
                    }
                    
                    data.forEach(servico => {
                        let item = document.createElement("p");
                        item.textContent = servico.nome;
                        lista.appendChild(item);
                        
                        let option = document.createElement("option");
                        option.value = servico.id;
                        option.textContent = servico.nome;
                        select.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error("Erro ao carregar serviços:", error);
                    document.getElementById("lista-servicos").innerHTML = "<p>Erro ao carregar serviços.</p>";
                });
            
            document.getElementById("form-agendar").addEventListener("submit", function(event) {
                event.preventDefault();
                let formData = new FormData(this);
                
                fetch("backend/agendar.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => alert(data.mensagem))
                .catch(error => console.error("Erro ao agendar serviço:", error));
            });
        });
    