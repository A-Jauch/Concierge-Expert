<?php session_start();
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Abonnement</title>
</head>

<body class="">

  <header>
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-12 col-md-11 col-xs-12">
                  <nav>
                      <div class="align">
                          <ul>
                              <li><a href="../index.php">Accueil</a></li>
                              <li><a href="service.php">Services</a></li>
                              <a href="../index.php" id="logo"><img src="../img/logo.png" width="150px" alt="logo"></a>
                              <li><a href="subscription.php">Abonnement</a></li>
                                      <?php
                                      $connected = isset($_SESSION['mail']) ? true : false;
                                      if ($connected) { ?>
                              <li><a href="deconnection.php">
                                      <button type="button" class="btn btn-primary">Déconnexion</button>
                                  </a>
                              </li>
                              <?php } else { ?>
                                  <li><a href="connection.php">
                                          <button type="button" class="btn btn-primary">Espace Client</button>
                                      </a>
                                  </li>
                              <?php } ?>
                          </ul>
                      </div>
                  </nav>
              </div>
          </div>
      </div>
  </header>

    <main>
        <div class="container">
            <div class="row centered-form">
            <br><div class="col-lg-12 col-sm-12 col-xs-12">
                <center><h3 class="font">Abonnement</h3>
                <?php
                if (isset($_SESSION['id']))
                {
                  $req=$bdd->query('SELECT subscriptionType FROM SUBSCRIPTION WHERE idUser =' . $_SESSION['id']);
                  $subscription = $req->fetch(PDO::FETCH_ASSOC);
                  echo 'Abonnement actuel pour votre compte : <b>' . (isset($subscription['subscriptionType']) ? $subscription['subscriptionType'] : 'Aucun')  . '</b></center>';
                }

                 ?>
                  <?php
                  if(isset($_GET['error']) && $_GET['error'] == 'connected') {
                      echo '<center><p style="color: red;">Il faut être connecté pour s\'abonner</p></center>';
                  }

                  if(isset($_GET['error']) && $_GET['error'] == 'succeed' && $_GET['sub'] == 'base') {
                      echo '<center><p style="color: red;">Achat de l\'abonnement de ' . $_GET['sub'] . ' réussi</p></center>';
                  }

                  if(isset($_GET['error']) && $_GET['error'] == 'succeed' && $_GET['sub'] == 'family') {
                      echo '<center><p style="color: red;">Achat de l\'abonnement ' . $_GET['sub'] . ' réussi</p></center>';
                  }

                  if(isset($_GET['error']) && $_GET['error'] == 'succeed' && $_GET['sub'] == 'premium') {
                      echo '<center><p style="color: red;">Achat de l\'abonnement ' . $_GET['sub'] . ' réussi</p></center>';
                  }

                  if(isset($_GET['error']) && $_GET['error'] == 'subscribed') {
                      echo '<center><p style="color: red;">Vous êtes déjà abonné</p>';
                  }
                  ?>
                </div>
                  <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="card text-center box" style=""><br>
                        <center><img class="size" width="110px" height="110px"
                                     src="../img/base.png"></center>
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center">Abonnement de base</h5><br>
                            <p class="card-text" style="text-align: center">Bénéficiez d'un accès privilégie en ilimité 5j/7 de 9h à 20h</p>
                            <p class="card-text" style="text-align: center">12h de services/mois</p><br>
                            <center><a href="subscription/subscription_base.php" class="btn btn-primary">S'abonner</a></center>
                        </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="card text-center box" style=""><br>
                        <center><img class="size" width="110px" height="110px"
                                     src="../img/famille.png"></center>
                      <div class="card-body">
                          <h5 class="card-title" style="text-align: center">Abonnement Familial</h5><br>
                          <p class="card-text" style="text-align: center">Bénéficiez d'un accès privilégie en ilimité 6j/7 de 9h à 20h</p>
                          <p class="card-text" style="text-align: center">25h de services/mois</p><br>
                          <center><a href="subscription/subscription_family.php" class="btn btn-primary">S'abonner</a></center>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="card text-center box" style=""><br>
                        <center><img class="size" width="110px" height="110px"
                                     src="../img/premium.png"></center>
                      <div class="card-body">
                          <h5 class="card-title" style="text-align: center">Abonnement Premium</h5><br>
                          <p class="card-text" style="text-align: center">Bénéficiez d'un accès privilégie en ilimité 7j/7 24h/24</p>
                          <p class="card-text" style="text-align: center">50h de services/mois</p><br>
                          <center><a href="subscription/subscription_premium.php" class="btn btn-primary">S'abonner</a></center>
                      </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </main>

    <footer id="footer">
        <br>
        <section id="bottom">
            <a href=""><img src="../img/logo.png" width="80"></a>
            <div><small> Concierge Expert - All rights reserved © </small></div>
        </section>
        <br>
    </footer>

</body>

</html>
