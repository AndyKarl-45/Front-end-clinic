<?php
if ($lvl != 2) {
  echo '<option value="0" selected>...</option>';
  $iResult = $db->query('SELECT * FROM personnel where   open_close!=1');
} else {
  $iResult = $db->query("SELECT * FROM personnel where id_personnel='$id_perso_session' and  open_close!=1");
}



while ($data = $iResult->fetch()) {

  $i = $data['id_personnel'];
  echo '<option value ="' . $i . '">';
  echo $data['nom'] . ' ' . $data['prenom'];
  echo '</option>';
}
