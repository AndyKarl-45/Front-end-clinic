<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php");
?>

<?php

if ($_POST) {


    // strtoupper($_POST['nom_quat']);
     $id_cat_exa = $_POST['id_cat_exa'];
     $description = $_POST['description'];
     $id_type_exa = $_POST['id_type_exa'];
     $nomB = strtolower($_POST['nom']);
     $nom = ucwords($nomB);
     $prix_t_exa = $_POST['prix_t_exa'];
    $open_close = 0;


    $query = "UPDATE type_exa SET id_cat_exa=:id_cat_exa, prix_t_exa=:prix_t_exa, description=:description, nom=:nom WHERE id_type_exa ='$id_type_exa'";

    $req = $db->prepare($query);

    // Bind parameters to statement
    $req->bindParam(':id_cat_exa', $id_cat_exa);
    $req->bindParam(':nom', $nomB );
    $req->bindParam(':prix_t_exa', $prix_t_exa);
    $req->bindParam(':description', $description);
    $req->execute();


    if ($req) {
        ?>
        <script>
            window.location.href = 'liste_type_examen.php?witness=1';
        </script>
        <?php
    } else {
        ?>
        <script>
            window.location.href = 'liste_type_examen.php?witness=-1';
        </script>
        <?php

    }


}
?>