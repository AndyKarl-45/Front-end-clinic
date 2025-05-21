<?php

include('first.php');
include('php/db.php');
include('php/main_side_navbar.php');

// $query  = "SELECT id_personnel as total from personnel";
// $q = $conn->query($query);
// while($row = $q->fetch_assoc())
// {
//     $total = $row["total"];
// }
// $id_personnel = $total;

?>
<?php
//$ido=$_REQUEST['id'];
//$query  = "SELECT count(id_personnel) as total from personnel where salle=\"SALLE MIMBOMAN\"";
//$q = $conn->query($query);
//while($row = $q->fetch_assoc())
//{
//    $total = $row["total"];
//}
//$totat_personnel = $total;

?>
<?php
$ref_exa=$_REQUEST['ref_exa'];

$query  = "SELECT * from examen where ref_exa='".$ref_exa."'";
$q = $db->query($query);
while($row = $q->fetch())
{
    $id_exa = $row['id_exa'];
    /*-------------------- ETAT --------------------*/

    $ref_exa = $row['ref_exa'];
    $id_patient = $row['id_patient'];
    $id_medecin = $row['id_medecin'];
    $date_exa = $row['date_exa'];
    $id_lab = $row['id_lab'];
    $obs = $row['obs'];
    ?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Détails  Examen :  <?php echo $ref_exa?> </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme XXX, il est <?=date("G:i");?> en ce jour du <?=dateToFrench("now","l j F Y");?>.
                    </li>
                </ol>
                <!--                Main Body-->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <b>
                                    <ul class="nav nav-pills" style="float: right;">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="liste_examen.php">
                                                Retour
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Nav pills -->
                                    <ul class="nav nav-pills">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="pill" href="#home">
                                                <i class="fas fa-cubes"></i>
                                                Détails
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="pill" href="#menu2">
                                                <i class="fas fa-cubes"></i>
                                                <?php

                                                $query = "SELECT  count( DISTINCT id_type_exa) as total from examen_exa where   ref_exam_exa='$ref_exa'  ";
                                                $q = $db->query($query);
                                                while($row = $q->fetch())
                                                {

                                                    echo ' Type d\'examen['.$row['total'].']';
                                                }

                                                ?>

                                            </a>
                                        </li>

                                    </ul>
                                </b>
                            </div>

                            <div class="card-body">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <!--********************************************ETAT CIVILE************************************************* -->
                                    <!-- Etat Civile-->
                                    <div class="tab-pane container active" id="home">
                                        <!-- infos civile-->

                                        <!-- <h5><b><u>NB:</u></b> Aucune information ne peut être modifier.</h5> -->

                                        <div class="row">
                                            <hr/>
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="card mb-4">
                                                    <form class="form-horizontal" action="#" method="POST">
                                                        <div class="card-header">
                                                            <!--  <i class="fas fa-scroll"></i>
                                     <b>L'ensemble des salles de campresj.</b>
                                                                  -->

                                                        </div>
                                                        <div class="card-body">
                                                            <fieldset>
                                                                <div class="table-responsive">
                                                                    <table class="table  table-hover table-condensed" id="myTable">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td style="width: 50%">
                                                                                <span class="help-block small-font" >Patient:</span>
                                                                                <div class="col">
                                                                                    <select name="id_four" style="width:75%;border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" readonly>
                                                                                        <option value="<?=$id_patient?>"selected="">
                                                                                            <?php
                                                                                            $sql = "SELECT DISTINCT * from patient where id_patient= '$id_patient'";

                                                                                            $stmt = $db->prepare($sql);
                                                                                            $stmt->execute();

                                                                                            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                                            foreach($tables as $table)
                                                                                            {
                                                                                                echo strtoupper($table['ref_patient']);
                                                                                            }

                                                                                            ?>

                                                                                        </option>
                                                                                    </select>
                                                                            </td>

                                                                            <td style="width: 50%">
                                                                                <span class="help-block small-font" >Medecin:</span>
                                                                                <div class="col">
                                                                                    <select name="id_four" style="width:75%;border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" readonly>
                                                                                        <option value="<?=$id_medecin?>"selected="">
                                                                                            <?php
                                                                                            $sql = "SELECT DISTINCT * from medecin where id_medecin= '$id_medecin'";

                                                                                            $stmt = $db->prepare($sql);
                                                                                            $stmt->execute();

                                                                                            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                                            foreach($tables as $table)
                                                                                            {
                                                                                                echo strtoupper($table['nom_m'].' '.$table['prenom_m']);
                                                                                            }

                                                                                            ?>

                                                                                        </option>
                                                                                    </select>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="width: 50%">
                                                                                <span class="help-block small-font" >Observation:</span>
                                                                                <div class="col">
                                                                                    <textarea class="form-control" rows="3" name="obs"
                                                                                              cols="30" readonly><?=$obs?></textarea>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <span class="help-block small-font" >Date de création:</span>
                                                                                <div class="col">
                                                                                    <input type="date"
                                                                                           class="form-control" name="date_r_com" value="<?=$date_exa?>" disabled>
                                                                                </div>
                                                                            </td>
                                                                        </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="card-footer">

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--********************************************INFO RH************************************************* -->



                                    <div class="tab-pane container" id="menu2">
                                        <!-- infos civile-->

                                        <!--  <h5><b><u>NB:</u></b> Veillez saisir vos informations concernant le traitement de ressource humaine</h5> -->




                                        <div class="row">
                                            <hr/>
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="card mb-4">
                                                    <div class="card-header">
                                                        <i class="fas fa-scroll"></i>
                                                        <b>L'ensemble des types d'examens.</b>

                                                    </div>
                                                    <div class="card-body">
                                                        <div class="well bs-component">
                                                            <form class="form-horizontal">
                                                                <fieldset>
                                                                    <div class="table-responsive">
                                                                        <form method="post" action="" >
                                                                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                                <thead>
                                                                                <tr class="bg-primary">
                                                                                    <!-- <th><p align="center">Matricule </p></th> -->
                                                                                    <th><p align="center" style="color: white">Types d'examen</p></th>
                                                                                    <th><p align="center" style="color: white">Date</p></th>
                                                                                    <th><p align="center" style="color: white">Prix</p></th>
                                                                                    <th><p align="center" style="color: white">Action</p></th>
                                                                                    <!--                                                                                    <th><p align="center" style="color: white">Remise unitaire</p></th>-->
                                                                                    <!--                                                                                    <th><p align="center" style="color: white">Remise Total</p></th>-->


                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
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




                                                                                    $query = "SELECT * from type_exa where id_type_exa = '$id_type_exa'  ";
                                                                                    $q = $db->query($query);
                                                                                    while($row = $q->fetch())
                                                                                    {

                                                                                        $nom = $row['nom'];
                                                                                        $prix_t_exa= $row['prix_t_exa'];

                                                                                        ?>

                                                                                        <tr>
                                                                                            <input name="id" type="hidden" value="<?php //echo $row['id'];?>" />
                                                                                            <td align="center"> <?php echo $nom; ?>   </td>

                                                                                            <td align="center"><?=$date_exam?> </td>
                                                                                            <td align="center"><?php echo number_format($prix_t_exa) ?>  </td>
                                                                                           <td align="center">
                                                                                               <a class="btn btn-warning" data-toggle="modal" data-target="#modifierExamExa<?=$id_type_exa?>"  title="Modifier"
                                                                                                  style="background-color: transparent">
                                                                                                   <i style="color: orange" class="fas fa-pen"></i>
                                                                                               </a>
                                                                                               <a class="btn btn-danger"  href="delete_exam_exa.php?ref_exa=<?php echo $ref_exa; ?>&id_type_exa=<?=$id_type_exa?>" title="view"
                                                                                                  style="background-color: transparent">
                                                                                                   <i  style="color: red" class="fas fa-trash"></i>
                                                                                               </a>
                                                                                            <div class="modal fade" id="modifierExamExa<?=$id_type_exa?>" role="dialog">
                                                                                                    <div class="modal-dialog">
                                                                                                        <!-- Modal content-->
                                                                                                        <div class="modal-content">
                                                                                                            <div class="modal-header" style="padding:20px 50px;">
                                                                                                                <h3 align="center"><i class="fas fa-map"></i> <b>Type d'examen</b></h3>
                                                                                                                <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
                                                                                                            </div>
                                                                                                            <div class="modal-body" style="padding:40px 50px;">
                                                                                                                <form class="form-horizontal" action="update_exam_exa.php" name="form" method="post">

                                                                                                                    <div class="form-group">
                                                                                                                        <label>Type d'examen:</label>
                                                                                                                        <input  type="hidden" name="ref_exa" value="<?=$ref_exa?>" />
                                                                                                                        <input  type="hidden" name="id_exa" value="<?=$id_exa?>" />
                                                                                                                        <input  type="hidden" name="id_type_exa_last" value="<?=$id_type_exa?>" />
                                                                                                                        <div class="col-sm-12">
                                                                                                                            <select class="form-control"
                                                                                                                                    name="id_type_exa_new">
                                                                                                                                <option value="<?=$id_type_exa?>" selected=""><?=$nom?></option>
                                                                                                                                <?php

                                                                                                                                $iResult = $db->query("SELECT * FROM type_exa where open_close!=1 and id_type_exa!='$id_type_exa' ");

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
                                                                                                                    <div class="form-group">
                                                                                                                        <label>Date d'examen:</label>
                                                                                                                        <div class="col-sm-12">
                                                                                                                            <input class="form-control" type="date" name="date_exam" value="<?=$date_exam?>" />
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="form-group">
                                                                                                                        <div class="col-sm-12">
                                                                                                                            <center>
                                                                                                                                <input type="submit" style=" width:25% " name="submit_cs" class="btn btn-primary"
                                                                                                                                       value="valider">

                                                                                                                                <input data-dismiss="modal" type="text" style=" width:25% " name=""
                                                                                                                                       class="btn btn-danger" value="Annuler"/></center>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </form>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                           </td>
                                                                                        </tr>

                                                                                    <?php }
                                                                                } ?>
                                                                                </tbody>




                                                                                <tfoot>
                                                                                <tr class="bg-primary">
                                                                                    <th><p align="center" style="color: white">Types d'examen</p></th>
                                                                                    <th><p align="center" style="color: white">Date</p></th>
                                                                                    <th><p align="center" style="color: white">Prix</p></th>
                                                                                    <th><p align="center" style="color: white">Action</p></th>
                                                                                    <!--                                                                                    <th><p align="center" style="color: white">Remise unitaire</p></th>-->
                                                                                    <!--                                                                                    <th><p align="center" style="color: white">--><?//=number_format($totaux_r)?><!--</p></th>-->

                                                                                </tr>
                                                                                </tfoot>
                                                                                <tbody></tbody>
                                                                            </table>
                                                                        </form>
                                                                    </div>
                                                                </fieldset>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--****************************************** ............************************************************ -->






                                    <!--****************************************** ............************************************************ -->

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
    <?php
}
?>


    <!--//Footer-->
<?php
include('foot.php');
?>