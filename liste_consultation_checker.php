<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');

?>

<!--Content-->

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><i class="fas fa-users" style="color: silver"></i> Liste des Consultations en cours...</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">
                    Hello M/Mme XXX, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                </li>
            </ol>
            <div class="row">
                <div class="col-xl-12">
                    <!-- Nav pills -->

                    <ul class="nav nav-pills" style="float: right; margin-right: 20px ;">
                        <li class="nav-item">
                            <a class="nav-link active" href="liste_con_suite_review.php">

                                <?php
                                echo ' Consultation à régler';

                                ?>


                            </a>
                        </li>
                    </ul>
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
                                    <!--                                    <th>Code Patient</th>-->
                                    <th onclick="sortTable(0)">Nom du patient</th>
                                    <th>Patient</th>
                                    <th>Infirmière(ier)</th>
                                    <th>Médecin</th>
                                    <th>Departement</th>
                                    <th onclick="sortTable(6)">Date de consultation</th>
                                    <th>Prix</th>
                                    <th>Reste à payer</th>
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

                                $query = "SELECT rc.*, c.*
          FROM regler_consul rc 
          JOIN consultation c ON rc.id_con = c.id_con where DATE(date_reg_paie) >= CURDATE() 
          ORDER BY rc.date_reg_consul desc";  // Trier par la date de consultation

                                $q = $db->query($query);
                                while ($row = $q->fetch()) {
                                    $id_reg_consul = $row['id_reg_consul'];
                                    $id_con = $row['id_con'];
                                    $id_patient = $row['id_patient'];
                                    $payer_reg = $row['payer'];
                                    $somme_reg = $row['somme'];
                                    $remise = $row['remise'];

                                    if ($somme_reg - ($payer_reg + $remise) != 0) {
                                        continue;
                                    }

                                    //                                    $sql = "SELECT DISTINCT * from regler_consultation  where id_con = '$id_con'";
                                    //
                                    //                                    $stmt = $db->prepare($sql);
                                    //                                    $stmt->execute();
                                    //
                                    //                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    //
                                    //                                    foreach ($tables as $table) {
                                    //                                        $id_reg_con= $table['id_reg_con'];
                                    //                                        $payer= $table['payer'];
                                    //                                        $somme= $table['somme'];
                                    //                                        $reste= $somme-$payer;
                                    //                                    }

                                    //                                    $sql = "SELECT DISTINCT * from consultation where id_con = '$id_con' order by date_con  desc";
                                    //
                                    //                                    $stmt = $db->prepare($sql);
                                    //                                    $stmt->execute();
                                    //
                                    //                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    //
                                    //                                    foreach ($tables as $table) {
                                    $id_con = $row['id_con'];
                                    $ref_con = $row['ref_con'];
                                    $id_patient = $row['id_patient'];
                                    $id_depart = $row['id_depart'];
                                    $id_medecin = $row['id_medecin'];
                                    $id_nurse = $row['id_nurse'];
                                    $date_con = $row['date_con'];
                                    $temp = $row['temp'];
                                    $taille = $row['taille'];
                                    $pression = $row['pression'];
                                    $poids = $row['poids'];
                                    // }

                                    $sql = "SELECT DISTINCT * from patient where id_patient = '$id_patient'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        $nom_patient_ref = $table['nom_p'] . ' ' . $table['prenom_p'];
                                        $nom_patient = $table['ref_patient'];
                                        $age = $table['age_p'];
                                    }

                                    $sql = "SELECT DISTINCT * from nurse where id_nurse = '$id_nurse'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        $nom_nurse = $table['nom_n'] . ' ' . $table['prenom_n'];
                                    }

                                    $sql = "SELECT DISTINCT * from medecin where id_medecin = '$id_medecin'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        $nom_medecin = $table['nom_m'] . ' ' . $table['prenom_m'];
                                    }

                                    $sql = "SELECT DISTINCT * from departement where id_depart = '$id_depart'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        $departement = $table['nom'];
                                    }
                                    if (empty($id_medecin)) {
                                        $nom_medecin = 'N/A';
                                    }
                                    if (empty($id_nurse)) {
                                        $nom_nurse = 'N/A';
                                    }
                                    if (empty($id_depart)) {
                                        $departement = 'N/A';
                                    }

                                ?>

                                    <tr>
                                        <!--                                    <td>--><?php //=$ref_con
                                                                                        ?><!--</td>-->
                                        <td><?= $nom_patient_ref ?></td>
                                        <td><img width="28" height="28" src="assetss/img/user.jpg"
                                                class="rounded-circle m-r-5"
                                                alt=""> <?= $nom_patient ?>
                                        </td>
                                        <td><?= $nom_nurse ?></td>
                                        <td><?= $nom_medecin ?></td>
                                        <td><?= $departement ?></td>
                                        <td><?= $date_con ?></td>
                                        <td><a href="#"><?= $somme_reg ?></a></td>
                                        <td><a href="#"><?= number_format($somme_reg - $payer_reg - $remise); ?></a></td>
                                        <td><a href="#"><?= number_format($payer_reg); ?></a></td>
                                        <td><a href="#"><?= number_format($remise); ?></a></td>
                                        <td>
                                            <?php
                                            if ($lvl == 11) {

                                                if ($somme_reg - ($payer_reg + $remise) == 0)
                                                    echo '<span class="custom-badge status-green" >Ok</span>';
                                                else
                                                    echo '<span class="custom-badge status-red" >Pas à Jour</span>';
                                            } else {
                                                if ($somme_reg - ($payer_reg + $remise) == 0)
                                                    echo '<span class="custom-badge status-green" data-toggle="modal" data-target="#ajouterCon' . $id_reg_consul . '">Ok</span>';
                                                else
                                                    echo '<span class="custom-badge status-red" data-toggle="modal" data-target="#ajouterCon' . $id_reg_consul . '">Pas à Jour</span>';
                                            }
                                            ?>

                                        </td>
                                        <td class="text-center">
                                            <?php

                                            if ($lvl == 4 ||  $lvl == 13) {
                                                if ($lvl == 11 || $lvl == 7 || $lvl == 12) {
                                                    if ($somme_reg - ($payer_reg + $remise) == 0) {
                                                        echo '<a href="#" ><span class="custom-badge status-blue" ">rembourser</span></a>';
                                                    }
                                                } else {
                                                    if ($somme_reg - ($payer_reg + $remise) == 0) {
                                                        echo '<a href="rembourser_consul.php?id_con=' . $id_con . '&id_reg_consul=' . $id_reg_consul . '" onclick="Supp(this.href); return(false);"><span class="custom-badge status-blue" ">rembourser</span></a>';
                                                    }
                                                }
                                            }

                                            ?>

                                        </td>

                                        <td align="center"><a href="facture_consultation.php?id_reg_consul=<?= $id_reg_consul ?>&id_perso=<?= $id_perso_session ?>" target="_blank">
                                                <i class='fa fa-print'></i>
                                            </a><a
                                                href="facture_consultation_Ticket.php?id_reg_consul=<?= $id_reg_consul ?>&id_perso=<?= $id_perso_session ?>" title="Ticket"
                                                target="_blank">
                                                <i class='far fa-file-alt'></i>
                                            </a></td>
                                        <td class="text-right">
                                            <div class="modal fade" id="ajouterCon<?= $id_reg_consul ?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header" style="padding:20px 50px;">
                                                            <h3 align="center"><i class="fas fa-map"></i> <b>Reglement: <?= $ref_con ?></b></h3>
                                                            <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
                                                        </div>
                                                        <div class="modal-body" style="padding:40px 50px;">
                                                            <form class="form-horizontal" action="update_con_paye.php" name="form" method="post">

                                                                <div class="row">
                                                                    <label style="text-align: center;">
                                                                        <i class="far fa-newspaper"></i>
                                                                        Versement précédent
                                                                    </label>
                                                                    <div class="col-md-12">
                                                                        <hr />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Payement versé:</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" value="<?= number_format($payer_reg) ?>" disabled="" />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Reste à payer:</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" value="<?= number_format($somme_reg - $payer_reg - $remise) ?>" disabled="" />
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <hr />
                                                                    </div>
                                                                </div>


                                                                <div class="row">
                                                                    <label>
                                                                        <i class="far fa-newspaper"></i>
                                                                        Versement Actuel
                                                                    </label>
                                                                    <div class="col-md-12">
                                                                        <hr />
                                                                    </div>
                                                                </div>


                                                                <div class="form-group">
                                                                    <label>Montant versé:</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="hidden" name="id_reg_consul" value="<?= $id_reg_consul ?>" class="form-control">
                                                                        <input type="hidden" name="id_perso_session" value="<?= $id_perso_session ?>" class="form-control">
                                                                        <input type="hidden" name="id_con" value="<?= $id_con ?>" class="form-control">
                                                                        <input type="number" name="payer" id="montant-verse<?= $ref_con ?>" class="form-control" oninput="calculerReste('<?= $ref_con ?>')">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Montant total:</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="hidden" name="somme" class="form-control" value="<?= $somme_reg ?>">
                                                                        <input type="text" class="form-control" value="<?= number_format($somme_reg - $payer_reg - $remise) ?>" disabled="" />
                                                                        <input type="hidden" class="form-control" id="montant-total<?= $ref_con ?>" value="<?= $somme_reg - $payer_reg - $remise ?>" />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Reste à payer:</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="reste-payer<?= $ref_con ?>" value="0" disabled="" />
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Montant à rembourser:</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="reste-rembourser<?= $ref_con ?>" value="0" disabled="" />
                                                                    </div>
                                                                </div>

                                                                <?php
                                                                if ($lvl == 4 || $lvl == 7 || $lvl == 11) {
                                                                ?>
                                                                    <div class="form-group">
                                                                        <label>Remise:</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="number" class="form-control" name="remise" value="0" />
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <div class="form-group">
                                                                        <div class="col-sm-12">
                                                                            <input type="hidden" class="form-control" name="remise" value="0" />
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                                }
                                                                ?>

                                                                <?php
                                                                if ($lvl == 4 || $lvl == 7 || $lvl == 11 || $lvl == 2 || $lvl == 12) {
                                                                ?>
                                                                    <div class="form-group">
                                                                        <label>Mode de paie : <span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="col-sm-12">
                                                                            <select class="form-control"
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

                                                                                    echo '<option value ="' . $i . '">';
                                                                                    echo $data['nom'];
                                                                                    echo '</option>';
                                                                                }
                                                                                echo '<option value ="01010">';
                                                                                echo 'CAUTION ( ' . number_format($montant_caution) . ' FCFA)';
                                                                                echo '</option>';

                                                                                ?>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                                }
                                                                ?>
                                                                <?php
                                                                if ($lvl == 4 || $lvl == 7 || $lvl == 11) {
                                                                ?>
                                                                    <div class="form-group">
                                                                        <label>Caisse: <span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="col-sm-12">
                                                                            <select class="form-control"
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

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <center>
                                                                            <input type="submit" style=" width:25% " name="submit_cs" class="btn btn-primary"
                                                                                value="Payer">

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
                                        </td>
                                    </tr>

                                <?php }
                                ?>
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

