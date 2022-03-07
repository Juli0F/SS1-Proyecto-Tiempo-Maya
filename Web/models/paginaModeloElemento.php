<?php

use function PHPSTORM_META\type;

session_start(); ?>
<?php

$conn = include '../conexion/conexion.php';
$tabla = $_GET['elemento'];
$table = strtolower($tabla);
$datos = $conn->query("SELECT nombre,significado,htmlCodigo FROM tiempo_maya." . $table . ";");
$elementos = $datos;
$informacion = $conn->query("SELECT htmlCodigo FROM tiempo_maya.pagina WHERE nombre='" . $tabla . "';");



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tiempo Maya - <?php echo $tabla; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <?php include "../blocks/bloquesCss.html" ?>
    <link rel="stylesheet" href="../css/estilo.css?v=<?php echo (rand()); ?>" />
    <link rel="stylesheet" href="../css/paginaModelo.css?v=<?php echo (rand()); ?>" />


</head>
<?php include "../NavBar2.php" ?>

<body>
    <section id="inicio">
        <div id="inicioContainer" class="inicio-container">
            <?php echo "<h1>" . $tabla . " </h1>"; ?>
            <a href='#informacion' class='btn-get-started'>Informacion</a>
            <a href='#elementos' class='btn-get-started'>Elementos</a>
        </div>
    </section>
    <section id="information">
        <div class="container">
            <div class="row about-container">
                <div class="section-header">
                    <h3 class="section-title">INFORMACION</h3>
                </div>
                <div id="player"></div>
                
                <?php foreach ($informacion as $info) {
                    echo $info['htmlCodigo'];
                } ?>
            </div>

        </div>
    </section>
    <hr>




    <!--<div id="elementos" class="container-fluid" >-->
    <div class="row">
        <div  style="position: relative; top: 40px; left: 40px;" class="col-2">
        <img src='../imgs/maya/calendario haab.svg'>
        </div>
        
        <div class="col-8">
            <?php

            foreach ($datos as $dato) {

                $r_char = array("'", "´");
                $stringPrint = "<div class='card div_interno'  >";
                $name = trim(str_replace($r_char, "", $dato['nombre']));
                //$stringPrint .= "<img style='width: 20rem;' class='card-img-top' src='../imgs/maya/". $name . ".svg' alt='Card image cap' >";
                echo   $name;
                $stringPrint .= "<div class='card-body  ' style='border-style: groove;'>";

                $stringPrint .= "<div class='card div_interno'>";
                $stringPrint .= "<div class='card-body' style='border-style: groove;'>";
                $stringPrint .= "<img style=''  src='../imgs/maya/" . $name . ".svg'>";
                $stringPrint .= "<h3 class='section-title  div_interno text-center' id='" . $dato['nombre'] . "'>" . $dato['nombre'] . ":    " . $dato['significado'] . "</h3>";
                $stringPrint .= "</div>";
                $stringPrint .= "</div>";

                $stringPrint .= "<div class='card-text'>" . $dato['htmlCodigo'] . "</div> </div></div>";
                $stringPrint .= "<br/><br/>";

                echo $stringPrint;
            }
            ?>
        </div>

        <div class="col-2">
            
        </div>
    </div>
    
    
    <?php include "../blocks/bloquesJs.html" ?>




</body>

</html>