
<?php

require_once 'bloques/_config.php';
include 'bloques/_header.php';

//  Obtenemos la id del evento
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;  // Asegurarnos de que el id es un entero

// Comprobamos que el id sea válido
if ($id <= 0) {
    echo "ID no válido";
    exit;
}

//  Realizar la consulta a la base de datos 
$sql = "SELECT * FROM eventos WHERE id = ?";
$stmt = $conn->prepare($sql);  
$stmt->bind_param("i", $id);  
$stmt->execute();  

// Obtenemos el resultado de la consulta
$result = $stmt->get_result();  

// Comprobamos que la consulta nos devuelve algún evento
if ($result->num_rows > 0) {
    $evento = $result->fetch_assoc();  
} else {
    echo "Evento no encontrado";
    exit;
}

// Obtenemos la dirección de evento ya que las tablas estaban relacionadas
$direccion_sql = "SELECT direccion FROM direcciones WHERE id = ?";
$direccion_stmt = $conn->prepare($direccion_sql);
$direccion_stmt->bind_param("i", $evento['id_direccion']);
$direccion_stmt->execute();
$direccion_result = $direccion_stmt->get_result();

// Si la dirección existe, la obtenemos
if ($direccion_result->num_rows > 0) {
    $direccion = $direccion_result->fetch_assoc()['direccion'];
} else {
    $direccion = "Dirección no disponible";
}

// Cambiamos la fecha para que nos aparezca en el formato que queremos
$fecha = new DateTime($evento['fecha']);
$fecha_formateada = $fecha->format('l d \d\e F \d\e Y');

// Convertimos la fecha a español
$meses = [
    "January" => "Enero", "February" => "Febrero", "March" => "Marzo", "April" => "Abril", 
    "May" => "Mayo", "June" => "Junio", "July" => "Julio", "August" => "Agosto", 
    "September" => "Septiembre", "October" => "Octubre", "November" => "Noviembre", "December" => "Diciembre"
];
$dias = [
    "Monday" => "Lunes", "Tuesday" => "Martes", "Wednesday" => "Miércoles", "Thursday" => "Jueves", 
    "Friday" => "Viernes", "Saturday" => "Sábado", "Sunday" => "Domingo"
];

// Con esto cambiamos os nombres y los días al español
$fecha_formateada = str_replace(array_keys($dias), array_values($dias), $fecha_formateada);
$fecha_formateada = str_replace(array_keys($meses), array_values($meses), $fecha_formateada);
?>

<section class="ficha">
   
    <div class="ficha-imagen">
        <img src="<?= $evento['img'] ?>" alt="<?= $evento['nombre'] ?>">
    </div>

    
    <div class="ficha-descripcion">
        <h1><?= $evento['nombre'] ?></h1>
        <p><strong>Fecha:</strong> <?= $fecha_formateada ?></p>
        <p><strong>Horario:</strong> <?= $evento['horario'] ?></p>
        <p><strong>Dirección:</strong> <?= $direccion ?></p>
        <p><strong>Precio:</strong> <?= $evento['precio'] ?></p>
        <p><?= $evento['descripcion'] ?></p>
    </div>
</section>

<?php

include 'bloques/_footer.php';
?>

