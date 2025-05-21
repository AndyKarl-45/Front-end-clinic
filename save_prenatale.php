<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {





    $id_patient = $_POST['id_patient'];
    $id_nurse = $_POST['id_nurse'];
    $id_medecin = $_POST['id_medecin'];
    $ddr = $_POST['ddr'];
    $dpa = $_POST['dpa'];
    $taille = $_POST['taille'];
    $te = $_POST['te'];
    $g = $_POST['g'];
    $p = $_POST['p'];
    $cat = $_POST['cat'];
    $grossesse = $_POST['grossesse'];
    $conj = $_POST['conj'];
    $oed = $_POST['oed'];
    $ca = $_POST['ca'];
    $pres = $_POST['pres'];
    $bdc = $_POST['bdc'];
    $tv = $_POST['tv'];
    $urinesalb = $_POST['urinesalb'];
    $urinessuc = $_POST['urinessuc'];
    $date_rdv = $_POST['date_rdv'];

    $date_created = date('Y-m-d');
    $obs = $_POST['obs'];
    $plaintes = $_POST['plaintes'];
    //  $remise = $_POST['remise'];

    $year = (new DateTime())->format("Y");
    $month = (new DateTime())->format("m");
    $day = (new DateTime())->format("d");



//--------------------------------- insertion prenatale -----------------------------------------//



        $etat=0;
        $query = " INSERT INTO prenatale (id_patient,id_nurse,taille,ddr,dpa,te,g,p,cat,grossesse,conj,oed,ca,pres,id_medecin,bdc,tv,urines_alb,urines_suc,date_rdv,obs,plaintes,date_created) 
                     VALUES (:id_patient,:id_nurse,:taille,:ddr,:dpa,:te,:g,:p,:cat,:grossesse,:conj,:oed,:ca,:pres,:id_medecin,:bdc,:tv,:urinesalb,:urinessuc,:date_rdv,:obs,:plaintes,:date_created)";

        $sql = $db->prepare($query);
        // Bind parameters to statement
        // $sql->bindParam(':ref_con', $ref_con);
        $sql->bindParam(':id_patient', $id_patient);
        $sql->bindParam(':id_nurse', $id_nurse);
        $sql->bindParam(':taille', $taille);
        $sql->bindParam(':ddr', $ddr);
        $sql->bindParam(':dpa', $dpa);
        $sql->bindParam(':te', $te);
        $sql->bindParam(':g', $g);
        $sql->bindParam(':p', $p);
        $sql->bindParam(':cat', $cat);
        $sql->bindParam(':grossesse', $grossesse);
        $sql->bindParam(':conj', $conj);
        $sql->bindParam(':oed', $oed);
        $sql->bindParam(':ca', $ca);
        $sql->bindParam(':pres', $pres);
        $sql->bindParam(':id_medecin', $id_medecin);
        $sql->bindParam(':bdc', $bdc);
        $sql->bindParam(':tv', $tv);
        $sql->bindParam(':urinesalb', $urinesalb);
        $sql->bindParam(':urinessuc', $urinessuc);
        $sql->bindParam(':date_rdv', $date_rdv);
        $sql->bindParam(':obs', $obs);
        $sql->bindParam(':plaintes', $plaintes);
        $sql->bindParam(':date_created', $date_created);
        $sql->execute();


    $query  = "SELECT max(id_pre) as total from prenatale";
    $q = $conn->query($query);
    while($row = $q->fetch_assoc())
    {
        $total_apt = $row["total"];
    }
    $id_app = $total_apt;
    $ref_pre= 'PRE_'.$year.'_'.$month.'_'.$id_patient.'_'.$id_app;

    //ref de consul
    $query1 = " UPDATE prenatale SET  ref_pre=:ref_pre    
        WHERE id_pre= '$id_app' ";
    $sql1 = $db->prepare($query1);

    // Bind parameters to statement
    $sql1->bindParam(':ref_pre', $ref_pre);
    $sql1->execute();



//    $sql = "INSERT INTO regler_consul (ref_reg_consul,id_con,id_patient,somme,date_reg_consul,id_type_consul)
//                                  VALUES (?,?,?,?,?,?)";
//    $req = $db->prepare($sql);
//    $req->execute(array($ref_con,$id_app,$id_patient,$somme,$date_con,$id_type_consul));
//

    if ($sql) {
        ?>
        <script>
            //alert('client a été bien enregistrée.');
            window.location.href = '<?=$prenatale['option2_link']?>?witness=1';
        </script>
        <?php
    } else {
        ?>
        <script>
            //alert('Error.');
            window.location.href = '<?=$prenatale['option2_link']?>?witness=-1';
        </script>
        <?php

    }


}
?>
