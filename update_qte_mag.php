<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php");
//     include ('MailSender/mailsenderclass.php');
?>
<?php

$id_num_lot=$_POST['id_num_lot'];
$id_num_lot_new=$_POST['id_num_lot_new'];
$ref_com=$_POST['ref_com'];
$id_medi=$_POST['id_medi'];
$id_perso_session=$_POST['id_perso_session'];
$qt_com=$_POST['qt_com'];
$date_exp=$_POST['date_fab'];
$date_fab=$_POST['date_exp'];


$etat=1;
$date_valide=date('Y-m-d');
$heure=date("G:i");
$query  = " UPDATE magasin  SET   qt_com=:qt_com, date_c_com=:date_valide, date_fab=:date_fab, date_exp=:date_exp, id_num_lot=:id_num_lot
                                     WHERE  id_num_lot='$id_num_lot'  and id_medi='$id_medi' ";

$sql = $db->prepare($query);

// Bind parameters to statement
$sql->bindParam(':qt_com', $qt_com);
$sql->bindParam(':date_valide', $date_valide);
$sql->bindParam(':date_fab', $date_fab);
$sql->bindParam(':date_exp', $date_exp);
$sql->bindParam(':id_num_lot', $id_num_lot_new);
$sql->execute();

$query  = " UPDATE pharmacie  SET   id_num_lot=:id_num_lot
                                     WHERE  id_num_lot='$id_num_lot'  and id_medi='$id_medi' ";

$sql = $db->prepare($query);

// Bind parameters to statement
$sql->bindParam(':id_num_lot', $id_num_lot_new);
$sql->execute();


$query  = " UPDATE commande  SET   id_num_lot=:id_num_lot
                                     WHERE  id_num_lot='$id_num_lot'  and id_medi='$id_medi' ";

$sql = $db->prepare($query);

// Bind parameters to statement
$sql->bindParam(':id_num_lot', $id_num_lot_new);
$sql->execute();



if($sql)
{
    ?>
    <script>
        //  alert('Demande valider.');
        window.location.href='liste_mag_centrale.php?witness=1';
    </script>
    <?php
}

else
{
    ?>
    <script>
        //alert('Demande n\'a pas été valider.');
        window.location.href='liste_mag_centrale.php?witness=-1';
    </script>
    <?php

}
?>
