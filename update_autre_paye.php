<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")

?>

<?php

if ($_POST) {
    $id_autre = $_POST['id_autre'];
    $id_reg_autre = $_POST['id_reg_autre'];
    $id_perso_session = $_POST['id_perso_session'];
    $payer = $_POST['montant_verse'];
    $somme = $_POST['montant_total'];
    echo $paie = $_POST['paie'];
    $remise = $_POST['remise'];
    $link_fail = 'liste_autres_services_suite_review.php';
    $link_success = 'liste_autres_services_checker.php';


    if (isset($_POST['id_autre_service'])) {
        $id_autre_service = $_POST['id_autre_service'];
    } else {
        $id_autre_service[0] = 0;
?>
        <script>
            alert('Vous avez choisi aucun Service.');
            window.location.href = '<?= $link_fail ?>?witness=-1';
        </script>
    <?php

    }
    $id = count($id_autre_service);

    /*--------------------------------- ETAT INFOS RH -------------------------------------*/
    $payer_sum = 0;
    $remise_sum = 0;
    $cnt = 0;
    $cnt_pers = 0;
    $query  = "SELECT * from regler_autre where id_reg_autre='$id_reg_autre' and id_autre='$id_autre'";
    $q = $conn->query($query);
    while ($row = $q->fetch_assoc()) {
        $payer_init = $row["payer"];
        $remise_init = $row["remise"];
        $id_patient = $row["id_patient"];
        $cnt += 1;
    }

    // chec if reglement is ok
    if ($somme - ($payer_init + $remise_init) === 0) {
    ?>
        <script>
            //  alert('client n\'a pas été mis à jour.');
            window.location.href = '<?= $link_fail ?>?witness=-4';
        </script>
        <?php
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

    $query  = "SELECT * from mode_paie where nom like 'CAUTION' ";
    $q = $conn->query($query);
    while ($row = $q->fetch_assoc()) {
        $mode_caution = $row["id_mode_paie"];
    }

    if (empty($mode_caution)) {
        $mode_caution = 0;
    }

    $query  = "SELECT * from caution where id_patient ='$id_patient' ";
    $q = $conn->query($query);
    while ($row = $q->fetch_assoc()) {
        $montant_caution = $row["montant"];
    }

    if ($paie == '01010') {

        if ($montant_caution != 0) {
            $payer = $montant_caution;
        } else {
        ?>
            <script>
                //  alert('client n\'a pas été mis à jour.');
                window.location.href = '<?= $link_fail ?>?witness=-3';
            </script>
        <?php
        }
    }

    if ($cnt_pers == 1 and $paie != 0) {

        $payer_total = 0;
        $somme_total = 0;
        $versement = 0;
        foreach ($id_autre_service as $cle => $data_item) {
            // echo $cle .'=>'. $data_item;
            $query  = "SELECT * from autre_exa where  id_autre='$id_autre' and id_autre_service='$id_autre_service[$cle]'";
            $q = $conn->query($query);
            while ($row = $q->fetch_assoc()) {
                $payer_init_exa = $row["payer"];
                $somme_exa = $row["amount"];
            }
            $somme_total += $somme_exa;
            $remise_sum = $remise_init + $remise;

            if ($payer >= 0) {
                $payer_sum = $payer_init_exa + $payer;


                if ($somme_exa - $payer_sum > 0) {
                    $somme_exa = $payer_sum;
                    $payer_total += $payer_sum;
                    $payer = -1;
                    $etat = -1;

                    $query1 = "UPDATE autre_exa SET  etat=:etat
                            WHERE id_autre = '$id_autre' and id_autre_service='$id_autre_service[$cle]' ";

                    $sql1 = $db->prepare($query1);

                    // Bind parameters to statement
                    $sql1->bindParam(':etat', $etat);
                    $sql1->execute();
                } elseif ($somme_exa - $payer_sum <= 0) {
                    $payer -= $somme_exa;
                    $payer_total += $somme_exa;
                    $etat = 1;

                    $query1 = "UPDATE autre_exa SET  etat=:etat
                            WHERE id_autre = '$id_autre' and id_autre_service='$id_autre_service[$cle]' ";

                    $sql1 = $db->prepare($query1);

                    // Bind parameters to statement
                    $sql1->bindParam(':etat', $etat);
                    $sql1->execute();
                }

                $query1 = "UPDATE autre_exa SET  payer=:payer
                            WHERE id_autre = '$id_autre' and id_autre_service='$id_autre_service[$cle]' ";


                $sql1 = $db->prepare($query1);

                // Bind parameters to statement
                $sql1->bindParam(':payer', $somme_exa);
                $sql1->execute();
            }
        }


        $paye_reel = $payer_total - $remise_sum;
        $date_reg_paie = date('Y-m-d');

        $query1 = "UPDATE regler_autre SET  payer=:payer, remise=:remise, somme=:somme, id_paie=:id_paie,date_reg_paie=:date_reg_paie 
                WHERE id_autre = '$id_autre'and id_reg_autre='$id_reg_autre'";


        $sql1 = $db->prepare($query1);

        // Bind parameters to statement
        $sql1->bindParam(':payer', $paye_reel);
        $sql1->bindParam(':remise', $remise_sum);
        $sql1->bindParam(':id_paie', $paie);
        $sql1->bindParam(':somme', $somme_total);
        $sql1->bindParam(':date_reg_paie', $date_reg_paie);
        $sql1->execute();

        $etat = -1;
        $date_reg_paie = date('Y-m-d');
        $query1 = "UPDATE regler_autre SET  etat=:etat, date_reg_paie=:date_reg_paie
                WHERE  id_autre='$id_autre' and id_reg_autre='$id_reg_autre'";


        $sql1 = $db->prepare($query1);

        // Bind parameters to statement
        $sql1->bindParam(':etat', $etat);
        $sql1->bindParam(':date_reg_paie', $date_reg_paie);
        $sql1->execute();

        if ($somme_total - $payer_total == 0) {
            $etat = 1;
            $query1 = "UPDATE autre SET  etat=:etat
                WHERE  id_autre='$id_autre' ";


            $sql1 = $db->prepare($query1);

            // Bind parameters to statement
            $sql1->bindParam(':etat', $etat);
            $sql1->execute();

            $etat = 1;
            $date_reg_paie = date('Y-m-d');
            $query1 = "UPDATE regler_autre SET  etat=:etat, id_caisse=:id_caisse, date_reg_paie=:date_reg_paie
                WHERE  id_autre='$id_autre' and id_reg_autre='$id_reg_autre'";


            $sql1 = $db->prepare($query1);

            // Bind parameters to statement
            $sql1->bindParam(':etat', $etat);
            $sql1->bindParam(':id_caisse', $id_caisse);
            $sql1->bindParam(':date_reg_paie', $date_reg_paie);
            $sql1->execute();
        }

        if ($somme_total > $payer_total) {
            $versement = $payer;
        } else {
            $versement = $somme;
        }


        $quantite_final_src = $solde_src + $versement;
        $query1 = "UPDATE caisse SET  solde=:payer
                WHERE  id_caisse='$id_caisse'";


        $sql1 = $db->prepare($query1);

        // Bind parameters to statement
        $sql1->bindParam(':payer', $quantite_final_src);
        $sql1->execute();



        $ref_caisse = 'N/A';
        $id_beneficiaire = $id_caisse;
        $id_perso = $id_perso_session;
        $somme = $somme_exa;
        $date_hist = date('Y-m-d');
        $statut = 'E';
        $type_beni = 'P';
        $service = 9;

        $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_entre,date_hist,statut,type_beni,id_perso,service,id_mode_paie)
                      VALUES (?,?,?,?,?,?,?,?,?,?)";
        $req = $db->prepare($sql);
        $req->execute(array($id_caisse, $ref_caisse, $id_patient, $somme, $date_hist, $statut, $type_beni, $id_perso, $service, $paie));

        if ($paie == '01010') {

            if ($montant_caution - $somme_total >= 0)
                $reste_caution = ($montant_caution + $remise) - $somme_total;
            else
                $reste_caution = ($montant_caution + $remise) - $payer;


            $query1 = "UPDATE caution SET  montant=:payer
                    WHERE  id_patient='$id_patient'";


            $sql1 = $db->prepare($query1);

            // Bind parameters to statement
            $sql1->bindParam(':payer', $reste_caution);
            $sql1->execute();
        }

        if ($req) {
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
            // alert('Vous n\'avez pas de caisse ou un mode de règlement.');
            window.location.href = '<?= $link_fail ?>?witness=-2';
        </script>
<?php
    }
}
?>