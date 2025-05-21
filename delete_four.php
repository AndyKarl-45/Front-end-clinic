<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php");



if (isset($_REQUEST['id'])) {
    $id_four = $_REQUEST['id'];


//    $query = "DELETE FROM fournisseur WHERE id_four='$id_four'";
//    $sql = $conn->query($query);

    $open_close = 1;

    $query1 = " UPDATE fournisseur SET  open_close=:open_close    
                    WHERE id_four= '$id_four' ";
    $sql1 = $db->prepare($query1);

    // Bind parameters to statement
    $sql1->bindParam(':open_close', $open_close);
    $sql1->execute();

    if ($sql1) {
        echo "<script>
                window.location.href='liste_four.php?witness=1';
            </script>";
    } else {

        echo "<script>
                window.location.href='liste_four.php?witness=-1';
            </script>";
    }
}


?>