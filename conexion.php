<?php 

$mysqli = new mysqli('localhost','root', '', 'personal');

/*ejemplo de ruta
Servidor local: 127.0.0.1
servidor en otra pc con la IP: 192.168.1.2
Servidor en internet con DNS: miservidor.com 
*/

/*Comprobando conexion*/
if($mysqli->connect_error){
	die ('Error en la conexion'. $mysqli->connect_error);
}else{
	/*printf("Servidor Informacion: %s\n", $mysqli->server_info);*/
}

 ?>