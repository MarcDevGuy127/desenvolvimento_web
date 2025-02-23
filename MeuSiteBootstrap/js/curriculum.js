// Função para alternar a exibição do card ao clicar no título
function toggleCard(cardId) {
    const card = document.getElementById(cardId);

    // Verifica se o card está visível ou não
    if (card.classList.contains('show')) {
        card.classList.remove('show');  // Se estiver visível, oculta
    } else {
        // Fecha qualquer outro card aberto antes de abrir o novo
        const allCards = document.querySelectorAll('.card');
        allCards.forEach(c => c.classList.remove('show'));

        // Abre o card desejado
        card.classList.add('show');
    }
}