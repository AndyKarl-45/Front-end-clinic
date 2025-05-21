<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');

?>
<?php
if ($_POST) {
    $id_num_lot = $_POST['id_num_lot'];
    $id_medi = $_POST['id_medi'];
    $quantite = $_POST['quantite'];
    $date_phar=date('Y-m-d');
    $heure=date("G:i");

    $query = "SELECT * from medicament where id_medi= '$id_medi' ";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($tables as $table) {
        $nom_medi = $table['nom_medi'];
    }

    $query = "SELECT * from magasin where id_medi= '$id_medi' and id_num_lot='$id_num_lot' ";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($tables as $table) {
        $quantite_in = $table['qt_com'];
        $date_exp= $table['date_exp'];
        $date_fab = $table['date_fab'];
    }
    $quantite_final=$quantite_in-$quantite;

    if($quantite_final>=0){
        $today=date('Y-m-d');
        $taux_med=0;
        $sql = "SELECT id_medi, quantite FROM pharmacie where id_medi='$id_medi' and id_num_lot='$id_num_lot' and date_fab > '$today' ";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tables as $table) {
            $taux_med+=1;

            $quantite_init = $table['quantite'];
        }
        $to = $taux_med;



        if ($to != 0) {
            $qt_total = $quantite_init + $quantite;

            $query1 = "UPDATE pharmacie SET quantite=:quantite, heure=:heure where id_medi='$id_medi' and id_num_lot='$id_num_lot' ";

            $sql12 = $db->prepare($query1);

            // Bind parameters to statement
            $sql12->bindParam(':quantite', $qt_total);
            $sql12->bindParam(':heure', $heure);
            $sql12->execute();
        } else {


            $query12 = " INSERT INTO pharmacie (id_medi,nom_medi,quantite,date_phar,id_num_lot,date_exp,date_fab,heure) 
                     VALUES (:id_medi,:nom_medi,:quantite,:date_phar,:id_num_lot,:date_exp,:date_fab,:heure)";

            $sql12 = $db->prepare($query12);
            // Bind parameters to statement
            $sql12->bindParam(':id_medi', $id_medi);
            $sql12->bindParam(':nom_medi', $nom_medi);
            $sql12->bindParam(':quantite', $quantite);
            $sql12->bindParam(':date_phar', $date_phar);
            $sql12->bindParam(':id_num_lot', $id_num_lot);
            $sql12->bindParam(':date_exp', $date_exp);
            $sql12->bindParam(':date_fab', $date_fab);
            $sql12->bindParam(':heure', $heure);
            $sql12->execute();
        }

        if($sql12){
                $query1 = "UPDATE magasin SET qt_com=:quantite where  id_medi='$id_medi' and id_num_lot='$id_num_lot'";

                $req = $db->prepare($query1);

                // Bind parameters to statement
                $req->bindParam(':quantite', $quantite_final);
                $req->execute();
        }else{
            ?>
            <script>
                alert('Error: execution echec');
                window.location.href = 'liste_mag_centrale.php?witness=-1';
            </script>
            <?php
        }

        if($quantite_final ==0 ){
            $query = "DELETE FROM magasin WHERE id_num_lot='$id_num_lot' and id_medi='$id_medi' ";
            $sql = $conn->query($query);
        }


    }else{
        ?>
        <script>
            //alert('Error.');
            window.location.href = 'liste_mag_centrale.php?witness=-2';
        </script>
        <?php

    }



    if ($sql) {
        ?>
        <script>
            //alert('client a été bien enregistrée.');
            window.location.href = 'liste_mag_centrale.php?witness=1';
        </script>
        <?php
    } else {
        ?>
        <script>
            //alert('Error.');
            window.location.href = 'liste_mag_centrale.php?witness=-1';
        </script>
        <?php

    }

}
?>

