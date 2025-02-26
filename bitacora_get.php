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

//$encodeData=file_get_contents('php://input');
//$decodedData=json_decode($encodeData,true);

//$fecha=$decodedData['fecha'];

$fecha=$_GET["fecha"];

try{
    $sql = "SELECT
    bit_codigo as id,
user_id,
date_format(bit_fecha,'%d-%m-%Y %r')AS fecha,
concat(bit_descripcion,' con ',bit_navegador,' Desde ',bit_ip_equipo)AS evento
FROM
tbl_bitacora_web
WHERE bit_fecha LIKE '%".$fecha."%' order by bit_fecha DESC";
//echo $sql;
    $query=mysqli_query($conexion,$sql);
    
    $events = array();
    while ($row = mysqli_fetch_assoc($query)) 
    {
        $events[] = $row;
    }
    echo json_encode($events);
}catch(Exception $exp)
{
    //echo json_encode('Error');
    $respuesta="Error";
}
?>