<?php
session_start();

$sql="select * from postulante where ci=".$_SESSION["id"];
$resultado=mysqli_query($con, $sql);
$fila=mysqli_fetch_array($resultado);
if($fila["CertificadoNac"]==1 && $fila["FotoCI"]==1 && $fila["CertificadoAnt"]==1 && $fila["FotoTitulo"]==1 && $fila["ProgGestion"]==1)
{
	$_SESSION["condicion"]="SI";
}else
{
	$_SESSION["condicion"]="NO";
}
?>