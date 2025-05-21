<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');
$todays=date('Y-m-d');


?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"><i class="fas fa-users" style="color: silver"></i> Liste des vaccinations en cours</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme XXX, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                        .

                    </li>
                </ol>
                <div class="row">
                    <div class="col-xl-12">
                        <?php if ( $lvl !=11 ) { ?>

                            <b>
                                <!-- Nav pills -->
                                <ul class="nav nav-pills" style="float: right;">
                                    <li class="nav-item">
                                        <a class="btn btn-primary" href="nouvelle_vaccination.php">
                                            <i class="fas fa-user"></i>
                                            Nouvelle vaccination
                                        </a>
                                    </li>
                                </ul>

                            </b>
                        <?php } ?>

                        <b>
                            <ul class="nav nav-pills" style="float: right; margin-right: 20px ;">
                                <li class="nav-item">
                                    <a class="btn btn-primary" href="liste_vaccination.php">
                                        <i class="fas fa-cubes"></i>
                                        Retour
                                    </a>
                                </li>
                            </ul>
                        </b>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr/>
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
                                    <th width="20%" >Nom du patient</th>
                                    <th>Age</th>
                                    <th>Infimière</th>
                                    <th>Médecin</th>
                                    <th>Vaccins</th>
                                    <th>Date</th>
                                    <th>Prochain</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($lvl == 3) {
                                    $query = "SELECT * from vaccination where id_nurse='$id_perso_session' and etat!=1 and open_close!=1 ";
                                }elseif ($lvl == 5) {
                                    $query = "SELECT * from vaccination where id_medecin='$id_perso_session' and etat!=1 and open_close!=1 ";
                                } else {

                                    $query = "SELECT * from vaccination where open_close!=1 and etat!=1";
                                }


                                $q = $db->query($query);
                                while ($row = $q->fetch()) {
                                    $id_vac = $row['id_vac'];
                                    $ref_vac = $row['ref_vac'];
                                    $id_patient = $row['id_patient'];
                                    $id_nurse = $row['id_nurse'];
                                    $id_medecin = $row['id_medecin'];
                                    $date_vaccin = $row['date_vaccin'];
                                    $date_next_vaccin = $row['date_next_vaccin'];
                                    $id_type_vaccin = $row['id_type_vaccin'];


                                    $sql = "SELECT DISTINCT * from patient where id_patient = '$id_patient'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        $nom_patient= $table['nom_p'] . ' ' . $table['prenom_p'];
                                        //$nom_patient= $table['ref_patient'];
                                        $age= $table['age_p'];
                                    }
                                    $sql = "SELECT DISTINCT * from medecin where id_medecin = '$id_medecin'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        $nom_medecin= $table['nom_m'] . ' ' . $table['prenom_m'];
                                    }


                                    $sql = "SELECT DISTINCT * from nurse where id_nurse = '$id_nurse'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        $nom_nurse= $table['nom_n'] . ' ' . $table['prenom_n'];
                                    }

                                    $sql = "SELECT DISTINCT * from type_vaccin where id_type_vaccin = '$id_type_vaccin'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        $type_vaccin= $table['nom'] ;
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
                                    if(empty($id_medecin)){
                                        $nom_medecin='N/A';
                                    }
                                    if(empty($id_nurse)){
                                        $nom_nurse='N/A';
                                    }
                                    if(empty($id_type_vaccin)){
                                        $type_hosp='N/A';
                                    }

                                    ?>
                                    <tr align="center">
                                        <td><img width="28" height="28" src="assetss/img/user.jpg"
                                                 class="rounded-circle m-r-5"
                                                 alt=""><?=$nom_patient?></td>
                                        <td> <?=$age?></td>
                                        <td> <?=$nom_nurse?></td>
                                        <td> <?=$nom_medecin?></td>
                                        <td> <?=$type_vaccin?></td>
                                        <td><?= dateToFrench($date_vaccin, " j F Y")?></td>
                                        <td><?= dateToFrench($date_next_vaccin, " j F Y")?></td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                   aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <!--                                                <a class="dropdown-item" href="#" data-toggle="modal"-->
                                                    <!--                                                   data-target="#delete_patient"><i class="fas fa-random"></i>-->
                                                    <!--                                                    Transférer</a>-->
                                                    <?php if ($lvl == 4 || $lvl == 7 || $lvl == 3 || $lvl == 2 ) { ?>
                                                        <a class="dropdown-item" href="modifier_vaccination.php?id=<?=$id_vac?>"><i
                                                                class="fas fa-pen"></i> Edit</a>
                                                    <?php } ?>
                                                    <?php if ($lvl == 4 || $lvl == 7 ) { ?>
                                                        <a class="dropdown-item" href="delete_vaccination.php?id=<?=$id_vac?>" onclick="Supp(this.href); return(false);"><i class="fas fa-trash"></i>
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
                        <hr/>
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
        function Supp(link){
            if(confirm('Confirmer  la suppression de l\'hospitalisation ?')){
                document.location.href = link;
            }
        }
    </script>

    <!--//Footer-->
<?php
include('foot.php');
?>