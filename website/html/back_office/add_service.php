<?php
ini_set('display_errors', 'off');
include 'html/config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Ajouter un service</title>
</head>

<body class="bodi">

<div class="container">
    <div class="">
        <center><img src="../../img/logo.png" width="200px"></center>
    </div>
    <br>
    <div class="row centered-form">
        <div class="col-lg-12 col-xl-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <center><h3 class="font">Ajouter un service</h3></center>
                </div>
                <div class="panel-body">
                    <form action="verif_service.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12 col-xl-126">
                                <?php
                                if ($_GET['error'] === 'yes') {
                                    echo '<h6>*a service with this name has been already created </h6>';
                                }
                                ?>
                                <?php
                                if ($_GET['error'] === '1') {
                                    echo '<h6>*One or more input are empty or invalid</h6>';
                                }
                                ?>
                                <div class="form-group">
                                    <!-- Affiche -->
                                    <label class="font">Choix du fichier(png, jpg, jpeg) : </label>
                                    <input type="file" name="image" class="form-control input-md" multiple><br>
                                    <!-- Service's name -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="md-form">
                                                <label class="font">Entrez le nom du service : </label>
                                                <input type="text" name="name" placeholder="Nom du service"
                                                       class="form-control input-sm"><br>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="md-form">
                                                <label class="font">Prix (TTC/heure) : </label>
                                                <input type="number" name="price" placeholder="Prix"
                                                       class="form-control input-sm"></br>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="inline">
                                      <input type="checkbox" name="addIndex" value="yes">
                                      <p class="inline" class="font">Cochez la case pour afficher ce service à la page index :</p>
                                    </div>
                                </div>
                                <center><input type="submit" name="" value="Valider" class="btn btn-primary"></center>
                                <br>
                    </form>
                    <form action="../../index.php" method="POST">
                        <center><input type="submit" name="" value="Retour" class="btn btn-danger"></center>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>
