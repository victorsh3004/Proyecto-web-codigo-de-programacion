<?php 
require 'conexion.php';
/*referencia
https://es.stackoverflow.com/questions/86094/mostrar-informaci%C3%B3n-de-un-solo-tipo-de-usuario-administrador-o-paciente-en-dat
*/

/*Nombre de la tabla*/
$sTabla = "personas";

/*Array que contiene los nombres de las columnas de la tabla*/
$aColumnas = array ('id', 'nombre', 'email', 'telefono');

/* Columna indexada*/
$sIndexcolumn = "id";

/*Paginacion*/
$sLimit = "";
if(isset( $_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1'){
	$sLimit = "LIMIT ".$_GET['iDisplayStart'].", ".$_GET['iDisplayLength'];
}

//Ordenacion
if(isset($_GET['iSortCol_0'])){
	$sOrder = "ORDER BY  ";
	for ($i=0; $i < intval($_GET['iSortingCols']); $i++) { 
		if ($_GET['bSortable_'.intval($_GET['iSortCol_'.$i])] == "true") {
			$sOrder .= $aColumnas[ intval( $_GET['iSortCol_'.$i])]."
			".$_GET['sSortDir_'.$i] .", ";
		}
	}

	$sOrder = substr_replace( $sOrder, "", -2);
	if( $sOrder == "ORDER BY"){
		$sOrder = "";
	}

}

//Filtracion
$sWhere = "WHERE estado=0";
if( $_GET['sSearch'] != ""){
	$sWhere = "WHERE (";
	for ($i=0; $i < count($aColumnas); $i++) { 
		$sWhere .= $aColumnas[$i]." LIKE '%".$_GET['sSearch']."%' OR ";
	}
	$sWhere = substr_replace($sWhere, "", -3);
	$sWhere .= ')';
}

//Filtrado de columna individual
for ($i=0; $i < count($aColumnas); $i++) { 
	if ($_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '') {
		if ($sWhere == "") {
			$sWhere = "WHERE ";
		}else
		$sWhere .= " AND ";

		$sWhere .= $aColumnas[$i]." LIKE '%".$_GET['sSearch_'.$i]."%' ";
	}
}

//Obtener datos para mostrar SQL queries
$sQuery= "
SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumnas))."
FROM  $sTabla
$sWhere 
$sOrder
$sLimit 
";
$rResult = $mysqli->query($sQuery); 


/* Data set length after filtering */
$sQuery = "
SELECT FOUND_ROWS()
";
$rResultFilterTotal = $mysqli->query($sQuery);
$aResultFilterTotal = $rResultFilterTotal->fetch_array();
$iFilteredTotal = $aResultFilterTotal[0];

/*Total data set length*/
$sQuery = "
SELECT COUNT(".$sIndexcolumn.")
FROM $sTabla
";
$rResultTotal = $mysqli->query($sQuery);
$aResultTotal = $rResultTotal->fetch_array();
$iTotal = $aResultTotal[0];

/*
	*Output
*/
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);

	while ($aRow = $rResult->fetch_array()) {
		$row = array();
		for ($i=0; $i < count($aColumnas); $i++) { 
			if ($aColumnas[$i] == "version") {
				/* Special output formatting for 'version' column*/
				$row[] = ($aRow[ $aColumnas[$i] ] == "0") ? '-' : $aRow[ $aColumnas [$i]];

			}else if( $aColumnas[$i] != ' '){
				/*General output */
				$row[] = $aRow[ $aColumnas[$i]];
			}
		}

		$row[] = "<td><a href='modificar.php?id=".$aRow['id']."'><span class='icon-new-message'></span></a></td>";
		$row[] = "<td><a href='#' data-href='eliminar.php?id=".$aRow['id']." 'data-toggle='modal' data-target='#confirm-delete'><span class='icon-remove-user'></span></a></td>";
		$output['aaData'][] = $row;
	}
	echo json_encode($output);

	?>

