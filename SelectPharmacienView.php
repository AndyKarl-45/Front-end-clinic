<?php

if ($lvl == 10) {
    $iResult = $db->query("SELECT * FROM  users where id_perso='$id_perso_session' and statut='A'");
} else {
    echo '<option value="0" selected="">....</option>';
    $iResult = $db->query("SELECT * FROM  users where lvl=10 and statut='A' ");
}

while ($data = $iResult->fetch()) {

    $id_perso = $data['id_perso'];
    // echo '<option value ="' . $i . '">';
    // echo $data['nom'] . ' ' . $data['prenom'];
    // echo '</option>';

    $sql = "SELECT DISTINCT * from personnel where id_personnel = '$id_perso'";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tables as $table) {
        $i = $id_perso;
        echo '<option value ="' . $i . '">';
        echo $table['nom'] . ' ' . $table['prenom'];
        echo '</option>';
    }

}

?>