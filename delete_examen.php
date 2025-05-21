<?php

include("php/dbconnect.php");


if (isset($_REQUEST['id'])) {
    $id_exa = $_REQUEST['id'];


    $query = "DELETE FROM examen WHERE id_exa='$id_exa' and etat=-1";
    $sql = $conn->query($query);

    if ($sql) {

        $query = "DELETE FROM regler_examen WHERE id_exa='$id_exa'";
        $sql = $conn->query($query);
    }else{

        $open_close=1;

        $query1 = " UPDATE examen SET  open_close=:open_close    
                    WHERE id_con='$id_exa' and etat=1 ";


        $sql1 = $db->prepare($query1);

        // Bind parameters to statement
        $sql1->bindParam(':open_close', $open_close);
        $sql1->execute();

        $query1 = " UPDATE regler_examen SET  open_close=:open_close    
                    WHERE id_con='$id_exa' ";


        $sql1 = $db->prepare($query1);

        // Bind parameters to statement
        $sql1->bindParam(':open_close', $open_close);
        $sql1->execute();

    }


    if ($sql1) {
        echo "<script>
                window.location.href='liste_examen.php?witness=1';
            </script>";
    } else {

        echo "<script>
                window.location.href='liste_examen.php?witness=-1';
            </script>";
    }
}


?>