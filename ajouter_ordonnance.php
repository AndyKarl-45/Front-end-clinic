<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php");
?>
<?php


$id_patient=$_POST['id_patient'];
$id_medecin=$_POST['id_medecin'];
$id_pharmacien=$_POST['id_pharmacien'];
$id_nurse=$_POST['id_nurse'];
$ref_ordos=$_REQUEST['ref_ordos'];
echo $ref_ordos;
$id_agent=$_POST['id_agent'];
$date_ordo=date('Y-m-d');
$id_depart=1;

$year = (new DateTime())->format("Y");
$month = (new DateTime())->format("m");
$day = (new DateTime())->format("d");

if( $id_medecin !=0 and $id_pharmacien ==0 and $id_nurse ==0  ){
    $id_agent=$id_medecin;
    $agent='M';
}elseif ($id_medecin ==0 and $id_pharmacien !=0 and $id_nurse ==0  ){
    $id_agent=$id_pharmacien;
    $agent='p';
}else{
    $id_agent=$id_nurse;
    $agent='I';
}






if( isset($_POST['qte']) and  isset($_POST['id_medis']) ){
    // $id_medi=$_POST['id_medi'];
    $quantite=$_POST['qte'];
    $posologie=$_POST['poso'];
    $traitement=$_POST['traite'];
    $id_medi=$_POST['id_medis'];
    $id_num_lot='N/A';


}else{
//     echo 'fooog';
//   $id_medi[0]=0;

    ?>
    <script>
        alert('L\'ordonnance ne contient aucune prescritpion !');
        window.location.href='<?=$ordonnance['option2_link']?>?witness=-1';
    </script>
    <?php
}


// V2rifie le stock de la pharmacie
$query  = "SELECT * from pharmacie where id_medi='$id_medi'";
$q = $conn->query($query);
while($row = $q->fetch_assoc())
{
    $medoc_phar = $row["quantite"];
    $id_medicament = $row['id_medi'];
    $id_num_lot = $row['id_num_lot'];
}

if($ref_ordos=='andy'){
    $affiche=0;
    echo 'gogoogo';
    //création de l'ordonnance
    $query = " INSERT INTO ordonnance (id_patient,id_medecin,id_depart,date_ordo,id_pharmacien,id_nurse,affiche)
                                 VALUES (:id_patient,:id_medecin,:id_depart,:date_ordo,:id_pharmacien,:id_nurse,:affiche)";

    $sql = $db->prepare($query);

// Bind parameters to statement
// $sql->bindParam(':ref_medi', $ref_medi);
    $sql->bindParam(':id_patient', $id_patient);
    $sql->bindParam(':id_medecin', $id_medecin);
    $sql->bindParam(':id_depart', $id_depart);
    $sql->bindParam(':date_ordo', $date_ordo);
    $sql->bindParam(':id_pharmacien', $id_pharmacien);
    $sql->bindParam(':id_nurse', $id_nurse);
    $sql->bindParam(':affiche', $affiche);
    $sql->execute();


    //prix
    $query  = "SELECT prix_u_v from medicament where id_medi='$id_medi' ";
    $q = $conn->query($query);
    while($row = $q->fetch_assoc())
    {
        $amount = $row["prix_u_v"];
    }

    // création du médicament
    $total_apt=0;
    $query  = "SELECT Max(id_ordo) as total from ordonnance";
    $q = $conn->query($query);
    while($row = $q->fetch_assoc())
    {
        $total_apt = $row["total"];
    }
    $id_app = $total_apt;
    $ref_medi= 'ORDO_'.$year.'_'.$month.'_'.$id_patient.'_'.$id_app;
    $id_ordo = $id_app;

    //ref de l'ordo
    $query1 = " UPDATE ordonnance SET  ref_ordo=:ref_ordo    
                        WHERE id_ordo= '$id_ordo' ";
    $sql1 = $db->prepare($query1);

// Bind parameters to statement
    $sql1->bindParam(':ref_ordo', $ref_medi);
    $sql1->execute();

    $ref_reg_ordo="N/A";


    $query = " INSERT INTO regler_ordo (ref_reg_ordo,ref_ordo,id_patient,id_medecin,somme,date_reg_ordo,id_ordo,id_pharmacien) 
                     VALUES (:ref_reg_ordo,:ref_medi,:id_patient,:id_medecin,:total_somme,:date_ordo,:id_ordo,:id_pharmacien)";

    $sql = $db->prepare($query);

    // Bind parameters to statement

    $sql->bindParam(':ref_reg_ordo', $ref_reg_ordo);
    $sql->bindParam(':ref_medi', $ref_medi);
    $sql->bindParam(':id_patient', $id_patient);
    $sql->bindParam(':id_medecin', $id_medecin);
    $sql->bindParam(':total_somme', $total_somme);
    $sql->bindParam(':date_ordo', $date_ordo);
    $sql->bindParam(':id_ordo', $id_ordo);
    $sql->bindParam(':id_pharmacien', $id_pharmacien);
    $sql->execute();

}else{

    // création du médicament
    $total_apt=0;
    $query  = "SELECT Max(id_ordo) as total from ordonnance";
    $q = $conn->query($query);
    while($row = $q->fetch_assoc())
    {
        $total_apt = $row["total"];
    }
    $id_app = $total_apt;
    $id_ordo = $id_app;


    $ref_medi=$ref_ordos;

    //prix
    $query  = "SELECT prix_u_v from medicament where id_medi='$id_medi' ";
    $q = $conn->query($query);
    while($row = $q->fetch_assoc())
    {
        $amount = $row["prix_u_v"];
    }

//    // création du médicament
//    $total_apt=0;
//    $query  = "SELECT Max(id_ordo) as total from ordonnance";
//    $q = $conn->query($query);
//    while($row = $q->fetch_assoc())
//    {
//        $total_apt = $row["total"];
//    }
//    $id_app = $total_apt;
//    $id_ordo = $id_app;
}


