<?php
ini_set('display_errors','off');
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Add Service</title>
</head>

<body class="bodi">

<div class="container">
    <div class="">
        <center><img src="../../img/logo.png" width="200px" ></center>
    </div><br>
    <div class="row centered-form">
        <div class="col-lg-12 col-xl-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <center><h3 class="font">Add a service</h3></center>
                </div>
                <div class="panel-body">
                    <form action="verif_service.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12 col-xl-126">
                                <?php
                                if($_GET['error'] === 'yes'){
                                    echo '<h6>*a service with this name has been already created </h6>';
                                }
                                ?>
                                <?php
                                if($_GET['error'] === '1'){
                                    echo '<h6>*One or more input are empty or invalid</h6>';
                                }
                                ?>
                                <div class="form-group">
                                    <!-- Affiche -->
                                    <label class="font">Select a file(png, jpg, jpeg) : </label>
                                    <input type="file" name="image" class="form-control input-md" multiple><br>
                                    <!-- Service's name -->
                                    <label class="font">Enter the service's name : </label>
                                    <input type="text" name="name" placeholder="Service's name" class="form-control input-sm"><br>

                                </div>
                            </div>
                        </div>
                        <br><center><input type="submit" name="" value="Validate" class="btn btn-primary"></center><br>
                    </form>
                    <form action="../../index.php" method="POST">
                        <center><input type="submit" name="" value="Return" class="btn btn-danger"></center>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>
