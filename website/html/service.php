<?php 
session_start();
include 'config.php';
include 'searchSubcategories.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Concierge Expert</title>
</head>
<body>
<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-11 col-xs-12">
                <nav>
                    <div class="align">
                        <ul>
                            <li><a href="../index.php">Accueil</a></li>
                            <li><a href="#">Services</a></li>
                            <a href="../index.php" id="logo"><img src="../img/logo.png" width="200px"></a>
                            <li><a href="subscription.php">Abonnement</a></li>
                                      <?php
                                      $connected = isset($_SESSION['mail']) ? true : false;
                                      if ($connected) { ?>
                              <li><a href="html/deconnection.php">
                                      <button type="button" class="btn btn-primary">Déconnexion</button>
                                  </a>
                              </li>
                              <?php } else { ?>
                                  <li><a href="html/connection.php">
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

    <br>
  <center>
    <input class="form-control col-md-3" id="searchService" type="text" placeholder="Chercher un service" aria-label="Search">
    <br>
    <button class="btn btn-warning" onclick="search()">Rechercher</button>
  <br></center>
    <br>

  <div id="searchSection" style="display: flex; align-items: center; justify-content: center">
    <?php
        $sc = searchSubcategories();
        for ($i = 0; $i < 5; $i++) {
            echo '<div class="card card-pos col-md-2" style="margin:1em">';
            echo '<h2 style="text-align: center">' . $sc[$i][0] . '</h2>';
            echo '<img style="margin-left: auto; margin-right: auto" class="size" width="100px" height="100px" src="back_office/' . $sc[$i][1] . '">'; 
            echo '<br>';
            echo '<form style="text-align: center" action="subcategory.php" method="post">';
                echo '<input type="hidden" name="categorie" value="' . $sc[$i][2] . '">';
                echo '<input type="hidden" name="name" value="' . $sc[$i][0] . '">';
                echo '<input type="submit" value="Réserver" class="btn btn-success">';
            echo '</form>';
            echo '<br>';
            echo '</div>';
        }
    ?>
  </div>

    <br>
  <script src="search.js"></script>

</body>

<footer>
    <br>
    <img src="../img/logo.png" width="80">
    <section id="bottom">
        <!--<p class="font">Conçu par : </br>JAUCH Anthony </br> BURIOT Vincent </br>JEAN-FRANCOIS Teddy</p>-->
    </section>
    <div><small> Concierge Expert - All rights reserved © </small></div>
    <br>
</footer>
</html>
