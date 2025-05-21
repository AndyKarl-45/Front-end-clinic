<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")

?>

<?php

if ($_POST) {
    $id_radiologie = $_POST['id_radiologie'];
    $id_reg_radiologie = $_POST['id_reg_radiologie'];
    $id_perso_session = $_POST['id_perso_session'];
    $payer = $_POST['montant_verse'];
    $somme = $_POST['montant_total'];
    $paie = $_POST['paie'];
    $remise = $_POST['remise'];
    $link = 'liste_radiologie_checker.php';


    if (isset($_POST['id_type_radiologie'])) {
        $id_type_radiologie = $_POST['id_type_radiologie'];
    } else {
        $id_type_radiologie[0] = 0;
?>
        <script>
            alert('Vous avez choisi aucun Type de radiologie.');
            window.location.href = '<?= $link ?>?witness=-1';
        </script>
        <?php

    }
    $id = count($id_type_radiologie);

    /*--------------------------------- ETAT INFOS RH -------------------------------------*/
    $payer_sum = 0;
    $remise_sum = 0;
    $cnt = 0;
    $cnt_pers = 0;
    $query  = "SELECT * from regler_radiologie where id_reg_radiologie='$id_reg_radiologie' and id_radiologie='$id_radiologie'";
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

    if ($paie === $mode_caution) {

        if ($montant_caution != 0) {
            $payer = $montant_caution;
        } else {
        ?>
            <script>
                //  alert('client n\'a pas été mis à jour.');
                window.location.href = '<?= $link ?>?witness=-3';
            </script>
        <?php
        }
    }

    if ($cnt_pers == 1 and $paie != 0) {

        $payer_total = 0;
        $somme_total = 0;
        $versement = 0;
        foreach ($id_type_radiologie as $cle => $data_item) {
            // echo $cle .'=>'. $data_item;
            $query  = "SELECT * from radiologie_exa where  id_radiologie='$id_radiologie' and id_type_radiologie='$id_type_radiologie[$cle]'";
            $q = $conn->query($query);
            while ($row = $q->fetch_assoc()) {
                $payer_init_radiologie = $row["payer"];
                $somme_radiologie = $row["amount"];
            }
            $somme_total += $somme_radiologie;
            $remise_sum = $remise_init + $remise;

            if ($payer >= 0) {
                $payer_sum = $payer_init_radiologie + $payer;


                if ($somme_radiologie - $payer_sum > 0) {
                    $somme_radiologie = $payer_sum;
                    $payer_total += $payer_sum;
                    $payer = -1;
                    $etat = -1;

                    $query1 = "UPDATE radiologie_exa SET  etat=:etat
                            WHERE id_radiologie = '$id_radiologie' and id_type_radiologie='$id_type_radiologie[$cle]' ";

                    $sql1 = $db->prepare($query1);

                    // Bind parameters to statement
                    $sql1->bindParam(':etat', $etat);
                    $sql1->execute();
                } elseif ($somme_radiologie - $payer_sum <= 0) {
                    $payer -= $somme_radiologie;
                    $payer_total += $somme_radiologie;
                    $etat = 1;

                    $query1 = "UPDATE radiologie_exa SET  etat=:etat
                            WHERE id_radiologie = '$id_radiologie' and id_type_radiologie='$id_type_radiologie[$cle]' ";

                    $sql1 = $db->prepare($query1);

                    // Bind parameters to statement
                    $sql1->bindParam(':etat', $etat);
                    $sql1->execute();
                }

                $query1 = "UPDATE radiologie_exa SET  payer=:payer
                            WHERE id_radiologie = '$id_radiologie' and id_type_radiologie='$id_type_radiologie[$cle]' ";


                $sql1 = $db->prepare($query1);

                // Bind parameters to statement
                $sql1->bindParam(':payer', $somme_radiologie);
                $sql1->execute();
            }
        }


        $paye_reel = $payer_total - $remise_sum;

        $query1 = "UPDATE regler_radiologie SET  payer=:payer, remise=:remise, somme=:somme, id_paie=:id_paie, id_caisse=:id_caisse
                WHERE id_radiologie = '$id_radiologie'and id_reg_radiologie='$id_reg_radiologie'";


        $sql1 = $db->prepare($query1);

        // Bind parameters to statement
        $sql1->bindParam(':payer', $paye_reel);
        $sql1->bindParam(':remise', $remise_sum);
        $sql1->bindParam(':id_paie', $paie);
        $sql1->bindParam(':somme', $somme_total);
        $sql1->bindParam(':id_caisse', $id_caisse);
        $sql1->execute();

        $etat = -1;
        $query1 = "UPDATE regler_radiologie SET  etat=:etat
                WHERE  id_radiologie='$id_radiologie' and id_reg_radiologie='$id_reg_radiologie'";


        $sql1 = $db->prepare($query1);

        // Bind parameters to statement
        $sql1->bindParam(':etat', $etat);
        $sql1->execute();

        if ($somme_total - $payer_total == 0) {
            $etat = 1;
            $query1 = "UPDATE radiologie SET  etat=:etat
                WHERE  id_radiologie='$id_radiologie' ";


            $sql1 = $db->prepare($query1);

            // Bind parameters to statement
            $sql1->bindParam(':etat', $etat);
            $sql1->execute();

            $etat = 1;
            $query1 = "UPDATE regler_radiologie SET  etat=:etat, id_caisse=:id_caisse
                WHERE  id_radiologie='$id_radiologie' and id_reg_radiologie='$id_reg_radiologie'";


            $sql1 = $db->prepare($query1);

            // Bind parameters to statement
            $sql1->bindParam(':etat', $etat);
            $sql1->bindParam(':id_caisse', $id_caisse);
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
        $service = 8;

        $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_entre,date_hist,statut,type_beni,id_perso,service)
                  VALUES (?,?,?,?,?,?,?,?,?)";
        $req = $db->prepare($sql);
        $req->execute(array($id_caisse, $ref_caisse, $id_patient, $versement, $date_hist, $statut, $type_beni, $id_perso, $service));

        if ($paie === $mode_caution) {

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
                window.location.href = '<?= $link ?>?witness=1';
            </script>
        <?php
        } else {
        ?>
            <script>
                //   alert('client n\'a pas été mis à jour.');
                window.location.href = '<?= $link ?>?witness=-1';
            </script>
        <?php

        }
    } else {
        ?>
        <script>
            // alert('Vous n\'avez pas de caisse ou un mode de règlement.');
            window.location.href = '<?= $link ?>?witness=-2';
        </script>
<?php
    }
}
?>