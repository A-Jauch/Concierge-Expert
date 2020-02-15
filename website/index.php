<?php include 'html/config.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Concierge Expert</title>
  </head>
  <body>
    <header>
        <nav>
          <div class="align">
            <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">Services</a></li>
              <a href="index.php" id="logo"><img src="img/logo.png" width="200px"></a>
              <li><a href="#">Contact</a></li>
              <li><a href="html/connection.php"><button type="button" class="btn btn-primary">Client area</button></a></li>
                <?php
                session_start();
                $connected = isset($_SESSION['mail']) ? true : false;
                if($connected) { ?>
                    <li><a href="html/deconnection.php"><button type="button" class="btn btn-primary">Déconnexion</button></a></li>
                <?php } ?>
            </ul>
          </div>
        </nav>
    </header>

    <main>
      <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="img/background.jpg" class="d-block w-100" class="background">
          </div>
        </div>


    <center><h1 class="font">Services</h1></center>

    <?php
          $req2 = $bdd -> prepare("SELECT * FROM SERVICE");
          $req2 -> execute();
     ?>

        <div class="container">
          <div class="row">
      <?php if($req2 -> rowCount() > 0): ?>
      <?php while($row = $req2 -> fetch(PDO::FETCH_ASSOC)): ?>
         <!-- Ajout d'un service sur l'écran d'accueil -->

            <div class="col-lg-4 col-sm-6 col-xs-12">
              <div class="card text-center box" style="width: 20rem;">
                <center><img class="size" width="300px" height="300px" src="<?php echo 'html/back_office/' . $row['image']; ?>"></center>
                <div class="card-body">
                  <h5 class="card-title"><?php echo '<h3><b>'. $row['name'] . '</b></h3>'; ?></h5>
                  <a href="#" class="btn btn-primary">Reservation</a>
                </div>
              </div>
            </div>

      <?php endwhile; ?>
      <?php endif; ?>
          </div>
        </div>

    <br><center><a href="html/back_office/add_service.php"><button type="button" class="btn btn-primary">Add a service</button></a></center><br>
    <center><a href="html/back_office/delete_service.php"><button type="button" class="btn btn-danger">Delete a service</button></a></center></br>

    </main>

  </body>

  <footer>
    <br><section id="bottom">
      <a href=""><img src="img/logo.png" width="80"></a>
      <div><small> Concierge Expert - All rights reserved © </small></div>
    </section> <br>
  </footer>
</html>
