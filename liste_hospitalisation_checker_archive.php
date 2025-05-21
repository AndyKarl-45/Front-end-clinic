<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');

?>

<!--Content-->

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid">
      <h1 class="mt-4"><i class="fas fa-users" style="color: silver"></i> Liste des Hospitalisations en cours...</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">
          Hello M/Mme XXX, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
          .

        </li>
      </ol>
      <div class="row">
        <div class="col-xl-12">

        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <hr />
        </div>
      </div>
      <!--                Main Body              -->
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-border table-striped custom-table mb-0" id="dataTable">
              <thead>
                <tr>
                  <th>Patient</th>
                  <th>Service</th>
                  <th>Type d'hospitalisation</th>
                  <th>N° chambre</th>
                  <th>N° lit</th>
                  <th>Nbre de jour</th>
                  <th>Date</th>
                  <th>Prix</th>
                  <th>Reste à Payer</th>
                  <th>Payer</th>
                  <th>Remise</th>
                  <th>Statuts</th>
                  <th>PDF</th>
                  <th>remboursement</th>
                  <th class="text-right">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $query = "SELECT * from regler_hosp ";
                $q = $db->query($query);
                while ($row = $q->fetch()) {
                  $id_reg_hosp = $row['id_reg_hosp'];
                  $id_hosp = $row['id_hosp'];
                  $payer_reg = $row['payer'];
                  $somme_reg = $row['somme'];
                  $remise = $row['remise'];
                  $reste = $somme_reg - $payer_reg;
                  if ($somme_reg - ($payer_reg + $remise) != 0) {
                    continue;
                  }


                  $sql = "SELECT DISTINCT * from hospitalisation  where id_hosp = '$id_hosp'";

                  $stmt = $db->prepare($sql);
                  $stmt->execute();

                  $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($tables as $table) {
                    $id_hosp = $table['id_hosp'];
                    $ref_hosp = $table['ref_hosp'];
                    $id_patient = $table['id_patient'];
                    $id_nurse = $table['id_nurse'];
                    $id_service = $table['id_service'];
                    $date_hosp = $table['date_hosp'];
                    $id_type_hosp = $table['id_type_hosp'];
                    $lit = $table['lit'];
                    $nb_jour = $table['nb_jour'];
                    $chambre = $table['chambre'];
                  }


                  $sql = "SELECT DISTINCT * from patient where id_patient = '$id_patient'";

                  $stmt = $db->prepare($sql);
                  $stmt->execute();

                  $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($tables as $table) {
                    $nom_patient = $table['nom_p'] . ' ' . $table['prenom_p'];
                    //$nom_patient= $table['ref_patient'];
                    $age = $table['age_p'];
                  }



                  $sql = "SELECT DISTINCT * from nurse where id_nurse = '$id_nurse'";

                  $stmt = $db->prepare($sql);
                  $stmt->execute();

                  $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($tables as $table) {
                    $nom_nurse = $table['nom_n'] . ' ' . $table['prenom_n'];
                  }

                  $sql = "SELECT  * from type_hosp where id_type_hosp = '$id_type_hosp'";

                  $stmt = $db->prepare($sql);
                  $stmt->execute();

                  $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($tables as $table) {
                    $type_hosp = $table['nom'];
                    $prix = $table['prix_t_hosp'];
                  }
                  $sql = "SELECT DISTINCT * from service where id_service = '$id_service'";

                  $stmt = $db->prepare($sql);
                  $stmt->execute();

                  $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($tables as $table) {
                    $service = $table['nom'];
                  }
                  if (empty($id_service)) {
                    $service = 'N/A';
                  }
                  if (empty($id_nurse)) {
                    $nom_nurse = 'N/A';
                  }
                  if (empty($id_type_hosp)) {
                    $type_hosp = 'N/A';
                  }
                  if (empty($prix)) {
                    $prix = 0;
                  }


                ?>

                  <tr>
                    <td><img width="28" height="28" src="assetss/img/user.jpg"
                        class="rounded-circle m-r-5"
                        alt=""><?= $nom_patient ?></td>
                    <td><a href="#"> <?= $service ?></a></td>
                    <td><a href="#"> <?= $type_hosp ?></a></td>
                    <td><a href="#"> <?= $chambre ?></a></td>
                    <td><a href="#"><?= $lit ?></a></td>
                    <td><a href="#"><?= $nb_jour ?></a></td>
                    <td><a href="#"><?= dateToFrench($date_hosp, " j F Y") ?></a></td>
                    <td><a href="#"><?= number_format($prix); ?></a></td>
                    <td><a href="#"><?= number_format($somme_reg - ($payer_reg + $remise)); ?></a></td>
                    <td><a href="#"><?= number_format($payer_reg); ?></a></td>
                    <td><a href="#"><?= number_format($remise); ?></a></td>
                    <td>
                      <?php
                      if ($lvl == 11) {
                        if ($somme_reg - ($payer_reg + $remise) == 0)
                          echo '<span class="custom-badge status-green" >Ok</span>';
                        else
                          echo '<span class="custom-badge status-red" >Pas à Jour</span>';
                      } else {
                        if ($somme_reg - ($payer_reg + $remise) == 0)
                          echo '<span class="custom-badge status-green" data-toggle="modal" data-target="#ajouterHosp' . $id_reg_hosp . '">Ok</span>';
                        else
                          echo '<span class="custom-badge status-red" data-toggle="modal" data-target="#ajouterHosp' . $id_reg_hosp . '">Pas à Jour</span>';
                      }
                      ?>

                    </td>
                    <td align="center"><a href="facture_hospitalisation.php?id_reg_hosp=<?= $id_reg_hosp ?>&id_perso=<?= $id_perso_session ?>" target="_blank">
                        <i class='fa fa-print'></i>
                      </a><a
                        href="facture_hospitalisation_Ticket.php?id_reg_hosp=<?= $id_reg_hosp ?>&id_perso=<?= $id_perso_session ?>" title="Ticket"
                        target="_blank">
                        <i class='far fa-file-alt'></i>
                      </a></td>
                    <td class="text-center">
                      <?php

                      if ($lvl == 4 ||  $lvl == 13) {
                        if ($lvl == 11 || $lvl == 7 || $lvl == 12) {
                          if ($somme_reg - ($payer_reg + $remise) == 0) {
                            echo '<a href="#" ><span class="custom-badge status-blue" ">rembourser</span></a>';
                          }
                        } else {
                          if ($somme_reg - ($payer_reg + $remise) == 0) {
                            echo '<a href="rembourser_services.php?id_service=' . $id_hosp . '&id_reg_service=' . $id_reg_hosp . '&table_service=hospitalisation" onclick="Supp(this.href); return(false);"><span class="custom-badge status-blue" ">rembourser</span></a>';
                          }
                        }
                      }

                      ?>

                    </td>

                    <td class="text-right">
                      <div class="modal fade" id="ajouterHosp<?= $id_reg_hosp ?>" role="dialog">
                        <div class="modal-dialog">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header" style="padding:20px 50px;">
                              <h3 align="center"><i class="fas fa-map"></i> <b>Reglement: <?= $ref_hosp ?></b></h3>
                              <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
                            </div>
                            <div class="modal-body" style="padding:40px 50px;">
                              <form class="form-horizontal" action="update_hosp_paye.php" name="form" method="post">
                                <div class="row">
                                  <label style="text-align: center;">
                                    <i class="far fa-newspaper"></i>
                                    Versement précédent
                                  </label>
                                  <div class="col-md-12">
                                    <hr />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label>Payer:</label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" value="<?= number_format($payer_reg) ?>" disabled="" />
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label>Reste à payer:</label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" value="<?= number_format($somme_reg - ($payer_reg + $remise)) ?>" disabled="">
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-12">
                                    <hr />
                                  </div>
                                </div>


                                <div class="row">
                                  <label>
                                    <i class="far fa-newspaper"></i>
                                    Versement Actuel
                                  </label>
                                  <div class="col-md-12">
                                    <hr />
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label>Montant Recue:</label>
                                  <div class="col-sm-12">
                                    <input type="hidden" name="id_reg_hosp" value="<?= $id_reg_hosp ?>" class="form-control">
                                    <input type="hidden" name="id_perso_session" value="<?= $id_perso_session ?>" class="form-control">
                                    <input type="hidden" name="id_hosp" value="<?= $id_hosp ?>" class="form-control">
                                    <input type="number" name="payer" id="montant-verse<?= $ref_hosp ?>" class="form-control" oninput="calculerReste('<?= $ref_hosp ?>')">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label>Montant total</label>
                                  <div class="col-sm-12">
                                    <input type="hidden" name="somme" class="form-control" value="<?= $somme_reg - $payer_reg - $remise ?>">
                                    <input type="text" class="form-control" value="<?= number_format($somme_reg - $payer_reg - $remise) ?>" disabled="" />
                                    <input type="hidden" class="form-control" id="montant-total<?= $ref_hosp ?>" value="<?= $somme_reg - $payer_reg - $remise ?>" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label>Reste à payer:</label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" id="reste-payer<?= $ref_hosp ?>" value="0" disabled="" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label>Montant à rembourser:</label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" id="reste-rembourser<?= $ref_hosp ?>" value="0" disabled="" />
                                  </div>
                                </div>
                                <?php
                                if ($lvl == 4 || $lvl == 7 || $lvl == 11) {
                                ?>
                                  <div class="form-group">
                                    <label>Remise:</label>
                                    <div class="col-sm-12">
                                      <input type="number" class="form-control" name="remise" value="0" />
                                    </div>
                                  </div>
                                <?php } ?>

                                <?php
                                if ($lvl == 4 || $lvl == 7 || $lvl == 11 || $lvl == 2 || $lvl == 12) {
                                ?>
                                  <input type="hidden" name="remise" value="0" class="form-control">
                                  <div class="form-group">
                                    <label>Mode de paie : <span
                                        class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                      <select class="form-control"
                                        name="paie">
                                        <option value="0" selected="">
                                          ...
                                        </option>
                                        <?php

                                        $sql = "SELECT montant from caution where id_patient = '$id_patient' ";

                                        $stmt = $db->prepare($sql);
                                        $stmt->execute();


                                        // Vérifiez si des résultats ont été trouvés
                                        if ($table = $stmt->fetch(PDO::FETCH_ASSOC)) {

                                          $montant_caution = $table['montant'];
                                        } else {
                                          $montant_caution = 0; // Aucun montant de caution trouvé
                                        }

                                        $iResult = $db->query("SELECT * FROM mode_paie where open_close!=1 ");

                                        while ($data = $iResult->fetch()) {

                                          $i = $data['id_mode_paie'];

                                          echo '<option value ="' . $i . '">';
                                          echo $data['nom'];
                                          echo '</option>';
                                        }
                                        echo '<option value ="01010">';
                                        echo 'CAUTION ( ' . number_format($montant_caution) . ' FCFA)';
                                        echo '</option>';

                                        ?>

                                      </select>
                                    </div>
                                  </div>
                                <?php
                                }
                                ?>

                                <?php
                                if ($lvl == 4 || $lvl == 7 || $lvl == 11) {
                                ?>
                                  <div class="form-group">
                                    <label>Caisse: <span
                                        class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                      <select class="form-control"
                                        name="id_caisse">
                                        <option value="0" selected="">
                                          ...
                                        </option>
                                        <?php

                                        $iResult = $db->query("SELECT * FROM caisse where open_close!=1 ");

                                        while ($data = $iResult->fetch()) {

                                          $i = $data['id_caisse'];
                                          echo '<option value ="' . $i . '">';
                                          echo $data['caisse'];
                                          echo '</option>';
                                        }

                                        ?>

                                      </select>
                                    </div>
                                  </div>
                                <?php } ?>
                                <div class="form-group">
                                  <div class="col-sm-12">
                                    <center>
                                      <input type="submit" style=" width:25% " name="submit_cs" class="btn btn-primary"
                                        value="Payer">

                                      <input data-dismiss="modal" type="text" style=" width:25% " name=""
                                        class="btn btn-danger" value="Annuler" />
                                    </center>
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
          <hr />
        </div>
      </div>

    </div>
  </main>
</div>
<div class="modal fade" id="ajouterHosp" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="padding:20px 50px;">
        <h3 align="center"><i class="fas fa-map"></i> <b>Reglement</b></h3>
        <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
      </div>
      <div class="modal-body" style="padding:40px 50px;">
        <form class="form-horizontal" action="save_pays.php" name="form" method="post">
          <div class="form-group">
            <label>Montant Recue</label>
            <div class="col-sm-12">
              <input type="text" name="nom" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label>Montant total</label>
            <div class="col-sm-12">
              <input type="text" name="nom" class="form-control" value="1.000.000" disabled="">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-12">
              <center>
                <input type="submit" style=" width:25% " name="submit_cs" class="btn btn-primary"
                  value="Créer">

                <input data-dismiss="modal" type="text" style=" width:25% " name=""
                  class="btn btn-danger" value="Annuler" />
              </center>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  function Supp(link) {
    if (confirm('Confirmer  le remboursement de l\'hospitalisation ?')) {
      document.location.href = link;
    }
  }


  function calculerReste(ref_service) {
    const montantTotal = parseInt(document.getElementById('montant-total' + ref_service).value);
    const montantVerse = parseInt(document.getElementById('montant-verse' + ref_service).value);
    let reste = montantTotal - montantVerse;
    let restePayer = 0;

    if (reste < 0) {
      resteRembourser = Math.abs(reste);
      restePayer = 0;
    } else {
      resteRembourser = 0;
      restePayer = Math.abs(reste);
    }


    document.getElementById('reste-rembourser' + ref_service).value = resteRembourser;
    //   $('.total-'+ref_service).attr('value',montantTotal);
    document.getElementById('reste-payer' + ref_service).value = restePayer;
    //   $('.total-'+ref_service).attr('value',montantTotal);
  }
</script>
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
    case '-3';
    ?>
      <script>
        Swal.fire({
          icon: 'Erreur',
          title: 'Votre caution est à 0 ',
          text: 'Mettre à jour la caution du patient ! ',
          footer: 'Reéssayez encore'
        })
      </script>
    <?php
      break;
    case '-4';
    ?>
      <script>
        Swal.fire({
          icon: 'Erreur',
          title: 'Règlement est ok ! ',
          text: 'Une erreur s\'est produite! ',
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