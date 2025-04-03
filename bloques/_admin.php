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

    <?php

    // Sistema para añadir nuevos eventos y que se vayan agregando a la base de datos
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Conexión a la base de datos
        const HOST = "localhost";
        const USER = "root";
        const PASS = "root";
        const DBNA = "xperience";

        $conn = new mysqli(HOST, USER, PASS, DBNA);

        // Verificar conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Recibir datos del formulario
        $nombre = $conn->real_escape_string($_POST['nombre']);
        $descripcion = $conn->real_escape_string($_POST['descripcion']);
        $fecha = $conn->real_escape_string($_POST['fecha']);
        $horario = $conn->real_escape_string($_POST['horario']);
        $id_direccion = (int)$_POST['id_direccion'];
        $precio = (float)$_POST['precio'];

        // Manejar la subida de la imagen
        $img = $_FILES['img'];
        $imgPath = "uploads/" . basename($img['name']);
        if (move_uploaded_file($img['tmp_name'], $imgPath)) {
            // Insertar datos en la base de datos
            $sql = "INSERT INTO eventos (nombre, descripcion, fecha, horario, img, id_direccion, precio) 
                    VALUES ('$nombre', '$descripcion', '$fecha', '$horario', '$imgPath', $id_direccion, $precio)";

            if ($conn->query($sql) === TRUE) {
                echo "Evento añadido exitosamente.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error al subir la imagen.";
        }

        // Cerrar conexión
        $conn->close();
    }
    ?>