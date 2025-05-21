<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php");
?>
<?php



//echo $id_salles;
//$cout=$_POST['cout'];
// $date_debut=$_POST['date_debut'];
$cpt=0;
$id_ask_outil=$_REQUEST['id_ask_outil'];
//$id_ask_mat=$_REQUEST['id_ask_mat'];




//--------------------------code pour email ------------------------------//
// $result="";
//       require "PHPMailer/PHPMailerAutoload.php";

//              $to ='mboningdany@gmail.com';
//              $from= 'supergoal@campresjonlline.net';
//              $from_name='CAMPREJ EQUIEPEMENT';
//              $subject='OBJET TEST';


//            $mail = new PHPMailer();
//            $mail->IsSMTP();
//            $mail->SMTPAuth = true;

//            $mail->SMTPSecure = 'ssl';
//            $mail->Host = 'mail.campresjonlline.net';
//            $mail->Port= '465';
//            $mail->Username = 'supergoal@campresjonlline.net';
//            $mail->Password = 'Y@)W@LPSDLaP';

//            $mail->IsHTML(true);
//            $mail->From="supergoal@campresjonlline.net";
//            $mail->FromName=$from_name;
//            $mail->Sender=$from;
//            $mail->AddReplyTo($from, $from_name);
//            $mail->Subject = $subject;
//            $mail->Body = '<h1 align=center>Name: ' .$from_name. '<br>Email: ' .$from. '<br>Message: ' .$subject. '</h1>';
//            $mail->AddAddress($to);
//            if(!$mail->Send())
//                {
//                    $result= "Please try later";
//                        // echo $result;
//                 }else{
//                   $result="Thanks you!!";
//                          // echo $result;
//                }

//-----------------------------------------------------------------------//




$t=0;
$sql="SELECT * FROM demande_materiel_outil where  id_ask_outil='$id_ask_outil'  ";
$stmt = $db->prepare($sql);
$stmt->execute();

$tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($tables as $table)
{
    $id_outil=$table['id_outil'];
    $id_num_lot_outil=$table['id_num_lot_outil'];
    $date_debut_mat=$table['date_debut_mat'];
    $id_perso = $table['id_perso'];
    $id_nurse = $table['id_nurse'];
    $id_med = $table['id_med'];
    $id_chi = $table['id_chi'];
    $id_lab = $table['id_lab'];
    $quantite_ask=$table['quantite'];
    // echo $id_materiel.'</br>';


    $sql = "SELECT * FROM magasin_outil where id_outil='$id_outil' and id_num_lot_outil LIKE '$id_num_lot_outil' ";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tables as $table) {
        $quantite_mat = $table['qt_com_outil'];
        $prix_unitaire = $table['prix_outil'];
        $date_exp = $table['date_exp'];
        $date_fab = $table['date_fab'];
    }

    echo $quantite_reste=$quantite_mat-$quantite_ask;
    $prix_total_f=$quantite_reste*$prix_unitaire;


    if($quantite_reste>=0){
        $query1  = " UPDATE magasin_outil  SET    qt_com_outil=:quantite WHERE id_outil = '$id_outil' and id_num_lot_outil LIKE '$id_num_lot_outil' ";



        $sql1 = $db->prepare($query1);

        // Bind parameters to statement
        $sql1->bindParam(':quantite', $quantite_reste);
        $sql1->execute();




        $statut=1;
        $query1  = " UPDATE demande_materiel_outil  SET   etat_dst=:statut    
                                     WHERE id_ask_outil='$id_ask_outil' ";



        $sql1 = $db->prepare($query1);

        // Bind parameters to statement
        $sql1->bindParam(':statut', $statut);
        $sql1->execute();

        $etat=1;
        $date_valide=date('Y-m-d');
        $heure=date("G:i");
        $query  = " UPDATE demande_outil  SET   etat_dst=:etat, date_valide=:date_valide, heure=:heure    
                                     WHERE id_ask_outil='$id_ask_outil' ";



        $sql = $db->prepare($query);

        // Bind parameters to statement
        $sql->bindParam(':etat', $etat);
        $sql->bindParam(':date_valide', $date_valide);
        $sql->bindParam(':heure', $heure);
        $sql->execute();

        if($quantite_reste==0){
            $query = "DELETE FROM magasin_outil WHERE id_outil='$id_outil' and id_num_lot_outil LIKE '$id_num_lot_outil'' ";
            $sql = $conn->query($query);
        }


    }else{

//                $query1  = " UPDATE materiel  SET    mag=:mag  WHERE id_materiel = '$id_materiel' ";
//
//
//
//                $sql1 = $db->prepare($query1);
//
//                // Bind parameters to statement
//                $sql1->bindParam(':mag', $receveur);
//                $sql1->execute();
        $etat=-1;
        $query  = " UPDATE demande_materiel_outil  SET   etat_dst=:etat WHERE  id_ask_outil='$id_ask_outil'";

        $sql = $db->prepare($query);

        // Bind parameters to statement
        $sql->bindParam(':etat', $etat);
        $sql->execute();
        $cpt++;

    }

}

if($cpt!=0){
    ?>
    <script>
        alert('Stock Insuffisant au Magasin');
        window.location.href='liste_demande_traitement_outil.php?witness=-1';
    </script>
    <?php
}

if($sql)
{//                                                $mailler = new mailsenderclass();
//
//                                                $subject = "Validation de demande de d'equipement";
//                                                $body = "Demande d'equipement effectuee le "
//                                                    .date("d/m/Y",strtotime($date_valide))
//                                                    ." pour la salle "
//                                                    .strtoupper($nom_salle)
//                                                    ." a ete valide par "
//                                                    .strtoupper($nom_user)
//                                                    ."<br/>
//                                                          <a href='campresjonlline.net'>Voir les details</a>";
//
//                                                $from= 'supergoal@campresjonlline.net';
//                                                $from_name='CAMPREJ EQUIEPEMENT';
//                                                $sql = $db->query("select * from users where secteur = $id_secteur_user and lvl = 5 ");
//                                                while($row = $sql->fetch()){
//                                                    $to = $row['email'];
//                                                    $mailler->mailsenderclass($to, $from, $from_name, $subject, $body);
//                                                }


    ?>
    <script>
        alert('Equipement Récue.');
        window.location.href='liste_demande_traitement_outil.php?witness=1';
    </script>
    <?php
}else
{
    ?>
    <script>
        alert('Error.');
        window.location.href='liste_demande_traitement_outil.php?witness=-1';
    </script>
    <?php

}






?>
