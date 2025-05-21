<?php
if($lvl != 3){
    echo'<option value="0" selected>...</option>';
    $iResult = $db->query('SELECT * FROM nurse where   open_close!=1');
}else{
    $iResult = $db->query("SELECT * FROM nurse where id_nurse='$id_perso_session' and  open_close!=1");
}



    while($data = $iResult->fetch()){

    $i = $data['id_nurse'];
    echo '<option value ="'.$i.'">';
    echo $data['nom_n'].' '.$data['prenom_n'];
    echo '</option>';

    }
?>