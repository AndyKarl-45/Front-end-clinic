<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');

?>

<!--Content-->

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><i class="fas fa-users" style="color: silver"></i> Liste des cautions </h1>
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
                                <a class="nav-link active" data-toggle="modal" data-target="#ajouterCaution"
                                    href="#home">
                                    <i class="fas fa-cubes"></i>
                                    Nouvelle caution
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
                                    <th>
                                        <p align="center">Ref. caution</p>
                                    </th>
                                    <th>
                                        <p align="center">patient</p>
                                    </th>
                                    <th>
                                        <p align="center">Montant</p>
                                    </th>
                                    <th>
                                        <p align="center">Date création</p>
                                    </th>
                                    <th>
                                        <p align="center">Date modification</p>
                                    </th>
                                    <th>
                                        <p align="center">Options</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $query = "SELECT * from caution where open_close!=1 order by date_caution, date_modif desc  ";
                                $q = $db->query($query);
                                while ($row = $q->fetch()) {
                                    $id_caution  = $row['id_caution'];
                                    $ref_caution  = $row['ref_caution'];
                                    $id_patient  = $row['id_patient'];
                                    $montant  = $row['montant'];
                                    $date_modif  = $row['date_modif'];
                                    $date_caution  = $row['date_caution'];

                                    $sql = "SELECT DISTINCT * from patient where id_patient = '$id_patient'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        //$nom_patient= $table['nom_p'] . ' ' . $table['prenom_p'];
                                        $nom_patient = $table['ref_patient'];
                                        $age = $table['age_p'];
                                    }

                                    if (empty($id_patient)) {
                                        $nom_patient = 'N/A';
                                    }

                                ?>

                                    <tr>
                                        <td align="center"><b><?= $ref_caution ?></b></td>
                                        <td align="center"><b><?= $nom_patient ?></b></td>
                                        <td align="center"><b><?php echo number_format($montant); ?></b></td>
                                        <td align="center"><?= dateToFrench($date_caution, " j F Y") ?></td>
                                        <td align="center"><?= dateToFrench($date_modif, " j F Y") ?></td>
                                        <td align="center">
                                            <a href="facture_caution.php?id_caution=<?= $id_caution ?>&id_perso=<?= $id_perso_session ?>" target="_blank">
                                                <i class="fa fa-print"></i>
                                            </a>
                                        </td>
                                        <td style="text-align: center">
                                            <?php
                                            echo '<a class="btn btn-warning" data-toggle="modal" data-target="#modifierCaution' . $id_caution . '"  style="background-color: transparent"><i  style="color: orange" class="fas fa-pen"></i></a>';
                                            ?>
                                            <a class="btn btn-danger" href="delete_caution.php?id_caution=<?= $id_caution ?>" style="background-color: transparent; margin-right: 10px;">
                                                <i style="color: red" class="fas fa-trash"></i></a>

                                            <div class="modal fade" id="modifierCaution<?= $id_caution ?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header" style="padding:20px 50px;">
                                                            <h3 align="center"><i class="fas fa-map"></i>
                                                                <b>Modifier</b>
                                                            </h3>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                title="Close">&times;
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="padding:40px 50px;">
                                                            <form class="form-horizontal" action="update_caution.php"
                                                                name="form" method="post">
                                                                <input type="hidden" name="id_perso" value="<?= $id_perso_session ?>">
                                                                <input type="hidden" name="id_caution" value="<?= $id_caution ?>">
                                                                <div class="form-group">
                                                                    <label>Ref_caution :</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="hidden" name="ref_caution" value="<?= $ref_caution ?>">
                                                                        <input type="text" name="nom" class="form-control" value="<?= $ref_caution ?>" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Patient :</label>
                                                                    <div class="col-sm-12">
                                                                        <select class="form-control"
                                                                            name="id_patient">
                                                                            <option value="<?= $id_patient ?>" selected="">
                                                                                <?= $nom_patient ?>
                                                                            </option>
                                                                            <?php

                                                                            $iResult = $db->query("SELECT * FROM patient  where open_close!=1");

                                                                            while ($data = $iResult->fetch()) {

                                                                                $i = $data['id_patient'];
                                                                                echo '<option value ="' . $i . '">';
                                                                                //   echo $data['nom_p'] . ' ' . $data['prenom_p'];
                                                                                echo $data['ref_patient'];
                                                                                echo '</option>';
                                                                            }

                                                                            ?>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>montant :</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="number" name="montant" class="form-control" value="<?= $montant ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <center>
                                                                            <input type="submit" style=" width:25% "
                                                                                name="submit_cs"
                                                                                class="btn btn-primary"
                                                                                value="Modifier">

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
<div class="modal fade" id="ajouterCaution" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding:20px 50px;">
                <h3 align="center"><i class="fas fa-map"></i> <b>Nouvelle Caution</b></h3>
                <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
                <form class="form-horizontal" action="save_caution.php" name="form" method="post">
                    <input type="hidden" name="id_perso" value="<?= $id_perso_session ?>">
                    <div class="form-group">
                        <label>Patient : <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBox">
                            <select class="form-control"
                                name="id_patient" id="countries">
                                <option value="0" selected="">
                                    ...
                                </option>
                                <?php

                                $iResult = $db->query("SELECT * FROM patient  where open_close!=1");

                                while ($data = $iResult->fetch()) {

                                    $i = $data['id_patient'];
                                    echo '<option value ="' . $i . '">';
                                    $nom_patient =  $data['nom_p'] . ' ' . $data['prenom_p'];
                                    echo $nom_patient . '( ' . $data['ref_patient'] . ' )';
                                    echo '</option>';
                                }

                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Montant</label>
                        <div class="col-sm-12">
                            <input type="number" name="montant" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>date Création</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" name="date_caution" value="<?= date('Y-m-d') ?>" disabled>
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
                    title: 'Caution du patient existe déjà ! ',
                    text: 'Vérifier votre liste de caution!',
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