/*função de validação(Tentar usar jquery)*/
function validar() {
    let nome = document.getElementById("nome").value.trim();
    let preco = parseFloat(document.getElementById("preco").value);
    let quantidade = parseInt(document.getElementById("quantidade").value);

    if (nome === "") {
        alert("O nome é Obrigatorio");
        return false;
    }
    if (isNaN(preco) || preco <= 0) {
        alert("O preco deve ser maior que 0");
        return false;
    }
    if (isNaN(quantidade) || quantidade < 0) {
        alert("A quantidade não pode ser negativa");
        return false;
    }
    return true;
}
