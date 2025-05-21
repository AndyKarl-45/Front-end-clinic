<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {


    /*--------------------------------- ETAT INFOS RH -------------------------------------*/
    $id_four = $_POST['id_four'];
    $ref_com_outil = $_POST['ref_com_outil'];
    $date_c_com = $_POST['date_c_com'];
    

    $query1 = " UPDATE commande_outil SET  id_four=:id_four, date_c_com=:date_c_com   WHERE ref_com_outil = '$ref_com_outil' ";


    $sql1 = $db->prepare($query1);

    // Bind parameters to statement
    $sql1->bindParam(':id_four', $id_four);
    $sql1->bindParam(':date_c_com', $date_c_com);
    $sql1->execute();


    if ($sql1) {
        ?>
        <script>
            //alert('client a été bien mis à jour.');
            window.location.href = 'modifier_commande_outil.php?ref_com_outil=<?=$ref_com_outil?>&witness=1';
        </script>
        <?php
    } else {
        ?>
        <script>
           // alert('client n\'a pas été mis à jour.');
            window.location.href = 'modifier_commande_outil.php?ref_com_outil=<?=$ref_com_outil?>&witness=-1';
        </script>
        <?php

    }


}
?>
