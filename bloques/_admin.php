<?php
// Formulario para incluir nuevos eventos en la base de datos creada
?>

<form action="procesar_evento.php" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre del Evento:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion" required></textarea><br><br>

        <label for="fecha">Fecha del Evento:</label><br>
        <input type="date" id="fecha" name="fecha" required><br><br>

        <label for="horario">Horario:</label><br>
        <input type="time" id="horario" name="horario" required><br><br>

        <label for="img">Imagen del Evento:</label><br>
        <input type="file" id="img" name="img" accept="image/*" required><br><br>

        <label for="id_direccion">ID de la Dirección:</label><br>
        <input type="number" id="id_direccion" name="id_direccion" required><br><br>

        <label for="precio">Precio:</label><br>
        <input type="number" id="precio" name="precio" step="0.01" required><br><br>

        <button type="submit">Enviar</button>
    </form>