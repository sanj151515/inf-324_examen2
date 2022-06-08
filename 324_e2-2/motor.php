<?php
include "conexion.inc.php";
session_start();
$flujo=$_GET["flujo"];
$proceso=$_GET["procesoanterior"];
$procesosiguiente=$_GET["proceso"];
$fila;
$valorBoton=$_GET["boton"];
if ($valorBoton=='Anterior')
{
	
	$sql="select * from flujoproceso ";
	$sql.="where Flujo='$flujo' and ProcesoSiguiente='$proceso'";
	$resultado1=mysqli_query($con, $sql);
	$fila=mysqli_fetch_array($resultado1);			
	if($fila!=null)
	{
		$procesosiguiente=$fila["Proceso"];
	}else
	{
		$sql="select * from FlujoProcesoCondicionante where Flujo='$flujo' and (ProcesoSI='$proceso' or ProcesoNO='$proceso')";
		$resultado1=mysqli_query($con, $sql);
		$fila=mysqli_fetch_array($resultado1);		
		$procesosiguiente=$fila["Proceso"];
	}

}
if ($valorBoton=='Siguiente')
{
	$sql="select * from flujoproceso ";
	$sql.="where Flujo='$flujo' and Proceso='$proceso'";
	$resultado=mysqli_query($con, $sql);
	$fila=mysqli_fetch_array($resultado);
	$tipoProceso=$fila["Tipo"];

	$pantalla=$fila['Pantalla'];
	$pantalla.=".motor.inc.php";
	include $pantalla;

	if($tipoProceso=="C")
	{
		$sql="select * from FlujoProcesoCondicionante ";
		$sql.="where Flujo='$flujo' and Proceso='$proceso'";
		$resultado=mysqli_query($con, $sql);
		$fila=mysqli_fetch_array($resultado);

		
		if($_SESSION["condicion"]=="SI")
			$procesosiguiente=$fila["ProcesoSI"];
		else
			$procesosiguiente=$fila["ProcesoNO"];
	}else{
		$procesosiguiente=$fila["ProcesoSiguiente"];
	}
	
	
}


//echo $sql;

header("Location: index.php?flujo=$flujo&proceso=$procesosiguiente");
?>