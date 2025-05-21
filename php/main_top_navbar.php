<?php
 $date_now= strtotime(date('Y-m-d')); 
  $total_peremption_=0;
 $total_peremption_phar=0;
 $total_peremption_mag=0;
  $total_stock_alert=0;
 $total_stock_alert_phar=0;
 $total_stock_alert_mag=0;
 $stock_alert=5;
 $query = "SELECT * from pharmacie where date_exp != null";
    $q = $db->query($query);
    while ($row = $q->fetch()) {
        $date_exp = $row['date_exp'];
           $quantite = $row['quantite'];
        
          $timestampExp = strtotime($date_exp); 
          if ($date_now >= $timestampExp){
              $total_peremption_phar++;
          }
          
          if ($quantite <= $stock_alert){
              $total_stock_alert_phar++;
          }
    }
  
 $query = "SELECT * from magasin where date_exp != null  ";
    $q = $db->query($query);
    while ($row = $q->fetch()) {
         $date_exps = $row['date_exp'];
           $qt_com = $row['qt_com'];
         
          $timestampExp = strtotime($date_exps); 
          if ($date_now >= $timestampExp){
              $total_peremption_mag++;
          }
          
          if ($qt_com <= $stock_alert){
              $total_stock_alert_mag++;
          }
    }
    /*----Total---*/
    $total_peremption = $total_peremption_mag + $total_peremption_phar;
     $total_stock_alert =  $total_stock_alert_mag +  $total_stock_alert_phar;
?>
<nav class="sb-topnav navbar navbar-expand-sm navbar-dark bg-dark sticky-top">
    <a class="navbar-brand" href="index.php">
        <?php
        echo $siteName;
        $lvl = $_SESSION['rainbo_lvl'];
        $chantier_user = $_SESSION['rainbo_chantier'];
        if ($chantier_user == 0)
            $chantier_user = "N/A";
        else {
            $query = "SELECT * from chantier where id_chantier = $chantier_user";
            $q = $db->query($query);
            while ($row = $q->fetch()) {
                $chantier_user = $row['nom_chantier'];
            }
        }
        ?>
    </a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i>
    </button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <!--            <div class="inner-text">-->
            <!--                <i class="fas fa-home"></i><sup><span class="badge badge-warning">-->
            <? //=$salle_user?><!--</span></sup>-->
            <!--            </div>-->
            <!--            &nbsp;&nbsp;&nbsp;-->
            <!--<div class="inner-text">-->
            <!--    <a  data-toggle="modal" data-target="#listeNotification"></a>-->
                
            <!--</div>-->
            &nbsp;&nbsp;&nbsp;&nbsp;
            <?php
                if( $lvl == 4 || $lvl == 6 || $lvl == 10 || $lvl == 11){
            ?>
            <div class="inner-text">
                <ul class="navbar-nav ml-auto ml-md-0">
                        <li class="nav-item dropdown">
                            <a  style="color :white" class=" dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">Stock Alet<sup><span class="badge badge-warning"><?=$total_stock_alert?></span></sup></a>
                             
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="liste_stock_alert_phar.php">Pharmacie (<?=$total_stock_alert_phar?>) </a>
                                
                                <a class="dropdown-item" href="liste_stock_alert_mag.php">Magasin (<?=$total_stock_alert_mag?>)</a>
                                
                        </li>
                </ul>
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <div class="inner-text">
                <ul class="navbar-nav ml-auto ml-md-0">
                        <li class="nav-item dropdown">
                            <a  style="color :white" class=" dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">Péremption<sup><span class="badge badge-warning"><?=$total_peremption?></span></sup></a>
                             
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="liste_peremption_phar.php">Pharmacie (<?=$total_peremption_phar?>) </a>
                                
                                <a class="dropdown-item" href="liste_peremption_mag.php">Magasin (<?=$total_peremption_mag?>)</a>
                                
                        </li>
                </ul>
            </div>
            <!--<div class="inner-text">-->
            <!--    <a  data-toggle="modal" data-target="#listeNotification">Péremption<sup><span class="badge badge-warning">6</span></sup></a>-->
            <!--</div>-->
            &nbsp;&nbsp;&nbsp;&nbsp;
            <?php }?>
            <div class="inner-text">
                <a  data-toggle="modal" data-target="#listeNotification"><i class='fas fa-bell'></i><sup><span class="badge badge-warning">6</span></sup></a>
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <div class="inner-text">
                <i class="fas fa-map"></i><sup><span class="badge badge-warning"><?= $chantier_user ?></span></sup>
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp
            
            <div class="inner-text">
                <?php
                $grade = "";

                $iResult = $db->query('SELECT * FROM roles WHERE lvl = ' . $lvl);
                while ($data = $iResult->fetch()) {

                    $grade = $data['fonction'];
                }

                $id_perso_session = $_SESSION['rainbo_id_perso'];
                $nom_user = "";

                if($lvl==5 || $lvl== 8 || $lvl==9 || $lvl==3){
                    switch ($lvl) {
                        case '5';
                            $query1 = "SELECT * from medecin WHERE id_medecin= $id_perso_session";
                            $q1 = $db->query($query1);
                            while ($row1 = $q1->fetch()) {
                                $nom_user = $row1["nom_m"] . ' ' . $row1["prenom_m"];
                            }
                            break;
                        case '8';
                            $query1 = "SELECT * from chirugien WHERE id_chirugien= $id_perso_session";
                            $q1 = $db->query($query1);
                            while ($row1 = $q1->fetch()) {
                                $nom_user = $row1["nom_c"] . ' ' . $row1["prenom_c"];
                            }
                            break;
                        case '9';
                            $query1 = "SELECT * from laboratin WHERE id_laboratin= $id_perso_session";
                            $q1 = $db->query($query1);
                            while ($row1 = $q1->fetch()) {
                                $nom_user = $row1["nom_l"] . ' ' . $row1["prenom_l"];
                            }
                            break;
                        case '3';
                            $query1 = "SELECT * from nurse WHERE id_nurse= $id_perso_session";
                            $q1 = $db->query($query1);
                            while ($row1 = $q1->fetch()) {
                                $nom_user = $row1["nom_n"] . ' ' . $row1["prenom_n"];
                            }
                            break;

                    }

                }elseif($lvl == 1){
                    $query1 = "SELECT * from patient WHERE id_patient= $id_perso_session";
                    $q1 = $db->query($query1);
                    while ($row1 = $q1->fetch()) {
                        $nom_user = $row1["nom_p"] . ' ' . $row1["prenom_p"];
                    }
                }else{

                    $query1 = "SELECT * from personnel WHERE id_personnel= $id_perso_session";
                    $q1 = $db->query($query1);
                    while ($row1 = $q1->fetch()) {
                        $nom_user = $row1["nom"] . ' ' . $row1["prenom"];
                    }

                }



                echo strtoupper($nom_user) . ' (' . $grade . ')';
                ?>
            </div>

        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profile.php">Mon Profile</a>
                <?php
                if( $lvl == 4 || $lvl == 7 ){
                ?>
                <a class="dropdown-item" href="liste_utilisateurs.php">Utilisateurs</a>
                <?php }?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="deconnexion.php">Deconnexion</a>
            </div>
        </li>
    </ul>
    
</nav>
