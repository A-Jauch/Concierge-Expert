<?php
include 'searchSubcategories.php';

if(isset($_POST['research'])) {
    //get all subcategories
    $sc = searchSubcategories();

    for ($i = 0; $i < count($sc); $i++) {
        if ($sc[$i][0] == $_POST['research']) {
            echo '<div class="card card-pos col-md-2">';
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
            exit;
        }
    }
    echo '<p>Ce service n\'existe pas</p>';
}
