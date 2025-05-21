<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php");
?>
<?php

//$id_session = $_SESSION['rainbo_id_perso'];
//$user = $_SESSION['rainbo_name'];
//$email_user = $_SESSION['rainbo_email'];
//$nom_user = "";
//$query = "SELECT * from personnel where id_personnel = $id_session";
//$q = $db->query($query);
//while($row = $q->fetch()) {
//    $nom_session = $row['prenom'] .' '.$row['nom'];
//    $email_user_session = $row['email'];
//}
$date_valide=date('Y_m_d');
$heure=date("G_i_s");

$date_valide=(string) $date_valide;
$heure= (string) $heure;


$id_four=$_POST['id_four'];
//$id_medi=$_POST['id_medi'];
//$quantite=$_POST['quantite'];
//$prix=$_POST['prix'];
$ref_com_outil=$_POST['ref_com_outil'];
$date_c_com=$_POST['date_c_com'];
$date_l_com=$_POST['date_l_com'];
$date_r_com=$_POST['date_r_com'];
$obs=$_POST['obs'];
$mode_paie=$_POST['mode_paie'];
$id_four=$_POST['id_four'];

$ref_final=$ref_com_outil.'_'.$date_valide.'_'.$heure;

if(isset($_POST['id_outil']) and  isset($_POST['quantite']) and isset($_POST['id_num_lot_outil']) and isset($_POST['date_exp']) and  isset($_POST['date_fab'])){
    $id_outil=$_POST['id_outil'];
    $quantite=$_POST['quantite'];
    $id_num_lot_outil=$_POST['id_num_lot_outil'];
    $date_exp=$_POST['date_exp'];
    $date_fab=$_POST['date_fab'];
}else{
    $id_outil[0]=0;
    ?>
    <script>
        alert('Erreur lors du chargement.');
        window.location.href='liste_commande.php?witness=-1';
    </script>
    <?php

}


$id = count($id_outil);
   echo $id.'</br>';
   
//   foreach ($id_outil as $key => $value) {
//                     echo  $key.'=> '.$value.'</br>';
//                 }

if($id_outil[0]!=0 ){
    if($id!=0) {

        for ($j = 0; $j < $id; $j++) {
            $to=0;
            $prix_u_v=0;
            
            $sql = "SELECT prix_u_v FROM outil where  id_outil='$id_outil[$j]' ";
                $stmt = $db->prepare($sql);
                $stmt->execute();

                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($tables as $table) {
                    $prix_u_v = $table['prix_u_v'];
                }

            if ($id_outil[$j] != 0) {
               echo  $id_outil[$j].'</br>';
               echo  'qauntite: '.$quantite[$j].'</br>';
               echo  'lot: '.$id_num_lot_outil[$j].'</br>';
                 $quantite[$j];


                $sql = "SELECT count(id_outil) as total, qt_com_outil FROM commande_outil where ref_outil='$ref_final' and id_outil='$id_outil[$j]' and id_num_outil='$id_num_lot_outil[$j]' ";
                $stmt = $db->prepare($sql);
                $stmt->execute();

                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($tables as $table) {
                    $to = $table['total'];
                    $quantite_init = $table['qt_com_outil'];
                }
                echo $to;

                if ($to != 0) {
                    
                    echo 'faux'.'</br>';
                    $qt_total = $quantite_init + $quantite[$j];

                    $query1 = "UPDATE commande_outil SET qt_com_outil=:qt_com_outil where ref_com_outil='$ref_final' and id_outil='$id_outil[$j]' and id_num_lot_outil='$id_num_lot_outil[$j]' ";

                    $sql = $db->prepare($query1);

                    // Bind parameters to statement
                    $sql->bindParam(':qt_com_outil', $qt_total);
                    $sql->execute();


                } else {
                    
                    echo'vrai'.'</br>';

                    $query = " INSERT INTO commande_outil (id_four,ref_com_outil,id_outil,qt_com_outil,date_c_com,date_l_com,date_r_com,mode_paie,obs,id_num_lot_outil,date_exp,date_fab,prix_outil) 
                     VALUES (:id_four,:ref_com_outil,:id_outil,:qt_com_outil,:date_c_com,:date_l_com,:date_r_com,:mode_paie,:obs,:id_num_lot_outil,:date_exp,:date_fab,:prix_outil)";

                    $sql = $db->prepare($query);

                    // Bind parameters to statement
                    $sql->bindParam(':id_four', $id_four);
                    $sql->bindParam(':ref_com_outil', $ref_final);
                    $sql->bindParam(':id_outil', $id_outil[$j]);
                    $sql->bindParam(':qt_com_outil', $quantite[$j]);
                    $sql->bindParam(':date_c_com', $date_c_com);
                    $sql->bindParam(':date_l_com', $date_l_com);
                    $sql->bindParam(':date_r_com', $date_r_com);
                    $sql->bindParam(':mode_paie', $mode_paie);
                    $sql->bindParam(':obs', $obs);
                    $sql->bindParam('id_num_lot_outil', $id_num_lot_outil[$j]);
                    $sql->bindParam(':date_exp', $date_exp[$j]);
                    $sql->bindParam(':date_fab', $date_fab[$j]);
                    $sql->bindParam(':prix_outil', $prix_u_v);
                    $sql->execute();
                }
            }

//            $sql="SELECT count(id_medi) as total, qt_com FROM magasin where id_medi='$id_medi[$j]' ";
//            $stmt = $db->prepare($sql);
//            $stmt->execute();
//
//            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
//            foreach($tables as $table)
//            {
//                $to=$table['total'];
//                $qt=$table['qt_com'];
//            }
//            $total=$to;
//
//            if($total==0){
//                $query = " INSERT INTO magasin (id_four,ref_com,id_medi,qt_com,prix_ht,date_c_com,date_l_com,date_r_com)
//                     VALUES (:id_four,:ref_com,:id_medi,:qt_com,:prix_ht,:date_c_com,:date_l_com,:date_r_com)";
//
//                $sql = $db->prepare($query);
//
//                // Bind parameters to statement
//                $sql->bindParam(':id_four', $id_four);
//                $sql->bindParam(':ref_com', $ref_com);
//                $sql->bindParam(':id_medi', $id_medi[$j]);
//                $sql->bindParam(':qt_com', $quantite[$j]);
//                $sql->bindParam(':prix_ht', $prix[$j]);
//                $sql->bindParam(':date_c_com', $date_c_com);
//                $sql->bindParam(':date_l_com', $date_l_com);
//                $sql->bindParam(':date_r_com', $date_r_com);
//                $sql->execute();
//            }else{
//                $qt_total=$quantite[$j]+$qt;
//
//                $query1 = "UPDATE magasin SET qt_com=:qt_com where id_medi = '$id_medi[$j]' and id_four='$id_four' and  ref_com = '$ref_com' ";
//
//                $sql = $db->prepare($query);
//
//                // Bind parameters to statement
//                $sql->bindParam(':qt_com',$qt_total );
//                $sql->execute();
//            }






            }

        if($sql)
        {

            ?>
            <script>
                alert('Opération effectuée.');
                window.location.href = '<?=$commande_outil['option2_link']?>?witness=1';
            </script>
            <?php

        }else{

            ?>
            <script>
                alert('Synthax Error!!!');
                window.location.href = '<?=$commande_outil['option2_link']?>?witness=-1';
            </script>
            <?php


        }

        }
    }else{

    ?>
    <script>
        alert(' Error');
         window.location.href = '<?=$commande_outil['option2_link']?>?witness=-1';
    </script>
    <?php

}











?>
