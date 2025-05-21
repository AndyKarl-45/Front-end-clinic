<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');

?>

<!--Content-->

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid">
      <h1 class="mt-4"><i class="fas fa-users" style="color: silver"></i> Liste des Ordonnances en cours...</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">
          Hello M/Mme XXX, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
          .

        </li>
      </ol>
      <div class="row">
        <div class="col-xl-12">
          <!-- Nav pills -->
          <ul class="nav nav-pills" style="float: right; margin-right: 20px ;">
            <li class="nav-item">
              <a class="btn btn-primary" href="liste_ordonnance.php">
                <i class="fas fa-cubes"></i>
                Retour
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
                  <th>Code Patient</th>
                  <th>Médecin</th>
                  <th>listes médicaments</th>
                  <th>observations</th>
                  <th>Date</th>
                  <th>Prix</th>
                  <th>Reste à Payer</th>
                  <th>Payer</th>
                  <?php if ($lvl != 2) { ?>
                    <th>Remise</th>
                  <?php } ?>
                  <th>Statuts</th>
                  <th>PDF</th>
                  <th class="text-right">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php


                $query = "SELECT * from regler_ordo where etat=1 ";
                $q = $db->query($query);
                while ($row = $q->fetch()) {
                  $id_reg_ordo = $row['id_reg_ordo'];
                  $id_ordo = $row['id_ordo'];
                  $ref_ordo = $row['ref_ordo'];
                  $id_patient = $row['id_patient'];
                  $id_depart = $row['id_depart'];
                  $id_medecin = $row['id_medecin'];
                  $date_ordo = $row['date_reg_ordo'];
                  $payer = $row['payer'];
                  $somme = $row['somme'];
                  $remise = $row['remise'];
                  $etat = $row['etat'];
                  $reste = $somme - $payer;

                  if ($somme - ($payer + $remise) != 0) {
                    continue;
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



                  $sql = "SELECT DISTINCT * from medecin where id_medecin = '$id_medecin'";

                  $stmt = $db->prepare($sql);
                  $stmt->execute();

                  $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($tables as $table) {
                    $nom_medecin = $table['nom_m'] . ' ' . $table['prenom_m'];
                  }

                  $sql = "SELECT DISTINCT * from departement where id_depart = '$id_depart'";

                  $stmt = $db->prepare($sql);
                  $stmt->execute();

                  $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($tables as $table) {
                    $departement = $table['nom'];
                  }

                  if (empty($id_medecin)) {
                    $nom_medecin = 'N/A';
                  }
                  //                                if(empty($id_nurse)){
                  //                                    $nom_nurse='N/A';
                  //                                }
                  if (empty($id_depart)) {
                    $departement = 'N/A';
                  }

                ?>

                  <tr>

                    <td><img width="28" height="28" src="assetss/img/user.jpg"
                        class="rounded-circle m-r-5" alt=""><?= $nom_patient ?></td>
                    <td><a href="#"><img width="28" height="28" src="assetss/img/user.jpg"
                          class="rounded-circle m-r-5" alt=""><?= $nom_medecin ?></a></td>

                    <td align="center"><a
                        class="btn btn-primary"
                        href="liste_medicament_ordo.php?ref_ordo=<?= $ref_ordo ?>"
                        title="view"
                        style="background-color: transparent">
                        <i style="color: green" class="fas fa-eye"></i>
                      </a></td>
                    <td><a href="#">observations</a></td>
                    <td><a href="#"><?= dateToFrench($date_ordo, " j F Y") ?></a></td>
                    <td><a href="#"><?= $somme ?></a></td>
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
                          echo '<span class="custom-badge status-green" data-toggle="modal" data-target="#ajouterOdor' . $id_reg_ordo . '">Ok</span>';
                        else
                          echo '<span class="custom-badge status-red" data-toggle="modal" data-target="#ajouterOdor' . $id_reg_ordo . '">Pas à Jour</span>';
                      }
                      ?>




                    </td>
                    <td align="center">
                      <a href="facture_ordonnance.php?id_reg_ordo=<?= $id_reg_ordo ?>&id_perso=<?= $id_perso_session ?>" target="_blank">
                        <i class="fa fa-print"></i>
                      </a>
                      <a href="facture_ordonnance_Ticket.php?id_reg_ordo=<?= $id_reg_ordo ?>&id_perso=<?= $id_perso_session ?>" title="Ticket" target="_blank">
                        <i class="far fa-file-alt"></i>
                      </a>
                    </td>
                    <td class="text-right">
                      <?php

                      if ($lvl == 4 ||  $lvl == 13) {
                        if ($lvl == 11 || $lvl == 7 || $lvl == 12) {
                          if ($etat == 1) {
                            echo '<a href="#" ><span class="custom-badge status-blue" ">rembourser</span></a>';
                          }
                        } else {
                          if ($etat == 1) {
                            echo '<a href="rembourser_ordo.php?id_ordo=' . $id_ordo . '&id_reg_ordo=' . $id_reg_ordo . '" onclick="Supp(this.href); return(false);"><span class="custom-badge status-blue" ">rembourser</span></a>';
                          }
                        }
                      }

                      ?>






                      <div class="modal fade" id="ajouterOdor<?= $id_reg_ordo ?>" role="dialog">
                        <div class="modal-dialog" style="max-width: 950px; !important">
                          <!-- Modal content-->
                          <div class="modal-content" style="width: 950px; !important">
                            <div class="modal-header" style="padding:20px 50px;">
                              <h3 align="center"><i class="fas fa-map"></i>
                                <b>Reglement: <?= $ref_ordo ?></b>
                              </h3>
                              <button type="button" class="close" data-dismiss="modal"
                                title="Close">&times;
                              </button>
                            </div>
                            <div class="modal-body" style="padding:20px 50px;">
                              <form class="form-horizontal" action="update_ordo_paye.php" name="form" method="post">
                                <input type="hidden" name="id_reg_ordo"
                                  value="<?= $id_reg_ordo ?>"
                                  class="form-control">
                                <input type="hidden" name="id_perso_session"
                                  value="<?= $id_perso_session ?>"
                                  class="form-control">
                                <input type="hidden" name="id_ordo"
                                  value="<?= $id_ordo ?>"
                                  class="form-control">
                                <input type="hidden" name="ref_ordo"
                                  value="<?= $ref_ordo ?>"
                                  class="form-control">
                                <div class="table-responsive">
                                  <table style="width: 100%;">
                                    <thead>
                                      <tr align="center">
                                        <th>N° lot </th>
                                        <th>Medicaments</th>
                                        <th>Infos traitement</th>
                                        <th>Type de medicament</th>
                                        <th>Quanités</th>
                                        <th>Prix unitaire</th>
                                        <th>Prix Total</th>
                                        <th>Choix</th>
                                      </tr>
                                    </thead>
                                    <tfoot>
                                      <tr>
                                        <th colspan="7" style="background-color:white;">Montant Total:</th>
                                        <th>
                                          <input type="hidden" name="montant_total" class="total-<?= $ref_ordo ?>" value="0">
                                          <input type="text" style="width: 100px;" id="montant-total<?= $ref_ordo ?>" value="0" disabled>
                                        </th>
                                      </tr>
                                      <tr>
                                        <th colspan="7">Montant versé:</th>
                                        <th>
                                          <input type="text" style="width: 100px;" name="montant_verse" id="montant-verse<?= $ref_ordo ?>" style="background-color: #dee2e6" value="0" oninput="calculerReste('<?= $ref_ordo ?>')">
                                        </th>
                                      </tr>
                                      <tr>
                                        <th colspan="7" style="background-color:white;">Reste à rembourser:</th>
                                        <th>
                                          <input type="text" style="width: 100px;" id="reste-rembourser<?= $ref_ordo ?>" value="0" disabled>
                                        </th>
                                      </tr>
                                      <tr>
                                        <th colspan="7">Reste à payer:</th>
                                        <th>
                                          <input type="text" style="width: 100px;" id="reste-payer<?= $ref_ordo ?>" value="0" disabled>
                                        </th>
                                      </tr>
                                      <?php
                                      if ($lvl != 2) {
                                      ?>
                                        <tr>
                                          <th colspan="7" style="background-color:white;">Remise:</th>
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
                                          <th colspan="7" style="background-color:white;">Mode de paiement:</th>
                                          <th>
                                            <select style="width: 100px;"
                                              name="paie">
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
                                          <th colspan="7" style="background-color:white;">Caisse:</th>
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
                                      if ($etat != 0) {
                                        $sql2 = "SELECT  * from medicament_ordo where  ref_medi_ordo='$ref_ordo' and etat!=0 ";
                                      } else {
                                        $sql2 = "SELECT  * from medicament_ordo where  ref_medi_ordo='$ref_ordo' ";
                                      }

                                      $totaux = 0;
                                      $totaux_r = 0;
                                      $cnt = 0;

                                      $stmt2 = $db->prepare($sql2);
                                      $stmt2->execute();

                                      $tables2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                                      foreach ($tables2 as $table) {
                                        $id_medi = $table['id_medi'];
                                        $quantite = $table['quantite_medi_ordo'];
                                        $posologie = $table['posologie'];
                                        $traitement = $table['traitement'];
                                        $id_medi_ordo = $table['id_medi_ordo'];
                                        $id_num_lot = $table['id_num_lot'];
                                        $payer_exa = $table['payer'];




                                        $query2 = "SELECT * from medicament where id_medi = '$id_medi'  ";
                                        $q2 = $db->query($query2);
                                        while ($row = $q2->fetch()) {
                                          $id = $row['id_medi'];
                                          $ref_medi = $row['ref_medi'];
                                          $designation = $row['nom_medi'];
                                          $id_type_medi = $row['id_type_medi'];
                                          $prix = $row['prix_u_v'];

                                          $sql = "SELECT DISTINCT * from type_medi where id_type_medi = '$id_type_medi'";

                                          $stmt = $db->prepare($sql);
                                          $stmt->execute();

                                          $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                          foreach ($tables as $table) {
                                            $type_medi = $table['nom'];
                                          }
                                          if (empty($id_type_medi)) {
                                            $type_medi = 'N/A';
                                          }


                                      ?>
                                          <tr align="center">

                                            <td> <?php echo $id_num_lot; ?> </td>
                                            <td> <?php echo $designation; ?> </td>
                                            <td> <a
                                                class="btn btn-primary"
                                                data-toggle="modal" data-target="#posologie<?= $id_medi_ordo ?>"
                                                title="view"
                                                style="background-color: transparent">
                                                <i style="color: green" class="fas fa-eye"></i>
                                              </a>
                                            </td>
                                            <td><?= $type_medi ?> </td>
                                            <td><?php echo number_format($quantite);
                                                $cnt += $quantite ?> </td>
                                            <td><?php echo number_format($prix) ?> </td>
                                            <td><?php echo number_format($prix * $quantite);
                                                $totaux += $prix * $quantite;
                                                ?>

                                              <div class="modal fade" id="posologie<?= $id_medi_ordo ?>" role="dialog">
                                                <div class="modal-dialog">
                                                  <!-- Modal content-->
                                                  <div class="modal-content">
                                                    <div class="modal-header" style="padding:20px 50px;">
                                                      <h3 align="center"><i class="fas fa-map"></i> <b>Posolosgie: <?= $designation ?></b></h3>
                                                      <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
                                                    </div>
                                                    <div class="modal-body" style="padding:40px 50px;">
                                                      <form class="form-horizontal" action="#" name="form" method="#">

                                                        <div class="form-group">
                                                          <label>Posologie:</label>
                                                          <div class="col-sm-12">
                                                            <textarea class="form-control" rows="5" cols="70"><?= $posologie ?></textarea>
                                                          </div>
                                                        </div>
                                                        <div class="form-group">
                                                          <label>Traitement:</label>
                                                          <div class="col-sm-12">
                                                            <textarea class="form-control" rows="5" cols="70"><?= $traitement ?></textarea>
                                                          </div>
                                                        </div>
                                                        <div class="form-group">
                                                          <div class="col-sm-12">
                                                            <center>
                                                              <!--<input type="submit" style=" width:25% " name="submit_cs" class="btn btn-primary"-->
                                                              <!--       value="Payer">-->

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

                                            <td><input type="checkbox" class="choix" style="transform: scale(1.5);" name="id_medi_ordo[]" value="<?= $id_num_lot ?>"
                                                data-total="<?php echo $prix * $quantite; ?>" data-id="<?= $ref_ordo ?>" <?php if ($prix - $payer_exa == 0) {
                                                                                                                            echo 'disabled';
                                                                                                                          } ?>></td>
                                          </tr>
                                      <?php }
                                      } ?>
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

<div class="modal fade" id="ajouterOdor" role="dialog">
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
              <input type="text" name="nom" class="form-control" value="450,000" disabled="">
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
<script type="text/javascript">
  function Supp(link) {
    if (confirm('Confirmer  le remboursement de l\'ordonnance ?')) {
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

  // function calculerMontantTotal() {
  //     var lignesChoisies = document.querySelectorAll('.choix:checked');
  //   let montantTotal = 0;
  //   var ref_exa="";
  //
  //   lignesChoisies.forEach((ligne) => {
  //     ref_exa = ligne.dataset.id;
  //     montantTotal += parseInt(ligne.dataset.total);
  //   });
  //
  //   document.getElementById('montant-total'+ref_exa).value = montantTotal;
  //   $('.total-'+ref_exa).attr('value',montantTotal);
  // }
  //
  // function calculerReste(ref_exa) {
  //   const montantTotal = parseInt(document.getElementById('montant-total'+ref_exa).value);
  //   const montantVerse = parseInt(document.getElementById('montant-verse'+ref_exa).value);
  //   let reste = montantTotal - montantVerse;
  //   let restePayer = 0;
  //
  //   if (reste < 0) {
  //     resteRembourser = Math.abs(reste);
  //     restePayer = 0;
  //   }else{
  //      resteRembourser = 0;
  //     restePayer = Math.abs(reste);
  //   }
  //
  //
  //   document.getElementById('reste-rembourser'+ref_exa).value = resteRembourser;
  //   $('.total-'+ref_exa).attr('value',montantTotal);
  //   document.getElementById('reste-payer'+ref_exa).value = restePayer;
  //   $('.total-'+ref_exa).attr('value',montantTotal);
  // }
  //
  //
  //
  // document.addEventListener('DOMContentLoaded', () => {
  //   const choixCheckbox = document.querySelectorAll('.choix');
  //
  //   choixCheckbox.forEach((checkbox) => {
  //     checkbox.addEventListener('change', () => {
  //         var ref_exa = checkbox.dataset.id;
  //         document.getElementById('montant-total'+ref_exa).value =0;
  //         document.getElementById('reste-payer'+ref_exa).value =0;
  //         $('.total-'+ref_exa).attr('value',0);
  //
  //       calculerMontantTotal();
  //       calculerReste(ref_exa);
  //     });
  //   });
  // });
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
    case '-2';
    ?>
      <script>
        Swal.fire({
          icon: 'Erreur',
          title: 'Oops...',
          text: 'Stock Insuffisant !',
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