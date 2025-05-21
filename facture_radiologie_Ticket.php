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

$id_reg_radiologie=$_REQUEST['id_reg_radiologie'];

function dateDifference($start_date, $end_date)
{
    // calulating the difference in timestamps
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

    // 1 day = 24 hours
    // 24 * 60 * 60 = 86400 seconds
    return ceil(abs($diff / 86400));
}

$id_medis = [];

if (!empty($id_reg_radiologie)){
    $id_reg_radiologie = $_REQUEST['id_reg_radiologie'];
    $cpt=0;


//    Tes requetes

    $sql = "SELECT * from regler_radiologie where id_reg_radiologie = '$id_reg_radiologie'";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tables as $table) {
        $ref_reg_radiologie = $table['ref_reg_radiologie'];
        $id_patient=$table['id_patient'];
        $payer=$table['payer'];
        $remise=$table['remise'];
        $somme=$table['somme'];
        $id_type_radiologie=$table['id_type_radiologie'];

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
        if(empty($id_perso)==""){
            $nom_caissier="N/A";
        }

        $sql = "SELECT DISTINCT * from patient where id_patient = '$id_patient'";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tables as $table) {
            $nom_patient= $table['nom_p'] . ' ' . $table['prenom_p'];
        }



        $sql = "SELECT  * from radiologie_exa where  ref_radiologie_exa='$ref_reg_radiologie' and etat!='0' ";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tables as $row) {
            $id_medi= $row['id_radiologie_exa'];
            $id_medis[$id_medi]=$id_medi;
            $id_type_radiologie= $row['id_type_radiologie'];

            $sql = "SELECT DISTINCT * from type_radiologie where id_type_radiologie = '$id_type_radiologie'";

            $stmt = $db->prepare($sql);
            $stmt->execute();

            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($tables as $table) {
                $nom_medi[$id_medi]= $table['nom'] ;
                $prix_ht[$id_medi] = $table['prix_t_radiologie'];
            }


            $cpt++;
        }



        if(empty($id_type_radiologie)){
            $type_radiologie='N/A';
        }
        if(empty($ref_reg_radiologie)){
            $ref_reg_radiologie='N/A';
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
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Crée un nouvel objet PDF au format ticket de caisse
$pdf = new PDF('P', 'mm', array(200, 80));
$pdf->AliasNbPages();
$pdf->AddPage();
$today = date("d-m-Y - h:i A");
// Ajuste les positions et tailles des éléments pour le ticket de caisse
$pdf->SetFont('Arial','B',10);
$pdf->Text(25, 10, 'HOPE SERVICES');
$pdf->SetFont('Arial','',8);
$pdf->Text(15, 16, 'MONTE LIDO/CARREFOUR PAKITA');
$pdf->Text(30, 22, '+237 222 22 03 94');
$pdf->Line(5,24,75,24);
$pdf->SetFont('Arial','',8);
$pdf->Text(25,30, 'INVOICE / RECEIPT');
$pdf->SetFont('Arial','',8);
$pdf->Text(5, 35, 'Date');
$pdf->Text(30, 35, $today);
$pdf->Text(5, 40, 'Sales point');
$pdf->Text(30, 40, 'HOPE SERVICE');
$pdf->Text(5, 45, 'Session');
$session = date("G");
if(0 > $session && $session < 13){
    $session = "morning";
}elseif (12 > $session && $session < 18){
    $session = "afternoon";
}else{
    $session = "evening";
}
$pdf->Text(30, 45, $session);
$pdf->SetFont('Arial','B',8);
$pdf->Text(5, 50, 'Facture No: ');
$pdf->Text(30,50, $ref_reg_radiologie);
$pdf->SetFont('Arial','',8);
$pdf->Text(5, 55, 'Cashier');
$pdf->Text(30,55, ucfirst(strtolower($nom_caissier)) );
$pdf->Text(5, 60, 'Payment mode');
$pdf->Text(30,60, 'Cash');
$pdf->Text(5, 65, 'Nom Patient');
$pdf->Text(30,65, ucfirst(strtolower($nom_patient)) );
$pdf->SetFont('Arial','B',8);
$pdf->SetXY(1, 70);
$pdf->Cell(40 ,5,'DESIGNATION',1,0);
$pdf->Cell(10 ,5,'QTE',1,0);
$pdf->Cell(15 ,5,'P.U',1,0);
$pdf->Cell(13 ,5,'TOTAL',1,1);
$pdf->SetFont('Arial','',8);
$pdf->SetXY(1, 75);
$pdf->Cell(40,50,'',1,0); // hauteur réduite
$pdf->Cell(10 ,50,'',1,0); // hauteur réduite
$pdf->Cell(15 ,50,'',1,0); // hauteur réduite
$pdf->Cell(13 ,50,'',1,1); // hauteur réduite
$i=0;
$total_total_ht =0;
foreach ($id_medis as $id_med){
    $pdf->SetFont('Arial','',6);
    $pdf->Text(2, 78+$i, strtoupper($nom_medi[$id_med]));
    $pdf->Text(45, 78+$i,'1');
    $pdf->Text(53, 78+$i, $prix_ht[$id_med]);
    $pdf->Text(68, 78+$i, $prix_ht[$id_med]);
    $pdf->line(1,79+$i,79,79+$i);
    $i += 4;
}
$pdf->SetFont('Arial','B',8);
$pdf->Text(5, 130, 'Amount owed');
$pdf->Text(65,130, $somme);
$pdf->line(5,131,75,131);
$pdf->Text(5, 135, 'Amount paid');
$pdf->Text(65,135, $payer);
$pdf->line(5,136,75,136);
$pdf->Text(5, 140, 'Remise');
$pdf->Text(65,140, $remise);
$pdf->line(5,141,75,141);
$pdf->Text(5, 145, 'Difference');
$pdf->Text(65,145, $somme-($payer+$remise));
$pdf->line(5,146,75,146);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(65 ,50,int2str($somme),0,1,'C');
$pdf->Cell(65 ,-40,'We wish a speedy recovery',0, 1,'C');
$pdf->SetXY(5, 155);
$pdf->Cell(70 ,10,'Drugs sold can not be returned not exchanged',0, 1,'C');
$pdf->SetXY(5, 165);
$pdf->Cell(37 ,10,iconv('UTF-8', 'windows-1252', 'Signature Caissière(ier)'),0, 0,'C');
$pdf->Cell(37 ,10,iconv('UTF-8', 'windows-1252', 'Signature Client'),0, 1,'C');
$pdf->Output();
?>