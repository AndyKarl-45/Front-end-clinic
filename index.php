<?php

include('first.php');
include('php/main_side_navbar.php');


//Count request
// Count projets
$total_patient = 0;
$total_medecin = 0;
$total_nurse = 0;
$total_laboratin = 0;
$total_fournisseur = 0;
$total_appointment = 0;
$total_chirugien = 0;
$total_produit =0;
$total_consultation=0;
$today = date("Y-m-d");
$today = date("t", strtotime($today));

$query = "SELECT count(id_patient) as total from patient where open_close!=1";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_patient = $row["total"];
}

if($lvl == 5){
    $query = "SELECT count(id_medecin) as totals from medecin where id_medecin='$id_perso_session' and open_close!=1";
}else{
    $query = "SELECT count(id_medecin) as totals from medecin where open_close!=1";
}

$q = $db->query($query);
while($row = $q->fetch())
{
    $total_medecin = $row["totals"];
}

$query = "SELECT count(id_nurse) as total from nurse where open_close!=1";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_nurse = $row["total"];
}

$query = "SELECT count(id_laboratin) as total from laboratin where open_close!=1";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_laboratin = $row["total"];
}

$query = "SELECT count(id_four) as total from fournisseur ";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_fournisseur = $row["total"];
}

if($lvl == 5){
  $query = "SELECT count(id_app) as total from appointment where id_medecin='$id_perso_session' ";
}else{
    $query = "SELECT count(id_app) as total from appointment";
}

$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_appointment = $row["total"];
}


//
$query = "SELECT count(id_chirugien) as total from chirugien where open_close!=1";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_chirugien = $row["total"];
}
//
$query = "SELECT count(id_medi) as total from medicament where open_close!=1";
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_produit = $row["total"];
}

if($lvl == 5){
    $query = "SELECT count(id_con) as total from consultation where id_medecin='$id_perso_session' ";
    $query1 = "SELECT count(id_con) as total from consultation where id_medecin='$id_perso_session' and etat=1 ";
    $query2 = "SELECT count(id_con) as total from consultation where id_medecin='$id_perso_session' and etat=2 ";
}else{
    $query = "SELECT count(id_con) as total from consultation";
    $query1 = "SELECT count(id_con) as total from consultation where etat=1 ";
    $query2 = "SELECT count(id_con) as total from consultation where  etat=2 ";
}
//
$q = $conn->query($query);
while ($row = $q->fetch_assoc()) {
    $total_consultation = $row["total"];
}
$q = $conn->query($query1);
while ($row = $q->fetch_assoc()) {
    $total_parametres = $row["total"];
}
$q = $conn->query($query2);
while ($row = $q->fetch_assoc()) {
    $total_consultation_cours = $row["total"];
}

$total_examen = 0;
if($lvl == 5){
    $query = "SELECT count(id_exa) as total from examen where id_medecin='$id_perso_session' ";
}else{
    $query = "SELECT count(id_exa) as total from examen";
}

$q = $db->query($query);
while($row = $q->fetch())
{
    $total_examen = $row["total"];
}

$total_hosp = 0;
if($lvl == 5){
    $query = "SELECT count(id_hosp) as total from hospitalisation where id_medecin='$id_perso_session' ";
}else{
    $query = "SELECT count(id_hosp) as total from hospitalisation";
}

$q = $db->query($query);
while($row = $q->fetch())
{
    $total_hosp = $row["total"];
}

$total_ope = 0;
if($lvl == 5){
    $query = "SELECT count(id_ope) as total from operation where id_medecin='$id_perso_session' ";
}elseif($lvl == 8){
    $query = "SELECT count(id_ope) as total from operation where id_inter='$id_perso_session' ";
}else{
    $query = "SELECT count(id_ope) as total from operation";
}
$q = $db->query($query);
while($row = $q->fetch())
{
    $total_ope = $row["total"];
}


