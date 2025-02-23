var media = 7;
var mediaMinAprovacao = 7.0;
var percentaulPresenca = 75;
var presencaMinAprovacao = 75;

if (media >= mediaMinAprovacao) {
    console.log("Aprovado");
}

if (media >= mediaMinAprovacao) {
    console.log("Aprovado");
} else {
    console.log("Reprovado");
}

if (media < mediaMinAprovacao) {
    console.log("Reprovado por nota");
}

else if (percentaulPresenca < presencaMinAprovacao) {
    console.log("Reprovado por falta");
}
else {
    console.log("Aprovado");
}