<?php
echo '
    <option value="0" selected>...</option>';

$date_days = date('Y-m-d');
$iResult = $db->query("SELECT * from pharmacie where  quantite > 0 and date_fab > '$date_days' order by nom_medi asc");

while ($data = $iResult->fetch()) {

    $id_phar = $data['id_phar'];
    $id_num_lot = $data['id_num_lot'];
    $id_medi = $data['id_medi'];
    $quantite = $data['quantite'];
    $id_num_lot = $data['id_num_lot'];
    $date_exp = $data['date_exp'];
    $date_fab = $data['date_fab'];

    $sql = "SELECT DISTINCT * from medicament where id_medi = '$id_medi'";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tables as $table) {
        $ref_medi = $table['ref_medi'];
        $nom_medi = $table['nom_medi'];
        //$prix= $table['prix_unitaire'];
        $id_type_medi = $table['id_type_medi'];
        $prix = $table['prix_unitaire'];
        $prix_vente = $table['prix_u_v'];

        echo '<option value ="' . $id_medi . '">';
        //   echo $data['nom_p'] . ' ' . $data['prenom_p'];
        echo $nom_medi . '( stock: ' . $quantite . ' - Prix: ' . $prix_vente . 'FCFA )';
        echo '</option>';

        //        $sql = "SELECT DISTINCT * from type_medi where id_type_medi = '$id_type_medi'";
        //
        //        $stmt = $db->prepare($sql);
        //        $stmt->execute();
        //
        //        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //
        //        foreach ($tables as $table) {
        //            $type_medi= $table['nom'];
        //        }
    }

    // $i = $data['id_patient'];


}
