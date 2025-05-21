<?php

include ("php/dbconnect.php");


if (isset($_REQUEST['ref_com_outil']) and isset($_REQUEST['id_num_lot_outil'])) {
    $ref_com_outil = $_REQUEST['ref_com_outil'];
    $id_num_lot_outil = $_REQUEST['id_num_lot_outil'];
    // echo $id_personnel;

    $query = "DELETE FROM commande_outil WHERE ref_com_outil='$ref_com_outil' and id_num_lot_outil='$id_num_lot_outil' ";
    $sql = $conn->query($query);


    if ($sql)
    {
        ?>
        <script>
            alert('Commande a été bien modifié.');
            window.location.href='modifier_commande_outil.php?ref_com_outil=<?=$ref_com_outil?>';
        </script>
        <?php
    }
    else
    {

        ?>
        <script>
            alert('Commande a été bien modifié.');
            window.location.href='modifier_commande_outil.php?ref_com_outil=<?=$ref_com_outil?>';
        </script>
        <?php
    }
}


?>
