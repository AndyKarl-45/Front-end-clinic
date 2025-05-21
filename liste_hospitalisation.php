<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');
$todays = date('Y-m-d');

$query  = "SELECT count(id_lit) as total from lits where etat=1 and date_fin < $todays  ";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_lit = $row["total"];
}

?>

<!--Content-->

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><i class="fas fa-users" style="color: silver"></i> Liste des Hospitalisations</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">
                    Hello M/Mme XXX, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                    .

                </li>
            </ol>
            <div class="row">
                <div class="col-xl-12">
                    <?php if ($lvl != 11) { ?>

                        <b>
                            <!-- Nav pills -->
                            <ul class="nav nav-pills" style="float: right;">
                                <li class="nav-item">
                                    <a class="btn btn-primary" href="nouveau_hospitalisation.php?hospitalisation=0">
                                        <i class="fas fa-user"></i>
                                        Nouvelle_hospitalisation
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-pills" style="float: right; margin-right: 20px ;">
                                <li class="nav-item">
                                    <a class="nav-link" href="liste_hospitalisation_checker_review.php">

                                        <?php

                                        echo ' Hospitalisation à régler';

                                        ?>


                                    </a>
                                </li>
                            </ul>

                        </b>
                    <?php } ?>
                    <b>
                        <ul class="nav nav-pills" style="float: right; margin-right: 20px ;">
                            <li class="nav-item">
                                <a class="nav-link" href="liste_hospitalisation_suite.php">

                                    <?php

                                    if ($lvl == 3) {
                                        $query = "SELECT DISTINCT count(id_hosp) as total from hospitalisation WHERE  chambre='N/A' ";
                                    } elseif ($lvl == 5) {
                                        $query = "SELECT DISTINCT count(id_hosp) as total from hospitalisation WHERE id_medecin = '$id_perso_session' and chambre='N/A' ";
                                    } else {
                                        $query = "SELECT DISTINCT count(id_hosp) as total from hospitalisation where  chambre='N/A'  ";
                                    }

                                    $q = $db->query($query);
                                    while ($row = $q->fetch()) {
                                        echo ' Hospitalisation en cours[' . $row['total'] . ']';
                                    }

                                    ?>


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
                                <tr align="center">
                                    <!--                                    <th>Code Patient</th>-->
                                    <th width="20%">Nom du patient</th>
                                    <th>Infimière</th>
                                    <th>Médecin</th>
                                    <th>Type d'hospitalisation</th>
                                    <th>N° chambre</th>
                                    <th>N° lit</th>
                                    <th>Nbre de jour</th>
                                    <th>Date d'entrée</th>
                                    <th>Date de sortie</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($lvl == 5) {
                                    $query = "SELECT * from hospitalisation where id_medecin='$id_perso_session' and chambre !='N/A' and open_close!=1";
                                } else {

                                    $query = "SELECT * from hospitalisation where open_close!=1 and chambre !='N/A'";
                                }


                                $q = $db->query($query);
                                while ($row = $q->fetch()) {
                                    $id_hosp = $row['id_hosp'];
                                    $ref_hosp = $row['ref_hosp'];
                                    $id_patient = $row['id_patient'];
                                    $id_nurse = $row['id_nurse'];
                                    $id_medecin = $row['id_medecin'];
                                    $date_hosp = $row['date_hosp'];
                                    $date_sortie = $row['date_srt_hosp'];
                                    $id_type_hosp = $row['id_type_hosp'];
                                    $lit = $row['lit'];
                                    $nb_jour = $row['nb_jour'];
                                    $chambre = $row['chambre'];


                                    $sql = "SELECT DISTINCT * from patient where id_patient = '$id_patient'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        $nom_patient = $table['nom_p'] . ' ' . $table['prenom_p'];
                                        //$nom_patient= $table['ref_patient'];
                                        $age = $table['age_p'];
                                    }
                                    $sql = "SELECT DISTINCT * from medecin where id_medecin = '$id_medecin'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        $nom_medecin = $table['nom_m'] . ' ' . $table['prenom_m'];
                                    }
                                    $sql = "SELECT DISTINCT * from lits where id_lit = '$lit'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        $nom_lit = $table['nom'];
                                    }



                                    $sql = "SELECT DISTINCT * from nurse where id_nurse = '$id_nurse'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        $nom_nurse = $table['nom_n'] . ' ' . $table['prenom_n'];
                                    }

                                    $sql = "SELECT DISTINCT * from type_hosp where id_type_hosp = '$id_type_hosp'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        $type_hosp = $table['nom'];
                                    }
                                    //                                $sql = "SELECT DISTINCT * from service where id_service = '$id_service'";
                                    //
                                    //                                $stmt = $db->prepare($sql);
                                    //                                $stmt->execute();
                                    //
                                    //                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    //
                                    //                                foreach ($tables as $table) {
                                    //                                    $service= $table['nom'] ;
                                    //                                }
                                    if (empty($id_medecin)) {
                                        $nom_medecin = 'N/A';
                                    }
                                    if (empty($id_nurse)) {
                                        $nom_nurse = 'N/A';
                                    }
                                    if (empty($id_type_hosp)) {
                                        $type_hosp = 'N/A';
                                    }
                                    if (empty($lit)) {
                                        $nom_lit = 'N/A';
                                    }

                                ?>
                                    <tr align="center">
                                        <td><img width="28" height="28" src="assetss/img/user.jpg"
                                                class="rounded-circle m-r-5"
                                                alt=""><?= $nom_patient ?></td>
                                        <td> <?= $nom_nurse ?></td>
                                        <td> <?= $nom_medecin ?></td>
                                        <td> <?= $type_hosp ?></td>
                                        <td> <?= $chambre ?></td>
                                        <td><?= $nom_lit ?></td>
                                        <td><?= $nb_jour ?></td>
                                        <td><?= dateToFrench($date_hosp, " j F Y") ?></td>
                                        <td><?= dateToFrench($date_sortie, " j F Y") ?></td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <!--                                                <a class="dropdown-item" href="#" data-toggle="modal"-->
                                                    <!--                                                   data-target="#delete_patient"><i class="fas fa-random"></i>-->
                                                    <!--                                                    Transférer</a>-->
                                                    <?php if ($lvl == 4 || $lvl == 7 || $lvl == 3 || $lvl == 2) { ?>
                                                        <a class="dropdown-item" href="modifier_hospitalisation.php?id=<?= $id_hosp ?>&hospitalisation=0"><i
                                                                class="fas fa-pen"></i> Edit</a>
                                                    <?php } ?>
                                                    <?php if ($lvl == 4 || $lvl == 7) { ?>
                                                        <a class="dropdown-item" href="delete_hospitalisation.php?id=<?= $id_hosp ?>" onclick="Supp(this.href); return(false);"><i class="fas fa-trash"></i>
                                                            Delete</a>
                                                    <?php } ?>
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
                    text: 'Une erreur s\'est produite !',
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
                    title: 'Oops...',
                    text: 'Nombre de jours ne correspond pas !',
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
                    title: 'Oops...',
                    text: 'Aucun lit ne correspond ! ',
                    footer: 'Reéssayez encore'
                })
            </script>
<?php
            break;
    }
}
?>
<script type="text/javascript">
    function Supp(link) {
        if (confirm('Confirmer  la suppression de l\'hospitalisation ?')) {
            document.location.href = link;
        }
    }
</script>

<!--//Footer-->
<?php
include('foot.php');
?>