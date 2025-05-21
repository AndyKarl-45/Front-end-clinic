<?php
if($lvl ==1 ){
    $iResult = $db->query("SELECT * FROM patient where id_patient='$id_perso_session'");

}else{
    echo'<option value="0" selected="">....</option>';
    $iResult = $db->query("SELECT * FROM patient where open_close !=1");

}


    $iResult = $db->query('SELECT * FROM patient where   open_close!=1');

    while($data = $iResult->fetch()){

        $i = $data['id_patient'];
        echo '<option value ="' . $i . '">';
     //   echo $data['nom_p'] . ' ' . $data['prenom_p'];
        echo $data['ref_patient'].'( '.$data['nom_p'].' '.$data['prenom_p']. ' )';
        echo '</option>';

    }


 ?>