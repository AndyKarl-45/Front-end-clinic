<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {

    $nom = $_POST['nom'];
    $id_type_outil = $_POST['id_type_outil'];
    $prix_u_a = $_POST['prix_u_a'];
    $prix_u_v = $_POST['prix_u_v'];
    $id_four = $_POST['id_four'];
    $date_medi = date('Y-m-d');
   // $date_fin = $_POST['date_fin'];
    $date_medi_os=date('Y-m-d');

    $year = (new DateTime())->format("Y");
    $month = (new DateTime())->format("m");
    $day = (new DateTime())->format("d");
    $query  = "SELECT max(id_outil) as total from outil";
    $q = $conn->query($query);
    while($row = $q->fetch_assoc())
    {
        $total_apt = $row["total"];
    }
    $id_app = $total_apt + 1;
    //$ref_medi= 'P_'.$year.'_'.$month.'_'.$id_app;
    //ref
    $numeroref = substr_replace("00000",$id_app, -strlen($id_app));
    $ref_outil='F_'.$year.'_'.$month.'_'.$day.'_'.$numeroref;

//    if(strlen($total_apt)<=4){
//        //N°   0008  /  01  /Pdt/SG/ONIGC/22
//        $numeroref = substr_replace("0000",$num, -strlen($num));
//        $ref_dem_ent='Prod_'.$numeroref.' / '.$month.' /Pdt/SG/ONIGC/'.$years;
//
//    }else{
//        //N°   00008  /  01  /Pdt/SG/ONIGC/22
//        $numeroref = substr_replace("00000",$num, -strlen($num));
//        $ref_dem_ent='P_'.$numeroref.' / '.$month.' /Pdt/SG/ONIGC/'.$years;
//
//    }

    // $open_close = 0;
    // echo $ref_client.'</br>';
    // echo $raison_social_client.'</br>';
    // echo $id_type_client.'</br>';
    // echo $ville_client.'</br>';
    // echo $email_client.'</br>';
    // echo $pers_contact_client.'</br>';
    // echo $tel_contact_client.'</br>';
    



//--------------------------------- insertion un fournisseur -----------------------------------------//

    // $query = " INSERT INTO medecin (nom_m,prenom_m,user_m,email_m)
    //                  VALUES (:nom_m,:prenom_m,:user_m,:email_m)";


    $query = " INSERT INTO outil (ref_outil,nom_outil,id_type_outil,date_create,prix_unit,prix_u_v,id_four) 
                     VALUES (:ref_outil,:nom,:id_type_outil,:date_create,:prix_u_a,:prix_u_v,:id_four)";

    $sql = $db->prepare($query);
    // Bind parameters to statement
    $sql->bindParam(':ref_outil', $ref_outil);
    $sql->bindParam(':nom', $nom);
    $sql->bindParam(':id_type_outil', $id_type_outil);
    $sql->bindParam(':date_create', $date_outil_os);
    $sql->bindParam(':prix_u_a', $prix_u_a);
    $sql->bindParam(':prix_u_v', $prix_u_v);
    $sql->bindParam(':id_four', $id_four);
    $sql->execute();


    if ($sql) {
        ?>
        <script>
            //alert('client a été bien enregistrée.');
            window.location.href = 'liste_outil.php?witness=1';
        </script>
        <?php
    } else {
        ?>
        <script>
            //alert('Error.');
            window.location.href = 'liste_outil.php?witness=-1';
        </script>
        <?php

    }


}
?>
