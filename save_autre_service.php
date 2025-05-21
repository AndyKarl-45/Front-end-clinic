<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php");
?>

<?php

if ($_POST) {


    // strtoupper($_POST['nom_quat']);
    $prix_service = $_POST['prix_service'];
    $nom1 = strtolower($_POST['nom']);
    $nom2 = ucwords($nom1);
    $link = 'liste_autres_services_suite_review.php';
    // echo $nom2;
    $open_close = 0;

    $sql = "INSERT INTO autres_services (nom,prix_autre_service)
                                  VALUES (?,?)";
    $req = $db->prepare($sql);
    $req->execute(array($nom2, $prix_service));


    if ($req) {
?>
        <script>
            window.location.href = '<?= $link ?>?witness=1';
        </script>
    <?php
    } else {
    ?>
        <script>
            window.location.href = '<?= $link ?>?witness=-1';
        </script>
<?php

    }
}
?>