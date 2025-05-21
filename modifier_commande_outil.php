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
$ref_com_outil=$_REQUEST['ref_com_outil'];

$query  = "SELECT * from commande_outil where ref_com_outil='".$ref_com_outil."'";
$q = $db->query($query);
while($row = $q->fetch())
{
    $id_com = $row['id_com'];
    /*-------------------- ETAT CIVILE --------------------*/
    $id_four=$row['id_four'];
    $frais = $row['frais'];
    $date_c_com = $row['date_c_com'];
    $date_r_com = $row['date_r_com'];
    ?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Modifier  Commande :  <?php echo $ref_com?> </h1>
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
                                            <a class="nav-link active" href="liste_commande_outil_suite.php">
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

                                                $query = "SELECT  count( DISTINCT id_num_lot_outil) as total from commande_outil where   ref_com_outil='$ref_com_outil'  ";
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
                                                    <form class="form-horizontal" action="update_commande_outil.php" method="POST">
                                                        <div class="card-header">
                                                            <!--  <i class="fas fa-scroll"></i>
                                     <b>L'ensemble des salles de campresj.</b>
                                                                  -->
                                                            <input type="hidden" name="ref_com_outil" value="<?=$ref_com_outil?>">
                                                            <ul class="nav nav-pills"  >
                                                                <li class="nav-item">
                                                                    <button type="submit" style=" width:150px;"  name="submit_salle"  class="btn btn-primary" >Enregistrer</button>
                                                                </li>
                                                            </ul>

                                                        </div>
                                                        <div class="card-body">
                                                            <fieldset>
                                                                <div class="table-responsive">
                                                                    <table class="table  table-hover table-condensed" id="myTable">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td style="width: 50%">
                                                                                <span class="help-block small-font" >Fournisseur:</span>
                                                                                <input type="hidden" name="partie" value="1">
                                                                                <div class="col">
                                                                                    <select name="id_four" style="width:75%;border-top: 0; border-left: 0;
                                                                                border-right: 0;
                                                                                background: transparent;">
                                                                                        <option value="<?=$id_four?>"selected="">
                                                                                            <?php
                                                                                            $sql = "SELECT DISTINCT * from fournisseur where id_four= '$id_four'";

                                                                                            $stmt = $db->prepare($sql);
                                                                                            $stmt->execute();

                                                                                            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                                            foreach($tables as $table)
                                                                                            {
                                                                                                echo strtoupper($table['raison_social_four']);
                                                                                            }

                                                                                            $iResult = $db->query("SELECT * FROM fournisseur ");

                                                                                            while ($data = $iResult->fetch()) {

                                                                                                $i = $data['id_four'];
                                                                                                echo '<option value ="' . $i . '">';
                                                                                                echo $data['raison_social_four'];
                                                                                                echo '</option>';

                                                                                            }

                                                                                            ?>

                                                                                        </option>
                                                                                    </select>
                                                                            </td>
                                                                            <td>
                                                                                <span class="help-block small-font" >DATE COMMANDE:</span>
                                                                                <div class="col">
                                                                                    <input type="date"
                                                                                           class="form-control" name="date_c_com" value="<?=$date_c_com?>">
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
                                                        <b>L'ensemble des produits.</b>
                                                        <ul class="nav nav-pills"   style="float: right;">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" href="ajouter_commande_outil.php?ref_com_outil=<?=$ref_com_outil?>">
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
                                                                                    <th><p align="center" style="color: white">Fournitures</p></th>
                                                                                    <th><p align="center" style="color: white">Catégories</p></th>
                                                                                    <th><p align="center" style="color: white">Quanités</p></th>
                                                                                    <th><p align="center" style="color: white">Prix d'achat</p></th>
                                                                                    <th><p align="center" style="color: white">Option</p></th>


                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                <?php

                                                                                $sql = "SELECT  * from commande_outil where  ref_com_outil='$ref_com_outil' ";

                                                                                $stmt = $db->prepare($sql);
                                                                                $stmt->execute();

                                                                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                                foreach($tables as $table)
                                                                                {
                                                                                    $id_outil= $table['id_outil'];
                                                                                    $id_num_lot_outil= $table['id_num_lot_outil'];
                                                                                    $quantite= $table['qt_com_outil'];
                                                                                   // $prix= $table['prix_ht'];




                                                                                    $query = "SELECT * from outil where id_outil = '$id_outil'  ";
                                                                                    $q = $db->query($query);
                                                                                    while($row = $q->fetch())
                                                                                    {
                                                                                        $id = $row['id_outil'];
                                                                                        $ref_outil = $row['ref_outil'];
                                                                                        $designation = $row['nom_outil'];
                                                                                        $id_type_outil= $row['id_type_outil'];
                                                                                        $prix= $row['prix_unit'];

                                                                                        $sql = "SELECT DISTINCT * from type_outil where id_type_outil = '$id_type_outil'";

                                                                                        $stmt = $db->prepare($sql);
                                                                                        $stmt->execute();

                                                                                        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                                        foreach ($tables as $table) {
                                                                                            $type_outil= $table['nom'];
                                                                                        }
                                                                                        if(empty($id_type_outil)){
                                                                                            $type_outil='N/A';
                                                                                        }



                                                                                        ?>

                                                                                        <tr>
                                                                                            <input name="id" type="hidden" value="<?php //echo $row['id'];?>" />
                                                                                            <td align="center"> <?php echo $designation; ?>   </td>
                                                                                            <td align="center"><?=$type_outil?> </td>
                                                                                            <td align="center"><?php echo number_format($quantite) ?>  </td>
                                                                                            <td align="center"><?php echo number_format($prix) ?>  </td>
                                                                                            <td align="center" style="width: 18%">
                                                                                                <a class="btn btn-danger"  href="delete_com_outil.php?ref_com_outil=<?php echo $ref_com_outil; ?>&id_num_lot_outil=<?=$id_num_lot_outil?>" title="view"
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
                                                                                    <th><p align="center" style="color: white">Fournitures</p></th>
                                                                                    <th><p align="center" style="color: white">Catégories</p></th>
                                                                                    <th><p align="center" style="color: white">Quanités</p></th>
                                                                                    <th><p align="center" style="color: white">Prix d'achat</p></th>
                                                                                    <th><p align="center" style="color: white">Option</p></th>

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
                    icon: 'Solde Insuffisant !!!',
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