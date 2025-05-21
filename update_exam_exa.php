<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {


    /*--------------------------------- ETAT INFOS RH -------------------------------------*/
    $id = $_POST['id_type_exa_last'];
    $id_type_exa = $_POST['id_type_exa_new'];
    $id_exa = $_POST['id_exa'];
    $ref_exa = $_POST['ref_exa'];
    $date_exam = $_POST['date_exam'];





    /*--------------------------------- SAVE DATA INFOS RH ---------------------------*/

    // $query1 = " INSERT INTO personnel (ref_client,raison_social_client,pays_client,ville_client,tel_client,email_client,pers_contact_client,tel_contact_client,nom_banque,number_card_bancaire,day_anciennete,month_anciennete,year_anciennete)
    // VALUES
    // (:ref_client,:raison_social_client,:pays_client,:ville_client,:tel_client,:email_client,:pers_contact_client,:tel_contact_client,:nom_banque,:number_card_bancaire,:day_anciennete,:month_anciennete,:year_anciennete)";

    $query1 = " UPDATE examen_exa SET  id_type_exa=:id_type_exa, date_exam=:date_exam  WHERE id_type_exa = '$id' and ref_exam_exa='$ref_exa' and id_exa='$id_exa' ";


    $sql1 = $db->prepare($query1);

    // Bind parameters to statement
    $sql1->bindParam(':id_type_exa', $id_type_exa);
    $sql1->bindParam(':date_exam', $date_exam);
    $sql1->execute();


    if ($sql1) {
        ?>
        <script>
            //alert('Type de d\'examaen  a été² bien mis à jour.');
            window.location.href = 'liste_exam_exa.php?ref_exa=<?=$ref_exa?>&witness=1';
        </script>
        <?php
    } else {
        ?>
        <script>
            alert('Type de d\'examaen  n\'a ²pas été mis à jour.');
           // window.location.href = 'liste_exam_exa.php?ref_exa=<?=$ref_exa?>&witness=-1';
        </script>
        <?php

    }


}
?>
