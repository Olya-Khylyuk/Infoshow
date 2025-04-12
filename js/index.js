document.addEventListener("DOMContentLoaded", function() {
    var navbarToggler = document.querySelector('.navbar-toggler');
    var navbarIcon = document.querySelector('.navbar-toggler-icon');
    var navbarCollapse = document.querySelector('#navbarNav');

    // Подія при відкритті меню
    navbarCollapse.addEventListener('show.bs.collapse', function() {
        navbarIcon.innerHTML = '<i class="fa-solid fa-xmark" style="color: #fff;"></i>';
        navbarIcon.classList.remove('navbar-toggler-icon');
        navbarIcon.classList.add('close-icon');
    });

    // Подія при закритті меню
    navbarCollapse.addEventListener('hide.bs.collapse', function() {
        navbarIcon.innerHTML = '';  
        navbarIcon.classList.add('navbar-toggler-icon');
        navbarIcon.classList.remove('close-icon');
    });

    // Закриття меню при кліку поза ним
    document.addEventListener("click", function(event) {
        var isClickInsideNavbar = navbarToggler.contains(event.target) || navbarCollapse.contains(event.target);
        if (!isClickInsideNavbar && navbarCollapse.classList.contains("show")) {
            var bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                toggle: false
            });
            bsCollapse.hide();
        }
    });
});