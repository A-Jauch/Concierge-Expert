<?php
include 'config.php';
$name = $_POST['name'];
$categorie = $_POST['categorie'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Ajouter un service</title>
</head>

<body class="bodi">

<?php
$req2 = $bdd->prepare("SELECT * FROM " . $name);
$req2->execute();
?>

<div class="container">
    <div class=""><br>
        <?php if ($req2->rowCount() > 0) { ?>
            <?php while ($row = $req2->fetch(PDO::FETCH_BOTH)) { ?>
                <center><img src="<?= "back_office/" . $row['image'] ?>" width="200px"></center>
            <?php } ?>
        <?php } ?>
    </div>
    <br>
    <div class="row centered-form">
        <div class="col-lg-12 col-xl-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <center><h1 class="font"><?= $name ?></h3></center>
                </div>
                <div class="panel-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12 col-xl-126">
                                <div class="form-group">
                                    <?php
                                    $req = $bdd->prepare("DESCRIBE " . $name);
                                    $req->execute();
                                    $i = 0;
                                    if ($req->rowCount() > 0) {
                                        $variable = array();
                                        while ($nameColumn = $req->fetch(PDO::FETCH_BOTH)) {
                                            $new = $bdd->prepare("SELECT * FROM " . $name);
                                            $new->execute();
                                            $type = $new->getColumnMeta(0);
                                            $variable[$i] = $nameColumn['Field'];

                                            $test = $bdd->prepare("SELECT $variable[$i] FROM " . $name);
                                            $test->execute();
                                            $res = $test->getColumnMeta(0);
                                            if ($res['native_type'] == "VAR_STRING") {
                                                $res['native_type'] = "TEXT";
                                            }
                                            if ($res['native_type'] == "BLOB") {
                                                $res['native_type'] = "TEXT";
                                            }
                                            if ($res['native_type'] == "TIMESTAMP") {
                                                $res['native_type'] = "TIME";
                                            }
                                            $i++;
                                            if ($i > 4) {
                                                ?>
                                                <label class="font"><?= $nameColumn['Field'] ?> : </label>
                                                <input type="<?= $res['native_type'] ?>"
                                                       name="<?= $nameColumn['Field'] ?>"
                                                       placeholder="<?= $nameColumn['Field'] ?>"
                                                       class="form-control input-sm"><br>

                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <center><input type="submit" value="Valider" class="btn btn-primary"></center>
                        </br>
                    </form>
                    <form action="reservation.php" method="POST">
                        <input type="hidden" name="name" value="<?= $categorie ?>">
                        <center><input type="submit" name="" value="Retour" class="btn btn-danger"></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
