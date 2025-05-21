<?php

include ("php/dbconnect.php");


if (isset($_REQUEST['id_ask_outil']) and isset($_REQUEST['id_ask_outil'])  ) {
    $id_ask_outil = $_REQUEST['id_ask_outil'];
    $id_ask_outil = $_REQUEST['id_ask_outil'];
    // echo $id_personnel;

    $query = "DELETE FROM demande_materiel_outil WHERE id_ask_outil='$id_ask_outil' and id_ask_outil='$id_ask_outil' ";
    $sql = $conn->query($query);


    if ($sql)
    {
        ?>
        <script>
            alert('Demande de fourniture a été bien modifié.');
            window.location.href='modifier_demande_outil.php?id=<?=$id_ask_outil?>&witness=1';
        </script>
        <?php
    }
    else
    {

        ?>
        <script>
            alert('Demande de fourniture n\'a été bien modifié.');
            window.location.href='modifier_demande_outil.php?id=<?=$id_ask_outil?>&witness=-1';
        </script>
        <?php
    }
}


?>
