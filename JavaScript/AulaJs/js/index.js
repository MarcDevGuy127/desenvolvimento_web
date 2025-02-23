//comentario js uma linha
/*comentario 
js mais de 
uma linha

//diferenca entre grid e flex 
flex = adapta a fatia do site (escorrega o elemento para cima ou para baixo)
grid = o site é cortado em fatias

função: cloco de código com uma fenalidade específica que pode ser reaproveitada, quanto menor a responsabilidade da função é melhor...

var -> cria variavel
= -> atribui valor da variavel
"" -> define um texto
Ex: var nomeVariavel = "conteudo";
0tipos de variaveis no js
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
somadasnotas
media
*/
var nomeAluno = "Marcelo";
var nota1Bim = 7.5;
var nota2Bim = 5.7;
var somaNota = nota1Bim + nota2Bim;
var mediaNota = somaNota / 2;
var situacaoAluno = true;
console.log("Hello World");
console.log("Nome do Aluno:" + nomeAluno);
console.log("Nota 1° Bim:", nota1Bim);
console.log("Nota 2° Bim:", nota2Bim);
console.log("Média:", mediaNota);
if (mediaNota >= 7 && mediaNota <=10) {
    situacaoAluno = true;
    console.log("Aprovado");
} else {
    situacaoAluno = false;
    console.log("Reprovado");
}