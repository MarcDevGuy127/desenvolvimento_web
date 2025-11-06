function validarSenha(event) {
    const senha = document.getElementById("senha").value;

    // expressão regular: 8 a 12 caracteres, com maiúscula, minúscula, número e caractere especial
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,12}$/;

    if (!regex.test(senha)) {
        alert("A senha deve ter entre 8 e 12 caracteres e conter:\n- Letras maiúsculas\n- Letras minúsculas\n- Números\n- Caracteres especiais");
        event.preventDefault(); // impede o envio do formulário
        return false;
    }

    // caso passe na validação, o form pode ser enviado
    alert("Senha OK!");
    return true;
}