const nav = document.querySelectorAll(".side-link");
const screen = document.querySelector(".screen");

async function cargarEnScreen(url) {
    try {
        const respuesta = await fetch(url);
        if (!respuesta.ok) throw new Error(`Error ${respuesta.status}`);
        screen.innerHTML = await respuesta.text();
    } catch (error) {
        screen.innerHTML = "<p>No se pudo cargar el contenido.</p>";
        console.error(error);
    }
}

nav.forEach(link => {
    link.addEventListener("click", (e) => {
        e.preventDefault();

        nav.forEach(el => el.classList.remove("active"));
        link.classList.add("active");

        cargarEnScreen(link.getAttribute("href"));
    });
});



