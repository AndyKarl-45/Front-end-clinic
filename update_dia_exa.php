<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {


  /*--------------------------------- ETAT INFOS RH -------------------------------------*/
  $id = $_POST['id_maladie_last'];
  $id_maladie = $_POST['id_maladie_new'];
  $id_dia = $_POST['id_dia'];
  $ref_dia = $_POST['ref_dia'];
  $date_dia = $_POST['date_dia'];





  /*--------------------------------- SAVE DATA INFOS RH ---------------------------*/

  // $query1 = " INSERT INTO personnel (ref_client,raison_social_client,pays_client,ville_client,tel_client,email_client,pers_contact_client,tel_contact_client,nom_banque,number_card_bancaire,day_anciennete,month_anciennete,year_anciennete)
  // VALUES
  // (:ref_client,:raison_social_client,:pays_client,:ville_client,:tel_client,:email_client,:pers_contact_client,:tel_contact_client,:nom_banque,:number_card_bancaire,:day_anciennete,:month_anciennete,:year_anciennete)";

  $query1 = " UPDATE diagnostic_exa SET  id_maladie=:id_maladie, date_dia=:date_dia  WHERE id_maladie = '$id' and ref_dia_exa='$ref_dia' and id_dia='$id_dia' ";


  $sql1 = $db->prepare($query1);

  // Bind parameters to statement
  $sql1->bindParam(':id_maladie', $id_maladie);
  $sql1->bindParam(':date_dia', $date_dia);
  $sql1->execute();


  if ($sql1) {
?>
    <script>
      //alert('Type de d\'examaen  a été² bien mis à jour.');
      window.location.href = 'liste_diagnostique_exa.php?ref_dia=<?= $ref_dia ?>&witness=1';
    </script>
  <?php
  } else {
  ?>
    <script>
      alert('Diagnostic  n\'a pas été mis à jour.');
      window.location.href = 'liste_diagnostique_exa.php?ref_dia=<?= $ref_dia ?>&witness=-1';
    </script>
<?php

  }
}
?>