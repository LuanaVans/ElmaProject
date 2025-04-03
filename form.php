<? require_once 'bloques/_config.php'; ?>
<? include 'bloques/_header.php'; ?>

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
        echo "<div class='mensaje-enviado'>";
        echo "<h2 class='titulo'>Mensaje Enviado:</h2>";
        echo "<p><strong class='label'>Nombre:</strong> <span class='contenido'>" . $name . "</span></p>";
        echo "<p><strong class='label'>Correo Electrónico:</strong> <span class='contenido'>" . $email . "</span></p>";
        echo "<p><strong class='label'>Asunto:</strong> <span class='contenido'>" . $subject . "</span></p>";
        echo "<p><strong class='label'>Mensaje:</strong><br><span class='contenido'>" . nl2br($message) . "</span></p>";
        echo "</div>";
    } else {
        // Si el correo no es válido
        echo "<p class='error'>Por favor, ingresa un correo electrónico válido.</p>";
    }
} else {
    // Si el formulario no se ha enviado correctamente
    echo "<p class='error'>No se han enviado datos.</p>";
}
?>
<? include 'bloques/_footer.php'; ?>
