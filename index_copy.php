<?php require_once 'bloques/_config.php'; ?>
<?php include 'bloques/_header.php'; ?>

<h1>Agenda Cultural de Gijón</h1>
<p class="festiv">Descubre la agenda cultural de Gijón, donde cada día ofrece nuevas oportunidades para disfrutar de arte, música, teatro y eventos únicos. Mantente al tanto de las actividades más destacadas y no te pierdas lo mejor de nuestra ciudad.</p>

<section class="newsletter">
    <h2>Suscríbete a nuestra Newsletter</h2>
    <form action="index_copy.php" method="POST">
        <input type="email" name="email" placeholder="Introduce tu email" required>
        <button type="submit">Suscribirse</button>
    </form>
</section>

<section class="modal" id="newsletterModal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>¡Gracias por suscribirte!</h2>
        <p>Te mantendremos informado sobre los eventos culturales en Gijón.</p>
    </div>
</section>

<script>
    const modal = document.getElementById("newsletterModal");
    const closeBtn = document.querySelector(".close");

    // Mostrar el modal cuando el formulario sea exitoso
    function showModal() {
        modal.style.display = "block";
    }

    // Cerrar el modal cuando el usuario haga clic en el 'x'
    closeBtn.onclick = function() {
        modal.style.display = "none";
    }

    // Cerrar el modal si el usuario hace clic fuera de él
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        const params = new URLSearchParams(window.location.search);
        if (params.has("success")) {
            modal.style.display = "block";
        }
    });
</script>

<?php
// Verificamos si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    // Conexión a la base de datos
    if (!$conn) {
        die("Error de conexión a la base de datos: " . mysqli_connect_error());
    }

    // Sanear el email recibido
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Preparamos la consulta SQL para insertar el email
    $stmt = $conn->prepare("INSERT INTO newsletter (email) VALUES (?)");

    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    // Vinculamos el parámetro
    $stmt->bind_param("s", $email); // "s" significa que el parámetro es una cadena (string)

    // Intentamos ejecutar la consulta
    if ($stmt->execute()) {
        header('Location: index_copy.php?success=1');
        exit();
    } else {
        if ($stmt->errno === 1062) {
            header('Location: index_copy.php?error=email_exists');
        } else {
            header('Location: index_copy.php?error=database_error');
        }
        exit();
    }

    // Cerramos la sentencia preparada
    $stmt->close();
}

?>

<section class="container">
<?php
if (!$conn) {
    die("Error de conexión a la base de datos: " . mysqli_connect_error());
}

// Desplegamos los datos de la base de datos
$sql="SELECT 
    e.id AS evento_id,
    e.img AS evento_img,
    e.nombre AS evento_nombre,
    e.descripcion AS evento_descripcion,
    e.fecha AS evento_fecha,
    e.horario AS evento_horario,
    
    d.nombre AS direccion_nombre,
    d.direccion AS direccion_direccion,
    d.cp AS direccion_cp,
    c.ciudad AS ciudad_nombre,
    o.nombre AS organizador_nombre,
    o.telefono AS organizador_telefono,
    o.direccion AS organizador_direccion,
    t.tipo AS evento_tipo
FROM eventos e
JOIN direcciones d ON e.id_direccion = d.id
JOIN ciudad c ON d.id_ciudad = c.id
LEFT JOIN eventos_organizadores eo ON e.id = eo.id_evento
LEFT JOIN organizadores o ON eo.id_organiza = o.id
LEFT JOIN evento_tipo et ON e.id = et.id_evento
LEFT JOIN tipo_eventos t ON et.id_tipo = t.id
ORDER BY e.fecha;
";

// Devuelve :
// evento_id	evento_img	evento_nombre	evento_descripcion	evento_fecha	evento_horario	evento_precio_min	evento_precio_max	direccion_nombre	direccion_direccion	direccion_cp	ciudad_nombre	organizador_nombre	organizador_telefono	organizador_direccion	evento_tipo

$resultado_array = mysqli_query($conn, $sql);

if (mysqli_num_rows($resultado_array) > 0) 
{
    echo "<ul class='galeria'>";
    while ($row = mysqli_fetch_assoc($resultado_array)) 
    {
        echo "<li class='container'>
        <div class='contenedor'>
            <a href='ficha.php?id={$row['evento_id']}'>";

        if($row['evento_img'] != null)
        {
            echo "<img src='{$row['evento_img']}' alt='Imagen del evento' class='evento'>";
        }

        $fecha= convertirFechaES($row['evento_fecha']);

        echo "<h2>{$row['evento_nombre']}</h2>
      <p> $fecha</p> <!-- Aquí se usa directamente la fecha del evento -->
      <p>Horario: ".date("H:i", strtotime($row['evento_horario']))."</p>
      <p>Lugar: {$row['direccion_nombre']}</p>
      </a>
            
        </div>
        </li>";
    }
    echo "</ul>";
}

?>
</section>

<aside class="aside">
<ul> ¿Tienes Tiempo?
    <li><a href="lugares.php">Lugares de Interés</a></li>
    <li><a href="rutas.php">Rutas y Excursiones</a></li>
    <li><a href="museos.php">Museos</a></li>
    <li><a href="parques.php">Parques</a></li>
    <li><a href="bibliotecas.php">Bibliotecas</a></li>
    <li><a href="fiestas.php">Fiestas de Interés Cultural en Asturias</a></li>
</ul>
</aside>

<?php
// Cerrar la conexión a la base de datos al final
$conn->close();
?>

<?php include 'bloques/_footer.php'; ?>
