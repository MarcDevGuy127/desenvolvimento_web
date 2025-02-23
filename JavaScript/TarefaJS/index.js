obterValor() //concluido
function obterValor() {
    let valor = prompt("Por favor, insira um valor:");
    let divResultado = document.getElementById("resultado");
    let numero = parseInt(valor);
    if (numero >= 1 && numero <= 10) {
        let tabuadaHTML = `<h3>Tabuada do ${numero}:</h3><ul>`;
        for (let i = 1; i <= 10; i++) {
            tabuadaHTML += `<li>${numero} x ${i} = ${numero * i}</li>`;
        }
        tabuadaHTML += "</ul>";
        divResultado.innerHTML = tabuadaHTML;
    } else {
        divResultado.innerHTML = "Valor inválido, informe entre 1 e 10.";
    }
}
//imcompleto
NumerosArray();
function NumerosArray() {
    let varNumeros = [10, 9];
    let i = 0;
    let soma = 0;
    let pars = [];
    let impars = [];
    let maiorNumero = varNumeros[0];
    let menorNumero = varNumeros[0];
    while (i < varNumeros.length) {
        soma += varNumeros[i];
        if (varNumeros[i] > maiorNumero) {
            maiorNumero = varNumeros[i];
        }
        if (varNumeros[i] < menorNumero) {
            maiorNumero = varNumeros[i];
        }
        if (varNumeros[i] % 2 == 0) {
            pars.push(varNumeros[i]);
        }else{
            impars.push(varNumeros[i]);
        }
        console.log(varNumeros[i]);
        i++;
    }
    console.log("Qntde de Números:", varNumeros.length);
    console.log("Pares: ", pars)
    console.log("Impares: ", impars)
    console.log("Maior:", maiorNumero);
    console.log("Menor:", menorNumero);
    console.log("Média:", soma / varNumeros.length);
    console.log("Soma:", soma);
}