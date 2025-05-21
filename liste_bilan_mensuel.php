<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');

?>

<!--Content-->

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid">
      <h1 class="mt-4"><i class="fas fa-tasks" style="color: silver"></i>BILAN MEMSUEL</h1>
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
                  <th>Mois</th>
                  <th>Total Entrées</th>
                  <th>Total Sorties</th>
                  <th>Soldes</th>
                  <th class="text-right">Action</th>
                  <!--                                    <th>PDF</th>-->
                </tr>
              </thead>
              <tbody>
                <?php



                $query = "
                      SELECT 
                        DATE_FORMAT(date_hist, '%Y-%m') AS mois,
                        SUM(montant_entre) AS total_entrees,
                        SUM(montant_sortie) AS total_sorties,
                        SUM(montant_entre) - SUM(montant_sortie) AS solde
                      FROM 
                        historique_caisse
                      WHERE 
                        date_hist IS NOT NULL
                      GROUP BY 
                        DATE_FORMAT(date_hist, '%Y-%m')
                      ORDER BY 
                        DATE_FORMAT(date_hist, '%Y-%m') DESC;
                      ";


                $db->exec("SET sql_mode = REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', '');");
                $q = $db->query($query);
                while ($row = $q->fetch()) {
                  $mois = $row['mois'];
                  $total_entrees = number_format($row['total_entrees'], 2, ',', ' ') . ' FCFA';
                  $total_sorties = number_format($row['total_sorties'], 2, ',', ' ') . ' FCFA';
                  $solde = number_format($row['solde'], 2, ',', ' ') . ' FCFA';



                ?>

                  <tr>
                    <td><a href="details_mensuel.php?mois=<?= $mois ?>"><?= dateToFrench($mois, "F") ?></a></td>
                    <td><a href="details_mensuel.php?mois=<?= $mois ?>"><?= $total_entrees ?></a></td>
                    <td><a href="details_mensuel.php?mois=<?= $mois ?>"><?= $total_sorties ?></a></td>
                    <?php if ($solde >= 0) {
                      echo '<td style="color:green;font-weight:400">' . number_format($row['solde'], 2, ',', ' ') . ' FCFA</td>';
                    } else {
                      echo '<td style=color:red;font-weight:400">' . number_format($row['solde'], 2, ',', ' ') . ' FCFA</td>';
                    }
                    ?>
                    <td class="text-right">
                      <div class="dropdown dropdown-action">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                          aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="details_mensuel.php?mois=<?= $mois ?>"><i
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