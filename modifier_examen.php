<?php

include('first.php');
include('php/db.php');
include('php/main_side_navbar.php');


?>
<?php

$id_exa=$_REQUEST['id'];

$query = "SELECT * from examen where id_exa='$id_exa'";
$q = $db->query($query);
while ($row = $q->fetch()) {
    $id_exa = $row['id_exa'];
    $ref_exa = $row['ref_exa'];
    $id_patient = $row['id_patient'];
    $id_medecin = $row['id_medecin'];
    $date_exa = $row['date_exa'];
    $id_type_exa = $row['id_type_exa'];
    $obs = $row['obs'];
    $obs_exa = $row['obs_exa'];
    $id_lab = $row['id_lab'];



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

    $sql = "SELECT DISTINCT * from type_exa where id_type_exa = '$id_type_exa'";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tables as $table) {
        $type_exa= $table['nom'] ;
    }

    $iResult = $db->query("SELECT * FROM laboratin where id_laboratin='$id_lab'");

    while ($data = $iResult->fetch()) {

        $nom_lab =$data['nom_l'] . ' ' . $data['prenom_l'];

    }

    if(empty($id_medecin)){
        $nom_medecin='N/A';
    }
    if(empty($id_type_exa)){
        $type_exa='N/A';
    }
    if(empty($id_lab)){
        $nom_lab='N/A';
    }

    ?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Fiche d'Examen</h1>
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
                                            <a class="nav-link active" href="<?= $examen['option2_link'] ?>">

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
                                                Examen
                                            </a>
                                            
                                        </li>
                                        
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="pill" href="#menu1">
                                                <i class="fas fa-file-medical"></i>
                                                Résultat des Examens
                                            </a>
                                        </li>
                                        <?php }else{
                                        $statut2='active'; ?>
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="pill" href="#menu1">
                                                <i class="fas fa-file-medical"></i>
                                                Résultat des Examens
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
                                                                    <form action="update_examen.php" method="POST">
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <input type="hidden" name="partie" value="1">
                                                                                    <input type="hidden" name="id_exa" value="<?=$id_exa?>">
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
                                                                                    <label>Type d'examen <span
                                                                                            class="text-danger">*</span></label>
                                                                                    <select class="form-control" name="id_type_exa">
                                                                                        <option value="<?=$id_type_exa?>" selected=""><?=$type_exa?></option>
                                                                                        <?php

                                                                                        $iResult = $db->query("SELECT * FROM type_exa ");

                                                                                        while ($data = $iResult->fetch()) {

                                                                                            $i = $data['id_type_exa'];
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
                                                                                    <label>Date de l'examen</label>
                                                                                    <div>
                                                                                        <input type="date"
                                                                                               class="form-control " name="date_exa" value="<?=$date_exa?>">
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
                                                                            <a href="<?=$examen['option2_link']?>" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>

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
                                                    <!--Body Test-->
                                                    <div class="card-body">
                                                         <fieldset>
                                                        <div class="table-responsive">
                                                            <?php
                                                                $totaux=0;
                                                                $totaux_r=0;
                                                                $cnt=0;

                                                                $sql = "SELECT  * from examen_exa where  ref_exam_exa='$ref_exa' ";

                                                                $stmt = $db->prepare($sql);
                                                                $stmt->execute();

                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach($tables as $table)
                                                                {
                                                                    $id_exa= $table['id_exa'];
                                                                    $date_exam= $table['date_exam'];
                                                                    $id_type_exa= $table['id_type_exa'];
                                                                    $id_type_echantillon= $table['id_type_echantillon'];
                                                                    $resultat_exa= $table['resultat_exa'];
                                                                    $remarque= $table['remarque'];
                                                                    $rang= $table['rang'];




                                                                    $query = "SELECT * from type_exa where id_type_exa = '$id_type_exa'";
                                                                    $q = $db->query($query);
                                                                    while($row = $q->fetch())
                                                                    {

                                                                        $nom_type_exa = $row['nom'];
                                                                        $prix_t_exa= $row['prix_t_exa'];
                                                                    }
                                                                    
                                                                    $query = "SELECT * from type_echantillon where id_type_echantillon = '$id_type_echantillon'  ";
                                                                    $q = $db->query($query);
                                                                    while($row = $q->fetch())
                                                                    {

                                                                        $nom_echantillon = $row['nom'];
                                                                    }

                                                                    if(empty($id_type_echantillon)){
                                                                        $nom_echantillon='N/A';
                                                                    }


                                                                        ?>

                                                            <button class="accord"><?=$nom_type_exa?></button>
                                                            <div class="panelle">
                                                                <div class="card-body">
                                                        <fieldset>
                                                            <div class="table-responsive">
                                                                <div class="col-lg-8 offset-lg-2">
                                                                    <form action="update_examen.php" method="POST">
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <input type="hidden" name="partie" value="2">
                                                                                    <input type="hidden" name="id_exa" value="<?=$id_exa?>">
                                                                                    <input type="hidden" name="id_type_exa" value="<?=$id_type_exa?>">
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
                                                                                    <label>Laborantin<span
                                                                                            class="text-danger">*</span></label>
                                                                                    <select class="form-control" name="id_laboratin">
                                                                                        <?php

                                                                                            if ($lvl == 9) {
                                                                                                $iResult = $db->query("SELECT * FROM  laboratin where open_close!=1 and id_laboratin='$id_perso_session'");
                                                                                            } else {
                                                                                                echo '<option value="'.$id_lab.'" selected="">'.$nom_lab.'</option>';
                                                                                                $iResult = $db->query("SELECT * FROM  laboratin where open_close!=1");
                                                                                            }
    
                                                                                            while ($data = $iResult->fetch()) {
    
                                                                                                $i = $data['id_laboratin'];
                                                                                                echo '<option value ="' . $i . '">';
                                                                                                echo $data['nom_l'] . ' ' . $data['prenom_l'];
                                                                                                echo '</option>';
    
                                                                                            }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>Type d'échantillon<span
                                                                                            class="text-danger">*</span></label>
                                                                                    <select class="form-control" name="id_type_echantillon">
                                                                                        <option value="<?=$id_type_echantillon?>" selected="">
                                                                                            <?=$nom_echantillon?></option>
                                                                                        <?php

                                                                                        $iResult = $db->query("SELECT * FROM type_echantillon where open_close!=1 and id_type_echantillon!='$id_type_echantillon' ");

                                                                                        while ($data = $iResult->fetch()) {

                                                                                            $i = $data['id_type_echantillon'];
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
                                                                                    <label>Rang<span
                                                                                            class="text-danger">*</span></label>
                                                                                    <input type="text" name="rang" class="form-control" value="<?=$rang?>">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        
                                                                        <div class="form-group">
                                                                            <label>Résultat:<span class="text-danger">*</span></label>
                                                                            <textarea class="form-control" rows="20"
                                                                                      cols="70" name="resultat_exa"><?=$resultat_exa?></textarea>
                                                                        </div>
                                                                        
                                                                        <div class="form-group">
                                                                            <label>Remarque:</label>
                                                                            <textarea class="form-control" rows="5"
                                                                                      cols="70" name="remarque"><?=$remarque?></textarea>
                                                                        </div>


                                                                        <div class="m-t-20 text-center">
                                                                            <button class="btn btn-primary submit-btn">Enregistrer</button>
                                                                            <a href="<?=$examen['option2_link']?>" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>
                                                                            
                                                                            <a class="btn btn-primary submit-btn" href="document_resultat_exa.php?ref_exa=<?=$ref_exa?>&id_type_exa=<?=$id_type_exa?>" target="_blank">
                                                                                <i class="fa fa-print"></i>
                                                                            </a>


                                                                        </div>

                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                            </div>
                                                            
                                                            <?php 
                                                            } ?>

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
    <script>
    var acc = document.getElementsByClassName("accord");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("activ");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }
</script>
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


    <!-- <?php }
    ?> -->
    <!--//Footer-->
<?php
include('foot.php');
?>