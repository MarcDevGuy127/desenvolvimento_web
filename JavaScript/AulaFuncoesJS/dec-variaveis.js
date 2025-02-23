const variavelCONST = "valor fixo";
console.log(variavelCONST);
//vetor=é uma variavel que armazena mais de um valor
FnTesteVar();
FnTesteLet();
//hoisting
nomeVariavel = 123;
console.log(nomeVariavel);//123
//declarar variaveis

let variavelNome = "nova variavel";
console.log(variavelNome);

function FnTesteVar() {
    var nomeVariavelVAR = "conteudo 123";
    console.log(nomeVariavelVAR);   
}

function FnTesteLet() {
   var nomeVariavelLET = 144;
   console.log(nomeVariavelLET); 
}