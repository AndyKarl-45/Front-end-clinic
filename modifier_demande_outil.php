<?php

include('first.php');
include('php/db.php');
include('php/main_side_navbar.php');

// $query  = "SELECT id_personnel as total from personnel";
// $q = $conn->query($query);
// while($row = $q->fetch_assoc())
// {
//     $total = $row["total"];
// }
// $id_personnel = $total;

?>
<?php
//$ido=$_REQUEST['id'];
//$query  = "SELECT count(id_personnel) as total from personnel where salle=\"SALLE MIMBOMAN\"";
//$q = $conn->query($query);
//while($row = $q->fetch_assoc())
//{
//    $total = $row["total"];
//}
//$totat_personnel = $total;

?>
<?php
$id=$_REQUEST['id'];

$query  = "SELECT * from demande_outil where id_ask_outil='".$id."'";
$q = $db->query($query);
while($row = $q->fetch())
{
    $id_ask_outil = $row['id_ask_outil'];
    /*-------------------- ETAT CIVILE --------------------*/
    $id_perso = $row['id_perso'];
    $id_nurse = $row['id_nurse'];
    $id_med = $row['id_med'];
    $id_chi = $row['id_chi'];
    $id_lab = $row['id_lab'];
    $id_num_lot_outil = $row['id_num_lot_outil'];
    $date_debut=$row['date_debut'];
    $date_valide=$row['date_valide'];
    $heure=$row['heure'];
    $heure_debut = $row['heure_debut'];
    
     if($id_perso!=0 and $id_nurse == 0 and $id_med == 0 and $id_chi == 0 and $id_lab ==0){
        $sql = "SELECT DISTINCT * from personnel where id_personnel = '$id_perso'";
                
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($tables as $table) {
                $nom= $table['nom'] . ' ' . $table['prenom'];
            }
        
    }elseif($id_perso==0 and $id_nurse != 0 and $id_med == 0 and $id_chi == 0 and $id_lab ==0){
    $sql = "SELECT DISTINCT * from nurse where id_nurse = '$id_nurse'";
            
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tables as $table) {
            $nom= $table['nom_n'] . ' ' . $table['prenom_n'];
        } 
        
    }elseif($id_perso==0 and $id_nurse == 0 and $id_med != 0 and $id_chi == 0 and $id_lab ==0){
         $sql = "SELECT DISTINCT * from medecin where id_medecin = '$id_med'";
            
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($tables as $table) {
                $nom= $table['nom_m'] . ' ' . $table['prenom_m'];
            }
        
    }elseif($id_perso ==0 and $id_nurse == 0 and $id_med == 0 and $id_chi != 0 and $id_lab ==0){
        $sql = "SELECT DISTINCT * from chirugien where id_chirugien = '$id_chi'";
                
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($tables as $table) {
                $nom= $table['nom_c'] . ' ' . $table['prenom_c'];
            }
        
    }elseif($id_perso ==0 and $id_nurse == 0 and $id_med == 0 and $id_chi == 0 and $id_lab !=0){
        $sql = "SELECT DISTINCT * from laboratin where id_laboratin = '$id_lab'";
                
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($tables as $table) {
                $nom= $table['nom_l'] . ' ' . $table['prenom_l'];
            }
            
    ?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Détails  de la demande : <?php echo 'REF_DEMANDE_'.$id_ask_outil; ?> </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme XXX, il est <?=date("G:i");?> en ce jour du <?=dateToFrench("now","l j F Y");?>.
                    </li>
                </ol>
                <!--                Main Body-->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <b>
                                    <ul class="nav nav-pills" style="float: right;">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="liste_demande_outil.php">
                                                Retour
                                            </a>
                                        </li>

                                    </ul>

                                    <!-- Nav pills -->
                                    <ul class="nav nav-pills">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="pill" href="#home">
                                                <i class="fas fa-cubes"></i>
                                                Détails
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="pill" href="#menu2">
                                                <i class="fas fa-cubes"></i>
                                                <?php

                                                $query = "SELECT DISTINCT count(id_outil) as total from demande_materiel_outil where id_ask_outil='$id_ask_outil' ";
                                                $q = $db->query($query);
                                                while($row = $q->fetch())
                                                {

                                                    echo ' Fournitures['.$row['total'].']';
                                                }

                                                ?>

                                            </a>
                                        </li>

                                    </ul>
                                </b>
                            </div>

                            <div class="card-body">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <!--********************************************ETAT CIVILE************************************************* -->
                                    <!-- Etat Civile-->
                                    <div class="tab-pane container active" id="home">
                                        <!-- infos civile-->

                                        <!-- <h5><b><u>NB:</u></b> Aucune information ne peut être modifier.</h5> -->

                                        <div class="row">
                                            <hr/>
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="card mb-4">
                                                    <form class="form-horizontal" action="#" method="POST">
                                                        <div class="card-header">
                                                            <!--  <i class="fas fa-scroll"></i>
                                     <b>L'ensemble des salles de campresj.</b>
                                                                  -->

                                                        </div>
                                                        <div class="card-body">
                                                            <fieldset>
                                                                <div class="table-responsive">
                                                                    <table class="table  table-hover table-condensed" id="myTable">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td style="width: 50%">
                                                                                <span class="help-block small-font" >Destinataire:</span>
                                                                                <div class="col">
                                                                                    <input type="text" name="nom_salle" value="<?=$nom?>" style="width:75%;border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" disabled>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <span class="help-block small-font" >Date de demande:</span>
                                                                                <div class="col">
                                                                                    <?php  echo'<input  style="width:75%;border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;" name="date_debut" value="'.date("d-m-Y",strtotime($date_debut)).'"disabled>';
                                                                                    ?>
                                                                                </div>
                                                                            </td>
                                                                        </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="card-footer">

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--********************************************INFO RH************************************************* -->



                                    <div class="tab-pane container" id="menu2">
                                        <!-- infos civile-->

                                        <!--  <h5><b><u>NB:</u></b> Veillez saisir vos informations concernant le traitement de ressource humaine</h5> -->




                                        <div class="row">
                                            <hr/>
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="card mb-4">
                                                    <div class="card-header">
                                                        <i class="fas fa-scroll"></i>
                                                        <b>L'ensemble des fournitures.</b>
                                                        <ul class="nav nav-pills" style="float: right;">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" href="ajouter_ask_outil.php?id_ask_outil=<?=$id_ask_outil?>">
                                                                    <i class="fas fa-cubes"></i>
                                                                    Ajouter fourniture
                                                                </a>
                                                            </li>

                                                        </ul>

                                                    </div>
                                                    <div class="card-body">
                                                        <div class="well bs-component">
                                                            <form class="form-horizontal">
                                                                <fieldset>
                                                                    <div class="table-responsive">
                                                                        <form method="post" action="" >
                                                                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                                <thead>
                                                                                <tr class="bg-primary">
                                                                                    <!-- <th><p align="center">Matricule </p></th> -->
                                                                                    <th><p align="center" style="color: white">Code Fourniture</p></th>
                                                                                    <th><p align="center" style="color: white">Fournitures</p></th>
                                                                                    <th><p align="center" style="color: white">Quanités</p></th>
                                                                                    <th><p align="center" style="color: white">Destinataires</p></th>
                                                                                    <th><p align="center" style="color: white">Catégorie</p></th>
                                                                                    <th><p align="center" style="color: white">Date de demande </p></th>
                                                                                    <th><p align="center" style="color: white">Date de validation </p></th>
                                                                                    <th><p align="center" style="color: white">Options</p></th>

                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                <?php

                                                                                $sql = "SELECT DISTINCT * from demande_materiel_outil where  id_ask_outil='$id_ask_outil'  ";

                                                                                $stmt = $db->prepare($sql);
                                                                                $stmt->execute();

                                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                                foreach($tables as $table)
                                                                                {
                                                                                    $id_outil= $table['id_outil'];
                                                                                    $quantite= $table['quantite'];
                                                                                    $id_ask_outil= $table['id_ask_outil'];




                                                                                    $query = "SELECT * from outil where id_outil = '$id_outil'  ";
                                                                                    $q = $db->query($query);
                                                                                    while($row = $q->fetch())
                                                                                    {
                                                                                        $id = $row['id_outil'];
                                                                                        $ref_outil = $row['ref_outil'];
                                                                                        $nom_outil = $row['nom_outil'];
                                                                                        $id_type_outil= $row['id_type_outil'];



                                                                                        ?>

                                                                                        <tr>
                                                                                            <input name="id" type="hidden" value="<?php //echo $row['id'];?>" />

                                                                                            <td align="center"> <?php echo $ref_outil; ?>   </td>
                                                                                            <td align="center"> <?php echo $nom_outil; ?>   </td>
                                                                                            <td align="center"><?php echo number_format($quantite) ?>  </td>
                                                                                            <td align="center"> <?php echo $nom; ?>   </td>
                                                                                            <td align="center">
                                                                                                <?php
                                                                                                $sql = "SELECT DISTINCT * from type_outil where id_type_outil = '$id_type_outil'";

                                                                                                $stmt = $db->prepare($sql);
                                                                                                $stmt->execute();

                                                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                                                foreach($tables as $table)
                                                                                                {
                                                                                                    echo $table['nom'];
                                                                                                }

                                                                                                ?>
                                                                                            </td>
                                                                                            <td align="center"><?php echo date("d-m-Y",strtotime($date_debut)); ?></td>
                                                                                            <td align="center"> <?php if($date_valide=='N/A'){echo 'N/A';}else{echo $date_valide; echo ' ('.$heure.')';} ?></td>
                                                                                            <td align="center" style="width: 18%">
                                                                                                <a class="btn btn-danger"  href="delete_ask_outil.php?id_ask_outil=<?php echo $id_ask_outil; ?>&id_ask_mat=<?=$id_ask_outil?>" title="view"
                                                                                                   style="background-color: transparent">
                                                                                                    <i  style="color: red" class="fas fa-trash"></i>
                                                                                                </a>

                                                                                            </td>
                                                                                        </tr>

                                                                                    <?php }
                                                                                } ?>
                                                                                </tbody>




                                                                                <tfoot>
                                                                                <tr class="bg-primary">
                                                                                    <th><p align="center" style="color: white">Code Fourniture</p></th>
                                                                                    <th><p align="center" style="color: white">Fournitures</p></th>
                                                                                    <th><p align="center" style="color: white">Quanités</p></th>
                                                                                    <th><p align="center" style="color: white">Destinataires</p></th>
                                                                                    <th><p align="center" style="color: white">Catégorie</p></th>
                                                                                    <th><p align="center" style="color: white">Date de demande </p></th>
                                                                                    <th><p align="center" style="color: white">Date de validation </p></th>
                                                                                    <th><p align="center" style="color: white">Options</p></th>

                                                                                </tr>
                                                                                </tfoot>
                                                                                <tbody></tbody>
                                                                            </table>
                                                                        </form>
                                                                    </div>
                                                                </fieldset>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--****************************************** ............************************************************ -->






                                    <!--****************************************** ............************************************************ -->

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
    <?php
}
?>
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
        case '-2';
            ?>
            <script>
                Swal.fire({
                    icon: 'Stock Insuffisant',
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