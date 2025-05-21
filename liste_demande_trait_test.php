<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');

?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"><i class="fas fa-random" style="color: silver"></i> Liste des demandes de fournitures en envoie</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme XXX, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                        .

                    </li>
                </ol>
                <div class="row">
                    <div class="col-xl-12">


                        <b>
                             <?php if($lvl == 10){ ?>
                            <!-- Nav pills -->
                            <ul class="nav nav-pills" style="float: right;">
                                <li class="nav-item">
                                    <a class="btn btn-primary" href="nouvelle_demande_outil.php">
                                        <i class="fas fa-user"></i>
                                        Nouvelle demande
                                    </a>
                                </li>
                            </ul>
                             <?php } ?>
                            <ul class="nav nav-pills" style="float: right; margin-right: 20px ;">
                                <li class="nav-item">
                                    <a class="btn btn-primary" href="liste_demande_outils.php">
                                        <i class="fas fa-cubes"></i>
                                        Retour
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
                                    <<th><p align="center">Personnel</p></th>
                                    <th><p align="center">Fonction</p></th>
                                    <th><p align="center" >Date de demande </p></th>
                                    <th><p align="center" >Date de validation </p></th>
                                    <th><p align="center" >Fournitures</p></th>
                                    <th><p align="center" >Action</p></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                 if($lvl!=3 and $lvl!= 5 and $lvl != 8 and $lvl!=9 and $lvl!=4 and $lvl!=7){
                                    
                                    $query = "SELECT * from demande_outil WHERE id_perso = '$id_perso_session' and etat_src=1 and etat_dst=0 order by id_ask_outil desc";
                                    
                                }
                                switch ($lvl) {
                                    case '3';
                                    $query = "SELECT * from demande_outil WHERE id_nurse = '$id_perso_session'  and etat_src=1 and etat_dst=0  order by id_ask_outil desc";   
                                        break;
                                    case '5';
                                    $query = "SELECT * from demande_outil WHERE id_med = '$id_perso_session'  and etat_src=1 and etat_dst=0  order by id_ask_outil desc";   
                                        break;
                                    case '8';
                                    $query = "SELECT * from demande_outil WHERE id_chi = '$id_perso_session' and etat_src=1 and etat_dst=0  order by id_ask_outil desc";   
                                        break;
                                    case '9';
                                    $query = "SELECT * from demande_outil WHERE id_lab = '$id_perso_session' and etat_src=1 and etat_dst=0  order by id_ask_outil desc";   
                                        break;
                                }
                                
                                if($lvl == 4 || $lvl == 7 ){
                                    $query = "SELECT * from demande_outil where  etat_src=1 and etat_dst=0  order by id_ask_outil desc";
                                }
                                

                                $q = $db->query($query);
                                while($row = $q->fetch())
                                {

                                    $statut = $row['etat_dst'];
                                    $id_ask_outil = $row['id_ask_outil'];
                                    $id_perso = $row['id_perso'];
                                    $id_nurse = $row['id_nurse'];
                                    $id_med = $row['id_med'];
                                    $id_chi = $row['id_chi'];
                                    $id_lab = $row['id_lab'];
                                    $etat = $row['etat_src'];
                                    $date_debut = $row['date_debut'];
                                    $heure_debut = $row['heure_debut'];
                                    $date_valide = $row['date_valide'];
                                    $heure = $row['heure'];

                                    $sql = "SELECT DISTINCT * from personnel where id_personnel = '$id_perso'";
                
                                                    $stmt = $db->prepare($sql);
                                                    $stmt->execute();
                
                                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                                                    foreach ($tables as $table) {
                                                        $nom= $table['nom'] . ' ' . $table['prenom'];
                                                    }
                                    $sql = "SELECT DISTINCT * from roles where lvl = '$lvl'";
                
                                                    $stmt = $db->prepare($sql);
                                                    $stmt->execute();
                
                                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                                                    foreach ($tables as $table) {
                                                        $fonction= $table['fonction'];
                                                    }
                                    
                                    
                                    switch ($lvl) {
                                    case '3';
                                                $sql = "SELECT DISTINCT * from nurse where id_nurse = '$id_nurse'";
            
                                                $stmt = $db->prepare($sql);
                                                $stmt->execute();
            
                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                                                foreach ($tables as $table) {
                                                    $nom= $table['nom_n'] . ' ' . $table['prenom_n'];
                                                }   
                                        break;
                                    case '5';
                                                $sql = "SELECT DISTINCT * from medecin where id_medecin = '$id_med'";
            
                                                $stmt = $db->prepare($sql);
                                                $stmt->execute();
            
                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                                                foreach ($tables as $table) {
                                                    $nom= $table['nom_m'] . ' ' . $table['prenom_m'];
                                                }
                                        break;
                                    case '8';
                                        $sql = "SELECT DISTINCT * from chirugien where id_chirugien = '$id_chi'";
                
                                                    $stmt = $db->prepare($sql);
                                                    $stmt->execute();
                
                                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                                                    foreach ($tables as $table) {
                                                        $nom= $table['nom_c'] . ' ' . $table['prenom_c'];
                                                    }  
                                        break;
                                    case '9';
                                                    $sql = "SELECT DISTINCT * from laboratin where id_laboratin = '$id_lab'";
                
                                                    $stmt = $db->prepare($sql);
                                                    $stmt->execute();
                
                                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                                                    foreach ($tables as $table) {
                                                        $nom= $table['nom_l'] . ' ' . $table['prenom_l'];
                                                    }
                                        break;
                                }
                                
                                    if($lvl == 4 || $lvl == 7 ){
                                    $sql = "SELECT DISTINCT * from nurse where id_nurse = '$id_nurse'";
            
                                                $stmt = $db->prepare($sql);
                                                $stmt->execute();
            
                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                                                foreach ($tables as $table) {
                                                    $nom= $table['nom_n'] . ' ' . $table['prenom_n'];
                                                } 
                                    $sql = "SELECT DISTINCT * from medecin where id_medecin = '$id_med'";
            
                                                $stmt = $db->prepare($sql);
                                                $stmt->execute();
            
                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                                                foreach ($tables as $table) {
                                                    $nom= $table['nom_m'] . ' ' . $table['prenom_m'];
                                                }
                                    $sql = "SELECT DISTINCT * from chirugien where id_chirugien = '$id_chi'";
                
                                                    $stmt = $db->prepare($sql);
                                                    $stmt->execute();
                
                                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                                                    foreach ($tables as $table) {
                                                        $nom= $table['nom_c'] . ' ' . $table['prenom_c'];
                                                    } 
                                    $sql = "SELECT DISTINCT * from laboratin where id_laboratin = '$id_lab'";
                
                                                    $stmt = $db->prepare($sql);
                                                    $stmt->execute();
                
                                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                                                    foreach ($tables as $table) {
                                                        $nom= $table['nom_l'] . ' ' . $table['prenom_l'];
                                                    }
                                    }


                                    ?>

                                    <tr>
                                        <td align="center"><a href="#" style="color: black"> <?php echo $nom; ?>  </a></td>
                                        <td align="center"><a href="#" style="color: black"> <?php echo $fonction; ?>  </a></td>
                                        <td align="center"><a href="#" style="color: black"> <?php echo date("d-m-Y",strtotime($date_debut)); echo ' ('.$heure_debut.')'; ?>  </a></td>
                                        <td align="center"><a href="#" style="color: black"> <?php if($date_valide=='N/A'){echo 'N/A';}else{echo date("d-m-Y",strtotime($date_valide)); echo ' ('.$heure.')';} ?>  </a></td>
                                        <td align="center" style="width: 18%">
                                            <a class="btn btn-primary"  href="details_demande_outil.php?id=<?php echo $id_ask_outil; ?>" title="view"
                                               style="background-color: transparent">
                                                <i  style="color: green" class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                        <?php if($lvl == 6 || $lvl == 4 || $lvl == 7  ){?>
                                        <td align="center" style="width: 18%">
                                            <button  style=" width:140px;"    class="btn btn-warning" >En envoie
                                            </button>
                                        </td>

                                    <?php }else{
                                    if($statut==0){
                                        echo'<td align="center">';
                                    echo' <a class="btn btn-primary" href="refuser_reception_outil.php?id_ask_outil='.$id_ask_outil.'">
                                        <i class="fa fa-trash"></i></a>||<a class="btn btn-primary" href="valider_reception_outil.php?id_ask_outil='.$id_ask_outil.'"><i class="fa fa-check"></i></a>';

                                      }elseif($statut==1){
                                      echo'<a class="btn btn-success" href="details_demande_outil.php?id='.$id_ask_outil.'"><i class="fa fa-handshake"></i></a>';
                                                       }elseif($statut==-1){
                                                       echo'<a class="btn btn-danger" href="details_demande_outil.php?id='.$id_ask_outil.'"><i class="fas fa-handshake-slash"></i></a>';
                                        }
                                            echo'</td>';
                                 }?>
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