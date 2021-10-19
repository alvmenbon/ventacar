<?php 

include("db.php");

    $id = $_POST['id'];
    $make = $_POST['make'];
    $modelId = $_POST['modelId'];
    $model = $_POST['model'];
    //$year = $_POST['year'];
    //$type = $_POST['type'];
  

    
    $result = $db->query("INSERT INTO cars(brandID, brand, modelID,model) VALUES('$id','$make','$modelId', '$model')");
    
    
    if (!$result) {
        die("query error");  /*COMPROBACION DE LA CONSULTA*/

        
       
    }
    else{

        echo  $json = json_encode($result, true);

    }

   // $_SESSION['message']= 'Coche añadido correctamente';
   // $_SESSION['message_type']='success';


   // header("Location:  index.php"); /*REDIRECCIONA */


?>