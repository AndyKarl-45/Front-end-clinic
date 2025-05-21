<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');

?>

<!--Content-->

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid">
      <h1 class="mt-4"><i class="fas fa-tasks" style="color: silver"></i> Liste des rapports caisses</h1>
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
                  <th>Nom Caisse</th>
                  <th>Nom Caissière</th>
                  <th>Solde</th>
                  <th class="text-right">Action</th>
                  <!--                                    <th>PDF</th>-->
                </tr>
              </thead>
              <tbody>
                <?php


                if ($lvl == 2) {
                  $query = "SELECT * from caisse where id_perso='$id_perso_session' and open_close!='1'  order by date_caisse asc";
                } else {
                  $query = "SELECT * from caisse where open_close!='1'  order by date_caisse asc";
                }


                $q = $db->query($query);
                while ($row = $q->fetch()) {
                  $id_caisse = $row['id_caisse'];
                  $code = $row['code'];
                  $caisse = $row['caisse'];
                  $id_perso = $row['id_perso'];
                  $date_caisse = $row['date_caisse'];
                  $solde = $row['solde'];

                  $sql = "SELECT * from personnel where id_personnel = '$id_perso'";

                  $stmt = $db->prepare($sql);
                  $stmt->execute();

                  $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($tables as $table) {
                    $nom = $table['nom'] . ' ' . $table['prenom'];
                  }




                  // Liste des noms de services
                  $services = ['regler_consul', 'regler_ecographie', 'regler_examen', 'regler_hosp', 'regler_ope', 'regler_ordo', 'regler_radiologie']; // Remplacez par vos noms de services

                  // Caisse à vérifier
                  $idCaisseAVerifier = $id_caisse; // Remplacez par l'ID de la caisse que vous souhaitez vérifier

                  // Initialiser le total des remises
                  $totalRemisesCaisse = 0;

                  // Parcourir tous les services
                  foreach ($services as $nomService) {
                    $totalRemises = 0;

                    $sql = "SELECT SUM(remise)  as rem FROM $nomService WHERE id_caisse = '$id_caisse' ";
                    $stmt = $db->prepare($sql);
                    //$stmt->bindParam(':nomService', $nomService);
                    //->bindParam(':idCaisse', $idCaisse);
                    $stmt->execute();

                    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($tables as $table) {
                      $totalRemises = $table['rem'];
                    }

                    $totalRemisesCaisse +=  $totalRemises;
                  }



                ?>

                  <tr>
                    <td><a href="details_tresorerie.php?id=<?= $id_caisse ?>"><?= $caisse ?></a></td>
                    <td><a href="details_tresorerie.php?id=<?= $id_caisse ?>"><img width="28" height="28" src="assetss/img/user.jpg"
                          class="rounded-circle m-r-5"
                          alt=""><?= $nom ?></a></td>
                    <td><a href="details_tresorerie.php?id=<?= $id_caisse ?>"><?= number_format($solde) ?></a></td>
                    <!--                                        <td align="center"><a href="#" target="_blank">-->
                    <!--                                                <i class='fa fa-print'></i>-->
                    <!--                                            </a></td>-->
                    <td class="text-right">
                      <div class="dropdown dropdown-action">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                          aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">

                          <a class="dropdown-item" href="details_tresorerie.php?id_caisse=<?= $id_caisse ?>"><i
                              class="fas fa-eye"></i> Détails</a>

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