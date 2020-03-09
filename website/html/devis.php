<?php
ini_set('display_errors', 'off');
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Devis</title>
</head>

<body class="bodi">
<div class="container">
    <div class="">
        <center><img src="../img/logo.png" width="200px"></center>
    </div>
    <br>
    <div class="row centered-form">
        <div class="col-lg-12 col-xl-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <center><h3 class="font">Demande de devis</h3></center>
                </div>
                <div class="panel-body">
                    <form action="verif_devis.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form">

                                    <?php
                                    $req2 = $bdd->prepare("SELECT name FROM SERVICE");
                                    $req2->execute();
                                    ?>

                                    <label class="font">Sélectionner le type de prestation</label>
                                    <center><select name="index" class="form-control input-sm">
                                            <?php if ($req2->rowCount() > 0) { ?>
                                                <?php while ($row = $req2->fetch(PDO::FETCH_ASSOC)) { ?>
                                                    <option value="<?= $row['name']; ?>"><?= str_replace('_',' ',$row['name']) ?></option>
                                                <?php } ?>
                                            <?php } ?>

                                        </select></center>
                                    </br>
                                </div>
                            </div>
                        </div>
                        <!-- Information -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="md-form">
                                    <label class="font">Nom : </label>
                                    <input type="text" name="lastName" placeholder="Nom"
                                           class="form-control input-sm"></br>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form">
                                    <label class="font">Prénom : </label>
                                    <input type="text" name="firstName" placeholder="Prénom"
                                           class="form-control input-sm"></br>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="md-form">
                            <label class="font">Numéro de téléphone : </label>
                            <input type="number" name="phoneNumber" placeholder="Téléphone"
                                   class="form-control input-sm"></br>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="md-form">
                            <label class="font">Adresse e-mail : </label>
                            <input type="text" name="email" placeholder="E-mail"
                                   class="form-control input-sm"></br>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="md-form">
                            <label class="font">Code postal : </label>
                            <input type="number" name="postalCode" placeholder="Code postal"
                                   class="form-control input-sm"></br>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-form">
                            <label class="font">Ville : </label>
                            <input type="text" name="city" placeholder="Ville"
                                   class="form-control input-sm"></br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <center><input type="submit" name="" value="Valider" class="btn btn-primary"></center>
    </br>
    </form>
    <form action="../index.php" method="POST">
        <center><input type="submit" name="" value="Retour" class="btn btn-danger"></center>
    </form>
    </br>
</div>
</div>
</div>
</body>

</html>
