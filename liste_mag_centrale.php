<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');

?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"><i class="fas fa-hospital-alt" style="color: silver"></i>Magasin Centrale</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme XXX, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                        .

                    </li>
                </ol>
                <div class="row">
                    <div class="col-xl-12">
                        <ul class="nav nav-pills"   style="float: right;">
                            <li class="nav-item">
                                <a class="nav-link active" href="etat_excel_magasin.php" target="blank" style="margin-right: 20px" ><i class="fas fa-download"></i> Exporter
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-pills"   style="float: right;">
                            <li class="nav-item">
                                <a class="nav-link active" href="etat_print_magasin.php" target="blank" style="margin-right: 20px" ><i class="fa fa-print"></i> Imprimer
                                </a>
                            </li>
                        </ul>
                        <b>
                            <ul class="nav nav-pills"   style="float: right; margin-right: 20px ;">
                                <li class="nav-item">
                                    <a class="nav-link" href="liste_mag_centrale_peremption.php">

                                        <?php
                                        $today=date('Y-m-d');

                                        $query = "SELECT count(DISTINCT id_mag) as total from magasin where date_fab <= '$today' ";

                                        $q = $db->query($query);
                                        while($row = $q->fetch())
                                        {
                                            echo ' Médicaments périmés ['.$row['total'].']';

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
                                    <th>Numéro de lot</th>
<!--                                    <th>Ref Produit</th>-->
                                    <th>Nom</th>
                                    <th>Quantités</th>
                                    <th>Categorie</th>
                                    <th>prix d'achat total</th>
                                    <th>prix de vente total</th>
                                    <th>Marge</th>
<!--                                    <th>Date de fabrique</th>-->
<!--                                    <th>Date de péremption</th>-->
                                    <th class="text-right">Transfert</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $benefice=0;
                                $solde_prix_v_t=0;
                                $solde_prix_u_t=0;

                                $query = "SELECT * from magasin where date_fab > '$today'";
                                $q = $db->query($query);
                                while ($row = $q->fetch()) {
                                $id_mag = $row['id_mag'];
                                $id_medi = $row['id_medi'];
                                $ref_com = $row['ref_com'];
                                $qt_com = $row['qt_com'];
                                $id_num_lot=$row['id_num_lot'];
                                $date_exp=$row['date_exp'];
                                $date_fab=$row['date_fab'];



                                $sql = "SELECT DISTINCT * from medicament where id_medi = '$id_medi'";

                                $stmt = $db->prepare($sql);
                                $stmt->execute();

                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($tables as $table) {
                                    $ref_medi = $table['ref_medi'];
                                    $nom_medi= $table['nom_medi'];
                                    //$prix= $table['prix_unitaire'];
                                    $prix_u_a = $table['prix_unitaire'];
                                    $prix_u_v = $table['prix_u_v'];
                                    $id_type_medi= $table['id_type_medi'];
                                    $prix= $table['prix_unitaire'];

                                    $solde_prix_v_t+=$qt_com*$prix_u_v;
                                    $solde_prix_u_t+=$qt_com*$prix_u_a;


                                    $sql = "SELECT DISTINCT * from type_medi where id_type_medi = '$id_type_medi'";

                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();

                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tables as $table) {
                                        $type_medi= $table['nom'];
                                    }
                                }

                                if(empty($id_type_medi)){
                                    $type_medi='N/A';
                                }
                                if(empty($id_medi)){
                                    $nom_medi='N/A';
                                }

                                ?>

                                <tr>
<!--                                    <td align="center"> --><?php ////echo $ref_medi; ?><!--   </td>-->
                                    <td><a href="#"><i class="fas fa-cubes" aria-hidden="true"></i> <?=$id_num_lot?></a></td>
                                    <td><a href="#"><i class="fas fa-cubes" aria-hidden="true"></i> <?=$nom_medi?></a></td>
                                    <td align="center"><?php echo number_format($qt_com) ?>  </td>
                                    <td align="center"><?=$type_medi?> </td>
                                    <td><a href="#"><?=number_format($prix_u_a*$qt_com)?></a></td>
                                    <td><a href="#"><?=number_format($prix_u_v*$qt_com)?></a></td>
                                    <td><a href="#"><?=number_format(($prix_u_v*$qt_com)-($qt_com*$prix_u_a))?></a></td>
<!--                                    <td><a href="#">--><?php //if(empty($date_exp)){echo 'N/A';}else{echo $date_exp;}  ?><!--</a></td>-->
<!--                                    <td><a href="#">--><?php //if(empty($date_fab)){echo 'N/A';}else{echo $date_fab;} ?><!--</a></td>-->
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                               aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <?php
                                                if( $lvl == 4 || $lvl == 7 || $lvl == 6 || $lvl == 10){
                                                ?>
                                                <a class="dropdown-item"  data-toggle="modal"
                                                   data-target="#edit-mag<?=$id_medi?>_<?=$ref_com?>"><i
                                                            class="fa fa-pen"></i> Edit</a>
                                                <?php } ?>
                                                <a class="dropdown-item" href="transfert_mag_phar.php?id_medi=<?=$id_medi?>&id_num_lot=<?=$id_num_lot?>"><i
                                                            class="fa fa-random"></i> Transfert</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                   data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i>
                                                    Delete</a>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="edit-mag<?=$id_medi?>_<?=$ref_com?>" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header" style="padding:20px 50px;">
                                                        <h3 align="center"><i class="fas fa-bars"></i> <b>Nouvelle quantité</b></h3>
                                                        <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
                                                    </div>
                                                    <div class="modal-body" style="padding:40px 50px;">
                                                        <form class="form-horizontal" action="update_qte_mag.php" name="form" method="post">
                                                            <input type="hidden" name="id_num_lot"
                                                                   value="<?=$id_num_lot?>"
                                                                   class="form-control">
                                                            <input type="hidden" name="ref_com"
                                                                   value="<?=$ref_com?>"
                                                                   class="form-control">
                                                            <input type="hidden" name="id_medi"
                                                                   value="<?=$id_medi?>"
                                                                   class="form-control">
                                                            <input type="hidden" name="id_perso_session"
                                                                   value="<?= $id_perso_session ?>"
                                                                   class="form-control">
                                                            <div class="form-group">
                                                                <label>Numéro de lot:</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" name="id_num_lot_new" value="<?=$id_num_lot?>" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Ref :</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" value="<?=$ref_com?>" name="ref_com" class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Médicament :</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" value="<?=$nom_medi?>" name="nom_medi" class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Quantité :</label>
                                                                <div class="col-sm-12">
                                                                    <input type="number" value="<?=$qt_com?>" name="qt_com" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>date fabricaton :</label>
                                                                <div class="col-sm-12">
<!--                                                                    <input type="date" value="--><?//=$date_exp?><!--" name="date_fab" class="form-control" min="YYYY-MM">-->
                                                                    <input type="date" value="<?=$date_exp?>" name="date_fab" class="form-control" >
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>date de péremption :</label>
                                                                <div class="col-sm-12">
<!--                                                                    <input type="date" value="--><?//=$date_fab?><!--" name="date_exp" class="form-control" min="YYYY-MM">-->
                                                                    <input type="date" value="<?=$date_fab?>" name="date_exp" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-sm-12">
                                                                    <center>
                                                                        <input type="submit" style=" width:25% " name="submit_cs" class="btn btn-primary"
                                                                               value="valider">

                                                                        <input type="reset" data-dismiss="modal" style=" width:25% " class="btn btn-danger"
                                                                               value="Annuler"/>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                } ?>

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


                <label>
                    <i class="far fa-newspaper"></i>
                    Etats
                </label>
                <div class="row">

                    <?php



                    // $profession = $row['profession'];

                    ?>
                    <div class="col-md-4 col-sm-4  col-lg-3">
                        <div style="background-color: #EFF3F5;" class="profile-widget">
                            <div class="doctor-img">
                                <a class="avatar" href="#"><i class="fas fa-donate"></i></a>
                            </div>
                            <div class="dropdown profile-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                   aria-expanded="false"><i
                                            class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">

                                    <a class="dropdown-item" href="#"><i class="fas fa-pen"></i> Edit</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_doctor"><i
                                                class="fas fa-trash"></i> Delete</a>
                                </div>
                            </div>
                            <h4 class="doctor-name text-ellipsis"><a href="#">Prix d'achat total</a></h4>
                            <div class="doc-prof">Total:<br><?php
                                ?></div>
                            <div class="user-country">
                                <i class="fas fa-donate"></i> <?= number_format($solde_prix_u_t);?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4  col-lg-3">
                        <div style="background-color: #EFF3F5;" class="profile-widget">
                            <div class="doctor-img">
                                <a class="avatar" href="#"><i class="fas fa-donate"></i></a>
                            </div>
                            <div class="dropdown profile-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                   aria-expanded="false"><i
                                            class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">

                                    <a class="dropdown-item" href="#"><i class="fas fa-pen"></i> Edit</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_doctor"><i
                                                class="fas fa-trash"></i> Delete</a>
                                </div>
                            </div>
                            <h4 class="doctor-name text-ellipsis"><a href="#">Prix de vente total</a></h4>
                            <div class="doc-prof">Total:<br><?php
                                ?></div>
                            <div class="user-country">
                                <i class="fas fa-donate"></i> <?= number_format($solde_prix_v_t);?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4  col-lg-3">
                        <div style="background-color: #EFF3F5;" class="profile-widget">
                            <div class="doctor-img">
                                <a class="avatar" href="#"><i class="fas fa-donate"></i></a>
                            </div>
                            <div class="dropdown profile-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                   aria-expanded="false"><i
                                            class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">

                                    <a class="dropdown-item" href="#"><i class="fas fa-pen"></i> Edit</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_doctor"><i
                                                class="fas fa-trash"></i> Delete</a>
                                </div>
                            </div>
                            <h4 class="doctor-name text-ellipsis"><a href="#">Bénéfice</a></h4>
                            <div class="doc-prof">Total:<br><?php
                                ?></div>
                            <div class="user-country">
                                <i class="fas fa-donate"></i> <?= number_format($solde_prix_v_t-$solde_prix_u_t);?>
                            </div>
                        </div>
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