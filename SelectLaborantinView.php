<?php

if ($lvl == 9) {
    $iResult = $db->query("SELECT * FROM  laboratin where open_close!=1 and id_laborantin='$id_perso_session'");
} else {
    echo '<option value="0" selected="">....</option>';
    $iResult = $db->query("SELECT * FROM  laboratin where open_close!=1");
}

while ($data = $iResult->fetch()) {

    $i = $data['id_laborantin'];
    echo '<option value ="' . $i . '">';
    echo $data['nom_l'] . ' ' . $data['prenom_l'];
    echo '</option>';

}


?>