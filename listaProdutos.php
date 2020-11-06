<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>TechStart Pro | Olist</title>
<link href="../css/estilo.css" rel="stylesheet">
</head>

<body>
    
	<center>
		<h3>Listagem de produtos</h3>
        <?php
					//Connection
					include_once("./conecta.php");
					//Get all categories from database
					$data=mysqli_query($connection, "SELECT * FROM product");
                                        
                    echo "<table border=1>";
                    echo "<tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Valor</th>
                            <th>Categorias</th>
                            <th>Editar</th>
                            <th>Apagar</th>
                        </tr>";

					while($row=$data->fetch_array()){
                        echo "<tr>";
                        echo "<td>$row[name]</td>";
                        echo "<td>$row[description]</td>";
                        echo "<td>$row[value]</td>";
                        $categoryData=mysqli_query($connection, "SELECT * FROM productCategory PC INNER JOIN category C ON C.id=PC.idCategory WHERE PC.idProduct=$row[id]");
                        echo "<td>";                    
                        while($categoryRow=$categoryData->fetch_array()){
                            echo "$categoryRow[name], ";
                        }
                        echo "</td>";

                        echo "<td><form method='post' action='formEditaProduto.php' class='form' style='width:30%;'>
                                <input type='hidden' value='$row[id]' name='id' id='id'>
                                <input type='submit' value='Editar produto' class='button'>
                            </form></td>";
                        
                        echo "<td><form method='post' action='excluiProduto.php' class='form' style='width:30%;'>
                                <input type='hidden' value='$row[id]' name='id' id='id'>
                                <input type='submit' value='Excluir produto' class='button'>
                            </form></td>";
                        echo "</tr>";
                    }
                    echo "</table>";

                    
				?>
	</center>
</body>
</html>













