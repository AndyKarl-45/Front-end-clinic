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

$id_reg_exa=$_REQUEST['id_reg_exa'];

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

if (!empty($id_reg_exa)){
    $id_reg_exa = $_REQUEST['id_reg_exa'];
    $cpt=0;


//    Tes requetes

    $sql = "SELECT * from regler_examen where id_reg_exa = '$id_reg_exa'";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tables as $table) {
        $ref_reg_exa = $table['ref_reg_exa'];
        $payer=$table['payer'];
        $remise=$table['remise'];
        $somme=$table['somme'];
        $id_patiented=$table['id_patient'];

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

        $sql = "SELECT DISTINCT * from patient where id_patient = '$id_patiented'";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tables as $table) {
            $nom_patiented= $table['nom_p'] . ' ' . $table['prenom_p'];
        }



        $sql = "SELECT * from examen_exa where ref_exam_exa = '$ref_reg_exa' and etat!=0 ";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tables as $table) {
            $id_exam_exa= $table['id_exam_exa'];
            $id_medis[$id_exam_exa]=$id_exam_exa;
            $id_patient[$id_exam_exa]= $table['id_patient'];
            $id_type_exa[$id_exam_exa]= $table['id_type_exa'];
            $amount[$id_exam_exa]= $table['amount'];
            $qte_exam_exa[$id_exam_exa]= $table['qte_exam_exa'];



            $sql = "SELECT DISTINCT * from patient where id_patient = '$id_patient[$id_exam_exa]'";

            $stmt = $db->prepare($sql);
            $stmt->execute();

            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($tables as $table) {
                $nom_patient[$id_exam_exa]= $table['nom_p'] . ' ' . $table['prenom_p'];
            }

            $sql = "SELECT DISTINCT * from type_exa where id_type_exa = '$id_type_exa[$id_exam_exa]'";

            $stmt = $db->prepare($sql);
            $stmt->execute();

            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($tables as $table) {
                $type_exa[$id_exam_exa]= $table['nom'] ;
            }
        }


        if(empty($id_type_exa)){
            $type_exa='N/A';
        }
        if(empty($ref_reg_exa)){
            $ref_reg_exa='N/A';
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

// Crée un nouvel objet PDF au format A6
$pdf = new PDF('P', 'mm', array(200, 140));
$pdf->AliasNbPages();
$pdf->AddPage();
$today = date("d-m-Y - h:i A");

// Ajuste les positions et tailles des éléments pour A6
$pdf->SetFont('Arial','B',10);
$pdf->Text(57, 10, 'CLINIQUE CATHOLIQUE SAINTE MARIE');
$pdf->SetFont('Arial','',8);
$pdf->Text(50, 16, 'SOA CENTRE');
$pdf->Text(70, 22, '+237 ');
$pdf->Line(5,24,135,24);
$pdf->SetFont('Arial','',8);
$pdf->Text(55,30, 'INVOICE / RECEIPT');
$pdf->SetFont('Arial','',8);
$pdf->Text(10, 35, 'Date');
$pdf->Text(55, 35, $today);
$pdf->Text(10, 40, 'Sales point');
$pdf->Text(55, 40, 'CLINIQUE CATHOLIQUE SAINTE MARIE');
$pdf->Text(10, 45, 'Session');
$session = date("G");
if(0 > $session && $session < 13){
    $session = "morning";
}elseif (12 > $session && $session < 18){
    $session = "afternoon";
}else{
    $session = "evening";
}
$pdf->Text(55, 45, $session);
$pdf->SetFont('Arial','B',8);
$pdf->Text(10, 50, 'Facture No: ');
$pdf->Text(55,50, $ref_reg_exa);
$pdf->SetFont('Arial','',8);
$pdf->Text(10, 55, 'Cashier');
$pdf->Text(55,55, ucfirst(strtolower($nom_caissier)) );
$pdf->Text(10, 60, 'Client');
$pdf->Text(55,60, ucfirst(strtolower($nom_patiented)));
$pdf->Text(10, 65, 'Payment mode');
$pdf->Text(55,65, 'Cash');
$pdf->Text(10, 70, 'Nom Patient');
$pdf->Text(55,70, ucfirst(strtolower($nom_patiented)) );
$pdf->SetFont('Arial','B',8);
$pdf->SetXY(10, 75);
$pdf->Cell(55 ,5,'DESIGNATION',1,0);
$pdf->Cell(10 ,5,'QTE',1,0);
$pdf->Cell(20 ,5,'P.U HT',1,0);
$pdf->Cell(20 ,5,'TOTAL HT',1,1);
$pdf->SetFont('Arial','',8);
$pdf->SetXY(10, 80);
$pdf->Cell(55,50,'',1,0); // hauteur réduite
$pdf->Cell(10 ,50,'',1,0); // hauteur réduite
$pdf->Cell(20 ,50,'',1,0); // hauteur réduite
$pdf->Cell(20 ,50,'',1,1); // hauteur réduite
$i=0;
$total_total_ht =0;
foreach ($id_medis as $id_med){
    $pdf->SetFont('Arial','',6);
    $pdf->Text(11, 85+$i, strtoupper($type_exa[$id_med]));
    $pdf->Text(66, 85+$i, '1');
    $pdf->Text(76, 85+$i, $amount[$id_med]);
    $pdf->Text(96, 85+$i, $amount[$id_med]);
    $pdf->line(10,87+$i,110,87+$i);
    $i += 4;
}
$pdf->SetFont('Arial','B',8);
$pdf->Text(10, 135, 'Amount owed');
$pdf->Text(70,135, $somme);
$pdf->line(10,136,100,136);
$pdf->Text(10, 140, 'Amount paid');
$pdf->Text(70,140, $payer);
$pdf->line(10,141,100,141);
$pdf->Text(10, 145, 'Remise');
$pdf->Text(70,145, $remise);
$pdf->line(10,146,100,146);
$pdf->Text(10, 150, 'Difference');
$pdf->Text(70,150, $somme-($payer+$remise));
$pdf->line(10,151,100,151);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(100 ,5,int2str($somme),0,1,'C');
$pdf->line(5,155,135,155);
$pdf->SetFont('Arial','',8);
$pdf->Cell(100 ,5,'We wish a speedy recovery',0, 1,'C');
$pdf->line(5,160,135,160);
$pdf->Cell(100 ,5,'Drugs sold can not be returned not exchanged',0, 1,'C');
$pdf->SetXY(10, 165);
$pdf->Cell(60 ,10,iconv('UTF-8', 'windows-1252', 'Signature Caissière(ier)'),0, 0,'C');
$pdf->Cell(60 ,10,iconv('UTF-8', 'windows-1252', 'Signature Client'),0, 1,'C');
$pdf->Output();
?>
