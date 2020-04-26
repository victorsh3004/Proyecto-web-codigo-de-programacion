<?php
require 'conexion.php';

$id = $_GET['id'];

$sql = "SELECT * FROM personas WHERE id = '$id'";
$resultado = $mysqli->query($sql);
$row = $resultado->fetch_array(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <link rel="stylesheet" href="fonts.css"><!--  https://icomoon.io/app/#/select/font  -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">




</head>

<body>
    <div class="container">
        <div class="row">
            <h3 style="text-align:center">MODIFICAR REGISTRO</h3>
        </div>

        <!-- Para agregar archivos agregamos: enctype="multipart/form-data"-->
        <form class="form-horizontal" method="POST" action="update.php" enctype="multipart/form-data" autocomplete="off">
       
            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $row['nombre']; ?>" required>
                </div>
            </div>

            <!--type="hidden" (oculto)-->
            
            <input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>" >

            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $row['email']; ?>"  required>
                </div>
            </div>

            <div class="form-group">
                <label for="telefono" class="col-sm-2 control-label">Telefono</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Telefono" value="<?php echo $row['telefono']; ?>" >
                </div>
            </div>

            <div class="form-group">
                <label for="estado_civil" class="col-sm-2 control-label">Estado Civil</label>
                <div class="col-sm-10">
                    <select class="form-control" id="estado_civil" name="estado_civil">
                        <option value="SOLTERO" <?php if($row['estado_civil']=='SOLTERO') echo 'selected'; ?>>SOLTERO</option>
                        <option value="CASADO" <?php if($row['estado_civil']=='CASADO') echo 'selected'; ?>>CASADO</option>
                        <option value="OTRO" <?php if($row['estado_civil']=='OTRO') echo 'selected'; ?>>OTRO</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="hijos" class="col-sm-2 control-label">¿Tiene Hijos?</label>

                <div class="col-sm-10">
                    <label class="radio-inline">
                        <input type="radio" id="hijos" name="hijos" value="1" <?php if($row['hijos']=='1') echo 'checked'; ?>> SI
                    </label>

                    <label class="radio-inline">
                        <input type="radio" id="hijos" name="hijos" value="0" <?php if($row['hijos']=='0') echo 'checked'; ?>> NO
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="intereses" class="col-sm-2 control-label">INTERESES</label>

                <div class="col-sm-10">
                    <label class="checkbox-inline">
                        <input type="checkbox" id="intereses[]" name="intereses[]" value="Libros" <?php if(strpos($row['intereses'], "Libros")!== false) echo 'checked'; ?>> Libros
                    </label>

                    <label class="checkbox-inline">
                        <input type="checkbox" id="intereses[]" name="intereses[]" value="Musica" <?php if(strpos($row['intereses'], "Musica")!== false) echo 'checked'; ?>> Musica
                    </label>

                    <label class="checkbox-inline">
                        <input type="checkbox" id="intereses[]" name="intereses[]" value="Deportes" <?php if(strpos($row['intereses'], "Deportes")!== false) echo 'checked'; ?>> Deportes
                    </label>

                    <label class="checkbox-inline">
                        <input type="checkbox" id="intereses[]" name="intereses[]" value="Otros" <?php if(strpos($row['intereses'], "Otros")!== false) echo 'checked'; ?>> Otros
                    </label>
                </div>
            </div>
                <!-- para restringir el tipo de archivos agregamos accept="image/*" (*) por: jpg, png, gif, jpeg 
            Para archivos pdf accept="aplication/pdf"
        -->
        <div class="form-group">
            <label for="archivo" class="col-sm-2 control-label">Archivo</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="archivo[]" name="archivo[]" multiple="" >

                <?php 
                $path = "files/".$id;
                if(file_exists($path)){
                    $directorio = opendir($path);
                    while ($archivo = readdir($directorio)) {
                        if (!is_dir($archivo)){
                            echo "<div data='".$path."/".$archivo."'><a href='".$path."/".$archivo."' title='Ver Archivo Adjunto'><span class='icon-image'></span></a>";
                            echo "$archivo <a href='#' class='delete' title='Ver Archivo Adjunto'><span class='icon-trash' aria-hidden='true'></span></a></div>";
                            echo "<img src='files/$id/$archivo' width='300' />";
                        }
                    }
                }
                ?>


            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <a href="index.php" class="btn btn-default">Regresar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>
</div>




<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>




<script type="text/javascript">
    $(document).ready(function(){
        $('.delete').click(function(){
            alert("Hola");   
            var parent = $(this).parent().attr('id');
            
            var service = $(this).parent().attr('data');
            
            var dataSrting = 'id='+service;
            

            $.ajax({
                type:   "POST",
                url:    "del_file.php",
                data:   dataSrting,
                success: function(){
                    location.reload();
                }
            });
        });
    });
</script>

</body>
</html>