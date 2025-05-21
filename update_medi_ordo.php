<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {


    /*--------------------------------- ETAT INFOS RH -------------------------------------*/
    $id = $_POST['id_medi'];
    $ref_ordo = $_POST['ref_ordo'];
    $qte = $_POST['qte'];




    /*--------------------------------- SAVE DATA MEDOC---------------------------*/

    $query1 = " UPDATE medicament_ordo  SET   quantite_medi_ordo=:quantite 
                    WHERE id_medi = '$id' and ref_medi_ordo='$ref_ordo' ";


    $sql1 = $db->prepare($query1);

    // Bind parameters to statement
    $sql1->bindParam(':quantite', $qte);
    $sql1->execute();


    if ($sql1) {
        ?>
        <script>
            alert(' Médicament a été bien mis à jour.');
            window.location.href = 'modifier_ordo.php?ref_ordo=<?=$ref_ordo?>&witness=1';
        </script>
        <?php
    } else {
        ?>
        <script>
            alert('Médicament n\'a pas été mis à jour.');
            window.location.href = 'modifier_ordo.php?ref_ordo=<?=$ref_ordo?>&witness=-1';
        </script>
        <?php

    }


}
?>
