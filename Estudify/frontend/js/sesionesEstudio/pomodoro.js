document.addEventListener("DOMContentLoaded", () => {
    let tiempoTrabajo = 25 * 60; // 25 minutos en segundos
    let tiempoDescanso = 5 * 60; // 5 minutos en segundos
    let ciclos = 4; // Número total de ciclos de Pomodoro por sesión
    let cicloActual = 1; // Ciclo actual
    let enTrabajo = true; // Bandera para saber si es trabajo o descanso
    let timer; // Variable del intervalo

    const display = document.getElementById("pomodoro-display");
    const btnIniciar = document.getElementById("iniciar-pomodoro");
    const asignatura = "JavaScript"; // Puedes recoger este valor dinámicamente en tu interfaz

    function iniciarCronometro() {
        let tiempo = enTrabajo ? tiempoTrabajo : tiempoDescanso;

        timer = setInterval(() => {
            const minutos = Math.floor(tiempo / 60);
            const segundos = tiempo % 60;
            display.textContent = `${minutos}:${segundos < 10 ? "0" + segundos : segundos}`;
            tiempo--;

            if (tiempo < 0) {
                clearInterval(timer);

                // Verificar si terminamos los ciclos
                if (enTrabajo && cicloActual === ciclos) {
                    guardarSesionPomodoro(
                        tiempoTrabajo * ciclos / 60, // Duración total en minutos
                        tiempoDescanso * (ciclos - 1) / 60, // Tiempo de descanso en minutos
                        ciclos,
                        asignatura
                    );
                    alert("Sesión Pomodoro completada!");
                    return;
                }

                enTrabajo = !enTrabajo;
                if (enTrabajo) {
                    cicloActual++;
                    alert("¡Hora de trabajar!");
                } else {
                    alert("¡Hora de descansar!");
                }

                iniciarCronometro();
            }
        }, 1000);
    }

    btnIniciar.addEventListener("click", () => {
        iniciarCronometro();
    });

    function guardarSesionPomodoro(duracion, duracionDescanso, ciclos, asignatura) {
        fetch("../../../backend/controladores/sesionesEstudio/controladorSesionesEstudio.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                duracion: duracion,
                duracion_descanso: duracionDescanso,
                tipo_sesion: "Pomodoro",
                ciclos: ciclos,
                asignatura: asignatura,
            }),
        })
        .then((response) => response.json())
        .then((data) => {
            if (data.status === "success") {
                console.log(data.message);
            } else {
                console.error(data.message);
            }
        });
    }
});
