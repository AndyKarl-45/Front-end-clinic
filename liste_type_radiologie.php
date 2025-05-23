<?php

include("first.php");
include('php/main_side_navbar.php');

?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Liste type de radiologie</h1>
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

                                <!-- Nav pills -->

                                <b>

                                    <!-- Nav pills -->
                                    <ul class="nav nav-pills" style="float: right;">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="modal"
                                               data-target="#ajouterTypeRadiologie"
                                               href="#home">
                                                <i class="fas fa-cubes"></i>
                                                Nouveau type de radiologie
                                            </a>
                                        </li>
                                    </ul>
                                </b>
                            </div>
                            <div class="card-body">
                                <div class="well bs-component">
                                    <form class="form-horizontal">
                                        <fieldset>
                                            <div class="table-responsive">
                                                <form method="post" action="">
                                                    <table class="table table-border table-striped custom-table mb-0" id="dataTable"
                                                           width="100%" cellspacing="0">
                                                        <thead>
                                                        <tr>
                                                            <th><p align="center">Type de radiologie</p></th>
                                                            <th><p align="center">Prix</p></th>
                                                            <th><p align="center">Options</p></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php

                                                        $query = "SELECT * from type_radiologie order by nom desc ";
                                                        $q = $db->query($query);
                                                        while ($row = $q->fetch()) {
                                                            $id_type_radiologie = $row['id_type_radiologie'];
                                                            $nom = $row['nom'];
                                                            $prix_t_radiologie  =$row['prix_t_radiologie'];
                                                         ?>


                                                        <tr>
                                                            <input name="nom" type="hidden" value=""/>
                                                            <td align="center"><b><?=$nom?></b></td>
                                                            <td align="center"><b><?php echo number_format($prix_t_radiologie); ?></b></td>
                                                            <td align="center">
                                                                <?php
                                                                echo '<a class="btn btn-warning" data-toggle="modal" data-target="#modifierTypeRadiologie' . $id_type_radiologie. '"  style="background-color: transparent"><i  style="color: orange" class="fas fa-pen"></i></a>';
                                                                ?>
                                                                <div class="modal fade" id="modifierTypeRadiologie<?= $id_type_radiologie ?>" role="dialog">
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
                                                                                <form class="form-horizontal" action="update_type_radiologie.php"
                                                                                      name="form" method="post">
                                                                                    <div class="form-group">
                                                                                        <label>Nom :</label>
                                                                                        <div class="col-sm-12">
                                                                                            <input type="hidden" name="id_type_radiologie" value="<?=$id_type_radiologie?>">
                                                                                            <input type="text" name="nom" class="form-control" value="<?=$nom?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>Prix :</label>
                                                                                        <div class="col-sm-12">
                                                                                            <input type="number" name="prix_t_radiologie" class="form-control" value="<?=$prix_t_radiologie?>">
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

                                                                <a class="btn btn-danger"  href="delete_type_radiologie.php?id_type_radiologie=<?=$id_type_radiologie?>"  style="background-color: transparent">
                                                                        <i style="color: red" class="fas fa-trash"></i>
                                                                    </a></td>
                                                        </tr>

                                                    <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </form>
                                            </div>
                                        </fieldset>
                                    </form>
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


include("ajouter_type_radiologie.php");


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

    }
}
?>


    <!--//Footer-->
<?php
include('foot.php');
?>