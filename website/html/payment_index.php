<?php session_start();
include 'config.php';
$name = $_POST['name'];

$constprice = 0;
function debug($variable)
{
    echo '<pre>' . print_r($variable, true) . '</pre>';
}

?>

<?

if (!empty($_POST['heureSemaine']) && isset($_POST['date']) && !empty($_POST['date']) &&isset($_SESSION['mail'])) {

    $insert = $bdd->prepare("INSERT INTO " . $name . "(heureSemaine,date,name,idUser)" . "VALUES (?,?,?,?)");

    $insert->execute([$_POST['heureSemaine'], $_POST['date'], $name, $_SESSION['id']]);
    $last_id = $bdd->lastInsertId();
}

if (!empty($_POST['heureSemaine']) && isset($_POST['dateDebut']) && isset($_POST['dateFin']) && !empty($_POST['dateFin']) && !empty($_POST['dateDebut'])) {

    $insert = $bdd->prepare("INSERT INTO " . $name . "(heureSemaine,dateDebut,dateFin,name)" . "VALUES (?,?,?,?)");

    $insert->execute([$_POST['heureSemaine'], $_POST['dateDebut'], $_POST['dateFin'], $name]);
    $last_id = $bdd->lastInsertId();
}


$req = $bdd->prepare("SELECT * FROM " . $name . " WHERE id =1");
$req->execute();
$test = $req->fetchAll(PDO::FETCH_ASSOC);
$constprice = $test[0]['price'];
?>

<?php


foreach ($test as $rows) {


    //  debug($constprice);
    $hour = strtotime($_POST['heureSemaine']);

    if (!empty($_POST['dateDebut']) && !empty($_POST['dateFin']) && isset($_POST['dateDebut']) && isset($_POST['dateDebut'])) {
        $dateDebut = idate('w', strtotime($_POST['dateDebut']));
        $dateFin = idate('w', strtotime($_POST['dateFin']));
        $dateDif = $dateDebut - $dateFin;
        debug($dateDif);
    }
    if (!empty($_POST['heureSemaine']) && isset($_POST['heureSemaine'])) {
        $stockHmin = idate('H', $hour) * 60;
        //    debug($stockHmin);
        $totalH = (idate('i', $hour) + $stockHmin) / 60;
        //    debug($totalH);
        $result = $totalH * $rows['price'];
        debug($result);

    }


    //   debug($_POST);


    if (!empty($_POST['heureSemaine']) && isset($_POST['heureSemaine'])) {
        if (isset($rows["price"])) {
            //debug($result);


            $insert = $bdd->prepare(" UPDATE " . $name . " SET price = " . $result . " WHERE id =" . $last_id);

            $insert->execute([$result]);

        }

        $req = $bdd->prepare("SELECT * FROM " . $name . " WHERE id =" . $last_id);
        $req->execute();
        $price = $req->fetchAll(PDO::FETCH_ASSOC);
    }
}

/*if (!empty($_POST['heureSemaine']) && isset($_POST['heureSemaine']))
{

    foreach ($price as $row) {
       debug($row['id']);
    }
}*/


if (!empty($_POST['heureSemaine']) && isset($_POST['heureSemaine'])) {
    $total_price = 0;

    $item_details = '';

    $order_details = '
<div class="table-responsive" id="order_table">
 <table class="table table-bordered table-striped">
      <tr>  
        <th>Nom Service</th>  
        <th>Nombre Heures Au Jour</th>  
        <th>Prix Horraire</th>  
        <th>Total</th>  
    </tr>
';
    if (!empty($price)) {
        foreach ($price as $rows) {
            $order_details .= '
              <tr>
               <td>' . $rows["name"] . '</td>
               <td>' . $rows["heureSemaine"] . '</td>
               <td align="right">$ ' . $constprice . '</td>
               <td align="right">$ ' . number_format($rows["price"], 2) . '</td>
              </tr>
  
            ';
        }

    }
    $order_details .= '</table>';

}

