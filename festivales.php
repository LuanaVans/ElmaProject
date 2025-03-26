<? require_once 'bloques/_config.php'; ?>
<? include 'bloques/_header.php'; ?>

<h1 >Festivales</h1>
<p class="festiv">Asturias es el lugar perfecto para disfrutar de festivales únicos que combinan música, arte, gastronomía y tradición. Durante todo el año, nuestra región se llena de vida con eventos que celebran la cultura local y el talento internacional. Ya sea que te atraigan los conciertos en la playa, las fiestas tradicionales o los festivales de cine, Asturias tiene algo para todos. ¡Descubre los mejores festivales en Asturias y no te pierdas la oportunidad de vivir una experiencia inolvidable en este paraíso del norte de España!</p>




<?
$ruta="json/festivales2.json";


//mostrar los datos obtenidos en una lista de HTML


//recorremos el array para mostrar todos los datos
$miArray=cargarJSON($ruta);
echo '<ul class="festilista">';
foreach ($miArray['festivales'] as $miFestival) {
    echo "<li class='item'>
    <img class='imagen' src='{$miFestival['imagen']}' alt='{$miFestival['nombre']}'>
    <div class='info'> 

    <h2>{$miFestival['nombre']}</h2>

    <p class='festi'>{$miFestival['fecha']}</p>
    <p class='festi'>{$miFestival['lugar']}</p>
    <p class='festi'>{$miFestival['descripcion']}</p>
    
    
    </div>
    </li>";
}

    echo '</ul>';

    ?>









<? include 'bloques/_footer.php'; ?>