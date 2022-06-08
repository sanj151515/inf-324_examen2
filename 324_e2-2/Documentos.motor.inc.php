<?php
session_start();
/*$cnacimiento=$_GET["cnacimiento"];
$cidentidad=$_GET["cidentidad"];
$sql="update academico.alumno set ";
$sql.="cnacimiento='$cnacimiento', cidentidad='$cidentidad' ";
$sql.="where id=".$_SESSION["id"];
$resultado=mysqli_query($con, $sql);*/
$sql="select * from postulante where ci=".$_SESSION["id"];
$resultado=mysqli_query($con, $sql);
//echo $sql;
$var1;$var2;$var3;$var4;$var5;
if($_GET["CertificadoNac"])
	$var1=1;
else
	$var1=0;
if($_GET["FotoCI"])
	$var2=1;
else
	$var2=0;
if($_GET["CertificadoAnt"])
	$var3=1;
else
	$var3=0;
if($_GET["FotoTitulo"])
	$var4=1;
else
	$var4=0;
if($_GET["ProgGestion"])
	$var5=1;
else
	$var5=0;
if($resultado->num_rows > 0)
{
	$sql="update postulante set ";
	$sql.="CertificadoNac=$var1, FotoCI=$var2, CertificadoAnt=$var3, FotoTitulo=$var4, ProgGestion=$var5 ";
	$sql.="where ci=".$_SESSION["id"];
}
else
{
	$sql="insert into postulante values(";
	$sql.=$_SESSION["id"].",'$var1', '$var2', '$var3', '$var4', '$var5')";
}
//$resultado=mysqli_query($con, $sql);
$_SESSION["sql_aux"]=$sql;
//$fila=mysqli_fetch_array($resultado);
/*

$var = $_GET['CertificadoNac'];
    if(isset($var)){
    $_SESSION["honesto"]="SI";

  }else{ $_SESSION["honesto"]="NO";}
*/
/*$ci=$_GET["id"];
$CertificadoNac=$_GET["CertificadoNac"];
$CertificadoAnt=$_GET["CertificadoAnt"];
$FotoTitulo=$_GET["FotoTitulo"];
$sql="insert into postulante values('$ci','$CertificadoNac','$CertificadoAnt','$FotoTitulo')";
$sql.="cnacimiento='$cnacimiento', cidentidad='$cidentidad' ";
$_SESSION["sql_documentos"]=$sql;
*/

?>
