function openMenu() {
    var menu = document.querySelector('.menu');
    var burgerMenu = document.querySelector('.burger-menu');
    
    if (menu.style.display === 'block') {
        menu.style.display = 'none';
        burgerMenu.style.display = 'block';
    } else {
        menu.style.display = 'block';
        burgerMenu.style.display = 'none';
    }
}
// naroors