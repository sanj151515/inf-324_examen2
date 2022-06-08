<?php
session_start();
$sql=$_SESSION["sql_aux"];
$resultado=mysqli_query($con, $sql);
/*if ($resultado === false) {
    $_SESSION["condicion"]="NO";
    echo "al parecer algo ha fallado, porfavor vuelva a enviar sus documentos";
}else
{
	$_SESSION["condicion"]="SI";
}*/
?>