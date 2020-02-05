<?php
ini_set('display_errors','off');
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Add Service</title>
</head>

<body class="bodi">

<div class="container">
    <div class="">
        <center><img src="../img/logo.png" width="200px" ></center>
    </div><br>
    <div class="row centered-form">
        <div class="col-lg-12 col-xl-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <center><h3 class="font">Inscription</h3></center>
                </div>
                <div class="panel-body">
                    <form action="verif_inscription.php" method="POST" enctype="multipart/form-data">
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
                                    <label class="font">Nom : </label>
                                    <input type="text" name="lastName" placeholder="Nom" class="form-control input-md" multiple><br>
                                    <!-- Service's name -->
                                    <label class="font">Prénom : </label>
                                    <input type="text" name="firstName" placeholder="Prénom" class="form-control input-sm"><br>
                                    <!-- Affiche -->
                                    <label class="font">Mail : </label>
                                    <input type="text" name="mail" placeholder="Mail" class="form-control input-md" multiple><br>
                                    <!-- Affiche -->
                                    <label class="font">Confirmation mail : </label>
                                    <input type="text" name="confMail" placeholder="Confirmation mail" class="form-control input-md" multiple><br>
                                    <!-- Affiche -->
                                    <label class="font">Mot de passe : </label>
                                    <input type="password" name="password" placeholder="Mot de passe" class="form-control input-md" multiple><br>
                                    <!-- Affiche -->
                                    <label class="font">Confirmation mot de passe : </label>
                                    <input type="password" name="confPassword" placeholder="Confirmation mot de passe" class="form-control input-md" multiple><br>
                                    <!-- Affiche -->
                                    <label class="font">Adresse : </label>
                                    <input type="text" name="address" placeholder="Adresse" class="form-control input-md" multiple><br>
                                    <!-- Affiche -->
                                    <label class="font">Numéro de téléphone : </label>
                                    <input type="text" name="phoneNumber" placeholder="Téléphone" class="form-control input-md" multiple><br>

                                </div>
                            </div>
                        </div>
                        <br><center><input type="submit" name="" value="Validate" class="btn btn-primary"></center><br>
                    </form>
                    <form action="../index.php" method="POST">
                        <center><input type="submit" name="" value="Return" class="btn btn-danger"></center>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>
