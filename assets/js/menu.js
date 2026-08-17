const menu = document.querySelector("#menuOverlay");
const openButton = document.querySelector("#openMenu");
const closeButton = document.querySelector("#closeMenu");

const submenuButton = document.querySelector(".submenu-button");
const submenu = document.querySelector(".submenu");


function openMenu() {
    menu.classList.add("is-open");

    menu.setAttribute("aria-hidden", "false");
    openButton.setAttribute("aria-expanded", "true");

    document.body.classList.add("menu-open");

    closeButton.focus();
}


function closeMenu() {
    menu.classList.remove("is-open");

    menu.setAttribute("aria-hidden", "true");
    openButton.setAttribute("aria-expanded", "false");

    document.body.classList.remove("menu-open");

    openButton.focus();
}


openButton.addEventListener("click", openMenu);

closeButton.addEventListener("click", closeMenu);


submenuButton.addEventListener("click", function () {
    const isExpanded =
        submenuButton.getAttribute("aria-expanded") === "true";

    submenuButton.setAttribute(
        "aria-expanded",
        String(!isExpanded)
    );

    submenu.classList.toggle("is-open");
});


document.addEventListener("keydown", function (event) {
    if (
        event.key === "Escape" &&
        menu.classList.contains("is-open")
    ) {
        closeMenu();
    }
});

const currentPage =
    window.location.pathname.split("/").pop() || "index.php";

const navigationLinks =
    document.querySelectorAll(".menu-nav a");

navigationLinks.forEach(function (link) {
    const linkAddress =
        link.getAttribute("href").split("#")[0];

    if (linkAddress === currentPage) {
        link.classList.add("active-page");
    }
});