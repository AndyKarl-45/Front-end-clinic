<?php

include ("php/dbconnect.php");


if (isset($_REQUEST['ref_ordo']) and isset($_REQUEST['id_medi'])) {
    $ref_ordo = $_REQUEST['ref_ordo'];
    $id_medi = $_REQUEST['id_medi'];
    // echo $id_personnel;

    $query = "DELETE FROM medicament_ordo WHERE ref_ordo='$ref_ordo' and id_medi='$id_medi' ";
    $sql = $conn->query($query);


    if ($sql)
    {
        ?>
        <script>
            alert('Commande a été bien modifié.');
            window.location.href='modifier_ordo.php?ref_ordo=<?=$ref_ordo?>';
        </script>
        <?php
    }
    else
    {

        ?>
        <script>
            alert('Commande a été bien modifié.');
            window.location.href='modifier_ordo.php?ref_ordo=<?=$ref_ordo?>';
        </script>
        <?php
    }
}


?>
