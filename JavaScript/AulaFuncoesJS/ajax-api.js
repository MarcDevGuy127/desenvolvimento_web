/**
 * AJAX
 * Chama HTTP assincrona
 * 
 * API - Interface de programação
 * 
 * JSON - formato de arquivo
 *      - Objeto javascript
 */
let nome = "marc";
console.log(typeof (nome), nome); // exibe string

let nota = 34;
console.log(typeof (nota), nota); // exibe number

let situacao = false;
console.log(typeof (situacao), situacao); // exibe boolean

// array agrupa conteúdos do mesmo tipo
let numerosMega = [3, 13, 20, 35, 51, 55];
/**
 *  
 // bloco de código
 {
     let nome = "marc";
 }
 
 */
// função
/**
 * function teste() {
    // bloco de código
    let nome = "marc";
}
 */

// objeto - várias características na mesma variável
let aluno = {
    nome: "marc",
    ra: "123",
    turma: "A",
    notas: [9.0, 8.9]
};
console.log(typeof (aluno), aluno); // exibe object

// função para mostrar dados do aluno
function MostrarDadosAluno(aluno) {
    console.log(aluno.ra);
    console.log(aluno.nome);
}

document.querySelector("#div_html");
// inicia carregamento
axios.get('https://brasilapi.com.br/api/cep/v2/83322140')
    .then(function (response) {
        console.log("status https:", response.status);
        console.log(response.data);
        // parar loading;
        const cepinfo = response.data;
        divcep.innerHtml = ${cepinfo.cep}
        Rua ${cepinfo.street}
    })
    .catch(function (error) {
        // handle error
        console.log(error);
        // parar loading;
    })
    .finally(function () { // finally executa mesmo errado ou certo
        // always executed
    });

var teste = "";