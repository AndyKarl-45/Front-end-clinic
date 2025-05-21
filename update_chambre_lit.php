 <?php
    include("first.php");
    include('php/navbar_links.php');
    include("php/db.php");
?>

<?php

if($_REQUEST)
{               


        
        $hospitalisation = $_REQUEST['id'];
        $id_hosp = $_REQUEST['hosp'];
        


            if($hospitalisation)
            {
                ?>
                <script>
                     window.location.href='modifier_hospitalisation.php?id=<?=$id_hosp?>&hospitalisation=<?=$hospitalisation?>';
                </script>
                <?php
            }

            else
            {       
              ?>
                <script>
                    alert('Error.');
                    window.location.href='modifier_hospitalisation.php?id=<?=$id_hosp?>&hospitalisation=0';
                </script>
                <?php
               
            }


}
?>
