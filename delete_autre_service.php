<?php
include('first.php');
include('php/db.php');
include("php/dbconnect.php");


if (isset($_REQUEST['id_autre_service'])) {
    $id_autre_service = $_REQUEST['id_autre_service'];


//    $query = "DELETE FROM type_eco WHERE id_type_eco='$id_type_eco'";
//    $sql = $conn->query($query);

    $open_close = 1;

    $query1 = " UPDATE autres_services SET  open_close=:open_close    
                    WHERE id_autre_service= '$id_autre_service' ";


    $sql1 = $db->prepare($query1);

    // Bind parameters to statement
    $sql1->bindParam(':open_close', $open_close);
    $sql1->execute();


    if ($sql1) {
        echo "<script>
                window.location.href='liste_autre_service.php?witness=1';
            </script>";
    } else {

        echo "<script>
                window.location.href='liste_autre_service.php?witness=-1';
            </script>";
    }
}


?>