<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');

?>

<!--Content-->

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid">
      <h1 class="mt-4"><i class="fas fa-users" style="color: silver"></i> Liste des anesthésies en cours...</h1>
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
                  <!--                                    <th>Réferences</th>-->
                  <th width="20%">Nom du patient</th>
                  <th>Code Patient</th>
                  <th>Médecin</th>
                  <th>Type d'anesthésie</th>
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

                $query = "SELECT * from regler_anesthesie";
                $q = $db->query($query);
                while ($row = $q->fetch()) {
                  $id_reg_anes = $row['id_reg_anes'];
                  $id_anes = $row['id_anes'];
                  $id_type_anes = $row['id_type_anes'];
                  $id_patient = $row['id_patient'];
                  $payer = $row['payer'];
                  $somme = $row['somme'];
                  $remise = $row['remise'];
                  $reste = $somme - $payer;

                  if ($somme - ($payer + $remise) == 0) {
                    continue;
                  }

                  $sql = "SELECT * from anesthesie  where id_anes = '$id_anes'";

                  $stmt = $db->prepare($sql);
                  $stmt->execute();

                  $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($tables as $table) {

                    $id_anes = $table['id_anes'];
                    $ref_anes = $table['ref_anes'];
                    $id_patient = $table['id_patient'];
                    $id_medecin = $table['id_medecin'];
                    $date_anes = $table['date_anes'];
                    $id_type_anes = $table['id_type_anes'];
                  }




                  $sql = "SELECT DISTINCT * from patient where id_patient = '$id_patient'";

                  $stmt = $db->prepare($sql);
                  $stmt->execute();

                  $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($tables as $table) {
                    $nom_patient_ref = $table['nom_p'] . ' ' . $table['prenom_p'];
                    $nom_patient = $table['ref_patient'];
                    $age = $table['age_p'];
                  }



                  $sql = "SELECT DISTINCT * from medecin where id_medecin = '$id_medecin'";

                  $stmt = $db->prepare($sql);
                  $stmt->execute();

                  $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($tables as $table) {
                    $nom_medecin = $table['nom_m'] . ' ' . $table['prenom_m'];
                  }

                  $sql = "SELECT DISTINCT * from type_anes where id_type_anes = '$id_type_anes'";

                  $stmt = $db->prepare($sql);
                  $stmt->execute();

                  $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($tables as $table) {
                    $type_eco = $table['nom'];
                    $prix = $table['prix_t_anes'];
                  }
                  if (empty($id_medecin)) {
                    $nom_medecin = 'N/A';
                  }
                  if (empty($id_type_anes)) {
                    $type_eco = 'N/A';
                  }

                ?>

                  <tr>
                    <!--                                        <td><a href="#">--><?php //=$ref_anes
                                                                                    ?><!--</a></td>-->
                    <td><?= $nom_patient_ref ?></td>
                    <td><img width="28" height="28" src="assetss/img/user.jpg"
                        class="rounded-circle m-r-5" alt=""><?= $nom_patient ?></td>
                    <td><a href="#"><?= $nom_medecin ?></a></td>
                    <td><a href="#"><?= $type_eco ?></a></td>
                    <td><a href="#"><?= $date_anes ?></a></td>
                    <td><a href="#"><?= number_format($prix); ?></a></td>
                    <td><a href="#"><?= number_format($somme - ($payer + $remise)); ?></a></td>
                    <td><a href="#"><?= number_format($payer); ?></a></td>
                    <td><a href="#"><?= number_format($remise); ?></a></td>
                    <td>

                      <?php
                      if ($lvl == 11) {

                        if ($somme - ($payer + $remise) == 0)
                          echo '<span class="custom-badge status-green" >Ok</span>';
                        else
                          echo '<span class="custom-badge status-red" >Pas à Jour</span>';
                      } else {
                        if ($somme - ($payer + $remise) == 0)
                          echo '<span class="custom-badge status-green" data-toggle="modal" data-target="#ajouterAnes' . $id_reg_anes . '">Ok</span>';
                        else
                          echo '<span class="custom-badge status-red" data-toggle="modal" data-target="#ajouterAnes' . $id_reg_anes . '">Pas à Jour</span>';
                      }
                      ?>

                    </td>
                    <td align="center">
                      <a href="facture_anesthesie.php?id_reg_anes=<?= $id_reg_anes ?>&id_perso=<?= $id_perso_session ?>" target="_blank">
                        <i class="fa fa-print"></i>
                      </a>
                      <a href="facture_anesthesie_Ticket.php?id_reg_anes=<?= $id_reg_anes ?>&id_perso=<?= $id_perso_session ?>" title="Ticket" target="_blank">
                        <i class="far fa-file-alt"></i>
                      </a>
                    </td>
                    <td class="text-center">
                      <?php

                      if ($lvl == 4 ||  $lvl == 13) {
                        if ($lvl == 11 || $lvl == 7 || $lvl == 12) {
                          if ($somme - ($payer + $remise) == 0) {
                            echo '<a href="#" ><span class="custom-badge status-blue" ">rembourser</span></a>';
                          }
                        } else {
                          if ($somme - ($payer + $remise) == 0) {
                            echo '<a href="rembourser_services.php?id_service=' . $id_anes . '&id_reg_service=' . $id_reg_anes . '&table_service=anesthesie" onclick="Supp(this.href); return(false);"><span class="custom-badge status-blue" ">rembourser</span></a>';
                          }
                        }
                      }

                      ?>

                    </td>
                    <td class="text-right">
                      <div class="modal fade" id="ajouterAnes<?= $id_reg_anes ?>" role="dialog">
                        <div class="modal-dialog">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header" style="padding:20px 50px;">
                              <h3 align="center"><i class="fas fa-map"></i> <b>Reglement: <?= $ref_anes ?></b></h3>
                              <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
                            </div>
                            <div class="modal-body" style="padding:40px 50px;">
                              <form class="form-horizontal" action="update_anes_paye.php" name="form" method="post">

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
                                  <label>Payer</label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" value="<?= number_format($payer) ?>" disabled="" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label>Reste à payer</label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" value="<?= number_format($somme - ($payer + $remise)) ?>" disabled="">
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
                                  <label>Montant Recue</label>
                                  <div class="col-sm-12">
                                    <input type="hidden" name="id_reg_anes" value="<?= $id_reg_anes ?>" class="form-control">
                                    <input type="hidden" name="id_perso_session" value="<?= $id_perso_session ?>" class="form-control">
                                    <input type="hidden" name="id_anes" value="<?= $id_anes ?>" class="form-control">
                                    <input type="number" name="payer" id="montant-verse<?= $ref_anes ?>" class="form-control" oninput="calculerReste('<?= $ref_anes ?>')">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label>Montant total</label>
                                  <div class="col-sm-12">
                                    <input type="hidden" name="somme" class="form-control" value="<?= $somme - $payer - $remise ?>">
                                    <input type="text" class="form-control" value="<?= number_format($somme - $payer - $remise) ?>" disabled="" />
                                    <input type="hidden" class="form-control" id="montant-total<?= $ref_anes ?>" value="<?= $somme - $payer - $remise ?>" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label>Reste à payer:</label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" id="reste-payer<?= $ref_anes ?>" value="0" disabled="" />
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label>Montant à rembourser:</label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" id="reste-rembourser<?= $ref_anes ?>" value="0" disabled="" />
                                  </div>
                                </div>
                                <?php
                                if ($lvl == 4 || $lvl == 7 || $lvl == 11 || $lvl == 2 || $lvl == 12) {
                                ?>
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
                                          if ($data['nom'] === 'CAUTION') {
                                            echo '<option value ="' . $i . '">';
                                            echo $data['nom'] . ' ( ' . number_format($montant_caution) . ' )';
                                            echo '</option>';
                                          } else {
                                            echo '<option value ="' . $i . '">';
                                            echo $data['nom'];
                                            echo '</option>';
                                          }
                                        }

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
                                    <label>Remise</label>
                                    <div class="col-sm-12">
                                      <input type="number" class="form-control" name="remise" value="0" />
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label>Caisse <span
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

<div class="modal fade" id="ajouterExam" role="dialog">
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
              <input type="text" name="nom" class="form-control" value="1.500.000" disabled="">
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