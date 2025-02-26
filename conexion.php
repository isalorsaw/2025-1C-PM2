<?php

$servidor="localhost";	
$usuario="root";
$clave="root";
$bd="movil2";

try
{
    //$encodeData=file_get_contents('php://input');
    //$decodedData=json_decode($encodeData,true);

    date_default_timezone_set("America/Chicago");
	$conexion=mysqli_connect($servidor,$usuario,$clave,$bd);

	if (!$conexion) 
	{
    	echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    	echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    	echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    	exit;
	}
	else 
		{
			//echo $bd;
			mysqli_set_charset($conexion,"utf8");
			mysqli_select_db($conexion,$bd);
			mysqli_query($conexion,"SET time_zone = '-06:00'");
			mysqli_query($conexion,"SET NAMES 'utf8'");
		}
}catch(Exception $exp)
{
    echo json_encode('Error');
}

?>