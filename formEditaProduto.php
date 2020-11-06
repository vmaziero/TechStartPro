<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>TechStart Pro | Olist</title>
<link href="../css/estilo.css" rel="stylesheet">
</head>

<body>
	<center>
		<h3>Editar produto</h3>
			<h4>Selecione novamente a(s) categoria(s) desejada(s) pressionando a tecla Ctrl e clicando sobre as opções.</h4>
			<?php 
				//Connection
				include_once("./conecta.php");

				//Get all categories from database
				$id=$_POST["id"];
				$data=mysqli_query($connection, "SELECT * FROM product WHERE id=$id");
				$productInfo=mysqli_fetch_array($data);

			?>
			<form method="post" action="editaProduto.php" class="form" style="width:30%;">
			<table>
			<tr>
				<th></th>
				<th>Nome</th>
				<th>Descrição</th>
				<th>Valor</th>
				<th>Categorias</th>
			</tr>
			<tr>
				<td><input type='hidden' value="<?php echo $id ?>" name='id' id='id'></td>
				<td><input type="text" name="name" required class="field" value="<?php echo $productInfo['name']; ?>"></td>
				<td><input type="textarea" rows="4" cols="20" name="description" required class="field" value="<?php echo $productInfo['description']; ?>"></td>
				<td><input type="number" step="any" name="value" required class="field" value="<?php echo $productInfo['value']; ?>"></td>
				<td><select name="category[]" id="category" multiple>
					<option value="" disabled selected>Categorias</option>
					<?php
						//Get all categories from database
						$data=mysqli_query($connection, "SELECT * FROM category");
						//Separando os dados com Array
						
						while($row=$data->fetch_array()){
							echo "<option value='$row[id]'>$row[name]</option>";	
						}
						
					?>
				</select></td>

				<td><input type="submit" value="Salvar alterações" class="button"></td>
			</tr>
			</table>
		</form>
	</center>
</body>
</html>












