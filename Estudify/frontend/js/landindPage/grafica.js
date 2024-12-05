document.addEventListener("DOMContentLoaded", () => {
    const barras = document.querySelectorAll(".nivel");
    barras.forEach(barra => {
        const porcentaje = barra.getAttribute("data-porcentaje");
        barra.style.height = `${porcentaje}%`;
    });
});
