<?php
	$host="192.168.1.69:8099";
	$user="root";
	$password="olist";
	$databaseName="olist";

	$connection=mysqli_connect($host, $user, $password, $databaseName);

	if(!$connection){
		echo "Ocorreu uma falha, não foi possível conectar ao banco. Contate o administrador";
	}
?>