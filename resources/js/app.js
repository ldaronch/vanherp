require('./bootstrap');

// Custom scripts for the admin panel
document.addEventListener('DOMContentLoaded', function() {
    // Sidebar toggle or other interactive elements
    const menuBtn = document.querySelector('header .material-symbols-outlined');
    const sidebar = document.querySelector('aside');
    
    if (menuBtn && sidebar) {
        menuBtn.addEventListener('click', () => {
            // Add toggle logic if needed for mobile
            console.log('Menu clicked');
        });
    }

    // Accordion logic for Sidebar
    const accordionBtns = document.querySelectorAll('aside button');
    accordionBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const submenu = this.nextElementSibling;
            const arrow = this.querySelector('.material-symbols-outlined:last-child');
            
            if (submenu) {
                submenu.classList.toggle('hidden');
                if (arrow) {
                    arrow.textContent = submenu.classList.contains('hidden') ? 'expand_more' : 'expand_less';
                }
            }
        });
    });
});
