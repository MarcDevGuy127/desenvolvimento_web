let texto = "Marcelo"; //string
let valor = 123.45; //number
let aprovado = true; //boolean

let arrayVazio = [];
arrayVazio = 123;
console.log(arrayVazio);

//ARRAY 1 DIMENSAO - VETOR
//SINTAXE ARRAY É DEFINIDO POR []
let diasSemana = ["DOM", "SEG", "TER", "QUA", "QUI", "SEX", "SAB"];
console.log("1° DIA: ", diasSemana[0]);
console.log("2° DIA: ", diasSemana[1]);
console.log("3° DIA: ", diasSemana[2]);
console.log("4° DIA: ", diasSemana[3]);
console.log("5° DIA: ", diasSemana[4]);
console.log("6° DIA: ", diasSemana[5]);
console.log("7° DIA: ", diasSemana[6]);

let indice = 0;
let seqDia = 1;
while (indice < diasSemana.length) {
    //debugger;
    //console.log(indice);
    console.log(`${seqDia}º dia: ${diasSemana[indice]}`);
    indice = indice + 1;
    seqDia = seqDia + 1;

}


//criar uma funçao EscreverTabuada
//a funcao deve receber por parametro
//o numero da tabuada
//escrever na tela uma linha para cada resultado
EscreverTabuada(1);
function EscreverTabuada(num) {
    let i = 1;
    while (num >= 1 && i <= 10) {
        console.log(`${num}* ${i}: ${num * i}`);
        i++;
    }
}

//for(inicio;condicao;incremento)
for (let i = 1; i < 10; i++){
    console.log(`${num}* ${i}: ${num * i}`);
}

FnDoisParam(1, 10);
function FnDoisParam(inicio, fim) {
    if (fim < inicio) {
        console.error("Erro");
    }
    while (inicio <= fim) {
        if (inicio % 2 == 0) {
            console.log(inicio);
        }
        inicio++;
    }

}
NumerosArray();
function NumerosArray() {
    let varNum = [2, 7, 6, 5, 5, 44, 3, 234, 4, 56];

    console.log(varNum);

    let i = 0;
    while (i < varNum.length) {
        console.log(varNum[i]);
        i++;
    }
}
NotasArray();
function NotasArray() {
    let varNotas = [10, 9];
    let i = 0;
    let soma = 0;
    let pars = [];
    let divisivelPCinco = [];
    let maiorNumero = varNotas[0];
    let menorNumero = varNotas[0];
    while (i < varNotas.length) {
        soma += varNotas[i];
        if (varNotas[i] > maiorNumero) {
            maiorNumero = varNotas[i];
        }
        if (varNotas[i] < menorNumero) {
            maiorNumero = varNotas[i];
        }
        if (varNotas[i] % 2 == 0) {
            pars.push(varNotas[i]);
        }
        if (varNotas[i] % 5 == 0) {
            pars.push(divisivelPCinco[i]);
        }
        console.log(varNotas[i]);
        i++;
    }
    console.log("Pares: ", pars)
    console.log("Divisivel por 5: ",divisivelPCinco);
    console.log("Maior:", maiorNumero);
    console.log("Menor:", menorNumero);
    console.log("Soma:", soma);
    console.log("Média:", soma / varNotas.length);
}