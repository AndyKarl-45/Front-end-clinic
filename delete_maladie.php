<?php

include("php/dbconnect.php");


if (isset($_REQUEST['id_maladie'])) {
    $id_maladie = $_REQUEST['id_maladie'];


    $open_close=1;

    $query1 = " UPDATE maladie SET  open_close=:open_close    
                    WHERE id_maladie='$id_maladie'";


    $sql1 = $db->prepare($query1);

    // Bind parameters to statement
    $sql1->bindParam(':open_close', $open_close);
    $sql1->execute();


    if ($sql1) {
        echo "<script>
                window.location.href='liste_maladie.php?witness=1';
            </script>";
    } else {

        echo "<script>
                window.location.href='liste_maladie.php?witness=-1';
            </script>";
    }
}


?>