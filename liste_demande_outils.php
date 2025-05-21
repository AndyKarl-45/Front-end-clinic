<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');

?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"><i class="fas fa-random" style="color: silver"></i> Liste des demandes des fournitures</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme XXX, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                        .

                    </li>
                </ol>
                <div class="row">
                    <div class="col-xl-12">


                        <b>
                            
                            <!-- Nav pills -->
                            <?php //if($lvl == 10  || $lvl == 4 || $lvl == 7){ ?>
                            <ul class="nav nav-pills" style="float: right;">
                                <li class="nav-item">
                                    <a class="btn btn-primary" href="nouvelle_demande_outil.php">
                                        <i class="fas fa-user"></i>
                                        Nouvelle demande
                                    </a>
                                </li>
                            </ul>
                            <?php  //} ?>
                            <?php if($lvl == 6){ ?>
                            <!--<ul class="nav nav-pills" style="float: right;">-->
                            <!--    <li class="nav-item">-->
                            <!--        <a class="btn btn-primary" href="nouvelle_sortie_outil.php">-->
                            <!--            <i class="fas fa-user"></i>-->
                            <!--            Sortie fourniture-->
                            <!--        </a>-->
                            <!--    </li>-->
                            <!--</ul>-->
                            <?php } ?>
                            <ul class="nav nav-pills"   style="float: right; margin-right: 20px ;">
                                <li class="nav-item">
                                    <a class="nav-link" href="liste_demande_echec_outil.php">

                                        <?php

                                        if($lvl !=3 and $lvl != 4 and $lvl != 5 and $lvl != 7 and $lvl != 8 and $lvl !=9 and  $lvl!=6 ){
                                            $query = "SELECT DISTINCT count(id_ask_outil) as total from demande_outil WHERE id_perso = '$id_perso_session' and etat_dst=-1 ";
                                       }elseif($lvl == 4 || $lvl ==7 || $lvl==6 ){
                                            $query = "SELECT DISTINCT count(id_ask_outil) as total from demande_outil where etat_dst=-1  order by id_ask_outil desc";
                                       }
                                        
                                        switch ($lvl) {
                                        case '3';
                                        $query = "SELECT DISTINCT count(id_ask_outil) as total from demande_outil WHERE id_nurse = '$id_perso_session' and etat_dst=-1 "; 
                                            break;
                                        case '5';
                                        $query = "SELECT DISTINCT count(id_ask_outil) as total from demande_outil WHERE id_med = '$id_perso_session' and etat_dst=-1 ";   
                                            break;
                                        case '8';
                                        $query = "SELECT DISTINCT count(id_ask_outil) as total from demande_outil WHERE id_chi = '$id_perso_session' and etat_dst=-1 ";   
                                            break;
                                        case '9';
                                        $query = "SELECT DISTINCT count(id_ask_outil) as total from demande_outil WHERE id_lab = '$id_perso_session' and etat_dst=-1 ";
                                            break;
                                    }

                                        $q = $db->query($query);
                                        while($row = $q->fetch())
                                        {
                                            echo ' Demande en echec ['.$row['total'].']';

                                        }

                                        ?>


                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-pills"   style="float: right; margin-right: 20px ;">
                                <li class="nav-item">
                                    <a class="nav-link" href="liste_demande_traitement_outil.php">

                                        <?php

                                        if($lvl !=3 and $lvl != 4 and $lvl != 5 and $lvl != 7 and $lvl != 8 and $lvl !=9 and $lvl !=6){
                                            $query = "SELECT DISTINCT count(id_ask_outil) as total from demande_outil WHERE id_perso = '$id_perso_session' and etat_dst=0 and etat_src=1 ";
                                       }elseif($lvl == 4 || $lvl ==7 || $lvl==6){
                                            $query = "SELECT DISTINCT count(id_ask_outil) as total from demande_outil where etat_dst=0 and etat_src=1  ";
                                       }
                                        
                                        switch ($lvl) {
                                        case '3';
                                        $query = "SELECT DISTINCT count(id_ask_outil) as total from demande_outil WHERE id_nurse = '$id_perso_session' and etat_dst=0 and etat_src=1 ";
                                            break;
                                        case '5';
                                        $query = "SELECT DISTINCT count(id_ask_outil) as total from demande_outil WHERE id_med = '$id_perso_session' and etat_dst=0 and etat_src=1 ";
                                            break;
                                        case '8';
                                        $query = "SELECT DISTINCT count(id_ask_outil) as total from demande_outil WHERE id_chi = '$id_perso_session' and etat_dst=0 and etat_src=1 ";
                                            break;
                                        case '9';
                                        $query = "SELECT DISTINCT count(id_ask_outil) as total from demande_outil WHERE id_lab = '$id_perso_session' and etat_dst=0 and etat_src=1 ";
                                            break;
                                    }

                                        $q = $db->query($query);
                                        while($row = $q->fetch())
                                        {
                                            echo ' Demande en envoie['.$row['total'].']';

                                        }

                                        ?>


                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-pills"   style="float: right; margin-right: 20px ;">
                                <li class="nav-item">
                                    <a class="nav-link" href="liste_demande_outil_suite.php">

                                        <?php

                                        
                                        if($lvl !=3 and $lvl != 4 and $lvl != 5 and $lvl != 7 and $lvl != 8 and $lvl !=9 and $lvl !=6 ){
                                            $query = "SELECT DISTINCT count(id_ask_outil) as total from demande_outil WHERE id_perso = '$id_perso_session' and etat_src=0 and etat_dst=0 ";
                                       }
                                       if($lvl == 4 || $lvl ==7 || $lvl==6 ){
                                            $query = "SELECT DISTINCT count(id_ask_outil) as total from demande_outil where etat_src=0 and etat_dst=0  ";
                                       }
                                        
                                        switch ($lvl) {
                                        case '3';
                                        $query = "SELECT DISTINCT count(id_ask_outil) as total from demande_outil WHERE id_nurse = '$id_perso_session' and etat_dst=0 and etat_src=0"; 
                                            break;
                                        case '5';
                                        $query = "SELECT DISTINCT count(id_ask_outil) as total from demande_outil WHERE id_med = '$id_perso_session' and etat_dst=0 and etat_src=0 ";   
                                            break;
                                        case '8';
                                        $query = "SELECT DISTINCT count(id_ask_outil) as total from demande_outil WHERE id_chi = '$id_perso_session' and etat_dst=0 and etat_src=0 ";   
                                            break;
                                        case '9';
                                        $query = "SELECT DISTINCT count(id_ask_outil) as total from demande_outil WHERE id_lab = '$id_perso_session' and etat_dst=0 and etat_src=0 ";
                                            break;
                                    }

                                        $q = $db->query($query);
                                        while($row = $q->fetch())
                                        {
                                            echo ' Demande en cours ['.$row['total'].']';

                                        }

                                        ?>


                                    </a>
                                </li>
                            </ul>
                        </b>


                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>
                <!--                Main Body              -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-border table-striped custom-table mb-0" id="dataTable">
                                <thead>
                                <tr>
