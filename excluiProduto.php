<?php
	//Connection
	include_once("conecta.php");

	//Receiving data
	$recId=$_POST["id"];
	
	//Delete categories for the product
	$query="DELETE FROM productCategory WHERE idProduct=$recId";
	mysqli_query($connection, $query);

	//Delete product on database
	$query="DELETE FROM product WHERE id=$recId";
	mysqli_query($connection, $query);

	header("location: listaProduto.php");
?>




