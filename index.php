<?php include("db.php") ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venta de coches</title>
    <!--boostrap 4-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--FONT AWESOME 5-->
    <script src="https://kit.fontawesome.com/65fc940331.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>

<body>
    <nav class="navbar-dark bg-dark">
        <div class="container">
            <a href="index.php" class="navbar-brand">Venta de coches</a>
        </div>
    </nav>

    <div class="container p-4">
        <div class="col-md-4">
            <?php if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php session_unset();
            } ?>
            <div class="card card-body">
                <form action="save_car.php" method="POST">
                    <div class="form-group">
                        <label>MARCAS</label>
                        <p>
                            <select id="slt-marcas" name="slt-marcas" class="form-control" onchange="getModelos()">
                            </select>
                    </div>
                    <div class="form-group">
                        <label>MODELOS</label>
                        <p>
                            <select id="slt-modelos" name="slt-modelos" class="form-control" onchange="">
                            </select>
                    </div>

                    <input type="submit" class="btn btn-success btn-block" name="save-car" value="Añadir coche" onclick="insertDatos()">
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <!--  <th>Año</th>
                <th>Matricula</th>
                <th>Precio</th>-->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>


                    <?php

                    $result_car = $db->query("SELECT * FROM cars");

                    while ($row = $result_car->fetchArray()) { ?>
                        <tr>
                            <td><?php echo $row['brand'] ?></td>
                            <td><?php echo $row['model'] ?></td>

                            <td>
                                <a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary">
                                    <i class="fab fa-bitcoin"></i>
                                </a>
                                <a href="delete_car.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function getMarcas() {
            var marcas = $("#slt-marcas");
            $.ajax({
                data: {
                    id: marcas.val()
                },
                url: 'marcas.php',
                type: 'POST',
                dataType: 'json',
                beforeSend: function() {
                    // marcas.prop('disabled', true);
                },
                success: function(r) {
                    marcas.prop('disabled', false);

                    // Limpiamos el select
                    marcas.find('option').remove();

                    $(r).each(function(i, v) { // indice, valor
                        if (v.id <= 300) {
                            marcas.append('<option value="' + v.id + '">' + v.name + '</option>');
                        }
                    })

                    marcas.prop('disabled', false);
                },
                error: function() {
                    alert('Ocurrio un error en el servidor ..');
                    marcas.prop('disabled', false);
                }
            });
        }


        function getModelos() {
            var marcas = $("#slt-marcas");
            var modelos = $("#slt-modelos");
            $.ajax({
                data: {
                    id: marcas.val()
                },
                url: 'modelos.php',
                type: 'POST',
                dataType: 'json',
                beforeSend: function() {
                    // marcas.prop('disabled', true);
                },
                success: function(r) {
                    modelos.prop('disabled', false);

                    // Limpiamos el select
                    modelos.find('option').remove();

                    $(r).each(function(i, v) { // indice, valor
                        if (v.vehicleType == 'C' && v.name != 'Others') {
                            modelos.append('<option value="' + v.id + '">' + $("#slt-marcas option:selected").text() + " " + v.name + '</option>');
                        }
                    })

                    modelos.prop('disabled', false);
                },
                error: function() {
                    alert('Ocurrio un error en el servidor ..');
                    marcas.prop('disabled', false);
                }
            });
        }

        function insertDatos() {

            var marcas = $("#slt-marcas option:selected");
            var modelos = $("#slt-modelos option:selected");

            $.ajax({
                data: {
                    id: marcas.val(),
                    make: marcas.text(),
                    modelId: modelos.val(),
                    model: modelos.text()
                },
                url: 'save_car.php',
                type: 'POST',
                dataType: 'json',
                beforeSend: function() {
                    // alert(marcas.val());
                },
                success: function(r) {
                    // mensajito todo ok
                },
                error: function(s) {
                    //  alert(s.responseText);
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            // Bloqueamos el SELECT de los cursos
            $("#slt-modelos").prop('disabled', true);
            getMarcas();

            // Hacemos la lógica que cuando nuestro SELECT cambia de valor haga algo

        })
    </script>



</body>

</html>