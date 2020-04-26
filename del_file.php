<?php 
$file = $_POST['id'];
echo "Entre";
//indicamos si este elemento es un archivo
if(is_file($file)){
	//damos permisos al script
	chmod($file,0777);

	//validacion si el archivo se elimino
	if (!unlink($file)) {
		echo false;
	}
}


 ?>