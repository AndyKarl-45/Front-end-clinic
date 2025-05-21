<?php

include("php/dbconnect.php");


if (isset($_REQUEST['idr'])) {
    $ref_com_outil = $_REQUEST['idr'];
   // $id_four = $_REQUEST['idf'];


    $query = "DELETE FROM commande_outil WHERE ref_com_outil='$ref_com_outil'";
    $sql = $conn->query($query);


    if ($sql) {
        echo "<script>
                window.location.href='liste_commande_outil_suite.php?witness=1';
            </script>";
    } else {

        echo "<script>
                window.location.href='liste_commande_outil_suite.php?witness=-1';
            </script>";
    }
}else {

    echo "<script>
                window.location.href='liste_commande_outil_suite.php?witness=-1';
            </script>";
}


?>