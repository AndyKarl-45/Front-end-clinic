<?php

include('first.php');
include('php/db.php');
include('php/main_side_navbar.php');


?>
<?php

$id_radiologie=$_REQUEST['id'];

$query = "SELECT * from radiologie where id_radiologie='$id_radiologie'";
$q = $db->query($query);
while ($row = $q->fetch()) {
    $id_radiologie = $row['id_radiologie'];
    $ref_radiologie = $row['ref_radiologie'];
    $id_patient = $row['id_patient'];
    $id_medecin = $row['id_medecin'];
    $date_radiologie = $row['date_radiologie'];
    $id_type_radiologie = $row['id_type_radiologie'];
    $obs = $row['obs'];
    $obs_radiologie = $row['obs_radiologie'];
    $id_radiologue = $row['id_radiologue'];



    $sql = "SELECT DISTINCT * from patient where id_patient = '$id_patient'";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tables as $table) {
       // $nom_patient= $table['nom_p'] . ' ' . $table['prenom_p'];
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

    $sql = "SELECT DISTINCT * from type_radiologie where id_type_radiologie = '$id_type_radiologie'";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tables as $table) {
        $type_radiologie= $table['nom'] ;
    }

    $iResult = $db->query("SELECT * FROM radiologue where id_radiologue='$id_radiologue'");

    while ($data = $iResult->fetch()) {

        $nom_radiologue =$data['nom_r'] . ' ' . $data['prenom_r'];

    }

    if(empty($id_medecin)){
        $nom_medecin='N/A';
    }
    if(empty($id_type_radiologie)){
        $type_exa='N/A';
    }
    if(empty($id_radiologue)){
        $nom_radiologue='N/A';
    }

    ?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Fiche de radiologie</h1>
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
                                    <ul class="nav nav-pills" style="float: right;">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="<?= $radiologie['option2_link'] ?>">

                                                Retour
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Nav pills -->
                                    
                                    <ul class="nav nav-pills">
                                        <?php if($lvl != 9){ $statut1='active'; ?>
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="pill" href="#home">
                                                <i class="fas fa-file-medical-alt"></i>
                                                Radiologie
                                            </a>
                                            
                                        </li>
                                        
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="pill" href="#menu1">
                                                <i class="fas fa-file-medical"></i>
                                                Résultat des Radiologies
                                            </a>
                                        </li>
                                        <?php }else{
                                        $statut2='active'; ?>
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="pill" href="#menu1">
                                                <i class="fas fa-file-medical"></i>
                                                Résultat des Radiologies
                                            </a>
                                        </li>
                                        <?php }?>
                                    </ul>
                                </b>
                            </div>

                            <div class="card-body">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <!-- Etat Civile-->
                                    <div class="tab-pane container <?=$statut1?>" id="home">
                                        <!-- infos civile-->

                                        <div class="row">
                                            <hr/>
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="card mb-4">

                                                    <div class="card-header">

                                                    </div>
                                                    <div class="card-body">
                                                        <fieldset>
                                                            <div class="table-responsive">
                                                                <div class="col-lg-8 offset-lg-2">
                                                                    <form action="update_radiologie.php" method="POST">
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <input type="hidden" name="partie" value="1">
                                                                                    <input type="hidden" name="id_radiologie" value="<?=$id_radiologie?>">
                                                                                    <label>Patient <span
                                                                                            class="text-danger">*</span></label>
                                                                                    <select class="form-control"
                                                                                            name="id_patient">
                                                                                        <option value="<?=$id_patient?>" selected="">
                                                                                            <?=$nom_patient?>
                                                                                        </option>
                                                                                        <?php

                                                                                        $iResult = $db->query("SELECT * FROM patient  where open_close!=1 ");

                                                                                        while ($data = $iResult->fetch()) {

                                                                                            $i = $data['id_patient'];
                                                                                            echo '<option value ="' . $i . '">';
                                                                                            echo $data['nom_p'] . ' ' . $data['prenom_p'];
                                                                                            echo '</option>';

                                                                                        }

                                                                                        ?>

                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>Médecin<span
                                                                                            class="text-danger">*</span></label>
                                                                                    <select class="form-control" name="id_medecin">
                                                                                        <option value="<?=$id_medecin?>" selected=""><?=$nom_medecin?></option>
                                                                                        <?php

                                                                                        $iResult = $db->query("SELECT * FROM medecin ");

                                                                                        while ($data = $iResult->fetch()) {

                                                                                            $i = $data['id_medecin'];
                                                                                            echo '<option value ="' . $i . '">';
                                                                                            echo $data['nom_m'] . ' ' . $data['prenom_m'];
                                                                                            echo '</option>';

                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group" >
                                                                                    <label>Type de radiologie <span
                                                                                            class="text-danger">*</span></label>
                                                                                    <select class="form-control" name="id_type_exa">
                                                                                        <option value="<?=$id_type_radiologie?>" selected=""><?=$type_radiologie?></option>
                                                                                        <?php

                                                                                        $iResult = $db->query("SELECT * FROM type_radiologie ");

                                                                                        while ($data = $iResult->fetch()) {

                                                                                            $i = $data['id_type_radiologie'];
                                                                                            echo '<option value ="' . $i . '">';
                                                                                            echo $data['nom'];
                                                                                            echo '</option>';

                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>Date de la radiologie</label>
                                                                                    <div>
                                                                                        <input type="date"
                                                                                               class="form-control " name="date_exa" value="<?=$date_radiologie?>">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>observation/commentaire</label>
                                                                            <textarea class="form-control" rows="3" name="obs"
                                                                                      cols="30"><?=$obs?></textarea>
                                                                        </div>
                                                                        <div class="m-t-20 text-center">
                                                                            <button class="btn btn-primary submit-btn">Enregistrer</button>
                                                                            <a href="<?=$radiologie['option2_link']?>" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>

                                                                        </div>

                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="card-footer">

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--ETAT ACADEMIQUE -->
                                    <div class="tab-pane container <?=$statut2?>" id="menu1">
                                        <!-- infos civile-->

                                        <div class="row">
                                            <hr/>
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="card mb-4">

                                                    <div class="card-header">

                                                    </div>
                                                    <div class="card-body">
                                                        <fieldset>
                                                            <div class="table-responsive">
                                                                <div class="col-lg-8 offset-lg-2">
                                                                    <form action="update_radiologie.php" method="POST">
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <input type="hidden" name="partie" value="2">
                                                                                    <input type="hidden" name="id_radiologie" value="<?=$id_radiologie?>">
                                                                                    <label>Patient <span
                                                                                            class="text-danger">*</span></label>
                                                                                    <select class="form-control"
                                                                                            name="id_patient">
                                                                                        <option value="<?=$id_patient?>" selected="">
                                                                                            <?=$nom_patient?>
                                                                                        </option>


                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>Radiologue<span
                                                                                            class="text-danger">*</span></label>
                                                                                    <select class="form-control" name="id_radiologue">
                                                                                        <option value="<?=$id_radiologue?>" selected="">
                                                                                            <?=$nom_radiologue?>
                                                                                        <?php

                                                                                        $iResult = $db->query("SELECT * FROM radiologue ");

                                                                                        while ($data = $iResult->fetch()) {

                                                                                            $i = $data['id_radiologue'];
                                                                                            echo '<option value ="' . $i . '">';
                                                                                            echo $data['nom_r'] . ' ' . $data['prenom_r'];
                                                                                            echo '</option>';

                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>Image<span
                                                                                                class="text-danger">*</span></label>
                                                                                    <input type="file" name="fichier_img[]"
                                                                                           style="width:100%"
                                                                                           class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>Fichier<span
                                                                                                class="text-danger">*</span></label>
                                                                                    <input type="file" name="fichier_doc[]"
                                                                                           style="width:100%"
                                                                                           class="form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>observation<span class="text-danger">*</span></label>
                                                                            <textarea class="form-control" rows="20"
                                                                                      cols="70" name="obs_radiologie"><?=$obs_radiologie?></textarea>
                                                                        </div>


                                                                        <div class="m-t-20 text-center">
                                                                            <button class="btn btn-primary submit-btn">Enregistrer</button>
                                                                            <a href="<?=$radiologie['option2_link']?>" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>


                                                                        </div>

                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="card-footer">

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- information RH -->

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


    <!-- <?php }
    ?> -->
    <!--//Footer-->
<?php
include('foot.php');
?>