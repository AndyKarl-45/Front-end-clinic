<?php

include('first.php');
include('php/db.php');
include('php/main_side_navbar.php');


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
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#home">
                                            <i class="fas fa-file-medical-alt"></i>
                                            Examen
                                        </a>
                                    </li>
                                    <!--<li class="nav-item">-->
                                    <!--    <a class="nav-link" data-toggle="pill" href="#menu1">-->
                                    <!--        <i class="fas fa-file-medical"></i>-->
                                    <!--        Résultat des Examens-->
                                    <!--    </a>-->
                                    <!--</li>-->
                                </ul>
                            </b>
                        </div>

                        <div class="card-body">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!-- Etat Civile-->
                                <div class="tab-pane container active" id="home">
                                    <!-- infos civile-->

                                    <div class="row">
                                        <hr />
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card mb-4">

                                                <div class="card-header">

                                                </div>
                                                <div class="card-body">
                                                    <fieldset>
                                                        <div class="table-responsive">
                                                            <form action="save_examen.php" method="POST" enctype="multipart/form-data">
                                                                <!--                                                                    <div class="col-lg-8 offset-lg-2">-->

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
                                                                                        <span class="help-block small-font">Patient :</span>
                                                                                        <div class="col">
                                                                                            <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBox">
                                                                                            <select name="id_patient" class="form-control" id="countries">
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
                                                                                <?php if ($lvl == 5) { ?>
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
                                                                                            <span class="help-block small-font">Médecin :</span>
                                                                                            <input type="hidden" class="form-control" name="id_nurse" value="0">
                                                                                            <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxMed">
                                                                                            <select class="form-control" name="id_medecin" id="countriesMed">
                                                                                                <?php include("SelectMedecinView.php"); ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php } elseif ($lvl == 3) { ?>
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
                                                                                            <span class="help-block small-font">Infirmière :</span>
                                                                                            <input type="hidden" class="form-control" name="id_medecin" value="0">
                                                                                            <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxInf">
                                                                                            <select name="id_nurse" class="form-control" id="countriesInf">

                                                                                                <?php include("SelectNurseView.php"); ?>
                                                                                            </select>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>

                                                                                <?php } else { ?>
                                                                                    <div class="col">

                                                                                        <ul class="nav nav-pills">
                                                                                            <li class="nav-item">
                                                                                                <a class="nav-link active" data-toggle="tab" href="#a1">
                                                                                                    <i class="fas fa-user-md"></i>
                                                                                                    Médecin
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
                                                                                                <span class="help-block small-font">Médecin :</span>
                                                                                                <div class="col">
                                                                                                    <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxMed">
                                                                                                    <select name="id_medecin" class="form-control" id="countriesMed">

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
                                                                                            <div class="tab-pane " id="a3">
                                                                                                <span class="help-block small-font">Infirmière :</span>
                                                                                                <div class="col">
                                                                                                    <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxInf">
                                                                                                    <select name="id_nurse" class="form-control" id="countriesInf">

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
                                                                <div class="form-group">
                                                                    <label>observation/commentaire</label>
                                                                    <textarea class="form-control" rows="3" name="obs"
                                                                        cols="30"></textarea>
                                                                </div>



                                                                <!--                                                                    </div>-->
                                                                <!--/// -->
                                                                <div class="card mb-4">
                                                                    <div class="card-header">
                                                                        <i class="fas fa-scroll"></i>
                                                                        <b>Liste des medicaments </b>
                                                                    </div>
                                                                </div>
                                                                <div class="table-responsive">
                                                                    <table class="table table-border table-striped custom-table mb-0" id="TableIDExa">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>...</th>
                                                                                <th>Type d'examen</th>
                                                                                <!--<th>Date d'examen</th>-->
                                                                                <th>Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="search-group" id="search-group-0">
                                                                                <td><input type="checkbox" style=" width: 25px; height: 25px" name="id_mat" multiple></td>
                                                                                <td>
                                                                                    <input type="search" id="searchBoxTypeExa-0" class="form-control " placeholder="barre de recherche..." spellcheck="false">
                                                                                    <select class="form-control " id="countriesTypeExa-0"
                                                                                        name="id_type_exa[]">
                                                                                        <?php

                                                                                        $query = "SELECT * FROM type_exa where open_close!=1 order by nom asc";
                                                                                        $q = $db->query($query);
                                                                                        while ($row = $q->fetch()) {
                                                                                            $id_type_exa = $row['id_type_exa'];
                                                                                            $nom = $row['nom'];
                                                                                            $prix_t_exa = $row['prix_t_exa'];

                                                                                            echo '<option value ="' . $id_type_exa . '">';
                                                                                            echo $row['nom'] . ' (' . $prix_t_exa . ') FCFA';
                                                                                            echo '</option>';
                                                                                        }

                                                                                        ?>

                                                                                    </select>
                                                                                </td>
                                                                                <!--<td><input type="date" class="form-control" style=" width: 150px; height: 25px" name="date_exam[]"   multiple></td>-->
                                                                                <td>
                                                                                    <a type="button" onclick="addRow('TableIDExa')"
                                                                                        class="btn btn-primary"
                                                                                        title="view"
                                                                                        style="background-color: transparent">
                                                                                        <i style="color: green" class="fas fa-plus"></i>
                                                                                    </a>
                                                                                    <a class="btn btn-danger" type="button" onclick="deleteRow('TableIDExa')"
                                                                                        title="supprimer"
                                                                                        style="background-color: transparent">
                                                                                        <i style="color: red" class="fas fa-trash"></i>
                                                                                    </a>

                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>



                                                                <div class="m-t-20 text-center">
                                                                    <button class="btn btn-primary submit-btn">Enregistrer</button>
                                                                    <a href="<?= $examen['option2_link'] ?>" style=" width:150px;" class="btn btn-danger">
                                                                        <font>Annuler</font>
                                                                    </a>

                                                                </div>
                                                            </form>
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
                                <div class="tab-pane container" id="menu1">
                                    <!-- infos civile-->

                                    <div class="row">
                                        <hr />
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
                                                                <form action="save_examen.php" method="POST">
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <input type="hidden" name="partie" value="2">
                                                                                <label>Patient <span
                                                                                        class="text-danger">*</span></label>
                                                                                <select class="form-control"
                                                                                    name="id_patient">
                                                                                    <option value="0" selected="">
                                                                                        ...
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
                                                                                <label>Laborantin<span
                                                                                        class="text-danger">*</span></label>
                                                                                <select class="form-control" name="id_laboratin">
                                                                                    <option value="0" selected="">
                                                                                        ...
                                                                                    </option>
                                                                                    <?php

                                                                                    $iResult = $db->query("SELECT * FROM laboratin ");

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
                                                                                <label>Fichier<span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="file" name="fichier[]"
                                                                                    style="width:100%"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>observation<span class="text-danger">*</span></label>
                                                                        <textarea class="form-control" rows="20"
                                                                            cols="70" name="obs_exa"></textarea>
                                                                    </div>


                                                                    <div class="m-t-20 text-center">
                                                                        <button class="btn btn-primary submit-btn">Enregistrer</button>
                                                                        <a href="<?= $examen['option2_link'] ?>" style=" width:150px;" class="btn btn-danger">
                                                                            <font>Annuler</font>
                                                                        </a>


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
                    <hr />
                </div>
            </div>

        </div>
    </main>
</div>


<!-- <?php


        //include("ajouter_profession.php");


        ?> -->
<!--//Footer-->


<?php
include('foot.php');
?>