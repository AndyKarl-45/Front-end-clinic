<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php");
?>

<?php

if ($_POST) {

    $diagnostic = $_POST['diagnostic'];

    // strtoupper($_POST['nom_quat']);

    $nom1 = strtolower($_POST['nom']);
    $nom2 = ucwords($nom1);
    echo $nom2;
    $open_close = 0;

    $sql = "INSERT INTO maladie (nom)
                                  VALUES (?)";
    $req = $db->prepare($sql);
    $req->execute(array($nom2));

    if ($diagnostic != 1) {
        if ($req) {
?>
            <script>
                window.location.href = 'liste_maladie.php?witness=1';
            </script>
        <?php
        } else {
        ?>
            <script>
                window.location.href = 'liste_maladie.php?witness=-1';
            </script>
        <?php

        }
    } else {
        if ($req) {
        ?>
            <script>
                window.location.href = 'nouveau_diagnostique.php?witness=1';
            </script>
        <?php
        } else {
        ?>
            <script>
                window.location.href = 'nouveau_diagnostique.php?witness=-1';
            </script>
<?php

        }
    }
}
?>