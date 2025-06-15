<!--
    Decide U
    Footer
    Guerrero Castro Blanca Teresita
    Cibrian Castro Ana Cristina
    Vega Escalante Romina
    Última actualización: 14/06/2025
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <!--Enlace de conexion a la hoja de estilo-->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/estilo.css">
    </head>
    <body>
        <!--Pie de página del sitio-->
        <footer class="footer">
            <!--Contenido del footer, lado izquierdo: texto o correro-->
            <div class="footer-content">
                <!-- Lado izquierdo -->
                <div class="footer-left">
                    <p>&copy; 2025 DecideU. Todos los derechos reservados.</p>
                    <p><a href="mailto:decide.u.037@gmail.com">decide.u.037@gmail.com</a></p>
                </div>
                <!-- Lado derecho (fecha y hora) -->
                <div class="footer-right">
                    <span class="reloj-icono">⏰</span>
                    <span id="reloj"></span>
                </div>
            </div>
        </footer>
        <!--Conexion al script-->
        <script>
        // Función que actualiza el contenido del reloj con la fecha y hora actuales
        function actualizarReloj() {
            // Crear un objeto Date con la fecha y hora actuales
            const ahora = new Date();

            // Obtener los componentes de la fecha y hora
            const dia = ahora.getDate(); // Día del mes (1-31)
            const mes = ahora.getMonth() + 1; // Mes (0-11) +1 para que sea (1-12)
            const anio = ahora.getFullYear(); // Año completo (ejemplo: 2025)

            // Obtener los componentes de la hora
            let horas = ahora.getHours(); // Horas (0-23)
            let minutos = ahora.getMinutes(); // Minutos (0-59)
            let segundos = ahora.getSeconds(); // Segundos (0-59)

            // Añadir un cero delante si los minutos o segundos son menores que 10 para formato 2 dígitos
            minutos = minutos < 10 ? '0' + minutos : minutos;
            segundos = segundos < 10 ? '0' + segundos : segundos;
            // También para el día y mes, si quieres que siempre tengan dos dígitos
            const diaFormateado = dia < 10 ? '0' + dia : dia;
            const mesFormateado = mes < 10 ? '0' + mes : mes;

            // Crear un string con la fecha en formato DD/MM/YYYY
            const fecha = `${diaFormateado}/${mesFormateado}/${anio}`;

            // Crear un string con la hora en formato HH:MM:SS (24 horas)
            const hora = `${horas}:${minutos}:${segundos}`;

            // Obtener el elemento HTML donde se mostrará la fecha y hora
            const elementoReloj = document.getElementById('reloj');

            // Actualizar el contenido HTML del elemento con la fecha y hora concatenadas
            elementoReloj.textContent = `${fecha} ${hora}`;
        }

        // Ejecutar la función actualizarReloj una vez al cargar la página para mostrar inmediatamente
        actualizarReloj();

        // Actualizar el reloj cada 1 segundo (1000 milisegundos)
        setInterval(actualizarReloj, 1000);
        </script>
        <!--Links para usar funcionalidades de bootstrap-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>
</html>