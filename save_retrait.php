<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php");
?>

<?php

if ($_POST) {


    // strtoupper($_POST['nom_quat']);
    // $nom1 = strtolower($_POST['nom']);
    $id_banque = $_POST['id_banque'];
    $id_perso = $_POST['id_perso'];
    $auteur = $_POST['auteur'];
    $montant = $_POST['montant'];
    $motif = $_POST['motif'];
    $date_retrait=date('Y-m-d');
    // $nom2 = ucwords($nom1);
    $open_close = 0;

    $sql = "INSERT INTO retrait (id_banque,auteur,id_perso,montant,motif,date_retrait)
                                  VALUES (?,?,?,?,?,?)";
    $req = $db->prepare($sql);
    $req->execute(array($id_banque,$auteur,$id_perso,$montant,$motif,$date_retrait));


    if ($req) {
        ?>
        <script>
                        window.location.href = 'liste_retrait.php?witness=1';
        </script>
        <?php
    } else {
        ?>
        <script>
                        window.location.href = 'liste_retrait.php?witness=-1';
        </script>
        <?php

    }


}
?>