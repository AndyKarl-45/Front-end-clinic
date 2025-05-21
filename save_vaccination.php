<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {




    $id_patient = $_POST['id_patient'];
    $id_nurse = $_POST['id_nurse'];
    $id_medecin = $_POST['id_medecin'];
    $id_type_vaccin = $_POST['id_type_vaccin'];
    $date_vaccin = $_POST['date_vaccin'];
    $date_next_vaccin = $_POST['date_next_vaccin'];
    $date_created = date('Y-m-d');



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

        $query  = "SELECT max(id_vac) as total from vaccination";
        $q = $conn->query($query);
        while($row = $q->fetch_assoc())
        {
            $total_apt = $row["total"];
        }
        $id_app = $total_apt+1;
        $ref_vac= 'VAC_'.$year.'_'.$month.'_'.$day.'_'.$id_app;

        $query = " INSERT INTO vaccination (ref_vac,id_medecin,id_type_vaccin,date_next_vaccin,date_created,id_patient,id_nurse,date_vaccin)
                     VALUES (:ref_vac,:id_medecin,:id_type_vaccin,:date_next_vaccin,:date_created,:id_patient,:id_nurse,:date_vaccin)";


        $sql = $db->prepare($query);
        //    Bind parameters to statement
        $sql->bindParam(':ref_vac', $ref_vac);
        $sql->bindParam(':id_medecin', $id_medecin);
        $sql->bindParam(':id_type_vaccin', $id_type_vaccin);
        $sql->bindParam(':date_next_vaccin', $date_next_vaccin);
        $sql->bindParam(':date_created', $date_created);
        $sql->bindParam(':id_patient', $id_patient);
        $sql->bindParam(':id_nurse', $id_nurse);
        $sql->bindParam(':date_vaccin', $date_vaccin);
        $sql->execute();


        $query  = "SELECT prix_vaccin from type_vaccin where id_type_vaccin='$id_type_vaccin'";
        $q = $conn->query($query);
        while($row = $q->fetch_assoc())
        {
            $somme = $row["prix_vaccin"];
        }

        //ref de hosp
        $query1 = " UPDATE vaccination SET  ref_vac=:ref_vac    
        WHERE id_vac= '$id_app' ";
        $sql1 = $db->prepare($query1);

        // Bind parameters to statement
        $sql1->bindParam(':ref_vac', $ref_vac);
        $sql1->execute();

        $sql = "INSERT INTO regler_vac (ref_reg_vac,id_vac,id_patient,somme,date_reg_vac,id_type_vaccin,id_medecin,id_nurse)
                                  VALUES (?,?,?,?,?,?,?,?)";
        $req = $db->prepare($sql);
        $req->execute(array($ref_vac,$id_app,$id_patient,$somme,$date_vaccin,$id_type_vaccin,$id_medecin,$id_nurse));

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
