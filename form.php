<?php
// Comprobar si el formulario ha sido enviado mediante el método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger y sanitizar los datos del formulario
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $subject = isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : '';
    $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';

    // Validar los datos (por ejemplo, validar el correo electrónico)
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Si los datos son válidos, mostrar los datos recibidos
        echo "<h2>Datos recibidos:</h2>";
        echo "<strong>Nombre:</strong> " . $name . "<br>";
        echo "<strong>Correo Electrónico:</strong> " . $email . "<br>";
        echo "<strong>Asunto:</strong> " . $subject . "<br>";
        echo "<strong>Mensaje:</strong><br>" . nl2br($message) . "<br>";
    } else {
        // Si el correo no es válido
        echo "<p style='color:red;'>Por favor, ingresa un correo electrónico válido.</p>";
    }
} else {
    // Si el formulario no se ha enviado correctamente
    echo "<p>No se han enviado datos.</p>";
}
?>
