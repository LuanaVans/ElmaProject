<? require_once 'bloques/_config.php'; ?>
<? include 'bloques/_header.php'; ?>


    

<h1> Agenda Cultural de Gijón </h1>
<p class="festiv">Descubre la agenda cultural de Gijón, donde cada día ofrece nuevas oportunidades para disfrutar de arte, música, teatro y eventos únicos. Mantente al tanto de las actividades más destacadas y no te pierdas lo mejor de nuestra ciudad</p>

<section class="newsletter">
    <h2>Suscríbete a nuestra Newsletter</h2>
    <form action="procesar_newsletter.php" method="POST">
        <input type="email" name="email" placeholder="Introduce tu email" required>
        <button type="submit">Suscribirse</button>
    </form>
    <div id="newsletterModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Suscríbete a nuestra Newsletter</h2>
        <form action="procesar_newsletter.php" method="POST">
            <input type="email" name="email" placeholder="Introduce tu email" required>
            <button type="submit">Suscribirse</button>
        </form>
    </div>
</div>
<button id="openModal">Suscribirse</button>

    <script>
        // Obtener el modal
        var modal = document.getElementById("newsletterModal");

        // Obtener el botón que abre el modal
        var btn = document.getElementById("openModal");

        // Obtener el elemento <span> que cierra el modal
        var span = document.getElementsByClassName("close")[0];

        // Cuando el usuario hace clic en el botón, abrir el modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // Cuando el usuario hace clic en <span> (x), cerrar el modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Cuando el usuario hace clic en cualquier parte fuera del modal, cerrarlo
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</section>


  
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






<? include 'bloques/_footer.php'; ?>
