<?php
setlocale(LC_CTYPE, 'fr_FR');
require('fpdf/fpdf.php');
require('convertisseur.php');
require('convertion_chiffre_lettre.php');
try {
  $db = new PDO('mysql:host=localhost;dbname=c2164852c_clinic_syges;charset=utf8', 'root', '');
} catch (PDOException $e) {
  die('Erreur: ' . $e->getMessage());
}
$id_perso = $_REQUEST['id_perso'];

$id_reg_exa = $_REQUEST['id_reg_exa'];

function dateDifference($start_date, $end_date)
{
  // calulating the difference in timestamps
  $diff = strtotime($start_date) - strtotime($end_date);

  $start_y = date("Y", strtotime($start_date));
  $start_m  = date("m", strtotime($start_date));
  $start_d  = date("d", strtotime($start_date));

  $end_y = date("Y", strtotime($end_date));
  $end_m = date("m", strtotime($end_date));
  $end_d = date("d", strtotime($end_date));

  if ($start_y == $end_y and $start_m == $end_m and $start_d > $end_d) {
    return -1;
  }
  if ($start_y == $end_y and $start_m > $end_m) {
    return -1;
  }
  if ($start_y > $end_y) {
    return -1;
  }

  // 1 day = 24 hours
  // 24 * 60 * 60 = 86400 seconds
  return ceil(abs($diff / 86400));
}

$id_medis = [];

if (!empty($id_reg_exa)) {
  $id_reg_exa = $_REQUEST['id_reg_exa'];
  $cpt = 0;


  //    Tes requetes

  $sql = "SELECT * from regler_examen where id_reg_exa = '$id_reg_exa'";

  $stmt = $db->prepare($sql);
  $stmt->execute();

  $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($tables as $table) {
    $ref_reg_exa = $table['ref_reg_exa'];
    $payer = $table['payer'];
    $remise = $table['remise'];
    $somme = $table['somme'];
    $id_patiented = $table['id_patient'];

    //            Get drug's name
    $sql = "SELECT DISTINCT * from personnel where id_personnel = '$id_perso'";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tables as $table) {
      $nom_caissier = $table['nom'] . ' ' . $table['prenom'];
    }
    // if(empty($id_perso_session)==""){
    //     $nom_caissier="N/A";
    // }
    if (empty($id_perso) == "") {
      $nom_caissier = "N/A";
    }

    $sql = "SELECT DISTINCT * from patient where id_patient = '$id_patiented'";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tables as $table) {
      $nom_patiented = $table['nom_p'] . ' ' . $table['prenom_p'];
    }



    $sql = "SELECT * from examen_exa where ref_exam_exa = '$ref_reg_exa' and etat!=0 ";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tables as $table) {
      $id_exam_exa = $table['id_exam_exa'];
      $id_medis[$id_exam_exa] = $id_exam_exa;
      $id_patient[$id_exam_exa] = $table['id_patient'];
      $id_type_exa[$id_exam_exa] = $table['id_type_exa'];
      $amount[$id_exam_exa] = $table['amount'];
      $qte_exam_exa[$id_exam_exa] = $table['qte_exam_exa'];



      $sql = "SELECT DISTINCT * from patient where id_patient = '$id_patient[$id_exam_exa]'";

      $stmt = $db->prepare($sql);
      $stmt->execute();

      $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach ($tables as $table) {
        $nom_patient[$id_exam_exa] = $table['nom_p'] . ' ' . $table['prenom_p'];
      }

      $sql = "SELECT DISTINCT * from type_exa where id_type_exa = '$id_type_exa[$id_exam_exa]'";

      $stmt = $db->prepare($sql);
      $stmt->execute();

      $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach ($tables as $table) {
        $type_exa[$id_exam_exa] = $table['nom'];
      }
    }


    if (empty($id_type_exa)) {
      $type_exa = 'N/A';
    }
    if (empty($ref_reg_exa)) {
      $ref_reg_exa = 'N/A';
    }




    //        $sql = "SELECT  * from medicament_ordo where  ref_medi_ordo='$ref_ordo'";
    //
    //        $stmt = $db->prepare($sql);
    //        $stmt->execute();
    //
    //        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //
    //        foreach ($tables as $row) {
    //            $id_medi= $row['id_medi'];
    //            $id_medis[$id_medi]=$id_medi;
    //            $quantite[$id_medi]= $row['quantite_medi_ordo'];
    //
    //
    //            $sql = "SELECT DISTINCT * from medicament where id_medi = '$id_medi'";
    //
    //            $stmt = $db->prepare($sql);
    //            $stmt->execute();
    //
    //            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //
    //            foreach ($tables as $table) {
    //                $ref_medi[$id_medi] = $table['ref_medi'];
    //                $nom_medi[$id_medi] = $table['nom_medi']; // [id_medi => nom]
    //                $prix_ht[$id_medi] = $table['prix_u_v'];
    //                //$prix_ttc[$id_medi] = $table['prix_u_v'];
    //            }
    //
    //            $cpt++;
    //        }


  }

  //    Fin des requetes
}
class PDF extends FPDF
{
  // Page header
  //	function Header()
  //	{
  //		// GFG logo image
  ////		$this->Image('img/logo.jpeg', 10, 6, 80);
  //
  //		// Set font-family and font-size
  //		$this->SetFont('Times','B',20);
  //
  //		// Move to the right
  //		$this->Cell(20);
  //
  //		// Set the title of pages.
  //		$this->Cell(30, 20, ' ', 0, 2, 'C');
  //
  //		// Break line with given space
  //		$this->Ln(1);
  //	}