$total_ordo = 0;
if($lvl == 5){
    $query = "SELECT count(id_ordo) as total from ordonnance where id_medecin='$id_perso_session' ";
}else{
    $query = "SELECT count(id_ordo) as total from ordonnance";
}
$q = $db->query($query);
while($row = $q->fetch())
{
    $total_ordo = $row["total"];
}

$total_app = 0;
if($lvl == 5){
    $query = "SELECT count(id_app) as total from appointment where id_medecin='$id_perso_session' ";
}else{
    $query = "SELECT count(id_app) as total from appointment";
}
$q = $db->query($query);
while($row = $q->fetch())
{
    $total_app = $row["total"];
}
$total_opp = 0;
$query = "SELECT count(id_bloc_ope) as total from bloc_operatoire";
$q = $db->query($query);
while($row = $q->fetch())
{
    $total_opp = $row["total"];
}
$total_sick = 0;
$query = "SELECT count(id_sal_mal) as total from salle_malade";
$q = $db->query($query);
while($row = $q->fetch())
{
    $total_sick = $row["total"];
}
$total_soin = 0;
$query = "SELECT count(id_sal_soin) as total from salle_soin";
$q = $db->query($query);
while($row = $q->fetch())
{
    $total_soin = $row["total"];
}
$total_lits = 0;
$query = "SELECT count(id_lit) as total from lits";
$q = $db->query($query);
while($row = $q->fetch())
{
    $total_lits = $row["total"];
}

$total_chambres = 0;
$query = "SELECT count(id_chambre) as total from chambres";
$q = $db->query($query);
while($row = $q->fetch())
{
    $total_chambres = $row["total"];
}
$total_depart = 0;
$query = "SELECT count(id_depart) as total from departement";
$q = $db->query($query);
while($row = $q->fetch())
{
    $total_depart = $row["total"];
}

/*---------- vérifie si délai d'occupation d'une chambre est passé -------------*/
$date_sortie="";
    $query = "SELECT * from hospitalisation where open_close!=1 and date_srt_hosp!=null";
                                
        $q = $db->query($query);
        while ($row = $q->fetch()) {
        $id_hosp = $row['id_hosp'];
        $ref_hosp = $row['ref_hosp'];
        $date_sortie = $row['date_srt_hosp'];
        $id_type_hosp = $row['id_type_hosp'];
        $lit = $row['lit'];
        $nb_jour = $row['nb_jour'];
        $chambre = $row['chambre'];
        $datetime1="";
        $datetime2="";
        $datetime1 = new DateTime($date_sortie); // Date dans le passé
        $datetime2 = new DateTime(date('Y-m-d'));   // Date du jour (2018-09-07 16:10:21)
        $interval = $datetime1->diff($datetime2);
        $nbjrs = $interval->format('%a');
        
            if($nbjrs>0){
                        $etas=0;
                 $query1 = " UPDATE lits SET  etat=:etat  WHERE id_lit = '$lit'  ";
            
            
                $sql1 = $db->prepare($query1);
            
                // Bind parameters to statement
                $sql1->bindParam(':etat', $etas);
                $sql1->execute();
            }
        }

/*-----------------------------*/

//
//$total_dette = 0;
//$query = "SELECT montant from credit WHERE modalite <> statut ";
//$q = $db->query($query);
//while($row = $q->fetch())
//{
//    $total_dette += $row["montant"];
//}
//
//$total_sortie = 0;
//$query = "SELECT montant from operations_compta WHERE type_oc = 'sortie' AND auteur <> 'special'";
//$q = $db->query($query);
//while($row = $q->fetch())
//{
//    $total_sortie += $row["montant"];
//}


