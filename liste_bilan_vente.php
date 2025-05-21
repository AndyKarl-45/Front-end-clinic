<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');

?>

<!--Content-->

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid">
      <h1 class="mt-4"><i class="fas fa-tasks" style="color: silver"></i>BILAN VENTE</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">
          Hello M/Mme XXX, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
          .

        </li>
      </ol>
      <div class="row">
        <div class="col-xl-12">


          <b>



          </b>


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
                  <th>Années</th>
                  <th>Services</th>
                  <th>Vente cumulées</th>
                  <th>Pourcentage sur CA</th>
                  <th class="text-right">Action</th>
                  <!--                                    <th>PDF</th>-->
                </tr>
              </thead>
              <tbody>
                <?php



                $query = "
SELECT 
    YEAR(date_hist) AS annee,
    service,
    SUM(montant_entre) AS total_entrees_par_service,
    (SUM(montant_entre) / 
        (SELECT SUM(montant_entre) 
         FROM historique_caisse 
         WHERE YEAR(date_hist) = YEAR(h.date_hist)
        ) * 100) AS pourcentage
FROM 
    historique_caisse h
WHERE 
    date_hist IS NOT NULL
GROUP BY 
    YEAR(date_hist), service
ORDER BY 
    YEAR(date_hist) ASC, service ASC;
";



                $db->exec("SET sql_mode = REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', '');");

                $q = $db->query($query);
                while ($row = $q->fetch()) {
                  $annee = $row['annee'];
                  $service = $row['service'];
                  $total_entrees = number_format($row['total_entrees_par_service'], 2, ',', ' ') . ' FCFA';
                  $pourcentage = number_format($row['pourcentage'], 2, ',', ' ') . ' %';

                  switch ($service) {
                    case 0;
                      $nom_service = 'Inconnu';
                      break;
                    case 1;
                      $nom_service = 'consultation';
                      break;
                    case 2;
                      $nom_service = 'examen';
                      break;
                    case 3;
                      $nom_service = 'hospitalisation';
                      break;
                    case 4;
                      $nom_service = 'ordonnance';
                      break;
                    case 5;
                      $nom_service = 'opération';
                      break;
                    case 6;
                      $nom_service = 'anesthésie';
                      break;
                    case 7;
                      $nom_service = 'ecographie';
                      break;
                    case 8;
                      $nom_service = 'radiologie';
                      break;
                    case 9;
                      $nom_service = 'autres services';
                      break;
                    case 10;
                      $nom_service = 'vaccination';
                      break;
                    default:
                      $nom_service = 'caisse';
                  }



                ?>

                  <tr>
                    <td><a href="details_vente.php?annuel=<?= $annee ?>&service=<?= $service ?>"><?= $annee ?></a></td>
                    <td><a href="details_vente.php?annuel=<?= $annee ?>&service=<?= $service ?>"><?= $nom_service ?></a></td>
                    <td><a href="details_vente.php?annuel=<?= $annee ?>&service=<?= $service ?>"><?= $total_entrees ?></a></td>
                    <td><a href="details_vente.php?annuel=<?= $annee ?>&service=<?= $service ?>"><?= $pourcentage ?></a></td>
                    <td class="text-right">
                      <div class="dropdown dropdown-action">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                          aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="details_vente.php?annuel=<?= $annee ?>&serivce=<?= $service ?>"><i
                              class="fa fa-random"></i> Détails</a>
                          <!--<a class="dropdown-item" href="edit-patient.html"><i-->
                          <!--            class="fa fa-pencil m-r-5"></i> Edit</a>-->
                          <!--<a class="dropdown-item" href="#" data-toggle="modal"-->
                          <!--   data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i>-->
                          <!--    Delete</a>-->
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