<!--                                    <th>Reference</th>-->
                                 
                                    <th>Auteur</th>
                                    <th>Date demande</th>
                                    <th>Date Validation</th>
                                    <th>Produits</th>
                                     <th>PDF</th>
                                    <!--<th class="text-right">Action</th>-->
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                if($lvl == 10)
                                    $query = "SELECT * from demande_outil WHERE id_perso = '$id_perso_session' and etat_dst=1 and etat_src=1 order by id_ask_outil desc";
                                else
                                $query = "SELECT * from demande_outil where etat_dst=1 and etat_src=1 order by id_ask_outil desc";

                                $q = $db->query($query);
                                while($row = $q->fetch())
                                {
                                $id_ask_outil = $row['id_ask_outil'];
                                $date_debut = $row['date_debut'];
                                $heure_debut = $row['heure_debut'];
                                $date_valide = $row['date_valide'];
                                $heure = $row['heure'];
                                $responsable = $row['responsable'];

                                ?>

                                <tr>
<!--                                    <td><a href="#">Ref_--><?//=$id_ask_medi?><!--</a></td>-->
                                 
                                    <td><a href="#"><img width="28" height="28" src="assetss/img/user.jpg"
                                                         class="rounded-circle m-r-5" alt=""><?=$responsable?></a></td>
                                    <td align="center"><a href="#" style="color: black"> <?php echo date("d-m-Y",strtotime($date_debut)); echo ' ('.$heure_debut.')'; ?>  </a></td>
                                    <td align="center"><a href="#" style="color: black"> <?php if($date_valide=='N/A'){echo 'N/A';}else{echo date("d-m-Y",strtotime($date_valide)); echo ' ('.$heure.')';} ?>  </a></td>
                                    <td align="center"><a
                                            class="btn btn-primary"
                                            href="details_demande_outil.php?id=<?php echo $id_ask_outil; ?>"
                                            title="view"
                                            style="background-color: transparent">
                                            <i style="color: green" class="fas fa-eye"></i>
                                        </a></td>
                                    <td ><a href="facture_ask_medi.php?id_ask_medi=<?=$id_ask_outil?>&lvl=<?=$lvl?>&id_perso=<?=$id_perso_session?>" target="_blank">
                                                <i class="fa fa-print"></i>
                                            </a></td>
                                </tr>
                                <?php }?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--                End Body              -->

                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>

            </div>
        </main>
    </div>
<?php
if (isset($_GET['witness'])) {
    $witness = $_GET['witness'];

    switch ($witness) {
        case '1';
            ?>
            <script>
                Swal.fire(
                    'Succès',
                    'Opération effectuée avec succès !',
                    'success'
                )
            </script>
            <?php
            break;
        case '-1';
            ?>
            <script>
                Swal.fire({
                    icon: 'Erreur',
                    title: 'Oops...',
                    text: 'Une erreur s\'est produite !',
                    footer: 'Reéssayez encore'
                })
            </script>
            <?php
            break;

    }
}
?>


    <!--//Footer-->
<?php
include('foot.php');
?>