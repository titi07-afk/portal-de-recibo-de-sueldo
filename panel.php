<?php
session_start();
include("conexion.php");
$correo=$_SESSION["correo"];
$sql="SELECT * FROM empleados WHERE correo='$correo'";
$resultado=mysqli_query($conexion,$sql);
$empleados=mysqli_fetch_assoc($resultado);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>panel</title>
</head>
<body>
<h2>datos del empleado</h2>
<p>Nombre:
<?php echo $empleados["nombre"]; ?>
</p>
<p>Apellido:
<?php echo $empleados["apellido"]; ?>
</p>
<p>Correo:
<?php echo $empleados["correo"]; ?>
</p>
<p>Sueldo:
<?php echo $empleados["sueldo"]; ?>
</p>
<a href="logout.php">
cerrar sesión
</a>
<?php 
$empleados = mysqli_fetch_assoc($resultado);
if ($empleados == null) {
    echo "empleado no encontrado.";
    exit();
}?>
</body>
</html>