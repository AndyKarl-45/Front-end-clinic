<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php");
?>
<?php

if($_REQUEST){



    $id_exa=$_REQUEST['id_exa'];
    $id_reg_exa=$_REQUEST['id_reg_exa'];


//$year = (new DateTime())->format("Y");
//$month = (new DateTime())->format("m");
//$day = (new DateTime())->format("d");
//$total_apt=0;
//$query  = "SELECT count(id_medi_ordo) as total from medicament_ordo";
//$q = $conn->query($query);
//while($row = $q->fetch_assoc())
//{
//    $total_apt = $row["total"];
//}
//$id_app = $total_apt + 1;
//$ref_medi= 'ORDO_'.$year.'_'.$month.'_'.$id_patient.'_'.$id_app;
    $quantite_final=0;
    $solde_final=0;
    $cnt=0;

    $query  = "SELECT count(id_exa) as total from examen_exa where id_exa='$id_exa'";
    $q = $conn->query($query);
    while($row = $q->fetch_assoc())
    {
        $total_apt = $row["total"];
    }
    $cnt=0;
    if($total_apt!=0){

        $query = "SELECT * from regler_examen where id_exa = '$id_exa' and id_reg_exa = '$id_reg_exa'  ";
        $q = $db->query($query);
        while($row = $q->fetch())
        {
            $payer= $row['payer'];
            $id_caisse= $row['id_caisse'];
            $cnt++;
        }

        $query = "SELECT * from caisse where id_caisse = '$id_caisse'  ";
        $q = $db->query($query);
        while($row = $q->fetch())
        {
            $solde_caisse= $row['solde'];
        }

        $solde_final= $solde_caisse - $payer;



        if($cnt!=0){
            $etat=-1;
            $payer_init=0;
            $query1 = "UPDATE regler_examen SET  etat=:etat, payer=:payer
                    WHERE id_exa = '$id_exa' and id_reg_exa = '$id_reg_exa'";

            $sql1 = $db->prepare($query1);
            // Bind parameters to statement
            $sql1->bindParam(':etat', $etat);
            $sql1->bindParam(':payer', $payer_init);
            $sql1->execute();


            $query1 = "UPDATE examen_exa SET  etat=:etat, payer=:payer
                    WHERE id_exa = '$id_exa' ";

            $sql1 = $db->prepare($query1);
            // Bind parameters to statement
            $sql1->bindParam(':etat', $etat);
            $sql1->bindParam(':payer', $payer_init);
            $sql1->execute();



            $etat=-1;
            $query1 = "UPDATE examen SET  etat=:etat
                    WHERE id_exa = '$id_exa' ";

            $sql1 = $db->prepare($query1);
            // Bind parameters to statement
            $sql1->bindParam(':etat', $etat);
            $sql1->execute();

            $query1 = "UPDATE caisse SET  solde=:solde
                    WHERE id_caisse = '$id_caisse'";

            $sql1 = $db->prepare($query1);
            // Bind parameters to statement
            $sql1->bindParam(':solde', $solde_final);
            $sql1->execute();

            $ref_caisse='N/A';
            $id_beneficiaire=$id_caisse;
            $id_perso=$id_perso_session;
            $somme=$payer;
            $date_hist=date('Y-m-d');
            $statut='S';
            $type_beni='P';
            $service=2;

            $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_sortie,date_hist,statut,type_beni,id_perso,service)
                      VALUES (?,?,?,?,?,?,?,?,?)";
            $req = $db->prepare($sql);
            $req->execute(array($id_caisse,$ref_caisse,$id_caisse,$somme,$date_hist,$statut,$type_beni,$id_perso,$service));
        }

    }


    if($req)
    {
        // $mailler = new mailsenderclass();

        // $subject = "Demande de d'equipement";
        // $body = "Demande d'equipement effectuee par "
        //         .strtoupper($nom_user)." le "
        //         .date("d/m/Y"). " à "
        //         .date("G:i")." pour la salle "
        //         .strtoupper($nom_salle)
        //         ."<br/>
        //          <a href='campresjonlline.net'>Voir les details</a>";

        // $from= 'supergoal@campresjonlline.net';
        // $from_name='CAMPREJ EQUIEPEMENT';
        // $sql = $db->query("select * from users where secteur = $id_secteur_user and (lvl = 4 or lvl = 3 or lvl = 8 or lvl = 7)");
        // while($row = $sql->fetch()){
        //     $to = $row['email'];
        //     $mailler->mailsenderclass($to, $from, $from_name, $subject, $body);
        // }
        // $mailler->mailsenderclass($email_user, $from, $from_name, $subject, $body);






        ?>
        <script>
            // alert('Ordonnance effectuée.');
            window.location.href='liste_examen_checker.php?witness=1';
        </script>
        <?php

    }

    else
    {

        ?>
        <script>
            alert('Erreur lors du chargement.');
            window.location.href='liste_examen_checker.php?witness=-1';
        </script>
        <?php

    }
}
?>
