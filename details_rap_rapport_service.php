<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');

?>
<?php
$id_caisse = $_REQUEST['id'];
$service = $_REQUEST['service'];
$id_perso_session = $_SESSION['rainbo_id_perso'];
$query = "SELECT * from caisse where id_caisse='" . $id_caisse . "'";
$q = $db->query($query);
while ($row = $q->fetch()) {
    // $id_materiel = $row['id_materiel'];
    // /*-------------------- DETAILS --------------------*/
    $caisse = $row['caisse'];
    $id_perso = $row['id_perso'];
?>
    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"><i class="fas fa-tasks" style="color: silver"></i> Details des ventes : <?= $service ?> </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme XXX, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                        .

                    </li>
                </ol>
                <div class="row">
                    <div class="col-xl-12">
                        <b>
                            <!-- Nav pills -->
                            <ul class="nav nav-pills" style="float: right;">
                                <li class="nav-item">
                                    <a class="nav-link active" href="etat_print_rap_rapport_service.php?id_caisse=<?= $id_caisse ?>&services=<?= $service ?>&id_perso=<?= $id_perso_session ?>" target="blank" style="margin-right: 20px"><i class="fa fa-print"></i> Imprimer
                                    </a>
                                </li>
                            </ul>

                            <ul class="nav nav-pills" style="float: right;">
                                <li class="nav-item">
                                    <a class="nav-link active" href="details_rap_service_archive.php?id_caisse=<?= $id_caisse ?>&service=<?= $service ?>" target="blank" style="margin-right: 20px"><i class="fa fa-archive"></i> Archive
                                    </a>
                                </li>
                            </ul>

                        </b>
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
                                        <!--                                    <th>Ref</th>-->
                                        <th>Produit/services</th>
                                        <th>quantité</th>
                                        <th>Prix Unitaire</th>
                                        <th>Prix_total</th>
                                        <th>Date</th>
                                        <th class="text-right"><i class="fas fa-bars"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php


                                    $table_services = ['id_type_consul', 'id_type_eco', 'id_type_exa', 'id_type_hosp', 'id_type_ope', 'id_type_ordo', 'id_type_radiologie', 'id_type_anes', 'id_autre_service']; // Remplacez par vos noms de services
                                    $date_service = ['date_reg_consul', 'date_reg_eco', 'date_reg_exa', 'date_reg_hosp', 'date_reg_ope', 'date_reg_ordo', 'date_reg_radiologie', 'date_reg_anes', 'date_reg_autre'];
                                    $type_services = ['type_consul', 'type_eco', 'type_exa', 'type_hosp', 'type_ope', 'id_type_ordo', 'type_radiologie', 'type_anes', 'autres_services'];
                                    $prix_t_services = ['prix_t_consul', 'prix_t_eco', 'prix_t_exa', 'prix_t_hosp', 'prix_t_ope', 'id_type_ordo', 'prix_t_radiologie', 'prix_t_anes', 'autres_services'];

                                    switch ($service) {
                                        case 'regler_consul';
                                            $id_type_service = $table_services[0];
                                            $i = 0;
                                            break;
                                        case 'regler_examen';
                                            $id_type_service = $table_services[2];
                                            $i = 2;
                                            break;
                                        case 'regler_hosp';
                                            $id_type_service = $table_services[3];
                                            $i = 3;
                                            break;
                                        case 'regler_ordo';
                                            $id_type_service = $table_services[5];
                                            $prix_unit = 0;
                                            $i = 5;
                                            break;
                                        case 'regler_ope';
                                            $id_type_service = $table_services[4];
                                            $i = 4;
                                            break;
                                        case 'regler_anesthesie';
                                            $id_type_service = $table_services[7];
                                            $i = 7;
                                            break;
                                        case 'regler_ecographie';
                                            $id_type_service = $table_services[1];
                                            $i = 1;
                                            break;
                                        case 'regler_radiologie';
                                            $id_type_service = $table_services[6];
                                            $i = 6;
                                            break;
                                        case 'regler_autre';
                                            $id_type_service = $table_services[8];
                                            $prix_unit = 0;
                                            $i = 8;
                                            break;
                                    }

                                    $query = "SELECT  Count($id_type_service) as qte, $date_service[$i] as date_service, $id_type_service as id_type  FROM $service WHERE id_caisse = '$id_caisse' and  payer+remise = somme and year($date_service[$i]) = year(now()) and month($date_service[$i]) = month(now()) group by $date_service[$i] order by $date_service[$i] desc";

                                    $db->exec("SET sql_mode = REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', '');");
                                    $q = $db->query($query);
                                    while ($row = $q->fetch()) {
                                        $qte = $row['qte'];
                                        $date_hist = $row['date_service'];
                                        $id_type = $row['id_type'];

                                        //  $n=SUBSTR($ref_caisse,0,3);

                                        if ($i != 5) {
                                            $sql = "SELECT nom,  $prix_t_services[$i] as prix_unit from $type_services[$i] where $table_services[$i] = '$id_type' and open_close!=1";

                                            $stmt = $db->prepare($sql);
                                            $stmt->execute();

                                            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                            foreach ($tables as $table) {
                                                $nom_type = $table['nom'];
                                                $prix_unit = $table['prix_unit'];
                                            }
                                        } else {
                                            //                                        $sql = "SELECT  payer from $service where etat = 1 and payer != 0";
                                            //
                                            //                                        $stmt = $db->prepare($sql);
                                            //                                        $stmt->execute();
                                            //
                                            //                                        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            //
                                            //                                        foreach ($tables as $table) {
                                            //                                            $nom_type = $table['nom'];
                                            //                                            $prix_unit= $table['prix_unit'];
                                            //                                        }
                                        }



                                    ?>

                                        <tr>
                                            <!--                                        <td><a href="#">--><?php //echo $id_hist_caisse;
                                                                                                            ?><!--</a></td>-->
                                            <td><a href="#"><?= $nom_type ?></a></td>
                                            <td><a href="#"><?= number_format($qte) ?></a></td>
                                            <td><a href="#"><?= number_format($prix_unit) ?></a></td>
                                            <td><a href="#"><?= number_format($prix_unit * $qte) ?></a></td>
                                            <td><a href="#"><?= $date_hist ?></a></td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                        aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">


                                                        <a class="dropdown-item" href="edit-patient.html"><i
                                                                class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i>
                                                            Delete</a>
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
<?php } ?>
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
                    title: 'Oops...',
                    c
                    text: 'Une erreur s\'est produite !',
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