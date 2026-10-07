document.addEventListener("DOMContentLoaded", () => {

    const toggleButton = document.querySelector(".js-menu-toggle");
    const mobileMenu = document.querySelector(".site-mobile-menu");
    const overlay = document.querySelector(".site-mobile-menu-overlay");
    const mobileBody = document.querySelector(".site-mobile-menu-body");
    const desktopMenu = document.querySelector("#desktop-menu");

    mobileBody.innerHTML = "";

    // Copiar enlaces del menú principal
    if (desktopMenu) {
        desktopMenu.querySelectorAll("li a").forEach(link => {
            let item = document.createElement("a");
            item.href = link.href;
            item.textContent = link.textContent;
            item.className = "block px-2 py-2 rounded hover:bg-gray-100";
            mobileBody.appendChild(item);
        });
    }

    // Cerrar sesión
    if (typeof logoutRoute !== "undefined" && logoutRoute) {
        let logoutBtn = document.createElement("button");
        logoutBtn.textContent = "Cerrar sesión";
        logoutBtn.className = "block text-left w-full px-2 py-2 rounded bg-red-600 text-white mt-4";
        logoutBtn.onclick = () => {
            document.querySelector(`form[action="${logoutRoute}"]`).submit();
        };

        mobileBody.appendChild(logoutBtn);
    }

    // Mostrar menú
    toggleButton.addEventListener("click", () => {
        mobileMenu.classList.add("open");
        overlay.classList.add("show");
    });

    // Cerrar menú al tocar el overlay
    overlay.addEventListener("click", () => {
        mobileMenu.classList.remove("open");
        overlay.classList.remove("show");
    });

});
