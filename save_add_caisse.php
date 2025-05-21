<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if($_POST)
{



    $code = $_POST['code'];

    $nom1 = strtolower($_POST['caisse']);
    $caisse = ucwords($nom1);

    $id_perso= $_POST['id_personnel'];
    $type_caisse= $_POST['type_caisse'];

    $solde =0;
    $date_caisse=date('Y-m-d');
//    $date_caisse = $_POST['date_caisse'];
    $open_close=0;

    $sql = "INSERT INTO caisse (code,caisse,id_perso,solde,date_caisse,open_close,type_caisse)
                                  VALUES (?,?,?,?,?,?,?)";
    $req = $db->prepare($sql);
    $req->execute(array($code,$caisse,$id_perso,$solde,$date_caisse,$open_close,$type_caisse));

    if($sql)
    {
        ?>
        <script>
            // alert('Profession a été bien enregistrée.');
            window.location.href='liste_add_caisse.php?witness=1';
        </script>
        <?php
    }

    else
    {
        ?>
        <script>
            // alert('Error.');
            window.location.href='liste_add_caisse.php?witness=-1';
        </script>
        <?php

    }


}
?>
