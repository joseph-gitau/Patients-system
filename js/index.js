const toggle = document.getElementById('dropdown-toggle');
const menu = document.getElementById('dropdown-menu');

toggle.addEventListener('click', (event) => {
    event.preventDefault();
    menu.classList.toggle('show');
});
