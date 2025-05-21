<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {


//
    $nom_r = strtoupper($_POST['nom_r']);
    $prenom_r = ucfirst(strtolower($_POST['prenom_r']));
     $user_r = "N/A";
     $pass_r = "N/A";
     $email_r = $_POST['email_r'];
    $type_r = $_POST['type_r'];
     $id_depart = $_POST['id_depart'];
     $date_r = $_POST['date_r'];
    $genre_r = $_POST['genre_r'];
     $adress_r = $_POST['adress_r'];
    $pays_r = $_POST['pays_r'];
    $ville_r = $_POST['ville_r'];
    $region_r = "N/A";
    $code_r = "N/A";
    $phone_r = $_POST['phone_r'];
    $bio_r = $_POST['bio_r'];
    if(empty($date_r)){
        $date_r=null;
    }


//--------------------------------- insertion un fournisseur -----------------------------------------//




    $query = " INSERT INTO radiologue (type_r,nom_r,prenom_r,user_r,email_r,pass_r,id_depart,date_r,genre_r,adress_r,pays_r,ville_r,region_r,code_r,phone_r,bio_r) 
                     VALUES (:type_r,:nom_r,:prenom_r,:user_r,:email_r,:pass_r,:id_depart,:date_r,:genre_r,:adress_r,:pays_r,:ville_r,:region_r,:code_r,:phone_r,:bio_r)";

    $sql = $db->prepare($query);

    // Bind parameters to statement
    $sql->bindParam(':type_r', $type_r);
    $sql->bindParam(':nom_r', $nom_r);
    $sql->bindParam(':prenom_r', $prenom_r);
    $sql->bindParam(':user_r', $user_r);
    $sql->bindParam(':email_r', $email_r);
    $sql->bindParam(':pass_r', $pass_r);
    $sql->bindParam(':id_depart', $id_depart);
    $sql->bindParam(':date_r', $date_r);
    $sql->bindParam(':genre_r', $genre_r);
    $sql->bindParam(':adress_r', $adress_r);
    $sql->bindParam(':pays_r', $pays_r);
    $sql->bindParam(':ville_r', $ville_r);
    $sql->bindParam(':region_r', $region_r);
    $sql->bindParam(':code_r', $code_r);
    $sql->bindParam(':phone_r', $phone_r);
    $sql->bindParam(':bio_r', $bio_r);
    $sql->execute();


    if ($sql) {
        ?>
        <script>
            //alert('client a été bien enregistrée.');
            window.location.href = '<?=$radiologue['option2_link']?>?witness=1';
        </script>
        <?php
    } else {
        ?>
        <script>
           //alert('Error.');
            window.location.href = '<?=$radiologue['option2_link']?>?witness=-1';
        </script>
        <?php

    }


}
?>
