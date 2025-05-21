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

$id_medis = [];

if (!empty($id_reg_exa)) {
  $sql = "SELECT * FROM regler_examen WHERE id_reg_exa = '$id_reg_exa'";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($tables as $table) {
    $ref_reg_exa = $table['ref_reg_exa'];
    $payer = $table['payer'];
    $remise = $table['remise'];
    $somme = $table['somme'];
    $id_patiented = $table['id_patient'];

    $sql = "SELECT DISTINCT * FROM personnel WHERE id_personnel = '$id_perso'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $personnel = $stmt->fetch(PDO::FETCH_ASSOC);
    $nom_caissier = $personnel ? $personnel['nom'] . ' ' . $personnel['prenom'] : 'N/A';

    $sql = "SELECT DISTINCT * FROM patient WHERE id_patient = '$id_patiented'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $patient = $stmt->fetch(PDO::FETCH_ASSOC);
    $nom_patiented = $patient ? $patient['nom_p'] . ' ' . $patient['prenom_p'] : 'N/A';

    $sql = "SELECT * FROM examen_exa WHERE ref_exam_exa = '$ref_reg_exa' AND etat!=0";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $examens = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($examens as $exam) {
      $id_exam_exa = $exam['id_exam_exa'];
      $id_medis[$id_exam_exa] = $id_exam_exa;
      $id_patient[$id_exam_exa] = $exam['id_patient'];
      $id_type_exa[$id_exam_exa] = $exam['id_type_exa'];
      $amount[$id_exam_exa] = $exam['amount'];

      $sql = "SELECT DISTINCT * FROM type_exa WHERE id_type_exa = '$id_type_exa[$id_exam_exa]'";
      $stmt = $db->prepare($sql);
      $stmt->execute();
      $type = $stmt->fetch(PDO::FETCH_ASSOC);
      $type_exa[$id_exam_exa] = $type ? $type['nom'] : 'N/A';
    }
  }
}

class PDF extends FPDF
{
  function Footer()
  {
    $this->SetY(-10);
    $this->SetFont('Arial', 'I', 7);
    $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
  }
}

$pdf = new PDF('P', 'mm', [150, 70]); // Format 15 cm x 7 cm en mode portrait
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 7);

$today = date("d-m-Y - h:i A");
$pdf->SetFont('Arial', 'B', 8);
$pdf->Text(10, 5, 'CLINIQUE CATHOLIQUE SAINTE MARIE');
$pdf->SetFont('Arial', '', 7);
$pdf->Text(28, 9, 'SOA CENTRE');
$pdf->Text(18, 12, '(+237) 654996123 - 688484484 ');
$pdf->Line(2, 13, 148, 13);

$esp_init = 16;
$esp_two = 28;
$pdf->SetFont('Arial', '', 8);
$pdf->Text(30, $esp_init, 'INVOICE / RECEIPT');
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
$pdf->Cell(30, 5, 'DESIGNATION', 1, 0);
$pdf->Cell(8, 5, 'QTE', 1, 0);
$pdf->Cell(12, 5, 'P.U HT', 1, 0);
$pdf->Cell(15, 5, 'TOTAL HT', 1, 1);

$pdf->SetFont('Arial', '', 7);
$pdf->SetXY(3, 40);
$pdf->Cell(30, 60, '', 1, 0);
$pdf->Cell(8, 60, '', 1, 0);
$pdf->Cell(12, 60, '', 1, 0);
$pdf->Cell(15, 60, '', 1, 1);

$i = 48;
foreach ($id_medis as $id_med) {
  $pdf->SetFont('Arial', '', 7);
  $pdf->Text(4, $i, strtoupper(iconv('UTF-8', 'windows-1252', $type_exa[$id_med])));
  $pdf->Text(34, $i, '1');
  $pdf->Text(42, $i, $amount[$id_med]);
  $pdf->Text(54, $i, $amount[$id_med]);
  $pdf->line(3, $i + 1, 68, $i + 1);
  $i += 4;
}

$longeur_line = 68;
$epace_text = 107;
$postion_result = 54;

$pdf->SetFont('Arial', 'B', 7);
$pdf->Text(3, $epace_text, 'Amount owed');
$pdf->Text($postion_result, $epace_text, $somme);
$pdf->line(3, $epace_text + 1, $longeur_line, $epace_text + 1);

$pdf->Text(3, $epace_text + 4, 'Amount paid');
$pdf->Text($postion_result, $epace_text + 4, $payer);
$pdf->line(3, $epace_text + 5, $longeur_line, $epace_text + 5);

$pdf->Text(3, $epace_text + 8, 'Remise');
$pdf->Text($postion_result, $epace_text + 8, $remise);
$pdf->line(3, $epace_text + 9, $longeur_line, $epace_text + 9);

$pdf->Text(3, $epace_text + 12, 'Difference');
$pdf->Text($postion_result, $epace_text + 12, $somme - ($payer + $remise));
$pdf->line(3, $epace_text + 13, $longeur_line, $epace_text + 13);

$pdf->SetFont('Arial', 'B', 7);
$pdf->SetXY(20, 122);
$pdf->Cell(30, 0, int2str($somme), 0, 1, 'C');
$pdf->SetFont('Arial', '', 7);
//$pdf->Cell(55, 6, 'We wish a speedy recovery', 0, 1, 'C');
//$pdf->Cell(55, 0, 'Drugs sold can not be returned not exchanged', 0, 1, 'C');

$pdf->SetFont('Arial', '', 8);
$pdf->Text(72, 72, 'Signature Caissier');
$pdf->Text(117, 72, 'Signature Client');

$pdf->Output();