?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Tableau de Bord</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme <?= strtoupper($nom_user); ?>, il est <?= date("G:i"); ?> en ce jour
                        du <?= dateToFrench("now", "l j F Y"); ?>.
                    </li>
                </ol>
                <div class="modal fade" id="listeNotification" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header" style="padding:20px 50px;">
                                <h3 align="center"><i class="fas fa-bell"></i> <b>(6) Notifications : </b></h3>
                                <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
                            </div>
                            <div class="modal-body" style="padding:40px 50px;">
                                <form class="form-horizontal" action="#" name="form" method="#">
                                    
                                    <div class="form-group">
                                        <label>---</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" rows="5"  cols="70">...</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>---</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" rows="5"  cols="70">...</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <center>
                                                <input type="submit" style=" width:25% " name="submit_cs" class="btn btn-primary"
                                                       value="ok">
                
                                                <input data-dismiss="modal" type="text" style=" width:25% " name=""
                                                       class="btn btn-danger" value="Annuler"/></center>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <!------------------------------------------------------------Spécialistes------------------------------------------------------------------->
<?php
                    if($lvl == 3 || $lvl == 4 || $lvl == 5 || $lvl == 8 || $lvl == 9 || $lvl == 7 ){
                    ?>
                <label>
                    <i class="far fa-newspaper"></i>
                    Spécialistes
                </label>
                        <div class="row">
                            <div class="col-md-12">
                                <hr/>
                            </div>
                        </div>
                <div class="row">

                        <?php
                        if( $lvl == 4 || $lvl == 5  || $lvl == 7 ){
                            ?>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_medecin.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF; padding-bottom: 57px;" >
                               <span class="dash-widget-bg3">
            <i class="fa fa-user-md" aria-hidden="true"></i></span> <sup class="badge badge-warning">0</sup>
                                <div class="dash-widget-info text-right" style="float:right;"  >
                                    <h3><?=$total_medecin?></h3>
                                    <span class="widget-title3">Médecins <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>

                            </div>
                        </a>
                    </div>
                            <?php } ?>
                    <?php
                    if($lvl == 3 || $lvl == 4   || $lvl == 7 ){
                    ?>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_nurse.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg4"><i class="fas fa-user-nurse" aria-hidden="true"></i>
                                    <!-- <i class="fa fa-heartbeat fas fa-user-nurse" aria-hidden="true"></i> --></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?=$total_nurse?></h3>
                                    <span class="widget-title4">Infimières(iers) <i class="fa fa-check"
                                                                                    aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                        <?php }?>
                        <?php
                        if( $lvl == 4  || $lvl == 9 || $lvl == 7 ){
                            ?>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_laboratin.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg1"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?=$total_laboratin?></h3>
                                    <span class="widget-title1"><?=$laboratin['title']?><i class="fa fa-check"
                                                                              aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php }?>

                        <?php
                        if( $lvl == 4 ||  $lvl == 8  || $lvl == 7 ){
                            ?>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_chirugien" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg2"><i class="fas fa-id-card-alt"
                                                                 aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?=$total_chirugien?></h3>
                                    <span class="widget-title2">chirugiens<i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php }?>

                </div>
                <?php } ?>

                <!------------------------------------------------------------Pateints----------------------------------------------------------------------->
<?php
                    if( $lvl == 3 || $lvl == 4 || $lvl == 5 || $lvl == 8 || $lvl == 9 || $lvl == 7 || $lvl == 10 || $lvl == 6){
                    ?>
                <label>
                    <i class="far fa-newspaper"></i>
                    Patients/Produits/Fournisseurs
                </label>
                        <div class="row">
                            <div class="col-md-12">
                                <hr/>
                            </div>
                        </div>
                <div class="row">
                        <?php
                        if( $lvl == 3 || $lvl == 4 || $lvl == 5 || $lvl == 8 || $lvl == 9 || $lvl == 7  ){
                            ?>

                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_patient.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg2"><i class="fas fa-user-injured"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $total_patient ?></h3>
                                    <span class="widget-title2">Patients <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                            <?php }?>
<?php
                    if($lvl == 10 || $lvl == 6 || $lvl == 4  || $lvl == 7 ){
                    ?>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_prod.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg3"><i class="fa fa-cubes"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?=$total_produit?></h3>
                                    <span class="widget-title3">Produits <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_four.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg4"><i class="fas fa-shipping-fast"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $total_fournisseur ?></h3>
                                    <span class="widget-title4">Fournisseurs <i class="fa fa-check"
                                                                                aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php } ?>


                </div>
                    <?php } ?>

                <!------------------------------------------------------------Services----------------------------------------------------------------------->
