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

$id_reg_consul = $_REQUEST['id_reg_consul'];

function dateDifference($start_date, $end_date)
{
    // calulating the difference in timestamps
    $diff = strtotime($start_date) - strtotime($end_date);

    $start_y = date("Y", strtotime($start_date));
    $start_m = date("m", strtotime($start_date));
    $start_d = date("d", strtotime($start_date));

    $end_y = date("Y", strtotime($end_date));
    $end_m = date("m", strtotime($end_date));
    $end_d = date("d", strtotime($end_date));

    if ($start_y == $end_y AND $start_m == $end_m AND $start_d > $end_d) {
        return -1;
    }
    if ($start_y == $end_y AND $start_m > $end_m) {
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
$pdf = new PDF('L', 'mm', 'A5');
//   $pdf = new PDF('L','mm',array(148,210));
$pdf->AliasNbPages();

// Add new pages
$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial', '', 10);

//header
$today = date("d-m-Y - h:i A");
$pdf->SetFont('Arial', 'B', 14);
//$pdf->Text(57, 10, 'CLINIQUE CATHOLIQUE SAINTE MARIE');

//$pdf->SetFont('Arial', '', 12);
//$pdf->Text(70, 16, 'SOA CENTRE');
//$pdf->Text(88, 22, '+237 ');

$pdf->Image('img/entete.png', 45, 2, 120);

$pdf->Line(5, 24, 205, 24);

$pdf->SetFont('Arial', '', 10);
$pdf->Text(58, 30, 'INVOICE / RECEIPT');

$pdf->SetFont('Arial', '', 10);
$pdf->Text(10, 35, 'Date');
$pdf->Text(55, 35, $today);

$pdf->Text(10, 40, 'Sales point');
$pdf->Text(55, 40, 'CLINIQUE CATHOLIQUE SAINTE MARIE');

$pdf->Text(10, 45, 'Session');
$session = date("G");
if (0 > $session && $session < 13) {
    $session = "morning";
} elseif (12 > $session && $session < 18) {
    $session = "afternoon";
} else {
    $session = "evening";
}
$pdf->Text(55, 45, $session);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Text(10, 50, 'Facture No: ');
$pdf->Text(55, 50, $ref_reg_consul);

$pdf->SetFont('Arial', '', 10);
$pdf->Text(10, 55, 'Cashier');
$pdf->Text(55, 55, ucfirst(strtolower($nom_caissier)));

$pdf->Text(10, 60, 'Client');
$pdf->Text(55, 60, ucfirst(strtolower($nom_patient)));

$pdf->Text(10, 65, 'Payment mode');
$pdf->Text(55, 65, 'Cash');

$pdf->Text(10, 70, 'Nom Patient');
$pdf->Text(55, 70, ucfirst(strtolower($nom_patient)));

//set font to arial, regular, 12pt
$pdf->SetFont('Arial', '', 12);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(94.5, 2.5, '', 0, 1);//end of line

//billing address
$pdf->Cell(94.5, 2.5, '', 0, 1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(5, 2.5, '', 0, 0);
$pdf->Cell(45, 2.5, '', 0, 1);

$pdf->Cell(5, 2.5, '', 0, 0);
$pdf->Cell(45, 2.5, '', 0, 1);

$pdf->Cell(5, 2.5, '', 0, 0);
$pdf->Cell(45, 2.5, '', 0, 1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(94.5, 5, '', 0, 1);//end of line

//invoice contents
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetXY(102, 27);
$pdf->Cell(55, 5, 'DESIGNATION', 1, 0);
$pdf->Cell(10, 5, 'QTE', 1, 0);
$pdf->Cell(17.5, 5, 'P.U HT', 1, 0);
$pdf->Cell(20, 5, 'TOTAL HT', 1, 1);//end of line

$pdf->SetFont('Arial', '', 16);
$pdf->SetXY(102, 27);
$pdf->Cell(55, 80, '', 1, 0);
$pdf->Cell(10, 80, '', 1, 0);
$pdf->Cell(17.5, 80, '', 1, 0);
$pdf->Cell(20, 80, '', 1, 1);//end of line

// Contenu de ton bon

// Changer 50 par le nombre de produits, donc il faut mettre un compteur dans ta requete qui va compter le nombre de produits
$i = 0;
$total_total_ht = 0;
$id_medis[0] = 1;
foreach ($id_medis as $id_med) {
    $pdf->SetFont('Arial', '', 8);
    $pdf->Text(103, 35.5 + $i, strtoupper($type_consul));
    $pdf->SetFont('Arial', '', 8);
    $pdf->Text(158, 35.5 + $i, '1');
    $pdf->Text(168, 35.5 + $i, $somme);
    $pdf->Text(185, 35.5 + $i, $somme);

    $pdf->line(102, 37 + $i, 204.5, 37 + $i);
    $i += 7;
}

///totaux
$pdf->SetFont('Arial', 'B', 10);
$pdf->Text(10, 90, 'Amount owed', 0);
$pdf->Text(60, 90, $somme);
$pdf->line(10, 91, 85, 91);

$pdf->Text(10, 95, 'Amount paid', 0);
$pdf->Text(60, 95, $payer);
$pdf->line(10, 96, 85, 96);

$pdf->Text(10, 100, 'Remise', 0);
$pdf->Text(60, 100, $remise);
$pdf->line(10, 101, 85, 101);

$pdf->Text(10, 105, 'Difference');
$pdf->Text(60, 105, $somme - ($payer + $remise));
$pdf->line(10, 106, 85, 106);

$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(75, 5, int2str($somme), 0, 1, 'C');
$pdf->line(5, 177.5, 100, 177.5);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(75, 5, 'We wish a speedy recovery', 0, 1, 'C');
$pdf->line(5, 182.5, 100, 182.5);

$pdf->Cell(74, 5, 'Drugs sold can not be returned not exchanged', 0, 1, 'C');

$pdf->SetXY(102, 110);
$pdf->Cell(45, 10, iconv('UTF-8', 'windows-1252', 'Signature Caissière(ier)'), 0, 0, 'C');
$pdf->Cell(60, 10, iconv('UTF-8', 'windows-1252', 'Signature Client'), 0, 1, 'C');

// Deuxième facture (adaptation pour qu'elle soit en dessous de la première)

// Positionnement pour la deuxième facture
$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial', '', 10);

//header
$today = date("d-m-Y - h:i A");
$pdf->SetFont('Arial', 'B', 14);
//$pdf->Text(87, 10, 'HOPE SERVICES');
//
//$pdf->SetFont('Arial', '', 12);
//$pdf->Text(70, 16, 'MONTE LIDO/CARREFOUR PAKITA');
//$pdf->Text(88, 22, '+237 222 22 03 94');
$pdf->Image('img/entete.png', 45, 2, 120);

$pdf->Line(5, 24, 205, 24);

$pdf->SetFont('Arial', '', 10);
$pdf->Text(58, 30, 'INVOICE / RECEIPT');

$pdf->SetFont('Arial', '', 10);
$pdf->Text(10, 35, 'Date');
$pdf->Text(55, 35, $today);

$pdf->Text(10, 40, 'Sales point');
$pdf->Text(55, 40, 'HOPE SERVICE');

$pdf->Text(10, 45, 'Session');
$session = date("G");
if (0 > $session && $session < 13) {
    $session = "morning";
} elseif (12 > $session && $session < 18) {
    $session = "afternoon";
} else {
    $session = "evening";
}
$pdf->Text(55, 45, $session);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Text(10, 50, 'Facture No: ');
$pdf->Text(55, 50, $ref_reg_consul);

$pdf->SetFont('Arial', '', 10);
$pdf->Text(10, 55, 'Cashier');
$pdf->Text(55, 55, ucfirst(strtolower($nom_caissier)));

$pdf->Text(10, 60, 'Client');
$pdf->Text(55, 60, ucfirst(strtolower($nom_patient)));

$pdf->Text(10, 65, 'Payment mode');
$pdf->Text(55, 65, 'Cash');

$pdf->Text(10, 70, 'Nom Patient');
$pdf->Text(55, 70, ucfirst(strtolower($nom_patient)));

//set font to arial, regular, 12pt
$pdf->SetFont('Arial', '', 12);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(94.5, 2.5, '', 0, 1);//end of line

//billing address
$pdf->Cell(94.5, 2.5, '', 0, 1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(5, 2.5, '', 0, 0);
$pdf->Cell(45, 2.5, '', 0, 1);

$pdf->Cell(5, 2.5, '', 0, 0);
$pdf->Cell(45, 2.5, '', 0, 1);

$pdf->Cell(5, 2.5, '', 0, 0);
$pdf->Cell(45, 2.5, '', 0, 1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(94.5, 5, '', 0, 1);//end of line

//invoice contents
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetXY(102, 27);
$pdf->Cell(55, 5, 'DESIGNATION', 1, 0);
$pdf->Cell(10, 5, 'QTE', 1, 0);
$pdf->Cell(17.5, 5, 'P.U HT', 1, 0);
$pdf->Cell(20, 5, 'TOTAL HT', 1, 1);//end of line

$pdf->SetFont('Arial', '', 16);
$pdf->SetXY(102, 27);
$pdf->Cell(55, 80, '', 1, 0);
$pdf->Cell(10, 80, '', 1, 0);
$pdf->Cell(17.5, 80, '', 1, 0);
$pdf->Cell(20, 80, '', 1, 1);//end of line

// Contenu de ton bon

// Changer 50 par le nombre de produits, donc il faut mettre un compteur dans ta requete qui va compter le nombre de produits
$i = 0;
$total_total_ht = 0;
$id_medis[0] = 1;
foreach ($id_medis as $id_med) {
    $pdf->SetFont('Arial', '', 8);
    $pdf->Text(103, 35.5 + $i, strtoupper($type_consul));
    $pdf->SetFont('Arial', '', 8);
    $pdf->Text(158, 35.5 + $i, '1');
    $pdf->Text(168, 35.5 + $i, $somme);
    $pdf->Text(185, 35.5 + $i, $somme);

    $pdf->line(102, 37 + $i, 204.5, 37 + $i);
    $i += 7;
}

///totaux
$pdf->SetFont('Arial', 'B', 10);
$pdf->Text(10, 90, 'Amount owed', 0);
$pdf->Text(60, 90, $somme);
$pdf->line(10, 91, 85, 91);

$pdf->Text(10, 95, 'Amount paid', 0);
$pdf->Text(60, 95, $payer);
$pdf->line(10, 96, 85, 96);

$pdf->Text(10, 100, 'Remise', 0);
$pdf->Text(60, 100, $remise);
$pdf->line(10, 101, 85, 101);

$pdf->Text(10, 105, 'Difference');
$pdf->Text(60, 105, $somme - ($payer + $remise));
$pdf->line(10, 106, 85, 106);

$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(75, 5, int2str($somme), 0, 1, 'C');
$pdf->line(5, 177.5, 100, 177.5);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(75, 5, 'We wish a speedy recovery', 0, 1, 'C');
$pdf->line(5, 182.5, 100, 182.5);

$pdf->Cell(74, 5, 'Drugs sold can not be returned not exchanged', 0, 1, 'C');

$pdf->SetXY(102, 110);
$pdf->Cell(45, 10, iconv('UTF-8', 'windows-1252', 'Signature Caissière(ier)'), 0, 0, 'C');
$pdf->Cell(60, 10, iconv('UTF-8', 'windows-1252', 'Signature Client'), 0, 1, 'C');


$pdf->Output();
?>
