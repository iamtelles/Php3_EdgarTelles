<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        /* Estilos CSS personalizados */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        .form-container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .submit-button {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <form method="POST" action="CUD.php">
            <?php echo $message; ?>
            <input type="hidden" name="id_estudiante" id="id_estudiante">

            <div class="form-group">
                <label for="carne">Carné:</label>
                <input class="form-control" type="text" name="carne" pattern="E\d{3}" required>
            </div>

            <div class="form-group">
                <label for="nombres">Nombres:</label>
                <input class="form-control" type="text" name="nombres" required>
            </div>

            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input class="form-control" type="text" name="apellidos" required>
            </div>

            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input class="form-control" type="date" name="fecha_nacimiento" required>
            </div>

            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input class="form-control" type="text" name="direccion">
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input class="form-control" type="text" name="telefono">
            </div>

            <div class="form-group">
                <label for="correo_electronico">Correo Electrónico:</label>
                <input class="form-control" type="email" name="correo_electronico">
            </div>

            <div class="form-group">
                <label for="id_tipo_sangre">Tipo de Sangre:</label>
                <select class="form-control" name="id_tipo_sangre">
                    <?php
                    include 'db_conection.php';
                    // Conectar a la base de datos
                    $conexion = mysqli_connect($hostname, $userName, $userpass, $dbName);

                    // Verificar la conexión
                    if (!$conexion) {
                        die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
                    }

                    // Consulta SQL para obtener los tipos de sangre
                    $sql = "SELECT * FROM db_empresa.tipos_sangre";
                    $result = mysqli_query($conexion, $sql);

                    // Iterar a través de los resultados y generar las opciones
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['id_tipo_sangre'] . '">' . $row['sangre'] . '</option>';
                    }

                    mysqli_close($conexion);
                    ?>
                </select>
            </div>

            <div class="submit-button">
                <button class="btn btn-primary" type="submit" name="create" value="true">Agregar</button>
            </div>
        </form>
    </div>
</body>

</html>
