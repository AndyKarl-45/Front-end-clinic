<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');

?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"><i class="fas fa-users" style="color: silver"></i> Liste des autres services en cours de paiement</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme XXX, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                        .

                    </li>
                </ol>
                <div class="row">
                    <div class="col-xl-12">
                        <b>

                            <ul class="nav nav-pills" style="float: right; margin-right: 20px ;">
                                <li class="nav-item">
                                    <a class="btn btn-primary" href="liste_autres_services.php">
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
                                <tr>
<!--                                    <th>Réferences</th>-->
                                    <th width="20%" >Nom du patient</th>
                                    <th>Code Patient</th>
                                    <th>Médecin</th>
                                    <th>Infirmière</th>
                                    <th>Services</th>
                                    <th>Date</th>
                                    <th>Statuts</th>
                                    <th>PDF</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($lvl == 3){
                                    $query = "SELECT * from autre where id_nurse='$id_perso_session' and etat=0";
                                }if($lvl == 5){
                                    $query = "SELECT * from autre where id_medecin='$id_perso_session' and etat=0";
                                }else {

                                    $query = "SELECT * from autre where etat=0";
                                }


                                $q = $db->query($query);
                                while ($row = $q->fetch()) {
                                    $id_autre = $row['id_autre'];
                                    $ref_autre = $row['ref_autre'];
                                    $id_patient = $row['id_patient'];
                                    $id_medecin = $row['id_medecin'];
                                    $id_nurse = $row['id_nurse'];
                                    $date_autre = $row['date_autre'];
                                    $id_autre_service = $row['id_autre_service'];
                                    $etat = $row['etat'];


                                    $sql = "SELECT DISTINCT * from patient where id_patient = '$id_patient'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        $nom_patient_ref= $table['nom_p'] . ' ' . $table['prenom_p'];
                                        $nom_patient= $table['ref_patient'];
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

                                    $sql = "SELECT DISTINCT * from autres_services where id_autre_service = '$id_autre_service'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        $autre= $table['nom'] ;
                                    }
                                    if(empty($id_medecin)){
                                        $nom_medecin='N/A';
                                    }
                                    if(empty($id_autre_service)){
                                        $autre='N/A';
                                    }
                                    if(empty($id_lab)){
                                        $nom_laborantin='N/A';
                                    }

                                    if(empty($id_nurse)){
                                        $nom_nurse='N/A';
                                    }

                                    ?>

                                    <tr>
<!--                                        <td><a href="#">--><?php //=$ref_autre?><!--</a></td>-->
                                        <td><?=$nom_patient_ref?></td>
                                        <td><a href="#"><img width="28" height="28" src="assetss/img/user.jpg"
                                                             class="rounded-circle m-r-5" alt=""><?=$nom_patient?></a></td>
                                        <td><a href="#"><?=$nom_medecin?></a></td>
                                        <td><?=$nom_nurse?></td>
                                        <td align="center"><a
                                                class="btn btn-primary"
                                                href="liste_autre_exa.php?ref_autre=<?=$ref_autre?>"
                                                title="view"
                                                style="background-color: transparent">
                                                <i style="color: green" class="fas fa-eye"></i>
                                            </a></td>
                                        <td><a href="#"><?= dateToFrench($date_autre, " j F Y")?></a></td>
                                        <td>

                                            <?php if($etat!=0)
                                                echo'<span class="custom-badge status-green" >Ok</span>';
                                            else
                                                echo'<span class="custom-badge status-red" >Pas payer</span>';
                                            ?>


                                        </td>
                                        <td align="center"><a href="etat_print_liste_autre.php?ref_exa=<?=$ref_autre?>" target="_blank">
                                                <i class="fa fa-print"></i>
                                            </a></td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                   aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <!--                                                <a class="dropdown-item" href="#" data-toggle="modal"-->
                                                    <!--                                                   data-target="#delete_patient"><i class="fas fa-random"></i>-->
                                                    <!--                                                    Transférer</a>-->
                                                    <!--                                                    <a class="dropdown-item" href="modifier_examen.php?id=--><?//=$id_exa?><!--"><i-->
                                                    <!--                                                            class="fas fa-pen"></i> Edit</a>-->
                                                    <!--                                                    <a class="dropdown-item" href="delete_examen.php?id=--><?//=$id_exa?><!--" onclick="Supp(this.href); return(false);"><i class="fas fa-trash"></i>-->
                                                    <!--                                                        Delete</a>-->
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

    }
}
?>
    <script type="text/javascript">
        function Supp(link){
            if(confirm('Confirmer  la suppression de l\'examen ?')){
                document.location.href = link;
            }
        }
    </script>

    <!--//Footer-->
<?php
include('foot.php');
?>