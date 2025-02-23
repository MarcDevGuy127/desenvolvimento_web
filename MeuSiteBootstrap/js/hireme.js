document.getElementById("contact-form").addEventListener("submit", function(event) {
  event.preventDefault(); // Impede o comportamento padrão do formulário
  
  const successMessage = document.getElementById("success-message");
  
  // Exibe a notificação com animação de entrada
  successMessage.classList.remove("hide");
  successMessage.classList.add("show");
  successMessage.style.display = "block"; // Torna visível
  
  // Esconde a notificação com animação de saída após 3 segundos
  setTimeout(() => {
    successMessage.classList.remove("show");
    successMessage.classList.add("hide");
  }, 3000);
});

/**
 * 
 * const savedTheme = localStorage.getItem("theme");
if (savedTheme) {
  updateBlurredCardBackground(savedTheme); // Atualiza o fundo do card
}
themeToggleButton.addEventListener("click", function () {
  const currentTheme = body.getAttribute("data-bs-theme");
  const newTheme = currentTheme === "dark" ? "white" : "dark";

  body.setAttribute("data-bs-theme", newTheme);
  updateBlurredCardBackground(newTheme); // Atualiza o fundo do card
});
 * *Botão para trocar tema *
document.getElementById("theme-toggle").addEventListener("click", function() {
  const body = document.body;
  
  // Alterna entre as classes 'dark-mode' e 'white-mode'
  if (body.classList.contains("dark")) {
    body.classList.remove("dark");
    body.classList.add("white");
    this.innerHTML = '<i class="bi bi-moon"></i> Modo Escuro'; // Ícone de Lua para o modo escuro
  } else {
    body.classList.remove("white");
    body.classList.add("dark");
    this.innerHTML = '<i class="bi bi-sun"></i> Modo Claro'; // Ícone de Sol para o modo claro
  }

  // Armazena a escolha do usuário no localStorage
  localStorage.setItem("theme", body.classList.contains("dark") ? "dark" : "white");
});

// Ao carregar a página, verificar a preferência do usuário
window.addEventListener("load", function() {
  const savedTheme = localStorage.getItem("theme");

  if (savedTheme === "dark") {
    document.body.classList.add("dark");
    document.getElementById("theme-toggle").innerHTML = '<i class="bi bi-sun"></i> Modo Claro'; // Ícone de Sol para o modo claro
  } else {
    document.body.classList.add("white");
    document.getElementById("theme-toggle").innerHTML = '<i class="bi bi-moon"></i> Modo Escuro'; // Ícone de Lua para o modo escuro
  }
});
 */

//alterando cor do card de acordo com o tema do site
document.addEventListener("DOMContentLoaded", function() {
  const blurredCard = document.getElementById("blurred-card");
  const themeToggleButton = document.getElementById("theme-toggle");

  // Função para atualizar o fundo do card
  function updateCardBackground(theme) {
    if (theme === "dark") {
      blurredCard.style.background = "rgba(41, 41, 41, 0.338)"; // Fundo escuro
    } else {
      blurredCard.style.background = "rgba(255, 255, 255, 0.338)"; // Fundo claro
    }
  }

  // Verifica o tema salvo no localStorage
  let savedTheme = localStorage.getItem("theme");
  if (savedTheme === null) {
    savedTheme = "white"; // Define o tema inicial como claro se não houver preferência salva
  }

  // Atualiza o fundo do card com o tema salvo
  updateCardBackground(savedTheme);

  // Atualiza o texto do botão com base no tema
  themeToggleButton.innerHTML = savedTheme === "dark" ? '<i class="bi bi-sun"></i> Modo Claro' : '<i class="bi bi-moon"></i> Modo Escuro';

  // Evento de clique para alternar o tema
  themeToggleButton.addEventListener("click", function() {
    // Alterna o tema
    const newTheme = savedTheme === "dark" ? "white" : "dark";

    // Atualiza o tema no localStorage
    localStorage.setItem("theme", newTheme);

    // Atualiza o fundo do card
    updateCardBackground(newTheme);

    // Atualiza o texto do botão
    themeToggleButton.innerHTML = newTheme === "dark" ? '<i class="bi bi-sun"></i> Modo Claro' : '<i class="bi bi-moon"></i> Modo Escuro';

    // Atualiza o tema salvo
    savedTheme = newTheme;
  });
});
