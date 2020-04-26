<?php
    
    require 'conexion.php';

    $id = $_GET['id'];    
    $sql = "UPDATE personas SET estado=1 WHERE id = '$id'";
    $resultado = $mysqli->query($sql);
    //$id_insert = $mysqli->insert_id;
    //die ("el id eliminado es : ".$id);
    //eliminarDir('files/'.$id);


    function eliminarDir($carpeta){
        foreach (glob($carpeta . "/*") as $archivo_carperta) {
            if (is_dir($archivo_carperta)) {
                eliminarDir($archivo_carperta);
            }else{
                unlink($archivo_carperta);
            }
        }
        rmdir($carpeta);
    }
    
?>

<html lang="es">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="fonts.css"><!--  https://icomoon.io/app/#/select/font  -->
        
        
    </head>
   <div class="container">
            <div class="row">
                <div class="row" style="text-align:center">
                <?php if($resultado) { ?>
                <h3>REGISTRO ELIMINADO</h3>
                <?php } else { ?>
                <h3>ERROR AL ELIMINAR</h3>
                <?php } ?>
                
                <a href="index.php" class="btn btn-primary">Regresar</a>
                
                </div>
            </div>
        </div>

        <script src="js/jquery-3.5.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script> 
    </body>
</html>