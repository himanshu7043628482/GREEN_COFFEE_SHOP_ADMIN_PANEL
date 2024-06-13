document.addEventListener("DOMContentLoaded", function() {
    let header = document.querySelector('.header');

    function fixedNavbar() {
        if (header) {
            header.classList.toggle('scrolled', window.pageYOffset > 0);
        }
    }

    fixedNavbar();
    window.addEventListener('scroll', fixedNavbar);

    let menuBtn = document.querySelector('#menu-btn');
    if (menuBtn) {
        menuBtn.addEventListener('click', function() {
            let navbar = document.querySelector('.navbar');
            if (navbar) {
                navbar.classList.toggle('active');
            }
        });
    }

    let userBtn = document.querySelector('#user-btn');
    if (userBtn) {
        userBtn.addEventListener('click', function() {
            let userBox = document.querySelector('.profile-detail');
            if (userBox) {
                userBox.classList.toggle('active');
            }
        });
    }
});
