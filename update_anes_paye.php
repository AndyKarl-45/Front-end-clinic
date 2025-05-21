<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")

?>

<?php

if ($_POST) {
    $id_anes = $_POST['id_anes'];
    $id_reg_anes = $_POST['id_reg_anes'];
    $id_perso_session = $_POST['id_perso_session'];
    $payer = $_POST['payer'];
    $somme = $_POST['somme'];
    $remise = $_POST['remise'];
    $paie = $_POST['paie'];
    /*--------------------------------- ETAT INFOS RH -------------------------------------*/
    $payer_sum=0;
    $remise_sum=0;
    $cnt=0;
    $cnt_pers=0;
    $query  = "SELECT * from regler_anesthesie where id_reg_anes='$id_reg_anes' and id_anes='$id_anes'";
    $q = $conn->query($query);
    while($row = $q->fetch_assoc())
    {
        $payer_init = $row["payer"];
        $remise_init = $row["remise"];
        $id_patient = $row["id_patient"];
        $cnt+=1;
    }
    
    // chec if reglement is ok
                if($somme-($payer_init+$remise_init)===0){
                    ?>
                        <script>
                            //  alert('client n\'a pas été mis à jour.');
                            window.location.href = 'liste_anesthesie_checker.php?witness=-4';
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
                
                if( $paie === $mode_caution ){
                    
                    if($montant_caution!=0 ){
                         $payer=$montant_caution;
                    }else{
                         ?>
                        <script>
                            //  alert('client n\'a pas été mis à jour.');
                            window.location.href = 'liste_anesthesie_checker.php?witness=-3';
                        </script>
                        <?php
                    }
                   
                }

    if($cnt_pers==1 )
    {
        if($cnt==0){
            if($somme-($payer+$remise)>=0){

                $query1 = "UPDATE regler_anesthesie SET  payer=:payer, remise=:remise,id_paie=:id_paie, id_caisse=:id_caisse
                    WHERE id_anes = '$id_anes'and id_reg_anes='$id_reg_anes'";


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
                $service=6;

                $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_entre,date_hist,statut,type_beni,id_perso,service,id_mode_paie)
                      VALUES (?,?,?,?,?,?,?,?,?,?)";
                $req = $db->prepare($sql);
                $req->execute(array($id_caisse,$ref_caisse,$id_patient,$somme,$date_hist,$statut,$type_beni,$id_perso,$service,$paie));
                
                
                if( $paie === $mode_caution and $payer === $montant_caution){
                            
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
                        window.location.href = 'liste_anesthesie_checker.php?witness=1';
                    </script>
                    <?php
                } else {
                    ?>
                    <script>
                        //   alert('client n\'a pas été mis à jour.');
                        window.location.href = 'liste_anesthesie_checker.php?witness=-1';
                    </script>
                    <?php

                }
            }else{
                $payer=$somme;

                $query1 = "UPDATE regler_anesthesie SET  payer=:payer, remise=:remise,id_paie=:id_paie, id_caisse=:id_caisse
                    WHERE id_anes = '$id_anes'and id_reg_anes='$id_reg_anes'";


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
                $service=6;

                $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_entre,date_hist,statut,type_beni,id_perso,service,id_mode_paie)
                      VALUES (?,?,?,?,?,?,?,?,?,?)";
                $req = $db->prepare($sql);
                $req->execute(array($id_caisse,$ref_caisse,$id_patient,$somme,$date_hist,$statut,$type_beni,$id_perso,$service,$paie));
                
                
                if( $paie === $mode_caution and $payer === $montant_caution){
                            
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
                        window.location.href = 'liste_anesthesie_checker.php?witness=1';
                    </script>
                    <?php
                } else {
                    ?>
                    <script>
                        //   alert('client n\'a pas été mis à jour.');
                        window.location.href = 'liste_anesthesie_checker.php?witness=-1';
                    </script>
                    <?php

                }
            

            }
        }else{
            $payer_sum=$payer_init+$payer;
            $remise_sum=$remise_init+$remise;
            if($somme-$payer_sum>=0){

                $query1 = "UPDATE regler_anesthesie SET  payer=:payer, remise=:remise,id_paie=:id_paie, id_caisse=:id_caisse
                    WHERE id_anes = '$id_anes'and id_reg_anes='$id_reg_anes'";


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
                $service=6;

                $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_entre,date_hist,statut,type_beni,id_perso,service,id_mode_paie)
                      VALUES (?,?,?,?,?,?,?,?,?,?)";
                $req = $db->prepare($sql);
                $req->execute(array($id_caisse,$ref_caisse,$id_patient,$somme,$date_hist,$statut,$type_beni,$id_perso,$service,$paie));
                
                
                if( $paie === $mode_caution ){
                            
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




            }else{
                        $payer=$somme;
                        $payer_sum=$payer_init+$payer;
                        $remise_sum=$remise_init+$remise;
                        $quantite_final_src=$solde_src+$payer;
                        
                        if($quantite_final_src <= 200000){
                            $date_reg_anes=date('Y-m-d');
                            
                            $query1 = "UPDATE regler_anesthesie SET  payer=:payer, remise=:remise, id_paie=:id_paie,date_reg_anes=:date_reg_anes, id_caisse=:id_caisse
                    WHERE id_anes = '$id_anes'and id_reg_anes='$id_reg_anes'";


                        $sql1 = $db->prepare($query1);

                        // Bind parameters to statement
                        $sql1->bindParam(':payer', $payer_sum);
                        $sql1->bindParam(':remise', $remise_sum);
                        $sql1->bindParam(':id_paie', $paie);
                        $sql1->bindParam(':date_reg_anes', $date_reg_anes);
                        $sql1->bindParam(':id_caisse', $id_caisse);
                        $sql1->execute();
                        
                        
                            $query1 = "UPDATE caisse SET  solde=:payer
                            WHERE  id_caisse='$id_caisse'";
        
        
                                $sql1 = $db->prepare($query1);
        
                                // Bind parameters to statement
                                $sql1->bindParam(':payer', $quantite_final_src);
                                $sql1->execute();
                        }else{
                            ?>
                        <script>
                            //  alert('client n\'a pas été mis à jour.');
                            window.location.href = 'liste_anesthesie_checker.php?witness=-2';
                        </script>
                        <?php
                        }
                        
                        if($somme-($payer_sum+$remise_sum)==0 ){
                                $etats=1;
                                $query1 = "UPDATE anesthesie SET  etat=:etat
                                WHERE id_anes = '$id_anes'";
            
            
                                    $sql1 = $db->prepare($query1);
            
                                    // Bind parameters to statement
                                    $sql1->bindParam(':etat', $etats);
                                    $sql1->execute();
                            }
                        

                        $ref_caisse='N/A';
                        $id_beneficiaire=$id_caisse;
                        $id_perso=$id_perso_session;
                        $somme=$payer;
                        $date_hist=date('Y-m-d');
                        $statut='E';
                        $type_beni='P';
                        $service=6;

                        $sql = "INSERT INTO historique_caisse (id_caisse,ref_caisse,id_beneficiaire,montant_entre,date_hist,statut,type_beni,id_perso,service,id_mode_paie)
                      VALUES (?,?,?,?,?,?,?,?,?,?)";
                $req = $db->prepare($sql);
                $req->execute(array($id_caisse,$ref_caisse,$id_patient,$somme,$date_hist,$statut,$type_beni,$id_perso,$service,$paie));
                        
                        
                        if( $paie === $mode_caution ){
                            
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
                        window.location.href = 'liste_anesthesie_checker.php?witness=1';
                    </script>
                    <?php
                } else {
                    ?>
                    <script>
                        //   alert('client n\'a pas été mis à jour.');
                        window.location.href = 'liste_anesthesie_checker.php?witness=-1';
                    </script>
                    <?php

                }

        }
    }else{
        ?>
        <script>
            alert('Vous n\'avez pas de caisse.');
            window.location.href = 'liste_anesthesie_checker.php?witness=-1';
        </script>
        <?php
    }










}
?>
