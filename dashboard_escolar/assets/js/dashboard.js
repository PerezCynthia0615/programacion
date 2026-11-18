async function cargarDatos(url, numeroTarjeta) {
    const tarjetas = document.querySelectorAll(".card");
    const contador = tarjetas[numeroTarjeta].querySelector("strong");

    // Estado: cargando
    contador.textContent = "Cargando...";

    try {
        // Solicitar información a la API
        const respuesta = await fetch(url);

        if (!respuesta.ok) {
            throw new Error("Error al consultar la API");
        }

        // Convertir JSON a datos JavaScript
        const datos = await respuesta.json();
        if (!Array.isArray(datos)) {
            throw new Error("Formato de datos incorrecto");
        }

        // Estado: éxito
        contador.textContent = datos.length;

    } catch (error) {
        // Estado: error
        contador.textContent = "Error";
        console.error(error);
    }
}

// Tarjeta 0: Materias
cargarDatos("api/materias/listar.php", 0);

// Tarjeta 1: Servicios
cargarDatos("api/servicios/listar.php", 1);
