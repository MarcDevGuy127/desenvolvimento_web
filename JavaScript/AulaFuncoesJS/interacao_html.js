/**seleciona um elemento, se tiver mais de um ele selecionará apenas o primeiro elemento encontrado.
 * retorna um item , caso não encontre retorna nulo*/
var elemento = document.querySelector("#div-1");
if (elemento != null) {
    //elemento encontrado
    //tag com conteudo
    //\n para texto <br/> para html
    elemento.innerHTML = "TEXTO<br/> VIA JS";
    //INPUTS
    //altera valor do input
    elemento.value = "TEXTO VIA JS";
} else {
    //elemento não encontrado
}
//seleciona todos os elementos
/** cONCATENAR +=
 * IGUAL =
 * retorna sempre array
 */

function Salvar() {
    var txtNome = document.querySelector("#txtNome");
    var txtIdade = document.querySelector("#txtIdade");
    var txtEmail = document.querySelector("#txtEmail");
    var txtNomeUsuario = document.querySelector("#txtNomeUsuario");
    txtNome.classList.remove("input-vazio");
    txtIdade.classList.remove("input-vazio");
    txtEmail.classList.remove("input-vazio");
    txtNomeUsuario.classList.remove("input-vazio");
    if (txtNome.value == "") {
        alert("Campo Nome vazio");
        txtNome.focus();
        return;
    }
    if (txtIdade.value == "") {
        alert("Campo Idade vazio");
        txtIdade.focus();
        return;
    }
    if (txtEmail.value == "") {
        alert("Campo Email vazio");
        txtEmail.focus();
        return;
    }
    if (txtNomeUsuario.value == "") {
        alert("Campo NomeUsuario vazio");
        txtNomeUsuario.focus();
        return;
    }
    alert("Informações salvas com sucesso!")
}

function tbAdd() {
    const alunoRa = document.querySelector("#txtAlunoRa");
    const alunoNome = document.querySelector("#txtAlunoNome");
    const alunoTurma = document.querySelector("#txtAlunoTurma");
    const tbBody = document.querySelector("#tb-alunos tbody");
    tbBody.innerHTML += `<tr>
                        <td>${alunoRa.value}</td>
                        <td>${alunoNome.value}</td>
                        <td>${alunoTurma.value}</td>
                        </tr>`;
    alunoRa.value = "";
    alunoNome.value = "";
    alunoTurma.value = "";
/**    const tbBody = document.querySelector("#tb-alunos tbody");
    tbBody.innerHTML += `<tr>
                        <td>ID</td>
                        <td>Nome</td>
                        <td>Idade</td>
                        </tr>`;
 */
}
function tbLimpar() {
    tbBody = document.querySelector("#tb-alunos tbody");
    tbBody.innerHTML = "";
}