<?php
include('php/dbconnect.php');
include('php/db.php');

// function dateToFrench($date, $format){
//     $english_days = array('Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday','Sunday');
//     $french_days = array('Lundi', 'Mardi', 'Mercredi', 'jeudi', 'Vendredi', 'Samedi', 'Dimanche');
//     $english_months = array('January', 'February', 'March','April','May', 'June','July','August', 'September','October', 'November', 'December');
//     $french_months = array('Janvier', 'Février', 'Mars','Avril','Mai', 'Juin','Juillet','Aout', 'Septembre','Octobre', 'Novembre', 'Décembre');
//     return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date))));
// }
// function rav($base){

//     try{
//     $db = new PDO('mysql:host=localhost;dbname=apfood_syges_paie;charset=utf8', 'apfood_syges_paie_root', '5f3V+O)l?}E}');

// }catch(PDOException $e){
//     die('Erreur: '.$e->getMessage());
// }

//     $result =0;
//     $query = "SELECT * FROM rav";
//     $q = $db->query($query);
//     while($row = $q->fetch())
//     {
//         $tranche_min = $row['tranche_min'];
//         $tranche_max = $row['tranche_max'];
//         $redevance = $row['redevance'];

//         if($tranche_min < $base && $base < $tranche_max)
//             $result = $redevance;
//     }
//     return $result;
// }

// function tdl($base){
//     try{
//     $db = new PDO('mysql:host=localhost;dbname=apfood_syges_paie;charset=utf8', 'apfood_syges_paie_root', '5f3V+O)l?}E}');

// }catch(PDOException $e){
//     die('Erreur: '.$e->getMessage());
// }

//     $result =0;
//     $query = "SELECT * FROM tdl";
//     $q = $db->query($query);
//     while($row = $q->fetch())
//     {
//         $tranche_min = $row['tranche_min'];
//         $tranche_max = $row['tranche_max'];
//         $taxe_com = $row['taxe_com'];

//         if($tranche_min < $base && $base < $tranche_max)
//             $result = $taxe_com;
//     }
//     return $result;
// }

$heure = date("G_i");
header("Content-type: application/vnd-ms-excel");
$filename = "etat_stock_alert_mag_".$heure.".xls";
header("Content-Disposition:attachment;filename = \"$filename\" ");

?>

<table class="table table-bordered"  border="1">
    <thead>
    <tr class="bg-primary">
        <th><p align="center" style="color: black"><?php echo iconv( 'UTF-8' ,'Windows-1252', 'Numéro de lot');?></p></th>
        <th><p align="center" style="color: black"><?php echo iconv( 'UTF-8' ,'Windows-1252', 'Médicaments');?></p></th>
        <th><p align="center" style="color: black"><?php echo iconv( 'UTF-8' ,'Windows-1252', 'quantités');?></p></th>
        <th><p align="center" style="color: black"><?php echo iconv( 'UTF-8' ,'Windows-1252', 'Catégorie');?></p></th>
        <th><p align="center" style="color: black"><?php echo iconv( 'UTF-8' ,'Windows-1252', 'Prix d\'achat total');?></p></th>
        <th><p align="center" style="color: black">Prix de vente total</p></th>
        <th><p align="center" style="color: black">Marge</p></th>
        <th><p align="center" style="color: black">Date de fabrique</p></th>
        <th><p align="center" style="color: black"><?php echo iconv( 'UTF-8' ,'Windows-1252', 'Date de péremption');?></p></th>

    </tr>
    </thead>
    <tbody>
    <?php

    $rsc1="N/A";
    $rsc2="N/A";
    $benefice=0;
    $solde_prix_v_t=0;
    $solde_prix_u_t=0;


    $query = "SELECT * from magasin where qt_com <= 5";
    $q = $db->query($query);
    while($row = $q->fetch())
    {
        $id_mag = $row['id_mag'];
        $id_medi = $row['id_medi'];
        $qt_com = $row['qt_com'];
        $id_num_lot=$row['id_num_lot'];
        $date_exp=$row['date_exp'];
        $date_fab=$row['date_fab'];



        $sql = "SELECT DISTINCT * from medicament where id_medi = '$id_medi'";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tables as $table) {
            $ref_medi = $table['ref_medi'];
            $nom_medi= $table['nom_medi'];
            //$prix= $table['prix_unitaire'];
            $prix_u_a = $table['prix_unitaire'];
            $prix_u_v = $table['prix_u_v'];
            $id_type_medi= $table['id_type_medi'];
            $prix= $table['prix_unitaire'];
            
            $solde_prix_v_t+=$qt_com*$prix_u_v;
            $solde_prix_u_t+=$qt_com*$prix_u_a;

            


            $sql = "SELECT DISTINCT * from type_medi where id_type_medi = '$id_type_medi'";

            $stmt = $db->prepare($sql);
            $stmt->execute();

            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($tables as $table) {
                $type_medi= $table['nom'];
            }
        }

        if(empty($id_type_medi)){
            $type_medi='N/A';
        }
        if(empty($id_medi)){
            $nom_medi='N/A';
        }

        ?>


        <tr align="center">
            <td>
                <?=$id_num_lot?>
            </td>
            <td >
                <?php echo iconv( 'UTF-8' ,'Windows-1252', $nom_medi);?>
            </td>
            <!--                                                            Base-->
            <td><?php echo number_format($qt_com) ?></td>
            <td><?php echo iconv( 'UTF-8' ,'Windows-1252', $type_medi);?> </td>
            <!--                                                            IRPP-->
            <td><?php echo number_format($prix_u_a*$qt_com)?></td>
            <td><?php echo number_format($prix_u_v*$qt_com)?></td>
            <td><?php echo number_format(($prix_u_v*$qt_com)-($qt_com*$prix_u_a))?></td>

            <td><?php if(empty($date_exp)){echo 'N/A';}else{echo $date_exp;}  ?></td>
            <td><?php if(empty($date_fab)){echo 'N/A';}else{echo $date_fab;} ?></td>

        </tr>
    <?php } ?>

    </tbody>
</table>



