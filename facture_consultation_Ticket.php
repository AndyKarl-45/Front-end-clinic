<?php
setlocale(LC_CTYPE, 'fr_FR');
require('fpdf/fpdf.php');
require('convertisseur.php');
require('convertion_chiffre_lettre.php');
try{
    $db = new PDO('mysql:host=localhost;dbname=c2164852c_clinic_syges;charset=utf8', 'root', '');
}catch(PDOException $e){
    die('Erreur: '.$e->getMessage());
}
$id_perso = $_REQUEST['id_perso'];
$id_reg_consul = $_REQUEST['id_reg_consul'];

function dateDifference($start_date, $end_date)
{
    $diff = strtotime($start_date) - strtotime($end_date);

    $start_y = date("Y",strtotime($start_date));
    $start_m  = date("m",strtotime($start_date));
    $start_d  = date("d",strtotime($start_date));

    $end_y = date("Y",strtotime($end_date));
    $end_m = date("m",strtotime($end_date));
    $end_d = date("d",strtotime($end_date));

    if($start_y == $end_y AND $start_m == $end_m AND $start_d > $end_d){
        return -1;
    }
    if($start_y == $end_y AND $start_m > $end_m){
        return -1;
    }
    if($start_y > $end_y){
        return -1;
    }

    return ceil(abs($diff / 86400));
}

$id_medis = [];

if (!empty($id_reg_consul)) {
    $id_reg_consul = $_REQUEST['id_reg_consul'];
    $cpt = 0;

    // Tes requetes

    $sql = "SELECT * from regler_consul where id_reg_consul = '$id_reg_consul'";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tables as $table) {
        $ref_reg_consul = $table['ref_reg_consul'];
        $id_patient = $table['id_patient'];
        $payer = $table['payer'];
        $remise = $table['remise'];
        $somme = $table['somme'];
        $id_type_consul = $table['id_type_consul'];
        $id_caisse = $table['id_caisse'];

        // Get drug's name
        $sql = "SELECT DISTINCT * from caisse where id_caisse = '$id_caisse'";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tables as $table) {
            $id_perso = $table['id_perso'];
        }

        // Get drug's name
        $sql = "SELECT DISTINCT * from personnel where id_personnel = '$id_perso'";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tables as $table) {
            $nom_caissier = $table['nom'];
        }
        if (empty($id_perso_session) == "") {
            $nom_caissier = "N/A";
        }
        if (empty($id_perso)) {
            $nom_caissier = "N/A";
        }

        $sql = "SELECT DISTINCT * from patient where id_patient = '$id_patient'";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tables as $table) {
            $nom_patient = $table['nom_p'] . ' ' . $table['prenom_p'];
        }

        $sql = "SELECT DISTINCT * from type_consul where id_type_consul = '$id_type_consul'";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tables as $table) {
            $type_consul = $table['nom'];
        }


        if (empty($id_type_consul)) {
            $type_consul = 'N/A';
        }
        if (empty($ref_reg_consul)) {
            $ref_reg_consul = 'N/A';
        }
    }

    // Fin des requetes
}

class PDF extends FPDF
{
    function Footer()
    {
        $this->SetY(-8);
        $this->SetFont('Arial', 'I', 5);
        $this->Cell(0, 5, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
$pdf = new PDF('P', 'mm', array(124, 82));  // Modifiez ici les dimensions
$pdf->AliasNbPages();
$pdf->AddPage();
$today = date("d-m-Y - h:i A");

// Ajustement des positions des éléments
$pdf->SetFont('Arial','B',8);  // Réduire la taille de la police
$pdf->Text(13, 6, 'CLINIQUE CATHOLIQUE SAINTE MARIE');
$pdf->SetFont('Arial','',7);
$pdf->Text(32, 10, 'SOA CENTRE');
$pdf->Text(22, 14, ' (+237) 654996123 - 688484484');
$pdf->Line(5,16,77,16);
$pdf->SetFont('Arial','',7);
$pdf->SetFont('Arial','',8);
$pdf->Text(5, 20, 'Date');
$pdf->Text(30, 20, $today);
$session = date("G");
$pdf->SetFont('Arial','B',8);
$pdf->Text(5, 25, 'Recu No: ');
$pdf->Text(30,25, $ref_reg_consul);
$pdf->SetFont('Arial','',8);
$pdf->Text(5, 30, iconv('UTF-8', 'windows-1252', 'Caissière'));
$pdf->Text(30,30, ucfirst(strtolower($nom_caissier)));
$pdf->Text(5, 35, 'mode de paiement');
$pdf->Text(30,35, 'Cash');
$pdf->Text(5, 40, 'Nom Patient');
$pdf->Text(30,40, ucfirst(strtolower($nom_patient)));
$pdf->SetFont('Arial','B',7);
$pdf->SetXY(5, 45);
$pdf->Cell(45 ,4,'DESIGNATION',1,0);
$pdf->Cell(7 ,4,'QTE',1,0);
$pdf->Cell(10 ,4,'  P.U',1,0);
$pdf->Cell(10 ,4,'TOTAL',1,1);
$pdf->SetFont('Arial','',6);
$pdf->SetXY(5, 45);
$pdf->Cell(45,30,'',1,0);
$pdf->Cell(7 ,30,'',1,0);
$pdf->Cell(10 ,30,'',1,0);
$pdf->Cell(10 ,30,'',1,1);
$i=2;
$total_total_ht = 0;
$id_medis[0] = 1;
foreach ($id_medis as $id_med){
    $pdf->SetFont('Arial','',7);
    $pdf->Text(6, 50+$i, strtoupper($type_consul));
    $pdf->Text(52, 50+$i, '1');
    $pdf->Text(58, 50+$i, $somme);
    $pdf->Text(68, 50+$i, $somme);
    $pdf->line(5,51+$i,77,51+$i);
    $i += 4;
}
$pdf->SetFont('Arial','B',7);
$pdf->Text(5, 80, iconv('UTF-8', 'windows-1252', 'Montant à payer'));
$pdf->Text(67,80, $somme);
$pdf->line(5,81,77,81);
$pdf->Text(5, 86, 'Montant payer');
$pdf->Text(67,86, $payer);
$pdf->line(5,87,77,87);
$pdf->Text(5, 92, iconv('UTF-8', 'windows-1252', 'Reste à payer'));
$pdf->Text(67,92, $somme-$payer);
$pdf->line(5,93,77,93);
$pdf->Text(5, 98, 'Remboursement');
$pdf->Text(67,98, $somme-($payer+$remise));
$pdf->line(5,99,77,99);
$pdf->SetFont('Arial','B',8);
$pdf->SetXY(10, 105);
$pdf->Cell(65 ,-2,iconv('UTF-8', 'windows-1252', 'Bonne guérison !'),0, 1,'C');
$pdf->Output();
?>
