<?php 
require 'conexion.php';

$nombre 		= $_POST['nombre'];
$email 			= $_POST['email'];
$telefono 		= $_POST['telefono'];
$estado_civil 	= $_POST['estado_civil'];
$hijos 			= isset($_POST['hijos']) ? $_POST['hijos'] : 0; /*condicional para cuando no se coloque ninguna opcion, sino toma la opcion 0*/
$intereses 		= isset($_POST['intereses']) ? $_POST['intereses'] : null; /*en este caso null por que es un arreglo*/

$arrayIntereses = null;

/*contamos el numero de elementos*/
if($intereses == null){
	$num_array=0;  
}else
$num_array = count($intereses);
$contador = 0;

/*Evaluamos*/
if($num_array>0){
	foreach ($intereses as $key => $value) {
		if ($contador != $num_array-1) {
			$arrayIntereses .= $value.' ';
		}else
		$arrayIntereses .= $value;
		$contador++;
	}
}



/*Ajecutamos el query*/

$sql = "INSERT INTO personas (nombre, email, telefono, estado_civil, hijos, intereses, estado) VALUES ('$nombre', '$email', '$telefono', '$estado_civil', '$hijos', '$arrayIntereses', 0)";
/*llamamos a la funcion query y el $resultado sera un valor boleano*/
$resultado = $mysqli->query($sql);

$id_insert = $mysqli->insert_id;




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





















/*---------------------------------------------------------------------------------------------------------------------------------------*/





?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!--<link rel="stylesheet" href="css/bootstrap-theme.css">-->
	<link rel="stylesheet" href="css/estilos.css">

	<script src="js/jquery-3.5.0.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="row" style="text-align: center">
				<?php if($resultado){ ?>
					<h3>Registro Guardado</h3>
				<?php } else {  ?>
					<h3>Error al guardar</h3>				
				<?php }  ?>

				<a href="index.php" class="btn btn-primary">Regresar</a>
			</div>
		</div>
	</div>
</body>