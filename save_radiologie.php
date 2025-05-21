<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {


    $partie = $_POST['partie'];
    $id_patient = $_POST['id_patient'];
    $date_rad = date('Y-m-d');

    $year = (new DateTime())->format("Y");
    $month = (new DateTime())->format("m");
    $day = (new DateTime())->format("d");
    $link = "liste_radiologie_checker_review.php";


    if ($partie == 1) {
        $id_medecin = $_POST['id_medecin'];
        $id_nurse = $_POST['id_nurse'];

        if (isset($_POST['id_type_radiologie'])) {
            $id_type_radiologie = $_POST['id_type_radiologie'];
        } else {
            //echo 'fooog';
            $id_type_radiologie[0] = 0;
        }
        $obs = $_POST['obs'];
        $id = count($id_type_radiologie);

        $execute = 0;
        $total_somme = 0;
        if ($id != 0) {
            $count = array();
            for ($j = 0; $j < $id; $j++) {
                $k = 0;


                if ($id_type_radiologie[$j] != 0) {
                    $sum_quant = 0;
                    //compter le nombre d'occurrence d'une type d'une radiologie
                    for ($i = 0; $i < $id; $i++) {
                        if ($id_type_radiologie[$j] == $id_type_radiologie[$i]) {
                            $sum_quant += 1;
                            $count[$i] = $id_type_radiologie[$i];
                        }
                    }
                    //fin


                    if ($execute == 0) {
                        $query = " INSERT INTO radiologie (id_patient,id_medecin,date_radiologie,obs,id_nurse) 
                     VALUES (:id_patient,:id_medecin,:date_radiologie,:obs,:id_nurse)";

                        $sql = $db->prepare($query);
                        // Bind parameters to statement
                        // $sql->bindParam(':ref_exa', $ref_exa);
                        $sql->bindParam(':id_patient', $id_patient);
                        $sql->bindParam(':id_medecin', $id_medecin);
                        $sql->bindParam(':date_radiologie', $date_rad);
                        $sql->bindParam(':obs', $obs);
                        $sql->bindParam(':id_nurse', $id_nurse);
                        $sql->execute();
                        $execute++;
                    }

                    $query  = "SELECT max(id_radiologie) as total from radiologie";
                    $q = $conn->query($query);
                    while ($row = $q->fetch_assoc()) {
                        $total_apt = $row["total"];
                    }
                    $id_app = $total_apt;
                    $ref_radiologie = 'RAD_' . $year . '_' . $month . '_' . $id_patient . '_' . $id_app;

                    //ref de l'exam
                    $query1 = " UPDATE radiologie SET  ref_radiologie=:ref_radiologie
                        WHERE id_radiologie= '$id_app' ";
                    $sql1 = $db->prepare($query1);

                    // Bind parameters to statement
                    $sql1->bindParam(':ref_radiologie', $ref_radiologie);
                    $sql1->execute();


                    $amount = 0;
                    $query  = "SELECT prix_t_radiologie from type_radiologie where id_type_radiologie='$id_type_radiologie[$j]'";
                    $q = $conn->query($query);
                    while ($row = $q->fetch_assoc()) {
                        $amount = $row["prix_t_radiologie"];
                    }
                    $total_somme += $amount;

                    $query = " INSERT INTO radiologie_exa (ref_radiologie_exa,id_radiologie,id_patient,id_medecin,id_type_radiologie,date_radiologie,qte_radiologie_exa,amount,id_nurse) 
                     VALUES (:ref_radiologie,:id_radiologie,:id_patient,:id_medecin,:id_type_radiologie,:date_radiologie,:qte,:amount,:id_nurse)";

                    $sql = $db->prepare($query);
                    // Bind parameters to statement
                    $sql->bindParam(':ref_radiologie', $ref_radiologie);
                    $sql->bindParam(':id_radiologie', $id_app);
                    $sql->bindParam(':id_patient', $id_patient);
                    $sql->bindParam(':id_medecin', $id_medecin);
                    $sql->bindParam(':id_type_radiologie', $id_type_radiologie[$j]);
                    $sql->bindParam(':date_radiologie', $date_rad);
                    $sql->bindParam(':qte', $sum_quant);
                    $sql->bindParam(':amount', $amount);
                    $sql->bindParam(':id_nurse', $id_nurse);
                    $sql->execute();
                }
            }
        }

        //        $query  = "SELECT prix_t_exa from type_exa where id_type_exa='$id_type_exa'";
        //        $q = $conn->query($query);
        //        while($row = $q->fetch_assoc())
        //        {
        //            $somme = $row["prix_t_exa"];
        //        }
        //
        //
        //        $query = " INSERT INTO examen (ref_exa,id_patient,id_medecin,id_type_exa,date_exa,obs)
        //                     VALUES (:ref_exa,:id_patient,:id_medecin,:id_type_exa,:date_exa,:obs)";
        //
        //        $sql = $db->prepare($query);
        //        // Bind parameters to statement
        //        $sql->bindParam(':ref_exa', $ref_exa);
        //        $sql->bindParam(':id_patient', $id_patient);
        //        $sql->bindParam(':id_medecin', $id_medecin);
        //        $sql->bindParam(':id_type_exa', $id_type_exa);
        //        $sql->bindParam(':date_exa', $date_exa);
        //        $sql->bindParam(':obs', $obs);
        //        $sql->execute();
        //
        //
        //
        $sql = "INSERT INTO regler_radiologie (ref_reg_radiologie,id_radiologie,id_patient,somme,date_reg_radiologie,id_medecin,id_nurse)
                                  VALUES (?,?,?,?,?,?,?)";
        $req = $db->prepare($sql);
        $req->execute(array($ref_radiologie, $id_app, $id_patient, $total_somme, $date_rad, $id_medecin, $id_nurse));
    } else {

        $id_radiologue = $_POST['id_radiologue'];
        $obs_radiologue = $_POST['obs_radiologue'];

        $query = " INSERT INTO radiologie (id_radiologie,id_patient,obs_radiologie) 
                     VALUES (:id_radiologie,:id_patient,:obs_radiologie)";

        $sql = $db->prepare($query);
        // Bind parameters to statement
        // $sql->bindParam(':ref_exa', $ref_exa);
        $sql->bindParam(':id_radiologie', $id_radiologie);
        $sql->bindParam(':id_patient', $id_patient);
        $sql->bindParam(':obs_radiologie', $obs_radiologie);
        $sql->execute();


        $query  = "SELECT max(id_radiologie) as total from radiologie";
        $q = $conn->query($query);
        while ($row = $q->fetch_assoc()) {
            $total_apt = $row["total"];
        }
        $id_app = $total_apt;
        $ref_exa = 'RAD_' . $year . '_' . $month . '_' . $id_patient . '_' . $id_app;

        //ref de l'exam
        $query1 = " UPDATE radiologie SET  ref_radiologie=:ref_radiologie    
            WHERE id_radiologie= '$id_app' ";
        $sql1 = $db->prepare($query1);

        // Bind parameters to statement
        $sql1->bindParam(':ref_radiologie', $ref_radiologie);
        $sql1->execute();
    }



    // $open_close = 0;
    // echo $ref_client.'</br>';
    // echo $raison_social_client.'</br>';
    // echo $id_type_client.'</br>';
    // echo $ville_client.'</br>';
    // echo $email_client.'</br>';
    // echo $pers_contact_client.'</br>';
    // echo $tel_contact_client.'</br>';


    //--------------------------------- insertion un fournisseur -----------------------------------------//

    // $query = " INSERT INTO medecin (nom_m,prenom_m,user_m,email_m)
    //                  VALUES (:nom_m,:prenom_m,:user_m,:email_m)";





    if ($sql) {
?>
        <script>
            //alert('client a été bien enregistrée.');
            window.location.href = '<?= $link ?>?witness=1';
        </script>
    <?php
    } else {
    ?>
        <script>
            //alert('Error.');
            window.location.href = '<?= $link ?>?witness=-1';
        </script>
<?php

    }
}
?>