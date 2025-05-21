<?php

include("php/dbconnect.php");


if (isset($_REQUEST['id_type_vaccin'])) {
    $id_type_vaccin = $_REQUEST['id_type_vaccin'];


    $open_close=1;

    $query1 = " UPDATE type_vaccin SET  open_close=:open_close    
                    WHERE id_type_vaccin='$id_type_vaccin'";


    $sql1 = $db->prepare($query1);

    // Bind parameters to statement
    $sql1->bindParam(':open_close', $open_close);
    $sql1->execute();


    if ($sql1) {
        echo "<script>
                window.location.href='liste_vaccin.php?witness=1';
            </script>";
    } else {

        echo "<script>
                window.location.href='liste_vaccin.php?witness=-1';
            </script>";
    }
}


?>