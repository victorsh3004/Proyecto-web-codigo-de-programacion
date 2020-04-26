<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!--<link rel="stylesheet" href="css/bootstrap-theme.css">-->
	<link rel="stylesheet" href="css/estilos.css">


</head>

<body>
	<div class="container">
		<div class="row">
			<h3 style="text-align:center">NUEVO REGISTRO</h3>
		</div>
		<!-- Para agregar archivos agregamos: enctype="multipart/form-data"-->
		<form class="form-horizontal" method="POST" action="guardar.php" enctype="multipart/form-data" autocomplete="off">
			<div class="form-group">
				<label for="nombre" class="col-sm-2 control-label">Nombre</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-sm-2 control-label">Email</label>
				<div class="col-sm-10">
					<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
				</div>
			</div>

			<div class="form-group">
				<label for="telefono" class="col-sm-2 control-label">Telefono</label>
				<div class="col-sm-10">
					<input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Telefono">
				</div>
			</div>

			<div class="form-group">
				<label for="estado_civil" class="col-sm-2 control-label">Estado Civil</label>
				<div class="col-sm-10">
					<select class="form-control" id="estado_civil" name="estado_civil">
						<option value="SOLTERO">SOLTERO</option>
						<option value="CASADO">CASADO</option>
						<option value="OTRO">OTRO</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="hijos" class="col-sm-2 control-label">¿Tiene Hijos?</label>

				<div class="col-sm-10">
					<label class="radio-inline">
						<input type="radio" id="hijos" name="hijos" value="1" checked> SI
					</label>

					<label class="radio-inline">
						<input type="radio" id="hijos" name="hijos" value="0"> NO
					</label>
				</div>
			</div>

			<div class="form-group">
				<label for="intereses" class="col-sm-2 control-label">INTERESES</label>

				<div class="col-sm-10">
					<label class="checkbox-inline">
						<input type="checkbox" id="intereses[]" name="intereses[]" value="Libros"> Libros
					</label>

					<label class="checkbox-inline">
						<input type="checkbox" id="intereses[]" name="intereses[]" value="Musica"> Musica
					</label>

					<label class="checkbox-inline">
						<input type="checkbox" id="intereses[]" name="intereses[]" value="Deportes"> Deportes
					</label>

					<label class="checkbox-inline">
						<input type="checkbox" id="intereses[]" name="intereses[]" value="Otros"> Otros
					</label>
				</div>
			</div>
			
			<!-- para restringir el tipo de archivos agregamos accept="image/*" (*) por: jpg, png, gif, jpeg 
			Para archivos pdf accept="aplication/pdf"
			-->
			<div class="form-group">
				<label for="archivo" class="col-sm-2 control-label">Archivo</label>
				<div class="col-sm-10">
					<input type="file" class="form-control" id="archivo[]" name="archivo[]" multiple="">
				</div>
				<!--
				<div class="col-sm-10">
					<input type="file" class="form-control" id="archivo" name="archivo" >
				</div>
				-->
			</div>

			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<a href="index.php" class="btn btn-default">Regresar</a>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
			</div>
		</form>
	</div>
	<script src="js/jquery-3.5.0.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>