<!--_config.php-->
<? 
const SITENAME= "Opel";
const LANG= "es";
const DEBUG= true;

// FUNCIÓN PARA EL TÍTULO SI CUENTA CON TÍTULO DE PAARTADO LO ESCRIBE Y SI NO, ESCRIBE EL APARTADO DE LA WEB
function titulo($ponerSiteTitulo=true)
{
    if(defined('TITULO'))
    {
        echo TITULO;
    }

    if(defined('TITULO')&&$ponerSiteTitulo)
    {
    echo " - ";
    }
    
    if($ponerSiteTitulo)
    {
        echo SITENAME;
    }

    if(!defined("TITULO"))
    {
    debug("titulo no definido");
    }
}

function debug($texto)
{
    if(DEBUG)
    {
    echo "<div class='debug'>$texto</div>";
    }
}



?>

<? const TITULO= "Descubre tu momento"; ?>
<!--_header.php-->

<!DOCTYPE html>
<html lang="<?=LANG?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><? titulo() ?></title>
</head>
    
<body>
  <header>
    <div class="logo"><?=SITENAME?></div>
</header>
<main>

    <h1><? titulo(false) ?></h1>

<!--_footer.php-->
</main> 
<footer>
<p>&copy;Copyright <?=SITENAME?> <?=date('Y')?> </p>
</footer>       
</body>
</html>