<?php
                    if($lvl == 1 || $lvl == 3 || $lvl == 4 || $lvl == 5  || $lvl == 8 || $lvl == 9 || $lvl == 7 ){
                    ?>
                <label>
                    <i class="far fa-newspaper"></i>
                    Services
                </label>
                        <div class="row">
                            <div class="col-md-12">
                                <hr/>
                            </div>
                        </div>
                <div class="row">
                        <?php
                        if($lvl == 1 || $lvl == 3 || $lvl == 4 || $lvl == 5   || $lvl == 7 ){
                            ?>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_consultation.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg4"><i class="fas fa-heartbeat" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $total_consultation ?></h3>
                                    <span class="widget-title4">Consultations<i class="fa fa-check"
                                                                                aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                        if( $lvl == 3 || $lvl == 4 || $lvl == 5   || $lvl == 7 ){
                            ?>
                            
                            <?php
                        if( $lvl == 4 || $lvl == 5   || $lvl == 7 ){
                            ?>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_con_fabrication.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg1"><i class="fas fa-heartbeat" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $total_consultation_cours ?></h3>
                                    <span class="widget-title1">Consultations en cours<i class="fa fa-check"
                                                                                aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                       <?php } ?>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_con_parametre.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg2"><i class="fas fa-heartbeat" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $total_parametres ?></h3>
                                    <span class="widget-title2">Paramètres<i class="fa fa-check"
                                                                                aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php } ?>
                            <?php }?>
                        <?php
                        if($lvl == 1  || $lvl == 4 || $lvl == 5 || $lvl == 9 || $lvl == 7 ){
                            ?>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_examen.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg1"><i class="fas fa-file-medical-alt" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $total_examen ?></h3>
                                    <span class="widget-title1">Examens<i class="fa fa-check"
                                                                          aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                            <?php }?>
                        <?php
                        if($lvl == 1  || $lvl == 4 || $lvl == 5 || $lvl == 7 ){
                            ?>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

                        <a href="liste_hospitalisation.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg2"><i class="fas fa-procedures"
                                                                 aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $total_hosp ?></h3>
                                    <span class="widget-title2">Hospitalisations<i class="fa fa-check"
                                                                                   aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                        <?php }?>
                        <?php
                        if($lvl == 1  || $lvl == 4 || $lvl == 5 || $lvl == 8 || $lvl == 7 ){
                            ?>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_operation.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg3"><i class="fas fa-check" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $total_ope ?></h3>
                                    <span class="widget-title3">Opérations <i class="fa fa-check"
                                                                              aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                            <?php }?>
                        <?php
                        if($lvl == 1  || $lvl == 4 || $lvl == 5  || $lvl == 7 ){
                            ?>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

                        <a href="liste_ordonnance.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg2"><i class="fas fa-tasks"
                                                                 aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $total_ordo ?></h3>
                                    <span class="widget-title2">Ordonnances<i class="fa fa-check"
                                                                              aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                            <?php }?>
                    <?php
                    if($lvl == 1 || $lvl == 3 || $lvl == 4 || $lvl == 5 || $lvl == 8 || $lvl == 9 || $lvl == 7 ){
                        ?>

                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

                        <a href="liste_appointment.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg1"><i class="fas fa-calendar-alt"
                                                                 aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $total_app ?></h3>
                                    <span class="widget-title1">Rendez-vous<i class="fa fa-check"
                                                                              aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php }?>

                </div>
                <?php }?>

                <!------------------------------------------------------------Agenda------------------------------------------------------------------------>
