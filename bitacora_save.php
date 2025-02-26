<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY,Origin,X-Requested_With,Content-Type,Accept,Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET,POST,OPTIONS,PUT,DELETE");
header("Allow: GET,POST,OPTIONS,PUT,DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if($method=="OPTIONS")
{
    die();
}
require_once("conexion.php");
$encodeData=file_get_contents('php://input');
$decodedData=json_decode($encodeData,true);

$usuario=$decodedData['usuario'];
$navegador=$decodedData['navegador'];
$ip=$decodedData['ip'];
$descrip=$decodedData['descrip'];
$modcod=$decodedData['modcod'];
$hoy=date('Y-m-d H:i:s');

$respuesta="";

try{
    $sql="insert into tbl_bitacora_web values(0,'".$usuario."','".$navegador."','".$ip."','".$descrip.
    "','".$hoy."',".$modcod.")";
    $respuesta=$sql;
    $query=mysqli_query($conexion,$sql);
    $respuesta="exito";
    //$count=mysqli_num_rows($query);
    //$respuesta=($count>0?"exito":"no existe");
}catch(Exception $exp)
{
    //echo json_encode('Error');
    $respuesta="Error";
}
echo json_encode($respuesta);
?>