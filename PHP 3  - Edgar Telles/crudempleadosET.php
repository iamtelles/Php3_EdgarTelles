<?php
include("datos_conexion.php");

function insertarEmpleado($conexion, $txt_codigo, $txt_nombres, $txt_apellidos, $txt_direccion, $txt_telefono, $drop_puesto, $txt_fn)
{
    $sql = "INSERT INTO empleados(codigo, nombres, apellidos, direccion, telefono, fecha_nacimiento, id_puesto) VALUES ('$txt_codigo', '$txt_nombres', '$txt_apellidos', '$txt_direccion', '$txt_telefono', '$txt_fn', $drop_puesto)";
    return $conexion->query($sql);
}

function modificarEmpleado($conexion, $txt_id, $txt_codigo, $txt_nombres, $txt_apellidos, $txt_direccion, $txt_telefono, $drop_puesto, $txt_fn)
{
    $sql = "UPDATE empleados SET codigo='$txt_codigo', nombres='$txt_nombres', apellidos='$txt_apellidos', direccion='$txt_direccion', telefono='$txt_telefono', fecha_nacimiento='$txt_fn', id_puesto=$drop_puesto WHERE id_empleado = $txt_id";
    return $conexion->query($sql);
}

function eliminarEmpleado($conexion, $txt_id)
{
    $sql = "DELETE FROM empleados WHERE id_empleado = $txt_id";
    return $conexion->query($sql);
}

if (!empty($_POST)) {
    $txt_id = utf8_decode($_POST["txt_id"]);
    $txt_codigo = utf8_decode($_POST["txt_codigo"]);
    $txt_nombres = utf8_decode($_POST["txt_nombres"]);
    $txt_apellidos = utf8_decode($_POST["txt_apellidos"]);
    $txt_direccion = utf8_decode($_POST["txt_direccion"]);
    $txt_telefono = utf8_decode($_POST["txt_telefono"]);
    $drop_puesto = utf8_decode($_POST["drop_puesto"]);
    $txt_fn = utf8_decode($_POST["txt_fn"]);

    $db_conexion = mysqli_connect($db_host, $db_usr, $db_pass, $db_nombre);

    if (!$db_conexion) {
        die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
    }

    if (isset($_POST['btn_agregar'])) {
        if (insertarEmpleado($db_conexion, $txt_codigo, $txt_nombres, $txt_apellidos, $txt_direccion, $txt_telefono, $drop_puesto, $txt_fn)) {
            $db_conexion->close();
            header('Location: /empresa');
        } else {
            $db_conexion->close();
        }
    } elseif (isset($_POST['btn_modificar'])) {
        if (modificarEmpleado($db_conexion, $txt_id, $txt_codigo, $txt_nombres, $txt_apellidos, $txt_direccion, $txt_telefono, $drop_puesto, $txt_fn)) {
            $db_conexion->close();
            header('Location: /empresa');
        } else {
            $db_conexion->close();
        }
    } elseif (isset($_POST['btn_eliminar'])) {
        if (eliminarEmpleado($db_conexion, $txt_id)) {
            $db_conexion->close();
            header('Location: /empresa');
        } else {
            $db_conexion->close();
        }
    }
}
?>

