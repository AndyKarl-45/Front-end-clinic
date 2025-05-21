<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if($_POST)
{



    $code1 = $_POST['code'];
    $code = 'BQ_'.$code1;

    $nom1 = strtolower($_POST['banque']);
    $banque = ucwords($nom1);

    $id_perso= $_POST['id_personnel'];

    $solde =0;
    $date_banque=date('Y-m-d');
//    $date_caisse = $_POST['date_caisse'];
    $open_close=0;

    $sql = "INSERT INTO banque (code,banque,id_perso,solde,date_banque,open_close)
                                  VALUES (?,?,?,?,?,?)";
    $req = $db->prepare($sql);
    $req->execute(array($code,$banque,$id_perso,$solde,$date_banque,$open_close));

    if($sql)
    {
        ?>
        <script>
            // alert('Profession a été bien enregistrée.');
            window.location.href='liste_add_banque.php?witness=1';
        </script>
        <?php
    }

    else
    {
        ?>
        <script>
            // alert('Error.');
            window.location.href='liste_add_banque.php?witness=-1';
        </script>
        <?php

    }


}
?>
