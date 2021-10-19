<?php 

include("db.php");

$id= $_GET['id'];
$result = $db->query("SELECT * FROM cars WHERE id = $id");
if (!$result) {
    die("query error");  /*COMPROBACION DE LA CONSULTA*/

    
   
}
else{

    echo  $json = json_encode($result, true);



    $row = $result->fetchArray();
    $make = $row['make'];
    $model = $row['model'];

}



    $id = $_GET['id'];
    $make = $_POST['make'];
    $modelId = $_POST['modelId'];
    $model = $_POST['model'];
    //$year = $_POST['year'];
    //$type = $_POST['type'];
  

    
    $db->query("UPDATE cars set make = '$make' , model = '$model' WHERE id = $id");
    
    


   // $_SESSION['message']= 'Coche añadido correctamente';
   // $_SESSION['message_type']='success';


   // header("Location:  index.php"); /*REDIRECCIONA */


?>