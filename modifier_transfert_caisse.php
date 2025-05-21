<?php

include('first.php');
include('php/db.php');
include('php/main_side_navbar.php');

?>
<?php

// $total_apt = 0;
// $today = date("Y-m-d");
// $today = date("t", strtotime($today));

$year = (new DateTime())->format("Y");
$month = (new DateTime())->format("m");
$day = (new DateTime())->format("d");

$id_trans_caisse = $_REQUEST['id_trans_caisse'];
$query = "SELECT * from transfert_caisse where id_trans_caisse =$id_trans_caisse  ";


$q = $db->query($query);
while ($row = $q->fetch()) {
    $id_trans_caisse = $row['id_trans_caisse'];
    $id_caisse_src = $row['id_caisse_src'];
    $nom_caisse_src = $row['nom_caisse_src'];

    $nom_caisse_dst = $row['nom_caisse_dst'];
    $id_caisse_dst = $row['id_caisse_dst'];

    $id_perso_dst = $row['id_perso_dst'];
    $etat = $row['etat'];
    $quantite = $row['quantite'];
    $date_trans_caisse = $row['date_trans_caisse'];
}

?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Modifier le transfert : N-<?=$id_trans_caisse?> </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme XXX, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                        .
                    </li>
                </ol>
                <!--                Main Body-->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <b>
                                    <!-- Nav pills -->
                                    <ul class="nav nav-pills">

                                    </ul>
                                </b>
                            </div>

                            <div class="card-body">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <!-- Etat Civile-->


                                    <div class="row">
                                        <div class="col-lg-8 offset-lg-2">
                                            <form action="update_transfert_caisse.php" method="POST">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Caisse source</label>

                                                            <?php
                                                            echo '<input class="form-control"  class="form-control form-control-lg" value="'.$nom_caisse_src.'" disabled >';
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="hidden" name="id_trans_caisse" value="<?=$id_trans_caisse?>">
                                                            <label>Caisse Principale : </label>
                                                            <select name="id_caisse_dst"class="form-control" required>
                                                                <option value="<?=$id_caisse_dst?>" selected=""><?=$nom_caisse_dst?></option>
                                                                <?php

                                                                    $iResult = $db->query("SELECT * FROM caisse where id_caisse!='$id_caisse_src' and  id_caisse!='$id_caisse_dst' and type_caisse='1' and open_close!=1");

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
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Montant</label>
                                                            <div>
                                                                <input type="number" class="form-control" name="montant" value="<?=$quantite?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Patient Email</label>
                                                            <input class="form-control" type="email">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Patient Phone Number</label>
                                                            <input class="form-control" type="text">
                                                        </div>
                                                    </div>
                                                </div> -->
<!--                                                <div class="form-group">-->
<!--                                                    <label>raison du rendez-vous </label>-->
<!--                                                    <textarea cols="30" rows="4" class="form-control" name="sms_app"></textarea>-->
<!--                                                </div>-->

                                                <div class="m-t-20 text-center">
                                                    <button class="btn btn-primary submit-btn">Enregistrer</button>
                                                    <a href="liste_transfert_caisse_suite.php" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="card-footer">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>

            </div>
        </main>
    </div>


    <!--    Modal pour ajouter Categorie Contrat-->


    <!--//Footer-->
<?php
include('foot.php');
?>