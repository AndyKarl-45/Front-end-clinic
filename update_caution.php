<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php");
?>

<?php

if ($_POST) {


    // strtoupper($_POST['nom_quat']);
     $id_caution = $_POST['id_caution'];
    $id_patient = $_POST['id_patient'];
    $id_perso = $_POST['id_perso'];
    $date_modif = date('Y-m-d');
    $time = date('G:i');
    $montant = $_POST['montant'];
    $open_close = 0;


    $query = "UPDATE caution SET id_patient=:id_patient, id_perso=:id_perso, montant=:montant, date_modif=:date_modif, heure_modif=:heure_modif WHERE id_caution ='$id_caution'";

    $req = $db->prepare($query);

    // Bind parameters to statement
    $req->bindParam(':id_patient', $id_patient);
    $req->bindParam(':id_perso', $id_perso);
    $req->bindParam(':montant', $montant);
    $req->bindParam(':date_modif', $date_modif);
    $req->bindParam(':heure_modif', $heure_modif);
    $req->execute();


    if ($req) {
        ?> 
        <script>
            window.location.href = 'liste_caution.php?witness=1';
        </script>
        <?php
    } else {
        ?>
        <script>
            window.location.href = 'liste_caution.php?witness=-1';
        </script>
        <?php

    }


}
?>