<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {

    $id_patient = $_POST['id_patient'];
    $id_perso = $_POST['id_perso'];
    $date_caution = date('Y-m-d');
    $montant = $_POST['montant'];


    $year = (new DateTime())->format("Y");
    $month = (new DateTime())->format("m");
    $day = (new DateTime())->format("d");

    //check if patient exist in the table
    $total_patient = 0;
    $query  = "SELECT id_caution as total from caution where id_patient='$id_patient'";
    $q = $conn->query($query);
    while ($row = $q->fetch_assoc()) {
        $total_patient = $row["total"];
    }

    //
    // id de la caution
    $total_apt = 0;
    $query  = "SELECT Max(id_caution) as total from caution";
    $q = $conn->query($query);
    while ($row = $q->fetch_assoc()) {
        $total_apt = $row["total"];
    }
    $id_app = $total_apt + 1;
    $ref_caution = 'CAU_' . $year . '_' . $month . '_' . $id_patient . '_' . $id_app;


    //--------------------------------- insertion un materiel -----------------------------------------//


    $query = " INSERT INTO caution (ref_caution,id_patient,id_perso,date_caution,date_modif,montant) 
                     VALUES (:ref_caution,:id_patient,:id_perso,:date_caution,:date_modif,:montant)";

    $sql = $db->prepare($query);

    // Bind parameters to statement
    $sql->bindParam(':ref_caution', $ref_caution);
    $sql->bindParam(':id_patient', $id_patient);
    $sql->bindParam(':id_perso', $id_perso);
    $sql->bindParam(':date_caution', $date_caution);
    $sql->bindParam(':date_modif', $date_caution);
    $sql->bindParam(':montant', $montant);
    $sql->execute();


    if ($sql) {
?>
        <script>
            window.location.href = 'liste_caution.php?witness=1';
        </script>
    <?php
    } else {
    ?>
        <script>
            window.location.href = 'liste_caution.php?witness=-1';
        </script>
    <?php

    }
    // } else {
    //     
    ?>
    <script>
        //         window.location.href = 'liste_caution.php?witness=-2';
    </script>
<?php
    // }
}
?>