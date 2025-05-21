<?php
require('fpdf/fpdf.php');
include('phpqrcode/qrlib.php');

// Infos de connection à la BD
try {
  //$db = new PDO('mysql:host=localhost;dbname=closer_onigc_syges;charset=utf8', 'closer_onigc_syges_root', 'j,jjkp{.RE${');
  $db = new PDO('mysql:host=localhost;dbname=closer_onigc_syges;charset=utf8', 'root', '');
} catch (PDOException $e) {
  die('Erreur: ' . $e->getMessage());
}

function dateToFrench($date, $format)
{
  $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
  $french_days = array('Lundi', 'Mardi', 'Mercredi', 'jeudi', 'Vendredi', 'Samedi', 'Dimanche');
  $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
  $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
  return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date))));
}

class PDF extends FPDF
{
  // Page header
  //    function Header()
  //    {
  //        // GFG logo image
  //        $this->Image('Picture1.png', 10, 6, 40, 40);
  //
  //        // Set font-family and font-size
  //        $this->SetFont('Times','B',20);
  //
  //        // Move to the right
  //        $this->Cell(20);
  //
  //        // Set the title of pages.
  //        $this->Cell(30, 20, ' ', 0, 2, 'C');
  //
  //        // Break line with given space
  //        $this->Ln(5);
  //    }



  // Page footer
  function Footer()
  {
    // Position at 1.5 cm from bottom
    $this->SetY(-15);

    // Set font-family and font-size of footer.
    $this->SetFont('Arial', 'I', 8);

    // set page number
    //$this->Cell(0, 10, 'Page ' . $this->PageNo() .
    //  '/{nb}', 0, 0, 'C');
  }

  function subWrite($h, $txt, $link = '', $subFontSize = 12, $subOffset = 0)
  {
    // resize font
    $subFontSizeold = $this->FontSizePt;
    $this->SetFontSize($subFontSize);

    // reposition y
    $subOffset = ((($subFontSize - $subFontSizeold) / $this->k) * 0.3) + ($subOffset / $this->k);
    $subX        = $this->x;
    $subY        = $this->y;
    $this->SetXY($subX, $subY - $subOffset);

    //Output text
    $this->Write($h, $txt, $link);

    // restore y position
    $subX        = $this->x;
    $subY        = $this->y;
    $this->SetXY($subX,  $subY + $subOffset);

    // restore font size
    $this->SetFontSize($subFontSizeold);
  }
}

// Script SQL pour charger les données de ta tables.
//if(isset($_GET['id'])!=""){
//   $id_entreprise = $_GET['id'];
//}
if (isset($_GET['id']) != "") {
  $id_dem_part = $_GET['id'];
} else {

?>
  <script>
    alert('INCORRECT.');
    window.location.href = '<?= $demande_particulier['option1_link'] ?>';
  </script>
<?php

};

// outputs image directly into browser, as PNG stream
// QRcode::png('PHP QR Code :)');




$query = "SELECT * from demande_particulier where id_dem_part='$id_dem_part' ";
$q = $db->query($query);
while ($row = $q->fetch()) {
  $id_dem_part = $row['id_dem_part'];
  $ref_dem_part = $row['ref_dem_part'];
  $id_caisse = $row['id_caisse'];
  $id_ing = $row['id_ing'];
  $droit = $row['droit'];
  $statut = $row['statut'];
  $date_dem_part = $row['date_dem_part'];
  $id_perso = $row['id_perso'];


  $nom = 'N/A';



  $sql = "SELECT * from caisse where id_caisse = '$id_caisse'";

  $stmt = $db->prepare($sql);
  $stmt->execute();

  $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($tables as $table) {
    $caisse = $table['caisse'];
  }

  $sql = "SELECT * from mytable where id_ingenieur = '$id_ing'";

  $stmt = $db->prepare($sql);
  $stmt->execute();

  $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($tables as $table) {
    $nom_ing = $table['nom_ing'] . ' ' . $table['prenom_ing'];
    $matricule = $table['matricule'];
    $id_ingenieur = $table['id_ingenieur'];
    $tail_nom = strlen($nom_ing);
  }

  $sql = "SELECT * from personnel where id_personnel = '$id_perso'";

  $stmt = $db->prepare($sql);
  $stmt->execute();

  $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($tables as $table) {
    $nom = $table['nom'] . ' ' . $table['prenom'];
  }

  $sql = "SELECT YEAR('$date_dem_part') as total  ";
  $stmt = $db->prepare($sql);
  $stmt->execute();

  $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($tables as $table) {
    $annee = $table['total'];
  }
}
$date = dateToFrench($date_dem_part, "d F Y");
$tailles = strlen($date);

$tempDir = 'files/';

$codeContents = 'N° d\'attesation: ' . $ref_dem_part . "\n" . 'Nom de l’ingénieur: ' . $nom_ing . "\n" . 'Tableau de l’Ordre pour l’année: ' . $annee . "\n" . ' Matricule: ' . $matricule . "\n" . ' Fait à Yaoundé: ' . "\n" . dateToFrench($date_dem_part, "j F Y");

