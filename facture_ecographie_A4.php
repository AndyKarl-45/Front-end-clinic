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

$id_reg_eco=$_REQUEST['id_reg_eco'];

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

if (!empty($id_reg_eco)){
    $id_reg_eco = $_REQUEST['id_reg_eco'];
    $cpt=0;


//    Tes requetes

    $sql = "SELECT * from regler_ecographie where id_reg_eco = '$id_reg_eco'";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tables as $table) {
        $ref_reg_eco = $table['ref_reg_eco'];
        $id_patient=$table['id_patient'];
        $payer=$table['payer'];
        $remise=$table['remise'];
        $somme=$table['somme'];

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

        $sql = "SELECT * from ecographie_exa where ref_eco_exa= '$ref_reg_eco' and etat!=0 ";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tables as $table) {
            $id_eco_exa= $table['id_eco_exa'];
            $id_medis[$id_eco_exa]=$id_eco_exa;
            $id_patient[$id_eco_exa]= $table['id_patient'];
            $id_type_eco[$id_eco_exa]= $table['id_type_eco'];
            $amount[$id_eco_exa]= $table['amount'];
            $qte_eco_exa[$id_eco_exa]= $table['qte_eco_exa'];



            $sql = "SELECT DISTINCT * from patient where id_patient = '$id_patient[$id_eco_exa]'";

            $stmt = $db->prepare($sql);
            $stmt->execute();

            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($tables as $table) {
                $nom_patient[$id_eco_exa]= $table['nom_p'] . ' ' . $table['prenom_p'];
            }

            $sql = "SELECT DISTINCT * from type_eco where id_type_eco = '$id_type_eco[$id_eco_exa]'";

            $stmt = $db->prepare($sql);
            $stmt->execute();

            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($tables as $table) {
                $type_eco[$id_eco_exa]= $table['nom'] ;
            }

        }


        if(empty($id_type_eco)){
            $type_eco='N/A';
        }
        if(empty($ref_reg_eco)){
            $ref_reg_eco='N/A';
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

// Crée un nouvel objet PDF au format A4 en mode portrait
$pdf = new PDF('P', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$today = date("d-m-Y - h:i A");

// Ajuste les positions et tailles des éléments pour A4
$pdf->SetFont('Arial','B',16);
$pdf->Text(57, 20, 'CLINIQUE CATHOLIQUE SAINTE MARIE');
$pdf->SetFont('Arial','',12);
$pdf->Text(70, 26, 'SOA CENTRE');
$pdf->Text(88, 32, '+237 ');
$pdf->Line(10,36,200,36);
$pdf->SetFont('Arial','',12);
$pdf->Text(85,43, 'INVOICE / RECEIPT');
$pdf->SetFont('Arial','',12);
$pdf->Text(10, 50, 'Date');
$pdf->Text(55, 50, $today);
$pdf->Text(10, 56, 'Sales point');
$pdf->Text(55, 56, 'CLINIQUE CATHOLIQUE SAINTE MARIE');
$pdf->Text(10, 62, 'Session');
$session = date("G");
if(0 > $session && $session < 13){
    $session = "morning";
}elseif (12 > $session && $session < 18){
    $session = "afternoon";
}else{
    $session = "evening";
}
$pdf->Text(55, 62, $session);
$pdf->SetFont('Arial','B',12);
$pdf->Text(10, 68, 'Facture No: ');
$pdf->Text(55,68, $ref_reg_eco);
$pdf->SetFont('Arial','',12);
$pdf->Text(115, 50, 'Cashier');
$pdf->Text(160,50, ucfirst(strtolower($nom_caissier)) );
$pdf->Text(115, 56, 'Client');
$pdf->Text(160,56, ucfirst(strtolower($nom_patient)));
$pdf->Text(115, 62, 'Payment mode');
$pdf->Text(160,62, 'Cash');
$pdf->Text(115, 68, 'Nom Patient');
$pdf->Text(160,68, ucfirst(strtolower($nom_patient)) );
$pdf->SetFont('Arial','B',12);
$pdf->SetXY(10, 85);
$pdf->Cell(90 ,7,'DESIGNATION',1,0);
$pdf->Cell(20 ,7,'QTE',1,0);
$pdf->Cell(35 ,7,'P.U HT',1,0);
$pdf->Cell(40 ,7,'TOTAL HT',1,1);
$pdf->SetFont('Arial','',12);
$pdf->SetXY(10, 92);
$pdf->Cell(90,80,'',1,0); // hauteur réduite
$pdf->Cell(20 ,80,'',1,0); // hauteur réduite
$pdf->Cell(35 ,80,'',1,0); // hauteur réduite
$pdf->Cell(40 ,80,'',1,1); // hauteur réduite
$i=0;
$total_total_ht =0;
foreach ($id_medis as $id_med){
    $pdf->SetFont('Arial','',10);
    $pdf->Text(12, 97+$i, strtoupper($type_eco[$id_med]));
    $pdf->Text(102, 97+$i, '1');
    $pdf->Text(122, 97+$i, $amount[$id_med]);
    $pdf->Text(157, 97+$i, $amount[$id_med]);
    $pdf->line(10,99+$i,195,99+$i);
    $i += 6;
}
$pdf->SetFont('Arial','B',12);
$pdf->Text(10, 180, 'Amount owed');
$pdf->Text(170,180, $somme);
$pdf->line(10,181,195,181);
$pdf->Text(10, 185, 'Amount paid');
$pdf->Text(170,185, $payer);
$pdf->line(10,186,195,186);
$pdf->Text(10, 190, 'Remise');
$pdf->Text(170,190, $remise);
$pdf->line(10,191,195,191);
$pdf->Text(10, 195, 'Difference');
$pdf->Text(170,195, $somme-($payer+$remise));
$pdf->line(10,196,195,196);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190 ,55,int2str($somme),0,1,'C');
$pdf->SetXY(10, 180);
$pdf->SetFont('Arial','',12);
$pdf->Cell(190 ,50,'We wish a speedy recovery',0, 1,'C');
$pdf->SetXY(10, 186);
$pdf->Cell(190 ,50,'Drugs sold can not be returned not exchanged',0, 1,'C');
$pdf->SetXY(10, 225);
$pdf->Cell(90 ,10,iconv('UTF-8', 'windows-1252', 'Signature Caissière(ier)'),0, 0,'C');
$pdf->Cell(90 ,10,iconv('UTF-8', 'windows-1252', 'Signature Client'),0, 1,'C');
$pdf->Output();
?>
