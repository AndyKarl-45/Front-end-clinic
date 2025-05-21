<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {
    
    $id_radiologie = $_POST['id_radiologie'];
    $partie = $_POST['partie'];
    $id_patient = $_POST['id_patient'];
    
    /*--------------------------------- ETAT INFOS RH -------------------------------------*/
    
    if($partie==1){
        
        $id_medecin = $_POST['id_medecin'];
        $id_type_radiologie = $_POST['id_type_radiologie'];
        $date_radiologie = $_POST['date_radiologie'];
        $obs = $_POST['obs'];

        $query1 = "UPDATE radiologie SET  id_patient=:id_patient, id_medecin=:id_medecin, 
                     id_type_radiologie=:id_type_radiologie, date_radiologie=:date_radiologie, obs=:obs   
                    WHERE id_radiologie = '$id_radiologie' ";


        $sql1 = $db->prepare($query1);

        // Bind parameters to statement
        $sql1->bindParam(':id_patient', $id_patient);
        $sql1->bindParam(':id_medecin', $id_medecin);
        $sql1->bindParam(':id_type_radiologie', $id_type_radiologie);
        $sql1->bindParam(':date_radiologie', $date_radiologie);
        $sql1->bindParam(':obs', $obs);
        $sql1->execute();

    }else{
        
        $id_radiologie = $_POST['id_radiologie'];
        $obs_radiologie = $_POST['obs_radiologie'];

        $query1 = "UPDATE radiologie SET  id_radiologie=:id_radiologie, id_patient=:id_patient,  obs_radiologie=:obs_radiologie 
                    WHERE id_radiologie = '$id_radiologie' ";


        $sql1 = $db->prepare($query1);

        // Bind parameters to statement
        $sql1->bindParam(':id_radiologie', $id_radiologie);
        $sql1->bindParam(':id_patient', $id_patient);
        $sql1->bindParam(':obs_radiologie', $obs_radiologie);
        $sql1->execute();
    }



    if ($sql1) {
        ?>
        <script>
            //alert('Consulattion a été bien mis à jour.');
            window.location.href = '<?=$radiologie['option2_link']?>?witness=1';
        </script>
        <?php
    } else {
        ?>
        <script>
            //   alert('client n\'a pas été mis à jour.');
            window.location.href = '<?=$radiologie['option2_link']?>?witness=-1';
        </script>
        <?php

    }


}
?>
