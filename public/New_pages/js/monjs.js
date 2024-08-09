document.addEventListener('DOMContentLoaded', function () {
    const content = document.querySelector('.content');
    const itemsPerPage = 6; // Nombre d'éléments par page
    let currentPage = 0;
    const items = Array.from(content.getElementsByTagName('tr')).slice(1);

    function showPage(page) {
        const start = page * itemsPerPage;
        const end = start + itemsPerPage;
        items.forEach((item, index) => {
            item.style.display = (index >= start && index < end) ? 'table-row' : 'none';
        });
    }

    function createPaginationButtons() {
        const totalPages = Math.ceil(items.length / itemsPerPage);
        const pagination = document.getElementById('pagination');
        pagination.innerHTML = '';

        for (let i = 0; i < totalPages; i++) {
            const button = document.createElement('span');
            button.classList.add('page-link');
            button.textContent = i + 1;
            button.addEventListener('click', () => {
                currentPage = i;
                showPage(currentPage);
            });
            pagination.appendChild(button);
        }
    }

    showPage(currentPage);
    createPaginationButtons();
});
