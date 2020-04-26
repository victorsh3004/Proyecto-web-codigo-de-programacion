<?php
require 'conexion.php';


?>

<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="fonts.css"><!--  https://icomoon.io/app/#/select/font  -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!--    Datatables  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/> 





</head>

<body>
   <div class="container">
    <div class="row">
        <h2 style="text-align:center">Curso de PHP y MySQL</h2>
    </div>

    <div class="row">
        <a href="nuevoRegistro.php" class="btn btn-primary">Nuevo Registro</a>       
    </div>

    <br>

    <div class="row table-responsive">
        <table class="table table-striped display" id="mitabla"> <!--<table class="table table-striped">-->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
                </div>

                <div class="modal-body">
                    ¿Desea eliminar este registro?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok">Delete</a>
                </div>
            </div>
        </div>
    </div>







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    <!--    Datatables-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script> 
    <script>

        $(document).ready(function(){
            $('#mitabla').DataTable({
                "order": [[1, "asc"]],
                "language":{
                    "lengthMenu": "Mostrar _MENU_ registros por pagina",
                    "info": "Mostrando pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrada de _MAX_ registros)",/*"infoFiltered": "(filtrada de _MAX_ registros)",*/
                    "loadingRecords": "Cargando...",
                    "processing":     "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords":    "No se encontraron registros coincidentes",
                    "paginate": {
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    },                  
                },
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "server_process.php"
            }); 
        }); 

    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
    });



</script> 


</body>
</html>