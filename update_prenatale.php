<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {



    $id_pre = $_POST['id_pre'];
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
    $date_modified = date('Y-m-d');



    $year = (new DateTime())->format("Y");
    $month = (new DateTime())->format("m");
    $day = (new DateTime())->format("d");

//    // Convertir la date du jour en objet DateTime
//    $dateTimeDuJour = new DateTime($date_hosp);
//
//    // Ajouter le nombre de jours pour obtenir la date de sortie
//    $dateTimeSortie = $dateTimeDuJour->modify("+$nb_jour days");
//
//    // Obtenir la date de sortie au format Y-m-d
//    $date_sortie = $dateTimeSortie->format('Y-m-d');






        $query1 = "UPDATE prenatale SET   id_patient=:id_patient,id_nurse=:id_nurse,taille=:taille,ddr=:ddr,dpa=:dpa,te=:te,g=:g,p=:p,cat=:cat,grossesse=:grossesse,conj=:conj,oed=:oed,ca=:ca,pres=:pres,id_medecin=:id_medecin,bdc=:bdc,tv=:tv,urines_alb=:urinesalb,urines_suc=:urinessuc,date_rdv=:date_rdv,obs=:obs,plaintes=:plaintes
                            WHERE id_pre = '$id_pre'";

        $sql = $db->prepare($query1);

        // Bind parameters to statement;
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
    $sql->execute();


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
