//FnCalcular(); tudo aquilo q o user ingterage eu recebo como texto
FnCalcular();
function FnCalcular() {
    alert("Vamos calcular");
    var valorDigitado1 = prompt("Digite valor 1");
    var valorDigitado2 = prompt("Digite valor 2");
    var numX = Number(valorDigitado1);
    var numY = Number(valorDigitado2);
    var operacao = prompt("Digite o operador (+ - * /)");

    //console.log(valorDigitado1,valorDigitado2);  //var aceita qlqr coisa //let nao executa antes da declaracao //const nao altoriza alteracoes
    // console.log(numX, operacao, numY);

    switch (operacao) {
        case "+": FnSoma(numX, numY);
            break;
        case "-": FnSubtracao(numX, numY);
            break;
        case "*": FnMultiplicacao(numX, numY);
            break;
        case "/": FnDivisao(numX, numY);
            break;
        default:alert("Operação Inválida");
            break;
    }
    
    /**
     * if (operacao == "+") {
        FnSoma(numX,numY);
    } else if (operacao == "-") {
        FnSubtracao(numX,numY);
    } else if (operacao == "*") {
        FnMultiplicacao(numX,numY);
    } else if (operacao == "/") {
        FnDivisao(numX,numY);
    }
     */
}

//concatenar com string => console.log('Soma: ${resultado}');
function FnSoma(numX, numY) {
    var resultadoSoma = numX + numY;
    console.log(`Soma: ${resultadoSoma}`);
}
function FnSubtracao(numX, numY) {
    var resultadoSubtracao = numX - numY;
    console.log(`Subtracao: ${resultadoSubtracao}`);
}
function FnMultiplicacao(numX, numY) {
    var resultadoMultipl = numX * numY;
    console.log(`Multiplicacao: ${resultadoMultipl}`);
}
function FnDivisao(numX, numY) {
    var resultadoDivisao = numX / numY;
    console.log(`Divisao: ${resultadoDivisao}`);
}