<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {


    $partie = $_POST['partie'];
    $id_patient = $_POST['id_patient'];
    $date_exa = date('Y-m-d');

    $year = (new DateTime())->format("Y");
    $month = (new DateTime())->format("m");
    $day = (new DateTime())->format("d");
    $link = "liste_examen_suite_review.php";


    if ($partie == 1) {
        $id_medecin = $_POST['id_medecin'];
        $id_nurse = $_POST['id_nurse'];


        if (isset($_POST['id_type_exa'])) {
            $id_type_exa = $_POST['id_type_exa'];
            // $date_exam=$_POST['date_exam'];
        } else {
            //echo 'fooog';
            $id_type_exa[0] = 0;
        }
        $obs = $_POST['obs'];
        $id = count($id_type_exa);

        $execute = 0;
        $total_somme = 0;
        if ($id != 0) {
            $count = array();
            for ($j = 0; $j < $id; $j++) {
                $k = 0;


                if ($id_type_exa[$j] != 0) {
                    $sum_quant = 0;
                    //compter le nombre d'occurrence d'une type d'examen
                    for ($i = 0; $i < $id; $i++) {
                        if ($id_type_exa[$j] == $id_type_exa[$i]) {
                            $sum_quant += 1;
                            $count[$i] = $id_type_exa[$i];
                        }
                    }
                    //fin


                    if ($execute == 0) {
                        $query = " INSERT INTO examen (id_patient,id_medecin,date_exa,obs,id_nurse) 
                     VALUES (:id_patient,:id_medecin,:date_exa,:obs,:id_nurse)";

                        $sql = $db->prepare($query);
                        // Bind parameters to statement
                        // $sql->bindParam(':ref_exa', $ref_exa);
                        $sql->bindParam(':id_patient', $id_patient);
                        $sql->bindParam(':id_medecin', $id_medecin);
                        $sql->bindParam(':date_exa', $date_exa);
                        $sql->bindParam(':obs', $obs);
                        $sql->bindParam(':id_nurse', $id_nurse);
                        $sql->execute();
                        $execute++;
                    }

                    $query  = "SELECT max(id_exa) as total from examen";
                    $q = $conn->query($query);
                    while ($row = $q->fetch_assoc()) {
                        $total_apt = $row["total"];
                    }
                    $id_app = $total_apt;
                    $ref_exa = 'EXAM_' . $year . '_' . $month . '_' . $id_patient . '_' . $id_app;

                    //ref de l'exam
                    $query1 = " UPDATE examen SET  ref_exa=:ref_exa    
                        WHERE id_exa= '$id_app' ";
                    $sql1 = $db->prepare($query1);

                    // Bind parameters to statement
                    $sql1->bindParam(':ref_exa', $ref_exa);
                    $sql1->execute();


                    $amount = 0;
                    $query  = "SELECT prix_t_exa from type_exa where id_type_exa='$id_type_exa[$j]'";
                    $q = $conn->query($query);
                    while ($row = $q->fetch_assoc()) {
                        $somme = $row["prix_t_exa"];
                        $amount = $row["prix_t_exa"];
                    }
                    $total_somme += $somme;

                    $query = " INSERT INTO examen_exa (ref_exam_exa,id_exa,id_patient,id_medecin,id_type_exa,date_exam,qte_exam_exa,amount,id_nurse) 
                     VALUES (:ref_exa,:id_exa,:id_patient,:id_medecin,:id_type_exa,:date_exam,:qte,:amount,:id_nurse)";

                    $sql = $db->prepare($query);
                    // Bind parameters to statement
                    $sql->bindParam(':ref_exa', $ref_exa);
                    $sql->bindParam(':id_exa', $id_app);
                    $sql->bindParam(':id_patient', $id_patient);
                    $sql->bindParam(':id_medecin', $id_medecin);
                    $sql->bindParam(':id_type_exa', $id_type_exa[$j]);
                    $sql->bindParam(':date_exam', $date_exa);
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
        $sql = "INSERT INTO regler_examen (ref_reg_exa,id_exa,id_patient,somme,date_reg_exa,id_medecin,id_nurse)
                                  VALUES (?,?,?,?,?,?,?)";
        $req = $db->prepare($sql);
        $req->execute(array($ref_exa, $id_app, $id_patient, $total_somme, $date_exa, $id_medecin, $id_nurse));
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
            // window.location.href = '<?= $examen['option2_link'] ?>?witness=1';
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