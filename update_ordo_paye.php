<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {
    $ref_ordo = $_POST['ref_ordo'];
    $id_reg_ordo = $_POST['id_reg_ordo'];
    $id_perso_session = $_POST['id_perso_session'];
    $payer = $_POST['montant_verse'];
    $somme = $_POST['montant_total'];
    $remise = $_POST['remise'];
    $paie = $_POST['paie'];
    $link_fail = 'liste_ordonnance_suite_review.php';
    $link_success = 'liste_ordonance_checker.php';



    //    if(isset($_POST['id_medi_ordo'])){
    //        $id_medi_ordo=$_POST['id_medi_ordo'];
    //    }else{
    //        $id_medi_ordo[0]=0;
    //    }
    /*--------------------------------- ETAT INFOS RH -------------------------------------*/
    $payer_sum = 0;
    $remise_sum = 0;
    $cnt = 0;
    $cnt_pers = 0;
    $query  = "SELECT * from regler_ordo where id_reg_ordo='$id_reg_ordo' and ref_ordo='$ref_ordo' and payer!=0";
    $q = $conn->query($query);
    while ($row = $q->fetch_assoc()) {
        $payer_init = $row["payer"];
        $remise_init = $row["remise"];
        $id_patient = $row["id_patient"];

        $cnt += 1;
    }
    if ($lvl == 4 || $lvl == 7 || $lvl == 11) {
        $id_caisse = $_POST['id_caisse'];

        $sql = "SELECT * FROM caisse where id_caisse='$id_caisse' and open_close!=1 ";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tables as $table) {
            $cnt_pers += 1;
        }

        $sql = "SELECT * FROM caisse where id_caisse='$id_caisse' and open_close!=1 ";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tables as $table) {
            $solde_src = $table['solde'];
            $id_caisse = $table['id_caisse'];
        }
    } else {
        $sql = "SELECT * FROM caisse where id_perso='$id_perso_session' and open_close!=1 ";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tables as $table) {
            $cnt_pers += 1;
        }


        $sql = "SELECT * FROM caisse where id_perso='$id_perso_session' and open_close!=1 ";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tables as $table) {
            $solde_src = $table['solde'];
            $id_caisse = $table['id_caisse'];
        }
    }
    if ($cnt_pers == 1) {
        echo $cnt;

        if ($cnt == 0) {
            if ($somme - ($payer + $remise) >= 0) {
                echo $total_som = $payer + $remise;

                if ($paie == '01010') {

                    if ($somme - ($payer + $remise) != 0) {
                        $sql = "SELECT montant from caution where id_patient = '$id_patient' ";

                        $stmt = $db->prepare($sql);
                        $stmt->execute();


                        // Vérifiez si des résultats ont été trouvés
                        if ($table = $stmt->fetch(PDO::FETCH_ASSOC)) {

                            $montant_caution = $table['montant'];
                        } else {
                            $montant_caution = 0; // Aucun montant de caution trouvé
                        }

                        $montant_caution_reste = $montant_caution - $somme;

                        if ($montant_caution_reste >= 0) {
                            $query1 = "UPDATE caution SET  montant=:montant
                    WHERE id_patient = '$id_patient'";

                            $sql1 = $db->prepare($query1);

                            // Bind parameters to statement
                            $sql1->bindParam(':montant', $montant_caution_reste);
                            $sql1->execute();

                            $total_som = $somme;
                        } else {

                            $total_som = $payer + $remise + $montant_caution;
                            $montant_caution_reste = 0;

                            $query1 = "UPDATE caution SET  montant=:montant
                    WHERE id_patient = '$id_patient'";

                            $sql1 = $db->prepare($query1);

                            // Bind parameters to statement
                            $sql1->bindParam(':montant', $montant_caution_reste);
                            $sql1->execute();

                            $total_som = $somme;
                        }
                    }
                }





                //                $id = count($id_medi_ordo]);
                //                for ($j = 0; $j < $id; $j++) {
                //
                //                }


                $iResult = $db->query("SELECT * from medicament_ordo where ref_medi_ordo='$ref_ordo' ");

                while ($row = $iResult->fetch()) {
                    $id_medi  = $row["id_medi"];
                    $sum_quant = $row["quantite_medi_ordo"];
                    $id_num_lot = $row["id_num_lot"];
                    $amount = $row["amount"];

                    $query  = "SELECT quantite from pharmacie where id_medi='$id_medi' and id_num_lot='$id_num_lot' ";
                    $q = $conn->query($query);
                    while ($row = $q->fetch_assoc()) {
                        $medoc_phar = $row["quantite"];
                    }
                    // vérifie en stock dans la pharmacie
                    if ($medoc_phar == 0) {
?>
                        <script>
                            //alert('Consulattion a été bien mis à jour.');
                            window.location.href = '<?= $link_fail ?>?witness=-2';
                        </script>
                    <?php
                    }



                    $qt_totals = $medoc_phar - $sum_quant;

                    $query1 = "UPDATE pharmacie SET quantite=:quantite where id_medi='$id_medi' and id_num_lot='$id_num_lot'";

                    $sql = $db->prepare($query1);

                    // Bind parameters to statement
                    $sql->bindParam(':quantite', $qt_totals);
                    $sql->execute();

                    if ($total_som - $amount >= 0) {

                        $total_som = $total_som - $amount;

                        $query1 = "UPDATE medicament_ordo SET  payer=:payer
                    WHERE ref_medi_ordo = '$ref_ordo'and id_medi='$id_medi'";

                        $sql1 = $db->prepare($query1);

                        // Bind parameters to statement
                        $sql1->bindParam(':payer', $amount);
                        $sql1->execute();
                    } else {
                        $query1 = "UPDATE medicament_ordo SET  payer=:payer
                    WHERE ref_medi_ordo = '$ref_ordo'and id_medi='$id_medi'";

                        $sql1 = $db->prepare($query1);

                        // Bind parameters to statement
                        $sql1->bindParam(':payer', $total_som);
                        $sql1->execute();
                    }
                }


                $date_reg_paie = date('Y-m-d');
                $query1 = "UPDATE regler_ordo SET  payer=:payer, id_perso=:id_perso, id_caisse=:id_caisse, remise=:remise, id_caisse=:id_caisse,id_paie=:id_paie,date_reg_paie=:date_reg_paie
                    WHERE ref_ordo = '$ref_ordo'and id_reg_ordo='$id_reg_ordo'";


                $sql1 = $db->prepare($query1);

                // Bind parameters to statement
                $sql1->bindParam(':payer', $payer);
                $sql1->bindParam(':id_perso', $id_perso_session);
                $sql1->bindParam(':id_caisse', $id_caisse);
                $sql1->bindParam(':remise', $remise);
                $sql1->bindParam(':id_paie', $paie);
                $sql1->bindParam(':date_reg_paie', $date_reg_paie);
                $sql1->execute();


                $query  = "SELECT * from regler_ordo where id_reg_ordo='$id_reg_ordo' and ref_ordo='$ref_ordo' and payer!=0";
                $q = $conn->query($query);
                while ($row = $q->fetch_assoc()) {
                    $id_patient = $row["id_patient"];
                }




                $quantite_final_src = $solde_src + $payer;
                $query1 = "UPDATE caisse SET  solde=:payer
                    WHERE  id_caisse='$id_caisse'";


                $sql1 = $db->prepare($query1);

                // Bind parameters to statement
                $sql1->bindParam(':payer', $quantite_final_src);
                $sql1->execute();

                $ref_caisse = 'N/A';
                $id_beneficiaire = $id_caisse;
                $id_perso = $id_perso_session;
                $somme = $payer;
                $date_hist = date('Y-m-d');
                $statut = 'E';
                $type_beni = 'P';
                $service = 4;

                $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_entre,date_hist,statut,type_beni,id_perso,service,id_mode_paie)
                      VALUES (?,?,?,?,?,?,?,?,?,?)";
                $req = $db->prepare($sql);
                $req->execute(array($id_caisse, $ref_caisse, $id_patient, $somme, $date_hist, $statut, $type_beni, $id_perso, $service, $paie));


                if ($sql1) {
                    ?>
                    <script>
                        //alert('Consulattion a été bien mis à jour.');
                        window.location.href = '<?= $link_success ?>?witness=1';
                    </script>
                <?php
                } else {
                ?>
                    <script>
                        //   alert('client n\'a pas été mis à jour.');
                        window.location.href = '<?= $link_fail ?>?witness=-1';
                    </script>
                <?php

                }
            } else {
                ?>
                <script>
                    //  alert('client n\'a pas été mis à jour.');
                    window.location.href = '<?= $link_fail ?>?witness=-1';
                </script>
                <?php

            }
        } else {

            $payer = $somme;
            echo $total_som = $payer + $remise;

            $iResult = $db->query("SELECT * from medicament_ordo where ref_medi_ordo='$ref_ordo' ");

            while ($row = $iResult->fetch()) {
                $id_medi  = $row["id_medi"];
                $sum_quant = $row["quantite_medi_ordo"];
                $id_num_lot = $row["id_num_lot"];
                $amount = $row["amount"];

                $query  = "SELECT quantite from pharmacie where id_medi='$id_medi' and id_num_lot='$id_num_lot' ";
                $q = $conn->query($query);
                while ($row = $q->fetch_assoc()) {
                    $medoc_phar = $row["quantite"];
                }

                if ($medoc_phar == 0) {
                ?>
                    <script>
                        //alert('Consulattion a été bien mis à jour.');
                        window.location.href = '<?= $link_fail ?>?witness=-2';
                    </script>
                <?php
                }



                $qt_totals = $medoc_phar - $sum_quant;

                $query1 = "UPDATE pharmacie SET quantite=:quantite where id_medi='$id_medi' and id_num_lot='$id_num_lot'";

                $sql = $db->prepare($query1);

                // Bind parameters to statement
                $sql->bindParam(':quantite', $qt_totals);
                $sql->execute();

                if ($total_som - $amount >= 0) {

                    $total_som = $total_som - $amount;

                    $query1 = "UPDATE medicament_ordo SET  payer=:payer
                    WHERE ref_medi_ordo = '$ref_ordo'and id_medi='$id_medi'";

                    $sql1 = $db->prepare($query1);

                    // Bind parameters to statement
                    $sql1->bindParam(':payer', $amount);
                    $sql1->execute();
                } else {
                    $query1 = "UPDATE medicament_ordo SET  payer=:payer
                    WHERE ref_medi_ordo = '$ref_ordo'and id_medi='$id_medi'";

                    $sql1 = $db->prepare($query1);

                    // Bind parameters to statement
                    $sql1->bindParam(':payer', $total_som);
                    $sql1->execute();
                }
            }


            $payer_sum = $payer_init + $payer;
            $remise_sum = $remise_init + $remise;

            if ($somme - ($payer_sum + $remise_sum) >= 0) {

                $date_reg_paie = date('Y-m-d');
                $query1 = "UPDATE regler_ordo SET  payer=:payer,  id_perso=:id_perso, id_caisse=:id_caisse, remise=:remise, id_caisse=:id_caisse,date_reg_paie=:date_reg_paie
                    WHERE ref_ordo = '$ref_ordo'and id_reg_ordo='$id_reg_ordo'";


                $sql1 = $db->prepare($query1);

                // Bind parameters to statement
                $sql1->bindParam(':payer', $payer_sum);
                $sql1->bindParam(':id_perso', $id_perso_session);
                $sql1->bindParam(':id_caisse', $id_caisse);
                $sql1->bindParam(':remise', $remise_sum);
                $sql1->bindParam(':id_caisse', $id_caisse);
                $sql1->bindParam(':date_reg_paie', $date_reg_paie);
                $sql1->execute();

                $quantite_final_src = $solde_src + $payer;
                $query1 = "UPDATE caisse SET  solde=:payer
                    WHERE  id_caisse='$id_caisse'";


                $sql1 = $db->prepare($query1);

                // Bind parameters to statement
                $sql1->bindParam(':payer', $quantite_final_src);
                $sql1->execute();

                $ref_caisse = 'N/A';
                $id_beneficiaire = $id_caisse;
                $id_perso = $id_perso_session;
                $somme = $payer;
                $date_hist = date('Y-m-d');
                $statut = 'E';
                $type_beni = 'P';
                $service = 4;

                $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_entre,date_hist,statut,type_beni,id_perso,service)
                      VALUES (?,?,?,?,?,?,?,?,?)";
                $req = $db->prepare($sql);
                $req->execute(array($id_caisse, $ref_caisse, $id_patient, $somme, $date_hist, $statut, $type_beni, $id_perso, $service));


                $sql1 = $db->prepare($query1);

                // Bind parameters to statement
                $sql1->bindParam(':payer', $quantite_final_src);
                $sql1->execute();


                if ($sql1) {
                ?>
                    <script>
                        //alert('Consulattion a été bien mis à jour.');
                        window.location.href = '<?= $link_success ?>?witness=1';
                    </script>
                <?php
                } else {
                ?>
                    <script>
                        //   alert('client n\'a pas été mis à jour.');
                        window.location.href = '<?= $link_fail ?>?witness=-1';
                    </script>
                <?php

                }
            } else {

                $date_reg_paie = date('Y-m-d');
                $query1 = "UPDATE regler_ordo SET  payer=:payer,  id_perso=:id_perso, id_caisse=:id_caisse, remise=:remise, id_caisse=:id_caisse,date_reg_paie=:date_reg_paie
                    WHERE ref_ordo = '$ref_ordo'and id_reg_ordo='$id_reg_ordo'";


                $sql1 = $db->prepare($query1);

                // Bind parameters to statement
                $sql1->bindParam(':payer', $payer_sum);
                $sql1->bindParam(':id_perso', $id_perso_session);
                $sql1->bindParam(':id_caisse', $id_caisse);
                $sql1->bindParam(':remise', $remise_sum);
                $sql1->bindParam(':id_caisse', $id_caisse);
                $sql1->bindParam(':date_reg_paie', $date_reg_paie);
                $sql1->execute();

                $quantite_final_src = $solde_src + $payer;
                $query1 = "UPDATE caisse SET  solde=:payer
                    WHERE  id_caisse='$id_caisse'";


                $sql1 = $db->prepare($query1);

                // Bind parameters to statement
                $sql1->bindParam(':payer', $quantite_final_src);
                $sql1->execute();

                $ref_caisse = 'N/A';
                $id_beneficiaire = $id_caisse;
                $id_perso = $id_perso_session;
                $somme = $payer;
                $date_hist = date('Y-m-d');
                $statut = 'E';
                $type_beni = 'P';
                $service = 4;

                $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_entre,date_hist,statut,type_beni,id_perso,service)
                      VALUES (?,?,?,?,?,?,?,?,?)";
                $req = $db->prepare($sql);
                $req->execute(array($id_caisse, $ref_caisse, $id_patient, $somme, $date_hist, $statut, $type_beni, $id_perso, $service));


                $sql1 = $db->prepare($query1);

                // Bind parameters to statement
                $sql1->bindParam(':payer', $quantite_final_src);
                $sql1->execute();


                if ($sql1) {
                ?>
                    <script>
                        //alert('Consulattion a été bien mis à jour.');
                        window.location.href = '<?= $link_success ?>?witness=1';
                    </script>
                <?php
                } else {
                ?>
                    <script>
                        //   alert('client n\'a pas été mis à jour.');
                        window.location.href = '<?= $link_fail ?>?witness=-1';
                    </script>
        <?php

                }
            }
        }
    } else {
        ?>
        <script>
            alert('Vous n\'avez pas de caisse.');
            window.location.href = '<?= $link_fail ?>?witness=-1';
        </script>
<?php
    }
}
?>