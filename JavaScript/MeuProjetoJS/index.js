/*
Ex: var nomeVariavel = "conteudo";
tipos de variaveis no js
string -> texto(texto)
number -> numero(123)
number -> numero(7.5)
any/undefined -> indefinido(valor nao definido) <- nunca pode acontecer se acontecer vc errou no teu código! >:(
bool true false (booleano: verdadeiro e falso)

; -> fim de linha
, -> separador
operadores
= -> atribuicao
+ = concatenação/juntar Ex: console.log(1 + "1");

aritmeticos
+ -> soma
- -> subtracao
/ -> divisao
* -> multiplicacao
% -> MOD retorna o resto da divisão

coparadores
== -> comparador de igualdade
=== -> comparador de igualdade e tipo
> -> maior que
< -> menor que
>= -> maior ou igual a que
<= -> menor ou igual a que
&& -> e
|| -> ou
!= -> diferente de
ano % 400 == 00 ||
(ano % 4 == 0 && ano % 100 != 0)

Atv:
somadedoisvalores
var numX = 50;
var numY = 23;
function soma(numX,numY) {
    return numX + numY;
}
console.log("Função de Soma")
console.log(soma(numX,numY));*/

/*verificador par ou impar*/
var numero = 10;
  
function verificador(numero) {
    if (numero % 2 == 0) {
      console.log(numero + " é par!");  
    } else {
      console.log(numero + " não é par!");  
    }
    return numero;
}

console.log(verificador(numero));
/*inverter string*/
var numX = 50;
var numY = 23;
function soma(numX, numY) {
  return numX + numY;
}

console.log(numX + " + " + numY + " = " + soma(numX, numY));