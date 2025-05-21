<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');

?>

<!--Content-->

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><i class="fas fa-users" style="color: silver"></i> Liste des Radiologies</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">
                    Hello M/Mme XXX, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                    .

                </li>
            </ol>
            <div class="row">
                <div class="col-xl-12">

                    <?php
                    if ($lvl != 9 and $lvl != 11  and $lvl != 14) {
                    ?>
                        <b>
                            <!--Nav pills -->
                            <ul class="nav nav-pills" style="float: right;">
                                <li class="nav-item">
                                    <a class="btn btn-primary" href="nouvelle_radiologie.php">
                                        <i class="fas fa-user"></i>
                                        Nouvelle radiologie
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-pills" style="float: right; margin-right: 20px ;">
                                <li class="nav-item">
                                    <a class="nav-link" href="liste_radiologie_checker_review.php">

                                        <?php

                                        echo ' Radiologie à régler';

                                        ?>


                                    </a>
                                </li>
                            </ul>

                        </b>
                    <?php } ?>

                    <b>
                        <ul class="nav nav-pills" style="float: right; margin-right: 20px ;">
                            <li class="nav-item">
                                <a class="nav-link" href="liste_radiologie_suite.php">

                                    <?php

                                    // if($lvl == 9) {
                                    //     $query = "SELECT DISTINCT count(id_radiologie) as total from radiologie WHERE id_radiologue = '$id_perso_session' and etat=0 ";
                                    // }elseif($lvl == 5) {
                                    //     $query = "SELECT DISTINCT count(id_radiologie) as total from radiologie WHERE id_radiologue = '$id_perso_session' and etat=0 ";
                                    // }else{
                                    if ($lvl == 3) {
                                        $query = "SELECT DISTINCT count(id_radiologie) as total from radiologie WHERE id_nurse = '$id_perso_session' and etat=0 and open_close!=1";
                                    } elseif ($lvl == 5) {
                                        $query = "SELECT DISTINCT count(id_radiologie) as total from radiologie WHERE id_medecin = '$id_perso_session' and etat=0 and open_close!=1";
                                    } else {
                                        $query = "SELECT DISTINCT count(id_radiologie) as total from radiologie where etat=0  ";
                                    }

                                    $q = $db->query($query);
                                    while ($row = $q->fetch()) {
                                        echo ' Radiologie en cours de paiement[' . $row['total'] . ']';
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
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-border table-striped custom-table mb-0" id="dataTable">
                            <thead>
                                <tr>
                                    <!--                                    <th>Réferences</th>-->
                                    <th width="20%">Nom du patient</th>
                                    <th>Code Patient</th>
                                    <th>Médecin</th>
                                    <th>Infirmière</th>
                                    <th>Type de radiologie</th>
                                    <th>Radiologue</th>
                                    <th>Date</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($lvl == 3) {
                                    $query = "SELECT * from radiologie where id_nurse='$id_perso_session' and etat=1";
                                } elseif ($lvl == 9) {
                                    $query = "SELECT * from radiologie where id_radiologue='$id_perso_session' and etat=1";
                                } elseif ($lvl == 5) {
                                    $query = "SELECT * from radiologie where id_medecin='$id_perso_session' and etat=1";
                                } else {

                                    $query = "SELECT * from radiologie where etat=1";
                                }


                                $q = $db->query($query);
                                while ($row = $q->fetch()) {
                                    $id_radiologie = $row['id_radiologie'];
                                    $ref_radiologie = $row['ref_radiologie'];
                                    $id_patient = $row['id_patient'];
                                    $id_medecin = $row['id_medecin'];
                                    $id_nurse = $row['id_nurse'];
                                    $date_radiologie = $row['date_radiologie'];
                                    $id_type_radiologie = $row['id_type_radiologie'];
                                    $id_radiologue = $row['id_radiologue'];


                                    $sql = "SELECT DISTINCT * from patient where id_patient = '$id_patient'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        $nom_patient_ref = $table['nom_p'] . ' ' . $table['prenom_p'];
                                        $nom_patient = $table['ref_patient'];
                                        $age = $table['age_p'];
                                    }



                                    $sql = "SELECT DISTINCT * from medecin where id_medecin = '$id_medecin'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        $nom_medecin = $table['nom_m'] . ' ' . $table['prenom_m'];
                                    }

                                    $sql = "SELECT DISTINCT * from nurse where id_nurse = '$id_nurse'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        $nom_nurse = $table['nom_n'] . ' ' . $table['prenom_n'];
                                    }

                                    $sql = "SELECT DISTINCT * from radiologue where id_radiologue = '$id_radiologue'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        $nom_radiologue = $table['nom_r'] . ' ' . $table['prenom_r'];
                                    }

                                    $sql = "SELECT DISTINCT * from type_radiologie where id_type_radiologie = '$id_type_radiologie'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        $type_exa = $table['nom'];
                                    }
                                    if (empty($id_medecin)) {
                                        $nom_medecin = 'N/A';
                                    }
                                    if (empty($id_type_radiologie)) {
                                        $type_exa = 'N/A';
                                    }
                                    if (empty($id_radiologue)) {
                                        $nom_radiologue = 'N/A';
                                    }
                                    if (empty($id_nurse)) {
                                        $nom_nurse = 'N/A';
                                    }

                                ?>

                                    <tr>
                                        <!--                                    <td>--><?php //=$ref_radiologie
                                                                                        ?><!--</td>-->
                                        <td><?= $nom_patient_ref ?></td>
                                        <td><img width="28" height="28" src="assetss/img/user.jpg"
                                                class="rounded-circle m-r-5" alt=""><?= $nom_patient ?></td>
                                        <td><?= $nom_medecin ?></td>
                                        <td><?= $nom_nurse ?></td>
                                        <td align="center"><a
                                                class="btn btn-primary"
                                                href="liste_radiologie_exa.php?ref_radiologie=<?= $ref_radiologie ?>"
                                                title="view"
                                                style="background-color: transparent">
                                                <i style="color: green" class="fas fa-eye"></i>
                                            </a></td>
                                        <td><?= $nom_radiologue ?></td>
                                        <td><?= dateToFrench($date_radiologie, " j F Y") ?></td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#delete_patient"><i class="fas fa-random"></i>
                                                        Transférer</a>
                                                    <?php if ($lvl != 11  and $lvl != 3) { ?>
                                                        <a class="dropdown-item" href="modifier_radiologie.php?id=<?= $id_radiologie ?>"><i
                                                                class="fas fa-pen"></i> Edit</a>
                                                    <?php } ?>
                                                    <?php if ($lvl == 4 || $lvl == 7) { ?>
                                                        <a class="dropdown-item" href="delete_examen.php?id=<?= $id_radiologie ?>" onclick="Supp(this.href); return(false);"><i class="fas fa-trash"></i>
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
    }
}
?>
<script type="text/javascript">
    function Supp(link) {
        if (confirm('Confirmer  la suppression de la radiologie ?')) {
            document.location.href = link;
        }
    }
</script>

<!--//Footer-->
<?php
include('foot.php');
?>