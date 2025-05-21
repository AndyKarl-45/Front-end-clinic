<?php

include('first.php');
include('php/db.php');
include('php/main_side_navbar.php');


?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Fiche d'une Radiologie</h1>
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
                                            <a class="nav-link active" href="<?= $radiologie['option2_link'] ?>">

                                                Retour
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Nav pills -->
                                    <ul class="nav nav-pills">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="pill" href="#home">
                                                <i class="fas fa-file-medical-alt"></i>
                                                Radiologie
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="pill" href="#menu1">
                                                <i class="fas fa-file-medical"></i>
                                                Résultat de la radiologie
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
                                                                <form action="save_radiologie.php" method="POST" enctype="multipart/form-data">
<!--                                                                <div class="col-lg-8 offset-lg-2">-->

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
                                                                                                    <input type="hidden" class="form-control" name="id_medecin" value="0">
                                                                                                    <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxInf" >
                                                                                                    <select name="id_nurse" class="form-control"  id="countriesInf">

                                                                                                        <?php include("SelectNurseView.php"); ?>
                                                                                                    </select>
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
                                                                        <div class="form-group">
                                                                            <label>observation/commentaire</label>
                                                                            <textarea class="form-control" rows="3" name="obs"
                                                                                      cols="30"></textarea>
                                                                        </div>



<!--                                                                </div>-->
                                                                    <!--/// -->
                                                                    <div class="card mb-4">
                                                                        <div class="card-header">
                                                                            <i class="fas fa-scroll"></i>
                                                                            <b>Liste des types de radiologie </b>
                                                                        </div>
                                                                    </div>
                                                                    <div class="table-responsive">
                                                                        <table class="table table-border table-striped custom-table mb-0" id="TableIDRad" >
                                                                            <thead>
                                                                            <tr>
                                                                                <th>...</th>
                                                                                <th>Type de radiologie</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <tr class="search-group" id="search-group-0">
                                                                                <td><input type="checkbox"  style=" width: 25px; height: 25px" name="id_mat"  multiple></td>
                                                                                <td>
                                                                                    <input type="search" class="form-control" id="searchBoxTypeExa-0" placeholder="barre de recherche..." >
                                                                                    <select class="form-control"
                                                                                             name="id_type_radiologie[]" id="countriesTypeExa-0">
                                                                                        <?php

                                                                                        $query = "SELECT * FROM type_radiologie where open_close!=1 order by nom asc";
                                                                                        $q = $db->query($query);
                                                                                        while ($row = $q->fetch()) {
                                                                                            $id_type_radiologie = $row['id_type_radiologie'];
                                                                                            $nom = $row['nom'];
                                                                                            $prix_t_radiologie = $row['prix_t_radiologie'];

                                                                                            echo '<option value ="' . $id_type_radiologie . '">';
                                                                                            echo $row['nom'].' ('.$prix_t_radiologie.') FCFA';
                                                                                            echo '</option>';

                                                                                        }

                                                                                        ?>

                                                                                    </select></td>
                                                                                <td>
                                                                                    <a type="button"  onclick="addRow('TableIDRad')"
                                                                                       class="btn btn-primary"
                                                                                       title="view"
                                                                                       style="background-color: transparent">
                                                                                        <i style="color: green" class="fas fa-plus"></i>
                                                                                    </a>
                                                                                    <a class="btn btn-danger" type="button" onclick="deleteRow('TableIDRad')"
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
                                                                        <a href="<?=$radiologie['option2_link']?>" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>

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
                                                                    <form action="save_radiologie.php" method="POST">
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <input type="hidden" name="partie" value="2">
                                                                                    <label>Patient <span
                                                                                                class="text-danger">*</span></label>
                                                                                    <select class="form-control"
                                                                                            name="id_patient"
                                                                                            >
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
                                                                                    <label>Radiologue<span
                                                                                                class="text-danger">*</span></label>
                                                                                    <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxRadExa" >
                                                                                    <select class="form-control" name="id_radiologue" id="countriesRadExa">
                                                                                        <option value="0" selected="">
                                                                                            ...
                                                                                        </option>
                                                                                        <?php

                                                                                        $iResult = $db->query("SELECT * FROM radiologue ");

                                                                                        while ($data = $iResult->fetch()) {

                                                                                            $i = $data['id_radiologue'];
                                                                                            echo '<option value ="' . $i . '">';
                                                                                            echo $data['nom_r'] . ' ' . $data['prenom_r'];
                                                                                            echo '</option>';

                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>Image<span
                                                                                                class="text-danger">*</span></label>
                                                                                    <input type="file" name="fichier_img[]"
                                                                                           style="width:100%"
                                                                                           class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>Fichier<span
                                                                                                class="text-danger">*</span></label>
                                                                                    <input type="file" name="fichier_doc[]"
                                                                                           style="width:100%"
                                                                                           class="form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>observation<span class="text-danger">*</span></label>
                                                                            <textarea class="form-control" rows="20"
                                                                                      cols="70" name="obs_radiologie"></textarea>
                                                                        </div>


                                                                        <div class="m-t-20 text-center">
                                                                            <button class="btn btn-primary submit-btn">Enregistrer</button>
                                                                            <a href="<?=$radiologie['option2_link']?>" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>


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

        searchBox = document.querySelector("#searchBoxRadio");
        countries = document.querySelector("#countriesRadio");
        var when = "keyup"; //You can change this to keydown, keypress or change

        searchBox.addEventListener("keyup", function (e) {
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
    </script>
    <script>
        function addRow(tableID) {


            var table = document.getElementById(tableID);

            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);

            var colCount = table.rows[0].cells.length;

            for(var i=0; i<colCount; i++) {

                var newcell = row.insertCell(i);

                newcell.innerHTML = table.rows[1].cells[i].innerHTML;
                //alert(newcell.childNodes);
                switch(newcell.childNodes[0].type) {
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

                for(var i=0; i<rowCount; i++) {
                    var row = table.rows[i];
                    var chkbox = row.cells[0].childNodes[0];
                    if(null != chkbox && true == chkbox.checked) {
                        if(rowCount <= 2) {
                            addRow(tableID);
                            // alert("Attention la 1ère ligne n'est pas supprimable. La quantité est initialisée à 0");
                            //  break;
                        }
                        table.deleteRow(i);
                        rowCount--;
                        i--;
                    }


                }
            }catch(e) {
                alert(e);
            }
        }

        function testValue(selection) {
            if (selection.value == "Dawn") {
                // do something
            }
            else if (selection.value == "Noon") {
                // do something
            }
            else if (selection.value == "Dusk") {
                // do something
            }
            else {
                // do something
            }
        }

    </script>
    <script>

        searchBoxRadExa = document.querySelector("#searchBoxRadExa");
        countriesRadExa = document.querySelector("#countriesRadExa");
        var when = "keyup"; //You can change this to keydown, keypress or change

        searchBoxRadExa.addEventListener("keyup", function (e) {
            var text = e.target.value; //searchBox value
            var options = countriesRadExa.options; //select options
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
                searchBoxRadExa.selectedIndex = 0; //if nothing matches it selects the default option
            }
        });
    </script>


    <script>

        searchBoxConInf = document.querySelector("#searchBoxConInf");
        countriesConInf = document.querySelector("#countriesConInf");
        var when = "keyup"; //You can change this to keydown, keypress or change

        searchBoxConInf.addEventListener("keyup", function (e) {
            var text = e.target.value; //searchBox value
            var options = countriesConInf.options; //select options
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
                searchBoxConInf.selectedIndex = 0; //if nothing matches it selects the default option
            }
        });
    </script>
<?php
include('foot.php');
?>