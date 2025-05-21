<?php
?>



<script>
    $('#btn-one').click(function () {
        $('#btn-one').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Chargement...').addClass('disabled');
    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="js/scriptss.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/datatables-demo.js"></script>


<script src="assetss/js/app.js"></script>
<script src="assetss/js/bootstrap-datetimepicker.min.js"></script>
<script>
    $(function () {
        $('#datetimepicker3').datetimepicker({
            format: 'LT'

        });
    });
</script>

<!--barre de recherche :PATIENT -->
<script>

    searchBox = document.querySelector("#searchBox");
    countries = document.querySelector("#countries");
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
<!--barre de recherche :MEDECIN -->
<script>

    searchBoxMed = document.querySelector("#searchBoxMed");
    countriesMed = document.querySelector("#countriesMed");
    var when = "keyup"; //You can change this to keydown, keypress or change

    searchBoxMed.addEventListener("keyup", function (e) {
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

    searchBoxInf = document.querySelector("#searchBoxInf");
    countriesInf = document.querySelector("#countriesInf");
    var when = "keyup"; //You can change this to keydown, keypress or change

    searchBoxInf.addEventListener("keyup", function (e) {
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


    searchBoxPhar = document.querySelector("#searchBoxPhar");
    countriesPhar = document.querySelector("#countriesPhar");
    var when = "keyup"; //You can change this to keydown, keypress or change

    searchBoxPhar.addEventListener("keyup", function (e) {
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


    searchBoxLab = document.querySelector("#searchBoxLab");
    countriesLab = document.querySelector("#countriesLab");
    var when = "keyup"; //You can change this to keydown, keypress or change

    searchBoxLab.addEventListener("keyup", function (e) {
        var text = e.target.value; //searchBox value
        var options = countriesLab.options; //select options
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
            searchBoxLab.selectedIndex = 0; //if nothing matches it selects the default option
        }
    });

</script>
<!--barre de recherche pour les types de produits EXAMEN - RADIOLOGIE - AUTRES SERVICES - COMMANDE -->
<script>
    let rowCount = 0;

    function addRowTypes(tableID) {
        console.log(tableID);
        const table = document.getElementById(tableID);
        console.log(tableID);
        rowCount++;
        const row = table.insertRow();
        row.className = "search-group";
        row.id = "search-group-" + rowCount;

        var checkboxCell = null;
        var searchCell = null;
        var numberCell = null;
        var dateFabCell = null;
        var dateExpCell = null;
        var actionCell = null;

        switch (tableID) {
            case 'TableIDCom':
                checkboxCell = row.insertCell(0);
                searchCell = row.insertCell(1);
                numberCell = row.insertCell(2);
                dateFabCell = row.insertCell(3);
                dateExpCell = row.insertCell(4);
                actionCell = row.insertCell(5);
                break;
            default:
                checkboxCell = row.insertCell(0);
                searchCell = row.insertCell(1);
                actionCell = row.insertCell(2);
                break;
        }




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

        // debut - select Box
        const selectBox = document.createElement("select");



        switch (tableID) {
            case 'TableIDExa':
                // Select Box

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
                break;
            case 'TableIDRad':

                // Select Box
                selectBox.id = "countriesTypeExa-" + rowCount;
                selectBox.name = "id_type_radiologie[]";
                selectBox.className = "form-control";
                searchCell.appendChild(selectBox);

                // Populate select options
            <?php
            $query = "SELECT * FROM type_radiologie where open_close!=1 order by nom asc";
            $q = $db->query($query);
            $options = "";
            while ($row = $q->fetch()) {
                $id_type_radiologie = $row['id_type_radiologie'];
                $nom = $row['nom'];
                $prix_t_radiologie = $row['prix_t_radiologie'];
                $options .= "<option value='$id_type_radiologie'>$nom ($prix_t_radiologie) FCFA</option>";
            }
            ?>
                selectBox.innerHTML = `<?= $options ?>`;
                break;
            case 'TableIDAutres':

                // Select Box
                selectBox.id = "countriesTypeExa-" + rowCount;
                selectBox.name = "id_autre_service[]";
                selectBox.className = "form-control";
                searchCell.appendChild(selectBox);

                // Populate select options
            <?php
            $query = "SELECT * FROM autres_services where open_close!=1 order by nom asc";
            $q = $db->query($query);
            $options = "";
            while ($row = $q->fetch()) {
                $id_autre_service = $row['id_autre_service'];
                $nom = $row['nom'];
                $prix_autre_service = $row['prix_autre_service'];
                $options .= "<option value='$id_autre_service'>$nom ($prix_autre_service) FCFA</option>";
            }
            ?>
                selectBox.innerHTML = `<?= $options ?>`;
                break;
            case 'TableIDCom':

                // Select Box
                selectBox.id = "countriesTypeExa-" + rowCount;
                selectBox.name = "id_medi[]";
                selectBox.className = "form-control";
                selectBox.style = "width: 250px; height: 25px";
                searchCell.appendChild(selectBox);

                // Populate select options
            <?php
            $query = "SELECT * FROM medicament where open_close!=1 order by nom_medi asc";
            $q = $db->query($query);
            $options = "";
            while ($row = $q->fetch()) {
                $id_medi = $row['id_medi'];
                $nom = $row['nom_medi'];
                $prix_unitaire = $row['prix_unitaire'];
                $options .= "<option value='$id_medi'>$nom ($prix_unitaire) FCFA</option>";
            }
            ?>

                // Number Box
                const numberBox = document.createElement("input");
                numberBox.type = "number";
                numberBox.className = "form-control";
                numberBox.name = "quantite[]";
                numberBox.value = 0;
                numberBox.min = 0;
                numberBox.style=" width: 80px; height: 25px";
                numberCell.appendChild(numberBox);

                // dateFab Box
                const dateFabBox = document.createElement("input");
                dateFabBox.type = "month";
                dateFabBox.className = "form-control";
                dateFabBox.name = "date_exp[]";
                dateFabBox.id ="date_exp";
                dateFabBox.style="width: 150px; height: 25px";
                dateFabCell.appendChild(dateFabBox);


                // dateExp Box
                const dateExpBox = document.createElement("input");
                dateExpBox.type = "month";
                dateExpBox.className = "form-control";
                dateExpBox.name = "date_fab[]";
                dateExpBox.id ="date_exp";
                dateExpBox.style="width: 150px; height: 25px";
                dateExpCell.appendChild(dateExpBox);

                selectBox.innerHTML = `<?= $options ?>`;
                break;
            case 'TableIDEco':
                // Select Box

                selectBox.id = "countriesTypeExa-" + rowCount;
                selectBox.name = "id_type_eco[]";
                selectBox.className = "form-control";
                searchCell.appendChild(selectBox);

                // Populate select options
            <?php
            $query = "SELECT * FROM type_eco where open_close!=1 order by nom asc";
            $q = $db->query($query);
            $options = "";
            while ($row = $q->fetch()) {
                $id_type_eco = $row['id_type_eco'];
                $nom = $row['nom'];
                $prix_t_eco = $row['prix_t_eco'];
                $options .= "<option value='$id_type_eco'>$nom ($prix_t_eco) FCFA</option>";
            }
            ?>
                selectBox.innerHTML = `<?= $options ?>`;
                break;
            default:
                console.log(`Sorry, La recherche ne fonctionne pas : Id affecté à la table`);
        }




        //end - select Box



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

    function deleteRowType(tableID, rowId) {
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

<script>
    // examen
    function addRowExam(tableID) {


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
    // commande
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


</body>
</html>

