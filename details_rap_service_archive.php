<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');

?>
<?php
$id_caisse = $_REQUEST['id_caisse'];
$service = $_REQUEST['service'];
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
                <h1 class="mt-4"><i class="fas fa-tasks" style="color: silver"></i> Archives: <?= $service ?> </h1>
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
                            <!--                            <ul class="nav nav-pills"   style="float: right;">-->
                            <!--                                <li class="nav-item">-->
                            <!--                                    <a class="nav-link active" href="etat_print_rap_vente.php?id_caisse=--><?php //=$id_caisse
                                                                                                                                            ?><!--" target="blank" style="margin-right: 20px" ><i class="fa fa-print"></i> Imprimer-->
                            <!--                                    </a>-->
                            <!--                                </li>-->
                            <!--                            </ul>-->

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
                                        <th>Année(s)</th>
                                        <th class="text-right"><i class="fas fa-bars"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $date_service = ['date_reg_consul', 'date_reg_eco', 'date_reg_exa', 'date_reg_hosp', 'date_reg_ope', 'date_reg_ordo', 'date_reg_radiologie', 'date_reg_anes', 'date_reg_autre'];

                                    switch ($service) {
                                        case 'regler_consul';
                                            //  $id_type_service=$table_services[0];
                                            $i = 0;
                                            break;
                                        case 'regler_examen';
                                            //  $id_type_service=$table_services[2];
                                            $i = 2;
                                            break;
                                        case 'regler_hosp';
                                            //  $id_type_service=$table_services[3];
                                            $i = 3;
                                            break;
                                        case 'regler_ordo';
                                            //$id_type_service=$table_services[5];
                                            $prix_unit = 0;
                                            $i = 5;
                                            break;
                                        case 'regler_ope';
                                            //  $id_type_service=$table_services[4];
                                            $i = 4;
                                            break;
                                        case 'regler_anesthesie';
                                            //  $id_type_service=$table_services[7];
                                            $i = 7;
                                            break;
                                        case 'regler_ecographie';
                                            //   $id_type_service=$table_services[1];
                                            $i = 1;
                                            break;
                                        case 'regler_radiologie';
                                            //   $id_type_service=$table_services[6];
                                            $i = 6;
                                            break;
                                        case 'regler_autre';
                                            //   $id_type_service=$table_services[8];
                                            $prix_unit = 0;
                                            $i = 8;
                                            break;
                                    }


                                    $query = "SELECT year($date_service[$i]) as annee from $service  group by year($date_service[$i])  order by $date_service[$i] asc";
                                    // $query = "SELECT * from service where nom ='Ordonnances' order by nom asc";
                                    //  $query = "SELECT * from historique_caisse where id_caisse='$id_caisse'  order by id_hist_caisse desc";
                                    $db->exec("SET sql_mode = REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', '');");
                                    $q = $db->query($query);
                                    while ($row = $q->fetch()) {
                                        // $id_hist_caisse = $row['id_hist_caisse'];
                                        $annee = $row['annee'];




                                    ?>

                                        <tr>
                                            <td><a href="details_rap_service_archive_mois.php?id=<?= $id_caisse ?>&service=<?= $service ?>&annee=<?= $annee ?>"><img width="28" height="28" src="assetss/img/user.jpg"
                                                        class="rounded-circle m-r-5"
                                                        alt=""><?= $annee ?></a></td>



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