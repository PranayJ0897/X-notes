
<?php



/*Session Start*/
session_start();
/*connection to database*/
require 'connection.php';
$name='';
$location='';
$update=false;
$id = 0;

/* Checking if the save button is pressed and inserting the data into table*/

if(isset($_POST['save'])){
    $name = $_POST['name'];                                                          //storing the name entered by user into name variable
    $location = $_POST['location'];                                                 //storing the location entered by user into location variable
    

    $sql_insert = "INSERT INTO data (name,location) VALUES ('$name','$location')"; //running the query to insert the data

    $result = mysqli_query($con,$sql_insert);                                      //running the query to insert the data
    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: CRUDApp.php");
    
    
    
}
/*checkiing if the delete button is clicked and then performing the delete operation  */
if (isset($_GET['id'])) {
    
    $id = $_GET['id'];
    
    $delete = "DELETE FROM data WHERE id = $id";
    
    $res = mysqli_query($con,$delete);
    
    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    
    header("location: CRUDApp.php");
}

/*checkiing if the edit button is clicked and then performing the edit operation  */
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;

    $select="SELECT * FROM data WHERE id = $id";
    $result = mysqli_query($con,$select);

    if($result){
        $row = mysqli_fetch_array($result);
        $name = $row['name'];
        $location = $row['location'];
    }
    else {
        die(mysqli_error($con));
    }
    

    
}
/*checkiing if the update button is clicked and then performing the update operation  */
if(isset($_POST['update'])){
    $id =  $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $update ="UPDATE data set name = '$name',location='$location' WHERE id=$id";

    $result = mysqli_query($con,$update);

    if($result){
        $_SESSION['message']="Record has been updated";
        $_SESSION['msg_type']="warning";

        header("location: CRUDApp.php");
    }

    
}







?>