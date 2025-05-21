<?php

include('first.php');
include('php/db.php');
include('php/main_side_navbar.php');


?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Fiche d'Opération</h1>
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
                                            <a class="nav-link active" href="<?= $operation['option2_link'] ?>">

                                                Retour
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Nav pills -->
                                    <ul class="nav nav-pills">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="pill" href="#home">
                                                <i class="fas fa-file-medical-alt"></i>
                                                Opération<!-- <?= $id_personnel ?> -->
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="pill" href="#menu1">
                                                <i class="fas fa-file-medical"></i>
                                                Rapport de l'opération
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
                                                                    <form action="save_operation.php" method="POST">
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>Patient <span
                                                                                                class="text-danger">*</span></label>
                                                                                    <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBox" >
                                                                                    <select class="form-control"
                                                                                            name="id_patient" id="countries">
<!--                                                                                        <option value="0" selected="">-->
<!--                                                                                            ...-->
<!--                                                                                        </option>-->
<!--                                                                                        --><?php
//
//                                                                                        $iResult = $db->query("SELECT * FROM patient where open_close!=1  ");
//
//                                                                                        while ($data = $iResult->fetch()) {
//
//                                                                                            $i = $data['id_patient'];
//                                                                                            echo '<option value ="' . $i . '">';
//                                                                                           // echo $data['nom_p'] . ' ' . $data['prenom_p'];
//                                                                                            echo $data['ref_patient'];
//                                                                                            echo '</option>';
//
//                                                                                        }
//
//                                                                                        ?>  <?php include("SelectClientView.php"); ?>

                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>Médecin<span
                                                                                                class="text-danger">*</span></label>
                                                                                    <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxMedOpe" >
                                                                                    <select class="form-control" name="id_medecin" id="countriesMedOpe">
                                                                                        <?php
                                                                            if($lvl == 5){
                                                                                $iResult = $db->query("SELECT * FROM  medecin where open_close!=1 and id_medecin='$id_perso_session'");
                                                                            }else{
                                                                                echo'<option value="0" selected="">....</option>';
                                                                                $iResult = $db->query("SELECT * FROM  medecin where open_close!=1 ");
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
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Departement</label>
                                                                                    <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxDepOpe" >
                                                                                    <select class="form-control" name="id_depart" id="countriesDepOpe">

                                                                                        <option value="0" selected="">....</option>
                                                                                        <?php

                                                                                        $iResult = $db->query("SELECT * FROM departement where open_close!=1 ");

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
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>Type d'opération <span
                                                                                                class="text-danger">*</span></label>
                                                                                    <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxTypeOpe" >
                                                                                    <select class="form-control" name="id_type_ope"id="countriesTypeOpe">
                                                                                        <option value="0" selected="">...</option>
                                                                                        <?php

                                                                                        $iResult = $db->query("SELECT * FROM type_ope where open_close!=1  ");

                                                                                        while ($data = $iResult->fetch()) {

                                                                                            $i = $data['id_type_ope'];
                                                                                            echo '<option value ="' . $i . '">';
                                                                                            echo $data['nom'];
                                                                                            echo '</option>';

                                                                                        }

                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

<!--                                                                            <div class="col-sm-6">-->
<!--                                                                                <div class="form-group">-->
<!--                                                                                    <label>Date d'opération</label>-->
<!--                                                                                    <div>-->
<!--                                                                                        <input type="date"-->
<!--                                                                                               class="form-control" name="date_ope">-->
<!--                                                                                    </div>-->
<!--                                                                                </div>-->
<!--                                                                            </div>-->
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>Fichiers<span
                                                                                                class="text-danger">*</span></label>
                                                                                    <input type="file" name="fichier[]"
                                                                                           style="width:100%"
                                                                                           class="form-control"
                                                                                           multiple="multiple">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Heure de début</label>
                                                                                    <div>
                                                                                        <input type="time" class="form-control" name="time_first">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Heure de fin</label>
                                                                                    <div>
                                                                                        <input type="time" class="form-control" name="time_last">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>Résumé</label>
                                                                            <textarea class="form-control" rows="3"
                                                                                      cols="30" name="resume"></textarea>
                                                                        </div>
                                                                        <div class="m-t-20 text-center">
                                                                            <button class="btn btn-primary submit-btn">
                                                                                Enregistrer
                                                                            </button>
                                                                            <a href="liste_operation.php" style=" width:150px;"
                                                                               class="btn btn-danger"><font>Annuler</font></a>
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
                                    <div class="tab-pane container" id="menu1">
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
                                                                    <form action="save_fournisseur.php" method="POST" enctype="multipart/form-data">
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>Patient <span
                                                                                                class="text-danger">*</span></label>
                                                                                    <select class="form-control"
                                                                                            name="id_card_bank"
                                                                                            disabled="">
                                                                                        <option value="" selected="">
                                                                                            ...
                                                                                        </option>
                                                                                        <?php

                                                                                        $iResult = $db->query("SELECT * FROM patient where open_close!=1  ");

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
                                                                                    <label>Chirugien<span
                                                                                                class="text-danger">*</span></label>
                                                                                    <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxChiOpe" >
                                                                                    <select class="form-control" name="id_inter" id="countriesChiOpe">
                                                                                        <?php
                                                                                        if($lvl == 8){
                                                                                            $iResult = $db->query("SELECT * FROM  chirugien where open_close!=1 and id_chirugien='$id_perso_session'");
                                                                                        }else{
                                                                                            echo'<option value="0" selected="">....</option>';
                                                                                            $iResult = $db->query("SELECT * FROM  chirugien");
                                                                                        }

                                                                                        while ($data = $iResult->fetch()) {

                                                                                            $i = $data['id_chirugien'];
                                                                                            echo '<option value ="' . $i . '">';
                                                                                            echo $data['nom_c'] . ' ' . $data['prenom_c'];
                                                                                            echo '</option>';

                                                                                        }

                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>Fichiers<span
                                                                                                class="text-danger">*</span></label>
                                                                                    <input type="file" name="fichier[]"
                                                                                           style="width:100%"
                                                                                           class="form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Observation<span class="text-danger">*</span></label>
                                                                            <textarea class="form-control" rows="20"
                                                                                      cols="70"></textarea>
                                                                        </div>


                                                                        <div class="m-t-20 text-center">

                                                                            <button class="btn btn-primary submit-btn">Enregistrer</button>
                                                                            <a href="<?=$operation['option2_link']?>" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>


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


    <!-- <?php


    //include("ajouter_profession.php");


    ?> -->
    <!--//Footer-->
    <script>

        searchBoxTypeOpe = document.querySelector("#searchBoxTypeOpe");
        countriesTypeOpe = document.querySelector("#countriesTypeOpe");
        var when = "keyup"; //You can change this to keydown, keypress or change

        searchBoxTypeOpe.addEventListener("keyup", function (e) {
            var text = e.target.value; //searchBox value
            var options = countriesTypeOpe.options; //select options
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
                searchBoxTypeOpe.selectedIndex = 0; //if nothing matches it selects the default option
            }
        });
    </script>

    <script>

        searchBoxMedOpe = document.querySelector("#searchBoxMedOpe");
        countriesMedOpe = document.querySelector("#countriesMedOpe");
        var when = "keyup"; //You can change this to keydown, keypress or change

        searchBoxMedOpe.addEventListener("keyup", function (e) {
            var text = e.target.value; //searchBox value
            var options = countriesMedOpe.options; //select options
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
                searchBoxMedOpe.selectedIndex = 0; //if nothing matches it selects the default option
            }
        });
    </script>

    <script>

        searchBoxChiOpe = document.querySelector("#searchBoxChiOpe");
        countriesChiOpe = document.querySelector("#countriesChiOpe");
        var when = "keyup"; //You can change this to keydown, keypress or change

        searchBoxChiOpe.addEventListener("keyup", function (e) {
            var text = e.target.value; //searchBox value
            var options = countriesChiOpe.options; //select options
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
                searchBoxChiOpe.selectedIndex = 0; //if nothing matches it selects the default option
            }
        });
    </script>

    <script>

        searchBoxDepOpe = document.querySelector("#searchBoxDepOpe");
        countriesDepOpe = document.querySelector("#countriesDepOpe");
        var when = "keyup"; //You can change this to keydown, keypress or change

        searchBoxDepOpe.addEventListener("keyup", function (e) {
            var text = e.target.value; //searchBox value
            var options = countriesDepOpe.options; //select options
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
                searchBoxDepOpe.selectedIndex = 0; //if nothing matches it selects the default option
            }
        });
    </script>
<?php
include('foot.php');
?>