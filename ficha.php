<?php
// Incluir configuración y encabezado
require_once 'bloques/_config.php';
include 'bloques/_header.php';

// Paso 2: Obtener y validar el parámetro id (suponiendo que viene de la URL)
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;  // Asegurarnos de que el id es un entero

// Validar que el id sea válido
if ($id <= 0) {
    echo "ID no válido";
    exit;
}

// Paso 3: Realizar la consulta a la base de datos usando consultas preparadas
$sql = "SELECT * FROM eventos WHERE id = ?";
$stmt = $conn->prepare($sql);  // Preparar la consulta SQL
$stmt->bind_param("i", $id);  // Vinculamos el parámetro (i para integer)
$stmt->execute();  // Ejecutar la consulta

// Paso 4: Obtener el resultado de la consulta
$result = $stmt->get_result();  // Obtener el resultado de la consulta

// Paso 5: Verificar si la consulta devuelve algún evento
if ($result->num_rows > 0) {
    $evento = $result->fetch_assoc();  // Obtener el primer evento como un array asociativo
} else {
    echo "Evento no encontrado";
    exit;
}

?>

<section class="ficha">
    <!-- Imagen del evento -->
    <div class="ficha-imagen">
        <img src="<?= $evento['img'] ?>" alt="<?= $evento['nombre'] ?>">
    </div>

    <!-- Descripción del evento -->
    <div class="ficha-descripcion">
        <h1><?= $evento['nombre'] ?></h1>
        <p><?= $evento['fecha'] ?></p>
        <p><?= $evento['horario'] ?></p>
        <p><?= $evento['id_direccion'] ?></p>
        <p><?= $evento['precio'] ?></p>
        <p><?= $evento['descripcion'] ?></p>
    </div>
</section>

<?php
// Incluir el pie de página del sitio
include 'bloques/_footer.php';


?>
