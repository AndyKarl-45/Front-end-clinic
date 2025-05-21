<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');

?>
<?php
$id_caisse = $_REQUEST['id'];
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
                <h1 class="mt-4"><i class="fas fa-tasks" style="color: silver"></i> Détails: <?= $caisse ?> </h1>
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
                                    <a class="nav-link active" href="etat_print_rap_remise.php?id_caisse=<?= $id_caisse ?>" target="blank" style="margin-right: 20px"><i class="fa fa-print"></i> Imprimer
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
                                        <th>Services</th>
                                        <th class="text-right"><i class="fas fa-bars"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $query = "SELECT * from service order by nom asc";
                                    //  $query = "SELECT * from historique_caisse where id_caisse='$id_caisse'  order by id_hist_caisse desc";
                                    $q = $db->query($query);
                                    while ($row = $q->fetch()) {
                                        // $id_hist_caisse = $row['id_hist_caisse'];
                                        $nom_service = $row['nom'];

                                        if (empty($nom_service)) {
                                            $nom_service = 'N/A';
                                        }

                                        $services = ['regler_consul', 'regler_ecographie', 'regler_examen', 'regler_hosp', 'regler_ope', 'regler_ordo', 'regler_radiologie', 'regler_anesthesie', 'regler_autre']; // Remplacez par vos noms de services

                                        switch ($nom_service) {
                                            case 'consultation';
                                                $table_service = $services[0];
                                                break;
                                            case 'examen';
                                                $table_service = $services[2];
                                                break;
                                            case 'hospitalisation';
                                                $table_service = $services[3];
                                                break;
                                            case 'ordonnance';
                                                $table_service = $services[5];
                                                break;
                                            case 'opération';
                                                $table_service = $services[4];
                                                break;
                                            case 'anesthésie';
                                                $table_service = $services[7];
                                                break;
                                            case 'ecographie';
                                                $table_service = $services[1];
                                                break;
                                            case 'radiologie';
                                                $table_service = $services[6];
                                                break;
                                            case 'autres services';
                                                $table_service = $services[8];
                                                break;
                                        }

                                    ?>

                                        <tr>
                                            <td><a href="details_rap_remise_service.php?id=<?= $id_caisse ?>&service=<?= $table_service ?>"><img width="28" height="28" src="assetss/img/user.jpg"
                                                        class="rounded-circle m-r-5"
                                                        alt=""><?= $nom_service ?></a></td>



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