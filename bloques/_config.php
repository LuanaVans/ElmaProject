
<!--_config.php-->
<?
//Modo desarrollo 
const DEBUG= true;

//DATOS
const SITENAME= "Entérate Gijón";
const LANG= "es";
const URL = "http://localhost:8080";





const MENU = [
    [
        'texto' => 'Inicio',
        'url'   => 'index.php', 
        'clase' => '',
        'target' => 0
    ],
    [
        'texto' => 'Festivales',
        'url'   => 'Festivales.php',         
        'clase' => '',
        'target' => 0
    ],
    [
        'texto' => 'Sobre Nosotros',
        'url'   => 'nosotros.php', 
        'clase' => '',
        'target' => 0
    ],
    [
        'texto' => 'Contacto',
        'url'   => 'contacto.php', 
        'clase' => '',
        'target' => 0
    ]
];

//Función que construirá el menú del header, los valores por defecto son MENU y true
function construirMenu($array=MENU, $nav=true)
{
    
    $miHTML = '<ul class="headermenu">';
    foreach($array as $item)
    {
        $miHTML .= "<li><a href='{$item['url']}' target='{$item['target']}' class='{$item['clase']}'>{$item['texto']}</a></li>";
    }
    $miHTML .= '</ul>';

    if($nav){
        $miHTML = "<nav class='menu'>$miHTML</nav>";
    }

    return $miHTML;
}





//Función que se asegura de sanitizar el código
function limpiar($aLimpiar){
    return htmlspecialchars($aLimpiar, ENT_QUOTES, 'UTF-8');
}




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

<? const TITULO= "Entérate Gijón"; ?>

<!--para la base de datos -->
<?php

const HOST = "localhost";
const USER = "root";
const PASS = "root";
const DBNA = "xperience";

// Create connection
$conn = mysqli_connect(HOST, USER, PASS, DBNA);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>


