<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');

?>

<!--Content-->

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid">
      <h1 class="mt-4"><i class="fas fa-users" style="color: silver"></i> Liste des autres services </h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">
          Hello M/Mme XXX, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
          .

        </li>
      </ol>
      <div class="row">
        <div class="col-xl-12">
          <!-- Nav pills -->
          <ul class="nav nav-pills" style="float: right;">
            <li class="nav-item">
              <a class="nav-link active" href="etat_print_ticket.php" target="blank" style="margin-right: 20px"><i class="fa fa-print"></i> Ticket
              </a>
            </li>
          </ul>
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
                  <th>Patient</th>
                  <th>Médecin</th>
                  <th>Services</th>
                  <th>Date</th>
                  <th>Prix</th>
                  <th>Reste à Payer</th>
                  <th>Payer</th>
                  <?php if ($lvl != 2) { ?>
                    <th>Remise</th>
                  <?php } ?>
                  <th>Statuts</th>
                  <th>PDF</th>
                  <th>remboursement</th>
                  <th class="text-right">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $query = "SELECT * from regler_autre ";
                $q = $db->query($query);
                while ($row = $q->fetch()) {
                  $id_reg_autre = $row['id_reg_autre'];
                  $id_autre = $row['id_autre'];
                  $id_autre_service = $row['id_autre_service'];
                  $id_patient = $row['id_patient'];
                  $etat_reg = $row['etat'];
                  $payer = $row['payer'];
                  $somme = $row['somme'];
                  $remise = $row['remise'];
                  $reste = $somme - $payer;

                  if ($somme - ($payer + $remise) != 0) {
                    continue;
                  }

                  $sql = "SELECT * from autre  where id_autre = '$id_autre'";

                  $stmt = $db->prepare($sql);
                  $stmt->execute();

                  $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($tables as $table) {

                    $id_autre = $table['id_autre'];
                    $ref_autre = $table['ref_autre'];
                    $id_patient = $table['id_patient'];
                    $id_medecin = $table['id_medecin'];
                    $date_autre = $table['date_autre'];
                    $id_autre_service = $table['id_autre_service'];
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

                  //                                    $sql = "SELECT DISTINCT * from autres_services where id_autre_service  = '$id_autre_service '";
                  //
                  //                                    $stmt = $db->prepare($sql);
                  //                                    $stmt->execute();
                  //
                  //                                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  //
                  //                                    foreach ( $tables as $table) {
                  //                                        $autre_service= $table['nom'];
                  //                                        $prix = $table['prix_autre_service'];
                  //                                    }
                  $autre_service = '';
                  if (empty($id_medecin)) {
                    $nom_medecin = 'N/A';
                  }
                  if (empty($id_autre_service)) {
                    $autre = 'N/A';
                  }

                ?>

                  <tr>
                    <!--                                        <td><a href="#">--><?php //= $ref_autre 
                                                                                    ?><!--</a></td>-->
                    <td><?= $nom_patient_ref ?></td>
                    <td><img width="28" height="28" src="assetss/img/user.jpg"
                        class="rounded-circle m-r-5" alt=""><?= $nom_patient ?>
                    </td>
                    <td><a href="#"><?= $nom_medecin ?></a></td>
                    <td><a href="#"><?= $autre_service ?></a></td>
                    <td><a href="#"><?= $date_autre ?></a></td>
                    <td><a href="#"><?= number_format($somme); ?></a></td>
                    <td><a href="#"><?= number_format($somme - ($payer + $remise)); ?></a></td>
                    <td><a href="#"><?= number_format($payer); ?></a></td>
                    <?php if ($lvl != 2) { ?>
                      <td><a href="#"><?= number_format($remise); ?></a></td>
                    <?php } ?>
                    <td>

                      <?php
                      if ($lvl == 11) {
                        if ($somme - ($payer + $remise) == 0)
                          echo '<span class="custom-badge status-green" >Ok</span>';
                        else
                          echo '<span class="custom-badge status-red" >Pas à Jour</span>';
                      } else {
                        if ($somme - ($payer + $remise) == 0)
                          echo '<span class="custom-badge status-green" data-toggle="modal" data-target="#ajouterAutre' . $id_reg_autre . '">Ok</span>';
                        else
                          echo '<span class="custom-badge status-red" data-toggle="modal" data-target="#ajouterAutre' . $id_reg_autre . '">Pas à Jour</span>';
                      }
                      ?>

                    </td>
                    <td align="center"><a
                        href="facture_autre.php?id_reg_autre=<?= $id_reg_autre ?>&id_perso=<?= $id_perso_session ?>"
                        target="_blank">
                        <i class='fa fa-print'></i>
                      </a>
                      <a href="facture_autre_Ticket.php?id_reg_autre=<?= $id_reg_autre ?>&id_perso=<?= $id_perso_session ?>" title="Ticket" target="_blank">
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
                            echo '<a href="rembourser_services.php?id_service=' . $id_autre . '&id_reg_service=' . $id_reg_autre . '" onclick="Supp(this.href); return(false);"><span class="custom-badge status-blue" ">rembourser</span></a>';
                          }
                        }
                      }

                      ?>

                    </td>
                    <td class="text-right">
                      <div class="modal fade" id="ajouterAutre<?= $id_reg_autre ?>" role="dialog">
                        <div class="modal-dialog" style="max-width: 800px; !important">
                          <!-- Modal content-->
                          <div class="modal-content" style="width: 800px; !important">
                            <div class="modal-header" style="padding:20px 50px;">
                              <h3 align="center"><i class="fas fa-map"></i>
                                <b>Reglement: <?= $ref_autre ?></b>
                              </h3>
                              <button type="button" class="close" data-dismiss="modal"
                                title="Close">&times;
                              </button>
                            </div>
                            <div class="modal-body" style="padding:40px 50px;">
                              <form class="form-horizontal" action="update_autre_paye.php" name="form" method="post">
                                <input type="hidden" name="id_reg_autre"
                                  value="<?= $id_reg_autre ?>"
                                  class="form-control">
                                <input type="hidden" name="id_perso_session"
                                  value="<?= $id_perso_session ?>"
                                  class="form-control">
                                <input type="hidden" name="id_autre"
                                  value="<?= $id_autre ?>"
                                  class="form-control">
                                <div class="table-responsive">
                                  <table style="width: 100%;">
                                    <thead>
                                      <tr align="center">
                                        <th>Services</th>
                                        <th>Prix</th>
                                        <th>Reste à payer</th>
                                        <th>Choix</th>
                                      </tr>
                                    </thead>
                                    <tfoot>
                                      <tr>
                                        <th colspan="3" style="background-color:white;">Montant Total:</th>
                                        <th>
                                          <input type="hidden" name="montant_total" class="total-<?= $ref_autre ?>" value="0">
                                          <input type="text" style="width: 100px;" id="montant-total<?= $ref_autre ?>" value="0" disabled>
                                        </th>
                                      </tr>
                                      <tr>
                                        <th colspan="3">Montant versé:</th>
                                        <th>
                                          <input type="text" style="width: 100px;" name="montant_verse" id="montant-verse<?= $ref_autre ?>" style="background-color: #dee2e6" value="0" oninput="calculerReste('<?= $ref_autre ?>')">
                                        </th>
                                      </tr>
                                      <tr>
                                        <th colspan="3" style="background-color:white;">Reste à rembourser:</th>
                                        <th>
                                          <input type="text" style="width: 100px;" id="reste-rembourser<?= $ref_autre ?>" value="0" disabled>
                                        </th>
                                      </tr>
                                      <tr>
                                        <th colspan="3">Reste à payer:</th>
                                        <th>
                                          <input type="text" style="width: 100px;" id="reste-payer<?= $ref_autre ?>" value="0" disabled>
                                        </th>
                                      </tr>
                                      <?php
                                      if ($lvl != 2) {
                                      ?>
                                        <tr>
                                          <th colspan="3" style="background-color:white;">Remise:</th>
                                          <th>
                                            <input type="number" style="width: 100px;"
                                              name="remise" value="0" />
                                          </th>
                                        </tr>
                                      <?php } else { ?>
                                        <input type="hidden" style="width: 100px;"
                                          name="remise" value="0" />
                                      <?php } ?>
                                      <?php
                                      if ($lvl == 4 || $lvl == 7 || $lvl == 11 || $lvl == 2 || $lvl == 12) {
                                      ?>
                                        <tr>
                                          <th colspan="3" style="background-color:white;">Mode de paiement:</th>
                                          <th>
                                            <select style="width: 100px;"
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
                                          </th>
                                        </tr>
                                      <?php
                                      }
                                      ?>

                                      <?php
                                      if ($lvl == 4 || $lvl == 7 || $lvl == 11) {
                                      ?>
                                        <tr>
                                          <th colspan="3" style="background-color:white;">Caisse:</th>
                                          <th><select style="width: 100px;"
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

                                            </select></th>
                                        </tr>
                                      <?php } ?>
                                    </tfoot>
                                    <tbody>
                                      <?php
                                      if ($etat_reg != 0)
                                        $sql = "SELECT * from autre_exa  where ref_autre_exa = '$ref_autre' and etat!=0";
                                      else
                                        $sql = "SELECT * from autre_exa  where ref_autre_exa = '$ref_autre'";


                                      $stmt = $db->prepare($sql);
                                      $stmt->execute();

                                      $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                      foreach ($tables as $table) {

                                        $id_autre = $table['id_autre'];
                                        $id_patient = $table['id_patient'];
                                        $id_medecin = $table['id_medecin'];
                                        $id_autre_service = $table['id_autre_service'];
                                        $amount_exa = $table['amount'];
                                        $payer_exa = $table['payer'];


                                        $sql = "SELECT DISTINCT * from autres_services where id_autre_service = '$id_autre_service'";

                                        $stmt = $db->prepare($sql);
                                        $stmt->execute();

                                        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($tables as $table) {
                                          $autre_service = $table['nom'];
                                          $prix = $table['prix_autre_service'];
                                        }

                                        if (empty($id_autre_service)) {
                                          $autre_service = 'N/A';
                                        }




                                      ?>
                                        <tr align="center">
                                          <td><?= $autre_service ?></td>
                                          <td><?= $prix ?></td>
                                          <td>
                                            <?php echo $prix - $payer_exa; ?>
                                          </td>
                                          <td><input type="checkbox" class="choix" style="transform: scale(1.5);" name="id_autre_service[]" value="<?= $id_autre_service ?>"
                                              data-total="<?php echo $prix - $payer_exa; ?>" data-id="<?= $ref_autre ?>" <?php if ($prix - $payer_exa == 0) {
                                                                                                                            echo 'disabled';
                                                                                                                          } ?>></td>
                                        </tr>
                                      <?php } ?>
                                      <!-- Ajouter d'autres lignes du tableau ici -->
                                    </tbody>
                                  </table>
                                </div>
                                <div class="form-group" style="padding-top: 50px;">
                                  <div class="col-sm-12">
                                    <center>
                                      <input type="submit" style=" width:25% "
                                        name="submit_cs"
                                        class="btn btn-primary"
                                        value="Payer">
                                      <input data-dismiss="modal" type="text"
                                        style=" width:25% " name=""
                                        class="btn btn-danger"
                                        value="Annuler" />
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

