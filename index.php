<? require_once 'bloques/_config.php'; ?>
<? include 'bloques/_header.php'; ?>


<h1> Agenda Cultural de Gijón </h1>
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
    echo "<ul>";
    while ($row = mysqli_fetch_assoc($resultado_array)) 
    {
        echo "<li class='container'>
        <div class='contenedor'>";
        
        if($row['evento_img'] != null)
        {
            echo "<img src='{$row['evento_img']}' alt='Imagen del evento'class='evento'>";
        }
        else
        {
            echo "<img src='img/evento_default.avif' alt='Imagen del evento'class='evento'>";
        }
        
        
        echo "</div>
        <div class='contenedor'>
        <h2>{$row['evento_nombre']}</h2>
            <p>Fecha: ".date("d M Y", strtotime($row['evento_horario']))."</p>
            <p>Horario: ".date("H:i", strtotime($row['evento_horario']))."</p>
            <p>Lugar: {$row['direccion_nombre']}</p>
            <p>Dirección: {$row['direccion_direccion']}</p>
            <p>Tipo: {$row['evento_tipo']}</p>
        </div>
        </li>";
    }
    echo "</ul>";
}

?>

<? include 'bloques/_footer.php'; ?>