<? // filstrador ?>

<form action="c_filtro_resultados.php" method="GET">

<?
$sql="SELECT * FROM tipo_eventos;";
$resultado_array = mysqli_query($conn, $sql);

if (mysqli_num_rows($resultado_array) > 0) 
{
    echo "<select name='tipo' id='tipo'>";
    while ($row = mysqli_fetch_assoc($resultado_array)) 
    {
        echo "<option value='$row[id]'>$row[tipo]</option>";
    }
    echo "</select>";
}
?>

<input type="submit" value="Filtrar">
</form>


<?php
if(isset($_GET['tipo'])){
    $tipo=$_GET['tipo'];
    $sql="SELECT e.id AS evento_id,
    e.nombre AS evento_nombre,
    e.descripcion AS evento_descripcion,
    e.fecha AS evento_fecha,
    e.horario AS evento_horario,
    t.id AS id_tipo,
    t.tipo AS tipo,
    e.img AS evento_img FROM eventos e
JOIN evento_tipo et ON e.id = et.id_evento
JOIN tipo_eventos t ON et.id_tipo = t.id
WHERE t.id = $tipo;";
    $resultado_array = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($resultado_array) > 0) 
    {
        echo "<ul class='galeria'>";
        while ($row = mysqli_fetch_assoc($resultado_array)) 
        {
            echo "<li class='container'>
            <div class='contenedor'>
            <img src='$row[evento_img]' alt='$row[evento_nombre]'>
            <h2>$row[evento_nombre]</h2>
            <a href='ficha.php?id=$row[evento_id]'>Ver más</a>
            </div>
            </li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No hay eventos disponibles para este tipo.</p>";
    }
}

?>