<!--    Modal pour ajouter Categorie Contrat-->
<div class="modal fade" id="ajouterOper" role="dialog">
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
                            <input type="text" name="nom" class="form-control" value="500,000" disabled="">
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
<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->

<script>
    function Supp(link) {
        if (confirm('Confirmer  le remboursement de la consultattion ?')) {
            document.location.href = link;
        }
    }

    function calculerReste(ref_service) {
        const montantTotal = parseInt(document.getElementById('montant-total' + ref_service).value);
        const montantVerse = parseInt(document.getElementById('montant-verse' + ref_service).value);
        let reste = montantTotal - montantVerse;
        let restePayer = 0;

        if (reste < 0) {
            resteRembourser = Math.abs(reste);
            restePayer = 0;
        } else {
            resteRembourser = 0;
            restePayer = Math.abs(reste);
        }


        document.getElementById('reste-rembourser' + ref_service).value = resteRembourser;
        //   $('.total-'+ref_service).attr('value',montantTotal);
        document.getElementById('reste-payer' + ref_service).value = restePayer;
        //   $('.total-'+ref_service).attr('value',montantTotal);
    }
</script>


<?php
if (isset($_GET['witness'])) {
    $witness = $_GET['witness'];

    switch ($witness) {
        case '1';
?>
            <script>
                Swal.fire(
                    'Succès',
                    'Opération effectuée avec succès !',
                    'success'
                )
            </script>
        <?php
            break;
        case '-1';
        ?>
            <script>
                Swal.fire({
                    icon: 'Erreur',
                    title: 'Versement Incorrecte',
                    text: 'Une erreur s\'est produite!',
                    footer: 'Reéssayez encore'
                })
            </script>
        <?php
            break;
        case '-2';
        ?>
            <script>
                Swal.fire({
                    icon: 'Erreur',
                    title: 'Votre solde est à 200 000 ',
                    text: 'Transférer votre solde à la caisse principale!',
                    footer: 'Reéssayez encore'
                })
            </script>
        <?php
            break;
        case '-3';
        ?>
            <script>
                Swal.fire({
                    icon: 'Erreur',
                    title: 'Votre caution est à 0 ',
                    text: 'Mettre à jour la caution du patient ! ',
                    footer: 'Reéssayez encore'
                })
            </script>
        <?php
            break;
        case '-4';
        ?>
            <script>
                Swal.fire({
                    icon: 'Erreur',
                    title: 'Règlement est ok ! ',
                    text: 'Une erreur s\'est produite! ',
                    footer: 'Reéssayez encore'
                })
            </script>
<?php
            break;
    }
}
?>
<script>
    function sortTable(columnIndex) {
        var table = document.getElementById("dataTable");
        var rows = table.rows;
        var switching = true;
        var shouldSwitch, i;
        var dir = "asc"; // Par défaut, trier en ordre croissant
        var switchCount = 0;

        // Boucle jusqu'à ce qu'aucun switch n'ait été effectué
        while (switching) {
            switching = false;
            var rowsArray = Array.from(rows).slice(1); // Ne pas inclure la ligne d'en-tête

            for (i = 0; i < rowsArray.length - 1; i++) {
                shouldSwitch = false;
                var x = rowsArray[i].getElementsByTagName("TD")[columnIndex];
                var y = rowsArray[i + 1].getElementsByTagName("TD")[columnIndex];

                // Comparer les deux valeurs
                if (dir === "asc") {
                    if (isNaN(Date.parse(x.innerHTML))) { // Si ce n'est pas une date, comparer les chaînes
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    } else { // Si c'est une date, comparer les dates
                        if (new Date(x.innerHTML) > new Date(y.innerHTML)) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                } else if (dir === "desc") {
                    if (isNaN(Date.parse(x.innerHTML))) {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    } else {
                        if (new Date(x.innerHTML) < new Date(y.innerHTML)) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
            }

            if (shouldSwitch) {
                // Si un switch doit être fait, échanger les lignes
                rowsArray[i].parentNode.insertBefore(rowsArray[i + 1], rowsArray[i]);
                switching = true;
                switchCount++;
            } else {
                // Si aucun switch n'a été fait, et la direction est "asc", changer en "desc"
                if (switchCount === 0 && dir === "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>

<!--//Footer-->
<?php
include('foot.php');
?>