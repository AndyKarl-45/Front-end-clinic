<?php
setlocale(LC_CTYPE, 'fr_FR');
require('fpdf/fpdf.php');
require('convertisseur.php');
try{
    $db = new PDO('mysql:host=localhost;dbname=c2164852c_clinic_syges;charset=utf8', 'root', '');

}catch(PDOException $e){
    die('Erreur: '.$e->getMessage());
}


$id_caisse=$_REQUEST['id_caisse'];
$service=$_REQUEST['services'];
$id_perso_session=$_REQUEST['id_perso'];
$moisletter = date('F');


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

if (!empty($id_caisse) and !empty($service)) {


    // inforamtion

    $table_services = ['id_type_consul', 'id_type_eco', 'id_type_exa', 'id_type_hosp','id_type_ope','id_type_ordo','id_type_radiologie','id_type_anes','id_autre_service']; // Remplacez par vos noms de services
    $date_service = ['date_reg_consul', 'date_reg_eco', 'date_reg_exa', 'date_reg_hosp','date_reg_ope','date_reg_ordo','date_reg_radiologie','date_reg_anes','date_reg_autre'];
    $type_services= ['type_consul', 'type_eco', 'type_exa', 'type_hosp','type_ope','id_type_ordo','type_radiologie','type_anes','autres_services'];
    $prix_t_services= ['prix_t_consul', 'prix_t_eco', 'prix_t_exa', 'prix_t_hosp','prix_t_ope','id_type_ordo','prix_t_radiologie','prix_t_anes','autres_services'];

    switch ($service) {
        case 'regler_consul';
            $id_type_service=$table_services[0];
            $i=0;
            break;
        case 'regler_examen';
            $id_type_service=$table_services[2];
            $i=2;
            break;
        case 'regler_hosp';
            $id_type_service=$table_services[3];
            $i=3;
            break;
        case 'regler_ordo';
            $id_type_service=$table_services[5];
            $prix_unit= 0;
            $i=5;
            break;
        case 'regler_ope';
            $id_type_service=$table_services[4];
            $i=4;
            break;
        case 'regler_anesthesie';
            $id_type_service=$table_services[7];
            $i=7;
            break;
        case 'regler_ecographie';
            $id_type_service=$table_services[1];
            $i=1;
            break;
        case 'regler_radiologie';
            $id_type_service=$table_services[6];
            $i=6;
            break;
        case 'regler_autre';
            $id_type_service=$table_services[8];
            $prix_unit= 0;
            $i=8;
            break;
    }

    $cpt=0;


//    Tes requetes

    $sql = "SELECT  Count($id_type_service) as qte, $date_service[$i] as date_service, $id_type_service as id_type  FROM $service WHERE id_caisse = '$id_caisse' and  payer+remise = somme  group by $date_service[$i] order by $date_service[$i] desc";


    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tables as $table) {

        $id_type = $table['id_type'];
        $id_medi= $table['id_type'];

        $id_medis[$id_medi]=$id_medi;

        $qte[$id_medi]= $table['qte'];

        $date_hist[$id_medi] = $table['date_service'];
        $date_c_com= date('Y-m-d');
        $date_r_com=$table['date_service'];


        if ($i != 5){
            $sql = "SELECT nom,  $prix_t_services[$i] as prix_unit from $type_services[$i] where $table_services[$i] = '$id_type' and open_close!=1";

            $stmt = $db->prepare($sql);
            $stmt->execute();

            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($tables as $table) {
                $nom_type[$id_medi] = $table['nom'];
                $prix_unit[$id_medi] = $table['prix_unit'];
            }


        }





        if (empty($id_fours)) {
            $nom_four = 'N/A';
        }
        $cpt++;
    }
    $id_go=19;

    // Nom et prenom de a responsable
    $sql = "SELECT * from personnel where id_personnel = '$id_perso_session'";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($tables as $table)
    {
        $nom_res=$table['nom'].' '.$table['prenom'];
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

// Create new object.
$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages();

// Add new pages
$pdf->AddPage();


//set font to arial, bold, 14pt
$pdf->SetFont('Arial','',10);
//header
$today = date("d/m/Y");
//$pdf->Text(140, 6, '"Ville", le '.$today);

$pdf->Image('img/entete.png', 45, 2, 120);


//$pdf->SetFont('Arial','B',14);
//$pdf->Text(60, 20, 'BON DE COMMANDE No "'.$ref_com.'"');

$pdf->SetFont('Arial','',12);
$pdf->Text(5, 40, 'Date d\' impression : '.date("d/m/Y", strtotime($today)));
$pdf->Text(5, 45, 'Mois en cours : '.$moisletter);
$pdf->Text(5, 50, 'Responsable : '.iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $nom_res));
//$pdf->Text(5, 50, 'destinataire):');

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

