/*Aba da pesquisa*/
let campo = document.getElementById("pesquisa");

if (campo) {
    campo.addEventListener("keyup", function() {
        let filtro = this.value.toLowerCase();
        let linhas = document.querySelectorAll("table tr");

        linhas.forEach(function(linha, index) {
            if (index === 0) return;
            let nome = linha.cells[1].innerText.toLowerCase();
            linha.style.display = nome.includes(filtro) ? "" : "none";
        });
    });
}

/* função de validação do nome , preço, quantidade*/
function validar() {
    let nome = document.getElementById("nome").value.trim();
    let preco = parseFloat(document.getElementById("preco").value);
    let quantidade = parseInt(document.getElementById("quantidade").value);

    if (nome === "") {
        alert("O nome é obrigatório");
        return false;
    }
    if (isNaN(preco) || preco <= 0) {
        alert("O preço deve ser maior que 0");
        return false;
    }
    if (isNaN(quantidade) || quantidade < 0) {
        alert("A quantidade não pode ser negativa");
        return false;
    }
    return true;
}

