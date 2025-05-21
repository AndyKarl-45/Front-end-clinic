<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {




    $id_patient = $_POST['id_patient'];
    $id_vac = $_POST['id_vac'];
    $id_nurse = $_POST['id_nurse'];
    $id_medecin = $_POST['id_medecin'];
    $id_type_vaccin = $_POST['id_type_vaccin'];
    $date_vaccin = $_POST['date_vaccin'];
    $date_next_vaccin = $_POST['date_next_vaccin'];
    $date_modified = date('Y-m-d');



    $year = (new DateTime())->format("Y");
    $month = (new DateTime())->format("m");
    $day = (new DateTime())->format("d");

//    // Convertir la date du jour en objet DateTime
//    $dateTimeDuJour = new DateTime($date_hosp);
//
//    // Ajouter le nombre de jours pour obtenir la date de sortie
//    $dateTimeSortie = $dateTimeDuJour->modify("+$nb_jour days");
//
//    // Obtenir la date de sortie au format Y-m-d
//    $date_sortie = $dateTimeSortie->format('Y-m-d');




    if(empty($id_type_vaccin)){
        ?>
        <script>
            //alert('client a été bien enregistrée.');
            window.location.href = '<?=$vaccination['option2_link']?>?witness=-3';
        </script>
        <?php
    }else{
        $query  = "SELECT prix_vaccin from type_vaccin where id_type_vaccin='$id_type_vaccin'";
        $q = $conn->query($query);
        while($row = $q->fetch_assoc())
        {
            $somme = $row["prix_vaccin"];
        }

    }

    if( $date_vaccin <= $date_next_vaccin ){


        $query1 = "UPDATE vaccination SET   id_medecin=:id_medecin, id_type_vaccin=:id_type_vaccin, date_next_vaccin=:date_next_vaccin, date_modified=:date_modified,id_patient=:id_patient, id_nurse=:id_nurse, date_vaccin=:date_vaccin
                            WHERE id_vac = '$id_vac'";

        $sql1 = $db->prepare($query1);

        // Bind parameters to statement;
        $sql1->bindParam(':id_medecin', $id_medecin);
        $sql1->bindParam(':id_type_vaccin', $id_type_vaccin);
        $sql1->bindParam(':date_next_vaccin', $date_next_vaccin);
        $sql1->bindParam(':date_modified', $date_modified);
        $sql1->bindParam(':id_patient', $id_patient);
        $sql1->bindParam(':id_nurse', $id_nurse);
        $sql1->bindParam(':date_vaccin', $date_vaccin);
        $sql1->execute();


        $query  = "SELECT prix_vaccin from type_vaccin where id_type_vaccin='$id_type_vaccin'";
        $q = $conn->query($query);
        while($row = $q->fetch_assoc())
        {
            $somme = $row["prix_vaccin"];
        }


        $query1 = "UPDATE regler_vac SET   id_medecin=:id_medecin, id_type_vaccin=:id_type_vaccin, somme=:somme, id_patient=:id_patient, id_nurse=:id_nurse
                            WHERE id_vac = '$id_vac'";

        $sql1 = $db->prepare($query1);

        // Bind parameters to statement;
        $sql1->bindParam(':id_medecin', $id_medecin);
        $sql1->bindParam(':id_type_vaccin', $id_type_vaccin);
        $sql1->bindParam(':somme', $somme);
        $sql1->bindParam(':id_patient', $id_patient);
        $sql1->bindParam(':id_nurse', $id_nurse);
        $sql1->execute();


    }else{
        ?>
        <script>
            //alert('client a été bien enregistrée.');
            window.location.href = '<?=$vaccination['option2_link']?>?witness=-2';
        </script>
        <?php
    }



    if ($sql1) {
        ?>
        <script>
            //alert('client a été bien enregistrée.');
            window.location.href = '<?=$vaccination['option2_link']?>?witness=1';
        </script>
        <?php
    } else {
        ?>
        <script>
            //alert('Error.');
            window.location.href = '<?=$vaccination['option2_link']?>?witness=-1';
        </script>
        <?php

    }


}
?>
