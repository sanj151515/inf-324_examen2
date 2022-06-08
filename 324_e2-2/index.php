<?php
include "conexion.inc.php";
$flujo;
if(isset($_GET["flujo"]))
	$flujo=$_GET["flujo"];
else
	$flujo='F1';
$proceso;
if(isset($_GET["proceso"]))
	$proceso=$_GET["proceso"];
else
	$proceso='P1';
$sql="select * from flujoproceso ";
$sql.="where Flujo='$flujo' and proceso='$proceso'";
$resultado=mysqli_query($con, $sql);
$fila=mysqli_fetch_array($resultado);
$pantalla=$fila['Pantalla'];
$pantalla.=".inc.php";
$pantallalogica=$fila['Pantalla'];
$pantallalogica.=".main.inc.php";
$procesoanterior=$proceso;
$proceso=$fila['ProcesoSiguiente'];
include $pantallalogica;
?>
<html>
<body>	
	<form action="motor.php" method="GET">
		<!--iframe src="pantalla.php"></iframe-->
		<input type="hidden" name="flujo" value="<?php echo $flujo;?>"/>
		<input type="hidden" name="proceso" value="<?php echo $proceso;?>"/>
		<input type="hidden" name="procesoanterior" value="<?php echo $procesoanterior;?>"/>

		<?php
		//echo $pantalla;
		include $pantalla;
		echo "<br>";
		$sql="select * from flujoproceso ";
		$sql.="where Flujo='$flujo' and Proceso='$procesoanterior'";
		$resultado=mysqli_query($con, $sql);
		$fila=mysqli_fetch_array($resultado);
		$tipoProceso=$fila["Tipo"];
		if($tipoProceso!="I")
			echo '<input type="submit" name="boton" value="Anterior"/>';
		if($tipoProceso!="F")
			echo '<input type="submit" name="boton" value="Siguiente"/>';
		?>
		
		
	</form>
</body>
</html>