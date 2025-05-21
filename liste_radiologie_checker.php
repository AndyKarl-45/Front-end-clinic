<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');

?>

<!--Content-->

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><i class="fas fa-users" style="color: silver"></i> Liste des Radiologies en cours...</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">
                    Hello M/Mme XXX, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                    .

                </li>
            </ol>
            <div class="row">
                <div class="col-xl-12">

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <hr />
                </div>
            </div>
            <!--                Main Body              -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-border table-striped custom-table mb-0" id="dataTable">
                            <thead>
                                <tr>
                                    <th width="20%">Référence</th>
                                    <th>Patient</th>
                                    <th>Médecin</th>
                                    <th>Type de radiologie</th>
                                    <th>Date</th>
                                    <th>Prix</th>
                                    <th>Reste à Payer</th>
                                    <th>Payer</th>
                                    <th>Remise</th>
                                    <th>Statuts</th>
                                    <th>PDF</th>
                                    <th>remboursement</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $query = "SELECT * from regler_radiologie where DATE(date_reg_radiologie) >= CURDATE()";
                                $q = $db->query($query);
                                while ($row = $q->fetch()) {
                                    $id_reg_radiologie = $row['id_reg_radiologie'];
                                    $id_radiologie = $row['id_radiologie'];
                                    $id_type_radiologie = $row['id_type_radiologie'];
                                    $id_patient = $row['id_patient'];
                                    $etat_reg = $row['etat'];
                                    $payer = $row['payer'];
                                    $somme = $row['somme'];
                                    $remise = $row['remise'];
                                    $reste = $somme - $payer;


                                    if ($somme - ($payer + $remise) != 0) {
                                        continue;
                                    }

                                    $sql = "SELECT * from radiologie  where id_radiologie = '$id_radiologie'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {

                                        $id_radiologie = $table['id_radiologie'];
                                        $ref_radiologie = $table['ref_radiologie'];
                                        $id_patient = $table['id_patient'];
                                        $id_medecin = $table['id_medecin'];
                                        $date_radiologie = $table['date_radiologie'];
                                        $id_type_radiologie = $table['id_type_radiologie'];
                                    }




                                    $sql = "SELECT DISTINCT * from patient where id_patient = '$id_patient'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        $nom_patient = $table['nom_p'] . ' ' . $table['prenom_p'];
                                        //$nom_patient = $table['ref_patient'];
                                        $age = $table['age_p'];
                                    }


                                    $sql = "SELECT DISTINCT * from medecin where id_medecin = '$id_medecin'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        $nom_medecin = $table['nom_m'] . ' ' . $table['prenom_m'];
                                    }

                                    $sql = "SELECT DISTINCT * from type_radiologie where id_type_radiologie = '$id_type_radiologie'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        $type_radiologie = $table['nom'];
                                        $prix = $table['prix_t_radiologie'];
                                    }
                                    if (empty($id_medecin)) {
                                        $nom_medecin = 'N/A';
                                    }
                                    if (empty($id_type_radiologie)) {
                                        $type_radiologie = 'N/A';
                                    }

                                ?>

                                    <tr>
                                        <td><a href="#"><?= $ref_radiologie ?></a></td>
                                        <td><img width="28" height="28" src="assetss/img/user.jpg"
                                                class="rounded-circle m-r-5" alt=""><?= $nom_patient ?>
                                        </td>
                                        <td><a href="#"><?= $nom_medecin ?></a></td>
                                        <td><a href="#"><?= $type_radiologie ?></a></td>
                                        <td><a href="#"><?= $date_radiologie ?></a></td>
                                        <td><a href="#"><?= number_format($somme); ?></a></td>
                                        <td><a href="#"><?= number_format($somme - ($payer + $remise)); ?></a></td>
                                        <td><a href="#"><?= number_format($payer); ?></a></td>
                                        <td><a href="#"><?= number_format($remise); ?></a></td>
                                        <td>

                                            <?php
                                            if ($lvl == 11) {
                                                if ($somme - ($payer + $remise) == 0)
                                                    echo '<span class="custom-badge status-green" >Ok</span>';
                                                else
                                                    echo '<span class="custom-badge status-red" >Pas à Jour</span>';
                                            } else {
                                                if ($somme - ($payer + $remise) == 0)
                                                    echo '<span class="custom-badge status-green" data-toggle="modal" data-target="#ajouterRad' . $id_reg_radiologie . '">Ok</span>';
                                                else
                                                    echo '<span class="custom-badge status-red" data-toggle="modal" data-target="#ajouterRad' . $id_reg_radiologie . '">Pas à Jour</span>';
                                            }
                                            ?>

                                        </td>
                                        <td align="center"><a
                                                href="facture_radiologie.php?id_reg_radiologie=<?= $id_reg_radiologie ?>&id_perso=<?= $id_perso_session ?>"
                                                target="_blank">
                                                <i class='fa fa-print'></i>
                                            </a>
                                            <a href="facture_radiologie_Ticket.php?id_reg_radiologie=<?= $id_reg_radiologie ?>&id_perso=<?= $id_perso_session ?>" title="Ticket" target="_blank">
                                                <i class="far fa-file-alt"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <?php

                                            if ($lvl == 4 ||  $lvl == 13) {
                                                if ($lvl == 11 || $lvl == 7 || $lvl == 12) {
                                                    if ($somme - ($payer + $remise) == 0) {
                                                        echo '<a href="#" ><span class="custom-badge status-blue" ">rembourser</span></a>';
                                                    }
                                                } else {
                                                    if ($somme - ($payer + $remise) == 0) {
                                                        echo '<a href="rembourser_services.php?id_service=' . $id_radiologie . '&id_reg_service=' . $id_reg_radiologie . '" onclick="Supp(this.href); return(false);"><span class="custom-badge status-blue" ">rembourser</span></a>';
                                                    }
                                                }
                                            }

                                            ?>

                                        </td>
                                        <td class="text-right">

                                            <div class="modal fade" id="ajouterRad<?= $id_reg_radiologie ?>" role="dialog">
                                                <div class="modal-dialog" style="max-width: 800px; !important">
                                                    <!-- Modal content-->
                                                    <div class="modal-content" style="width: 800px; !important">
                                                        <div class="modal-header" style="padding:20px 50px;">
                                                            <h3 align="center"><i class="fas fa-map"></i>
                                                                <b>Reglement: <?= $ref_radiologie ?></b>
                                                            </h3>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                title="Close">&times;
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="padding:40px 50px;">
                                                            <form class="form-horizontal" action="update_radiologie_paye.php" name="form" method="post">
                                                                <input type="hidden" name="id_reg_radiologie"
                                                                    value="<?= $id_reg_radiologie ?>"
                                                                    class="form-control">
                                                                <input type="hidden" name="id_perso_session"
                                                                    value="<?= $id_perso_session ?>"
                                                                    class="form-control">
                                                                <input type="hidden" name="id_radiologie"
                                                                    value="<?= $id_radiologie ?>"
                                                                    class="form-control">
                                                                <div class="table-responsive">
                                                                    <table style="width: 100%;">
                                                                        <thead>
                                                                            <tr align="center">
                                                                                <th>Type</th>
                                                                                <th>Prix</th>
                                                                                <th>Reste à payer</th>
                                                                                <th>Choix</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tfoot>
                                                                            <tr>
                                                                                <th colspan="3" style="background-color:white;">Montant Total:</th>
                                                                                <th>
                                                                                    <input type="hidden" name="montant_total" class="totalRad-<?= $ref_radiologie ?>" value="0">
                                                                                    <input type="text" style="width: 100px;" id="montant-totalRad<?= $ref_radiologie ?>" value="0" disabled>
                                                                                </th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th colspan="3">Montant versé:</th>
                                                                                <th>
                                                                                    <input type="text" style="width: 100px;" name="montant_verse" id="montant-verseRad<?= $ref_radiologie ?>" style="background-color: #dee2e6" value="0" oninput="calculerReste('<?= $ref_radiologie ?>')">
                                                                                </th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th colspan="3" style="background-color:white;">Reste à rembourser:</th>
                                                                                <th>
                                                                                    <input type="text" style="width: 100px;" id="reste-rembourserRad<?= $ref_radiologie ?>" value="0" disabled>
                                                                                </th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th colspan="3">Reste à payer:</th>
                                                                                <th>
                                                                                    <input type="text" style="width: 100px;" id="reste-payerRad<?= $ref_radiologie ?>" value="0" disabled>
                                                                                </th>
                                                                            </tr>
                                                                            <?php
                                                                            if ($lvl == 4 || $lvl == 7 || $lvl == 11 || $lvl == 2 || $lvl == 12) {
                                                                            ?>
                                                                                <tr>
                                                                                    <th colspan="3" style="background-color:white;">Mode de paiement:</th>
                                                                                    <th>
                                                                                        <select style="width: 100px;"
                                                                                            name="paie">
                                                                                            <option value="0" selected="">
                                                                                                ...
                                                                                            </option>
                                                                                            <?php

                                                                                            $sql = "SELECT montant from caution where id_patient = '$id_patient' ";

                                                                                            $stmt = $db->prepare($sql);
                                                                                            $stmt->execute();


                                                                                            // Vérifiez si des résultats ont été trouvés
                                                                                            if ($table = $stmt->fetch(PDO::FETCH_ASSOC)) {

                                                                                                $montant_caution = $table['montant'];
                                                                                            } else {
                                                                                                $montant_caution = 0; // Aucun montant de caution trouvé
                                                                                            }


                                                                                            $iResult = $db->query("SELECT * FROM mode_paie where open_close!=1 ");

                                                                                            while ($data = $iResult->fetch()) {

                                                                                                $i = $data['id_mode_paie'];
                                                                                                if ($data['nom'] === 'CAUTION') {
                                                                                                    echo '<option value ="' . $i . '">';
                                                                                                    echo $data['nom'] . ' ( ' . number_format($montant_caution) . ' )';
                                                                                                    echo '</option>';
                                                                                                } else {
                                                                                                    echo '<option value ="' . $i . '">';
                                                                                                    echo $data['nom'];
                                                                                                    echo '</option>';
                                                                                                }
                                                                                            }

                                                                                            ?>

                                                                                        </select>
                                                                                    </th>
                                                                                </tr>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                            <?php
                                                                            if ($lvl == 4 || $lvl == 7 || $lvl == 11) {
                                                                            ?>
                                                                                <tr>
                                                                                    <th colspan="3" style="background-color:white;">Remise:</th>
                                                                                    <th>
                                                                                        <input type="number" style="width: 100px;"
                                                                                            name="remise" value="0" />
                                                                                    </th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th colspan="3" style="background-color:white;">Caisse:</th>
                                                                                    <th><select style="width: 100px;"
                                                                                            name="id_caisse">
                                                                                            <option value="0" selected="">
                                                                                                ...
                                                                                            </option>
                                                                                            <?php

                                                                                            $iResult = $db->query("SELECT * FROM caisse where open_close!=1 ");

                                                                                            while ($data = $iResult->fetch()) {

                                                                                                $i = $data['id_caisse'];
                                                                                                echo '<option value ="' . $i . '">';
                                                                                                echo $data['caisse'];
                                                                                                echo '</option>';
                                                                                            }

                                                                                            ?>

                                                                                        </select></th>
                                                                                </tr>
                                                                            <?php } ?>
                                                                        </tfoot>
                                                                        <tbody>
                                                                            <?php
                                                                            if ($etat_reg != 0)
                                                                                $sql = "SELECT * from radiologie_exa  where ref_radiologie_exa = '$ref_radiologie' and etat!=0";
                                                                            else
                                                                                $sql = "SELECT * from radiologie_exa  where ref_radiologie_exa = '$ref_radiologie'";


                                                                            $stmt = $db->prepare($sql);
                                                                            $stmt->execute();

                                                                            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                            foreach ($tables as $table) {

                                                                                $id_radiologie = $table['id_radiologie'];
                                                                                $id_patient = $table['id_patient'];
                                                                                $id_medecin = $table['id_medecin'];
                                                                                $id_type_radiologie = $table['id_type_radiologie'];
                                                                                $amount_radiologie = $table['amount'];
                                                                                $payer_radiologie = $table['payer'];


                                                                                $sql = "SELECT DISTINCT * from type_radiologie where id_type_radiologie = '$id_type_radiologie'";

                                                                                $stmt = $db->prepare($sql);
                                                                                $stmt->execute();

                                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                                foreach ($tables as $table) {
                                                                                    $type_radiologie = $table['nom'];
                                                                                    $prix = $table['prix_t_radiologie'];
                                                                                }

                                                                                if (empty($id_type_radiologie)) {
                                                                                    $type_radiologie = 'N/A';
                                                                                }




                                                                            ?>
                                                                                <tr align="center">
                                                                                    <td><?= $type_radiologie ?></td>
                                                                                    <td><?= $prix ?></td>
                                                                                    <td>
                                                                                        <?php echo $prix - $payer_radiologie; ?>
                                                                                    </td>
                                                                                    <td><input type="checkbox" class="choixRad" style="transform: scale(1.5);" name="id_type_radiologie[]" value="<?= $id_type_radiologie ?>"
                                                                                            data-total="<?php echo $prix - $payer_radiologie; ?>" data-id="<?= $ref_radiologie ?>" <?php if ($prix - $payer_radiologie == 0) {
                                                                                                                                                                                        echo 'disabled';
                                                                                                                                                                                    } ?>></td>
                                                                                </tr>
                                                                            <?php } ?>
                                                                            <!-- Ajouter d'autres lignes du tableau ici -->
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="form-group" style="padding-top: 50px;">
                                                                    <div class="col-sm-12">
                                                                        <center>
                                                                            <input type="submit" style=" width:25% "
                                                                                name="submit_cs"
                                                                                class="btn btn-primary"
                                                                                value="Payer">
                                                                            <input data-dismiss="modal" type="text"
                                                                                style=" width:25% " name=""
                                                                                class="btn btn-danger"
                                                                                value="Annuler" />
                                                                        </center>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--                End Body              -->

            <div class="row">
                <div class="col-md-12">
                    <hr />
                </div>
            </div>

        </div>
    </main>
</div>

<div class="modal fade" id="ajouterExam" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding:20px 50px;">
                <h3 align="center"><i class="fas fa-map"></i> <b>Reglement</b></h3>
                <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
                <form class="form-horizontal" action="save_pays.php" name="form" method="post">
                    <div class="form-group">
                        <label>Montant Recue</label>
                        <div class="col-sm-12">
                            <input type="text" name="nom" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Montant total</label>
                        <div class="col-sm-12">
                            <input type="text" name="nom" class="form-control" value="1.500.000" disabled="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <center>
                                <input type="submit" style=" width:25% " name="submit_cs" class="btn btn-primary"
                                    value="Créer">

                                <input data-dismiss="modal" type="text" style=" width:25% " name=""
                                    class="btn btn-danger" value="Annuler" />
                            </center>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function Supp(link) {
        if (confirm('Confirmer  le remboursement de l\'hospitalisation ?')) {
            document.location.href = link;
        }
    }

    function calculerMontantTotal() {
        var lignesChoisies = document.querySelectorAll('.choixRad:checked');
        let montantTotal = 0;
        var ref_exa = "";

        lignesChoisies.forEach((ligne) => {
            ref_radiologie = ligne.dataset.id;
            montantTotal += parseInt(ligne.dataset.total);
        });

        document.getElementById('montant-totalRad' + ref_radiologie).value = montantTotal;
        $('.totalRad-' + ref_radiologie).attr('value', montantTotal);
    }

    function calculerReste(ref_radiologie) {
        const montantTotal = parseInt(document.getElementById('montant-totalRad' + ref_radiologie).value);
        const montantVerse = parseInt(document.getElementById('montant-verseRad' + ref_radiologie).value);
        let reste = montantTotal - montantVerse;
        let restePayer = 0;

        if (reste < 0) {
            resteRembourser = Math.abs(reste);
            restePayer = 0;
        } else {
            resteRembourser = 0;
            restePayer = Math.abs(reste);
        }


        document.getElementById('reste-rembourserRad' + ref_radiologie).value = resteRembourser;
        $('.totalRad-' + ref_radiologie).attr('value', montantTotal);
        document.getElementById('reste-payerRad' + ref_radiologie).value = restePayer;
        $('.totalRad-' + ref_radiologie).attr('value', montantTotal);
    }



    document.addEventListener('DOMContentLoaded', () => {
        const choixCheckbox = document.querySelectorAll('.choixRad');

        choixCheckbox.forEach((checkbox) => {
            checkbox.addEventListener('change', () => {
                var ref_radiologie = checkbox.dataset.id;
                document.getElementById('montant-totalRad' + ref_radiologie).value = 0;
                document.getElementById('reste-payerRad' + ref_radiologie).value = 0;
                $('.totalRad-' + ref_radiologie).attr('value', 0);

                calculerMontantTotal();
                calculerReste(ref_radiologie);
            });
        });
    });
</script>
<script>
    <?php
    if (isset($_GET['witness'])) {
        $witness = $_GET['witness'];

        switch ($witness) {
            case '1';
    ?>
                    <
                    script >
                    Swal.fire(
                        'Succès',
                        'Opération effectuée avec succès !',
                        'success'
                    )
</script>
<?php
                break;
            case '-2';
?>
    <script>
        Swal.fire({
            icon: 'Erreur',
            title: 'Oops...',
            text: 'Vous n\'avez pas de caisse ou un mode de règlement.',
            footer: 'Reéssayez encore'
        })
    </script>
<?php
                break;
            case '-1';
?>
    <script>
        Swal.fire({
            icon: 'Erreur',
            title: 'Oops...',
            text: 'Une erreur produit !',
            footer: 'Reéssayez encore'
        })
    </script>
<?php
                break;
        }
    }
?>


<!--//Footer-->
<?php
include('foot.php');
?>