<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php");
?>

<?php

if ($_POST) {


    // strtoupper($_POST['nom_quat']);
    echo $id_type_echantillon = $_POST['id_type_echantillon'];
    echo $nomB = $_POST['nom'];
    echo $nom = ucwords($nomB);
    $open_close = 0;


    $query = "UPDATE type_echantillon SET nom=:nom WHERE id_type_echantillon ='$id_type_echantillon'";

    $req = $db->prepare($query);

    // Bind parameters to statement
    $req->bindParam(':nom', $nomB);
    $req->execute();


    if ($req) {
        ?>
        <script>
            window.location.href = 'liste_type_echantillon.php?witness=1';
        </script>
        <?php
    } else {
        ?>
        <script>
            window.location.href = 'liste_type_echantillon.php?witness=-1';
        </script>
        <?php

    }


}
?>