// Função que processa as notas e presença
function FuncFormulario() {
    // Captura os valores dos campos
    let nome = parseFloat(document.getElementById('nome').value);
    let email = parseFloat(document.getElementById('email').value);
    let telefone = parseInt(document.getElementById('telefone').value);
    let aulas = parseInt(document.getElementById('termos').value);
    let checkbox = document.getElementById('termos');
    let p = document.createElement('p');
    if (checkbox.checked=false) {
        p.textContent = "Confirme os termos!";
    }

    // Adiciona o parágrafo ao corpo da página
    document.body.appendChild(p);
}   