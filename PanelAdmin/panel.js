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

        const url = link.getAttribute("href");

        // ¿Es el botón que despliega un dropdown? (tiene un .content justo después)
        const esDropdown = link.nextElementSibling?.classList.contains("content");

        if (esDropdown) {
            const yaActivo = link.classList.contains("active");
            nav.forEach(el => el.classList.remove("active"));
            if (!yaActivo) link.classList.add("active"); // clic de nuevo = cierra
            return;
        }

        nav.forEach(el => el.classList.remove("active"));
        link.classList.add("active");

        // Si todavía no tiene href real, no intenta cargar nada
        if (!url || url.trim() === "" || url.trim() === "#") return;

        cargarEnScreen(url);
    });
});

// Cargar Inicio al abrir el panel
const inicio = document.querySelector(".side-link.active");
if (inicio) cargarEnScreen(inicio.getAttribute("href"));