<?php
  include 'config.php';
  $name = $_POST['name'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Réservation</title>
</head>

<body>

  <?php
  $req2 = $bdd->prepare("SELECT * FROM " . $name);
  $req2->execute();
  ?>

  <div class="container">
      <div class="row">
          <?php if ($req2->rowCount() > 0) { ?>
              <?php while ($row = $req2->fetch(PDO::FETCH_ASSOC)) { ?>
                  <!-- Ajout d'une nouvelle catégorie -->

                  <div class="col-lg-4 col-sm-6 col-xs-12">
                      <div class="card text-center box" style="width: 15rem;">
                        <center><img class="size" width="100px" height="100px"
                                     src="<?= 'back_office/' . $row['image']; ?>"></center>
                          <div class="card-body">
                              <h5 class="card-title"><?= '<h3><b>' . $row['name'] . '</b></h3>'; ?></h5>
                              <form action="subcategory.php" method="post">
                                <input type="hidden" name="categorie" value="<?= $name ?>">
                                <input type="hidden" name="name" value=<?= $row['name'] ?>>
                                <input type="submit" value="Réserver" class="btn btn-success">
                              </form>
                          </div>
                      </div>
                  </div>

              <?php } ?>
          <?php } ?>
      </div>
    </div>


  <center><form action="back_office/reservation_back.php" method="post">
    <input type="hidden" name="name" value=<?= $name ?> >
    <input type="submit" value="Accès back-office" class="btn btn-primary">
  </form></center><br>
  <form action="../index.php" method="POST">
      <center><input type="submit" name="" value="Retour" class="btn btn-danger"></center>
  </form>

</body>

</html>
