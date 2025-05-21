<?php
include('first.php');
include('php/db.php');

include("php/dbconnect.php");


if (isset($_REQUEST['id_type_echantillon'])) {
    $id_type_echantillon = $_REQUEST['id_type_echantillon'];


//    $query = "DELETE FROM type_eco WHERE id_type_eco='$id_type_eco'";
//    $sql = $conn->query($query);

    $open_close = 1;

    $query1 = " UPDATE type_echantillon SET  open_close=:open_close    
                    WHERE id_type_echantillon = '$id_type_echantillon' ";

    $sql1 = $db->prepare($query1);

    // Bind parameters to statement
    $sql1->bindParam(':open_close', $open_close);
    $sql1->execute();


    if ($sql1) {
        echo "<script>
                window.location.href='liste_type_echantillon.php?witness=1';
            </script>";
    } else {

        echo "<script>
                window.location.href='liste_type_echantillon.php?witness=-1';
            </script>";
    }
}


?>