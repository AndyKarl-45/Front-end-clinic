<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php");



if (isset($_REQUEST['id'])) {
    $id_num_lot = $_REQUEST['id'];
    $type = $_REQUEST['type'];

    if($type == 'magasin'){
        $query = "DELETE FROM magasin WHERE id_num_lot='$id_num_lot'";
        $sql = $conn->query($query);

        if ($sql) {
            echo "<script>
                window.location.href='liste_mag_centrale_peremption.php?witness=1';
            </script>";
        } else {

            echo "<script>
                window.location.href='liste_mag_centrale_peremption.php?witness=-1';
            </script>";
        }

    }else{
        $query = "DELETE FROM pharmacie WHERE id_num_lot='$id_num_lot'";
        $sql = $conn->query($query);

        if ($sql) {
            echo "<script>
                window.location.href='liste_mag_phar_peremption.php?witness=1';
            </script>";
        } else {

            echo "<script>
                window.location.href='liste_mag_phar_peremption.php?witness=-1';
            </script>";
        }
    }



//    $open_close = 1;
//
//    $query1 = " UPDATE fournisseur SET  open_close=:open_close
//                    WHERE id_four= '$id_four' ";
//    $sql1 = $db->prepare($query1);
//
//    // Bind parameters to statement
//    $sql1->bindParam(':open_close', $open_close);
//    $sql1->execute();


}


?>