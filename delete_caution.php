<?php

include("php/dbconnect.php");


if (isset($_REQUEST['id_caution'])) {
  $id_caution = $_REQUEST['id_caution'];


  $query = "DELETE FROM caution WHERE id_caution='$id_caution'";
  $sql = $conn->query($query);


  if ($sql) {
    echo "<script>
                window.location.href='liste_caution.php?witness=1';
            </script>";
  } else {

    echo "<script>
                window.location.href='liste_caution.php?witness=-1';
            </script>";
  }
}
