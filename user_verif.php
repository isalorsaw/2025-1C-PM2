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
$clave=$decodedData['clave'];

//echo $usuario;
$respuesta="";

try{
    //echo json_encode("Hola".$usuario." Clave ".$clave);
    //$respuesta="Hola".$usuario." Clave ".$clave;
    
    $sql="select * from tbl_user where user_nombre='".$usuario."' and user_clave='".$clave."' and user_estado=1";
    $query=mysqli_query($conexion,$sql);
    $count=mysqli_num_rows($query);
    //if($count>0)$respuesta=("exito");
    //else $respuesta=("No Existe");
    $respuesta=($count>0?"exito":"no existe");

    //echo $sql;
    //$respuesta=$sql;

}catch(Exception $exp)
{
    //echo json_encode('Error');
    //$respuesta="Error";
}
echo json_encode($respuesta);
?>