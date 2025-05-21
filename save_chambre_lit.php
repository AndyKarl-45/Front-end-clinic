 <?php
    include("first.php");
    include('php/navbar_links.php');
    include("php/db.php");
?>

<?php

if($_REQUEST)
{               


        
        $hospitalisation = $_REQUEST['id'];
        


                                    if($hospitalisation)
                                    {
                                        ?>
                                        <script>
                                           
                                             window.location.href='nouveau_hospitalisation.php?hospitalisation=<?=$hospitalisation?>';
                                        </script>
                                        <?php
                                    }

                                    else
                                    {       
                                      ?>
                                        <script>
                                            alert('Error.');
                                            window.location.href='nouveau_hospitalisation.php';
                                        </script>
                                        <?php
                                       
                                    }


}
?>
