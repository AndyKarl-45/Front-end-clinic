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
                                                                <form action="save_examen.php" method="POST" enctype="multipart/form-data">
                                                                    <div class="col-lg-8 offset-lg-2">

                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <input type="hidden" name="partie" value="1">
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
                                                                                        //                                                                                            //echo $data['nom_p'] . ' ' . $data['prenom_p'];
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
                                                                                    <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxMed" >
                                                                                    <select class="form-control" name="id_medecin" id="countriesMed">

                                                                                        <?php include("SelectMedecinView.php"); ?>

                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>observation/commentaire</label>
                                                                            <textarea class="form-control" rows="3" name="obs"
                                                                                      cols="30"></textarea>
                                                                        </div>



                                                                    </div>
                                                                    <!--/// -->
                                                                    <div class="card mb-4">
                                                                        <div class="card-header">
                                                                            <i class="fas fa-scroll"></i>
                                                                            <b>Liste des medicaments </b>
                                                                        </div>
                                                                    </div>
                                                                    <div class="table-responsive">
                                                                        <table class="table table-border table-striped custom-table mb-0" id="TableID" >
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
                                                                                <td><input type="checkbox"  style=" width: 25px; height: 25px" name="id_mat"  multiple></td>
                                                                                <td>
                                                                                    <input type="search" id="searchBoxTypeExa-0" class="form-control " placeholder="barre de recherche..."  spellcheck="false">
                                                                                    <select class="form-control " id="countriesTypeExa-0"
                                                                                            name="id_type_exa[]"  >
                                                                                        <?php

                                                                                        $query = "SELECT * FROM type_exa where open_close!=1 order by nom asc";
                                                                                        $q = $db->query($query);
                                                                                        while ($row = $q->fetch()) {
                                                                                            $id_type_exa = $row['id_type_exa'];
                                                                                            $nom = $row['nom'];
                                                                                            $prix_t_exa = $row['prix_t_exa'];

                                                                                            echo '<option value ="' . $id_type_exa . '">';
                                                                                            echo $row['nom'].' ('.$prix_t_exa.') FCFA';
                                                                                            echo '</option>';

                                                                                        }

                                                                                        ?>

                                                                                    </select></td>
                                                                                <!--<td><input type="date" class="form-control" style=" width: 150px; height: 25px" name="date_exam[]"   multiple></td>-->
                                                                                <td>
                                                                                    <a type="button"  onclick="addRowExa('TableID')"
                                                                                       class="btn btn-primary"
                                                                                       title="view"
                                                                                       style="background-color: transparent">
                                                                                        <i style="color: green" class="fas fa-plus"></i>
                                                                                    </a>
                                                                                    <a class="btn btn-danger" type="button" onclick="deleteRowExa('TableID')"
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
                                                                        <a href="<?=$examen['option2_link']?>" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>

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
                                                                    <form action="save_examen.php" method="POST">
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
                                                                            <a href="<?=$examen['option2_link']?>" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>


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
        let rowCount = 0;

        function addRowExa(tableID) {
            const table = document.getElementById(tableID);
            rowCount++;
            const row = table.insertRow();
            row.className = "search-group";
            row.id = "search-group-" + rowCount;

            const checkboxCell = row.insertCell(0);
            const searchCell = row.insertCell(1);
            const actionCell = row.insertCell(2);

            // Checkbox
            const checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.name = "id_mat";
            checkbox.style.width = "25px";
            checkbox.style.height = "25px";
            checkboxCell.appendChild(checkbox);

            // Search Box
            const searchBox = document.createElement("input");
            searchBox.type = "search";
            searchBox.id = "searchBoxTypeExa-" + rowCount;
            searchBox.className = "form-control";
            searchBox.placeholder = "barre de recherche...";
            searchBox.spellcheck = false;
            searchCell.appendChild(searchBox);

            // Select Box
            const selectBox = document.createElement("select");
            selectBox.id = "countriesTypeExa-" + rowCount;
            selectBox.name = "id_type_exa[]";
            selectBox.className = "form-control";
            searchCell.appendChild(selectBox);

            // Populate select options
            <?php
            $query = "SELECT * FROM type_exa where open_close!=1 order by nom asc";
            $q = $db->query($query);
            $options = "";
            while ($row = $q->fetch()) {
                $id_type_exa = $row['id_type_exa'];
                $nom = $row['nom'];
                $prix_t_exa = $row['prix_t_exa'];
                $options .= "<option value='$id_type_exa'>$nom ($prix_t_exa) FCFA</option>";
            }
            ?>
            selectBox.innerHTML = `<?= $options ?>`;

            // Add actions
            const addButton = document.createElement("a");
            addButton.className = "btn btn-primary";
            addButton.title = "view";
            addButton.style.backgroundColor = "transparent";
            addButton.innerHTML = '<i style="color: green" class="fas fa-plus"></i>';
            addButton.onclick = function () { addRow(tableID); };
            actionCell.appendChild(addButton);

            const deleteButton = document.createElement("a");
            deleteButton.className = "btn btn-danger";
            deleteButton.title = "supprimer";
            deleteButton.style.backgroundColor = "transparent";
            deleteButton.innerHTML = '<i style="color: red" class="fas fa-trash"></i>';
            deleteButton.onclick = function () { deleteRow(tableID, row.id); };
            actionCell.appendChild(deleteButton);

            // Add event listener for search box
            searchBox.addEventListener("keyup", function (e) {
                var text = e.target.value.toLowerCase(); // searchBox value
                var options = selectBox.options; // select options
                for (var i = 0; i < options.length; i++) {
                    var option = options[i]; // current option
                    var optionText = option.text.toLowerCase(); // option text lowercased
                    var regex = new RegExp(text, "i"); // case insensitive regex
                    var match = optionText.match(regex); // test if regex is true
                    var contains = optionText.indexOf(text) != -1; // test if searchBox value is contained by the option text
                    if (match || contains) { // if one or the other goes through
                        option.selected = true; // select that option
                        return; // prevent other code inside this event from executing
                    }
                }
                selectBox.selectedIndex = 0; // if nothing matches, select the default option
            });
        }

        function deleteRowExa(tableID, rowId) {
            const table = document.getElementById(tableID);
            const row = document.getElementById(rowId);
            table.deleteRow(row.rowIndex);
        }

        // Initial event listener for the first search box
        document.addEventListener("DOMContentLoaded", function() {
            const searchBox = document.getElementById("searchBoxTypeExa-0");
            const selectBox = document.getElementById("countriesTypeExa-0");
            searchBox.addEventListener("keyup", function (e) {
                var text = e.target.value.toLowerCase(); // searchBox value
                var options = selectBox.options; // select options
                for (var i = 0; i < options.length; i++) {
                    var option = options[i]; // current option
                    var optionText = option.text.toLowerCase(); // option text lowercased
                    var regex = new RegExp(text, "i"); // case insensitive regex
                    var match = optionText.match(regex); // test if regex is true
                    var contains = optionText.indexOf(text) != -1; // test if searchBox value is contained by the option text
                    if (match || contains) { // if one or the other goes through
                        option.selected = true; // select that option
                        return; // prevent other code inside this event from executing
                    }
                }
                selectBox.selectedIndex = 0; // if nothing matches, select the default option
            });
        });
    </script>







<?php
include('foot.php');
?>