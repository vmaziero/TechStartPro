<?php

require_once 'conecta.php';
if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {

        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            
            $categoryName = "";
            if (isset($column[0])) {
                $categoryName = mysqli_real_escape_string($connection, $column[0]);
            }
            
            
            $query=" SELECT name FROM category";
            $data=mysqli_query($connection, $query);
            $alreadyExists=false;
            while($row=$data->fetch_array()){
                if($row['name']==$categoryName){
                    $alreadyExists=true;
                    break;
                }
            }
            if(!$alreadyExists){
                $query="INSERT INTO category (name) VALUES ('$categoryName') ";
                mysqli_query($connection, $query);
            }
                        
        }
    }
}
header("location: listaProdutos.php");
?>