$fileName = 'qrcode_' . $id_ingenieur . '.png';

$pngAbsoluteFilePath = $tempDir . $fileName;
$urlRelativeFilePath = 'files/' . $fileName;

QRcode::png($codeContents, $pngAbsoluteFilePath);


// Create new object.
$pdf = new PDF('P', 'mm', 'A4');
$pdf->AliasNbPages();

$pdf->AddFont('CalistoMT', '', 'CALIST.php');
$pdf->AddFont('CalisMTBol', '', 'CALISTB.php');
$pdf->AddFont('CalistoMT-BoldItalic', '', 'CALISTBI.php');
$pdf->AddFont('CenturyGothic', '', '07558_CenturyGothic.php');
$pdf->AddFont('CenturyGothic-Bold', '', '07723_Cgothicb0.php');
$pdf->AddFont('CenturyGothic-Italic', '', '07557_CenturyGothicKursiv.php');
$pdf->AddFont('CenturyGothic-BoldItalic', '', '07724_CGOTHICBI.php');
$pdf->AddFont('Candara', '', 'Candara.php');
$pdf->AddFont('Candara-Italic', '', 'Candara_Italic (1).php');
$pdf->AddFont('Candara-BoldItalic', '', 'Candara_Bold_Italic.php');

$pdf->AddFont('Candara-Bold', '', 'Candara_Bold.php');


// Add new pages
$pdf->AddPage('P');

//set font to arial, bold, 14pt
$pdf->SetFont('CalisMTBol', '', 9);
//header
$pdf->Text(20, 10, iconv('UTF-8', 'windows-1252', 'République du Cameroun'));
$pdf->Image('logos.png', 85, 5, 60, 40);
$pdf->Text(155, 10, 'Republic of Cameroon');

$pdf->SetFont('CalistoMT', '', 7);
$pdf->Text(27, 13, 'Paix - Travail - Patrie');
$pdf->Text(158, 13, 'Peace - Work - Fatherland');

$pdf->SetFont('CenturyGothic-Bold', '', 16);
$pdf->Text(20, 25, 'Ordre National des');
$pdf->Text(12, 31, iconv('UTF-8', 'windows-1252', 'Ingénieurs de Génie Civil'));

$pdf->Text(150, 25, 'National Order of');
$pdf->Text(153, 31, 'Civil Engineers');


//set font to arial, bold, 14pt
$pdf->SetFont('CenturyGothic-Bold', '', 10);
$pdf->Line(20, 50, 190, 50);

$pdf->SetFont('Candara-Bold', '', 12);
$pdf->Text(130, 60, iconv('UTF-8', 'windows-1252', $ref_dem_part));

$pdf->SetFont('CenturyGothic-Bold', '', 28);
$pdf->Text(60, 85, 'A T T E S T A T I O N');


//$pdf->SetFont('Arial','B',18);
//$pdf->Text(70,100,iconv('UTF-8', 'windows-1252', 'Le Président de l’Ordre'));
//
//$pdf->SetFont('Arial','B',16);
//$pdf->Text(90,123,'atteste que');
//
//$pdf->SetFont('Arial','',16);
//$pdf->Text(55,133,iconv('UTF-8', 'windows-1252', 'l’Ingénieur'));
//$pdf->SetFont('Arial','B',16);
//$pdf->setFillColor(230,230,230);
////$pdf->Text(85,133,'xxx');
//$pdf -> SetXY(83,128.5);
//$pdf->Cell(0,6,iconv('UTF-8', 'windows-1252', $nom_ing),0,1,'L',1);
$pdf->SetFont('Candara-Bold', '', 18);
$pdf->Text(70, 105, iconv('UTF-8', 'windows-1252', 'Le Président de l’Ordre'));

$pdf->SetFont('Candara', '', 16);
$pdf->Text(90, 115, 'atteste que');

$pdf->SetFont('Candara', '', 16);
$pdf->Text(55, 125, iconv('UTF-8', 'windows-1252', 'l’Ingénieur'));
$pdf->SetFont('Candara-Bold', '', 16);
$pdf->setFillColor(230, 230, 230);
//$pdf->Text(85,133,'xxx');
$pdf->SetXY(83, 120.5);
$pdf->Cell(0, 6, iconv('UTF-8', 'windows-1252', $nom_ing), 0, 1, 'L', 1);



$pdf->SetFont('Candara', '', 16);
$pdf->Text(38, 133, iconv('UTF-8', 'windows-1252', 'est bien inscrit au Tableau de l’Ordre pour l’année ' . $annee));
$pdf->Text(69, 141, 'sous le matricule');
$pdf->SetFont('Candara-Bold', '', 16);
$pdf->SetXY(113, 136.5);
$pdf->Cell(30, 6, $matricule, 0, 1, 'L', 1);
//$pdf->Text(115,156,'XXXX');

