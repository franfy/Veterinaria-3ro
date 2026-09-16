const nav = document.querySelectorAll(".side-link");


nav.forEach(link => {
    link.addEventListener("click", (e) => {
        e.preventDefault();

        nav.forEach(el => el.classList.remove("active"));

        link.classList.add("active");
    });
});