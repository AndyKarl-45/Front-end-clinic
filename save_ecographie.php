<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {


    $partie = $_POST['partie'];
    $id_patient = $_POST['id_patient'];
    $id_eco = $_POST['id_eco'];
    $ref_eco = $_POST['ref_eco'];
    $date_eco = date('Y-m-d');
    $link = "liste_ecographie_checker_review.php";

    //    $year = (new DateTime())->format("Y");
    //    $month = (new DateTime())->format("m");
    //    $day = (new DateTime())->format("d");
    //    $query  = "SELECT max(id_exa) as total from examen";
    //    $q = $conn->query($query);
    //    while($row = $q->fetch_assoc())
    //    {
    //        $total_apt = $row["total"];
    //    }
    //    $id_app = $total_apt + 1;
    //    $ref_exa= 'EXAM_'.$year.'_'.$month.'_'.$id_patient.'_'.$id_app;

    if ($partie == 1) {
        $id_medecin = $_POST['id_medecin1'];
        $id_nurse = $_POST['id_nurse'];
        $obs = $_POST['obs'];
        //$id_type_eco = $_POST['id_type_eco'];
        if (isset($_POST['id_type_eco'])) {
            $id_type_eco = $_POST['id_type_eco'];
            // $date_exam=$_POST['date_exam'];
        } else {
            //echo 'fooog';
            $id_type_eco[0] = 0;
        }

        //-----------------------
        $id = count($id_type_eco);
        //        echo($id);
        //        die;

        $execute = 0;
        $total_somme = 0;
        if ($id != 0) {
            $count = array();
            for ($j = 0; $j < $id; $j++) {
                $k = 0;


                if ($id_type_eco[$j] != 0) {
                    $sum_quant = 0;
                    //compter le nombre d'occurrence d'une type d'examen
                    for ($i = 0; $i < $id; $i++) {
                        if ($id_type_eco[$j] == $id_type_eco[$i]) {
                            $sum_quant += 1;
                            $count[$i] = $id_type_eco[$i];
                        }
                    }
                    //fin


                    if ($execute == 0) {

                        $query = " INSERT INTO ecographie (ref_eco,id_patient,id_medecin,date_eco,obs,id_nurse) 
                     VALUES (:ref_eco,:id_patient,:id_medecin,:date_eco,:obs,:id_nurse)";

                        $sql = $db->prepare($query);
                        // Bind parameters to statement
                        $sql->bindParam(':ref_eco', $ref_eco);
                        $sql->bindParam(':id_patient', $id_patient);
                        $sql->bindParam(':id_medecin', $id_medecin);
                        $sql->bindParam(':date_eco', $date_eco);
                        $sql->bindParam(':obs', $obs);
                        $sql->bindParam(':id_nurse', $id_nurse);
                        $sql->execute();
                        $execute++;
                    }


                    $amount = 0;
                    $query  = "SELECT prix_t_eco from type_eco where id_type_eco='$id_type_eco[$j]'";
                    $q = $conn->query($query);
                    while ($row = $q->fetch_assoc()) {
                        $somme = $row["prix_t_eco"];
                        $amount = $row["prix_t_eco"];
                    }
                    $total_somme += $somme;

                    $query = " INSERT INTO ecographie_exa (ref_eco_exa,id_eco,id_patient,id_medecin,id_type_eco,date_eco,qte_eco_exa,amount,id_nurse) 
                     VALUES (:ref_eco,:id_eco,:id_patient,:id_medecin,:id_type_eco,:date_eco,:qte,:amount,:id_nurse)";

                    $sql = $db->prepare($query);
                    // Bind parameters to statement
                    $sql->bindParam(':ref_eco', $ref_eco);
                    $sql->bindParam(':id_eco', $id_eco);
                    $sql->bindParam(':id_patient', $id_patient);
                    $sql->bindParam(':id_medecin', $id_medecin);
                    $sql->bindParam(':id_type_eco', $id_type_eco[$j]);
                    $sql->bindParam(':date_eco', $date_eco);
                    $sql->bindParam(':qte', $sum_quant);
                    $sql->bindParam(':amount', $amount);
                    $sql->bindParam(':id_nurse', $id_nurse);
                    $sql->execute();
                }
            }
        }
        //----------------------


        //        $date_eco = $_POST['date_eco'];
        //        $obs = $_POST['obs'];
        //
        //        $query  = "SELECT prix_t_eco from type_eco where id_type_eco='$id_type_eco'";
        //        $q = $conn->query($query);
        //        while($row = $q->fetch_assoc())
        //        {
        //            $somme = $row["prix_t_eco"];
        //        }






        $sql = "INSERT INTO regler_ecographie (ref_reg_eco,id_eco,id_patient,somme,date_reg_eco,id_medecin,id_nurse)
                                  VALUES (?,?,?,?,?,?,?)";
        $req = $db->prepare($sql);
        $req->execute(array($ref_eco, $id_eco, $id_patient, $total_somme, $date_eco, $id_medecin, $id_nurse));
    } else {

        $id_medecin = $_POST['id_medecin2'];
        $obs_eco = $_POST['obs_eco'];

        $query = " INSERT INTO ecographie (ref_eco,id_medecin2,id_patient,obs_eco) 
                     VALUES (:ref_eco,:id_lab,:id_patient,:obs_eco)";

        $sql = $db->prepare($query);
        // Bind parameters to statement
        $sql->bindParam(':ref_eco', $ref_eco);
        $sql->bindParam(':id_lab', $id_medecin);
        $sql->bindParam(':id_patient', $id_patient);
        $sql->bindParam(':obs_eco', $obs_eco);
        $sql->execute();
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