<?php
if($lvl == 1 || $lvl == 3 || $lvl == 4  || $lvl == 5  || $lvl == 8 || $lvl == 9 || $lvl == 7 ){
    ?>
<!--                <label>-->
<!--                    <i class="far fa-newspaper"></i>-->
<!--                    Agenda-->
<!--                </label>-->
<!--                    <div class="row">-->
<!--                        <div class="col-md-12">-->
<!--                            <hr/>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                <div class="row">-->
<!--                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">-->
<!--                        <a href="liste_appointment.php" style="text-decoration: none; ">-->
<!--                            <div class="dash-widget" style="background-color: #D6DBDF">-->
<!--                                <span class="dash-widget-bg1"><i class="fa fa-stethoscope"-->
<!--                                                                 aria-hidden="true"></i></span>-->
<!--                                <div class="dash-widget-info text-right">-->
<!--                                    <h3>--><?//= $total_appointment?><!-- </h3>-->
<!--                                    <span class="widget-title1">Rendez-vous <i class="fa fa-check"-->
<!--                                                                               aria-hidden="true"></i></span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </a>-->
<!--                    </div>-->
<!--                </div>-->
    <?php }?>

                <!------------------------------------------------------------N/A------------------------------------------------------------------->
                <?php
                    if( $lvl == 4   || $lvl == 7 ){
                    ?>
                <label>
                    <i class="far fa-newspaper"></i>
                    Salles/Blocs
                </label>
                        <div class="row">
                            <div class="col-md-12">
                                <hr/>
                            </div>
                        </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_bloc_operation.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg4"><i class="fas fa-x-ray" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $total_opp?></h3>
                                    <span class="widget-title4">Blocs Opératoire <i class="fa fa-check"
                                                                                    aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_salle_malade.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg3"><i class="fas fa-diagnoses" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $total_sick?></h3>
                                    <span class="widget-title3">Salle des Malades <i class="fa fa-check"
                                                                                     aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_salle_soin.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg2"><i class="fas fa-clinic-medical"
                                                                 aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $total_soin?></h3>
                                    <span class="widget-title2">Salle des soins <i class="fa fa-check"
                                                                                   aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php }?>


                <!------------------------------------------------------------OTHER------------------------------------------------------------------->
<?php
                    if( $lvl == 4   || $lvl == 7 ){
                    ?>
                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>

                <!--               Etat-->
                <label>
                    <i class="far fa-newspaper"></i>
                    Quelques états
                </label>
                        <div class="row">
                            <div class="col-md-12">
                                <hr/>
                            </div>
                        </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_lit.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg1"><i class="fas fa-bed" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $total_lits?></h3>
                                    <span class="widget-title1">Lits <i class="fa fa-check"
                                                                        aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_chambres.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg2"><i class="fas fa-home"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $total_chambres?></h3>
                                    <span class="widget-title2">Chambres <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <a href="liste_departement.php" style="text-decoration: none; ">
                            <div class="dash-widget" style="background-color: #D6DBDF ">
                                <span class="dash-widget-bg3"><i class="fas fa-paste" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <h3><?= $total_depart?></h3>
                                    <span class="widget-title3">Départements <i class="fa fa-check"
                                                                                aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>


                </div>
                <?php } ?>

                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>
