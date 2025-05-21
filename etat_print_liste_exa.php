
<?php
setlocale(LC_CTYPE, 'fr_FR');
require('fpdf/fpdf.php');
try{
    $db = new PDO('mysql:host=localhost;dbname=c2164852c_clinic_syges;charset=utf8', 'root', '');

}catch(PDOException $e){
    die('Erreur: '.$e->getMessage());
}


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


echo $ref_exa=$_REQUEST['ref_exa'];

if (!empty($ref_exa)) {

    //    Tes requetes
    $date_c_com=date('Y-m-d');
    
    $id_medis = [];
    
    $cpt=0;
    
     $query = "SELECT * from examen_exa where ref_exam_exa='$ref_exa'";
                                    
        $q = $db->query($query);
        while ($row = $q->fetch()) {
          $id_exa= $table['id_exa'];
          $id_medis[$id_exa]=$id_exa;
          $date_exam[$id_exa]= $row['date_exam'];
          $id_type_exa[$id_exa]= $row['id_type_exa'];
          $ref_exam_exa[$id_exa] = $row['ref_exam_exa'];
          $id_patient[$id_exa] = $row['id_patient'];
          $id_medecin[$id_exa] = $row['id_medecin'];
           $id_lab[$id_exa] = $row['id_lab'];
          $date_exam[$id_exa] = $row['date_exam'];
          $id_type_exa[$id_exa] = $row['id_type_exa'];
          $qt_exam_exa[$id_exa] = $row['qt_exam_exa'];
          $etat[$id_exa] = $row['etat'];
        
        $sql = "SELECT DISTINCT * from type_exa where id_type_exa = '$id_type_exa[$id_exa]'";
    
        $stmt = $db->prepare($sql);
        $stmt->execute(); 
    
        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($tables as $table) {
            $nom_type_exa[$id_exa] = $table['nom'];
            $prix_t_exa[$id_exa]= $table['prix_t_exa'];
    
            // $sql = "SELECT DISTINCT * from type_medi where id_type_medi = '$id_type_medi'";
    
            // $stmt = $db->prepare($sql);
            // $stmt->execute();
    
            // $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // foreach ($tables as $table) {
            //     $type_medi[$id_medi] = $table['nom'];
            // }
        }
    
    
        $sql = "SELECT DISTINCT * from patient where id_patient = '$id_patient[$id_exa]'";
    
        $stmt = $db->prepare($sql);
        $stmt->execute();
    
        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($tables as $table) {
            $nom_patient= $table['nom_p'];
            $prenom_patient=$table['prenom_p'];
            $ref_patient = $table['ref_patient'];
            $age= $table['age_p'];
        }
    
    
    
        $sql = "SELECT DISTINCT * from medecin where id_medecin = '$id_medecin[$id_exa]'";
    
        $stmt = $db->prepare($sql);
        $stmt->execute();
    
        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($tables as $table) {
            $nom_medecin= $table['nom_m'] . ' ' . $table['prenom_m'];
    
        }
        
        $sql = "SELECT DISTINCT * from laboratin  where id_laboratin = '$id_lab[$id_exa]'";
    
        $stmt = $db->prepare($sql);
        $stmt->execute();
    
        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($tables as $table) {
            $nom_lab= $table['nom_l'] . ' ' . $table['prenom_l'];
    
        }
    
        if(empty($id_patient[$id_exa])){
                $nom_patient='N/A';
            }
            
        if(empty($id_type_exa[$id_exa])){
                $nom_type_exa='N/A';
            }
        
        if(empty($id_medecin[$id_exa])){
            $nom_medecin='N/A';
        }
        
        if(empty($id_lab[$id_exa])){
            $nom_lab='N/A';
        }
    
    }
}



//    Fin des requetes

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
$pdf->Text(140, 6, '"Ville", le '.$today);

$pdf->Image('img/logo.jpeg', 23, 5, 20);


$pdf->SetFont('Arial','B',14);
$pdf->Text(60, 20, 'LISTES DES EXAMENS   ');

$pdf->SetFont('Arial','',12);
//$pdf->Text(5, 40, 'Date : '.date("d/m/Y", strtotime($date_c_com)));
$pdf->Text(5, 40, 'Nom du patient : '.iconv( 'UTF-8' ,'Windows-1252', ucwords(strtolower($nom_patient))));
$pdf->Text(5, 48, 'Prenom du patient : '.iconv( 'UTF-8' ,'Windows-1252', ucwords(strtolower($prenom_patient))));
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
$pdf->Cell(150 ,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(12 ,5,'REF.',1,0);
$pdf->Cell(62 ,5,'TYPE D\'EXAMENS ',1,0);
$pdf->Cell(45 ,5,'PRIX',1,0);
$pdf->Cell(13 ,5,'QTE ',1,0);
$pdf->Cell(45 ,5,'DATE D\'EXAMENS',1,0);

$pdf->Cell(21,5,'TOTAL',1,1);//end of line


$pdf->SetFont('Arial','',11);

$pdf->Cell(12 ,100,'',1,0);
$pdf->Cell(62 ,100,'',1,0);
$pdf->Cell(45 ,100,'',1,0);
$pdf->Cell(13 ,100,'',1,0);
$pdf->Cell(45 ,100,'',1,0);
$pdf->Cell(21 ,100,'',1,1);//end of line

// Contenu de ton bon

// Changer 50 par le nombre de produits, donc il faut mettre un compteur dans ta requete qui va compter le nombre de produits
$i=0;
$total_ttc =0;

foreach ($id_medis as $id_med){
    $pdf->Text(12, 70+$i, '#'.$id_med);
    $pdf->Text(27, 70+$i, $nom_type_exa[$id_med]);
    $pdf->Text(88, 70+$i, $prix_t_exa[$id_med] );
    $pdf->Text(130, 70+$i, $qt_exam_exa[$id_med]);
    $total_ht = $prix_ht[$id_med]*$qt_exam_exa[$id_med];
    $pdf->Text(143, 70+$i, $date_exam[$id_med]);
    $tva = $total_ht*19.25/100;
    $pdf->Text(189, 70+$i, $total_ht);
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
$pdf->Cell(40 ,5,'Net a payer',0,0, 'R');
//$nap = $prix - $ir ;
$pdf->Cell(21,5,$total_ttc,1,1);//end of line4


$pdf->SetFont('Arial','',12);
$pdf->Text(15, 200, iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE','PrEparer par  : '));
$pdf->Text(85, 200,iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', 'Verifier par  : '));
$pdf->Text(155, 200, iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE','Valider par  : '));


//
//$pdf->Cell(42 ,10,'Avance',0,0);
//$pdf->Cell(42 ,10,'29',0,1);
//
//$pdf->Cell(42 ,10,'Reste',0,0);
//$pdf->Cell(42 ,10,'30',0,1);
//
//$pdf->Cell(42 ,10,iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE','Date d\'échéance'),0,0);
//$pdf->Cell(42 ,10,'31',0,1);//end of line
//
////make a dummy empty cell as a vertical spacer
//$pdf->Cell(189 ,20,'',0,1);//end of line
//
////define a new font style
//$pdf->SetFont('Arial', '', 8);
//$pdf->Cell(80 ,5,'Site web : www.syges.cm',0,0, 'R');
//$pdf->Cell(40 ,5,'Email : support@syges.cm',0,1, 'R');
//$pdf->Cell(125 ,5,'',0,1, 'R');
//$pdf->Cell(80 ,5,'32',0,0, 'R');
//$pdf->Cell(40 ,5,'33',0,1, 'R');

$pdf->Output();

?>
