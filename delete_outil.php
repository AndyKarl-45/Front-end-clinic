<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {


    /*--------------------------------- ETAT INFOS RH -------------------------------------*/
    $id = $_POST['id'];
    // echo $id;

    $open_close = 1;

    $query1 = " UPDATE type_outil SET  open_close=:open_close    
                    WHERE id_type_outil= '$id' ";


    $sql1 = $db->prepare($query1);

    // Bind parameters to statement
    $sql1->bindParam(':open_close', $open_close);
    $sql1->execute();


    if ($sql1) {
        ?>
        <script>
         
            window.location.href = '<?=$cat_outil['option1_link']?>?witness=1';
        </script>
        <?php
    } else {
        ?>
        <script>
            alert('Categorie fourniture n\'a pas été supprimé.');
            window.location.href = '<?=$cat_outil['option2_link']?>?witness=-1';
        </script>
        <?php

    }


}
?>
