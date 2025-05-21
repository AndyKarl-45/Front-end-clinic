<?php

if ($lvl == 5) {
    $iResult = $db->query("SELECT * FROM  medecin where open_close!=1 and id_medecin='$id_perso_session'");
} else {
    echo '<option value="0" selected="">....</option>';
    $iResult = $db->query("SELECT * FROM  medecin where open_close!=1");
}

while ($data = $iResult->fetch()) {

    $i = $data['id_medecin'];
    echo '<option value ="' . $i . '">';
    echo $data['nom_m'] . ' ' . $data['prenom_m'];
    echo '</option>';

}


?>