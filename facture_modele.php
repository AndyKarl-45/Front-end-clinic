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
$id_reg_service = $_REQUEST['id'];
$nom_service=$_REQUEST['service'];

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

switch ($nom_service) {
    case 'consulation';

        break;
    case 'examen';

        break;
    case 'hospitalisation';

        break;
    case 'operation';

        break;
    case 'anesthesie';

        break;
    case 'ordonnance';

        break;
    case 'anesthesie';

        break;
    case 'ecographie';

        break;
    case 'radiologie';

        break;
    case 'autres_service';

        break;

}

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

        // Get drug's name
        $sql = "SELECT DISTINCT * from personnel where id_personnel = '$id_perso'";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tables as $table) {
            $nom_caissier = $table['nom'] . ' ' . $table['prenom'];
        }
        if (empty($id_perso_session) == "") {
            $nom_caissier = "N/A";
        }
        if (empty($id_perso) == "") {
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
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
$pdf = new PDF('P', 'mm', array(170, 80));  // Modifiez ici les dimensions
$pdf->AliasNbPages();
$pdf->AddPage();
$today = date("d-m-Y - h:i A");

// Ajustement des positions des éléments
$pdf->SetFont('Arial','B',8);  // Réduire la taille de la police
$pdf->Text(30, 8, 'HOPE SERVICES');
$pdf->SetFont('Arial','',7);
$pdf->Text(20, 12, 'MONTE LIDO/CARREFOUR PAKITA');
$pdf->Text(30, 16, '+237 222 22 03 94');
$pdf->Line(5,18,75,18);
$pdf->SetFont('Arial','',7);
$pdf->Text(30,22, 'INVOICE / RECEIPT');
$pdf->SetFont('Arial','',8);
$pdf->Text(5, 26, 'Date');
$pdf->Text(30, 26, $today);
$pdf->Text(5, 30, 'Sales point');
$pdf->Text(30, 30, 'HOPE SERVICE');
$pdf->Text(5, 34, 'Session');
$session = date("G");
if(0 > $session && $session < 13){
    $session = "morning";
}elseif (12 > $session && $session < 18){
    $session = "afternoon";
}else{
    $session = "evening";
}
$pdf->Text(30, 34, $session);
$pdf->SetFont('Arial','B',8);
$pdf->Text(5, 38, 'Facture No: ');
$pdf->Text(30,38, $ref_reg_consul);
$pdf->SetFont('Arial','',8);
$pdf->Text(5, 42, 'Cashier');
$pdf->Text(30,42, ucfirst(strtolower($nom_caissier)));
$pdf->Text(5, 46, 'Payment mode');
$pdf->Text(30,46, 'Cash');
$pdf->Text(5, 50, 'Nom Patient');
$pdf->Text(30,50, ucfirst(strtolower($nom_patient)));
$pdf->SetFont('Arial','B',8);
$pdf->SetXY(1, 54);
$pdf->Cell(45 ,5,'DESIGNATION',1,0);
$pdf->Cell(8 ,5,'QTE',1,0);
$pdf->Cell(12 ,5,'P.U',1,0);
$pdf->Cell(13 ,5,'TOTAL',1,1);
$pdf->SetFont('Arial','',6);
$pdf->SetXY(1, 59);
$pdf->Cell(45,45,'',1,0);
$pdf->Cell(8 ,45,'',1,0);
$pdf->Cell(12 ,45,'',1,0);
$pdf->Cell(13 ,45,'',1,1);
$i=2;
$total_total_ht = 0;
$id_medis[0] = 1;
foreach ($id_medis as $id_med){
    $pdf->SetFont('Arial','',6);
    $pdf->Text(2, 60+$i, strtoupper($type_consul));
    $pdf->Text(47, 60+$i, '1');
    $pdf->Text(55, 60+$i, $somme);
    $pdf->Text(67, 60+$i, $somme);
    $pdf->line(1,61+$i,79,61+$i);
    $i += 4;
}
$pdf->SetFont('Arial','B',8);
$pdf->Text(5, 110, 'Amount owed');
$pdf->Text(65,110, $somme);
$pdf->line(5,111,75,111);
$pdf->Text(5, 115, 'Amount paid');
$pdf->Text(65,115, $payer);
$pdf->line(5,116,75,116);
$pdf->Text(5, 120, 'Remise');
$pdf->Text(65,120, $remise);
$pdf->line(5,121,75,121);
$pdf->Text(5, 125, 'Difference');
$pdf->Text(65,125, $somme-($payer+$remise));
$pdf->line(5,126,75,126);
$pdf->SetFont('Arial','B',8);
$pdf->SetXY(10, 125);
$pdf->Cell(65 ,10,int2str($somme),0,1,'C');
$pdf->Cell(65 ,-2,'We wish a speedy recovery',0, 1,'C');
$pdf->SetXY(5, 130);
$pdf->Cell(70 ,17,'Drugs sold can not be returned not exchanged',0, 1,'C');
$pdf->SetXY(5, 140);
$pdf->Cell(37 ,8,iconv('UTF-8', 'windows-1252', 'Signature Caissière(ier)'),0, 0,'C');
$pdf->Cell(37 ,8,iconv('UTF-8', 'windows-1252', 'Signature Client'),0, 1,'C');

$pdf->Output();
?>
