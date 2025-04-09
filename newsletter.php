<?php
include 'bloques/_header.php'; // Incluye el encabezado
require_once 'bloques/_config.php'; // Asegúrate de que la conexión a la base de datos esté correcta

if (isset($_GET['success'])) {
    echo "<p>¡Gracias por suscribirte a nuestra newsletter!</p>";
} elseif (isset($_GET['error'])) {
    if ($_GET['error'] === 'email_exists') {
        echo "<p>Este email ya está registrado.</p>";
    } elseif ($_GET['error'] === 'database_error') {
        echo "<p>Ocurrió un error al registrar tu email. Inténtalo de nuevo más tarde.</p>";
    }
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index_copy.php');
    exit();
}

// Verifica si se ha enviado el formulario (método POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitizar el email
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Validar que el email es válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Mostrar error si el email no es válido
        echo "<script>alert('El email ingresado no es válido.'); window.location.href='index_copy.php';</script>";
        exit();
    }

    // Preparar la consulta para insertar el email en la base de datos
    $sql = "INSERT INTO newsletter (email) VALUES (?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    // Asociar el parámetro a la consulta preparada
    $stmt->bind_param("s", $email);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Mostrar mensaje de éxito y redirigir a la página principal
        echo "<script>alert('¡Gracias por suscribirte a nuestra newsletter!'); window.location.href='index_copy.php';</script>";
    } else {
        if ($stmt->errno === 1062) { // Si el correo ya está registrado
            echo "<script>alert('Este email ya está registrado.'); window.location.href='index_copy.php';</script>";
        } else {
            // Mostrar mensaje de error si algo salió mal
            echo "<script>alert('Error al registrar el email: " . $stmt->error . "'); window.location.href='index_copy.php';</script>";
        }
    }

    
}

// Agregar índice único a la columna email en la tabla newsletter
$sql = "ALTER TABLE newsletter ADD UNIQUE (email)";
if ($conn->query($sql) === TRUE) {
    echo "Índice único agregado a la columna email en la tabla newsletter.";
} else {
    echo "Error al agregar índice único: " . $conn->error;
}

?>
<?php include 'bloques/_footer.php'; ?>
