//sintaxe função
//PascalCase: Funcoes e Objetos
//ComeceMaiusculoAlternaCaseNovaPalavra

//camelCase: variaveis e parametros
// comeceMaiusculoAlternaCaseNovaPalavra

/*
Função: bloco de código
com uma finalidade específica
Que pode ser reaproveitado
*/
/*regra de negócio encapsulada = você sabe o que ele vai fazer, mas não sabe como ele vai fazer*/
//function: define a função
/*
    ()//receber parâmetros
    {//define início do bloco
        //código
    }//define fim do bloco
*/
function FnCalculaMedia(nomeAluno) {
    var nota1Bim = 7.5;
    var nota2Bim = 5.7;
    var somaNota = nota1Bim + nota2Bim;
    var mediaNota = somaNota / 2;
    var situacaoAluno = true;
    if (mediaNota >= 7 && mediaNota <=10) {
        situacaoAluno = true;
        console.log("Aprovado");
    } else {
        situacaoAluno = false;
        console.log("Reprovado");
    }
    console.log("Hello World");
    console.log("Nome do Aluno:" + nomeAluno);
    console.log("Nota 1° Bim:", nota1Bim);
    console.log("Nota 2° Bim:", nota2Bim);
    console.log("Média:", mediaNota);
}