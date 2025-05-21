<?php

include('first.php');
include('php/db.php');
include('php/main_side_navbar.php');
$ref_ordo = $_REQUEST['ref_ordo'];
$id_agent = $_REQUEST['id_agent'];
$act1 = 'active';
$act2 = $act3 = '';
if (isset($_REQUEST['id_patient']) and isset($_REQUEST['id_agent']) and isset($_REQUEST['agent'])) {
    $id_patient = $_REQUEST['id_patient'];
    $id_agent = $_REQUEST['id_agent'];
    $agent = $_REQUEST['agent'];

    switch ($agent) {
        case 'M';
            $act1 = 'active';
            $act2 = $act3 = '';
            break;
        case 'P';
            $act2 = 'active';
            $act1 = $act3 = '';
            break;
        case 'I';
            $act3 = 'active';
            $act2 = $act1 = '';
            break;
    }
}



$somme_total = 0;
$somme_total = 0;

?>

<!--Content-->

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Fiche d'Ordonnance</h1>
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
                                        <a class="nav-link active" href="<?= $ordonnance['option2_link'] ?>">

                                            Retour
                                        </a>
                                    </li>
                                </ul>
                                <!-- Nav pills -->
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#home">
                                            <i class="fas fa-file-medical-alt"></i>
                                            Examination
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#menu1">
                                            <i class="fas fa-file-medical"></i>
                                            Observations
                                        </a>
                                    </li>
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

                                                            <div class="card mb-4">
                                                                <form action="ajouter_ordonnance.php?ref_ordos=<?= $ref_ordo ?>" method="POST" enctype="multipart/form-data">
                                                                    <input type="hidden" class="form-control" name="id_agent" value="<?= $id_agent ?>">

                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <hr />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <input type="hidden" class="form-control" name="ref_ordo" value="<?= $ref_ordo ?>">

                                                                        <div class="col-sm-6">
                                                                            <!--                                                                            <div class="form-group">-->
                                                                            <!--                                                                                <label>Patient <span-->
                                                                            <!--                                                                                            class="text-danger">*</span></label>-->
                                                                            <!--                                                                                <select class="form-control"-->
                                                                            <!--                                                                                        name="id_patient">-->
                                                                            <!--                                                                                    <option value="0" selected="">-->
                                                                            <!--                                                                                        ...-->
                                                                            <!--                                                                                    </option>-->
                                                                            <!--                                                                                    --><?php
                                                                                                                                                                        //
                                                                                                                                                                        //                                                                                    $iResult = $db->query("SELECT * FROM patient where open_close!=1 ");
                                                                                                                                                                        //
                                                                                                                                                                        //                                                                                    while ($data = $iResult->fetch()) {
                                                                                                                                                                        //
                                                                                                                                                                        //                                                                                        $i = $data['id_patient'];
                                                                                                                                                                        //                                                                                        echo '<option value ="' . $i . '">';
                                                                                                                                                                        //                                                                                     //   echo $data['nom_p'] . ' ' . $data['prenom_p'];
                                                                                                                                                                        //                                                                                        echo $data['ref_patient'];
                                                                                                                                                                        //                                                                                        echo '</option>';
                                                                                                                                                                        //
                                                                                                                                                                        //                                                                                    }
                                                                                                                                                                        //
                                                                                                                                                                        //                                                                                    
                                                                                                                                                                        ?>
                                                                            <!---->
                                                                            <!--                                                                                </select>-->
                                                                            <!--                                                                            </div>-->
                                                                            <div class="col">
                                                                                <div class="form-group">

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
                                                                                                        if (empty($id_patient)) {

                                                                                                            include("SelectClientView.php");
                                                                                                        } else {
                                                                                                            $iResult = $db->query("SELECT * FROM patient where id_patient='$id_patient' and open_close!=1");

                                                                                                            while ($data = $iResult->fetch()) {

                                                                                                                $i = $data['id_patient'];
                                                                                                                echo '<option value ="' . $i . '">';
                                                                                                                //   echo $data['nom_p'] . ' ' . $data['prenom_p'];
                                                                                                                echo $data['ref_patient'] . '( ' . $data['nom_p'] . ' ' . $data['prenom_p'] . ' )';
                                                                                                                echo '</option>';
                                                                                                            }
                                                                                                        }


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
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="col">
                                                                                <div class="form-group">
                                                                                    <?php if ($lvl == 3) { ?>
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
                                                                                                <input type="hidden" class="form-control" name="id_pharmacien" value="0">
                                                                                                <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxInf">
                                                                                                <select name="id_nurse" class="form-control" id="countriesInf">

                                                                                                    <?php include("SelectNurseView.php"); ?>
                                                                                                </select>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>

                                                                                    <?php } elseif ($lvl == 5) { ?>
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
                                                                                                <input type="hidden" class="form-control" name="id_pharmacien" value="0">
                                                                                                <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxMed">
                                                                                                <select class="form-control" name="id_medecin" id="countriesMed">
                                                                                                    <?php include("SelectMedecinView.php"); ?>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php } elseif ($lvl == 10) { ?>
                                                                                        <input type="hidden" class="form-control" name="id_medecin" value="0">
                                                                                        <input type="hidden" class="form-control" name="id_nurse" value="0">
                                                                                        <label>Pharmacien<span
                                                                                                class="text-danger">*</span></label>
                                                                                        <select class="form-control" name="id_pharmacien">
                                                                                            <?php include("SelectPharmacienView.php"); ?>
                                                                                        </select>

                                                                                    <?php } else { ?>
                                                                                        <div class="col">

                                                                                            <ul class="nav nav-pills">
                                                                                                <li class="nav-item">
                                                                                                    <a class="nav-link <?= $act1 ?>" data-toggle="tab" href="#a1">
                                                                                                        <i class="fas fa-user-md"></i>
                                                                                                        Médecin
                                                                                                    </a>
                                                                                                </li>
                                                                                                <li class="nav-item">
                                                                                                    <a class="nav-link <?= $act2 ?>" data-toggle="tab" href="#a2">
                                                                                                        <i class="fas fa-id-card-alt"></i>
                                                                                                        Pharmacien
                                                                                                    </a>
                                                                                                </li>
                                                                                                <li class="nav-item">
                                                                                                    <a class="nav-link <?= $act3 ?>" data-toggle="tab" href="#a3">
                                                                                                        <i class="fas fa-id-card-alt"></i>
                                                                                                        Infirmière
                                                                                                    </a>
                                                                                                </li>
                                                                                            </ul>
                                                                                            </ul>
                                                                                            <div class="tab-content">
                                                                                                <div class="tab-pane  <?= $act1 ?>" id="a1">
                                                                                                    <span class="help-block small-font">Médecin :</span>
                                                                                                    <div class="col">
                                                                                                        <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxMed">
                                                                                                        <select name="id_medecin" class="form-control" id="countriesMed">

                                                                                                            <?php
                                                                                                            $ext = "E";
                                                                                                            if ($agent != 'M') {
                                                                                                                echo '<option value="0" selected>...</option>';
                                                                                                                $iResult = $db->query('SELECT * FROM medecin where   open_close!=1');
                                                                                                            } else {
                                                                                                                $iResult = $db->query("SELECT * FROM medecin where  id_medecin='$id_agent' and open_close!=1");
                                                                                                            }

                                                                                                            while ($data = $iResult->fetch()) {

                                                                                                                $i = $data['id_medecin'];
                                                                                                                echo '<option value ="' . $i . '">';
                                                                                                                echo $data['nom_m'] . ' ' . $data['prenom_m'];
                                                                                                                echo '</option>';
                                                                                                            }
                                                                                                            ?>
                                                                                                        </select>
                                                                                                        <button type="button" style="background-color: transparent; border-radius: 20px; border-color: black; border-bottom-color: yellow; border-top-color: red;
border-right-color: blue;
border-left-color: orange;">
                                                                                                            <a href="nouveau_medecin.php"><i
                                                                                                                    class="fas fa-plus"></i></a>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="tab-pane <?= $act2 ?>" id="a2">
                                                                                                    <span class="help-block small-font">Pharmacien :</span>
                                                                                                    <div class="col">
                                                                                                        <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxPhar">
                                                                                                        <select name="id_pharmacien" class="form-control" id="countriesPhar">

                                                                                                            <?php
                                                                                                            if ($agent != 'P') {
                                                                                                                echo '<option value="0" selected>...</option>';
                                                                                                                $iResult = $db->query("SELECT * FROM  users where lvl=10 and statut='A' ");
                                                                                                            } else {
                                                                                                                $iResult = $db->query("SELECT * FROM  users where id_perso='$id_agent' and statut='A'");
                                                                                                            }



                                                                                                            while ($data = $iResult->fetch()) {

                                                                                                                $id_perso = $data['id_perso'];
                                                                                                                // echo '<option value ="' . $i . '">';
                                                                                                                // echo $data['nom'] . ' ' . $data['prenom'];
                                                                                                                // echo '</option>';

                                                                                                                $sql = "SELECT DISTINCT * from personnel where id_personnel = '$id_perso'";

                                                                                                                $stmt = $db->prepare($sql);
                                                                                                                $stmt->execute();

                                                                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                                                                foreach ($tables as $table) {
                                                                                                                    $i = $table['id_perso'];
                                                                                                                    echo '<option value ="' . $i . '">';
                                                                                                                    echo $table['nom'] . ' ' . $table['prenom'];
                                                                                                                    echo '</option>';
                                                                                                                }
                                                                                                            }
                                                                                                            ?>
                                                                                                        </select>
                                                                                                        <button type="button" style="background-color: transparent; border-radius: 20px; border-color: black; border-bottom-color: yellow; border-top-color: red;
border-right-color: blue; border-left-color: orange;">
                                                                                                            <a href="nouveau_personnel.php"><i
                                                                                                                    class="fas fa-plus"></i></a>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="tab-pane <?= $act3 ?>" id="a3">
                                                                                                    <span class="help-block small-font">Infirmière :</span>
                                                                                                    <div class="col">
                                                                                                        <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxInf">
                                                                                                        <select name="id_nurse" class="form-control" id="countriesInf">

                                                                                                            <?php
                                                                                                            if ($agent != 'I') {
                                                                                                                echo '<option value="0" selected>...</option>';
                                                                                                                $iResult = $db->query('SELECT * FROM nurse where   open_close!=1');
                                                                                                            } else {
                                                                                                                $iResult = $db->query("SELECT * FROM nurse where id_nurse='$id_agent' and  open_close!=1");
                                                                                                            }



                                                                                                            while ($data = $iResult->fetch()) {

                                                                                                                $i = $data['id_nurse'];
                                                                                                                echo '<option value ="' . $i . '">';
                                                                                                                echo $data['nom_n'] . ' ' . $data['prenom_n'];
                                                                                                                echo '</option>';
                                                                                                            }
                                                                                                            ?>
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
                                                                        <div class="col-sm-6">
                                                                            <div class="col">
                                                                                <div class="form-group">

                                                                                    <div class="col">
                                                                                        <div class="tab-content">
                                                                                            <span class="help-block small-font">Médicament ( Nom - Q: stock - P: (prix) ) :</span>
                                                                                            <div class="col">
                                                                                                <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxMedoc">
                                                                                                <select name="id_medis" class="form-control" id="countriesMedoc">
                                                                                                    <?php include("SelectMedicamentView.php"); ?>
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

                                                                                    <div class="col">
                                                                                        <div class="tab-content">
                                                                                            <!--                                                                                                <div class="tab-pane" id="#">-->
                                                                                            <span class="help-block small-font">Quantité(s)</span>
                                                                                            <div class="col">
                                                                                                <input type="number" class="form-control" name="qte" value="0" min="0">

                                                                                            </div>
                                                                                            <!--                                                                                                </div>-->
                                                                                        </div>

                                                                                    </div>


                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="col">
                                                                                <div class="form-group">

                                                                                    <div class="col">
                                                                                        <div class="tab-content">
                                                                                            <!--                                                                                                <div class="tab-pane" id="#">-->
                                                                                            <span class="help-block small-font">Posologie</span>
                                                                                            <div class="col">
                                                                                                <textarea class="form-control" rows="2" name="<?php echo 'poso'; ?>"
                                                                                                    cols="20"></textarea>

                                                                                            </div>
                                                                                            <!--                                                                                                </div>-->
                                                                                        </div>

                                                                                    </div>


                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="col">
                                                                                <div class="form-group">

                                                                                    <div class="col">
                                                                                        <div class="tab-content">
                                                                                            <!--                                                                                                <div class="tab-pane" id="#">-->
                                                                                            <span class="help-block small-font">Traitement</span>
                                                                                            <div class="col">
                                                                                                <textarea class="form-control" rows="2" name="<?php echo 'traite'; ?>"
                                                                                                    cols="20"></textarea>
                                                                                            </div>
                                                                                            <!--                                                                                                </div>-->
                                                                                        </div>

                                                                                    </div>


                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="m-t-20 text-center">
                                                                                <button class="btn btn-primary submit-btn">
                                                                                    Ajouter
                                                                                </button>
                                                                                <a href="liste_ordonnance.php" style=" width:150px;"
                                                                                    class="btn btn-danger">
                                                                                    <font>Annuler</font>
                                                                                </a>
                                                                            </div>
                                                                            <hr />
                                                                            <hr />
                                                                        </div>

                                                                    </div>

                                                                </form>
                                                            </div>
                                                            <form action="save_ordonnance.php" method="POST" enctype="multipart/form-data">
                                                                <div class="card mb-4">
                                                                    <div class="card-header">
                                                                        <i class="fas fa-scroll"></i>
                                                                        <b>Liste des medicaments ajoutés </b>
                                                                        <!--                                                                            <b style="float: right"><span id="soldetotal">0</span> FCFA</b>-->
                                                                    </div>
                                                                </div>
                                                                <div class="table-responsive">
                                                                    <input type="hidden" class="form-control" name="ref_ordo" value="<?= $ref_ordo ?>">
                                                                    <table style="background-color: ivory" class="table table-border table-striped custom-table mb-0" id="dataTable">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>N° Lot</th>
                                                                                <th>Nom</th>
                                                                                <!--<th>Categorie</th>-->
                                                                                <th>Posologie</th>
                                                                                <th>Quantité</th>
                                                                                <!--                                                                                <th>Quantités</th>-->
                                                                                <th>Traitement</th>
                                                                                <!--                                                                                <th>Date Péremption</th>-->
                                                                                <!--                                                                                <th>Date création</th>-->
                                                                                <th>Prix total</th>
                                                                                <th class="text-right">Action</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody>
                                                                            <?php
                                                                            $i = 0;
                                                                            $date_days = date('Y-m-d');


                                                                            $query = "SELECT * from medicament_ordo where  ref_medi_ordo='$ref_ordo'";
                                                                            $q = $db->query($query);
                                                                            while ($row = $q->fetch()) {

                                                                                $id_medi = $row['id_medi'];
                                                                                $quantite = $row['quantite_medi_ordo'];
                                                                                $posologie = $row['posologie'];
                                                                                $traitement = $row['traitement'];
                                                                                $id_medi_ordo = $row['id_medi_ordo'];
                                                                                $id_num_lot = $row['id_num_lot'];
                                                                                $payer_exa = $row['payer'];


                                                                                $sql = "SELECT DISTINCT * from medicament where id_medi = '$id_medi'";

                                                                                $stmt = $db->prepare($sql);
                                                                                $stmt->execute();

                                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                                foreach ($tables as $table) {
                                                                                    $ref_medi = $table['ref_medi'];
                                                                                    $nom_medi = $table['nom_medi'];
                                                                                    //$prix= $table['prix_unitaire'];
                                                                                    $id_type_medi = $table['id_type_medi'];
                                                                                    $prix = $table['prix_unitaire'];
                                                                                    $prix_vente = $table['prix_u_v'];

                                                                                    $sql = "SELECT DISTINCT * from type_medi where id_type_medi = '$id_type_medi'";

                                                                                    $stmt = $db->prepare($sql);
                                                                                    $stmt->execute();

                                                                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                                    foreach ($tables as $table) {
                                                                                        $type_medi = $table['nom'];
                                                                                    }
                                                                                }

                                                                                if (empty($id_type_medi)) {
                                                                                    $type_medi = 'N/A';
                                                                                }
                                                                                if (empty($id_medi)) {
                                                                                    $nom_medi = 'N/A';
                                                                                }

                                                                            ?>


                                                                                <tr>
                                                                                    <td>
                                                                                        <a href="#"><i class="fas fa-cubes" aria-hidden="true"></i> <?= $id_num_lot ?></a>
                                                                                    </td>
                                                                                    <!--<td><a href="#"><?php echo $ref_medi; ?></a></td>-->
                                                                                    <td width="20%"> <b><?= $nom_medi ?> <br>( <?= $prix_vente ?> FCFA ) </b></td>
                                                                                    <!--<td><b><?= $type_medi ?> </b></td>-->
                                                                                    <td><?= $posologie ?></td>
                                                                                    <td align="center"><?= $quantite ?> <input type="hidden" style=" width: 50px; height: 25px" name="<?php echo 'quantite[]'; ?>" value="<?= $quantite ?>" /></td>
                                                                                    <!--                                                                                    <td align="center"> <input type="number" id="qteMed--><? //=$id_medi
                                                                                                                                                                                                                                    ?><!--" style=" width: 50px; height: 25px" name="--><?php //echo 'quantite[]';
                                                                                                                                                                                        ?><!--" value="0" min="0" max="--><? //=$quantite
                                                                                                                                                                                                                                        ?><!--" multiple/></td>-->
                                                                                    <td><?= $traitement ?></td>
                                                                                    <!--                                                                                <td><b>--><? //=$newDate = date("m-Y", strtotime($date_exp));
                                                                                                                                                                                    ?><!-- </b></td>-->
                                                                                    <!--                                                                                    <td><b>--><? //=$newDate = date("m-Y", strtotime($date_fab));
                                                                                                                                                                                        ?><!-- </b></td>-->
                                                                                    <td><b><?php echo $prix_vente * $quantite ?> <input type="hidden" name="prixboss[]" value="<?= $prix_vente * $quantite ?>"> <?php $somme_total += $prix_vente * $quantite; ?></td>
                                                                                    <td align="center">
                                                                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                                                                            <input type="hidden" style=" width: 50px; height: 25px" name="<?php echo 'id_num_lot[]'; ?>" value="<?= $id_num_lot ?>" />
                                                                                            <a class="btn btn-danger" href="remove_medi_ordo.php?id=<?= $id_medi_ordo ?>&ref_ordo=<?= $ref_ordo ?>&id_patient=<?= $id_patient ?>&id_agent=<?= $id_agent ?>&agent=<?= $agent ?>&witness=1"><i class="fas fa-trash"></i></a>
                                                                                        </div>



                                                                                    </td>

                                                                                </tr>

                                                                            <?php $i++;
                                                                            } ?>

                                                                        </tbody>
                                                                        <tfoot>
                                                                            <tr>
                                                                                <th>N° Lot</th>
                                                                                <th>Nom</th>
                                                                                <!--<th>Categorie</th>-->
                                                                                <th>Posologie</th>
                                                                                <th>Quantité</th>
                                                                                <!--                                                                                <th>Quantités</th>-->
                                                                                <th>Traitement</th>
                                                                                <!--                                                                                <th>Date Péremption</th>-->
                                                                                <!--                                                                                <th>Date création</th>-->
                                                                                <th><?= $somme_total ?> FCFA</th>
                                                                                <th class="text-right">Action</th>
                                                                            </tr>
                                                                        </tfoot>
                                                                    </table>
                                                                </div>



                                                                <div class="m-t-20 text-center">
                                                                    <button class="btn btn-primary submit-btn">
                                                                        Enregistrer
                                                                    </button>
                                                                    <a href="liste_ordonnance.php" style=" width:150px;"
                                                                        class="btn btn-danger">
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
                                                                <form action="save_fournisseur.php" method="POST">
                                                                    <div class="row">


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
                                                                        <label>observation<span
                                                                                class="text-danger">*</span></label>
                                                                        <textarea class="form-control" rows="20"
                                                                            cols="70"></textarea>
                                                                    </div>


                                                                    <div class="m-t-20 text-center">

                                                                        <button class="btn btn-primary submit-btn">Enregistrer</button>
                                                                        <a href="<?= $ordonnance['option2_link'] ?>" style=" width:150px;" class="btn btn-danger">
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
<script>
    // Fonction pour calculer et afficher le prix total lorsque le checkbox est coché
    // function calculerPrixTotal(idMedi) {
    //     var checkbox = document.getElementById('checkMed' + idMedi);
    //     var quantiteInput = document.getElementById('qteMed' + idMedi);
    //     var prixUnitaireInput = document.getElementById('prixMed' + idMedi);
    //     var prixTotalInput = document.getElementById('prixtotal' + idMedi);
    //
    //     if (checkbox.checked && quantiteInput && prixUnitaireInput && prixTotalInput) {
    //         var quantite = parseFloat(quantiteInput.value);
    //         var prixUnitaire = parseFloat(prixUnitaireInput.value);
    //         var prixTotal = quantite * prixUnitaire;
    //         prixTotalInput.value = prixTotal.toFixed(2);
    //         console.log(prixTotal);
    //     } else {
    //         prixTotalInput.value = ''; // Réinitialiser le champ si le checkbox n'est pas coché
    //     }
    // }

    // Fonction pour calculer et afficher la somme totale
    function calculerSommeTotal() {
        var checkboxes = document.querySelectorAll('input[id^="checkMed"]:checked');
        var sommeTotal = 0;

        checkboxes.forEach(function(checkbox) {
            var idMedicament = checkbox.id.replace('checkMed', '');
            var prixTotalInput = document.getElementById('prixtotal' + idMedicament);
            if (prixTotalInput) {
                sommeTotal += parseFloat(prixTotalInput.value);
            }
        });

        document.getElementById('soldetotal').innerText = sommeTotal.toFixed(2);
    }

    // Fonction pour calculer le prix total lorsque la quantité est changée
    function calculerPrixTotalOnChange(idMedicament) {
        var checkbox = document.getElementById('checkMed' + idMedicament);
        var quantiteInput = document.getElementById('qteMed' + idMedicament);
        var prixUnitaireInput = document.getElementById('prixMed' + idMedicament);
        var prixTotalInput = document.getElementById('prixtotal' + idMedicament);

        if (checkbox.checked && quantiteInput && prixUnitaireInput && prixTotalInput) {
            var quantite = parseFloat(quantiteInput.value);
            var prixUnitaire = parseFloat(prixUnitaireInput.value);
            var prixTotal = quantite * prixUnitaire;
            prixTotalInput.value = prixTotal.toFixed(2);
        } else {
            prixTotalInput.value = '0.00'; // Réinitialiser le prix total à zéro
        }
    }

    // Écouter les changements de quantité et recalculer le prix total
    var elementsQuantite = document.querySelectorAll('input[id^="qteMed"]');
    elementsQuantite.forEach(function(element) {
        var idMedicament = element.id.replace('qteMed', '');
        element.addEventListener('change', function() {
            calculerPrixTotalOnChange(idMedicament);
            calculerSommeTotal();
        });
    });

    // Fonction pour calculer le prix total
    function calculerPrixTotal(idMedicament) {
        var checkbox = document.getElementById('checkMed' + idMedicament);
        var quantiteInput = document.getElementById('qteMed' + idMedicament);
        var prixUnitaireInput = document.getElementById('prixMed' + idMedicament);
        var prixTotalInput = document.getElementById('prixtotal' + idMedicament);

        if (checkbox.checked && quantiteInput && prixUnitaireInput && prixTotalInput) {
            var quantite = parseFloat(quantiteInput.value);
            var prixUnitaire = parseFloat(prixUnitaireInput.value);
            var prixTotal = quantite * prixUnitaire;
            prixTotalInput.value = prixTotal.toFixed(2);
        } else {
            prixTotalInput.value = '0.00'; // Réinitialiser le prix total à zéro
        }
    }

    // Écouter les changements de statut du checkbox et recalculer le prix total
    var elementsCheckbox = document.querySelectorAll('input[id^="checkMed"]');
    elementsCheckbox.forEach(function(element) {
        var idMedicament = element.id.replace('checkMed', '');
        element.addEventListener('change', function() {
            calculerPrixTotal(idMedicament);
            calculerSommeTotal();
        });
    });
</script>
<script>
    function addRow(tableID) {


        var table = document.getElementById(tableID);

        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);

        var colCount = table.rows[0].cells.length;

        for (var i = 0; i < colCount; i++) {

            var newcell = row.insertCell(i);

            newcell.innerHTML = table.rows[1].cells[i].innerHTML;
            //alert(newcell.childNodes);
            switch (newcell.childNodes[0].type) {
                case "text":
                    newcell.childNodes[0].value = "";
                    break;
                case "checkbox":
                    newcell.childNodes[0].checked = false;
                    break;
                case "select-one":
                    newcell.childNodes[0].selectedIndex = 0;
                    break;
            }
        }
    }

    function deleteRow(tableID) {
        try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;

            for (var i = 0; i < rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if (null != chkbox && true == chkbox.checked) {
                    if (rowCount <= 2) {
                        addRow(tableID);
                        // alert("Attention la 1ère ligne n'est pas supprimable. La quantité est initialisée à 0");
                        //  break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }


            }
        } catch (e) {
            alert(e);
        }
    }

    function testValue(selection) {
        if (selection.value == "Dawn") {
            // do something
        } else if (selection.value == "Noon") {
            // do something
        } else if (selection.value == "Dusk") {
            // do something
        } else {
            // do something
        }
    }
</script>
<script>
    searchBoxMed = document.querySelector("#searchBoxMed");
    countriesMed = document.querySelector("#countriesMed");
    var when = "keyup"; //You can change this to keydown, keypress or change

    searchBoxMed.addEventListener("keyup", function(e) {
        var text = e.target.value; //searchBox value
        var options = countriesMed.options; //select options
        for (var i = 0; i < options.length; i++) {
            var option = options[i]; //current option
            var optionText = option.text; //option text ("Somalia")
            var lowerOptionText = optionText.toLowerCase(); //option text lowercased for case insensitive testing
            var lowerText = text.toLowerCase(); //searchBox value lowercased for case insensitive testing
            var regex = new RegExp("^" + text, "i"); //regExp, explained in post
            var match = optionText.match(regex); //test if regExp is true
            var contains = lowerOptionText.indexOf(lowerText) != -1; //test if searchBox value is contained by the option text
            if (match || contains) { //if one or the other goes through
                option.selected = true; //select that option
                return; //prevent other code inside this event from executing
            }
            searchBoxMed.selectedIndex = 0; //if nothing matches it selects the default option
        }
    });

    searchBoxPhar = document.querySelector("#searchBoxPhar");
    countriesPhar = document.querySelector("#countriesPhar");
    var when = "keyup"; //You can change this to keydown, keypress or change

    searchBoxPhar.addEventListener("keyup", function(e) {
        var text = e.target.value; //searchBox value
        var options = countriesPhar.options; //select options
        for (var i = 0; i < options.length; i++) {
            var option = options[i]; //current option
            var optionText = option.text; //option text ("Somalia")
            var lowerOptionText = optionText.toLowerCase(); //option text lowercased for case insensitive testing
            var lowerText = text.toLowerCase(); //searchBox value lowercased for case insensitive testing
            var regex = new RegExp("^" + text, "i"); //regExp, explained in post
            var match = optionText.match(regex); //test if regExp is true
            var contains = lowerOptionText.indexOf(lowerText) != -1; //test if searchBox value is contained by the option text
            if (match || contains) { //if one or the other goes through
                option.selected = true; //select that option
                return; //prevent other code inside this event from executing
            }
            searchBoxPhar.selectedIndex = 0; //if nothing matches it selects the default option
        }
    });


    searchBoxInf = document.querySelector("#searchBoxInf");
    countriesInf = document.querySelector("#countriesInf");
    var when = "keyup"; //You can change this to keydown, keypress or change

    searchBoxInf.addEventListener("keyup", function(e) {
        var text = e.target.value; //searchBox value
        var options = countriesInf.options; //select options
        for (var i = 0; i < options.length; i++) {
            var option = options[i]; //current option
            var optionText = option.text; //option text ("Somalia")
            var lowerOptionText = optionText.toLowerCase(); //option text lowercased for case insensitive testing
            var lowerText = text.toLowerCase(); //searchBox value lowercased for case insensitive testing
            var regex = new RegExp("^" + text, "i"); //regExp, explained in post
            var match = optionText.match(regex); //test if regExp is true
            var contains = lowerOptionText.indexOf(lowerText) != -1; //test if searchBox value is contained by the option text
            if (match || contains) { //if one or the other goes through
                option.selected = true; //select that option
                return; //prevent other code inside this event from executing
            }
            searchBoxInf.selectedIndex = 0; //if nothing matches it selects the default option
        }
    });


    searchBox = document.querySelector("#searchBox");
    countries = document.querySelector("#countries");
    var when = "keyup"; //You can change this to keydown, keypress or change

    searchBox.addEventListener("keyup", function(e) {
        var text = e.target.value; //searchBox value
        var options = countries.options; //select options
        for (var i = 0; i < options.length; i++) {
            var option = options[i]; //current option
            var optionText = option.text; //option text ("Somalia")
            var lowerOptionText = optionText.toLowerCase(); //option text lowercased for case insensitive testing
            var lowerText = text.toLowerCase(); //searchBox value lowercased for case insensitive testing
            var regex = new RegExp("^" + text, "i"); //regExp, explained in post
            var match = optionText.match(regex); //test if regExp is true
            var contains = lowerOptionText.indexOf(lowerText) != -1; //test if searchBox value is contained by the option text
            if (match || contains) { //if one or the other goes through
                option.selected = true; //select that option
                return; //prevent other code inside this event from executing
            }
            searchBox.selectedIndex = 0; //if nothing matches it selects the default option
        }
    });

    searchBoxMedoc = document.querySelector("#searchBoxMedoc");
    countriesMedoc = document.querySelector("#countriesMedoc");
    var when = "keyup"; //You can change this to keydown, keypress or change

    searchBoxMedoc.addEventListener("keyup", function(e) {
        var text = e.target.value; //searchBox value
        var options = countriesMedoc.options; //select options
        for (var i = 0; i < options.length; i++) {
            var option = options[i]; //current option
            var optionText = option.text; //option text ("Somalia")
            var lowerOptionText = optionText.toLowerCase(); //option text lowercased for case insensitive testing
            var lowerText = text.toLowerCase(); //searchBox value lowercased for case insensitive testing
            var regex = new RegExp("^" + text, "i"); //regExp, explained in post
            var match = optionText.match(regex); //test if regExp is true
            var contains = lowerOptionText.indexOf(lowerText) != -1; //test if searchBox value is contained by the option text
            if (match || contains) { //if one or the other goes through
                option.selected = true; //select that option
                return; //prevent other code inside this event from executing
            }
            searchBoxMedoc.selectedIndex = 0; //if nothing matches it selects the default option
        }
    });
</script>
<?php
include('foot.php');
?>