<?php

include('first.php');
include('php/db.php');
include('php/main_side_navbar.php');


?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Fiche prénatale</h1>
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
                                            <a class="nav-link active" href="<?= $prenatale['option2_link'] ?>">

                                                Retour
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Nav pills -->
                                    <ul class="nav nav-pills">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="pill" href="#home">
                                                <i class="fas fa-heartbeat"></i>
                                                Paramètres du Patient
                                            </a>
                                        </li>
                                        <?php if($lvl != 3 and $lvl !=5 and $lvl !=4 and $lvl !=7){?>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="pill" href="#menu1">
                                                    <i class="fas fa-stethoscope"></i>
                                                    Rapport du Médecin
                                                </a>
                                            </li>
                                        <?php }?>
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
                                                                    <form action="save_prenatale.php" method="POST">
                                                                        <div class="row">

                                                                            <div class="col">
                                                                                <div class="form-group">
                                                                                    <?php if($lvl == 5){ ?>
                                                                                        <input type="hidden" class="form-control" name="id_nurse" value="0">
                                                                                        <label>Médecin<span
                                                                                                class="text-danger">*</span></label>
                                                                                        <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxMed" >
                                                                                        <select name="id_medecin"  class="form-control"  id="countriesMed">
                                                                                            <?php

                                                                                            if ($lvl == 5) {
                                                                                                $iResult = $db->query("SELECT * FROM  medecin where id_medecin='$id_perso_session'");
                                                                                            } else {
                                                                                                echo '<option value="0" selected="">....</option>';
                                                                                                $iResult = $db->query("SELECT * FROM  medecin");
                                                                                            }

                                                                                            while ($data = $iResult->fetch()) {

                                                                                                $i = $data['id_medecin'];
                                                                                                echo '<option value ="' . $i . '">';
                                                                                                echo $data['nom_m'] . ' ' . $data['prenom_m'];
                                                                                                echo '</option>';

                                                                                            }

                                                                                            ?>
                                                                                        </select>
                                                                                    <?php }elseif($lvl == 3){ ?>
                                                                                        <input type="hidden" class="form-control" name="id_medecin" value="0">
                                                                                        <label>Infirmière</label>
                                                                                        <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxConInf" >
                                                                                        <select class="form-control" name="id_nurse" id="countriesConInf">

                                                                                            <?php
                                                                                            if($lvl == 3) {
                                                                                                $iResult = $db->query("SELECT * FROM nurse where id_nurse='$id_perso_session' ");
                                                                                            }else {
                                                                                                $iResult = $db->query("SELECT * FROM nurse ");
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

                                                                                    <?php }else{?>
                                                                                        <div class="col">

                                                                                            <ul class="nav nav-pills">
                                                                                                <li class="nav-item">
                                                                                                    <a class="nav-link active " data-toggle="tab" href="#a1">
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
                                                                                                <div class="tab-pane active" id="a1">
                                                                                                    <span class="help-block small-font" >Médecin :</span>
                                                                                                    <div class="col">
                                                                                                        <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxMed" >
                                                                                                        <select name="id_medecin"  class="form-control"  id="countriesMed">

                                                                                                            <?php

                                                                                                            echo'<option value="0" selected>...</option>';
                                                                                                            $iResult = $db->query('SELECT * FROM medecin where   open_close!=1');


                                                                                                            while($data = $iResult->fetch()){

                                                                                                                $i = $data['id_medecin'];
                                                                                                                echo '<option value ="'.$i.'">';
                                                                                                                echo $data['nom_m'].' '.$data['prenom_m'];
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
                                                                                                <div class="tab-pane" id="a3">
                                                                                                    <span class="help-block small-font" >Infirmière :</span>
                                                                                                    <div class="col">
                                                                                                        <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxInf" >
                                                                                                        <select name="id_nurse" class="form-control"  id="countriesInf">

                                                                                                            <?php

                                                                                                            echo'<option value="0" selected>...</option>';
                                                                                                            $iResult = $db->query('SELECT * FROM nurse where   open_close!=1');

                                                                                                            while($data = $iResult->fetch()){

                                                                                                                $i = $data['id_nurse'];
                                                                                                                echo '<option value ="'.$i.'">';
                                                                                                                echo $data['nom_n'].' '.$data['prenom_n'];
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
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>Patient <span
                                                                                            class="text-danger">*</span></label>
                                                                                    <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBox" >
                                                                                    <select class="form-control" id="countries"
                                                                                            name="id_patient">
                                                                                        <!--                                                                                        <option value="0" selected="">-->
                                                                                        <!--                                                                                            ...-->
                                                                                        <!--                                                                                        </option>-->
                                                                                        <!--                                                                                        --><?php
                                                                                        //
                                                                                        //                                                                                        $iResult = $db->query("SELECT * FROM patient where open_close!=1 ");
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
                                                                                        <label>DDR </label>
                                                                                        <div class="form-group input-group">
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   value="" name="ddr"/>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <label>DPA </label>
                                                                                        <div class="form-group input-group">
                                                                                            <input type="text"
                                                                                                   class="form-control" name="dpa" value=""
                                                                                            />

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <label>Taille</label>
                                                                                        <div class="form-group input-group">
                                                                                            <input type="text"
                                                                                                   class="form-control" name="taille"
                                                                                                   value="0"/>
                                                                                            <div class="input-group-prepend ">
                                                                                                <span class="input-group-text">cm</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <label>TE</label>
                                                                                        <!--   <input class="form-control" type="number">mmHg -->
                                                                                        <div class="form-group input-group">
                                                                                            <input type="text"
                                                                                                   class="form-control" name="te"
                                                                                                   value=""/>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <label>G</label>
                                                                                        <div class="form-group input-group">
                                                                                            <input type="text"
                                                                                                   class="form-control" name="g"
                                                                                                   value=""/>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <label>P</label>
                                                                                        <div class="form-group input-group">
                                                                                            <input type="text"
                                                                                                   class="form-control" name="p"
                                                                                                   value=""/>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <label>C.A.T</label>
                                                                                        <div class="form-group input-group">
                                                                                            <input type="text"
                                                                                                   class="form-control" name="cat"
                                                                                                   value=""/>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>Age de grossesse</label>
                                                                                    <div class="form-group input-group">
                                                                                        <input type="text"
                                                                                               class="form-control" name="grossesse"
                                                                                               value=""/>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>Conj</label>
                                                                                    <div class="form-group input-group">
                                                                                        <input type="text"
                                                                                               class="form-control" name="conj"
                                                                                               value=""/>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>Oed</label>
                                                                                    <div class="form-group input-group">
                                                                                        <input type="text"
                                                                                               class="form-control" name="oed"
                                                                                               value=""/>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>C.A</label>
                                                                                    <div class="form-group input-group">
                                                                                        <input type="text"
                                                                                               class="form-control" name="ca"
                                                                                               value=""/>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>Près</label>
                                                                                    <div class="form-group input-group">
                                                                                        <input type="text"
                                                                                               class="form-control" name="pres"
                                                                                               value=""/>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>BDC</label>
                                                                                    <div class="form-group input-group">
                                                                                        <input type="text"
                                                                                               class="form-control" name="bdc"
                                                                                               value=""/>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>TV</label>
                                                                                    <div class="form-group input-group">
                                                                                        <input type="text"
                                                                                               class="form-control" name="tv"
                                                                                               value=""/>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>Urines Alb</label>
                                                                                    <div class="form-group input-group">
                                                                                        <input type="text"
                                                                                               class="form-control" name="urinesalb"
                                                                                               value=""/>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>Urines Suc</label>
                                                                                    <div class="form-group input-group">
                                                                                        <input type="text"
                                                                                               class="form-control" name="urinessuc"
                                                                                               value=""/>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>RDV</label>
                                                                                    <div class="form-group input-group">
                                                                                        <input type="date"
                                                                                               class="form-control" name="date_rdv"
                                                                                               value=""/>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Prévention + Observation</label>
                                                                            <textarea class="form-control" rows="6"
                                                                                      cols="30" name="obs"></textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Plaintes</label>
                                                                            <textarea class="form-control" rows="6"
                                                                                      cols="30" name="plaintes"></textarea>
                                                                        </div>

                                                                        <div class="m-t-20 text-center">
                                                                            <button class="btn btn-primary submit-btn">Enregistrer</button>
                                                                            <a href="<?=$prenatale['option2_link']?>" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>
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
                                                                    <form action="save_consultation_med.php" method="POST">
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <?php
                                                                                    if( $lvl != 2 and $lvl != 8 and $lvl != 3){
                                                                                        ?>
                                                                                        <label>Patient <span
                                                                                                class="text-danger">*</span></label>
                                                                                        <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxRapConPat" >
                                                                                        <select class="form-control"
                                                                                                name="id_patient" id="countriesRapConPat">
                                                                                            <!--                                                                                        <option value="0" selected="">-----</option>-->
                                                                                            <!--                                                                                        --><?php
                                                                                            //
                                                                                            //
                                                                                            //
                                                                                            //                                                                                            $sql = "SELECT  * from patient where open_close!=1";
                                                                                            //
                                                                                            //                                                                                            $stmt = $db->prepare($sql);
                                                                                            //                                                                                            $stmt->execute();
                                                                                            //
                                                                                            //                                                                                            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                                                            //
                                                                                            //                                                                                            foreach($tables as $data)
                                                                                            //                                                                                            {
                                                                                            //                                                                                                $i = $data['id_patient'];
                                                                                            //                                                                                                echo '<option value ="' . $i . '" >';
                                                                                            //                                                                                               // echo $data['nom_p'] . ' ' . $data['prenom_p'];
                                                                                            //                                                                                                echo $data['ref_patient'];
                                                                                            //                                                                                                echo '</option>';
                                                                                            //                                                                                            }
                                                                                            //
                                                                                            //
                                                                                            //
                                                                                            //                                                                                        ?>  <?php include("SelectClientView.php"); ?>
                                                                                        </select>
                                                                                    <?php }?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>Médecin<span
                                                                                            class="text-danger">*</span></label>
                                                                                    <input type="search" class="form-control" placeholder="barre de recherche..." id="searchBoxRapConMed" >
                                                                                    <select class="form-control" name="id_medecin" id="countriesRapConMed">

                                                                                        <?php

                                                                                        if ($lvl == 5) {
                                                                                            $iResult = $db->query("SELECT * FROM  medecin where id_medecin='$id_perso_session'");
                                                                                        } else {
                                                                                            echo '<option value="0" selected="">....</option>';
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
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>observation<span class="text-danger">*</span></label>
                                                                            <textarea class="form-control" rows="20" name="obs_medecin"
                                                                                      cols="70"></textarea>
                                                                        </div>


                                                                        <div class="m-t-20 text-center">
                                                                            <button class="btn btn-primary submit-btn">Enregistrer</button>
                                                                            <a href="<?=$consultation['option2_link']?>" style=" width:150px;" class="btn btn-danger"><font>Annuler</font></a>


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
    <script>

        searchBoxRapConPat = document.querySelector("#searchBoxRapConPat");
        countriesRapConPat = document.querySelector("#countriesRapConPat");
        var when = "keyup"; //You can change this to keydown, keypress or change

        searchBoxRapConPat.addEventListener("keyup", function (e) {
            var text = e.target.value; //searchBox value
            var options = countriesRapConPat.options; //select options
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
                searchBoxRapConPat.selectedIndex = 0; //if nothing matches it selects the default option
            }
        });
    </script>
    <script>

        searchBoxRapConMed = document.querySelector("#searchBoxRapConMed");
        countriesRapConMed = document.querySelector("#countriesRapConMed");
        var when = "keyup"; //You can change this to keydown, keypress or change

        searchBoxRapConMed.addEventListener("keyup", function (e) {
            var text = e.target.value; //searchBox value
            var options = countriesRapConMed.options; //select options
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
                searchBoxRapConMed.selectedIndex = 0; //if nothing matches it selects the default option
            }
        });
    </script>


    <!-- <?php


    //include("ajouter_profession.php");


    ?> -->
    <!--//Footer-->
<?php
include('foot.php');
?>