<?php
require_once 'bloques/_config.php'; // Asegúrate de que este archivo contiene la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Validar que el email sea válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("El email ingresado no es válido.");
    }

    // Insertar el email en la base de datos
    $sql = "INSERT INTO newsletter (email) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        echo "¡Gracias por suscribirte a nuestra newsletter!";
    } else {
        if ($stmt->errno === 1062) { // Código de error para entradas duplicadas
            echo "Este email ya está registrado.";
        } else {
            echo "Error al registrar el email: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
}
?>