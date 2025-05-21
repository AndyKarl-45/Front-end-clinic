<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")

?>

<?php

if ($_POST) {
    $id_eco = $_POST['id_eco'];
    $id_reg_eco = $_POST['id_reg_eco'];
    $id_perso_session = $_POST['id_perso_session'];
    $payer = $_POST['montant_verse'];
    $somme = $_POST['montant_total'];
    $remise = $_POST['remise'];
    $paie = $_POST['paie'];
    $link_fail = "liste_ecographie_checker_review.php";
    $link_success = "liste_ecographie_checker.php";

    if (isset($_POST['id_type_eco'])) {
        $id_type_eco = $_POST['id_type_eco'];
    } else {
        $id_type_eco[0] = 0;
?>
        <script>
            alert('Vous avez choisi aucun Type d\'examen.');
            window.location.href = '<?= $link_fail ?>?witness=-1';
        </script>
    <?php

    }

    $id = count($id_type_eco);

    /*--------------------------------- ETAT INFOS RH -------------------------------------*/
    $payer_sum = 0;
    $remise_sum = 0;
    $cnt = 0;
    $cnt_pers = 0;
    $query  = "SELECT * from regler_ecographie where id_reg_eco='$id_reg_eco' and id_eco='$id_eco'";
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
            window.location.href = 'liste_ecographie_checker.php?witness=-4';
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

    if ($cnt_pers == 1  and $paie != 0) {
        $payer_total = 0;
        $somme_total = 0;
        $versement = 0;

        foreach ($id_type_eco as $cle => $data_item) {
            // echo $cle .'=>'. $data_item;
            $query  = "SELECT * from ecographie_exa where  id_eco='$id_eco' and id_type_eco='$id_type_eco[$cle]'";
            $q = $conn->query($query);
            while ($row = $q->fetch_assoc()) {
                $payer_init_eco = $row["payer"];
                $somme_eco = $row["amount"];
            }
            $somme_total += $somme_eco;
            $remise_sum = $remise_init + $remise;

            if ($payer >= 0) {
                $payer_sum = $payer_init_eco + $payer;


                if ($somme_eco - $payer_sum > 0) {
                    $somme_eco = $payer_sum;
                    $payer_total += $payer_sum;
                    $payer = -1;
                    $etat = -1;

                    $query1 = "UPDATE ecographie_exa SET  etat=:etat
                            WHERE id_eco = '$id_eco' and id_type_eco='$id_type_eco[$cle]' ";

                    $sql1 = $db->prepare($query1);

                    // Bind parameters to statement
                    $sql1->bindParam(':etat', $etat);
                    $sql1->execute();
                } elseif ($somme_eco - $payer_sum <= 0) {
                    $payer -= $somme_eco;
                    $payer_total += $somme_eco;
                    $etat = 1;

                    $query1 = "UPDATE ecographie_exa SET  etat=:etat
                            WHERE id_eco = '$id_eco' and id_type_eco='$id_type_eco[$cle]' ";

                    $sql1 = $db->prepare($query1);

                    // Bind parameters to statement
                    $sql1->bindParam(':etat', $etat);
                    $sql1->execute();
                }

                $query1 = "UPDATE ecographie_exa SET  payer=:payer
                            WHERE id_eco = '$id_eco' and id_type_eco='$id_type_eco[$cle]' ";


                $sql1 = $db->prepare($query1);

                // Bind parameters to statement
                $sql1->bindParam(':payer', $somme_eco);
                $sql1->execute();
            }
        }

        $paye_reel = $payer_total - $remise_sum;
        $date_reg_paie = date('Y-m-d');

        $query1 = "UPDATE regler_ecographie SET  payer=:payer, remise=:remise, somme=:somme, id_paie=:id_paie, id_caisse=:id_caisse,date_reg_paie=:date_reg_paie
                WHERE id_eco= '$id_eco'and id_reg_eco='$id_reg_eco'";


        $sql1 = $db->prepare($query1);

        // Bind parameters to statement
        $sql1->bindParam(':payer', $paye_reel);
        $sql1->bindParam(':remise', $remise_sum);
        $sql1->bindParam(':id_paie', $paie);
        $sql1->bindParam(':somme', $somme_total);
        $sql1->bindParam(':id_caisse', $id_caisse);
        $sql1->bindParam(':date_reg_paie', $date_reg_paie);
        $sql1->execute();

        $etat = -1;
        $date_reg_paie = date('Y-m-d');
        $query1 = "UPDATE regler_ecographie SET  etat=:etat, date_reg_paie=:date_reg_paie
                WHERE  id_eco='$id_eco' and id_reg_eco='$id_reg_eco'";


        $sql1 = $db->prepare($query1);

        // Bind parameters to statement
        $sql1->bindParam(':etat', $etat);
        $sql1->bindParam(':date_reg_paie', $date_reg_paie);
        $sql1->execute();

        if ($somme_total - $payer_total == 0) {
            $etat = 1;
            $query1 = "UPDATE ecographie SET  etat=:etat
                WHERE  id_eco='$id_eco' ";


            $sql1 = $db->prepare($query1);

            // Bind parameters to statement
            $sql1->bindParam(':etat', $etat);
            $sql1->execute();

            $etat = 1;
            $date_reg_paie = date('Y-m-d');
            $query1 = "UPDATE regler_ecographie SET  etat=:etat, id_caisse=:id_caisse,date_reg_paie=:date_reg_paie
                WHERE  id_eco='$id_eco' and id_reg_eco='$id_reg_eco'";


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
        $somme = $somme_eco;
        $date_hist = date('Y-m-d');
        $statut = 'E';
        $type_beni = 'P';
        $service = 7;

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
            alert('Vous n\'avez pas de caisse.');
            window.location.href = '<?= $link_fail ?>?witness=-1';
        </script>
<?php
    }
}
?>