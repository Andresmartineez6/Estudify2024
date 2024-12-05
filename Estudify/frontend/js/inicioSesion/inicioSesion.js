// frontend/js/inicioSesion/inicioSesion.js

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("form-inicio-sesion");
    
    form.addEventListener("submit", function (event) {
      event.preventDefault();
  
      const email = document.getElementById("email").value;
      const password = document.getElementById("password").value;
  
      // Validación básica
      if (email === "" || password === "") {
        alert("Por favor, completa todos los campos.");
        return;
      }
  
      // Simulación de autenticación
      if (email === "usuario@estudify.com" && password === "123456") {
        alert("Inicio de sesión exitoso");
        // Redirecciona a la página principal (suponiendo que sea dashboard.html)
        window.location.href = "dashboard.html";
      } else {
        alert("Correo electrónico o contraseña incorrectos");
      }
    });
  });
  