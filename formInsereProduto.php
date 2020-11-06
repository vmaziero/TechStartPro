<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>TechStart Pro | Olist</title>
<link href="../css/estilo.css" rel="stylesheet">
</head>

<body>
	<center>
		<h3>Cadastro de Produto</h3>
			<h4>Para selecionar múltiplas categorias, pressione a tecla Ctrl e clique nas opções desejadas.</h4>
			<form method="post" action="insereProduto.php" class="form" style="width:30%;">
			<input type="text" name="name" required placeholder="Nome" class="field">
			<input type="textarea" rows="4" cols="20" name="description" required placeholder="Descrição" class="field">
			<input type="number" step="any" name="value" required placeholder="Valor" class="field">
			<select name="category[]" id="category" multiple>
				<option value="" disabled selected>Categorias</option>
				<?php
					//Connection
					include_once("./conecta.php");
					//Get all categories from database
					$data=mysqli_query($connection, "SELECT * FROM category");
					//Separando os dados com Array
					
					while($row=$data->fetch_array()){
						echo "<option value='$row[id]'>$row[name]</option>";	
					}
					
				?>
			</select>

			<input type="submit" value="Incluir produto" class="button">
		</form>
	</center>
</body>
</html>













