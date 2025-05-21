<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');

?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"><i class="fas fa-users" style="color: silver"></i> Liste des retraits </h1>
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
                            <ul class="nav nav-pills" style="float: right;">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="modal" data-target="#ajouterRetrait"
                                       href="#home">
                                        <i class="fas fa-cubes"></i>
                                        Nouveau retrait
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-pills"   style="float: right;">
                                <li class="nav-item">
                                    <a class="nav-link active" href="etat_print_liste_retrait.php" target="blank" style="margin-right: 20px" ><i class="fas fa-download"></i> Historique
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
                                    <th><p align="center">Banque</p></th>
                                    <th><p align="center" >Auteur</p></th>
                                    <th><p align="center" >Montant</p></th>
                                    <th><p align="center" >Motif</p></th>
                                    <th><p align="center" >Date</p></th>
                                    <th><p align="center" >Options</p></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                $query = "SELECT * from retrait where open_close!=1 order by date_retrait desc  ";
                                $q = $db->query($query);
                                while($row = $q->fetch())
                                {
                                    $id_retrait  =$row['id_retrait'];
                                    $id_banque  =$row['id_banque'];
                                    $montant  =$row['montant'];
                                    $id_perso  =$row['id_perso'];
                                    $motif  =$row['motif'];
                                    $date_retrait  =$row['date_retrait'];

                                    $sql = "SELECT DISTINCT * from banque where id_banque = '$id_banque'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        $banque= $table['banque'] ;
                                    }
                                    
                                    $sql = "SELECT * from personnel where id_personnel = '$id_perso'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($tables as $table)
                                    {
                                        $nom=$table['nom'].' '.$table['prenom'];
                                    }
                                    
                                    if(empty($nom)){
                                        $nom='N/A';
                                    }

                                    ?>

                                    <tr>
                                        <td align="center"><b><?=$banque?></b></td>
                                        <td align="center"><b><?=$nom?></b></td>
                                        <td align="center"><b><?php echo number_format($montant); ?></b></td>
                                        <td align="center"> <a
                                                    class="btn btn-primary"
                                                   data-toggle="modal" data-target="#description<?=$id_banque?>"
                                                    title="view"
                                                    style="background-color: transparent">
                                                <i style="color: green" class="fas fa-eye"></i>
                                            </a> 
                                        <div class="modal fade" id="description<?= $id_banque ?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header" style="padding:20px 50px;">
                                                            <h3 align="center"><i class="fas fa-map"></i>
                                                                <b>Description</b></h3>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    title="Close">&times;
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="padding:40px 50px;">
                                                            <form class="form-horizontal" action="#"
                                                                  name="form" method="post">
                                                                <div class="form-group">
                                                                    <label>description:</label>
                                                                    <div class="col-sm-12">
                                                                        <textarea class="form-control" rows="5"  cols="70" disabled><?=$motif?></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <center>

                                                                            <input data-dismiss="modal" type="text"
                                                                                   style=" width:25% " name=""
                                                                                   class="btn btn-danger"
                                                                                   value="Annuler"/></center>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td align="center"><b><?=$date_retrait?></b></td>
                                        <td style="text-align: center">
                                            <?php
                                                echo '<a class="btn btn-warning" data-toggle="modal" data-target="#ajouterExa' . $id_type_exa . '"  style="background-color: transparent"><i  style="color: orange" class="fas fa-pen"></i></a>';
                                            ?>
                                            <a class="btn btn-danger"  href="delete_type_examen.php?id_type_exa=<?=$id_type_exa?>"  style="background-color: transparent; margin-right: 10px;">
                                                <i style="color: red" class="fas fa-trash"></i></a>
                                        
                                            <div class="modal fade" id="ajouterExa<?= $id_type_exa ?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header" style="padding:20px 50px;">
                                                            <h3 align="center"><i class="fas fa-map"></i>
                                                                <b>Modifier</b></h3>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    title="Close">&times;
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="padding:40px 50px;">
                                                            <form class="form-horizontal" action="update_retrait.php"
                                                                  name="form" method="post">
                                                                <div class="form-group">
                                                                    <label>Nom Banque:</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="hidden" name="id_banque" value="<?=$id_banque?>">
                                                                        <input type="text" name="auteur" class="form-control" value="<?=$nom_user?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                        <label>Nom Banque: <span
                                                                                    class="text-danger">*</span></label>
                                                                        <div class="col-sm-12">
                                                                            <select class="form-control"
                                                                                    name="id_banque">
                                                                                <option value="<?=$id_banque?>" selected="">
                                                                                    <?=$banque?>
                                                                                </option>
                                                                                <?php

                                                                                $iResult = $db->query("SELECT * FROM banque where open_close!=1 ");

                                                                                while ($data = $iResult->fetch()) {

                                                                                    $i = $data['id_banque'];
                                                                                    echo '<option value ="' . $i . '">';
                                                                                    echo $data['banque'];
                                                                                    echo '</option>';

                                                                                }

                                                                                ?>

                                                                            </select>
                                                                        </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Montant :</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="number" name="montant" class="form-control" value="<?=$montant?>">
                                                                    </div>
                                                                </div>

                                                                    <div class="form-group">
                                                                        <label>Auteur: <span
                                                                                    class="text-danger">*</span></label>
                                                                        <div class="col-sm-12">
                                                                            <select class="form-control"
                                                                                    name="id_perso">
                                                                                <option value="<?=$id_perso_session?>" selected="">
                                                                                    <?=$nom_user?>
                                                                                </option>
                                                                                <?php

                                                                                $iResult = $db->query("SELECT * FROM personnel where open_close!=1 ");

                                                                                while ($data = $iResult->fetch()) {

                                                                                    $i = $data['id_personnel'];
                                                                                    echo '<option value ="' . $i . '">';
                                                                                    echo $data['nom'] .' '. $data['prenom'];
                                                                                    echo '</option>';

                                                                                }

                                                                                ?>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Motif:</label>
                                                                        <div class="col-sm-12">
                                                                            <textarea class="form-control" rows="5"  cols="70" name="motif"><?=$motif?></textarea>
                                                                        </div>
                                                                    </div>

                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <center>
                                                                            <input type="submit" style=" width:25% "
                                                                                   name="submit_cs"
                                                                                   class="btn btn-primary"
                                                                                   value="Modifier">

                                                                            <input data-dismiss="modal" type="text"
                                                                                   style=" width:25% " name=""
                                                                                   class="btn btn-danger"
                                                                                   value="Annuler"/></center>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>

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
    <div class="modal fade" id="ajouterRetrait" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="padding:20px 50px;">
                    <h3 align="center"><i class="fas fa-map"></i> <b>Nouveau Retrait</b></h3>
                    <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
                </div>
                <div class="modal-body" style="padding:40px 50px;">
                    <form class="form-horizontal" action="save_retrait.php" name="form" method="post">
                        <div class="form-group">
                            <label>Nom Banque : <span
                                        class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <select class="form-control"
                                        name="id_banque">
                                    <option value="0" selected="">
                                        ...
                                    </option>
                                    <?php
    
                                    $iResult = $db->query("SELECT * FROM banque where open_close!=1 ");
    
                                    while ($data = $iResult->fetch()) {
    
                                        $i = $data['id_banque'];
                                        echo '<option value ="' . $i . '">';
                                        echo $data['banque'];
                                        echo '</option>';
    
                                    }
    
                                    ?>
    
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Auteur :</label>
                            <div class="col-sm-12">
                                <input type="text"  class="form-control" value="<?=$nom_user?>" disabled>
                                <input type="hidden" name="auteur" class="form-control" value="<?=$nom_user?>" >
                                <input type="hidden" name="id_perso" class="form-control" value="<?=$id_perso_session?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Montant :</label>
                            <div class="col-sm-12">
                                <input type="number" name="montant" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Motif:</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="5"  cols="70" name="motif"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <center>
                                    <input type="submit" style=" width:25% " name="submit_cs" class="btn btn-primary"
                                           value="Créer">
    
                                    <input data-dismiss="modal" type="text" style=" width:25% " name=""
                                           class="btn btn-danger" value="Annuler"/></center>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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