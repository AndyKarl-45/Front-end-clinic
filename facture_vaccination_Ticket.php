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
$id_reg_vac=$_REQUEST['id_reg_vac'];

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

$id_vacs = [];

if (!empty($id_reg_vac)){
    $id_reg_vac = $_REQUEST['id_reg_vac'];
    $cpt=0;


//    Tes requetes

    $sql = "SELECT * from regler_vac where id_reg_vac = '$id_reg_vac'";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tables as $table) {
        $ref_reg_vac = $table['ref_reg_vac'];
        $id_patient=$table['id_patient'];
        $payer=$table['payer'];
        $remise=$table['remise'];
        $somme=$table['somme'];
        $id_caisse = $table['id_caisse'];
        $id_type_vaccin = $table['id_type_vaccin'];

        // Get drug's name
        $sql = "SELECT DISTINCT * from caisse where id_caisse = '$id_caisse'";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tables as $table) {
            $id_perso = $table['id_perso'];
        }

//            Get drug's name
        $sql = "SELECT DISTINCT * from personnel where id_personnel = '$id_perso'";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tables as $table) {
            $nom_caissier= $table['nom'] . ' ' . $table['prenom'];
        }
        // if(empty($id_perso_session)==""){
        //     $nom_caissier="N/A";
        // }
        if(empty($id_perso)){
            $nom_caissier="N/A";
        }

        $sql = "SELECT DISTINCT * from patient where id_patient = '$id_patient'";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tables as $table) {
            $nom_patient= $table['nom_p'] . ' ' . $table['prenom_p'];
        }

        // $sql = "SELECT DISTINCT * from type_ordo where id_type_ordo = '$id_type_ordo'";

        // $stmt = $db->prepare($sql);
        // $stmt->execute();

        // $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // foreach ($tables as $table) {
        //     $type_ordo= $table['nom'] ;
        // }

        $sql = "SELECT  * from vaccination where  ref_vac='$ref_reg_vac'";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tables as $row) {
            $id_vac= $row['id_vac'];
            $id_vacs[$id_vac]=$id_vac;
            $quantite[$id_vac]= 1;
            $ref_vac[$id_vac] = $ref_reg_vac;




            $sql = "SELECT DISTINCT * from type_vaccin where id_type_vaccin = '$id_type_vaccin'";

            $stmt = $db->prepare($sql);
            $stmt->execute();

            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($tables as $table) {

                $nom_vac[$id_vac] = $table['nom']; // [id_medi => nom]
                $prix_ht[$id_vac] = $table['prix_vaccin'];
                //$prix_ttc[$id_medi] = $table['prix_u_v'];
            }

            $cpt++;
        }


        if(empty($id_type_vaccin)){
            $type_vaccin='N/A';
        }
        if(empty($ref_reg_vac)){
            $ref_reg_vac='N/A';
        }

    }

//    Fin des requetes
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
$pdf->Text(30,25, $ref_reg_vac);
$pdf->SetFont('Arial','',8);
$pdf->Text(5, 30, iconv('UTF-8', 'windows-1252', 'Caissière'));
$pdf->Text(30,30, iconv('UTF-8', 'windows-1252',ucfirst(strtolower($nom_caissier))));
$pdf->Text(5, 35, 'mode de paiement');
$pdf->Text(30,35, 'Cash');
$pdf->Text(5, 40, 'Nom Patient');
$pdf->Text(30,40, iconv('UTF-8', 'windows-1252',ucfirst(strtolower($nom_patient))));
$pdf->SetFont('Arial','B',7);
$pdf->SetXY(5, 45);
$pdf->Cell(45 ,4,'DESIGNATION',1,0);
$pdf->Cell(7 ,4,'QTE',1,0);
$pdf->Cell(10 ,4,'  P.U',1,0);
$pdf->Cell(10 ,4,'TOTAL',1,1);

$i=0;
$total_total_ht =0;
$total =0;
//foreach ($id_medis as $id_med){
//    $pdf->SetFont('Arial','',7);
//    $pdf->Text(6, 52+$i, strtoupper($nom_medi[$id_med]));
//    $pdf->Text(52, 52+$i, $quantite[$id_med]);
//    $pdf->Text(58, 52+$i, $prix_ht[$id_med]);
//    $total_ht = $prix_ht[$id_med]*$quantite[$id_med];
//    $pdf->Text(68, 52+$i, $total_ht);
//    $pdf->line(5,53+$i,77,53+$i);
//    $i += 4;
//    $total+=$total_ht;
//}
$pos0=30;
$max_rows_first_page = 8; // Nombre maximal de lignes de médicaments sur la première page
$max_rows_other_pages = 23; // Nombre maximal de lignes sur les autres pages
$current_page_rows = 0; // Compteur pour les lignes courantes
// positon par défaut
$pos1 = 52;
$pos2 = 52;
$pos3 = 52;
$pos4 = 52;
$pos5 = 53;
$pos6 = 53;
$cout =count($id_vacs);

