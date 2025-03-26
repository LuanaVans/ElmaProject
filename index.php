<? require_once 'bloques/_config.php'; ?>
<? include 'bloques/_header.php'; ?>


    

<h1> Agenda Cultural de Gijón </h1>
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
    e.precio_min AS evento_precio_min,
    e.precio_max AS evento_precio_max,
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
        <div class='contenedor'>";
        
        if($row['evento_img'] != null)
        {
            echo "<img src='{$row['evento_img']}' alt='Imagen del evento'class='evento'>";
        }
       // else
        //{
            //echo "<img src='img/evento_default.avif' alt='Imagen del evento'class='evento'>";
        //}
        
        echo "<h2>{$row['evento_nombre']}</h2>
            <p>Fecha: ".date("d M Y", strtotime($row['evento_horario']))."</p>
            <p>Horario: ".date("H:i", strtotime($row['evento_horario']))."</p>
            <p>Lugar: {$row['direccion_nombre']}</p>
            
        </div>
        </li>";
    }
    echo "</ul>";
}

?>
</section>

<aside class="aside">
<h4>Calendario</h4>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendario de Eventos Culturales</title>
  <style>
    /* Estilos básicos para el calendario */
    .calendar { 
      display: grid; 
      grid-template-columns: repeat(7, 1fr); 
      gap: 5px; 
      text-align: center; 
    }
    .calendar div { 
      padding: 10px; 
      cursor: pointer; 
      border: 1px solid #ccc; 
    }
    .selected { 
      background-color: #4CAF50; 
      color: white; 
    }
    .disabled { 
      background-color: #ddd; 
      cursor: not-allowed; 
    }
    /* Estilos del encabezado */
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .month-year {
      font-size: 1.2em;
      font-weight: bold;
    }
    .button {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 5px 10px;
      cursor: pointer;
    }
    .button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <h1>Calendario de Eventos Culturales</h1>

  <!-- Contenedor de navegación del mes -->
  <div class="header">
    <button class="button" onclick="changeMonth(-1)">&#60; Anterior</button>
    <div class="month-year" id="monthYear"></div>
    <button class="button" onclick="changeMonth(1)">Siguiente &#62;</button>
  </div>

  <div id="calendar" class="calendar"></div>

  <h2>Eventos para el <span id="selectedDate">Seleccione una fecha</span></h2>
  <div id="events"></div>
  
  <script src="js/calendario.js"></script>



<ul> ¿Tienes Tiempo?
    <li><a href="lugares.php">Lugares de Interés</a></li>
    <li><a href="rutas.php">Rutas y Excursiones</a></li>
    <li><a href="museos.php">Museos</a></li>
    <li><a href="parques.php">Parques</a></li>
    <li><a href="bibliotecas.php">Bibliotecas</a></li>
    <li><a href="fiestas.php">Fiestas de Interés Cultural en Asturias</a></li>
</ul>
</aside>



<? include 'bloques/_footer.php'; ?>
