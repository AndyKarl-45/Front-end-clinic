<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {





    $nom = $_POST['nom'];
    $id_type_medi = $_POST['id_type_medi'];
    $prix_u_a = $_POST['prix_u_a'];
    $prix_u_v = $_POST['prix_u_v'];
    $id_cat_medi = $_POST['id_cat_medi'];
    $date_medi = date('Y-m-d');
    $alert_prod = $_POST['alert_prod'];
    If(empty($alert_prod)){
        $alert_prod=0;
    }
   // $date_fin = $_POST['date_fin'];
    $date_medi_os=date('Y-m-d');

    $id_four = $_POST['id_four'];

    $year = (new DateTime())->format("Y");
    $month = (new DateTime())->format("m");
    $day = (new DateTime())->format("d");
    $query  = "SELECT max(id_medi) as total from medicament";
    $q = $conn->query($query);
    while($row = $q->fetch_assoc())
    {
        $total_apt = $row["total"];
    }
    $id_app = $total_apt + 1;
    //$ref_medi= 'P_'.$year.'_'.$month.'_'.$id_app;
    //ref
    $numeroref = substr_replace("00000",$id_app, -strlen($id_app));
    $ref_medi='M_'.$year.'_'.$month.'_'.$day.'_'.$numeroref;

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
  
    $query  = "SELECT count(id_medi) as total from medicament where nom_medi like '$nom' ";
    $q = $conn->query($query);
    while($row = $q->fetch_assoc())
    {
       echo $total_prod = $row["total"];
    }
    
    if($total_prod != 0){
      ?>
        <script>
            alert('medicament existe déjà !');
            window.location.href = 'liste_prod.php?witness=-1';
        </script>
      <?php
    }else{
        

//--------------------------------- insertion un fournisseur -----------------------------------------//

    // $query = " INSERT INTO medecin (nom_m,prenom_m,user_m,email_m)
    //                  VALUES (:nom_m,:prenom_m,:user_m,:email_m)";


    $query = " INSERT INTO medicament (ref_medi,nom_medi,id_type_medi,date_medi,date_medi_os,prix_unitaire,prix_u_v,id_four,alert_prod,id_cat_medi) 
                     VALUES (:ref_medi,:nom,:id_type_medi,:date_medi,:date_medi_os,:prix_u_a,:prix_u_v,:id_four,:alert_prod,:id_cat_medi)";

    $sql = $db->prepare($query);
    // Bind parameters to statement
    $sql->bindParam(':ref_medi', $ref_medi);
    $sql->bindParam(':nom', $nom);
    $sql->bindParam(':id_type_medi', $id_type_medi);
    $sql->bindParam(':date_medi', $date_medi_os);
    $sql->bindParam(':date_medi_os', $date_medi_os);
    $sql->bindParam(':prix_u_a', $prix_u_a);
    $sql->bindParam(':prix_u_v', $prix_u_v);
    $sql->bindParam(':id_four', $id_four);
    $sql->bindParam(':alert_prod', $alert_prod);
    $sql->bindParam(':id_cat_medi', $id_cat_medi);
    $sql->execute();


    if ($sql) {
        ?>
        <script>
            //alert('client a été bien enregistrée.');
            window.location.href = 'liste_prod.php?witness=1';
        </script>
        <?php
    } else {
        ?>
        <script>
            //alert('Error.');
            window.location.href = 'liste_prod.php?witness=-1';
        </script>
        <?php

    }
    }




}
?>
