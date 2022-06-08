<?php
session_start();
echo "CI: ".$_SESSION["id"]." valido"; 
echo "<br>";

$sql="select * from docenteTitular where ci=".$_SESSION["id"];
$resultado=mysqli_query($con, $sql);
$fila=mysqli_fetch_array($resultado);

$nombre=$fila["nombre"];


?>