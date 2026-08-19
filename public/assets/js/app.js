'use strict';

const searchInput = document.querySelector('[data-product-search]');
const rows = Array.from(document.querySelectorAll('[data-product-row]'));
const noResults = document.querySelector('[data-no-results]');

searchInput?.addEventListener('input', () => {
    const term = searchInput.value.trim().toLocaleLowerCase('pt-BR');
    let visibleRows = 0;

    rows.forEach((row) => {
        const productName = (row.dataset.productName ?? '').toLocaleLowerCase('pt-BR');
        const isVisible = productName.includes(term);
        row.hidden = !isVisible;
        visibleRows += isVisible ? 1 : 0;
    });

    if (noResults) {
        noResults.hidden = visibleRows !== 0;
    }
});

document.querySelectorAll('[data-confirm-delete]').forEach((form) => {
    form.addEventListener('submit', (event) => {
        if (!window.confirm('Deseja realmente excluir este produto?')) {
            event.preventDefault();
        }
    });
});
