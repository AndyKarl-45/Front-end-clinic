<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {


    $partie = $_POST['partie'];
    $id_patient = $_POST['id_patient'];
    $date_autre = date('Y-m-d');

    $year = (new DateTime())->format("Y");
    $month = (new DateTime())->format("m");
    $day = (new DateTime())->format("d");
    $link = "liste_autres_services_suite_review.php";

    if ($partie == 1) {
        $id_medecin = $_POST['id_medecin'];
        $id_nurse = $_POST['id_nurse'];

        if (isset($_POST['id_autre_service'])) {
            $id_autre_service = $_POST['id_autre_service'];
            // $date_exam=$_POST['date_exam'];
        } else {
            //echo 'fooog';
            $id_autre_service[0] = 0;
        }
        $obs = $_POST['obs'];
        $id = count($id_autre_service);

        $execute = 0;
        $total_somme = 0;
        if ($id != 0) {
            $count = array();
            for ($j = 0; $j < $id; $j++) {
                $k = 0;


                if ($id_autre_service[$j] != 0) {
                    $sum_quant = 0;
                    //compter le nombre d'occurrence d'une type d'examen
                    for ($i = 0; $i < $id; $i++) {
                        if ($id_autre_service[$j] == $id_autre_service[$i]) {
                            $sum_quant += 1;
                            $count[$i] = $id_autre_service[$i];
                        }
                    }
                    //fin


                    if ($execute == 0) {
                        $query = " INSERT INTO autre (id_patient,id_medecin,date_autre,obs,id_nurse) 
                     VALUES (:id_patient,:id_medecin,:date_autre,:obs,:id_nurse)";

                        $sql = $db->prepare($query);
                        // Bind parameters to statement
                        // $sql->bindParam(':ref_exa', $ref_exa);
                        $sql->bindParam(':id_patient', $id_patient);
                        $sql->bindParam(':id_medecin', $id_medecin);
                        $sql->bindParam(':date_autre', $date_autre);
                        $sql->bindParam(':obs', $obs);
                        $sql->bindParam(':id_nurse', $id_nurse);
                        $sql->execute();
                        $execute++;
                    }

                    $query  = "SELECT max(id_autre) as total from autre";
                    $q = $conn->query($query);
                    while ($row = $q->fetch_assoc()) {
                        $total_apt = $row["total"];
                    }
                    $id_app = $total_apt;
                    $ref_autre = 'AUTRE_' . $year . '_' . $month . '_' . $id_patient . '_' . $id_app;

                    //ref de l'exam
                    $query1 = " UPDATE autre SET  ref_autre=:ref_autre    
                        WHERE id_autre= '$id_app' ";
                    $sql1 = $db->prepare($query1);

                    // Bind parameters to statement
                    $sql1->bindParam(':ref_autre', $ref_autre);
                    $sql1->execute();


                    $amount = 0;
                    $query  = "SELECT prix_autre_service from autres_services where id_autre_service='$id_autre_service[$j]'";
                    $q = $conn->query($query);
                    while ($row = $q->fetch_assoc()) {
                        $somme = $row["prix_autre_service"];
                        $amount = $row["prix_autre_service"];
                    }
                    $total_somme += $somme;

                    $query = " INSERT INTO autre_exa (ref_autre_exa,id_autre,id_patient,id_medecin,id_autre_service,date_autre,qte_autre_exa,amount,id_nurse) 
                     VALUES (:ref_autre,:id_autre,:id_patient,:id_medecin,:id_autre_service,:date_autre,:qte,:amount,:id_nurse)";

                    $sql = $db->prepare($query);
                    // Bind parameters to statement
                    $sql->bindParam(':ref_autre', $ref_autre);
                    $sql->bindParam(':id_autre', $id_app);
                    $sql->bindParam(':id_patient', $id_patient);
                    $sql->bindParam(':id_medecin', $id_medecin);
                    $sql->bindParam(':id_autre_service', $id_autre_service[$j]);
                    $sql->bindParam(':date_autre', $date_autre);
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
        $sql = "INSERT INTO regler_autre (ref_reg_autre,id_autre,id_patient,somme,date_reg_autre,id_medecin,id_nurse)
                                  VALUES (?,?,?,?,?,?,?)";
        $req = $db->prepare($sql);
        $req->execute(array($ref_autre, $id_app, $id_patient, $total_somme, $date_autre, $id_medecin, $id_nurse));
    } else {

        $id_lab = $_POST['id_laboratin'];
        $obs_exa = $_POST['obs_exa'];
        $date_exa_lab = date('Y-m-d');

        $query = " INSERT INTO examen (id_lab,id_patient,obs_exa) 
                     VALUES (:id_lab,:id_patient,:obs_exa)";

        $sql = $db->prepare($query);
        // Bind parameters to statement
        // $sql->bindParam(':ref_exa', $ref_exa);
        $sql->bindParam(':id_lab', $id_lab);
        $sql->bindParam(':id_patient', $id_patient);
        $sql->bindParam(':obs_exa', $obs_exa);
        $sql->execute();


        $query  = "SELECT max(id_exa) as total from examen";
        $q = $conn->query($query);
        while ($row = $q->fetch_assoc()) {
            $total_apt = $row["total"];
        }
        $id_app = $total_apt;
        $ref_exa = 'EXAM_' . $year . '_' . $month . '_' . $id_patient . '_' . $id_app;

        //ref de l'exam
        $query1 = " UPDATE examen SET  ref_exa=:ref_exa, date_exa_lab=:date_exa_lab WHERE id_exa= '$id_app' ";
        $sql1 = $db->prepare($query1);

        // Bind parameters to statement
        $sql1->bindParam(':ref_exa', $ref_exa);
        $sql1->bindParam(':date_exa_lab', $date_exa_lab);
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