<? require_once 'bloques/_config.php'; ?>
<? include 'bloques/_header.php'; ?>


    

<h1> Agenda Cultural de Gijón </h1>
<p class="festiv">Descubre la agenda cultural de Gijón, donde cada día ofrece nuevas oportunidades para disfrutar de arte, música, teatro y eventos únicos. Mantente al tanto de las actividades más destacadas y no te pierdas lo mejor de nuestra ciudad</p>



  
<div class="secciones">



<section class="container">
<?
// desplegams los datos de la base de datos

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
    echo "<a href='ficha.php?id=?'><ul class='galeria'>";
    while ($row = mysqli_fetch_assoc($resultado_array)) 
    {
        echo "<li class='container'>
        <div class='contenedor'>";
        
        if($row['evento_img'] != null)
        {
            echo "<img src='{$row['evento_img']}' alt='Imagen del evento'class='evento'>";
        }
       // else
        //{
            //echo "<img src='img/evento_default.avif' alt='Imagen del evento'class='evento'>";
        //}


       

$fecha= convertirFechaES($row['evento_fecha']);

        
        echo "<h2>{$row['evento_nombre']}</h2>
      <p> $fecha</p> <!-- Aquí se usa directamente la fecha del evento -->
      <p>Horario: ".date("H:i", strtotime($row['evento_horario']))."</p>
      <p>Lugar: {$row['direccion_nombre']}</p>

            
        </div>
        </li>";
    }
    echo "</ul>";
    echo "</a>";
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
<?php
// Incluir la conexión a la base de datos
require_once 'bloques/_config.php'; // o 'db.php' si es otro archivo

// Definir el mes y el año actuales
$month = isset($_GET['month']) ? $_GET['month'] : date('m');
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');

// Número de días en el mes y el primer día del mes
$firstDayOfMonth = strtotime("$year-$month-01");
$daysInMonth = date('t', $firstDayOfMonth);

// Primer día de la semana del mes
$firstDayWeek = date('w', $firstDayOfMonth);

// Array con los nombres de los meses
$months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Eventos Culturales</title>
    <link rel="stylesheet" href="styles.css"> <!-- Incluir tu archivo CSS aquí -->
</head>
<body>

<h1>Agenda Cultural de Gijón - <?php echo $months[$month - 1] . ' ' . $year; ?></h1>

<!-- Mostrar el calendario -->
<div class="calendar">
    <table>
        <thead>
            <tr>
                <th><a href="?month=<?php echo ($month == 1) ? 12 : $month - 1; ?>&year=<?php echo ($month == 1) ? $year - 1 : $year; ?>">&lt;</a></th>
                <th colspan="5"><?php echo $months[$month - 1] . ' ' . $year; ?></th>
                <th><a href="?month=<?php echo ($month == 12) ? 1 : $month + 1; ?>&year=<?php echo ($month == 12) ? $year + 1 : $year; ?>">&gt;</a></th>
            </tr>
            <tr>
                <th>Lun</th>
                <th>Mar</th>
                <th>Mié</th>
                <th>Jue</th>
                <th>Vie</th>
                <th>Sáb</th>
                <th>Dom</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Crear las filas del calendario
            $currentDay = 1;

            // Llenar la primera fila con los días previos si es necesario
            for ($i = 0; $i < $firstDayWeek; $i++) {
                echo "<td></td>";
            }

            // Llenar el calendario con los días
            for ($day = $currentDay; $day <= $daysInMonth; $day++) {
                if ($firstDayWeek == 7) {
                    echo "</tr><tr>";
                    $firstDayWeek = 0;
                }

                // Comprobar si hay eventos para este día
                $event_date = "$year-$month-" . str_pad($day, 2, '0', STR_PAD_LEFT);
                $sql = "SELECT COUNT(*) AS evento_count FROM eventos WHERE evento_fecha = '$event_date'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $event_count = $row['evento_count'];

                echo "<td><a href='eventos.php?fecha=$event_date'>$day" . ($event_count > 0 ? " <span class='event-count'>$event_count</span>" : "") . "</a></td>";

                $firstDayWeek++;
            }

            // Rellenar el resto de la fila si es necesario
            while ($firstDayWeek < 7) {
                echo "<td></td>";
                $firstDayWeek++;
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

</aside>

</div>


<? include 'bloques/_footer.php'; ?>
