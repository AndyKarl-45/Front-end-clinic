<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {
    $id_vac = $_POST['id_vac'];
    $id_reg_vac = $_POST['id_reg_vac'];
    $id_perso_session = $_POST['id_perso_session'];
    $payer = $_POST['payer'];
    $somme = $_POST['somme'];
    $remise = $_POST['remise'];
    $paie = $_POST['paie'];
    /*--------------------------------- ETAT INFOS RH -------------------------------------*/
    $payer_sum=0;
    $remise_sum=0;
    $payer_init=$remise_init=0;
    $cnt=0;
    $cnt_pers=0;
    $query  = "SELECT * from regler_vac where id_reg_vac='$id_reg_vac' and id_vac='$id_vac' and payer!=0";
    $q = $conn->query($query);
    while($row = $q->fetch_assoc())
    {
        $payer_init = $row["payer"];
        $remise_init = $row["remise"];
        $id_patient = $row["id_patient"];
        $cnt+=1;
    }
    if(empty($id_patient)){
        $id_patient=0;
    }

    // chec if reglement is ok
    if($somme-($payer_init+$remise_init)===0){
        ?>
        <script>
            //  alert('client n\'a pas été mis à jour.');
            window.location.href = 'liste_vaccination_checker.php?witness=-4';
        </script>
        <?php
    }

    if( $lvl == 4 || $lvl == 7 || $lvl == 11){
        $id_caisse = $_POST['id_caisse'];

        $sql = "SELECT * FROM caisse where id_caisse='$id_caisse' and open_close!=1 ";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tables as $table) {
            $cnt_pers += 1;
        }

        $sql="SELECT * FROM caisse where id_caisse='$id_caisse' and open_close!=1 ";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($tables as $table)
        {
            $solde_src=$table['solde'];
            $id_caisse=$table['id_caisse'];
        }


    }else {
        $sql = "SELECT * FROM caisse where id_perso='$id_perso_session' and open_close!=1 ";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tables as $table) {
            $cnt_pers += 1;
        }


        $sql="SELECT * FROM caisse where id_perso='$id_perso_session' and open_close!=1 ";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($tables as $table)
        {
            $solde_src=$table['solde'];
            $id_caisse=$table['id_caisse'];
        }


    }

    $query  = "SELECT * from mode_paie where nom like 'CAUTION' ";
    $q = $conn->query($query);
    while($row = $q->fetch_assoc())
    {
        $mode_caution = $row["id_mode_paie"];
    }

    if(empty($mode_caution)){
        $mode_caution=0;
    }

    $query  = "SELECT * from caution where id_patient ='$id_patient' ";
    $q = $conn->query($query);
    while($row = $q->fetch_assoc())
    {
        $montant_caution = $row["montant"];
    }

    if( $paie == '01010' ){

        if($montant_caution!=0 ){
            $payer=$montant_caution;
        }else{
            ?>
            <script>
                //  alert('client n\'a pas été mis à jour.');
                window.location.href = 'liste_vaccination_checker.php?witness=-3';
            </script>
            <?php
        }
    }



    if($cnt_pers==1  and $paie!=0)
    {
        if($cnt==0){
            if($somme-($payer+$remise)>=0){
                echo $total_som = $payer+$remise;

                if( $paie == '01010'){

                    if($somme-($payer+$remise)!=0){
                        $sql = "SELECT montant from caution where id_patient = '$id_patient' ";

                        $stmt = $db->prepare($sql);
                        $stmt->execute();


                        // Vérifiez si des résultats ont été trouvés
                        if ( $table = $stmt->fetch(PDO::FETCH_ASSOC)) {

                            $montant_caution = $table['montant'];

                        } else {
                            $montant_caution= 0; // Aucun montant de caution trouvé
                        }

                        $montant_caution_reste = $montant_caution - $somme;

                        if($montant_caution_reste>=0 ){
                            $query1 = "UPDATE caution SET  montant=:montant
                    WHERE id_patient = '$id_patient'";

                            $sql1 = $db->prepare($query1);

                            // Bind parameters to statement
                            $sql1->bindParam(':montant', $montant_caution_reste);
                            $sql1->execute();

                            $total_som = $somme;

                        }else{

                            $total_som = $payer+$remise+$montant_caution;
                            $montant_caution_reste = 0;

                            $query1 = "UPDATE caution SET  montant=:montant
                    WHERE id_patient = '$id_patient'";

                            $sql1 = $db->prepare($query1);

                            // Bind parameters to statement
                            $sql1->bindParam(':montant', $montant_caution_reste);
                            $sql1->execute();

                            $total_som = $somme;

                        }
                    }

                }

                $etat=1;

                $query1 = "UPDATE regler_vac SET  payer=:payer, remise=:remise, id_paie=:id_paie, id_caisse=:id_caisse, etat=:etat
                            WHERE id_vac = '$id_vac'and id_reg_vac='$id_reg_vac'";


                $sql1 = $db->prepare($query1);

                // Bind parameters to statement
                $sql1->bindParam(':payer', $total_som);
                $sql1->bindParam(':id_paie', $paie);
                $sql1->bindParam(':remise', $remise);
                $sql1->bindParam(':id_caisse', $id_caisse);
                $sql1->bindParam(':etat', $etat);
                $sql1->execute();


                $query1 = "UPDATE vaccination SET   etat=:etat
                            WHERE id_vac = '$id_vac'";

                $sql1 = $db->prepare($query1);

                // Bind parameters to statement;
                $sql1->bindParam(':etat', $etat);
                $sql1->execute();


                $quantite_final_src=$solde_src+$payer;
                $query1 = "UPDATE caisse SET  solde=:payer
                            WHERE  id_caisse='$id_caisse'";


                $sql1 = $db->prepare($query1);

                // Bind parameters to statement
                $sql1->bindParam(':payer', $quantite_final_src);
                $sql1->execute();

                $ref_caisse='N/A';
                $id_beneficiaire=$id_caisse;
                $id_perso=$id_perso_session;
                $somme=$payer;
                $date_hist=date('Y-m-d');
                $statut='E';
                $type_beni='P';
                $service=10;

                $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_entre,date_hist,statut,type_beni,id_perso,service,id_mode_paie)
                              VALUES (?,?,?,?,?,?,?,?,?,?)";
                $req = $db->prepare($sql);
                $req->execute(array($id_caisse,$ref_caisse,$id_patient,$somme,$date_hist,$statut,$type_beni,$id_perso,$service,$paie));




                if ($sql1) {
                    ?>
                    <script>
                        //alert('Consulattion a été bien mis à jour.');
                        window.location.href = 'liste_vaccination_checker.php?witness=1';
                    </script>
                    <?php
                } else {
                    ?>
                    <script>
                        //   alert('client n\'a pas été mis à jour.');
                        window.location.href = 'liste_vaccination_checker.php?witness=-1';
                    </script>
                    <?php

                }
            }else{
                $payer=$somme;

                $query1 = "UPDATE regler_vac SET  payer=:payer, remise=:remise, id_paie=:id_paie,id_caisse=:id_caisse
                            WHERE id_vac = '$id_vac'and id_reg_vac='$id_reg_vac'";


                $sql1 = $db->prepare($query1);

                // Bind parameters to statement
                $sql1->bindParam(':payer', $payer);
                $sql1->bindParam(':id_paie', $paie);
                $sql1->bindParam(':remise', $remise);
                $sql1->bindParam(':id_caisse', $id_caisse);
                $sql1->execute();

                $quantite_final_src=$solde_src+$payer;
                $query1 = "UPDATE caisse SET  solde=:payer
                            WHERE  id_caisse='$id_caisse'";


                $sql1 = $db->prepare($query1);

                // Bind parameters to statement
                $sql1->bindParam(':payer', $quantite_final_src);
                $sql1->execute();

                $ref_caisse='N/A';
                $id_beneficiaire=$id_caisse;
                $id_perso=$id_perso_session;
                $somme=$payer;
                $date_hist=date('Y-m-d');
                $statut='E';
                $type_beni='P';
                $service=10;

                $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_entre,date_hist,statut,type_beni,id_perso,service,id_mode_paie)
                              VALUES (?,?,?,?,?,?,?,?,?,?)";
                $req = $db->prepare($sql);
                $req->execute(array($id_caisse,$ref_caisse,$id_patient,$somme,$date_hist,$statut,$type_beni,$id_perso,$service,$paie));


                if( $paie =='01010'  and $payer === $montant_caution){

                    if($montant_caution-$somme>=0)
                        $reste_caution=($montant_caution +$remise)-$somme;
                    else
                        $reste_caution=($montant_caution +$remise)-$payer;

                    $query1 = "UPDATE caution SET  montant=:payer
                            WHERE  id_patient='$id_patient'";


                    $sql1 = $db->prepare($query1);

                    // Bind parameters to statement
                    $sql1->bindParam(':payer', $reste_caution);
                    $sql1->execute();
                }


                if ($sql1) {
                    ?>
                    <script>
                        //alert('Consulattion a été bien mis à jour.');
                        window.location.href = 'liste_vaccination_checker.php?witness=1';
                    </script>
                    <?php
                } else {
                    ?>
                    <script>
                        //   alert('client n\'a pas été mis à jour.');
                        window.location.href = 'liste_vaccination_checker.php?witness=-1';
                    </script>
                    <?php

                }


            }
        }else{
            $payer_sum=$payer_init+$payer;
            $remise_sum=$remise_init+$remise;
            if($somme-($payer_sum+$remise_sum)>=0){

                $query1 = "UPDATE regler_vac SET  payer=:payer, remise=:remise, id_paie=:id_paie, id_caisse=:id_caisse
                            WHERE id_vac = '$id_vac'and id_reg_vac='$id_reg_vac'";


                $sql1 = $db->prepare($query1);

                // Bind parameters to statement
                $sql1->bindParam(':payer', $payer_sum);
                $sql1->bindParam(':id_paie', $paie);
                $sql1->bindParam(':remise', $remise_sum);
                $sql1->bindParam(':id_caisse', $id_caisse);
                $sql1->execute();

                $quantite_final_src=$solde_src+$payer;
                $query1 = "UPDATE caisse SET  solde=:payer
                            WHERE  id_caisse='$id_caisse'";


                $sql1 = $db->prepare($query1);

                // Bind parameters to statement
                $sql1->bindParam(':payer', $quantite_final_src);
                $sql1->execute();

                $ref_caisse='N/A';
                $id_beneficiaire=$id_caisse;
                $id_perso=$id_perso_session;
                $somme=$payer;
                $date_hist=date('Y-m-d');
                $statut='E';
                $type_beni='P';
                $service=10;

                $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_entre,date_hist,statut,type_beni,id_perso,service,id_mode_paie)
                              VALUES (?,?,?,?,?,?,?,?,?,?)";
                $req = $db->prepare($sql);
                $req->execute(array($id_caisse,$ref_caisse,$id_patient,$somme,$date_hist,$statut,$type_beni,$id_perso,$service,$paie));

                if( $paie == '01010' ){

                    if($montant_caution-$somme>=0)
                        $reste_caution=($montant_caution +$remise_sum)-$somme;
                    else
                        $reste_caution=($montant_caution +$remise_sum)-$payer_sum;

                    $query1 = "UPDATE caution SET  montant=:payer
                            WHERE  id_patient='$id_patient'";


                    $sql1 = $db->prepare($query1);

                    // Bind parameters to statement
                    $sql1->bindParam(':payer', $reste_caution);
                    $sql1->execute();
                }


                if ($sql1) {
                    ?>
                    <script>
                        //alert('Consulattion a été bien mis à jour.');
                        window.location.href = 'liste_vaccination_checker.php?witness=1';
                    </script>
                    <?php
                } else {
                    ?>
                    <script>
                        //   alert('client n\'a pas été mis à jour.');
                        window.location.href = 'liste_vaccination_checker.php?witness=-1';
                    </script>
                    <?php

                }
            }else{
                $payer=$somme;
                $payer_sum=$payer_init+$payer;
                $remise_sum=$remise_init+$remise;

                $query1 = "UPDATE regler_vac SET  payer=:payer, remise=:remise, id_paie=:id_paie
                            WHERE id_vac = '$id_vac'and id_reg_vac='$id_reg_vac'";


                $sql1 = $db->prepare($query1);

                // Bind parameters to statement
                $sql1->bindParam(':payer', $payer_sum);
                $sql1->bindParam(':id_paie', $paie);
                $sql1->bindParam(':remise', $remise_sum);
                $sql1->execute();

                $quantite_final_src=$solde_src+$payer;
                $query1 = "UPDATE caisse SET  solde=:payer
                            WHERE  id_caisse='$id_caisse'";


                $sql1 = $db->prepare($query1);

                // Bind parameters to statement
                $sql1->bindParam(':payer', $quantite_final_src);
                $sql1->execute();

                $ref_caisse='N/A';
                $id_beneficiaire=$id_caisse;
                $id_perso=$id_perso_session;
                $somme=$payer;
                $date_hist=date('Y-m-d');
                $statut='E';
                $type_beni='P';
                $service=10;

                $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_entre,date_hist,statut,type_beni,id_perso,service,id_mode_paie)
                              VALUES (?,?,?,?,?,?,?,?,?,?)";
                $req = $db->prepare($sql);
                $req->execute(array($id_caisse,$ref_caisse,$id_patient,$somme,$date_hist,$statut,$type_beni,$id_perso,$service,$paie));

                if( $paie == '01010' ){

                    if($montant_caution-$somme>=0)
                        $reste_caution=($montant_caution +$remise_sum)-$somme;
                    else
                        $reste_caution=($montant_caution +$remise_sum)-$payer_sum;

                    $query1 = "UPDATE caution SET  montant=:payer
                                WHERE  id_patient='$id_patient'";


                    $sql1 = $db->prepare($query1);

                    // Bind parameters to statement
                    $sql1->bindParam(':payer', $reste_caution);
                    $sql1->execute();
                }

            }


            if ($sql1) {
                ?>
                <script>
                    //alert('Consulattion a été bien mis à jour.');
                    window.location.href = 'liste_vaccination_checker.php?witness=1';
                </script>
                <?php
            } else {
                ?>
                <script>
                    //   alert('client n\'a pas été mis à jour.');
                    window.location.href = 'liste_vaccination_checker.php?witness=-1';
                </script>
                <?php

            }


        }


    }else{
        ?>
        <script>
            alert('Vous n\'avez pas de caisse.');
            window.location.href = 'liste_vaccination_checker.php?witness=-1';
        </script>
        <?php
    }











}
?>
