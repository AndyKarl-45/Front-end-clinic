<?php

include('first.php');
include('php/db.php');
include('php/main_side_navbar.php');
$date_demande=date('Y-m-d');
?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Nouvelle Demande de fourniture</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme XXX, il est <?=date("G:i");?> en ce jour du <?=dateToFrench("now","l j F Y");?>.
                    </li>
                </ol>
                <!--                Main Body-->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <form class="form-horizontal" action="save_demande_outil.php" method="POST">
                                <div class="card-header">
                                    <!--  <ul class="nav nav-pills">
                                     <li class="nav-item">
                                        <button type="submit" style=" width:150px;"  name="submit_salle"  class="btn btn-primary" >Enregistrer</button>
                                     </li>
                                 </ul> -->
                                </div>
                                <div class="card-body" >
                                    <fieldset>
                                        <div class="table-responsive">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Auteur</label>
                                                        <?php if($lvl== 4 || $lvl==7){ ?>
                                                             <select class="form-control" name="id_perso">
                                                                
                                                                <?php
                                                                
                                                                $iResult = $db->query("SELECT * FROM personnel where id_personnel='$id_perso_session' ");
                                                                while ($data = $iResult->fetch()) {
    
                                                                    $i = $data['id_personnel'];
                                                                    echo '<option value ="' . $i . '" selected>';
                                                                    echo $data['nom'] . ' ' . $data['prenom'];
                                                                    echo '</option>';
    
                                                                }
                                                                
                                                                $iResult = $db->query("SELECT * FROM personnel ");
                                                                
                                                                while ($data = $iResult->fetch()) {
    
                                                                    $i = $data['id_personnel'];
                                                                    echo '<option value ="' . $i . '">';
                                                                    echo $data['nom'] . ' ' . $data['prenom'];
                                                                    echo '</option>';
    
                                                                }
    
                                                                ?>
                                                            </select>
                                                        <?php } ?>
                                                        <?php if($lvl== 2 || $lvl==6 || $lvl == 10 || $lvl == 11 || $lvl == 12){ ?>
                                                             <select class="form-control" name="id_perso">
                                                                
                                                                <?php
                                                                
                                                                $iResult = $db->query("SELECT * FROM personnel where id_personnel='$id_perso_session' ");
                                                                while ($data = $iResult->fetch()) {
    
                                                                    $i = $data['id_personnel'];
                                                                    echo '<option value ="' . $i . '" selected>';
                                                                    echo $data['nom'] . ' ' . $data['prenom'];
                                                                    echo '</option>';
    
                                                                }
    
                                                                ?>
                                                            </select>
                                                        <?php } ?>
                                                        
                                                        <?php switch ($lvl) {
                                                            case '3';
                                                                ?>
                                                                <select class="form-control" name="id_perso">
                                                                
                                                                    <?php
                                                                    
                                                                    $iResult = $db->query("SELECT * FROM nurse where id_nurse='$id_perso_session' ");
                                                                    
                                                                    while ($data = $iResult->fetch()) {
        
                                                                        $i = $data['id_nurse'];
                                                                        echo '<option value ="' . $i . '">';
                                                                        echo $data['nom_n'] . ' ' . $data['prenom_n'];
                                                                        echo '</option>';
        
                                                                    }
        
                                                                    ?>
                                                                </select>
                                                            
                                                        <?php break;
                                                            case '5';
                                                             ?>
                                                                <select class="form-control" name="id_perso">
                                                                
                                                                    <?php
                                                                    
                                                                    $iResult = $db->query("SELECT * FROM medecin where id_medecin='$id_perso_session' ");
                                                                    
                                                                    while ($data = $iResult->fetch()) {
        
                                                                        $i = $data['id_medecin'];
                                                                        echo '<option value ="' . $i . '">';
                                                                        echo $data['nom_m'] . ' ' . $data['prenom_m'];
                                                                        echo '</option>';
        
                                                                    }
        
                                                                    ?>
                                                                </select>                                                            
                                                            
                                                        <?php break;
                                                            case '8';
                                                             ?>
                                                             
                                                                <select class="form-control" name="id_perso">
                                                                
                                                                    <?php
                                                                   
                                                                    $iResult = $db->query("SELECT * FROM chirugien where id_chirugien='$id_perso_session' ");
                                                                    
                                                                    while ($data = $iResult->fetch()) {
        
                                                                        $i = $data['id_chirugien'];
                                                                        echo '<option value ="' . $i . '">';
                                                                        echo $data['nom_c'] . ' ' . $data['prenom_c'];
                                                                        echo '</option>';
        
                                                                    }
        
                                                                    ?>
                                                                </select>
                                                                
                                                        <?php break;
                                                            case '9';
                                                             ?>
                                                                <select class="form-control" name="id_perso">
                                                                
                                                                    <?php
                                                                   
                                                                    $iResult = $db->query("SELECT * FROM laboratin where id_laboratin='$id_perso_session' ");
                                                                    
                                                                    while ($data = $iResult->fetch()) {
        
                                                                        $i = $data['id_laboratin'];
                                                                        echo '<option value ="' . $i . '">';
                                                                        echo $data['nom_l'] . ' ' . $data['prenom_l'];
                                                                        echo '</option>';
        
                                                                    }
        
                                                                    ?>
                                                                </select>
                                                        
                                                        <?php break;
                                                            } ?>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Date de demande</label>
                                                        <div>
                                                            <input type="hidden" class="form-control " name="date_debut" value="<?=$date_demande?>" >
                                                            <input type="date" class="form-control " name="date_debut" value="<?=$date_demande?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-12">
                                                    <hr/>
                                                </div>
                                            </div>


                                            <div class="card mb-4" style="background-color: silver">
                                                <div class="card-header">
                                                    <i class="fas fa-scroll"></i>
                                                    <b>Liste des fournitures </b>
                                                </div>

                                            </div>

                                            <table  style="background-color: ivory" class="table table-border table-striped custom-table mb-0" id="dataTable">
                                                <thead>
                                                <tr>
                                                    <th>N° Lot</th>
                                                    <!--<th>Code Produit</th>-->
                                                    <th>Nom</th>
                                                    <th>Categorie</th>
                                                    <th>prix unitaire</th>
                                                    <th>Quantités</th>
                                                    <th>Date Péremption</th>
                                                    <th class="text-right">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $i=0;

                                                $query = "SELECT * from magasin_outil where qt_com_outil!=0";
                                                $q = $db->query($query);
                                                while ($row = $q->fetch()) {
                                                    $id_mag_outil = $row['id_mag_outil'];
                                                    $id_outil = $row['id_outil'];
                                                    $qt_com_outil = $row['qt_com_outil'];
                                                    $prix=$row['prix_outil'];
                                                    $id_num_lot_outil=$row['id_num_lot_outil'];
                                                    $date_exp=$row['date_exp'];
                                                    $date_fab=$row['date_fab'];


                                                    $sql = "SELECT DISTINCT * from outil where id_outil = '$id_outil'";

                                                    $stmt = $db->prepare($sql);
                                                    $stmt->execute();

                                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                    foreach ($tables as $table) {
                                                        $ref_outil = $table['ref_outil'];
                                                        $nom_outil= $table['nom_outil'];
                                                        //$prix= $table['prix_unitaire'];
                                                        $id_type_outil= $table['id_type_outil'];
                                                        $prix= $table['prix_unit'];

                                                        $sql = "SELECT DISTINCT * from type_outil where id_type_outil = '$id_type_outil'";

                                                        $stmt = $db->prepare($sql);
                                                        $stmt->execute();

                                                        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                        foreach ($tables as $table) {
                                                            $type_outil= $table['nom'];
                                                        }
                                                    }

                                                    if(empty($id_type_outil)){
                                                        $type_outil='N/A';
                                                    }
                                                    if(empty($id_outil)){
                                                        $nom_outil='N/A';
                                                    }

                                                    ?>


                                                    <tr>
                                                    <td><input type="hidden" name="<?php echo 'id_num_lot_outil['.$i.']';?>" value="<?=$id_num_lot_outil?>"/>
                                                    <a href="#"><i class="fas fa-cubes" aria-hidden="true"></i> <?=$id_num_lot_outil?></a></td>
                                                    <!--<td><a href="#"><?php echo $ref_outil; ?></a></td>-->
                                                    <td><a href="#"><i class="fas fa-cubes" aria-hidden="true"></i> <?=$nom_outil?></a></td>
                                                    <td><a href="#"><?=$type_outil?> </a></td>
                                                    <td><a href="#"><?php echo number_format($prix) ?> </a></td>
                                                    <td><input type="number"  style=" width: 50px; height: 25px" name="<?php echo 'quantite['.$i.']';?>" value="<?=$qt_com_outil?>" min="0" max="<?=$qt_com?>" /></td>
                                                    <td><a href="#"><?=$date_exp?> </a></td>
                                                    <td align="center">
                                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                                            <input type="checkbox"  style=" width: 25px; height: 25px" name="<?php echo 'id_outil['.$i.']';?>" value="<?=$id_outil?>"   />

                                                        </div>



                                                    </td>

                                                </tr>

                                                    <?php $i++; }?>

                                                </tbody>
                                            </table>

                                        </div>
                                    </fieldset>
                                </div>
                                <div class="card-footer">
                                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups" style="float: right;">
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <button type="submit" name="submit_etat_civil" class="btn btn-primary" >Enregistrer</button>
<!--                                            <a href="nouvelle_demande_produit_fin.php" style=" width:150px;" class="btn btn-primary" >Enregistrer</a>-->
                                        </div>
                                        <div class="btn-group mr-2" role="group" aria-label="Second group">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">

                            </div>
                            <div class="card-body">
                                <div class="well bs-component">
                                    <form class="form-horizontal">
                                        <fieldset>
                                            <div class="table-responsive">
                                                <form method="post" action="" >

                                                </form>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                            <div class="card-footer">

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>


    <!--//Footer-->
<?php
include('foot.php');
?>