<?php

include('first.php');
include('php/db.php');
include('php/main_side_navbar.php');

$year = (new DateTime())->format("Y");
$month = (new DateTime())->format("m");
$day = (new DateTime())->format("d");
$query  = "SELECT count(id_anes) as total from anesthesie";
$q = $conn->query($query);
while($row = $q->fetch_assoc())
{
    $total = $row["total"];
}
$id_entite = $total + 1;
$ref_entite = 'ANE_'.$year.'_'.$month.'_'.$id_entite;


?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Fiche d'anesthésie</h1>
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
                                            <a class="nav-link active" href="<?= $anesthesie['option2_link'] ?>">

                                                Retour
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Nav pills -->
                                    <ul class="nav nav-pills">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="pill" href="#home">
                                                <i class="fas fa-file-medical-alt"></i>
                                                Anesthésie
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="pill" href="#menu1">
                                                <i class="fas fa-file-medical"></i>
                                                Résultat de l'anesthésie
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
                                                                    <form action="save_anesthesie.php" method="POST">
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <input type="hidden" name="partie" value="1">
                                                                                    <input type="hidden" name="ref_anes" value="<?=$ref_entite?>">
                                                                                    <input type="hidden" name="id_anes" value="<?=$id_entite?>">
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
//                                                                                        $iResult = $db->query("SELECT * FROM patient where open_close!=1");
//
//                                                                                        while ($data = $iResult->fetch()) {
//
//                                                                                            $i = $data['id_patient'];
//                                                                                            echo '<option value ="' . $i . '">';
//                                                                                          //  echo $data['nom_p'] . ' ' . $data['prenom_p'];
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
                                                                                    <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxMedAne" >
                                                                                    <select class="form-control" name="id_medecin" id="countriesMedAne">

                                                                                        <?php

                                                                                        if ($lvl == 5) {
                                                                                            $iResult = $db->query("SELECT * FROM  medecin where open_close!=1 and id_medecin='$id_perso_session'");
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
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group" >
                                                                                    <label>Type d'anesthésie <span
                                                                                            class="text-danger">*</span></label>
                                                                                    <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxTypeAne" >
                                                                                    <select class="form-control" name="id_type_anes" id="countriesTypeAne">
                                                                                        <option value="0" selected="">...</option>
                                                                                        <?php

                                                                                        $iResult = $db->query("SELECT * FROM type_anes where open_close!=1 ");

                                                                                        while ($data = $iResult->fetch()) {

                                                                                            $i = $data['id_type_anes'];
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
<!--                                                                                    <label>Date de l'anesthésie</label>-->
<!--                                                                                    <div>-->
<!--                                                                                        <input type="date"-->
<!--                                                                                               class="form-control " name="date_anes">-->
<!--                                                                                    </div>-->
<!--                                                                                </div>-->
<!--                                                                            </div>-->

                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>observation/commentaire</label>
                                                                            <textarea class="form-control" rows="3" name="obs"
                                                                                      cols="30"></textarea>
                                                                        </div>
                                                                        <div class="m-t-20 text-center">
                                                                            <button class="btn btn-primary submit-btn">Enregistrer</button>
                                                                            <a href="<?=$anesthesie['option2_link']?>" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>

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
                                                                    <form action="save_anesthesie.php" method="POST">
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <input type="hidden" name="partie" value="2">
                                                                                    <input type="hidden" name="ref_anes" value="<?=$ref_entite?>">
                                                                                    <input type="hidden" name="id_anes" value="<?=$id_entite?>">
                                                                                    <label>Patient <span
                                                                                            class="text-danger">*</span></label>
                                                                                    <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxPatAne" >
                                                                                    <select class="form-control"
                                                                                            name="id_patient" id="countriesPatAne"
                                                                                    >
                                                                                        <option value="0" selected="">
                                                                                            ...
                                                                                        </option>
                                                                                        <?php

                                                                                        $iResult = $db->query("SELECT * FROM patient where open_close!= 1");

                                                                                        while ($data = $iResult->fetch()) {

                                                                                            $i = $data['id_patient'];
                                                                                            echo '<option value ="' . $i . '">';
                                                                                            //echo $data['nom_p'] . ' ' . $data['prenom_p'];
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
                                                                                    <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxChiAne" >
                                                                                    <select class="form-control" name="id_chirugien" id="countriesChiAne">
                                                                                        <option value="0" selected="">
                                                                                            ...
                                                                                        </option>
                                                                                        <?php
                                                                                        if ($lvl == 8) {
                                                                                            $iResult = $db->query("SELECT * FROM chirugien where open_close!=1 and id_chirugien='$id_perso_session'");
                                                                                        } else {
                                                                                            echo '<option value="0" selected="">....</option>';
                                                                                            $iResult = $db->query("SELECT * FROM chirugien where open_close!=1 ");
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
                                                                                    <label>Fichier<span
                                                                                            class="text-danger">*</span></label>
                                                                                    <input type="file" name="fichier[]"
                                                                                           style="width:100%"
                                                                                           class="form-control" multiple>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>observation<span class="text-danger">*</span></label>
                                                                            <textarea class="form-control" rows="20"
                                                                                      cols="70" name="obs_anes"></textarea>
                                                                        </div>


                                                                        <div class="m-t-20 text-center">
                                                                            <button class="btn btn-primary submit-btn">Enregistrer</button>
                                                                            <a href="<?=$anesthesie['option2_link']?>" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>


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

        searchBoxMedAne = document.querySelector("#searchBoxMedAne");
        countriesMedAne = document.querySelector("#countriesMedAne");
        var when = "keyup"; //You can change this to keydown, keypress or change

        searchBoxMedAne.addEventListener("keyup", function (e) {
            var text = e.target.value; //searchBox value
            var options = countriesMedAne.options; //select options
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
                searchBoxMedAne.selectedIndex = 0; //if nothing matches it selects the default option
            }
        });
    </script>
    <script>

        searchBoxTypeAne = document.querySelector("#searchBoxTypeAne");
        countriesTypeAne = document.querySelector("#countriesTypeAne");
        var when = "keyup"; //You can change this to keydown, keypress or change

        searchBoxTypeAne.addEventListener("keyup", function (e) {
            var text = e.target.value; //searchBox value
            var options = countriesTypeAne.options; //select options
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
                searchBoxTypeAne.selectedIndex = 0; //if nothing matches it selects the default option
            }
        });
    </script>
    <script>

        searchBoxPatAne = document.querySelector("#searchBoxPatAne");
        countriesPatAne = document.querySelector("#countriesPatAne");
        var when = "keyup"; //You can change this to keydown, keypress or change

        searchBoxPatAne.addEventListener("keyup", function (e) {
            var text = e.target.value; //searchBox value
            var options = countriesPatAne.options; //select options
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
                searchBoxPatAne.selectedIndex = 0; //if nothing matches it selects the default option
            }
        });
    </script>
    <script>

        searchBoxChiAne = document.querySelector("#searchBoxChiAne");
        countriesChiAne = document.querySelector("#countriesChiAne");
        var when = "keyup"; //You can change this to keydown, keypress or change

        searchBoxChiAne.addEventListener("keyup", function (e) {
            var text = e.target.value; //searchBox value
            var options = countriesChiAne.options; //select options
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
                searchBoxChiAne.selectedIndex = 0; //if nothing matches it selects the default option
            }
        });
    </script>
<?php
include('foot.php');
?>