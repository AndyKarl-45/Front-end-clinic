<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php");
//     include ('MailSender/mailsenderclass.php');
?>
<?php

echo $ref_com_outil=$_REQUEST['idr'];
echo $id_four=$_REQUEST['idf'];



//$sql="SELECT count(ref_com) as total FROM commande where ref_com='$ref_com'  and id_four='$id_four' ";
//$stmt = $db->prepare($sql);
//$stmt->execute();
//
//$tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
//foreach($tables as $table)
//{
//    $total=$table['total'];
//}


$etat=1;
$date_valide=date('Y-m-d');
$heure=date("G:i");
$query  = " UPDATE commande_outil  SET   etat=:etat, date_valide=:date_valide, heure=:heure
                                     WHERE  ref_com_outil='$ref_com_outil'  and id_four='$id_four' ";

$sql = $db->prepare($query);

// Bind parameters to statement
$sql->bindParam(':etat', $etat);
$sql->bindParam(':date_valide', $date_valide);
$sql->bindParam(':heure', $heure);
$sql->execute();



$sql="SELECT *  FROM commande_outil where ref_com_outil='$ref_com_outil'  and id_four='$id_four'and etat=1 ";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($tables as $table)
            {

                $qt=$table['qt_com_outil'];
                $prix=$table['prix_outil'];
                $date_c_com = $table['date_c_com'];
                $date_l_com = $table['date_l_com'];
                $date_r_com = $table['date_r_com'];
                $id_outil = $table['id_outil'];
                $id_num_lot_outil = $table['id_num_lot_outil'];
                $date_exp = $table['date_exp'];
                $date_fab = $table['date_fab'];
            
            $to=0;
                $sql="SELECT  qt_com_outil FROM magasin_outil where ref_com_outil='$ref_com_outil' and  id_num_lot_outil='$id_num_lot_outil' ";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($tables as $table)
            {
                $to++;
                $quantite=$table['qt_com_outil'];
            }
            


                //
            if($to!=0){
             $qt_total=$quantite+$qt;

                $query1 = "UPDATE magasin_outil SET qt_com_outil=:qt_com_outil where ref_com_outil='$ref_com_outil' and  id_num_lot_outil='$id_num_lot_outil'";

                $sql = $db->prepare($query1);

                // Bind parameters to statement
                $sql->bindParam(':qt_com_outil',$qt_total );
                $sql->execute();


                // $query = " INSERT INTO magasin_outil (id_four,ref_com_outil,id_outil,qt_com_outil,date_c_com,date_l_com,date_r_com,id_num_lot_outil,date_exp,date_fab,prix_outil)
                //      VALUES (:id_four,:ref_com_outil,:id_outil,:qt_com_outil,:date_c_com,:date_l_com,:date_r_com,:id_num_lot_outil,:date_exp,:date_fab,:prix_outil)";

                // $sql = $db->prepare($query);

                // // Bind parameters to statement
                // $sql->bindParam(':id_four', $id_four);
                // $sql->bindParam(':ref_com_outil', $ref_com_outil);
                // $sql->bindParam(':id_outil', $id_outil);
                // $sql->bindParam(':qt_com_outil', $qt);
                // $sql->bindParam(':date_c_com', $date_c_com);
                // $sql->bindParam(':date_l_com', $date_l_com);
                // $sql->bindParam(':date_r_com', $date_r_com);
                // $sql->bindParam(':id_num_lot_outil', $id_num_lot_outil);
                // $sql->bindParam(':date_exp', $date_exp);
                // $sql->bindParam(':date_fab', $date_fab);
                // $sql->bindParam(':prix_outil', $prix);
                // $sql->execute();


            }else{


                $query = " INSERT INTO magasin_outil (id_four,ref_com_outil,id_outil,qt_com_outil,date_c_com,date_l_com,date_r_com,id_num_lot_outil,date_exp,date_fab,prix_outil)
                     VALUES (:id_four,:ref_com_outil,:id_outil,:qt_com_outil,:date_c_com,:date_l_com,:date_r_com,:id_num_lot_outil,:date_exp,:date_fab,:prix_outil)";

                $sql = $db->prepare($query);

                // Bind parameters to statement
                $sql->bindParam(':id_four', $id_four);
                $sql->bindParam(':ref_com_outil', $ref_com_outil);
                $sql->bindParam(':id_outil', $id_outil);
                $sql->bindParam(':qt_com_outil', $qt);
                $sql->bindParam(':date_c_com', $date_c_com);
                $sql->bindParam(':date_l_com', $date_l_com);
                $sql->bindParam(':date_r_com', $date_r_com);
                $sql->bindParam(':id_num_lot_outil', $id_num_lot_outil);
                $sql->bindParam(':date_exp', $date_exp);
                $sql->bindParam(':date_fab', $date_fab);
                $sql->bindParam(':prix_outil', $prix);
                $sql->execute();



            }
        }
        




if($sql)
{
   ?>
    <script>
      //  alert('Demande valider.');
      window.location.href='liste_com_outil.php?witness=1';
    </script>
    <?php
}

else
{
    ?>
    <script>
        //alert('Demande n\'a pas été valider.');
        window.location.href='liste_com_outil.php?witness=-1';
    </script>
    <?php

}
?>
