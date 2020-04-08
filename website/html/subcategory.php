<?php
session_start();
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
$req2 = $bdd->prepare("SELECT * FROM " . $name. " WHERE id =1");
$req2->execute();
?>

<div class="container">
    <div class=""><br>
        <?php if ($req2->rowCount() > 0) { ?>
            <?php while ($row = $req2->fetch(PDO::FETCH_BOTH)) { ?>
                <center><img src="<?= "back_office/" . $row['image'] ?>" width="200px"></center>
    </div>
    <br>
    <div class="row centered-form">
        <div class="col-lg-12 col-xl-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <center><h1 class="font"><?= str_replace('_',' ',$name) ?></h3></center><br>
                    <center><h6><?= $row['description']; ?></h6></center>

                    <center><h6><i>Prix unitaire pour 1 heure : <?= $row['price']; ?>€</i></h6><br></center>
                    <?php } ?>
                    <?php } ?>
                </div>
                <div class="panel-body">
                    <?php
                    $abo = $bdd->prepare("SELECT idUser FROM subscription WHERE idUser =?");
                    $abo->execute([$_SESSION['id']]);
                    $res_abo = $abo->fetch(PDO::FETCH_ASSOC);
                    var_dump($res_abo['idUser']);
                    ?>
                    <?php if (isset($res_abo['idUser']) && !empty($res_abo['idUser']) && $res_abo['idUser'] == $_SESSION['id']) {

                        ?>
                    <form action="back_office/account.php" method="POST" enctype="multipart/form-data">
                    <?php } else {?>
                    <form action="payment_index.php" method="POST" enctype="multipart/form-data">
                    <?php }?>
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
                                            $test2=$test->fetchAll(PDO::FETCH_ASSOC);
                                            $res = $test->getColumnMeta(0);
                                            if ($res['native_type'] == "VAR_STRING" && $res['native_type'] == "BLOB") {
                                                $res['native_type'] = "TEXT";
                                            }
                                            if ($res['native_type'] == "TIMESTAMP") {
                                                $res['native_type'] = "TIME";
                                            }
                                            $i++;
                                            if ($i > 5){
                                              if($nameColumn['Field'] == 'idUser' || $nameColumn['Field'] == 'order_id'){ ?>
                                                  <input type="hidden"
                                                         name="<?= $nameColumn['Field'] ?>"
                                                         placeholder="<?= $nameColumn['Field'] ?>"
                                                         class="form-control input-sm"><br>
                                                <?php }else{ ?>
                                                <label class="font"><?= $nameColumn['Field'] ?> : </label>
                                                <input type="<?= $res['native_type'] ?>"
                                                       name="<?= $nameColumn['Field'] ?>"
                                                       placeholder="<?= $nameColumn['Field'] ?>"
                                                       class="form-control input-sm"><br>
                                                 <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="last_id" value="<?php echo $last_id; ?>"/>
                        <input type="hidden" name="name" value="<?= $_POST['name'] ?>">
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
</body><br>

</html>
