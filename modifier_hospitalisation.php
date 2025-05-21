<?php

include('first.php');
include('php/db.php');
include('php/main_side_navbar.php');

$hospitalisation=$_REQUEST['hospitalisation'];

if($hospitalisation=='0' and $lvl == 3){
    $cas='disabled';
}else{
    $cas='';
}

?>
<?php
$id_hosp = $_REQUEST['id'];

$query = "SELECT * from hospitalisation where id_hosp='$id_hosp'";
$q = $db->query($query);
while ($row = $q->fetch()) {
    $id_hosp = $row['id_hosp'];
    $ref_hosp = $row['ref_hosp'];
    $id_patient = $row['id_patient'];
    $id_nurse = $row['id_nurse'];
    $id_service = $row['id_service'];
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
      //  $nom_patient= $table['nom_p'] . ' ' . $table['prenom_p'];
        $nom_patient = $table['ref_patient'];
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

    $sql = "SELECT DISTINCT * from type_hosp where id_type_hosp = '$id_type_hosp'";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tables as $table) {
        $type_hosp= $table['nom'] ;
    }
    $sql = "SELECT DISTINCT * from service where id_service = '$id_service'";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tables as $table) {
        $service= $table['nom'] ;
    }
    if(empty($id_medecin)){
        $nom_medecin='N/A';
    }
    if(empty($id_nurse)){
        $nom_nurse='N/A';
    }
    if(empty($id_type_hosp)){
        $type_hosp='N/A';
    }

    ?>
    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Modifier Hospitalisation</h1>
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
                            <?php
                                if($hospitalisation=='0' and $lvl == 3){
                                echo '<b style="color: red;"> Veillez choisir une chambre !!! </b>';
                            }elseif($hospitalisation !='0' and $lvl == 3){
                                echo '<b style="color: green;"> Chambre choisie !!! </b>';
                            }
                            ?>
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
                                            <form action="update_hospitalisation.php" method="POST">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input type="hidden" id="myHosp" name="id_hosp" value="<?=$id_hosp?>">
                                                            <label>Patient <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-control"
                                                                    name="id_patient" <?=$cas?> >
                                                                <option value="<?=$id_patient?>" selected="">
                                                                    <?=$nom_patient?>
                                                                </option>
                                                                <?php

                                                                $iResult = $db->query("SELECT * FROM patient where open_close!=1 ");

                                                                while ($data = $iResult->fetch()) {

                                                                    $i = $data['id_patient'];
                                                                    echo '<option value ="' . $i . '">';
                                                                   // echo $data['nom_p'] . ' ' . $data['prenom_p'];
                                                                    echo $data['ref_patient'];
                                                                    echo '</option>';

                                                                }

                                                                ?>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Infirmière<span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-control" name="id_nurse" <?=$cas?> >
                                                                <option value="<?=$id_nurse?>" selected=""><?=$nom_nurse?></option>
                                                                <?php

                                                                $iResult = $db->query("SELECT * FROM nurse ");

                                                                while ($data = $iResult->fetch()) {

                                                                    $i = $data['id_nurse'];
                                                                    echo '<option value ="' . $i . '">';
                                                                    echo $data['nom_n'] . ' ' . $data['prenom_n'];
                                                                    echo '</option>';

                                                                }

                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Médecin <span
                                                                        class="text-danger">*</span></label>
                                                            <select class="form-control" name="id_medecin" <?=$cas?> >
                                                                <option value="<?=$id_medecin?>" selected=""><?=$nom_medecin?></option>
                                                                <?php

                                                                $iResult = $db->query("SELECT * FROM medecin ");

                                                                while ($data = $iResult->fetch()) {

                                                                    $i = $data['id_medecin'];
                                                                    echo '<option value ="' . $i . '">';
                                                                    echo $data['nom_m'].' '.$data['prenom_m'];
                                                                    echo '</option>';

                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
<!--                                                    <div class="col-sm-6">-->
<!--                                                        <div class="form-group">-->
<!--                                                            <label>Service <span-->
<!--                                                                    class="text-danger">*</span></label>-->
<!--                                                            <select class="form-control" name="id_service">-->
<!--                                                                <option value="--><?//=$id_service?><!--" selected="">--><?//=$service?><!--</option>-->
<!--                                                                --><?php
//
//                                                                $iResult = $db->query("SELECT * FROM service ");
//
//                                                                while ($data = $iResult->fetch()) {
//
//                                                                    $i = $data['id_service'];
//                                                                    echo '<option value ="' . $i . '">';
//                                                                    echo $data['nom'];
//                                                                    echo '</option>';
//
//                                                                }
//                                                                ?>
<!--                                                            </select>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
                                                    <?php if( $lvl == 3 || $lvl == 4 || $lvl == 7){?>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>N° de la Chambre</label>
                                                            <div class="form-group input-group" style="width: 100%">
                                                                <select id="mySelect" class="form-control" name="chambre" onchange="myFunction()" required  >
                                                                
                                                                    
                                                                    <?php
                                                                    
                                                                    if($hospitalisation!='0'){
                                                                        
                                                                        $iResult = $db->query("SELECT * FROM chambres where id_chambre ='$hospitalisation' and open_close!=1 ");
                                                                        
                                                                        while ($data = $iResult->fetch()) {

                                                                        $i = $data['nom'];
                                                                        echo '<option value ="' . $i . '">';
                                                                        echo $data['nom'];
                                                                        echo '</option>';

                                                                    }
                                                                    
                                                                    }else{
                                                                        
                                                                        $iResult = $db->query("SELECT * FROM chambres where id_chambre ='$chambre' and open_close!=1 ");
                                                                        
                                                                        while ($data = $iResult->fetch()) {

                                                                        $i = $data['nom'];
                                                                        echo '<option value ="' . $i . '">';
                                                                        echo $data['nom'];
                                                                        echo '</option>';

                                                                    }
                                                                    
                                                                        $iResult = $db->query("SELECT * FROM chambres where open_close!=1"); 
                                                                        //echo'<option value="0" selected="">...</option>';
                                                                        
                                                                            while ($data = $iResult->fetch()) {
    
                                                                            $i = $data['id_chambre'];
                                                                            echo '<option value ="' . $i . '">';
                                                                            echo $data['nom'];
                                                                            echo '</option>';
    
                                                                        }
                                                                    }

                                                                    
                                                                    ?>
                                                                </select>
                                                                <?php 
                                                                if($hospitalisation=='0'){
                                                                    echo '  <button  style="width: 10%; margin-left:10px" type="button" id="sum" data-toggle="modal"   style="background-color: transparent">';
                                                                        
                                                                        echo '</button>';
                                                                }else{
                                                                    echo'<button type="button" data-toggle="modal"  style="background-color: transparent; border-radius: 20px; border-color: black; border-bottom-color: yellow; border-top-color: red; margin-top: 5px; margin-bottom:  5px; margin-left: 5px;
                                                                    border-right-color: blue;
                                                                    border-left-color: orange;"><a href="nouvelle_chambre.php"><i class="fas fa-plus"></i></a></button>';
                                                                }
            
                                                                ?>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php }else {?>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input class="form-control" type="hidden" name="chambre" value="<?=$chambre?>">
                                                            <input class="form-control" type="text" name="chambre" value="<?=$chambre?>" <?=$cas?> >
                                                        </div>
                                                    </div>
                                                    <?php }?>
                                                    
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Type d'hospitalisation <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-control" name="id_type_hosp" <?=$cas?>>
                                                                <option value="<?=$id_type_hosp?>" selected=""><?=$type_hosp?></option>
                                                                <?php

                                                                $iResult = $db->query("SELECT * FROM type_hosp ");

                                                                while ($data = $iResult->fetch()) {

                                                                    $i = $data['id_type_hosp'];
                                                                    echo '<option value ="' . $i . '">';
                                                                    echo $data['nom'];
                                                                    echo '</option>';

                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <?php if( $lvl == 3 || $lvl == 4 || $lvl == 7){?>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>N° du Lit <span
                                                                            class="text-danger">*</span></label>
                                                                <div class="form-group input-group" style="width: 100%">
                                                                    <select class="form-control" name="lit" <?=$cas?>>
                                                                        <option value="<?=$lit?>" selected=""><?=$lit?></option>
                                                                        <?php

                                                                        $iResult = $db->query("SELECT * FROM lits where id_chambre='$hospitalisation' and etat = 0");

                                                                        while ($data = $iResult->fetch()) {

                                                                            $i = $data['id_lit'];
                                                                            echo '<option value ="' . $i . '">';
                                                                            echo $data['nom'];
                                                                            echo '</option>';

                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <button type="button" data-toggle="modal"  style="background-color: transparent; border-radius: 20px; border-color: black; border-bottom-color: yellow; border-top-color: red; margin-top: 5px; margin-bottom:  5px; margin-left: 5px;
                                                                    border-right-color: blue;
                                                                    border-left-color: orange;"><a href="nouveau_lit.php"><i class="fas fa-plus"></i></a></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php }else {?>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>N° du lit <span class="text-danger">*</span></label>
                                                                <input class="form-control" type="hidden" name="lit" value="<?=$lit?>">
                                                                <input class="form-control" type="text" name="lit" value="<?=$lit?>" <?=$cas?>>
                                                            </div>
                                                        </div>

                                                    <?php }?>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Nbre de jour <span
                                                                    class="text-danger">*</span></label>
                                                            <input class="form-control" type="number" name="nb_jour" value="<?=$nb_jour?>" <?=$cas?>>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Date d'entrée</label>
                                                            <div>
                                                                <input type="date" class="form-control" name="date_hosp" value="<?=$date_hosp?>" <?=$cas?> >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Date de sortie</label>
                                                            <div>
                                                                <input type="date" class="form-control" name="date_sortie" value="<?=$date_sortie?>" <?=$cas?>>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="m-t-20 text-center">
                                                    <button class="btn btn-primary submit-btn">Enregistrer</button>
                                                    <a href="liste_hospitalisation.php" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>

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
    <script> 
    function myFunction() {
      var x = document.getElementById("mySelect").value;
      var y = document.getElementById("myHosp").value;
      document.getElementById("sum").innerHTML='<a href="update_chambre_lit.php?id='+x+'&hosp='+y+'"><i class="fas fa-check"></i></a>';
                                            }
    
    </script>

    <?php
}
    ?>
    <!--//Footer-->
<?php
include('foot.php');
?>