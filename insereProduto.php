<?php
	//Connection
	include_once("conecta.php");

	//Receiving data
	$recName=$_POST["name"];
	$recDescription=$_POST["description"];
	$recValue=$_POST["value"];
		
	//Adapting decimal comma separator to database dot
	$recValue=str_replace(",",".",$recValue);
	
	//Inserting product on database
	$query="INSERT INTO product (name, description, value) VALUES ('$recName', '$recDescription', '$recValue')";
	mysqli_query($connection, $query);
	$id=mysqli_insert_id($connection);
	
	//Inserting categories for the product
	foreach ($_POST["category"] as $category){
		$query="INSERT INTO productCategory (idProduct, idCategory) VALUES ('$id', '$category')";
		mysqli_query($connection, $query);
	}

	header("location: formExcluiProduto.php");
?>




