<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if($_POST)
{


    /*--------------------------------- ETAT HOLIDAY -------------------------------------*/
    $id = $_POST['id_banque'];
    $code = $_POST['code'];

    $nom1 = strtolower($_POST['banque']);
    $banque = ucwords($nom1);
    $date_banque= $_POST['date_banque'];
    $id_perso= $_POST['id_personnel'];
    $solde = $_POST['solde'];
    $open_close=0;
    $date_modif=date('Y-m-d');
    $heure_modif=date("G:i");



    // echo $id.'</br>';
    // echo $nom.'</br>';
    // echo $numero_secteur.'</br>';
    // echo $tel.'</br>';
    // echo $responsable.'</br>';


    /*--------------------------------- SAVE DATA HOLIDAY ---------------------------*/

    $query1 = "UPDATE banque SET code=:code, date_banque=:date_banque,date_modif=:date_modif, heure_modif=:heure_modif,id_perso=:id_perso, banque=:banque, solde=:solde where id_banque = '$id' ";

    $sql1 = $db->prepare($query1);

    // Bind parameters to statement
    $sql1->bindParam(':code', $code);
    $sql1->bindParam(':date_banque', $date_banque);
    $sql1->bindParam(':date_modif', $date_modif);
    $sql1->bindParam(':heure_modif', $heure_modif);
    $sql1->bindParam(':id_perso', $id_perso);
    $sql1->bindParam(':banque', $banque);
    $sql1->bindParam(':solde', $solde);
    $sql1->execute();



    if($sql1)
    {

        ?>
        <script>
            //  alert('Solde a été bien modifiée.');
            window.location.href='liste_add_banque.php?witness=1';
        </script>
        <?php



    }

    else
    {
        ?>
        <script>
            alert('Solde n\'a pas été  modifiée.');
            window.location.href='modifier_add_banque.php?id=<?=$id?>';
        </script>
        <?php

    }


}
?>
