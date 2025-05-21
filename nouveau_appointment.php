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
$query  = "SELECT count(id_app) as total from appointment";
$q = $conn->query($query);
while($row = $q->fetch_assoc())
{
    $total_apt = $row["total"];
}
$id_app = $total_apt + 1;
$ref_app = 'APT_'.$year.'_'.$month.'_'.$day.'_'.$id_app;
?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Nouveau Rendez-vous</h1>
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
                                <fieldset>
                                    <div class="table-responsive">
                                        <div class="col-lg-10 offset-lg-1">
                                            <form action="save_appointment.php" method="POST">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input type="hidden" name="partie" value="1">
                                                            <div class="col">
                                                                <ul class="nav nav-pills">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active" data-toggle="tab" href="#b1">
                                                                            <i class="fas fa-user-md"></i>
                                                                            Patient
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                                <div class="tab-content">
                                                                    <div class="tab-pane  active" id="b1">
                                                                        <span class="help-block small-font" >Patient :</span>
                                                                        <div class="col">
                                                                            <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBox" >
                                                                            <select name="id_patient"   class="form-control" id="countries" >
                                                                                <?php

                                                                                include("SelectClientView.php");

                                                                                ?>
                                                                                <button type="button" style="background-color: transparent; border-radius: 20px; border-color: black; border-bottom-color: yellow; border-top-color: red;