  // Page footer
  function Footer()
  {
    // Position at 1.5 cm from bottom
    $this->SetY(-15);

    // Set font-family and font-size of footer.
    $this->SetFont('Arial', 'I', 8);

    // set page number
    $this->Cell(0, 10, 'Page ' . $this->PageNo() .
      '/{nb}', 0, 0, 'C');
  }
}

//$date = date("d/m/Y");

// Create new object (P = potrait page | L = paysage PAGE)
//$pdf = new PDF('L', 'mm', 'A5');
//   $pdf = new PDF('L','mm',array(148,210));
//$pdf = new PDF('L', 'mm', [90, 150]);

$pdf = new PDF('P', 'mm', [150, 90]); // Format 15cm x 9cm en mode portrait
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial', '', 8);
$today = date("d-m-Y - h:i A");
$pdf->SetFont('Arial', 'B', 8);
$pdf->Text(20, 5, 'CLINIQUE CATHOLIQUE SAINTE MARIE');
$pdf->SetFont('Arial', '', 7);
$pdf->Text(40, 9, 'SOA CENTRE');
$pdf->Text(30, 12, '(+237) 654996123 - 688484484 ');
$pdf->Line(2, 13, 148, 13);

$esp_init = 16;
$esp_two = 28;
$pdf->SetFont('Arial', '', 9);
$pdf->Text(31, $esp_init, 'INVOICE / RECEIPT');
$pdf->Text(3, $esp_init + 5, 'Date:');
$pdf->Text($esp_two, $esp_init + 5, $today);
$pdf->Text(3, $esp_init + 9, 'Recu No:');
$pdf->Text($esp_two, $esp_init + 9, $id_reg_exa);
$pdf->Text(3, $esp_init + 13, 'Cashier:');
$pdf->Text($esp_two, $esp_init + 13, ucfirst(strtolower($nom_caissier)));
$pdf->Text(3, $esp_init + 17, 'Payment mode:');
$pdf->Text($esp_two, $esp_init + 17, 'Cash');
$pdf->Text(3, $esp_init + 21, 'Nom Patient:');
$pdf->Text($esp_two, $esp_init + 21, ucfirst(strtolower($nom_patiented)));

$pdf->SetFont('Arial', 'B', 7);
$pdf->SetXY(3, 40);
$pdf->Cell(52, 5, 'DESIGNATION', 1, 0);
$pdf->Cell(7, 5, 'QTE', 1, 0);
$pdf->Cell(11, 5, 'P.U HT', 1, 0);
$pdf->Cell(14, 5, 'TOTAL HT', 1, 1);

$pdf->SetFont('Arial', '', 7);
$pdf->SetXY(3, 40);
$pdf->Cell(52, 65, '', 1, 0);
$pdf->Cell(7, 65, '', 1, 0);
$pdf->Cell(11, 65, '', 1, 0);
$pdf->Cell(14, 65, '', 1, 1); //end of line

$i = 48;
foreach ($id_medis as $id_med) {
  $pdf->SetFont('Arial', '', 7);
  $pdf->Text(4, $i, strtoupper(iconv('UTF-8', 'windows-1252', $type_exa[$id_med])));
  $pdf->Text(56, $i, '1');
  $pdf->Text(63, $i, $amount[$id_med]);
  $pdf->Text(74, $i, $amount[$id_med]);
  $pdf->line(3, $i + 1, 87, $i + 1);
  $i += 4;
}

// $pdf->SetFont('Arial', 'B', 6);
// $pdf->Text(3, 40, 'Amount owed');
// $pdf->Text(35, 40, $somme);
// $pdf->line(3, 41, 55, 41);

// $pdf->Text(3, 44, 'Amount paid');
// $pdf->Text(35, 44, $payer);
// $pdf->line(3, 45, 55, 45);

// $pdf->Text(3, 48, 'Remise');
// $pdf->Text(35, 48, $remise);
// $pdf->line(3, 49, 55, 49);

// $pdf->Text(3, 52, 'Difference');
// $pdf->Text(35, 52, $somme - ($payer + $remise));
// $pdf->line(3, 53, 55, 53);

$longeur_line = 87;
$epace_text = 108;
$postion_result = 74;
///totaux
$pdf->SetFont('Arial', 'B', 7);
$pdf->Text(3, $epace_text, 'Amount owed', 0);
$pdf->Text($postion_result, $epace_text, $somme);
$pdf->line(3, $epace_text + 1, $longeur_line, $epace_text + 1);

$pdf->Text(3, $epace_text + 4, 'Amount paid', 0);
$pdf->Text($postion_result, $epace_text + 4, $payer);
$pdf->line(3, $epace_text + 5, $longeur_line, $epace_text + 5);

$pdf->Text(3, $epace_text + 8, 'Remise', 0);
$pdf->Text($postion_result, $epace_text + 8, $remise);
$pdf->line(3, $epace_text + 9, $longeur_line, $epace_text + 9);

$pdf->Text(3, $epace_text + 12, 'Difference');
$pdf->Text($postion_result, $epace_text + 12, $somme - ($payer + $remise));
$pdf->line(3, $epace_text + 13, $longeur_line, $epace_text + 13);

$pdf->SetFont('Arial', 'B', 7);
$pdf->SetXY(8, 124);
$pdf->Cell(75, 0, int2str($somme), 0, 1, 'C');
$pdf->SetFont('Arial', '', 7);
//$pdf->Cell(75, 6, 'We wish a speedy recovery', 0, 1, 'C');
//$pdf->Cell(75, 0, 'Drugs sold cannot be returned or exchanged', 0, 1, 'C');

$pdf->SetFont('Arial', '', 8);
$pdf->Text(8, 132, 'Signature Caissier');
$pdf->Text(60, 132, 'Signature Client');

$pdf->Output();
