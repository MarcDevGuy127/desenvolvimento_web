FuncP();
function FuncP(i) {
    // Laço de repetição para criar os parágrafos
    for (let i = 1; i <= 10; i++) {
        // Criar o elemento parágrafo
        let p = document.createElement('p');

        // Verificar se o número é múltiplo de 3
        if (i % 3 === 0) {
            p.textContent = `Este é o parágrafo número ${i}.`;
            p.classList.add('multiplo-de-3'); // Adicionar a classe para destaque
        } else {
            p.textContent = `Este é o parágrafo número ${i}.`;
        }

        // Adicionar o parágrafo à página
        document.body.appendChild(p);
    }
}
//<button onclick="FuncP()">Click me</button>