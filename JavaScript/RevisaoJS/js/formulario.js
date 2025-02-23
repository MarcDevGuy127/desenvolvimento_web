// Função que processa as notas e presença
function FuncMedia() {
    // Captura os valores dos campos
    let nota1 = parseFloat(document.getElementById('nota1').value);
    let nota2 = parseFloat(document.getElementById('nota2').value);
    let faltas = parseInt(document.getElementById('faltas').value);
    let aulas = parseInt(document.getElementById('aulas').value);

    // Calcula a média das notas
    let mediaNotas = (nota1 + nota2) / 2;

    // Calcula o percentual de presença
    let calcPresenca = (faltas / aulas) * 100;

    // Cria o parágrafo para mostrar o resultado
    let p = document.createElement('p');

    // Lógica para determinar se o aluno foi aprovado ou reprovado
    if (calcPresenca < 7.5 && mediaNotas >= 7) {
        p.textContent = "Reprovado por falta, percentual de presença abaixo de 75%.";
        p.classList.add('reprovado');
    } else if (calcPresenca <= 7.5 && mediaNotas < 7) {
        p.classList.add('reprovado');
        p.textContent = "Reprovado, média menor que 7.0.";
    } else if (calcPresenca >= 7.5 && mediaNotas >= 7) {
        p.classList.add('aprovado');
        p.textContent = "Aprovado, média maior ou igual 7.0 e percentual de presença maior ou igual 75%.";
    }

    // Adiciona o parágrafo ao corpo da página
    document.body.appendChild(p);
}