$pdf->SetFont('Candara', '', 14);
$pdf->Text(56, 155, iconv('UTF-8', 'windows-1252', 'A ce titre, il est autorisé à exercer la profession '));
$pdf->Text(55, 162, iconv('UTF-8', 'windows-1252', 'd’Ingénieur de Génie Civil pour la période allant'));
$pdf->Text(60.5, 169, 'du 1    janvier ' . $annee . ' au 31 decembre ' . $annee);
$pdf->SetXY(68, 167);
$pdf->subWrite(5, 'er', '', 10, 10);
$pdf->Text(60.5, 176, iconv('UTF-8', 'windows-1252', 'et à faire prévaloir la présente attestation'));
//$pdf->SetFont('Arial','',14);
//$pdf->Text(40,155,iconv('UTF-8', 'windows-1252', 'à ce titre, il est autorisé à exercer la profession d’Ingénieur'));
//$pdf->Text(60,162,iconv('UTF-8', 'windows-1252', 'de Génie Civil pour la période allant'));
//$pdf->Text(55,169,'du 1er janvier '.$annee.' au 31 decembre '.$annee);
//$pdf->Text(45,176,iconv('UTF-8', 'windows-1252', 'et à faire prévaloir la présente attestation dans le cadre'));
$pdf->SetTextColor(0, 0, 0);
$pdf->Text(80, 184, iconv('UTF-8', 'windows-1252', 'pour'));
$pdf->SetTextColor(0, 112, 192);
$pdf->SetFont('Candara-Bold', '', 14);
$pdf->Text(93, 184, 'usage personnel.');

$pdf->SetTextColor(0, 0, 0);
$pdf->Text(28, 200, iconv('UTF-8', 'windows-1252', 'Fait à Yaoundé, le '));
$pdf->SetFont('Candara-Bold', '', 14);
$pdf->SetTextColor(0, 112, 192);
$pdf->Text(72, 200, iconv('UTF-8', 'windows-1252', dateToFrench($date_dem_part, "d F Y")));

$pdf->SetFont('Candara', '', 14);

$pdf->SetTextColor(0, 0, 0);
$pdf->Text(72 + ($tailles * 2.7), 200, ' pour servir et valoir ce que de droit.');

$pdf->Image('files/qrcode_' . $id_ingenieur . '.png', 38, 230, 25, 25);


$pdf->SetLineWidth(.5);
$pdf->Image('img/cachetOgnic2.png', 130, 228.5, 40, 35);
$pdf->Line(125, 231, 174, 231);
// $pdf->Image('img/cachet onigc.png', 115, 223, 50, 45);
$pdf->SetFont('Candara-Bold', '', 14);
$pdf->Text(125, 230, iconv('UTF-8', 'windows-1252', 'Le Président de l\'Ordre'));


//$pdf->SetFont('Arial','B',14);
//$pdf->Text(115,215,iconv('UTF-8', 'windows-1252', 'P. le Président de l\'Ordre,'));

//$pdf->SetFont('Arial','BU',14);
//$pdf->Text(120,220,iconv('UTF-8', 'windows-1252', 'Le Sécretaire Général'));


//$pdf->SetFont('Arial','I',10);
//$pdf->Text(20,265,iconv('UTF-8', 'windows-1252', 'NB : Seul l\'original du présent document est valable.'));
$pdf->SetFont('Candara', '', 10);
$pdf->Text(20, 259, iconv('UTF-8', 'windows-1252', 'Ce document est généré par     CLOSER.'));
// $pdf->SetX(50);
$pdf->SetXY(62.5, 256);
$pdf->subWrite(4, '(c)', '', 6, 5);
$pdf->Text(20, 264, iconv('UTF-8', 'windows-1252', 'Le QR-CODE atteste de son authenticité'));
$pdf->SetLineWidth(.1);
$pdf->Line(20, 270, 190, 270);

$pdf->SetFont('CenturyGothic-BoldItalic', '', 8);
$pdf->SetTextColor(54, 95, 145);
$str = 'Montée Elig Essono - Yaoundé -      20822-     (+237) 677.66.10.66 / 655.01.02.03 -   noceonigc@yahoo.fr -     www.onigc.cm';
$str = iconv('UTF-8', 'windows-1252', $str);
$pdf->Text(20, 275, $str);
$pdf->Image('img/enveloppe.png', 64, 272.5, 3, 3);
$pdf->Image('img/old-typical-phone.png', 78, 272.5, 3, 3);
$pdf->Image('img/mouse.png', 128, 272.5, 3, 3);
$pdf->Image('img/laptop.png', 162, 272.5, 3, 3);

$pdf->SetFont('CenturyGothic-Italic', '', 7);
$pdf->SetTextColor(0, 0, 0);
$str = 'Comptes  bancaires : BICEC Yaoundé – Vallée sous le N° 31615665001-03 / ECOBANK Yaoundé - Hippodrome sous le N° 01316146701-72';
$str = iconv('UTF-8', 'windows-1252', $str);
$pdf->Text(20, 280, $str);

//Cell(width , height , text , border , end line , [align] )

//Splitter
$pdf->Cell(10, 36, '', 0);

//set font to arial, bold, 14pt
$pdf->SetFont('Arial', 'B', 7);



$pdf->Output();

?>