<div class="modal fade" id="ajouterAutre" role="dialog">
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

  function calculerMontantTotal(ref_exa) {
    const lignesChoisies = document.querySelectorAll('input[data-id="' + ref_exa + '"]:checked');
    let montantTotal = 0;

    lignesChoisies.forEach((ligne) => {
      montantTotal += parseInt(ligne.dataset.total) || 0;
    });

    document.getElementById('montant-total' + ref_exa).value = montantTotal;
    $('.total-' + ref_exa).attr('value', montantTotal);
  }

  function calculerReste(ref_exa) {
    const montantTotal = parseInt(document.getElementById('montant-total' + ref_exa).value) || 0;
    const montantVerse = parseInt(document.getElementById('montant-verse' + ref_exa).value) || 0;
    let reste = montantTotal - montantVerse;
    let resteRembourser = 0;
    let restePayer = 0;

    if (reste < 0) {
      resteRembourser = Math.abs(reste);
    } else {
      restePayer = Math.abs(reste);
    }

    document.getElementById('reste-rembourser' + ref_exa).value = resteRembourser;
    $('.total-' + ref_exa).attr('value', montantTotal);
    document.getElementById('reste-payer' + ref_exa).value = restePayer;
    $('.total-' + ref_exa).attr('value', montantTotal);
  }

  document.addEventListener('DOMContentLoaded', () => {
    const choixCheckbox = document.querySelectorAll('.choix');

    choixCheckbox.forEach((checkbox) => {
      checkbox.addEventListener('change', () => {
        const ref_exa = checkbox.dataset.id;

        if (checkbox.checked) {
          calculerMontantTotal(ref_exa);
          calculerReste(ref_exa);
        } else {
          const autresChoixCoches = document.querySelectorAll('input[data-id="' + ref_exa + '"]:checked');
          if (autresChoixCoches.length > 0) {
            let montantTotalRestant = 0;
            autresChoixCoches.forEach((autreCheckbox) => {
              montantTotalRestant += parseInt(autreCheckbox.dataset.total) || 0;
            });
            document.getElementById('montant-total' + ref_exa).value = montantTotalRestant;
            $('.total-' + ref_exa).attr('value', montantTotalRestant);
            calculerReste(ref_exa);
          } else {
            document.getElementById('montant-total' + ref_exa).value = 0;
            $('.total-' + ref_exa).attr('value', 0);
            document.getElementById('reste-rembourser' + ref_exa).value = 0;
            document.getElementById('reste-payer' + ref_exa).value = 0;
          }
        }
      });
    });
  });
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
    case '-2';
    ?>
      <script>
        Swal.fire({
          icon: 'Erreur',
          title: 'Oops...',
          text: 'Vous n\'avez pas de caisse ou un mode de règlement.',
          footer: 'Reéssayez encore'
        })
      </script>
    <?php
      break;
    case '-1';
    ?>
      <script>
        Swal.fire({
          icon: 'Erreur',
          title: 'Oops...',
          text: 'Une erreur produit !',
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