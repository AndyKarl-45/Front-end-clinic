<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php");
?>
<?php
// Assurez-vous d'avoir une connexion à votre base de données ici

if (isset($_POST['id_patient'])) {
    $id_patient = $_POST['id_patient'];

    // Requête SQL pour récupérer le montant de la caution en fonction de l'ID du patient
    $sql = "SELECT montant from caution where id_patient = 'id_patient' ";

    $stmt = $db->prepare($sql);
    $stmt->execute();


    // Vérifiez si des résultats ont été trouvés
    if ( $row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
        $montant_caution = $row['montant'];
        echo $montant_caution;
    } else {
        echo "0"; // Aucun montant de caution trouvé
    }
}
?>
