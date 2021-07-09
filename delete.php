<?php

require 'connection.php';
if (isset($_GET['id'])) {
   
    $id = $_GET['id'];

    $delete = "DELETE FROM data WHERE id = $id";

    $res = mysqli_query($con,$delete);

    if($res){
        echo "Record deleted!";
    }
    else {
        die("Unsuccessfull".mysqli_error($con));
    }

    
}




?>