<?php
if( $lvl == 4   || $lvl == 7 || $lvl == 2 || $lvl == 11 || $lvl == 12  ){
    ?>

                <label>
                    <i class="far fa-newspaper"></i>
                    Etats trésorerie ( Caisses )
                </label>
                <div class="row">

                    <?php
                    $sum_solde=0;
                    $cnx=0;
                    if($lvl==2 ){
                        $query = "SELECT * from caisse where id_perso='$id_perso_session' order by date_caisse desc limit 16";
                    }elseif($lvl== 4 || $lvl==7 || $lvl == 11 || $lvl == 12 ){
                        $query = "SELECT * from caisse order by date_caisse desc limit 16";
                    }

                    $q = $db->query($query);
                    while ($row = $q->fetch()) {
                        $id_caisse = $row['id_caisse'];
                        $code = $row['code'];
                        $caisse = $row['caisse'];
                        $id_perso = $row['id_perso'];
                        $date_caisse = $row['date_caisse'];
                        $solde = $row['solde'];
                        $sum_solde+=$solde;
                        $cnx++;

                        // $profession = $row['profession'];

                        ?>
                        <div class="col-md-4 col-sm-4  col-lg-3">
                            <div style="background-color: #EFF3F5;" class="profile-widget">
                                <div class="doctor-img">
                                    <?php if($lvl == 2 ){?>
                                        <a class="avatar" href="liste_caisse.php"><i class="fas fa-donate"></i></a>
                                    <?php }else{?>
                                        <a class="avatar" href="liste_add_banque.php"><i class="fas fa-donate"></i></a>
                                    <?php } ?>
                                </div>
                                <div class="dropdown profile-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                       aria-expanded="false"><i
                                                class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <?php 
                                        if($lvl != 12 ){
                                            ?>
                                        }
                                        <a class="dropdown-item" href="modifier_add_caisse.php?id=<?=$id_caisse;?>"><i class="fas fa-pen"></i> Edit</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_doctor"><i
                                                    class="fas fa-trash"></i> Delete</a>
                                                   <?php } ?>
                                    </div>
                                </div>
                                <?php if($lvl == 2 ){?>
                                    <h4 class="doctor-name text-ellipsis"><a href="liste_caisse.php"><?=$caisse?></a></h4>
                                <?php }else{?>
                                    <h4 class="doctor-name text-ellipsis"><a href="liste_add_banque.php"><?=$caisse?></a></h4>
                                <?php } ?>
                                <div class="doc-prof">Responsable:<br><?php


                                    $sql = "SELECT DISTINCT * from personnel where id_personnel = '$id_perso'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        echo $table['nom'].' '.$table['prenom'] ;
                                    }

                                    ?></div>
                                <div class="user-country">
                                    <i class="fas fa-donate"></i> <?= number_format($solde);?>
                                </div>
                            </div>
                        </div>
                    <?php }

                    ?>
                </div>
                
                <?php
                if($cnx==0){
                        echo'
                            <ol class="mb-4" style="
                            padding: 0.75rem 1rem;
                            margin-bottom: 1rem;
                            list-style: none;
                            background-color: #e9ecef;
                            border-radius: 0.25rem;
                            text-align:center;
                        " >
                                <li class="" style="color: #6c757d;">
                                    AUCUN ETAT DE TRESORERIE.
                                </li>
                            </ol>
                            ';
                    }
                if( $lvl == 4   || $lvl == 7  ){
                    ?>
                                <!--               Etat-->
                <label>
                    <i class="far fa-newspaper"></i>
                    Solde Total des caisses
                </label>

                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">
                                <div class="text-center">
                                    <h1><?=number_format($sum_solde)?></h1>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <?php
                                if($lvl == 4 || $lvl == 2 || $lvl == 5){
                                    ?>
                                    <a class="small text-white stretched-link" href="liste_caisse.php">Solde Total des caisses</a>
                                    <?php
                                }else{
                                    ?>
                                    <a class="small text-white stretched-link" href="">Solde Total caisses</a>
                                    <?php
                                }
                                ?>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
                
                
                <?php
                if( $lvl == 4   || $lvl == 7  ){
                    ?>
                
                
                 <label>
                    <i class="far fa-newspaper"></i>
                    Etats trésorerie ( Banques )
                </label>
                <div class="row">

                    <?php
                    $sum_solde_banque=0;
                    $cnxb=0;
                    if($lvl==2 ){
                        $query = "SELECT * from banque where id_perso='$id_perso_session' order by date_banque desc limit 16";
                    }elseif($lvl== 4 || $lvl==7 || $lvl == 11 || $lvl == 12 ){
                        $query = "SELECT * from banque order by date_banque desc limit 16";
                    }

                    $q = $db->query($query);
                    while ($row = $q->fetch()) {
                        $id_banque = $row['id_banque'];
                        $code = $row['code'];
                        $banque = $row['banque'];
                        $id_perso = $row['id_perso'];
                        $date_banque = $row['date_banque'];
                        $solde_banque = $row['solde'];
                        $sum_solde_banque+=$solde_banque;
                        $cnxb++;

                        // $profession = $row['profession'];

                        ?>
                        <div class="col-md-4 col-sm-4  col-lg-3">
                            <div style="background-color: #EFF3F5;" class="profile-widget">
                                <div class="doctor-img">
                                    <?php if($lvl == 2 ){?>
                                        <a class="avatar" href="liste_caisse.php"><i class="fas fa-donate"></i></a>
                                    <?php }else{?>
                                        <a class="avatar" href="liste_add_banque.php"><i class="fas fa-donate"></i></a>
                                    <?php } ?>

                                </div>
                                <div class="dropdown profile-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                       aria-expanded="false"><i
                                                class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <?php 
                                        if($lvl != 12 ){
                                            ?>
                                        }
                                        <a class="dropdown-item" href="modifier_add_banque.php?id=<?=$id_banque;?>"><i class="fas fa-pen"></i> Edit</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_doctor"><i
                                                    class="fas fa-trash"></i> Delete</a>
                                                   <?php } ?>
                                    </div>
                                </div>
                                <?php if($lvl == 2 ){?>
                                    <h4 class="doctor-name text-ellipsis"><a href="liste_caisse.php"><?=$banque?></a></h4>
                                <?php }else{?>
                                    <h4 class="doctor-name text-ellipsis"><a href="liste_add_banque.php"><?=$banque?></a></h4>
                                <?php } ?>

                                <div class="doc-prof">Responsable:<br><?php


                                    $sql = "SELECT DISTINCT * from personnel where id_personnel = '$id_perso'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        echo $table['nom'].' '.$table['prenom'] ;
                                    }

                                    ?></div>
                                <div class="user-country">
                                    <i class="fas fa-donate"></i> <?= number_format($solde_banque);?>
                                </div>
                            </div>
                        </div>
                    <?php }

                    ?>
                </div>
                
                <?php
                if($cnxb==0){
                        echo'
                            <ol class="mb-4" style="
                            padding: 0.75rem 1rem;
                            margin-bottom: 1rem;
                            list-style: none;
                            background-color: #e9ecef;
                            border-radius: 0.25rem;
                            text-align:center;
                        " >
                                <li class="" style="color: #6c757d;">
                                    AUCUN ETAT DE TRESORERIE.
                                </li>
                            </ol>
                            ';
                    }
                    ?>
                
                
                                                <!--               Etat-->
                <label>
                    <i class="far fa-newspaper"></i>
                    Solde Total des banques
                </label>

                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">
                                <div class="text-center">
                                    <h1><?=number_format($sum_solde_banque)?></h1>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <?php
                                if($lvl == 4 || $lvl == 2 || $lvl == 5){
                                    ?>
                                    <a class="small text-white stretched-link" href="liste_caisse.php">Solde Total des banques</a>
                                    <?php
                                }else{
                                    ?>
                                    <a class="small text-white stretched-link" href="">Solde Total banques</a>
                                    <?php
                                }
                                ?>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
<?php } ?>


    </div>
    </main>
    </div>

    <!--//Footer-->
<?php
include('foot.php');
?>