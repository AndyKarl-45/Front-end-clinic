<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php");
?>
<?php

$ref_ordo = $_POST['ref_ordo'];
$link = 'liste_ordonnance_suite.php';
$date_ordo = date('Y-m-d');

$year = (new DateTime())->format("Y");
$month = (new DateTime())->format("m");
$day = (new DateTime())->format("d");


if (isset($_POST['prixboss'])) {
    $prix_vente = $_POST['prixboss'];
} else {
?>
    <script>
        alert('Erreur lors du chargement.');
        window.location.href = '<?= $link ?>?witness=-1';
    </script>
<?php
}


$id = count($prix_vente);
$total_somme = 0;
for ($i = 0; $i < $id; $i++) {
    $entier = intval($prix_vente[$i]);
    $total_somme += $entier;
};

$affiche = 1;

//ref de l'ordo
$query1 = " UPDATE ordonnance SET  affiche=:affiche   
                        WHERE ref_ordo= '$ref_ordo' ";
$sql1 = $db->prepare($query1);

// Bind parameters to statement
$sql1->bindParam(':affiche', $affiche);
$sql1->execute();

//ref de l'ordo
$query1 = " UPDATE regler_ordo SET  somme=:somme   
                        WHERE ref_ordo= '$ref_ordo' ";
$sql1 = $db->prepare($query1);

// Bind parameters to statement
$sql1->bindParam(':somme', $total_somme);
$sql1->execute();



if ($sql1) {
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
        window.location.href = '<?= $link ?>?witness=1';
    </script>
<?php

} else {

?>
    <script>
        alert('Erreur lors du chargement.');
        window.location.href = '<?= $link ?>?witness=-1';
    </script>
<?php

}







?>