<?php

include("php/dbconnect.php");


if (isset($_REQUEST['id'])) {
    $id_con = $_REQUEST['id'];


    $query = "DELETE FROM consultation WHERE id_con='$id_con' and etat=-1";
    $sql1 = $conn->query($query);


    if ($sql1) {

        $query = "DELETE FROM regler_consul WHERE id_con='$id_con'";
        $sql1 = $conn->query($query);
    }else{

        $open_close=1;

        $query1 = " UPDATE consultation SET  open_close=:open_close    
                    WHERE id_con='$id_con' and etat=1 ";


        $sql1 = $db->prepare($query1);

        // Bind parameters to statement
        $sql1->bindParam(':open_close', $open_close);
        $sql1->execute();

        $query1 = " UPDATE regler_consul SET  open_close=:open_close    
                    WHERE id_con='$id_con' ";


        $sql1 = $db->prepare($query1);

        // Bind parameters to statement
        $sql1->bindParam(':open_close', $open_close);
        $sql1->execute();

    }




    if ($sql1) {
        echo "<script>
                window.location.href='liste_consultation.php?witness=1';
            </script>";
    } else {

        echo "<script>
                window.location.href='liste_consultation.php?witness=-1';
            </script>";
    }
}


?>