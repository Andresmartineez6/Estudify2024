
document.addEventListener("DOMContentLoaded",()=>{
    const toggleModeCheckbox=document.getElementById("toggleMode");
    const iconoSol=document.getElementById("iconoSol");
    const iconoLuna=document.getElementById("iconoLuna");
  
    const modoInicial=localStorage.getItem("modo") || "oscuro";
    aplicarModo(modoInicial==="claro");
  
    toggleModeCheckbox.checked = modoInicial==="claro";
  
    toggleModeCheckbox.addEventListener("change",()=>{
      const esModoClaro=toggleModeCheckbox.checked;
      aplicarModo(esModoClaro);
      localStorage.setItem("modo", esModoClaro ? "claro" : "oscuro");
    });
  
    function aplicarModo(esModoClaro){
      if(esModoClaro){
        document.body.classList.add("modo-claro");
        document.body.classList.remove("modo-oscuro");
        iconoSol.style.display="inline";
        iconoLuna.style.display="none";
      }else{
        document.body.classList.add("modo-oscuro");
        document.body.classList.remove("modo-claro");
        iconoSol.style.display="none";
        iconoLuna.style.display="inline";
      }
    }
});


document.addEventListener("DOMContentLoaded", () => {
    const ctx = document.getElementById('graficoRendimiento').getContext('2d');
    const graficoRendimiento = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Organización', 'Productividad', 'Compromiso', 'Gestión del Tiempo'],
            datasets: [{
                label: 'Mejora en %',
                data: [80, 70, 90, 60],
                backgroundColor: 'rgba(255, 140, 0, 0.7)', // Naranja semitransparente
                borderColor: 'rgba(255, 140, 0, 1)',
                borderWidth: 2, // Reduce el grosor de las barras
                borderRadius: 10, // Bordes redondeados en las barras
                barPercentage: 0.6, // Ajusta el tamaño de las barras
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Permite ajustar el tamaño libremente
            animation: {
                duration: 1500, // Ajusta la duración de la animación
                easing: 'easeInOutQuad' // Suaviza la animación
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        color: '#fff', // Color de la leyenda
                        font: {
                            size: 14,
                            family: 'Poppins'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    padding: 10,
                    bodyFont: {
                        size: 14
                    },
                    displayColors: false
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#ccc',
                        font: {
                            size: 14,
                            family: 'Poppins'
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    max: 100,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    },
                    ticks: {
                        color: '#ccc',
                        font: {
                            size: 14,
                            family: 'Poppins'
                        }
                    }
                }
            }
        }
    });
});




document.querySelectorAll('.beneficio-circulo').forEach(circulo => {
    circulo.addEventListener('mouseover', () => {
        circulo.style.transform = 'scale(1.2)';
    });
    circulo.addEventListener('mouseout', () => {
        circulo.style.transform = 'scale(1)';
    });
});






document.addEventListener("DOMContentLoaded", () => {
    const chistesTraducidos = new Map([
        ["Why couldn't the kid see the pirate movie?", "¿Por qué el niño no pudo ver la película de piratas?"],
        ["Because it was rated arrr!", "¡Porque era clasificación arrr!"],
        // Puedes añadir manualmente más traducciones si lo prefieres.
    ]);

    const citaElement = document.getElementById("cita");
    const nuevaCitaBtn = document.getElementById("nuevaCita");

    const obtenerChiste = async () => {
        try {
            const response = await fetch("https://official-joke-api.appspot.com/random_joke");
            if (!response.ok) throw new Error("Error al obtener el chiste");

            const data = await response.json();
            const setupTraducido = chistesTraducidos.get(data.setup) || data.setup;
            const punchlineTraducido = chistesTraducidos.get(data.punchline) || data.punchline;

            citaElement.innerHTML = `<strong>${setupTraducido}</strong> - ${punchlineTraducido}`;
        } catch (error) {
            console.error("Error al obtener el chiste:", error);
            citaElement.textContent = "No se pudo cargar el chiste. Intenta nuevamente.";
        }
    };

    nuevaCitaBtn.addEventListener("click", obtenerChiste);
    obtenerChiste(); // Mostrar un chiste al cargar la página
});
