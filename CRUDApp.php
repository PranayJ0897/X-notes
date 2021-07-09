<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X Notes | Revolutionary notes taking app </title>



    <!--Google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="design.css">

    <!-- Latest compiled and minified CSS & JS -->

    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <!--For data tables-->
    <!-- 1. CSS     -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <!-- 4.jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous">
        </script>
    <!-- 2. JS -->
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <!-- 3.Function -->
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>

</head>

<body>
    <div class="section-1">
        <div class="logo">
            X - notes
        </div>
        <?php require_once 'process.php';?>

        <div class="container">



        </div>
        <?php
    if (isset($_SESSION['message'])):?>
        <div class="alert alert-<?=$_SESSION['msg_type']?>">

            <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    ?>


        </div>
        <?php endif;?>

        <div class="row">

            <div class="col-md-offset-2 col-md-8">
                <div class="form-head">
                    <h3 class="note-head">Hello welcome ! Add your Note here</h3>
                </div>
                <hr>
                <form action="process.php" method="POST" style="margin-top: 25px;">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <!--creating an input hidden to fetch the values of name and location after   the                                                             edit button is clicked -->

                    <div class="form-group">

                        <label for=" name">Title</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?php echo $name;?>"
                            placeholder="Enter your name">
                        <!--The value will show the name and location of the record after the edit button is clicked -->
                    </div>
                    <div class="form-group">

                        <label for="location">Description</label>
                        <textarea type="text" name="location" class="form-control" id="location"
                            value="<?php echo $location; ?>" placeholder="Enter your location"></textarea>

                    </div>
                    <div class="form-group">
                        <!--Checking which button is clicked according to that the update msg or save msg will appear-->
                        <?php
                    if($update == true):
                    ?>
                        <script>
                            document.getElementsByClassName("note-head") = "Please update your note here. ";
                        </script>
                        <button class="btn btn-md btn-info" type="submit" name="update">Update</button>

                        <?php else:?>
                        <button class="btn btn-md btn-primary" type="submit" name="save">Save</button>
                        <?php endif ;?>
                    </div>

                </form>

            </div>


        </div>


        <?php

         /*connecting to database */

         require 'connection.php';

         /*displaying the data onto our web-page */

         $select_query = "SELECT id,name,location FROM data";

         $result = mysqli_query($con,$select_query);

        ?>


        <div class="row">
            <div class="col-md-offset-2 col-md-8">


                <div class="form-head">
                    <h3>Results</h3>
                </div>
                <hr>
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>

                    </thead>
                    <tbody>

                        <?php 
                        $sno = 1;
                        while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td>
                                <?php echo $sno; ?>
                            </td>
                            <td>
                                <?php echo $row['name']?>
                            </td>
                            <td width="600">
                                <?php echo $row['location']?>
                            </td>
                            <td>
                                <a href="CRUDApp.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                                <a href="process.php?id=<?php echo  $row['id']?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php $sno=$sno+1; ?>
                        <?php endwhile; ?>
                    </tbody>

                </table>



            </div>

        </div>







        <?php


    ?>






    </div>


    </div>
</body>

</html>