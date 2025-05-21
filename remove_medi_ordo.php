<?php

include("php/dbconnect.php");


if (isset($_REQUEST['id']) and isset($_REQUEST['ref_ordo']) and isset($_REQUEST['id_patient']) and isset($_REQUEST['id']) and isset($_REQUEST['id_agent']) and isset($_REQUEST['agent'])) {
   echo $id_app = $_REQUEST['id'];
    $ref_ordo = $_REQUEST['ref_ordo'];
    $id_patient = $_REQUEST['id_patient'];
    $id_agent = $_REQUEST['id_agent'];
    $agent = $_REQUEST['agent'];


    $query = "DELETE FROM medicament_ordo WHERE id_medi_ordo='$id_app'";
    $sql = $conn->query($query);


    if ($sql) {
        ?>
        <script>
                window.location.href='nouvelle_ordonnance_review.php?ref_ordo=<?=$ref_ordo?>&id_patient=<?=$id_patient?>&id_agent=<?=$id_agent?>&agent=<?=$agent?>&witness=1';
            </script>
        <?php
    } else {
?>
        <script>
                window.location.href='nouvelle_ordonnance_review.php?ref_ordo=<?=$ref_ordo?>&id_patient=<?=$id_patient?>&id_agent=<?=$id_agent?>&agent=<?=$agent?>&witness=-1';
            </script>
        <?php
    }
}


?>