border-right-color: blue;
border-left-color: orange;">
                                                                                    <a href="nouveau_patient.php"><i
                                                                                                class="fas fa-plus"></i></a>
                                                                                </button>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <?php if($lvl == 5){ ?>
                                                                    <ul class="nav nav-pills">
                                                                        <li class="nav-item">
                                                                            <a class="nav-link active" data-toggle="tab" href="#a1">
                                                                                <i class="fas fa-id-card-alt"></i>
                                                                                Médecin
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                    <div class="tab-content">
                                                                        <div class="tab-pane  active" id="a1">
                                                                            <span class="help-block small-font" >Médecin :</span>
                                                                            <input type="hidden" class="form-control" name="id_laboratin" value="0">
                                                                            <input type="hidden" class="form-control" name="id_nurse" value="0">
                                                                            <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxMed" >
                                                                            <select class="form-control" name="id_medecin" id="countriesMed">
                                                                                <?php include("SelectMedecinView.php"); ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                <?php }elseif($lvl == 3){ ?>
                                                                    <ul class="nav nav-pills">
                                                                        <li class="nav-item">
                                                                            <a class="nav-link active" data-toggle="tab" href="#a3">
                                                                                <i class="fas fa-id-card-alt"></i>
                                                                                Infirmière
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                    <div class="tab-content">
                                                                        <div class="tab-pane  active" id="a3">
                                                                            <span class="help-block small-font" >Infirmière :</span>
                                                                            <input type="hidden" class="form-control" name="id_laboratin" value="0">
                                                                            <input type="hidden" class="form-control" name="id_medecin" value="0">
                                                                            <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxInf" >
                                                                            <select name="id_nurse" class="form-control"  id="countriesInf">

                                                                                <?php include("SelectNurseView.php"); ?>
                                                                            </select>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                <?php }elseif($lvl==9){?>
                                                                    <ul class="nav nav-pills">
                                                                        <li class="nav-item">
                                                                            <a class="nav-link active" data-toggle="tab" href="#a2">
                                                                                <i class="fas fa-id-card-alt"></i>
                                                                                Laborantin
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                    <div class="tab-content">
                                                                        <div class="tab-pane  active" id="a2">
                                                                            <span class="help-block small-font" >Technicien :</span>
                                                                        <input type="hidden" class="form-control" name="id_medecin" value="0">
                                                                        <input type="hidden" class="form-control" name="id_nurse" value="0">
                                                                        <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxLab" >

                                                                        <select class="form-control" name="id_laboratin" id="countriesLab">

                                                                            <?php

                                                                            $iResult = $db->query("SELECT * FROM  laboratin where id_laboratin='$id_perso_session'");

                                                                            while ($data = $iResult->fetch()) {

                                                                                $i = $data['id_laboratin'];
                                                                                echo '<option value ="' . $i . '">';
                                                                                echo $data['nom_l'].' '.$data['prenom_l'];
                                                                                echo '</option>';

                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <?php }else{?>
                                                                    <div class="col">

                                                                        <ul class="nav nav-pills">
                                                                            <li class="nav-item">
                                                                                <a class="nav-link active" data-toggle="tab" href="#a1">
                                                                                    <i class="fas fa-user-md"></i>
                                                                                    Médecin
                                                                                </a>
                                                                            </li>
                                                                            <li class="nav-item">
                                                                                <a class="nav-link" data-toggle="tab" href="#a2">
                                                                                    <i class="fas fa-id-card-alt"></i>
                                                                                    Technicien
                                                                                </a>
                                                                            </li>
                                                                            <li class="nav-item">
                                                                                <a class="nav-link" data-toggle="tab" href="#a3">
                                                                                    <i class="fas fa-id-card-alt"></i>
                                                                                    Infirmière
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                        </ul>
                                                                        <div class="tab-content">
                                                                            <div class="tab-pane  active" id="a1">
                                                                                <span class="help-block small-font" >Médecin :</span>
                                                                                <div class="col">
                                                                                    <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxMed" >
                                                                                    <select name="id_medecin"  class="form-control"  id="countriesMed">

                                                                                        <?php include("SelectMedecinView.php"); ?>
                                                                                    </select>
                                                                                    <button type="button" style="background-color: transparent; border-radius: 20px; border-color: black; border-bottom-color: yellow; border-top-color: red;
                                                                    border-right-color: blue;
                                                                    border-left-color: orange;">
                                                                                        <a href="nouveau_medecin.php"><i
                                                                                                    class="fas fa-plus"></i></a>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="tab-pane" id="a2">
                                                                                <span class="help-block small-font" >Technicien :</span>
                                                                                <div class="col">
                                                                                    <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxLab" >
                                                                                    <select name="id_laborantin" class="form-control" id="countriesLab">

                                                                                        <?php include("SelectLaborantinView.php"); ?>

                                                                                    </select>
                                                                                    <button type="button" style="background-color: transparent; border-radius: 20px; border-color: black; border-bottom-color: yellow; border-top-color: red;
                                                                    border-right-color: blue; border-left-color: orange;">
                                                                                        <a href="nouveau_laboratin.php"><i
                                                                                                    class="fas fa-plus"></i></a>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="tab-pane " id="a3">
                                                                                <span class="help-block small-font" >Infirmière :</span>
                                                                                <div class="col">
                                                                                    <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxInf" >
                                                                                    <select name="id_nurse" class="form-control"  id="countriesInf">

                                                                                        <?php include("SelectNurseView.php"); ?>
                                                                                    </select>
                                                                                    <button type="button" style="background-color: transparent; border-radius: 20px; border-color: black; border-bottom-color: yellow; border-top-color: red;
                                                                    border-right-color: blue;
                                                                    border-left-color: orange;">
                                                                                        <a href="nouveau_nurse.php"><i
                                                                                                    class="fas fa-plus"></i></a>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>


                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Departement</label>
                                                            <select class="form-control" name="id_depart">
                                                                <option value="0" selected="">....</option>
                                                                <?php

                                                                $iResult = $db->query("SELECT * FROM departement");

                                                                while ($data = $iResult->fetch()) {

                                                                    $i = $data['id_depart'];
                                                                    echo '<option value ="' . $i . '">';
                                                                    echo $data['nom'];
                                                                    echo '</option>';

                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Code (APT-AAAA-MM-JJ-ID)</label>

                                                            <?php
                                                            echo '<input class="form-control" name="ref_app" type="hidden" value="'.$ref_app.'">';
                                                            echo '<input class="form-control"  class="form-control form-control-lg" value="'.$ref_app.'" disabled >';
                                                            ?>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Date</label>
                                                            <div>
                                                                <input type="date" class="form-control" name="date_app">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Time</label>
                                                            <div>
                                                                <input type="time" class="form-control" name="time_app">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>raison du rendez-vous </label>
                                                    <textarea cols="30" rows="4" class="form-control" name="sms_app"></textarea>
                                                </div>

                                                <div class="m-t-20 text-center">
                                                    <button class="btn btn-primary submit-btn">Enregistrer</button>
                                                    <a href="<?=$appointment['option2_link']?>" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>
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