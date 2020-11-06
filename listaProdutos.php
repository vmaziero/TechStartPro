<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>TechStart Pro | Olist</title>
<link href="../css/estilo.css" rel="stylesheet">
</head>

<body>
    
	<center>
        
        <button class="button"><a href="formInsereProduto.php">Inserir novo produto</a></button>
        <h3>Filtros</h3>
        <h4>Para filtrar produtos por múltiplas categorias, pressione a tecla Ctrl e clique nas opções desejadas.</h4>
        <form method="post" action="listaProdutos.php" class="form" style="width:30%;">
        <table>
			<tr>
				<th></th>
				<th>Nome</th>
				<th>Descrição</th>
				<th>Valor</th>
				<th>Categorias</th>
			</tr>
			<tr>
                <td><input type='hidden'  name='id' id='id'></td>
                <td><input type="text" name="name" class="field"></td>
                <td><input type="textarea" rows="4" cols="20" name="description" class="field"></td>
                <td><input type="number" step="any" name="value" class="field"></td>
                <td><select name="category[]" id="category" multiple>
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
                </select></td>

                <td><input type="submit" value="Pesquisar" class="button"></td>
            </tr>
        </table>
		</form>
		<h3>Listagem de produtos</h3>
        <?php
                    //Get all categories from database
                    if(empty($_POST)){
                        $data=mysqli_query($connection, "SELECT * FROM product");
                    }else{
                        $where="";
                        if($_POST["name"]){
                            $name=$_POST["name"];
                            $where=$where." AND name LIKE '%$name%'";
                        }
                        if($_POST["description"]){
                            $description=$_POST["description"];
                            $where=$where." AND description LIKE '%$description%'";
                        }
                        if($_POST["value"]){
                            $value=$_POST["value"];
                            $where=$where." AND value='$value'";
                        }
                        if(isset($_POST["category"])){
                            $where=$where." AND ";
                            $whereCategory="";
                            foreach ($_POST["category"] as $category){
                                $whereCategory=$whereCategory." OR PC.idCategory='$category'";
                            }
                            // Remove first "OR"
                            $whereCategory=substr($whereCategory, 4);
                            $where=$where.$whereCategory;
                        }
                        // Remove first "AND"
                        $where=substr($where, 5);
                        $query=" SELECT * FROM product P INNER JOIN productCategory PC ON PC.idProduct=P.id WHERE $where";
                        $data=mysqli_query($connection, $query);

                    }
					
                                        
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













