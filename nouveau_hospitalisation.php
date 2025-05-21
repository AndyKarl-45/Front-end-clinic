<?php

include('first.php');
include('php/db.php');
include('php/main_side_navbar.php');

$hospitalisation=$_REQUEST['hospitalisation'];
$cas='';

    if($hospitalisation=='0'){
        $cas='disabled';
    }else{
        $cas='';
    }


?>


    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Nouvelle Hospitalisation</h1>
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
                                <?php
                                if($hospitalisation=='0'){
                                echo '<b style="color: red;"> Veillez choisir une chambre !!! </b>';
                            }elseif($hospitalisation !='0' ){
                                echo '<b style="color: green;"> Chambre choisie !!! </b>';
                            }
                            ?>
                                <b>
                                    <!-- Nav pills -->
                                    <ul class="nav nav-pills">

                                    </ul>
                                </b>
                            </div>

                            <div class="card-body">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <!-- Etat Civile-->


                                    <div class="row">
                                        <div class="col-lg-8 offset-lg-2">
                                            <form action="save_hospitalisation.php" method="POST">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Patient <span
                                                                        class="text-danger">*</span></label>
                                                            <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBox" >
                                                            <select class="form-control"
                                                                    name="id_patient" id="countries"  <?=$cas?> >
<!--                                                                <option value="0" selected="">-->
<!--                                                                    ...-->
<!--                                                                </option>-->
<!--                                                                --><?php
//
//                                                                $iResult = $db->query("SELECT * FROM patient where open_close!=1 ");
//
//                                                                while ($data = $iResult->fetch()) {
//
//                                                                    $i = $data['id_patient'];
//                                                                    echo '<option value ="' . $i . '">';
//                                                                 //   echo $data['nom_p'] . ' ' . $data['prenom_p'];
//                                                                    echo $data['ref_patient'];
//                                                                    echo '</option>';
//
//                                                                }
//
//                                                                ?>  <?php include("SelectClientView.php"); ?>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Infirmière</label>
                                                            <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxHosInf" >
                                                            <select class="form-control" name="id_nurse" <?=$cas?>  id="countriesHosInf">

                                                                <?php
                                                                if($lvl == 3) {
                                                                    $iResult = $db->query("SELECT * FROM nurse where  id_nurse='$id_perso_session' and open_close!=1 order by nom_n, prenom_n asc ");
                                                                }else {
                                                                    $iResult = $db->query("SELECT * FROM nurse where open_close!=1 ");
                                                                    echo ' <option value="0" selected="">...</option>';
                                                                }

                                                                while ($data = $iResult->fetch()) {

                                                                    $i = $data['id_nurse'];
                                                                    echo '<option value ="' . $i . '">';
                                                                    echo $data['nom_n'] . ' ' . $data['prenom_n'];
                                                                    echo '</option>';

                                                                }

                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Médecin<span
                                                                        class="text-danger">*</span></label>
                                                            <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxHosMed" >
                                                            <select class="form-control" name="id_medecin" <?=$cas?> id="countriesHosMed">
                                                                <?php

                                                                if ($lvl == 5) {
                                                                    $iResult = $db->query("SELECT * FROM  medecin where id_medecin='$id_perso_session' and open_close!=1");
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
<!--                                                    <div class="col-sm-6">-->
<!--                                                        <div class="form-group">-->
<!--                                                            <label>Service <span-->
<!--                                                                        class="text-danger">*</span></label>-->
<!--                                                            <select class="form-control" name="id_service">-->
<!--                                                                <option value="0" selected="">...</option>-->
<!--                                                                --><?php
//
//                                                                $iResult = $db->query("SELECT * FROM service ");
//
//                                                                while ($data = $iResult->fetch()) {
//
//                                                                    $i = $data['id_service'];
//                                                                    echo '<option value ="' . $i . '">';
//                                                                    echo $data['nom'];
//                                                                    echo '</option>';
//
//                                                                }
//                                                                ?>
<!--                                                            </select>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>N° de la Chambre</label>
                                                            <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxChamHos" >
                                                            <div class="form-group input-group" style="width: 100%">
                                                                <select id="mySelect" class="form-control" name="chambre" onchange="myFunction()" required  >
                                                                
                                                                    
                                                                    <?php
                                                                    
                                                                    if($hospitalisation!='0'){
                                                                        $iResult = $db->query("SELECT * FROM chambres where open_close!=1 ");
                                                                        
                                                                        while ($data = $iResult->fetch()) {

                                                                        $i = $data['nom'];
                                                                            $id_cham = $data['id_chambre'];
                                                                        if($hospitalisation == $id_cham ){
                                                                            echo '<option value ="' . $id_cham . '" selected>';
                                                                            echo $data['nom'];
                                                                            echo '</option>';
                                                                        }else {
                                                                            echo '<option value ="' . $id_cham . '">';
                                                                            echo $data['nom'];
                                                                            echo '</option>';
                                                                        }

                                                                    }
                                                                    
                                                                    }else{
                                                                        $iResult = $db->query("SELECT * FROM chambres where open_close!=1"); 
                                                                        echo'<option value="0" selected="">...</option>';
                                                                        
                                                                            while ($data = $iResult->fetch()) {
    
                                                                            $i = $data['id_chambre'];
                                                                            echo '<option value ="' . $i . '">';
                                                                            echo $data['nom'];
                                                                            echo '</option>';
    
                                                                        }
                                                                    }

                                                                    
                                                                    ?>
                                                                </select>
                                                                <?php 

                                                                    echo '  <button  style="width: 10%; margin-left:10px" type="button" id="sum" data-toggle="modal"   style="background-color: transparent">';
                                                                        
                                                                        echo '</button>';

            
                                                                ?>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Type d'hospitalisation <span
                                                                        class="text-danger">*</span></label>
                                                            <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxTypeHos" >
                                                            <select class="form-control" name="id_type_hosp" <?=$cas?> id="countriesTypeHos">
                                                                <option value="0" selected="">...</option>
                                                                <?php

                                                                $iResult = $db->query("SELECT * FROM type_hosp where open_close!=1 ");

                                                                while ($data = $iResult->fetch()) {

                                                                    $i = $data['id_type_hosp'];
                                                                    echo '<option value ="' . $i . '">';
                                                                    echo $data['nom'];
                                                                    echo '</option>';

                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <?php if( $lvl == 3  || $lvl == 4 || $lvl == 7){?>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>N° du Lit <span
                                                                        class="text-danger">*</span></label>
                                                            <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxLitHos" >
                                                            <div class="form-group input-group" style="width: 100%">
                                                                <select class="form-control" name="lit" <?=$cas?>  id="countriesLitHos">
                                                                    <option value="0" selected="">...</option>
                                                                    <?php

                                                                    
                                                                    if($hospitalisation!='0'){
                                                                        $iResult = $db->query("SELECT * FROM lits where etat!=1 and id_chambre='$hospitalisation' and open_close!=1");
                                                                    }else{
                                                                        $iResult = $db->query("SELECT * FROM lits where etat!=1 and  open_close!=1"); 
                                                                    }

                                                                    while ($data = $iResult->fetch()) {

                                                                        $i = $data['id_lit'];
                                                                        echo '<option value ="' . $i . '">';
                                                                        echo $data['nom'];
                                                                        echo '</option>';

                                                                    }
                                                                    ?>
                                                                </select>
                                                                <button type="button" data-toggle="modal"  style="background-color: transparent; border-radius: 20px; border-color: black; border-bottom-color: yellow; border-top-color: red; margin-top: 5px; margin-bottom:  5px; margin-left: 5px;
                                                                    border-right-color: blue;
                                                                    border-left-color: orange;"><a href="nouveau_lit.php"><i class="fas fa-plus"></i></a></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php }else {?>
                                                        <input class="form-control" type="hidden" name="lit" value="0">
                                                    <?php }?>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Nbre de jour <span
                                                                        class="text-danger">*</span></label>
                                                            <input class="form-control" type="number" name="nb_jour" <?=$cas?>>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="m-t-20 text-center">
                                                    <button class="btn btn-primary submit-btn">Enregistrer</button>
                                                    <a href="liste_hospitalisation.php" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>

                                                </div>
                                            </form>
                                        </div>
                                    </div>


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


    <!--    Modal pour ajouter Categorie Contrat-->
<script> 
function myFunction() {
  var x = document.getElementById("mySelect").value;
  document.getElementById("sum").innerHTML='<a href="save_chambre_lit.php?id='+x+'"><i class="fas fa-check"></i></a>';
                                        }
</script>
    <script>

        searchBoxHosInf = document.querySelector("#searchBoxHosInf");
        countriesHosInf = document.querySelector("#countriesHosInf");
        var when = "keyup"; //You can change this to keydown, keypress or change

        searchBoxHosInf.addEventListener("keyup", function (e) {
            var text = e.target.value; //searchBox value
            var options = countriesHosInf.options; //select options
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
                searchBoxHosInf.selectedIndex = 0; //if nothing matches it selects the default option
            }
        });
    </script>
    <script>

        searchBoxHosMed = document.querySelector("#searchBoxHosMed");
        countriesHosMed = document.querySelector("#countriesHosMed");
        var when = "keyup"; //You can change this to keydown, keypress or change

        searchBoxHosMed.addEventListener("keyup", function (e) {
            var text = e.target.value; //searchBox value
            var options = countriesHosMed.options; //select options
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
                searchBoxHosMed.selectedIndex = 0; //if nothing matches it selects the default option
            }
        });
    </script>
    <script>

        searchBoxTypeHos = document.querySelector("#searchBoxTypeHos");
        countriesTypeHos = document.querySelector("#countriesTypeHos");
        var when = "keyup"; //You can change this to keydown, keypress or change

        searchBoxTypeHos.addEventListener("keyup", function (e) {
            var text = e.target.value; //searchBox value
            var options = countriesTypeHos.options; //select options
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
                searchBoxTypeHos.selectedIndex = 0; //if nothing matches it selects the default option
            }
        });
    </script>
    <script>

        searchBoxLitHos = document.querySelector("#searchBoxLitHos");
        countriesLitHos = document.querySelector("#countriesLitHos");
        var when = "keyup"; //You can change this to keydown, keypress or change

        searchBoxLitHos.addEventListener("keyup", function (e) {
            var text = e.target.value; //searchBox value
            var options = countriesLitHos.options; //select options
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
                searchBoxLitHos.selectedIndex = 0; //if nothing matches it selects the default option
            }
        });
    </script>

    <script>

        searchBoxChamHos = document.querySelector("#searchBoxChamHos");
        mySelect = document.querySelector("#mySelect");
        var when = "keyup"; //You can change this to keydown, keypress or change

        searchBoxChamHos.addEventListener("keyup", function (e) {
            var text = e.target.value; //searchBox value
            var options = mySelect.options; //select options
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
                searchBoxChamHos.selectedIndex = 0; //if nothing matches it selects the default option
            }
        });
    </script>

    <!--//Footer-->
<?php
include('foot.php');
?>