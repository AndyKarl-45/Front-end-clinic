<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php");
?>
<?php

if($_REQUEST){



    $id_service_value=$_REQUEST['id_service'];
    $id_reg_service_value=$_REQUEST['id_reg_service'];
    $table_service=$_REQUEST['table_service'];

    $table_key = ['id_con', 'id_eco', 'id_exa', 'id_hosp','id_ope','id_ordo','id_radiologie','id__anes','id_autre_service']; // Remplacez par vos noms de services
    $table_reg_key = ['id_reg_consul', 'id_reg_eco', 'id_reg_exa', 'id_reg_hosp','id_reg_ope','id_reg_ordo','id_reg_radiologie','id_reg_anes','id_reg_autre'];
    $table_reg = ['regler_consul', 'regler_ecographie', 'regler_examen', 'regler_hosp','regler_ope','regler_ordo','regler_radiologie','regler_anesthesie','regler_autre'];

    switch ($table_service) {
//        case 'Consultation';
//            $id_service=$table_key[0];
//            break;
//        case 'Examen';
//            $id_service=$table_key[2];
//            break;
        case 'hospitalisation';
            $id_service=$table_key[3];
            $id_reg_service=$table_reg_key[3];
            $table_reg_service=$table_reg[3];
            $i=3;
            break;
//        case 'Ordonnances';
//            $id_service=$table_key[5];
//            break;
        case 'operation';
            $id_service=$table_key[4];
            $id_reg_service=$table_reg_key[4];
            $table_reg_service=$table_reg[4];
            $i=5;
            break;
        case 'anesthesie';
            $id_service=$table_key[7];
            $id_reg_service=$table_reg_key[7];
            $table_reg_service=$table_reg[7];
            $i=6;
            break;
        case 'ecographie';
            $id_service=$table_key[1];
            $id_reg_service=$table_reg_key[1];
            $table_reg_service=$table_reg[1];
            $i=7;
            break;
        case 'radiologie';
            $id_service=$table_key[6];
            $id_reg_service=$table_reg_key[6];
            $table_reg_service=$table_reg[6];
            $i=8;
            break;
        case 'autre_services';
            $id_service=$table_key[8];
            $id_reg_service=$table_reg_key[8];
            $table_reg_service=$table_reg[8];
            $i=9;
            break;
    }




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

    $query  = "SELECT count($id_service) as total from $table_service where $id_service='$id_service_value'";
    $q = $conn->query($query);
    while($row = $q->fetch_assoc())
    {
        $total_apt = $row["total"];
    }

    if($total_apt!=0){

        $query = "SELECT * from $table_reg_service where $id_service = '$id_service_value' and $id_reg_service = '$id_reg_service_value'  ";
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
            $query1 = "UPDATE $table_reg_service SET   payer=:payer
                    WHERE $id_service = '$id_service_value' and id_reg_service = '$id_reg_service_value'";

            $sql1 = $db->prepare($query1);
            // Bind parameters to statement
//            $sql1->bindParam(':etat', $etat);
            $sql1->bindParam(':payer', $payer_init);
            $sql1->execute();



            $etat=-1;
            $query1 = "UPDATE $table_service SET  etat=:etat
                    WHERE id_servce = '$id_service_value' ";

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
            $service=$i;

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


        switch ($table_service) {
//        case 'Consultation';
//            $id_service=$table_key[0];
//            break;
//        case 'Examen';
//            $id_service=$table_key[2];
//            break;
            case 'hospitalisation';
                ?>
                <script>
                    // alert('Ordonnance effectuée.');
                    window.location.href='liste_hospitalisation_checker.php?witness=1';
                </script>
                <?php
                break;
//        case 'Ordonnances';
//            $id_service=$table_key[5];
//            break;
            case 'operation';
                ?>
                <script>
                    // alert('Ordonnance effectuée.');
                    window.location.href='liste_operation_checker.php?witness=1';
                </script>
                <?php
                break;
            case 'anesthesie';
                ?>
                <script>
                    // alert('Ordonnance effectuée.');
                    window.location.href='liste_anesthesie_checker.php?witness=1';
                </script>
                <?php
                break;
            case 'ecographie';
                ?>
                <script>
                    // alert('Ordonnance effectuée.');
                    window.location.href='liste_ecographie_checker.php?witness=1';
                </script>
                <?php
                break;
            case 'radiologie';
                ?>
                <script>
                    // alert('Ordonnance effectuée.');
                    window.location.href='liste_radiologie_checker.php?witness=1';
                </script>
                <?php
                break;
            case 'Autres Services';
                ?>
                <script>
                    // alert('Ordonnance effectuée.');
                    window.location.href='liste_autres_services_checker.php?witness=1';
                </script>
                <?php
                break;
        }

    }

    else
    {

        ?>
        <script>
            alert('Erreur lors du chargement.');
            window.location.href='liste_consultation_checker.php?witness=-1';
        </script>
        <?php

    }
}
?>
