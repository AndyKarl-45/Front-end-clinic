<?php

include("first.php");
include('php/navbar_links.php');
include("php/db.php");


if (isset($_REQUEST['id'])) {
    $id_chirugien = $_REQUEST['id'];

    $open_close = 1;
//    $query = "DELETE FROM medecin WHERE id_medecin='$id_medecin'";
//    $sql = $conn->query($query);

    $query1 = " UPDATE chirugien  SET  open_close=:open_close    
                    WHERE id_chirugien='$id_chirugien'";
    $sql1 = $db->prepare($query1);

    // Bind parameters to statement
    $sql1->bindParam(':open_close', $open_close);
    $sql1->execute();



    if ($sql1) {
        echo "<script>
                window.location.href='liste_chirugien.php?witness=1';
            </script>";
    } else {

        echo "<script>
                window.location.href='liste_chirugien.php?witness=-1';
            </script>";
    }
}


?>