if(6 < $cout && $cout <= 10){
    $pos0 = ($cout*4)+6;
    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(5, 45);
    $pdf->Cell(45,$pos0,'',1,0);
    $pdf->Cell(7 ,$pos0,'',1,0);
    $pdf->Cell(10 ,$pos0,'',1,0);
    $pdf->Cell(10 ,$pos0,'',1,1);
}elseif($cout > 10){
    $pos0 = (10*4)+6;
    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(5, 45);
    $pdf->Cell(45,$pos0,'',1,0);
    $pdf->Cell(7 ,$pos0,'',1,0);
    $pdf->Cell(10 ,$pos0,'',1,0);
    $pdf->Cell(10 ,$pos0,'',1,1);
}else{
    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(5, 45);
    $pdf->Cell(45,$pos0,'',1,0);
    $pdf->Cell(7 ,$pos0,'',1,0);
    $pdf->Cell(10 ,$pos0,'',1,0);
    $pdf->Cell(10 ,$pos0,'',1,1);
}


// Début de l'affichage des médicaments
foreach ($id_vacs as $id_med) {
    // Répéter l'affichage 20 fois



    // Si on est sur la première page et que le tableau atteint la limite, ajouter une nouvelle page
    if ($current_page_rows >= $max_rows_first_page && $pdf->PageNo() == 1 ) {
        $pdf->AddPage();
        // Réinitialiser la limite pour les autres pages
        $pos0=30;
        $current_page_rows = 0;
        $max_rows_first_page = $max_rows_other_pages;
        $ret=$cout-10;

        // Réafficher les en-têtes du tableau
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->SetXY(5, 5);
        $pdf->Cell(45, 4, 'DESIGNATION', 1, 0);
        $pdf->Cell(7, 4, 'QTE', 1, 0);
        $pdf->Cell(10, 4, '  P.U', 1, 0);
        $pdf->Cell(10, 4, 'TOTAL', 1, 1);
//            $pdf->SetFont('Arial', '', 6);
//            $pdf->SetXY(5, 5);
//            $pdf->Cell(45, 30, '', 1, 0);
//            $pdf->Cell(7, 30, '', 1, 0);
//            $pdf->Cell(10, 30, '', 1, 0);
//            $pdf->Cell(10, 30, '', 1, 1);

        if(6 < $ret && $ret <= $max_rows_other_pages){
            $pos0 = ($ret*4)+6;
            $pdf->SetFont('Arial','',6);
            $pdf->SetXY(5, 5);
            $pdf->Cell(45,$pos0,'',1,0);
            $pdf->Cell(7 ,$pos0,'',1,0);
            $pdf->Cell(10 ,$pos0,'',1,0);
            $pdf->Cell(10 ,$pos0,'',1,1);
        }elseif($ret > $max_rows_other_pages){
            $pos0 = ($max_rows_other_pages*4)+6;
            $pdf->SetFont('Arial','',6);
            $pdf->SetXY(5, 5);
            $pdf->Cell(45,$pos0,'',1,0);
            $pdf->Cell(7 ,$pos0,'',1,0);
            $pdf->Cell(10 ,$pos0,'',1,0);
            $pdf->Cell(10 ,$pos0,'',1,1);
        }else{
            $pdf->SetFont('Arial','',6);
            $pdf->SetXY(5, 5);
            $pdf->Cell(45,$pos0,'',1,0);
            $pdf->Cell(7 ,$pos0,'',1,0);
            $pdf->Cell(10 ,$pos0,'',1,0);
            $pdf->Cell(10 ,$pos0,'',1,1);
        }



        // Réinitialiser la position d'impression
        $i = 0;
        //position d'affichage des médicaments
        $pos1 = 12;
        $pos2 = 12;
        $pos3 = 12;
        $pos4 = 12;
        $pos5 = 13;
        $pos6 = 13;
    }

    // Affichage des médicaments
    $pdf->SetFont('Arial', '', 7);
    $pdf->Text(6, $pos1 + $i, strtoupper($nom_vac[$id_med]));
    $pdf->Text(52, $pos2 + $i, $quantite[$id_med]);
    $pdf->Text(58, $pos3 + $i, $prix_ht[$id_med]);

    $total_ht = $prix_ht[$id_med] * $quantite[$id_med];
    $pdf->Text(68, $pos4 + $i, $total_ht);
    $pdf->line(5, $pos5 + $i, 77, $pos6 + $i);

    // Incrémenter la position pour chaque ligne
    $i += 4;
    $total += $total_ht;

    // Incrémenter le compteur de lignes
    $current_page_rows++;



    // Si on atteint la limite de lignes pour cette page, ajouter une nouvelle page
    if ($current_page_rows >= $max_rows_other_pages) {
        $pdf->AddPage();
        $current_page_rows = 0;
        $pos0=30;
        $ret-=$max_rows_other_pages;
        // Réafficher les en-têtes du tableau sur la nouvelle page
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->SetXY(5, 5);
        $pdf->Cell(45, 4, 'DESIGNATION', 1, 0);
        $pdf->Cell(7, 4, 'QTE', 1, 0);
        $pdf->Cell(10, 4, '  P.U', 1, 0);
        $pdf->Cell(10, 4, 'TOTAL', 1, 1);
//            $pdf->SetFont('Arial', '', 6);
//            $pdf->SetXY(5, 5);
//            $pdf->Cell(45, 30, '', 1, 0);
//            $pdf->Cell(7, 30, '', 1, 0);
//            $pdf->Cell(10, 30, '', 1, 0);
//            $pdf->Cell(10, 30, '', 1, 1);

        if(6 < $ret && $ret <= $max_rows_other_pages){
            $pos0 = ($ret*4)+6;
            $pdf->SetFont('Arial','',6);
            $pdf->SetXY(5, 5);
            $pdf->Cell(45,$pos0,'',1,0);
            $pdf->Cell(7 ,$pos0,'',1,0);
            $pdf->Cell(10 ,$pos0,'',1,0);
            $pdf->Cell(10 ,$pos0,'',1,1);
        }elseif($ret > $max_rows_other_pages){
            $pos0 = ($max_rows_other_pages*4)+6;
            $pdf->SetFont('Arial','',6);
            $pdf->SetXY(5, 5);
            $pdf->Cell(45,$pos0,'',1,0);
            $pdf->Cell(7 ,$pos0,'',1,0);
            $pdf->Cell(10 ,$pos0,'',1,0);
            $pdf->Cell(10 ,$pos0,'',1,1);
        }else{
            $pdf->SetFont('Arial','',6);
            $pdf->SetXY(5, 5);
            $pdf->Cell(45,$pos0,'',1,0);
            $pdf->Cell(7 ,$pos0,'',1,0);
            $pdf->Cell(10 ,$pos0,'',1,0);
            $pdf->Cell(10 ,$pos0,'',1,1);
        }


        $i = 0; // Réinitialiser la position d'impression pour la nouvelle page
    }

}


