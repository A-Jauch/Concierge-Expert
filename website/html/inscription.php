<?php
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <title>Inscription</title>
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
                    <?php
                    if(isset($_GET['error']) && $_GET['error'] == 'mail_taken') {
                        echo '<h4 style="color : red">L\'email est déjà utilisé</h4>';
                    }
                    ?>
                    <center><h3 class="font">Inscription</h3></center>
                </div>
                <div class="panel-body">
                    <form action="verif_inscription.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12 col-xl-126">
                                <div class="form-group">
                                    <label class="font">Nom : </label>
                                    <input type="text" name="lastName" placeholder="Nom" class="form-control input-md" multiple><br>
                                    <label class="font">Prénom : </label>
                                    <input type="text" name="firstName" placeholder="Prénom" class="form-control input-sm"><br>
                                    <label class="font">Mail : </label>
                                    <input type="text" name="mail" placeholder="Mail" class="form-control input-md" multiple><br>
                                    <label class="font">Confirmation mail : </label>
                                    <input type="text" name="confMail" placeholder="Confirmation mail" class="form-control input-md" multiple><br>
                                    <label class="font">Mot de passe : </label>
                                    <input type="password" name="password" placeholder="Mot de passe" class="form-control input-md" multiple><br>
                                    <label class="font">Confirmation mot de passe : </label>
                                    <input type="password" name="confPassword" placeholder="Confirmation mot de passe" class="form-control input-md" multiple><br>
                                    <label class="font">Adresse : </label>
                                    <input type="text" name="address" placeholder="Adresse" class="form-control input-md" multiple><br>
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
