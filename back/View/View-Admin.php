<?php
session_start();
if ($_SESSION["username"] == "") {
    header("Location: http://admin.menjadorescola.me/");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Hacer un view para cada read?? -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read_All</title>

    <!-- css -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.7/css/select.bootstrap4.min.css" />

    <link rel="stylesheet" href="../public/css/estils.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />

    <!-- js -->


    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>


</head>

<body>

    <div class="container-fluid">
        <?php require_once "navbar.php" ?>
    </div>

    <style>

    </style>

    <div class="container" style="margin-bottom: 10%; margin-top: 2%;">
            <div aria-label="breadcrumb" style="margin-bottom: 3%;">
                <ol class="breadcrumb bg-transparent px-0">
                    <li class="breadcrumb-item active">Pagina Escuela Admin</li>
                    <li class="breadcrumb-item active" aria-current="page">Administrar Padres</li>
                </ol>
            </div>
        <h1>Administrar Padres</h1>
        <button type="input" title="A??adir Padre" class='btn btn-dark' name='afegirpare' data-toggle='modal' data-target='#ModalPare'><i class='fas fa-plus-circle'></i></button>
        <table id="table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="head">Nombre</th>
                    <th class="head">Apellidos</th>
                    <th class="head">DNI</th>
                    <th class="head">Hijos</th>
                    <th class="head"></th>
                </tr>
            </thead>
        </table>
    </div>

    <!--MODAL FORMULARI PARE-->
    <div class="modal fade" id="ModalPare" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Insertar Padre</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="insert/parent" class="needs-validation" method="post" id="form" name="f1" novalidate>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nompare"><strong>NOMBRE PADRE:</strong></label>
                            <input type="text" class="form-control" required name="nompare" id="nompare">
                            <div class="invalid-feedback">
                                Porfavor, ponga un nombre.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="llinatgepare"><strong>APELLIDO PADRE:</strong></label>
                            <input type="text" class="form-control" required name="llinatgepare" id="llinatgepare">
                            <div class="invalid-feedback">
                                Porfavor, ponga un apellido.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dnipare"><strong>DNI PADRE:</strong></label>
                            <input type="text" class="form-control" required name="dnipare" id="dnipare">
                            <div class="invalid-feedback">
                                Porfavor, ponga un DNI.
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" id="afegir" required class="btn btn-success" value="Afegir Pare">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--MODAL FORMULARI FILL-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Insertar Alumno</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="insert/student" method="post" id="form" name="f1" class="needs-validation" novalidate>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="nomalumne"><strong>NOMBRE ALUMNO</strong>
                                <input class="form-control" required type="text" name="nomalumne" id="nomalumne">
                                <div class="invalid-feedback">
                                    Porfavor, ponga un nombre.
                                </div>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="llinatgealumne"><strong>APELLIDO ALUMNO</strong>
                                <input class="form-control" required type="text" name="llinatgealumne" id="llinatgealumne">
                                <div class="invalid-feedback">
                                    Porfavor, ponga un apellido.
                                </div>
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="classe"><strong>Classe</strong>
                                <select class="form-control" name="classe" id="classe">
                                    <option value="1">Primero A</option>
                                    <option value="2">Primero B</option>
                                    <option value="3">Segundo A</option>
                                    <option value="4">Segundo B</option>
                                    <option value="5">Tercero A</option>
                                    <option value="6">Tercero B</option>
                                    <option value="7">Cuarto A</option>
                                    <option value="8">Cuarto B</option>
                                    <option value="9">Quinto A</option>
                                    <option value="10">Quinto B</option>
                                    <option value="11">Sexto A</option>
                                    <option value="12">Sexto B</option>
                                </select></label>
                            <div class="invalid-feedback">
                                Porfavor, ponga una clase.
                            </div>
                        </div>

                        <strong>ALERGIA</strong>
                        <br>
                        <div class="form-check-inline">
                            <label class="form-check-label" for='ous'>Huevos</label>
                            <input class="form-check-input" type='checkbox' id='ous' name='alergia[]' value='1'>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label" for='marisc'>Marisco</label>
                            <input class="form-check-input" type='checkbox' id='marisc' name='alergia[]' value='2'>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label" for='peix'>Pescado</label>
                            <input class="form-check-input" type='checkbox' id='peix' name='alergia[]' value='3'>
                        </div>
                        <br>
                        <div class="form-check-inline">
                            <label class="form-check-label" for='frutssecs'>Frutos Secos</label>
                            <input class="form-check-input" type='checkbox' id='frutssecs' name='alergia[]' value='4'>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label" for='llet'>Leche</label>
                            <input class="form-check-input" type='checkbox' id='llet' name='alergia[]' value='5'>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label" for='cereals'>Cereales</label>
                            <input class="form-check-input" type='checkbox' id='cereals' name='alergia[]' value='6'>
                        </div>
                        <input id="pareID" name="pareID" type="hidden" value="0">

                        <div class="form-group" style="margin-top:6%;">
                            <label for="date"><strong>FECHA DE NACIMIENTO:</strong></label>
                            <input class="form-control" type="date" name="date" id="date" required>
                            <div class="invalid-feedback">
                                Porfavor, ponga una fecha de nacimiento.
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <input type="submit" id="afegir" class="btn btn-success" value="Afegir Alumne">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="eliminarPare" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Padre</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Esta Seguro que quiere eliminar el padre?</p>
                    <form action="eliminar" method="post" id="form">
                        <input id="pareDNI" name="pareDNI" type="hidden" value="0">
                    

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <input type="submit" id="eliminar" class="btn btn-success" value="Eliminar Padre">
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

    <script>
        $(document).ready(function() {


            var t = $('#table').DataTable({
                "bPaginate": false,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
                "bAutoWidth": false,
                data: <?php echo json_encode($userArr); ?>,
                columns: [{
                    data: 'name',
                    responsivePriority: 1
                }, {
                    data: 'last_name'
                }, {
                    data: 'DNI'
                }, {
                    data: 'student_name',
                    responsivePriority: 3
                }, {
                    "defaultContent": "<button title='A??adir Hijo' type='submit' class='editar btn btn-info' data-toggle='modal' data-target='#exampleModal'><i class='fas fa-user-plus'></i></button><button style='margin-left:2%;' title='Eliminar Padre' type='submit' class='eliminar  btn btn-danger' data-toggle='modal' data-target='#eliminarPare'><i class='far fa-trash-alt'></i></button>",
                    responsivePriority: 2
                }],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/English.json"
                },
                select: true,
                responsive: true,

            });

            var obtener_data_editar = function(tbody, table) {
                $(tbody).on("click", "button.editar", function() {
                    var data = table.row($(this).parents("tr")).data();
                    var DNI = $("#pareID").val(data.DNI);
                });
            }

            var obtener_data_alumne = function(tbody, table) {
                $(tbody).on("click", "button.editar", function() {
                    var data = table.row($(this).parents("tr")).data();
                    var last_name = $("#llinatgealumne").val(data.last_name);
                });
            }

            var obtener_id_eliminar = function(tbody, table) {
                $(tbody).on("click", "button.eliminar", function() {
                    var data = table.row($(this).parents("tr")).data();
                    var DNI = $("#pareDNI").val(data.DNI);
                });
            }

            obtener_data_editar("#table tbody", t);
            obtener_data_alumne("#table tbody", t);
            obtener_id_eliminar("#table tbody", t);

            function loadData() {
                t = $('#table').DataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bInfo": false,
                    "bAutoWidth": false,
                    data: <?php echo json_encode($userArr); ?>,
                    columns: [{
                        data: 'name',
                        responsivePriority: 1
                    }, {
                        data: 'last_name'
                    }, {
                        data: 'DNI'
                    }, {
                        data: 'student_name',
                        responsivePriority: 3
                    }, {
                        "defaultContent": "<button title='A??adir Hijo' type='submit' class='editar btn btn-info' data-toggle='modal' data-target='#exampleModal'><i class='fas fa-user-plus'></i></button><button style='margin-left:2%;' title='Eliminar Padre' type='submit' class='eliminar  btn btn-danger' data-toggle='modal' data-target='#eliminarPare'><i class='far fa-trash-alt'></i></button>",
                        responsivePriority: 2
                    }],
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/English.json"
                    },
                    select: true,
                    responsive: true
                });

            }


            $("<button class='btn btn-success' name='afegirpare' data-toggle='modal' data-target='#ModalPare'><i class='fas fa-plus-circle'></i></button>").appendTo("div.panel-heading");

        });
    </script>

         <?php require_once "footer.php" ?>
 
    <!-- Footer -->



</body>

</html>