// Après avoir terminé l'affichage des médicaments
$somme = $total;

// Calcul de la position courante (la valeur de $i correspond à la hauteur atteinte par le tableau)
// Ajout d'une vérification pour savoir s'il y a assez d'espace pour afficher les montants
$min_space_for_totals = 20; // Espace minimum requis pour afficher les montants

// Si la position du tableau dépasse la limite d'espace pour les montants
if ($i + $min_space_for_totals > 80) {
    // Ajouter une nouvelle page si l'espace est insuffisant
    $pdf->AddPage();

    // Réinitialiser la position de départ
    $i = 10; // Commencer un peu plus bas pour laisser de la place pour les marges
}

// Affichage des montants
$pdf->SetFont('Arial', 'B', 7);
$pdf->Text(5, 80, iconv('UTF-8', 'windows-1252', 'Montant à payer'));
$pdf->Text(67, 80, $somme);
$pdf->line(5, 81, 77, 81);

$pdf->Text(5, 86, 'Montant payer');
$pdf->Text(67, 86, $payer);
$pdf->line(5, 87, 77, 87);

$pdf->Text(5, 92, iconv('UTF-8', 'windows-1252', 'Reste à payer'));
$pdf->Text(67, 92, $somme - $payer);
$pdf->line(5, 93, 77, 93);

$pdf->Text(5, 98, 'Remboursement');
$pdf->Text(67, 98, $somme - ($payer + $remise));
$pdf->line(5, 99, 77, 99);

$pdf->SetFont('Arial', 'B', 8);
$pdf->SetXY(10, 105);
$pdf->Cell(65, -2, iconv('UTF-8', 'windows-1252', 'Bonne guérison !'), 0, 1, 'C');

$pdf->Output();

?>