$query = " INSERT INTO medicament_ordo (ref_medi_ordo,id_medi,id_num_lot,id_patient,id_medecin,id_depart,quantite_medi_ordo,date_medi_os_ordo,id_ordo,id_pharmacien,id_nurse,posologie,traitement,amount) 
                     VALUES (:ref_medi,:id_medi,:id_num_lot,:id_patient,:id_medecin,:id_depart,:quantite_medi_ordo,:date_medi_os,:id_ordo,:id_pharmacien,:id_nurse,:posologie,:traitement,:amount)";

$sql = $db->prepare($query);

// Bind parameters to statement

$sql->bindParam(':ref_medi', $ref_medi);
$sql->bindParam(':id_medi', $id_medicament);
$sql->bindParam(':id_num_lot', $id_num_lot);
$sql->bindParam(':id_patient', $id_patient);
$sql->bindParam(':id_medecin', $id_medecin);
$sql->bindParam(':id_depart', $id_depart);
$sql->bindParam(':quantite_medi_ordo', $quantite);
$sql->bindParam(':date_medi_os', $date_ordo);
$sql->bindParam(':id_ordo', $id_ordo);
$sql->bindParam(':id_pharmacien', $id_pharmacien);
$sql->bindParam(':id_nurse', $id_nurse);
$sql->bindParam(':posologie', $posologie);
$sql->bindParam(':traitement', $traitement);
$sql->bindParam(':amount', $amount);
$sql->execute();







if($sql)
{
    // $mailler = new mailsenderclass();

    // $subject = "Demande de d'equipement";
    // $body = "Demande d'equipement effectuee par "
    //         .strtoupper($nom_user)." le "
    //         .date("d/m/Y"). " à "
    //         .date("G:i")." pour la salle "
    //         .strtoupper($nom_salle)
    //         ."<br/>
    //          <a href='campresjonlline.net'>Voir les details</a>";

    // $from= 'supergoal@campresjonlline.net';
    // $from_name='CAMPREJ EQUIEPEMENT';
    // $sql = $db->query("select * from users where secteur = $id_secteur_user and (lvl = 4 or lvl = 3 or lvl = 8 or lvl = 7)");
    // while($row = $sql->fetch()){
    //     $to = $row['email'];
    //     $mailler->mailsenderclass($to, $from, $from_name, $subject, $body);
    // }
    // $mailler->mailsenderclass($email_user, $from, $from_name, $subject, $body);






    ?>
    <script>
        // alert('Ordonnance effectuée.');
window.location.href='nouvelle_ordonnance_review.php?ref_ordo=<?=$ref_medi?>&id_patient=<?=$id_patient?>&id_agent=<?=$id_agent?>&agent=<?=$agent?>&witness=1';
    </script>
    <?php

}

else
{

    ?>
    <script>
        alert('Erreur lors du chargement.');
        window.location.href='nouvelle_ordonnance_review.php?ref_ordo=<?=$ref_medi?>&id_patient=<?$id_patient?>&id_agent=<?=$id_agent?>&agent=<?=$agent?>&witness=-1';
    </script>
    <?php

}
?>
