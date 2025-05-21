<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {


  $partie = $_POST['partie'];
  $id_patient = $_POST['id_patient'];
  $date_dia = date('Y-m-d');

  $year = (new DateTime())->format("Y");
  $month = (new DateTime())->format("m");
  $day = (new DateTime())->format("d");
  $link = "liste_diagnostique.php";


  $id_medecin = $_POST['id_medecin'];
  $id_nurse = $_POST['id_nurse'];


  if (isset($_POST['id_maladie'])) {
    $id_maladie = $_POST['id_maladie'];
    // $date_exam=$_POST['date_exam'];
  } else {
    //echo 'fooog';
    $id_maladie[0] = 0;
  }
  $obs = $_POST['obs'];
  $id = count($id_maladie);

  $execute = 0;
  $total_somme = 0;
  if ($id != 0) {
    $count = array();
    for ($j = 0; $j < $id; $j++) {
      $k = 0;


      if ($id_maladie[$j] != 0) {
        $sum_quant = 0;
        //compter le nombre d'occurrence d'une type d'examen
        for ($i = 0; $i < $id; $i++) {
          if ($id_maladie[$j] == $id_maladie[$i]) {
            $sum_quant += 1;
            $count[$i] = $id_maladie[$i];
          }
        }
        //fin


        if ($execute == 0) {
          $query = " INSERT INTO diagnostic (id_patient,id_medecin,date_dia,obs,id_nurse) 
                     VALUES (:id_patient,:id_medecin,:date_dia,:obs,:id_nurse)";

          $sql = $db->prepare($query);
          // Bind parameters to statement
          // $sql->bindParam(':ref_exa', $ref_exa);
          $sql->bindParam(':id_patient', $id_patient);
          $sql->bindParam(':id_medecin', $id_medecin);
          $sql->bindParam(':date_dia', $date_dia);
          $sql->bindParam(':obs', $obs);
          $sql->bindParam(':id_nurse', $id_nurse);
          $sql->execute();
          $execute++;
        }

        $query  = "SELECT max(id_dia) as total from diagnostic";
        $q = $conn->query($query);
        while ($row = $q->fetch_assoc()) {
          $total_apt = $row["total"];
        }
        $id_app = $total_apt;
        $ref_dia = 'DIA_' . $year . '_' . $month . '_' . $id_patient . '_' . $id_app;

        //ref de l'exam
        $query1 = " UPDATE diagnostic SET  ref_dia=:ref_dia    
                        WHERE id_dia= '$id_app' ";
        $sql1 = $db->prepare($query1);

        // Bind parameters to statement
        $sql1->bindParam(':ref_dia', $ref_dia);
        $sql1->execute();


        $amount = 0;


        $query = " INSERT INTO diagnostic_exa (ref_dia_exa,id_dia,id_patient,id_medecin,id_maladie,date_dia,qte_dia_exa,id_nurse) 
                     VALUES (:ref_dia,:id_dia,:id_patient,:id_medecin,:id_maladie,:date_dia,:qte,:id_nurse)";

        $sql = $db->prepare($query);
        // Bind parameters to statement
        $sql->bindParam(':ref_dia', $ref_dia);
        $sql->bindParam(':id_dia', $id_app);
        $sql->bindParam(':id_patient', $id_patient);
        $sql->bindParam(':id_medecin', $id_medecin);
        $sql->bindParam(':id_maladie', $id_maladie[$j]);
        $sql->bindParam(':date_dia', $date_dia);
        $sql->bindParam(':qte', $sum_quant);
        $sql->bindParam(':id_nurse', $id_nurse);
        $sql->execute();
      }
    }
  }




  // $open_close = 0;
  // echo $ref_client.'</br>';
  // echo $raison_social_client.'</br>';
  // echo $id_type_client.'</br>';
  // echo $ville_client.'</br>';
  // echo $email_client.'</br>';
  // echo $pers_contact_client.'</br>';
  // echo $tel_contact_client.'</br>';


  //--------------------------------- insertion un fournisseur -----------------------------------------//

  // $query = " INSERT INTO medecin (nom_m,prenom_m,user_m,email_m)
  //                  VALUES (:nom_m,:prenom_m,:user_m,:email_m)";





  if ($sql) {
?>
    <script>
      //alert('client a été bien enregistrée.');
      // window.location.href = '<?= $examen['option2_link'] ?>?witness=1';
      window.location.href = '<?= $link ?>?witness=1';
    </script>
  <?php
  } else {
  ?>
    <script>
      //alert('Error.');
      window.location.href = '<?= $link ?>?witness=-1';
    </script>
<?php

  }
}
?>