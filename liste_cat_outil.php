<?php

include("first.php");
include('php/main_side_navbar.php');

?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Liste Catégorie de Fourniture</h1>
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
                                               data-target="#ajouterCat_outil"
                                               href="#home">
                                                <i class="fas fa-cubes"></i>
                                                Nouvelle catégorie
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
                                                    <table class="table table-bordered table-hover" id="dataTable"
                                                           width="100%" cellspacing="0">
                                                        <thead>
                                                        <tr class="bg-primary">
                                                            <th><p align="center" style="color: white">Catégorie</p>
                                                            </th>
                                                             <?php
                                                                     if( $lvl != 11 and $lvl !=10  ){
                                                                 ?>
                                                            <th><p align="center" style="color: white">Options</p></th>
                                                             <?php
                                                                 }
                                                             ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php

                                                        $query = "SELECT * from type_outil where open_close!=1";
                                                        $q = $db->query($query);
                                                        while ($row = $q->fetch()) {
                                                        $id_type_medi = $row['id_type_outil'];
                                                        $nom = $row['nom'];

                                                        ?>


                                                        <tr>
                                                            <input name="nom" type="hidden" value=""/>
                                                            <td align="center"><b><?=strtoupper($nom)?></b></td>
                                                            <?php
                                                                     if( $lvl != 11 and $lvl !=10  ){
                                                                 ?>
                                                            <td align="center"><a class="btn btn-danger"
                                                                                  href="delete_outil.php?id=<?= $id_type_outil ?>"
                                                                                  style="background-color: transparent">
                                                                    <i style="color: red"
                                                                       class="fas fa-trash"></i>
                                                                </a></td>
                                                                <?php
                                                                 }
                                                             ?>
                                                            <!--  -->

                                                        </tr>
                                                    <?php
                                                        }
                                                        ?>

                                                        </tbody>
                                                        <tfoot>
                                                        <tr class="bg-primary">
                                                            <th><p align="center" style="color: white">Catégorie</p>
                                                            </th>
                                                            <?php
                                                                     if( $lvl != 11 and $lvl !=10  ){
                                                                 ?>
                                                            <th><p align="center" style="color: white">Options</p></th>
                                                             <?php
                                                                 }
                                                             ?>
                                                        </tr>
                                                        </tfoot>

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


include("ajouter_cat_outil.php");


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