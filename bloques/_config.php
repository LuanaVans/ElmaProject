
<!--_config.php-->
<?
//Modo desarrollo 
const DEBUG= true;

//DATOS
const SITENAME= "Opel";
const LANG= "es";
const URL = "http://localhost:8080";

const DATOS = [
    'direccion' => 'Calle 123',
    'ciudad'    => 'Ciudad 1',
    'email'     => 'opel@opel.com',
    'pais'      => 'Pais 1',
    'tel'       => '123456789',
    'gps'       => '123.456.789'
];

const MENU = [
    [
        'texto' => 'Inicio',
        'url'   => '/', 
        'clase' => '',
        'target' => 0
    ],
    [
        'texto' => 'Contacto',
        'url'   => 'contacto.php',         
        'clase' => '',
        'target' => 0
    ],
    [
        'texto' => 'Log In',
        'url'   => 'logIn.php', 
        'clase' => '',
        'target' => 0
    ]
];
//Llamar a contruir menú. Ejemplo de llamada a la función: contruirMenu(MENU2, false)
//Función que construirá nuestros menús, los valores por defecto son MENU y true
function construirMenu($array=MENU, $nav=true)
{
    
    $miHTML = '<ul>';
    foreach($array as $item)
    {
        $miHTML .= "<li><a href='{$item['url']}' target='{$item['target']}' class='{$item['clase']}'>{$item['texto']}</a></li>";
    }
    $miHTML .= '</ul>';

    if($nav){
        $miHTML = "<nav>$miHTML</nav>";
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

<? const TITULO= "Descubre tu momento"; ?>

<!--para la base de datos -->
<?php

const HOST = "localhost";
const USER = "root";
const PASS = "root";
const DBNA = "xperience";

function consulta($sql);
// Create connection
$conn = mysqli_connect( HOST, USER, PASS, DBNA);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>



