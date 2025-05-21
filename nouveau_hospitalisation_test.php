<?php

include('first.php');
include('php/db.php');
include('php/main_side_navbar.php');

$hospitalisation=$_REQUEST['hospitalisation'];
$cas='';
if(($hospitalisation=='0' and $lvl == 3) || ($hospitalisation=='0' and $lvl == 4) || ($hospitalisation=='0' and $lvl == 7)){
    $cas='disabled';
}
?>


    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Nouvelle Hospitalisation</h1>
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
                                <?php
                                if($hospitalisation=='0' and $lvl == 3){
                                echo '<b style="color: red;"> Veillez choisir une chambre !!! </b>';
                            }elseif($hospitalisation !='0' and $lvl == 3){
                                echo '<b style="color: green;"> Chambre choisie !!! </b>';
                            }
                            ?>
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
                                            <form action="save_hospitalisation.php" method="POST">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Patient <span
                                                                        class="text-danger">*</span></label>
                                                            <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBox" >
                                                            <select class="form-control"
                                                                    name="id_patient" id="countries"  <?=$cas?> >
                                                                <option value="0" selected="">
                                                                    ...
                                                                </option>
                                                                <?php

                                                                $iResult = $db->query("SELECT * FROM patient where open_close!=1 ");

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
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Infirmière</label>
                                                            <select class="form-control" name="id_nurse" <?=$cas?> >

                                                                <?php
                                                                if($lvl == 3) {
                                                                    $iResult = $db->query("SELECT * FROM nurse where  id_nurse='$id_perso_session' and open_close!=1 order by nom_n, prenom_n asc ");
                                                                }else {
                                                                    $iResult = $db->query("SELECT * FROM nurse where open_close!=1 ");
                                                                    echo ' <option value="0" selected="">...</option>';
                                                                }

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
                                                            <label>Médecin<span
                                                                        class="text-danger">*</span></label>
                                                            <select class="form-control" name="id_medecin" <?=$cas?> >
                                                                <?php

                                                                if ($lvl == 5) {
                                                                    $iResult = $db->query("SELECT * FROM  medecin where id_medecin='$id_perso_session' and open_close!=1");
                                                                } else {
                                                                    echo '<option value="0" selected="">....</option>';
                                                                    $iResult = $db->query("SELECT * FROM  medecin where open_close!=1");
                                                                }

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
<!--                                                    <div class="col-sm-6">-->
<!--                                                        <div class="form-group">-->
<!--                                                            <label>Service <span-->
<!--                                                                        class="text-danger">*</span></label>-->
<!--                                                            <select class="form-control" name="id_service">-->
<!--                                                                <option value="0" selected="">...</option>-->
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
                                                                        $iResult = $db->query("SELECT * FROM chambres where open_close!=1"); 
                                                                        echo'<option value="0" selected="">...</option>';
                                                                        
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
                                                        <input class="form-control" type="hidden" name="chambre" value="N/A">
                                                    <?php }?>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Type d'hospitalisation <span
                                                                        class="text-danger">*</span></label>
                                                            <select class="form-control" name="id_type_hosp" <?=$cas?> >
                                                                <option value="0" selected="">...</option>
                                                                <?php

                                                                $iResult = $db->query("SELECT * FROM type_hosp where open_close!=1 ");

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
                                                                <select class="form-control" name="lit" <?=$cas?> >
                                                                    <option value="0" selected="">...</option>
                                                                    <?php

                                                                    
                                                                    if($hospitalisation!='0'){
                                                                        $iResult = $db->query("SELECT * FROM lits where etat!=1 and id_chambre='$hospitalisation' and open_close!=1");
                                                                    }else{
                                                                        $iResult = $db->query("SELECT * FROM lits where etat!=1 and  open_close!=1"); 
                                                                    }

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
                                                        <input class="form-control" type="hidden" name="lit" value="0">
                                                    <?php }?>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Nbre de jour <span
                                                                        class="text-danger">*</span></label>
                                                            <input class="form-control" type="number" name="nb_jour" <?=$cas?>>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Date d'entrée</label>
                                                            <div>
                                                                <input type="date" class="form-control" name="date_hosp" <?=$cas?>>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Date de Sortie</label>
                                                            <div>
                                                                <input type="date" class="form-control" name="date_sortie" <?=$cas?>>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="m-t-20 text-center">
                                                    <button class="btn btn-primary submit-btn">Enregistrer</button>
                                                    <a href="<?=$hospitalisation['option2_link']?>" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>

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
  document.getElementById("sum").innerHTML='<a href="save_chambre_lit.php?id='+x+'"><i class="fas fa-check"></i></a>';
                                        }

</script>

    <!--//Footer-->
<?php
include('foot.php');
?>