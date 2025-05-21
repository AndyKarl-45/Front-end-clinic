<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {


    /*--------------------------------- ETAT INFOS RH -------------------------------------*/
    $id = $_POST['id_trans_caisse'];
    $id_caisse_dst = $_POST['id_caisse_dst'];
    $montant= $_POST['montant'];




    /*--------------------------------- SAVE DATA MEDOC---------------------------*/

    $query1 = " UPDATE transfert_caisse  SET  id_caisse_dst=:id_caisse_dst, quantite=:montant
                    WHERE id_trans_caisse = '$id' ";


    $sql1 = $db->prepare($query1);

    // Bind parameters to statement
    $sql1->bindParam(':id_caisse_dst', $id_caisse_dst);
    $sql1->bindParam(':montant', $montant);
    $sql1->execute();


    if ($sql1) {
        ?>
        <script>
          // alert(' Médicament a été bien mis à jour.');
            window.location.href = 'liste_transfert_caisse_suite.php?witness=1';
        </script>
        <?php
    } else {
        ?>
        <script>
          // alert('Médicament n\'a pas été mis à jour.');
            window.location.href = 'liste_transfert_caisse_suite.php?witness=-1';
        </script>
        <?php

    }


}
?>
