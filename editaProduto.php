<?php
	//Connection
	include_once("conecta.php");

	//Receiving data
	$recName=$_POST["name"];
	$recDescription=$_POST["description"];
	$recValue=$_POST["value"];
	$recId=$_POST["id"];
	
	//Adapting decimal comma separator to database dot
	$recValue=str_replace(",",".",$recValue);
	
	//Updating product on database
	$query="UPDATE product SET name='$recName', description='$recDescription', value='$recValue' WHERE id=$recId";
	mysqli_query($connection, $query);
	
	//Delete all categories settled before for the product
	$query="DELETE FROM productCategory WHERE idProduct=$recId";
	mysqli_query($connection, $query);

	//Inserting new categories settled for the product
	foreach ($_POST["category"] as $category){
		$query="INSERT INTO productCategory (idProduct, idCategory) VALUES ('$recId', '$category')";
		mysqli_query($connection, $query);
	}

	header("location: listaProdutos.php");
?>



