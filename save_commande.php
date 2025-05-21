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
$date_valide = date('Y_m_d');
$heure = date("G_i_s");

$date_valide = (string) $date_valide;
$heure = (string) $heure;


$id_four = $_POST['id_four'];
//$id_medi=$_POST['id_medi'];
//$quantite=$_POST['quantite'];
//$prix=$_POST['prix'];
$ref_com = $_POST['ref_com'];
$date_c_com = $_POST['date_c_com'];
$date_l_com = $_POST['date_l_com'];
$date_r_com = $_POST['date_r_com'];
$obs = $_POST['obs'];
$mode_paie = $_POST['mode_paie'];

$ref_final = $ref_com . '_' . $date_valide . '_' . $heure;

if (isset($_POST['id_medi']) and  isset($_POST['quantite'])  and isset($_POST['date_exp']) and  isset($_POST['date_fab'])) {
    $id_medi = $_POST['id_medi'];
    $quantite = $_POST['quantite'];
    //    $id_num_lot=$_POST['id_num_lot'];
    $date_exp = $_POST['date_exp'];
    $date_fab = $_POST['date_fab'];
} else {
    $id_medi[0] = 0;
?>
    <script>
        alert('Erreur lors du chargement.');
        window.location.href = 'liste_commande.php?witness=-1';
    </script>
    <?php

}


// Échapper les valeurs postées pour éviter les injections SQL
$id_mat_values = array_map('intval', $_POST['id_medi']);
$id = count($_POST['id_medi']);
echo $id . '</br>';

foreach ($id_mat_values as $key => $value) {
    echo  $key . '=> ' . $value . '</br>';
}

if ($id_medi[0] != 0) {
    if ($id != 0) {

        for ($j = 0; $j < $id; $j++) {
            $to = 0;

            if ($id_medi[$j] != 0) {
                //               echo  $id_medi[$j].'</br>';
                //               echo  'qauntite: '.$quantite[$j].'</br>';
                $heurCom = date("G_i_s");
                $id_num = (string) $heurCom;
                $id_num_lot = $ref_com . '_' . $id_num . '_' . $j;


                $to = 0;
                $sql = "SELECT id_medi, qt_com FROM commande where ref_com='$ref_final' and id_medi='$id_medi[$j]' and id_num_lot='$id_num_lot' ";
                $stmt = $db->prepare($sql);
                $stmt->execute();

                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($tables as $table) {
                    $to += 1;
                    $quantite_init = $table['qt_com'];
                }
                echo $to;

                if ($to != 0) {

                    echo 'faux' . '</br>';
                    $qt_total = $quantite_init + $quantite[$j];

                    $query1 = "UPDATE commande SET qt_com=:qt_com where ref_com='$ref_final' and id_medi='$id_medi[$j]' and id_num_lot='$id_num_lot' ";

                    $sql = $db->prepare($query1);

                    // Bind parameters to statement
                    $sql->bindParam(':qt_com', $qt_total);
                    $sql->execute();
                } else {

                    if (empty($date_exp[$j])) {
                        $date_exp[$j] = date('Y-m-d');
                    }
                    if (empty($date_fab[$j])) {
                        $date_fab[$j] = date('Y-m-d');
                    }

                    // Conversion de la date au format "AAAA-MM"
                    $date_parts = explode('-', $date_exp[$j]);
                    $year = $date_parts[0];
                    $month = $date_parts[1];

                    // Récupération du jour actuel
                    $current_day = date('d');

                    // Détermination du jour à enregistrer en fonction de la logique spécifiée
                    $day_to_save = ($current_day > 1) ? '31' : '01';

                    // Formatage de la date pour l'enregistrement en base de données
                    $date_expString = $year . '-' . $month . '-' . $day_to_save;

                    // Convertir la date string en timestamp UNIX
                    $date_ok1 = strtotime($date_expString);

                    // Convertir le timestamp en une date au format spécifié
                    $date_exp[$j] = date("Y-m-d", $date_ok1);

                    // Conversion de la date au format "AAAA-MM"
                    $date_parts2 = explode('-', $date_fab[$j]);
                    $year2 = $date_parts2[0];
                    $month2 = $date_parts2[1];

                    // Récupération du jour actuel
                    $current_day2 = date('d');

                    // Détermination du jour à enregistrer en fonction de la logique spécifiée
                    $day_to_save2 = ($current_day2 > 1) ? '31' : '01';

                    // Formatage de la date pour l'enregistrement en base de données
                    $date_fabString = $year2 . '-' . $month2 . '-' . $day_to_save2;

                    // Convertir la date string en timestamp UNIX
                    $date_ok2 = strtotime($date_fabString);

                    // Convertir le timestamp en une date au format spécifié
                    $date_fab[$j] = date("Y-m-d", $date_ok2);






                    //                    // transform format date(Y-m) in date(Y-m-d)  - date_exp
                    //                    $date_str = $date_exp[$j];
                    //                    $date = new DateTime($date_str);
                    //                    $date_exp[$j]= $date->format("Y-m-d");
                    //                    // transform format date(Y-m) in date(Y-m-d)  - date_fab
                    //                    $date_str2 = $date_fab[$j];
                    //                    $date2 = new DateTime($date_str2);
                    //                    $date_fab[$j]= $date2->format("Y-m-d");

                    echo 'vrai' . '</br>';
                    //                    $date = strtotime($date_str);
                    //                    $date_exp[$j] = date("Y-m-d", $date_str);

                    $query = " INSERT INTO commande (id_four,ref_com,id_medi,qt_com,date_c_com,date_l_com,date_r_com,mode_paie,obs,id_num_lot,date_exp,date_fab)
                     VALUES (:id_four,:ref_com,:id_medi,:qt_com,:date_c_com,:date_l_com,:date_r_com,:mode_paie,:obs,:id_num_lot,:date_exp,:date_fab)";

                    $sql = $db->prepare($query);

                    // Bind parameters to statement
                    $sql->bindParam(':id_four', $id_four);
                    $sql->bindParam(':ref_com', $ref_final);
                    $sql->bindParam(':id_medi', $id_medi[$j]);
                    $sql->bindParam(':qt_com', $quantite[$j]);
                    $sql->bindParam(':date_c_com', $date_c_com);
                    $sql->bindParam(':date_l_com', $date_l_com);
                    $sql->bindParam(':date_r_com', $date_r_com);
                    $sql->bindParam(':mode_paie', $mode_paie);
                    $sql->bindParam(':obs', $obs);
                    $sql->bindParam('id_num_lot', $id_num_lot);
                    $sql->bindParam(':date_exp', $date_exp[$j]);
                    $sql->bindParam(':date_fab', $date_fab[$j]);
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

        if ($sql) {

    ?>
            <script>
                alert('Opération effectuée.');
                window.location.href = 'liste_commande.php?witness=1';
            </script>
        <?php

        } else {

        ?>
            <script>
                alert('Synthax Error!!!');
                window.location.href = 'liste_commande.php?witness=-1';
            </script>
    <?php


        }
    }
} else {

    ?>
    <script>
        alert(' Error');
        window.location.href = 'liste_commande.php?witness=-1';
    </script>
<?php

}











?>