//$pdf->Cell(130 ,5,iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE','2'),0,0);

$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'',0,0);
$pdf->Cell(34 ,5,'',0,1);//end of line

$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'',0,0);
$pdf->Cell(34 ,5,'',0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//billing address
$pdf->Cell(100 ,5,'',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,'',0,1);

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,'',0,1);

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,'',0,1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(17 ,5,'REF.',1,0);
$pdf->Cell(80 ,5,'DESIGNATION',1,0);
$pdf->Cell(25 ,5,'P.U HT',1,0);
$pdf->Cell(15 ,5,'QTE',1,0);
$pdf->Cell(24 ,5,'TOTAL HT',1,0);
//$pdf->Cell(22 ,5,'TVA',1,0);
$pdf->Cell(30 ,5,'TOTAL TTC',1,1);//end of line


$pdf->SetFont('Arial','',11);

$pdf->Cell(17 ,200,'',1,0);
$pdf->Cell(80 ,200,'',1,0);
$pdf->Cell(25 ,200,'',1,0);
$pdf->Cell(15 ,200,'',1,0);
$pdf->Cell(24 ,200,'',1,0);
//$pdf->Cell(22 ,100,'',1,0);
$pdf->Cell(30 ,200,'',1,1);//end of line

// Contenu de ton bon

// Changer 50 par le nombre de produits, donc il faut mettre un compteur dans ta requete qui va compter le nombre de produits
$i=0;
$total_ttc =0;
$tva = 0;
foreach ($id_medis as $id_med){
    $pdf->Text(12, 70+$i, '#'.$id_med);
    $pdf->Text(28, 70+$i, $nom_type[$id_med]);
    $pdf->Text(108, 70+$i, $prix_unit[$id_med]);
    $pdf->Text(134, 70+$i, $qte[$id_med]);
    $total_ht = $prix_unit[$id_med]*$qte[$id_med];
    $pdf->Text(149, 70+$i, $total_ht);
    $tva = $total_ht*19.25/100;
    //$pdf->Text(149, 70+$i, $tva);
    $pdf->Text(173, 70+$i, $total_ht);
    $total_ttc += $total_ht;
    $i += 5;
    $total_ht =0;
    $tva = 0;
}


//summary
$pdf->Cell(20 ,5,'',0,0);
$pdf->Cell(45 ,5,'',0,0);
$pdf->Cell(25 ,5,'',0,0);
$pdf->Cell(20 ,5,'',0,0);
$pdf->Cell(25 ,5,'',0,0);
$pdf->Cell(26 ,5,'Net a payer',0,0, 'R');
//$nap = $prix - $ir ;
$pdf->Cell(30,5,$total_ttc,1,1);//end of line4


//$pdf->SetFont('Arial','',12);
//$pdf->Text(15, 200, iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE','Préparer par  : '));
//$pdf->Text(85, 200,iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', 'Vérifier par  : '));
//$pdf->Text(155, 200, iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE','Valider par  : '));


$pdf->Output();

?>
