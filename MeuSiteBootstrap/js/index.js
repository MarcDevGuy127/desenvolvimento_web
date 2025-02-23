// Função para adicionar cabeçalho
function addCabecalho(elemento) {
  // Encontrar o elemento com o ID 'cabecalho'
  const cabecalho = document.getElementById('cabecalho');

  // Inserir o conteúdo dentro desse elemento
  cabecalho.innerHTML = elemento;
}

addCabecalho(`
  <head>
    <meta charset="utf-8">
    <meta name="viewport">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--Linha de comando para funcionar bootstrap-->
    <link rel="stylesheet" type="text/css" href="/styles/index.css" media="screen" />
  </head>
  <header>
    <nav class="navbar">
      <div class="container-fluid">
        <a class="navbar-brand" href="/index.html">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-github"
            viewBox="0 0 16 16">
            <path
              d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8" />
          </svg>
          MarcDevGuy127
        </a>
        <div class="divid">
          <ul>
            <li><a href="/index.html">Home</a></li>
            <li><a href="/projects.html">My Projects</a></li>
            <li><a href="/curriculum.html">Curriculum</a></li>
            <li><a href="/hireme.html">Hire Me</a></li>
            <li><a href="/test.html">Test Page</a></li>
          </ul>
        </div>
        <li class="nav-item dropdown"><!--Dropdown Botao-->
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Social Media
            </a>
            <ul class="dropdown-menu"><!--Botao Nome Negrito-->
              <li><a class="dropdown-item" href="#">Gmail</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="https://discord.com">Discord</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><ion-icon name="logo-linkedin"></ion-icon><a class="dropdown-item" href="https://www.linkedin.com/in/marcelo-henrique-costa-da-silva-723497225/">Linkedin</a></li>
            </ul>
        </li>
        <form class="d-flex" role="search">
          <input class="form-control-me 2" id="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </nav>
  </header>
`);

//redefinir os html usando a mesma estrutura do index

/**
 * //função que muda o atributo data-bs-theme para white/dark no body
document.addEventListener("DOMContentLoaded", function() {
  document.body.setAttribute("data-bs-theme", "white");
});
 */

//Código do botão para trocar tema do site
document.addEventListener("DOMContentLoaded", function () {
  // Define o tema padrão como "white" ao carregar a página
  const body = document.body;
  const themeToggleButton = document.getElementById("theme-toggle");

  // Define o atributo inicial
  body.setAttribute("data-bs-theme", "white");

  // Verifica se há uma preferência salva no localStorage
  const savedTheme = localStorage.getItem("theme");
  if (savedTheme) {
    body.setAttribute("data-bs-theme", savedTheme);
    themeToggleButton.innerHTML =
      savedTheme === "dark"
        ? '<i class="bi bi-sun"></i>'
        : '<i class="bi bi-moon"></i>';
  }
/**  Lado A do botão
 * newTheme === "dark"
 *      ? '<i class="bi bi-sun"></i> Modo Claro'
        : '<i class="bi bi-moon"></i> Modo Escuro';
 */
  // Adiciona o evento de clique ao botão
  themeToggleButton.addEventListener("click", function () {
    const currentTheme = body.getAttribute("data-bs-theme");
    const newTheme = currentTheme === "dark" ? "white" : "dark";

    // Alterna o atributo data-bs-theme
    body.setAttribute("data-bs-theme", newTheme);

    // Atualiza o texto e ícone do botão
    this.innerHTML =
      newTheme === "dark"
        ? '<i class="bi bi-sun"></i>'
        : '<i class="bi bi-moon"></i>';
/**  Lado B do botão
 * newTheme === "dark"
 *      ? '<i class="bi bi-sun"></i> Modo Claro'
        : '<i class="bi bi-moon"></i> Modo Escuro';
 */
    // Salva a preferência no localStorage
    localStorage.setItem("theme", newTheme);
  });
});


function addFooter(elemento) {
  const footer = document.getElementById('footer');

  footer.innerHTML = elemento;
}

addFooter(`
  <footer class="bg-dark text-light py-5">
        <div class="container">
          <div class="row">
            <!-- Coluna 1: Sobre mim -->
            <div class="col-lg-4 mb-4">
              <div class="line-footer">
                <h3 class="mb-3">Sobre Mim</h3>
              </div>
              <img src="/images/selfie.jpg" alt="Minha Foto" class="img-fluid rounded-circle mb-3" style="width: 200px; height: 200px; object-fit: cover;">
              <p>
                Olá! Sou Marcelo Henrique, desenvolvedor Back-end focado na programação e criação de soluções inovadoras 
                com base nos meus conhecimentos técnicos. Confira o meu portfólio e entre em contato!
              </p>
            </div>
      
            <!-- Coluna 2: Navegação -->
            <div class="col-lg-4 mb-4">
              <div class="line-footer">
                <h5 class="mb-3">Navegação</h5>
              </div>
              <ul id="nav-footer">
                <li><span><a href="/index.html" class="text-light text-decoration-none">Home</a></span></li>
                <li><span><a href="/projects.html" class="text-light text-decoration-none">My Projects</a></span></li>
                <li><span><a href="/curriculum.html" class="text-light text-decoration-none">Curriculum</a></span></li>
                <li><span><a href="/hireme.html" class="text-light text-decoration-none">Hire Me</a></span></li>
                <li><span><a href="/test.html" class="text-light text-decoration-none">Test Page</a></span></li>
              </ul>
            </div>
      
            <!-- Coluna 3: Redes Sociais -->
            <div class="col-lg-4">
              <div class="line-footer">
                <h5 class="mb-3">Redes Sociais</h5>
              </div>
              <div>
                <a href="https://github.com/MarcDevGuy127" class="text-light me-3 fs-4"><i class="bi bi-github"></i></a>
                <a href="www.linkedin.com/in/marcelo-henrique-costa-da-silva-723497225" class="text-light me-3 fs-4"><i class="bi bi-linkedin"></i></a>
                <a href="#" class="text-light me-3 fs-4"><i class="bi bi-twitter"></i></a>
              </div>
              <p class="mt-3">
                <i class="bi bi-envelope"></i> <a href="mailto:marceloh.github@gmail.com" class="text-light text-decoration-none">marceloh.github@gmail.com</a>
              </p>
            </div>
          </div>
          
          <!-- Linha de separação -->
          <hr class="border-light my-4">
      
          <!-- Rodapé -->
          <div class="text-center">
            <p id="copyright-footer" class="mb-0">© 2025 Marcelo Henrique. Desenvolvido com ❤️ e criatividade.</p>
          </div>
        </div>
      </footer>
`);