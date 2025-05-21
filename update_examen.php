<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {
    $id_exa = $_POST['id_exa'];
    $partie = $_POST['partie'];
    $id_patient = $_POST['id_patient'];
    $id_type_exa = $_POST['id_type_exa'];
    /*--------------------------------- ETAT INFOS RH -------------------------------------*/
    if($partie==1){
        $id_medecin = $_POST['id_medecin'];
        $date_exa = $_POST['date_exa'];
        $obs = $_POST['obs'];

        $query1 = "UPDATE examen SET  id_patient=:id_patient, id_medecin=:id_medecin, 
                     id_type_exa=:id_type_exa, date_exa=:date_exa, obs=:obs   
                    WHERE id_exa = '$id_exa' ";


        $sql1 = $db->prepare($query1);

        // Bind parameters to statement
        $sql1->bindParam(':id_patient', $id_patient);
        $sql1->bindParam(':id_medecin', $id_medecin);
        $sql1->bindParam(':id_type_exa', $id_type_exa);
        $sql1->bindParam(':date_exa', $date_exa);
        $sql1->bindParam(':obs', $obs);
        $sql1->execute();

    }else{
        $id_lab = $_POST['id_laboratin'];
        $resultat_exa = $_POST['resultat_exa'];
        $remarque = $_POST['remarque'];
        $rang = $_POST['rang'];
        $id_type_echantillon = $_POST['id_type_echantillon'];

        $query1 = "UPDATE examen SET  id_lab=:id_lab, id_patient=:id_patient
                    WHERE id_exa = '$id_exa' ";


        $sql1 = $db->prepare($query1);

        // Bind parameters to statement
        $sql1->bindParam(':id_lab', $id_lab);
        $sql1->bindParam(':id_patient', $id_patient);
        $sql1->execute();
        
        
        $query1 = "UPDATE examen_exa SET resultat_exa=:resultat_exa , remarque=:remarque, rang=:rang, id_type_echantillon=:id_type_echantillon
                    WHERE id_exa = '$id_exa' and id_type_exa='$id_type_exa' ";


        $sql1 = $db->prepare($query1);

        // Bind parameters to statement
        $sql1->bindParam(':resultat_exa', $resultat_exa);
        $sql1->bindParam(':remarque', $remarque);
        $sql1->bindParam(':rang', $rang);
        $sql1->bindParam(':id_type_echantillon', $id_type_echantillon);
        $sql1->execute();
        
            if ($sql1) {
                ?>
                <script>
                     window.location.href = 'modifier_examen.php?id=<?=$id_exa?>&witness=1';
                </script>
                <?php
            } else {
                ?>
                <script>
                    window.location.href = 'modifier_examen.php?id=<?=$id_exa?>&witness=-1';
                </script>
                <?php
        
            }
    
    }



    if ($sql1) {
        ?>
        <script>
            //alert('Consulattion a été bien mis à jour.');
            window.location.href = '<?=$examen['option2_link']?>?witness=1';
        </script>
        <?php
    } else {
        ?>
        <script>
            //   alert('client n\'a pas été mis à jour.');
            window.location.href = '<?=$examen['option2_link']?>?witness=-1';
        </script>
        <?php

    }


}
?>
