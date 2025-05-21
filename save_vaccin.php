<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php");
?>

<?php

if ($_POST) {


    // strtoupper($_POST['nom_quat']);
    $prix_vaccin = $_POST['prix_vaccin'];
    $nom1 = strtolower($_POST['nom']);
    $nom2 = ucwords($nom1);
    // echo $nom2;
    $open_close = 0;

    $sql = "INSERT INTO type_vaccin (nom,prix_vaccin)
                                  VALUES (?,?)";
    $req = $db->prepare($sql);
    $req->execute(array($nom2,$prix_vaccin));


    if ($req) {
        ?>
        <script>

            window.location.href = 'liste_vaccin.php?witness=1';
        </script>
        <?php
    } else {
        ?>
        <script>
            window.location.href = 'liste_vaccin.php?witness=-1';
        </script>
        <?php

    }


}
?>