if (!empty($_POST['dateDebut']) && !empty($_POST['dateFin']) && isset($_POST['dateDebut']) && isset($_POST['dateDebut']) && !empty($_POST['heureSemaine']) && isset($_POST['heureSemaine'])) {
    $total_price = 0;

    $item_details = '';

    $order_details = '
<div class="table" id="order_table">
 <table class="table table-bordered table-striped">
      <tr>  
        <th>Nom Service</th>  
        <th>Nombre Heures Semaine</th>
        <th>Date de Début</th>  
        <th>Date de Fin</th>
        <th>Nombre de Jour de service</th>    
        <th>Prix horaire</th>  
        <th>Total</th>  
    </tr>
';
    if (!empty($price)) {
        foreach ($price as $rows) {
            debug($rows);
            $order_details .= '
            <tr>
   <td>' . $rows["name"] . '</td>
   <td>' . $rows["heureSemaine"] . '</td>
    <td>' . $rows["dateDebut"] . '</td>
    <td>' . $rows["dateFin"] . '</td>
    <td>' . $dateDif . '</td>

   <td align="right">$ ' . $constprice . '</td>
   <td align="right">$ ' . number_format($rows["price"], 2) . '</td>
  </tr>
  
            ';
        }

    }
    $order_details .= '</table></div>';
}


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <title>Payment Home</title>
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
                            <li><a href="service.php">Services</a></li>
                            <a href="../index.php" id="logo"><img src="../img/logo.png" width="150px" alt="logo"></a>
                            <li><a href="#">Contact</a></li>
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


<div class="container">
    <br/>
    <h3 align="center"><a href="#">PHP Shopping Cart with Stripe Payment Integration</a></h3>
    <br/>
    <span id="message"></span>
    <div class="panel panel-default">
        <div class="panel-heading">Order Process</div>
        <div class="panel-body">
            <form method="post" id="order_process_form" action="payment.php">
                <div class="row">
                    <div class="col-md-8" style="border-right:1px solid #ddd;">
                        <h4 align="center">Customer Details</h4>
                        <div class="form-group">
                            <label><b>Card Holder Name <span class="text-danger">*</span></b></label>
                            <input type="text" name="customer_name" id="customer_name" class="form-control" value=""/>
                            <span id="error_customer_name" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label><b>Email Address <span class="text-danger">*</span></b></label>
                            <input type="text" name="email_address" id="email_address" class="form-control" value=""/>
                            <span id="error_email_address" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label><b>Address <span class="text-danger">*</span></b></label>
                            <textarea name="customer_address" id="customer_address" class="form-control"></textarea>
                            <span id="error_customer_address" class="text-danger"></span>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label><b>City <span class="text-danger">*</span></b></label>
                                    <input type="text" name="customer_city" id="customer_city" class="form-control"
                                           value=""/>
                                    <span id="error_customer_city" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label><b>Zip <span class="text-danger">*</span></b></label>
                                    <input type="text" name="customer_pin" id="customer_pin" class="form-control"
                                           value=""/>
                                    <span id="error_customer_pin" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label><b>State </b></label>
                                    <input type="text" name="customer_state" id="customer_state" class="form-control"
                                           value=""/>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label><b>Country <span class="text-danger">*</span></b></label>
                                    <input type="text" name="customer_country" id="customer_country"
                                           class="form-control"/>
                                    <span id="error_customer_country" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <h4 align="center">Payment Details</h4>
                        <div class="form-group">
                            <label>Card Number <span class="text-danger">*</span></label>
                            <input type="text" name="card_holder_number" id="card_holder_number" class="form-control"
                                   placeholder="1234 5678 9012 3456" maxlength="20" onkeypress=""/>
                            <span id="error_card_number" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Expiry Month</label>
                                    <input type="text" name="card_expiry_month" id="card_expiry_month"
                                           class="form-control" placeholder="MM" maxlength="2"
                                           onkeypress="return only_number(event);"/>
                                    <span id="error_card_expiry_month" class="text-danger"></span>
                                </div>
                                <div class="col-md-4">
                                    <label>Expiry Year</label>
                                    <input type="text" name="card_expiry_year" id="card_expiry_year"
                                           class="form-control" placeholder="YYYY" maxlength="4"
                                           onkeypress="return only_number(event);"/>
                                    <span id="error_card_expiry_year" class="text-danger"></span>
                                </div>
                                <div class="col-md-4">
                                    <label>CVC</label>
                                    <input type="text" name="card_cvc" id="card_cvc" class="form-control"
                                           placeholder="123" maxlength="4" onkeypress="return only_number(event);"/>
                                    <span id="error_card_cvc" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div align="center">
                            <input type="hidden" name="total_amount" value="<?php echo $total_price; ?>"/>
                            <input type="hidden" name="currency_code" value="USD"/>
                            <input type="hidden" name="item_details" value="<?php echo $item_details; ?>"/>
                            <input type="button" name="button_action" id="button_action" class="btn btn-success btn-sm"
                                   value="Pay Now"/>
                        </div>
                        <br/>
                    </div>
                    <div class="col-md-4">
                        <h4 align="center">Order Details</h4>
                        <?php
                        echo $order_details;
                        ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
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

<script>
    $(document).ready(function () {

        function load_project() {
            $.ajax({
                url: "fetch_item.php",
                method: "POST",
                success: function (data) {
                    $('#display_item').html(data); // to display product on webpage
                }

            })

        }

    });


</script>
