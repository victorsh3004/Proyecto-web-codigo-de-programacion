<?php

require 'conexion.php';

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$estado_civil = $_POST['estado_civil'];
$hijos = isset($_POST['hijos']) ? $_POST['hijos'] : 0;
$intereses = isset($_POST['intereses']) ? $_POST['intereses'] : null;

$arrayIntereses = null;
if($intereses == null){
  $num_array=0;  
}else
$num_array = count($intereses);

$contador = 0;

if($num_array>0){
    foreach ($intereses as $key => $value) {
        if ($contador != $num_array-1)
            $arrayIntereses .= $value.' ';
        else
            $arrayIntereses .= $value;
        $contador++;
    }
}

$sql = "UPDATE personas SET nombre='$nombre', email='$email', telefono='$telefono', estado_civil='$estado_civil', hijos='$hijos', intereses='$arrayIntereses',estado=0 WHERE id = '$id'";
$resultado = $mysqli->query($sql);
$id_insert = $id;


/*Agregamos un arreglo con los archivos que vamos a permitir guardar ejemplo:
    $permitidos = array("image/gif","image/png","application/pdf");
    */
    $permitidos = array("image/gif","image/png","application/pdf");

    //tamaño limete del archivo
    $limite_kb = 500;

    if ($_FILES["archivo"]["error"][$key]>0) {
        echo "Error al cargar el archivo";
    }else{
        //Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
        foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name){

            if(in_array($_FILES["archivo"]["type"][$key], $permitidos) && $_FILES["archivo"]["size"][$key]<= $limite_kb * 1024){

                //Validamos que el archivo exista
                if($_FILES["archivo"]["name"][$key]) {
                    $filename = $_FILES["archivo"]["name"][$key]; //Obtenemos el nombre original del archivo
                    $source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
                    
                    $directorio = 'files/'.$id_insert.'/'; //Declaramos un  variable con la ruta donde guardaremos los archivos
                    
                    //Validamos si la ruta de destino existe, en caso de no existir la creamos
                    if(!file_exists($directorio)){
                        mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");    
                    }
                    
                    $dir=opendir($directorio); //Abrimos el directorio de destino
                    $target_path = $directorio.'/'.$filename; //Indicamos la ruta de destino, así como el nombre del archivo
                    
                    //Movemos y validamos que el archivo se haya cargado correctamente
                    //El primer campo es el origen y el segundo el destino
                    if(move_uploaded_file($source, $target_path)) { 
                        echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
                    } else {    
                        echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
                    }
                        closedir($dir); //Cerramos el directorio de destino
                }
            }       
        }
    }





/*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

/*=============================================
=            validacion para un solo archivo           =
=============================================*/


/*Aceptamos archivos con FILES*/
//if ($_FILES["archivo"]["error"]>0) {
//    echo "Error al cargar el archivo";
//}else{
//    /*Agregamos un arreglo con los archivos que vamos a permitir guardar ejemplo:
//    $permitidos = array("image/gif","image/png","application/pdf");
//    */
//    $permitidos = array("image/gif","image/png","application/pdf");
//
    //tamaño limete del archivo
//    $limite_kb = 500;

//    if(in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"]<= $limite_kb * 1024){
//        $ruta='files/'.$id_insert.'/';
//        $archivo = $ruta.$_FILES["archivo"]["name"];

        //Verificamos si la ruta existe, sino la creamos con mkdir
//        if (!file_exists($ruta)) {
//            mkdir($ruta);
//        }

        //Restricciones para achivos duplicados sino reemplaza el archivo antiguo
//        if (!file_exists($archivo)) {
            //guardamos
 //           $resultado = @move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo); //regresa true o false
//            if ($resultado) {
//                echo "Archivo Guardado";
//            }else{
//                echo "Error al guardar archivo";
//            }
//        }else{
//            echo "Archivo ya existe";
//        }

//    }else{
//        echo "Archivo no permitido o excede el tamaño";
//   }
//}


/*=====  End of Section comment block  ======*/






?>


<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="fonts.css"><!--  https://icomoon.io/app/#/select/font  -->


</head>
<body>
    <div class="container">
        <div class="row">
            <div class="row" style="text-align:center">
                <?php if($resultado) { ?>
                    <h3>REGISTRO MODIFICADO</h3>
                <?php } else { ?>
                    <h3>ERROR AL MODIFICAR</h3>
                <?php } ?>

                <a href="index.php" class="btn btn-primary">Regresar</a>

            </div>
        </div>
    </div>

    <script src="js/jquery-3.5.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
</body>
</html>