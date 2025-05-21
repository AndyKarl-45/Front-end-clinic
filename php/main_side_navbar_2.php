<?php
include('navbar_links.php');

?>
<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
      <div class="sb-sidenav-menu">
        <div class="nav">
          <!--     <div class="sb-sidenav-menu-heading">Acceuil</div> -->
          <a class="nav-link " href="index.php">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Tableau de Bord
          </a>

          <?php
          if ($lvl == 3 || $lvl == 5) {
          ?>

            <!--***************Médecin***********************-->

            <a class="nav-link collapsed" href="<?= $medecin['option2_link'] ?>" aria-expanded="false"
              aria-controls="pagesCollapseError">
              <div class="sb-nav-link-icon"><i class="<?= $medecin['icon'] ?>"></i></div>
              <?= $medecin['title'] ?>
            </a>

            <?php if ($lvl == 3) { ?>

              <!--***************Nurse***********************-->
              <a class="nav-link collapsed" href="<?= $nurse['option2_link'] ?>" aria-expanded="false"
                aria-controls="pagesCollapseError">
                <div class="sb-nav-link-icon"><i class="<?= $nurse['icon'] ?>"></i></div>
                <?= $nurse['title'] ?>
              </a>
            <?php } ?>

          <?php } ?>

          <!--  <div class="sb-sidenav-menu-heading">Utilitaires</div> -->
          <?php
          if ($lvl == 4  || $lvl == 8 || $lvl == 9 || $lvl == 7 || $lvl == 11 || $lvl == 14) {
          ?>

            <!--****************************************CORPS MEDICAL****************************************-->
            <!--<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages45"-->
            <!--   aria-expanded="false" aria-controls="collapsePages">-->
            <!--    <div class="sb-nav-link-icon"><i class="<?= $corps_medical['icon'] ?>"></i></div>-->
            <!--    <?= $corps_medical['title'] ?>-->
            <!--    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>-->
            <!--</a>-->
            <!--<div class="collapse" id="collapsePages45" aria-labelledby="headingOne"-->
            <!--     data-parent="#sidenavAccordion">-->
            <!--    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">-->

            <!--*******************************************MENU ENTITEES****************************************-->


            <?php
            if ($lvl == 4  || $lvl == 8 || $lvl == 9 || $lvl == 7 || $lvl == 11 || $lvl == 14) {
            ?>


              <!--<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError10"-->
              <!--   aria-expanded="false" aria-controls="pagesCollapseError">-->
              <!--    <div class="sb-nav-link-icon"><i class="<?= $speciale['icon'] ?>"></i></div>-->
              <!--    <?= $speciale['title'] ?>-->
              <!--    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>-->
              <!--</a>-->
              <!--<div class="collapse" id="pagesCollapseError10" aria-labelledby="headingOne"-->
              <!--     data-parent="#sidenavAccordionPages">-->
              <!--    <nav class="sb-sidenav-menu-nested nav nav accordion" id="sidenavAccordionPages" >-->

              <!--***************Médecin***********************-->
              <?php
              if ($lvl == 4 || $lvl == 5 || $lvl == 7 || $lvl == 11) {
              ?>

                <a class="nav-link collapsed" href="<?= $medecin['option2_link'] ?>" aria-expanded="false"
                  aria-controls="pagesCollapseError">
                  <div class="sb-nav-link-icon"><i class="<?= $medecin['icon'] ?>"></i></div>
                  <?= $medecin['title'] ?>
                </a>
              <?php } ?>

              <!--***************Nurse***********************-->
              <?php
              if ($lvl == 3 || $lvl == 4 || $lvl == 7 || $lvl == 11) {
              ?>

                <a class="nav-link collapsed" href="<?= $nurse['option2_link'] ?>" aria-expanded="false"
                  aria-controls="pagesCollapseError">
                  <div class="sb-nav-link-icon"><i class="<?= $nurse['icon'] ?>"></i></div>
                  <?= $nurse['title'] ?>
                </a>
              <?php } ?>


              <!--***************chirugien***********************-->
              <?php
              if ($lvl == 4 || $lvl == 8 || $lvl == 7 || $lvl == 11) {
              ?>

                <a class="nav-link collapsed" href="<?= $chirugien['option2_link'] ?>" aria-expanded="false"
                  aria-controls="pagesCollapseError">
                  <div class="sb-nav-link-icon"><i class="<?= $chirugien['icon'] ?>"></i></div>
                  <?= $chirugien['title'] ?>
                </a>
              <?php } ?>


              <!--***************laboratin***********************-->
              <?php
              if ($lvl == 4 || $lvl == 9 || $lvl == 7 || $lvl == 11) {
              ?>


                <a class="nav-link collapsed" href="<?= $laboratin['option2_link'] ?>" aria-expanded="false"
                  aria-controls="pagesCollapseError">
                  <div class="sb-nav-link-icon"><i class="<?= $laboratin['icon'] ?>"></i></div>
                  <?= $laboratin['title'] ?>
                </a>

              <?php } ?>

              <!--***************radiologue***********************-->
              <?php
              if ($lvl == 0) {
              ?>

                <a class="nav-link collapsed" href="<?= $radiologue['option2_link'] ?>" aria-expanded="false"
                  aria-controls="pagesCollapseError">
                  <div class="sb-nav-link-icon"><i class="<?= $radiologue['icon'] ?>"></i></div>
                  <?= $radiologue['title'] ?>
                </a>

              <?php } ?>



              <!--    </nav>-->
              <!--</div>-->
            <?php
            }
            ?>

            <?php
            if ($lvl == 4  || $lvl == 7 || $lvl == 11) {
            ?>
              <a class="nav-link collapsed" href="<?= $personnel['option2_link'] ?>" aria-expanded="false"
                aria-controls="pagesCollapseError">
                <div class="sb-nav-link-icon"><i class="<?= $personnel['icon'] ?>"></i></div>
                <?= $personnel['title'] ?>
              </a>
              <!--***************personnel***********************-->
              <!--                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError11"-->
              <!--                               aria-expanded="false" aria-controls="pagesCollapseError">-->
              <!--                                <div class="sb-nav-link-icon"><i class="--><? //= $generaliste['icon'] 
                                                                                              ?><!--"></i></div>-->
              <!--                                --><? //= $generaliste['title'] 
                                                      ?>
              <!--                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>-->
              <!--                            </a>-->
              <!--                            <div class="collapse" id="pagesCollapseError11" aria-labelledby="headingOne"-->
              <!--                                 data-parent="#sidenavAccordionPages">-->
              <!--                                <nav class="sb-sidenav-menu-nested nav nav accordion" id="sidenavAccordionPages" >-->
              <!---->
              <!---->
              <!--                                   -->
              <!--                                </nav>-->
              <!--                            </div>-->
            <?php
            }
            ?>
            <!--    </nav>-->
            <!--</div>-->
          <?php } ?>




          <?php

          if ($lvl == 3 || $lvl == 2 || $lvl == 5 || $lvl == 15) {
          ?>
            <!--***************Patient***********************-->
            <a class="nav-link collapsed" href="<?= $patient['option2_link'] ?>" aria-expanded="false"
              aria-controls="pagesCollapseError">
              <div class="sb-nav-link-icon"><i class="<?= $patient['icon'] ?>"></i></div>
              <?= $patient['title'] ?>
            </a>
          <?php
          }
          ?>



          <?php
          if ($lvl != 10 and $lvl != 3 and $lvl != 2  and $lvl != 5 and $lvl != 15) {
          ?>
            <!--<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2"-->
            <!--   aria-expanded="false" aria-controls="collapsePages">-->
            <!--    <div class="sb-nav-link-icon"><i class="<?= $entite['icon'] ?>"></i></div>-->
            <!--    <?= $entite['title'] ?>-->
            <!--    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>-->
            <!--</a>-->
            <!--<div class="collapse" id="collapsePages2" aria-labelledby="headingOne"-->
            <!--     data-parent="#sidenavAccordion">-->
            <!--    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">-->

            <!--***************Patient***********************-->
            <?php
            if ($lvl != 6) {
            ?>

              <a class="nav-link collapsed" href="<?= $patient['option2_link'] ?>" aria-expanded="false"
                aria-controls="pagesCollapseError">
                <div class="sb-nav-link-icon"><i class="<?= $patient['icon'] ?>"></i></div>
                <?= $patient['title'] ?>
              </a>
            <?php
            }
            ?>

            <?php
            /// if($lvl == 4 || $lvl == 7  ){
            ?>

            <!--<a class="nav-link collapsed" href="<?= $entreprise['option2_link'] ?>" aria-expanded="false"-->
            <!--   aria-controls="pagesCollapseError">-->
            <!--    <div class="sb-nav-link-icon"><i class="<?= $entreprise['icon'] ?>"></i></div>-->
            <!--    <?= $entreprise['title'] ?>-->
            <!--</a>-->

            <!--<a class="nav-link collapsed" href="<?= $assurances['option2_link'] ?>" aria-expanded="false"-->
            <!--   aria-controls="pagesCollapseError">-->
            <!--    <div class="sb-nav-link-icon"><i class="<?= $assurances['icon'] ?>"></i></div>-->
            <!--    <?= $assurances['title'] ?>-->
            <!--</a>-->
            <?php
            //    }
            ?>


            <!--***************Fournisseurs***********************-->
            <?php
            if ($lvl == 4 || $lvl == 6 || $lvl == 7 || $lvl == 11) {
            ?>

              <a class="nav-link collapsed" href="<?= $fournisseur['option2_link'] ?>"
                aria-expanded="false"
                aria-controls="pagesCollapseError">
                <div class="sb-nav-link-icon"><i class="<?= $fournisseur['icon'] ?>"></i></div>
                <?= $fournisseur['title'] ?>
              </a>
            <?php
            }
            ?>

            <!--    </nav>-->
            <!--</div>-->
          <?php
          }
          ?>





          <!--***************Appointment***********************-->
          <?php
          if ($lvl != 2 and $lvl != 6 and $lvl != 10 and $lvl != 11 and $lvl != 2) {
          ?>

            <a class="nav-link collapsed" href="<?= $appointment['option2_link'] ?>" aria-expanded="false"
              aria-controls="pagesCollapseError">
              <div class="sb-nav-link-icon"><i class="<?= $appointment['icon'] ?>"></i></div>
              <?= $appointment['title'] ?>
            </a>
          <?php
          }
          ?>

          <?php
          if ($lvl == 3 || $lvl == 2 || $lvl == 5 || $lvl == 9 || $lvl == 14 || $lvl == 15) {
          ?>


            <?php if ($lvl == 3 || $lvl == 5 || $lvl == 2 || $lvl == 15) { ?>
              <!--***************consultation***********************-->

              <!-- <a class="nav-link collapsed" href="<?= $consultation['option2_link'] ?>" aria-expanded="false"
                                aria-controls="pagesCollapseError">
                                <div class="sb-nav-link-icon"><i class="<?= $consultation['icon'] ?>"></i></div>
                                <?= $consultation['title'] ?>
                            </a> -->
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesCons"
                aria-expanded="false" aria-controls="collapsePages">
                <div class="sb-nav-link-icon"><i class="<?= $consultation['icon'] ?>"></i></div>
                <?= $consultation['title'] ?>
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
              </a>
              <div class="collapse" id="collapsePagesCons" aria-labelledby="headingOne">
                <nav class="sb-sidenav-menu-nested nav accordion">
                  <!-- ajouter -->
                  <a href="<?= $consultation['option1_link'] ?>"
                    class="nav-link"><?= $consultation['option1_name'] ?></a>
                  <!-- liste -->
                  <a href="<?= $consultation['option2_link'] ?>"
                    class="nav-link"><?= $consultation['option2_name'] ?></a>

                </nav>
              </div>




              <!--***************Hospitalisation***********************-->

              <a class="nav-link collapsed" href="<?= $hospitalisation['option2_link'] ?>" aria-expanded="false"
                aria-controls="pagesCollapseError">
                <div class="sb-nav-link-icon"><i class="<?= $hospitalisation['icon'] ?>"></i></div>
                <?= $hospitalisation['title'] ?>
              </a>
            <?php } ?>

            <?php if ($lvl == 3 || $lvl == 5 || $lvl == 2 || $lvl == 9 || $lvl == 15) { ?>
              <!--***************Examen***********************-->
              <!-- <a class="nav-link collapsed" href="<?= $examen['option2_link'] ?>" aria-expanded="false"
                                aria-controls="pagesCollapseError">
                                <div class="sb-nav-link-icon"><i class="<?= $examen['icon'] ?>"></i></div>
                                <?= $examen['title'] ?>
                            </a> -->
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesExams"
                aria-expanded="false" aria-controls="collapsePages">
                <div class="sb-nav-link-icon"><i class="<?= $examen['icon'] ?>"></i></div>
                <?= $examen['title'] ?>
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
              </a>
              <div class="collapse" id="collapsePagesExams" aria-labelledby="headingOne">
                <nav class="sb-sidenav-menu-nested nav accordion">
                  <!-- ajouter -->
                  <a href="<?= $examen['option1_link'] ?>"
                    class="nav-link"><?= $examen['option1_name'] ?></a>
                  <!-- liste -->
                  <a href="<?= $examen['option2_link'] ?>"
                    class="nav-link"><?= $examen['option2_name'] ?></a>

                </nav>
              </div>
            <?php } ?>

            <?php if ($lvl == 3 || $lvl == 5 || $lvl == 2  || $lvl == 14 || $lvl == 15) { ?>
              <!--***************Radiologie***********************-->
              <a class="nav-link collapsed" href="<?= $radiologie['option2_link'] ?>" aria-expanded="false"
                aria-controls="pagesCollapseError">
                <div class="sb-nav-link-icon"><i class="<?= $radiologie['icon'] ?>"></i></div>
                <?= $radiologie['title'] ?>
              </a>
            <?php } ?>

            <!--***************Opérations***********************-->

            <?php if ($lvl == 3 || $lvl == 5 || $lvl == 2 || $lvl == 15) { ?>
              <?php if ($lvl != 3) { ?>
                <a class="nav-link collapsed" href="<?= $operation['option2_link'] ?>" aria-expanded="false"
                  aria-controls="pagesCollapseError">
                  <div class="sb-nav-link-icon"><i class="<?= $operation['icon'] ?>"></i></div>
                  <?= $operation['title'] ?>
                </a>
                <!--*****************anesthésie*********************-->

                <a class="nav-link collapsed" href="<?= $anesthesie['option2_link'] ?>" aria-expanded="false"
                  aria-controls="pagesCollapseError">
                  <div class="sb-nav-link-icon"><i class="<?= $anesthesie['icon'] ?>"></i></div>
                  <?= $anesthesie['title'] ?>
                </a>
              <?php } ?>

              <?php if ($lvl == 5 || $lvl == 3) { ?>
                <!--***************Vaccination***********************-->
                <a class="nav-link collapsed" href="<?= $vaccination['option2_link'] ?>" aria-expanded="false"
                  aria-controls="pagesCollapseError">
                  <div class="sb-nav-link-icon"><i class="<?= $vaccination['icon'] ?>"></i></div>
                  <?= $vaccination['title'] ?>
                </a>

                <!--***************Prénatale***********************-->
                <a class="nav-link collapsed" href="<?= $prenatale['option2_link'] ?>" aria-expanded="false"
                  aria-controls="pagesCollapseError">
                  <div class="sb-nav-link-icon"><i class="<?= $prenatale['icon'] ?>"></i></div>
                  <?= $prenatale['title'] ?>
                </a>
              <?php } ?>
              <!--*****************Ecographie*********************-->

              <!-- <a class="nav-link collapsed" href="<?= $ecographie['option2_link'] ?>" aria-expanded="false"
                                aria-controls="pagesCollapseError">
                                <div class="sb-nav-link-icon"><i class="<?= $ecographie['icon'] ?>"></i></div>
                                <?= $ecographie['title'] ?>
                            </a> -->

              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesEcos"
                aria-expanded="false" aria-controls="collapsePages">
                <div class="sb-nav-link-icon"><i class="<?= $ecographie['icon'] ?>"></i></div>
                <?= $ecographie['title'] ?>
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
              </a>
              <div class="collapse" id="collapsePagesEcos" aria-labelledby="headingOne">
                <nav class="sb-sidenav-menu-nested nav accordion">
                  <!-- ajouter -->
                  <a href="<?= $ecographie['option1_link'] ?>"
                    class="nav-link"><?= $ecographie['option1_name'] ?></a>
                  <!-- liste -->
                  <a href="<?= $ecographie['option2_link'] ?>"
                    class="nav-link"><?= $ecographie['option2_name'] ?></a>

                </nav>
              </div>


              <!-- <a class="nav-link collapsed" href="<?= $autreServices['option2_link'] ?>" aria-expanded="false"
                                aria-controls="pagesCollapseError">
                                <div class="sb-nav-link-icon"><i class="<?= $autreServices['icon'] ?>"></i></div>
                                <?= $autreServices['title'] ?>
                            </a> -->
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesAutresServices"
                aria-expanded="false" aria-controls="collapsePages">
                <div class="sb-nav-link-icon"><i class="<?= $autres_services['icon'] ?>"></i></div>
                <?= $autres_services['title'] ?>
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
              </a>
              <div class="collapse" id="collapsePagesAutresServices" aria-labelledby="headingOne">
                <nav class="sb-sidenav-menu-nested nav accordion">
                  <!-- ajouter -->
                  <a href="<?= $autres_services['option1_link'] ?>"
                    class="nav-link"><?= $autres_services['option1_name'] ?></a>
                  <!-- liste -->
                  <a href="<?= $autres_services['option2_link'] ?>"
                    class="nav-link"><?= $autres_services['option2_name'] ?></a>

                </nav>
              </div>
            <?php } ?>
          <?php
          }
          ?>


          <?php
          if ($lvl != 10  and $lvl != 6 and $lvl != 1 and $lvl != 11 and $lvl != 3  and $lvl != 2 and $lvl != 5 and $lvl != 9 and $lvl != 14 and $lvl != 15) {
          ?>
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages5"
              aria-expanded="false" aria-controls="collapsePages">
              <div class="sb-nav-link-icon"><i class="<?= $service['icon'] ?>"></i></div>
              <?= $service['title'] ?>
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePages5" aria-labelledby="headingOne"
              data-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">

                <!--***************consultation***********************-->
                <?php
                if ($lvl != 9 and $lvl != 8) {
                ?>
                  <!-- <a class="nav-link collapsed" href="<?= $consultation['option2_link'] ?>" aria-expanded="false"
                                        aria-controls="pagesCollapseError">
                                        <div class="sb-nav-link-icon"><i class="<?= $consultation['icon'] ?>"></i></div>
                                        <?= $consultation['title'] ?>
                                    </a> -->

                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesCons"
                    aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="<?= $consultation['icon'] ?>"></i></div>
                    <?= $consultation['title'] ?>
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="collapsePagesCons" aria-labelledby="headingOne">
                    <nav class="sb-sidenav-menu-nested nav accordion">
                      <!-- ajouter -->
                      <a href="<?= $consultation['option1_link'] ?>"
                        class="nav-link"><?= $consultation['option1_name'] ?></a>
                      <!-- liste -->
                      <a href="<?= $consultation['option2_link'] ?>"
                        class="nav-link"><?= $consultation['option2_name'] ?></a>

                    </nav>
                  </div>
                <?php } ?>


                <!--***************Examen***********************-->
                <?php
                if ($lvl == 2 || $lvl == 9 || $lvl == 4 || $lvl == 7 ||  $lvl == 5 ||  $lvl == 11 ||  $lvl == 12 || $lvl == 14) {
                ?>


                  <!-- <a class="nav-link collapsed" href="<?= $examen['option2_link'] ?>" aria-expanded="false"
                                        aria-controls="pagesCollapseError">
                                        <div class="sb-nav-link-icon"><i class="<?= $examen['icon'] ?>"></i></div>
                                        <?= $examen['title'] ?>
                                    </a> -->
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesExams"
                    aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="<?= $examen['icon'] ?>"></i></div>
                    <?= $examen['title'] ?>
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="collapsePagesExams" aria-labelledby="headingOne">
                    <nav class="sb-sidenav-menu-nested nav accordion">
                      <!-- ajouter -->
                      <a href="<?= $examen['option1_link'] ?>"
                        class="nav-link"><?= $examen['option1_name'] ?></a>
                      <!-- liste -->
                      <a href="<?= $examen['option2_link'] ?>"
                        class="nav-link"><?= $examen['option2_name'] ?></a>

                    </nav>
                  </div>

                <?php } ?>

                <!--***************Radiologie***********************-->
                <?php
                if ($lvl != 9 and $lvl != 8 and $lvl != 14) {
                ?>
                  <!-- <a class="nav-link collapsed" href="<?= $radiologie['option2_link'] ?>" aria-expanded="false"
                                        aria-controls="pagesCollapseError">
                                        <div class="sb-nav-link-icon"><i class="<?= $radiologie['icon'] ?>"></i></div>
                                        <?= $radiologie['title'] ?>
                                    </a> -->

                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesRads"
                    aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="<?= $radiologie['icon'] ?>"></i></div>
                    <?= $radiologie['title'] ?>
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="collapsePagesRads" aria-labelledby="headingOne">
                    <nav class="sb-sidenav-menu-nested nav accordion">
                      <!-- ajouter -->
                      <a href="<?= $radiologie['option1_link'] ?>"
                        class="nav-link"><?= $radiologie['option1_name'] ?></a>
                      <!-- liste -->
                      <a href="<?= $radiologie['option2_link'] ?>"
                        class="nav-link"><?= $radiologie['option2_name'] ?></a>

                    </nav>
                  </div>

                <?php } ?>

                <?php
                if ($lvl != 9 and $lvl != 8 and $lvl != 14) {
                ?>

                  <!--***************Hospitalisation***********************-->

                  <!-- <a class="nav-link collapsed" href="<?= $hospitalisation['option2_link'] ?>" aria-expanded="false"
                                        aria-controls="pagesCollapseError">
                                        <div class="sb-nav-link-icon"><i class="<?= $hospitalisation['icon'] ?>"></i></div>
                                        <?= $hospitalisation['title'] ?>
                                    </a> -->

                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesHos"
                    aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="<?= $hospitalisation['icon'] ?>"></i></div>
                    <?= $hospitalisation['title'] ?>
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="collapsePagesHos" aria-labelledby="headingOne">
                    <nav class="sb-sidenav-menu-nested nav accordion">
                      <!-- ajouter -->
                      <a href="<?= $hospitalisation['option1_link'] ?>"
                        class="nav-link"><?= $hospitalisation['option1_name'] ?></a>
                      <!-- liste -->
                      <a href="<?= $hospitalisation['option2_link'] ?>"
                        class="nav-link"><?= $hospitalisation['option2_name'] ?></a>

                    </nav>
                  </div>
                <?php } ?>

                <?php
                if ($lvl != 9 and $lvl != 3 and $lvl != 14) {
                ?>

                  <!--***************Opérations***********************-->

                  <!-- <a class="nav-link collapsed" href="<?= $operation['option2_link'] ?>" aria-expanded="false"
                                        aria-controls="pagesCollapseError">
                                        <div class="sb-nav-link-icon"><i class="<?= $operation['icon'] ?>"></i></div>
                                        <?= $operation['title'] ?>
                                    </a> -->
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesOpes"
                    aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="<?= $operation['icon'] ?>"></i></div>
                    <?= $operation['title'] ?>
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="collapsePagesOpes" aria-labelledby="headingOne">
                    <nav class="sb-sidenav-menu-nested nav accordion">
                      <!-- ajouter -->
                      <a href="<?= $operation['option1_link'] ?>"
                        class="nav-link"><?= $operation['option1_name'] ?></a>
                      <!-- liste -->
                      <a href="<?= $operation['option2_link'] ?>"
                        class="nav-link"><?= $operation['option2_name'] ?></a>

                    </nav>
                  </div>
                  <!--*****************anesthésie*********************-->

                  <!-- <a class="nav-link collapsed" href="<?= $anesthesie['option2_link'] ?>" aria-expanded="false"
                                        aria-controls="pagesCollapseError">
                                        <div class="sb-nav-link-icon"><i class="<?= $anesthesie['icon'] ?>"></i></div>
                                        <?= $anesthesie['title'] ?>
                                    </a> -->
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesAnest"
                    aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="<?= $anesthesie['icon'] ?>"></i></div>
                    <?= $anesthesie['title'] ?>
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="collapsePagesAnest" aria-labelledby="headingOne">
                    <nav class="sb-sidenav-menu-nested nav accordion">
                      <!-- ajouter -->
                      <a href="<?= $anesthesie['option1_link'] ?>"
                        class="nav-link"><?= $anesthesie['option1_name'] ?></a>
                      <!-- liste -->
                      <a href="<?= $anesthesie['option2_link'] ?>"
                        class="nav-link"><?= $anesthesie['option2_name'] ?></a>

                    </nav>
                  </div>
                  <!--*****************Ecographie*********************-->

                  <!-- <a class="nav-link collapsed" href="<?= $ecographie['option2_link'] ?>" aria-expanded="false"
                                        aria-controls="pagesCollapseError">
                                        <div class="sb-nav-link-icon"><i class="<?= $ecographie['icon'] ?>"></i></div>
                                        <?= $ecographie['title'] ?>
                                    </a> -->
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesEcos"
                    aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="<?= $ecographie['icon'] ?>"></i></div>
                    <?= $ecographie['title'] ?>
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="collapsePagesEcos" aria-labelledby="headingOne">
                    <nav class="sb-sidenav-menu-nested nav accordion">
                      <!-- ajouter -->
                      <a href="<?= $ecographie['option1_link'] ?>"
                        class="nav-link"><?= $ecographie['option1_name'] ?></a>
                      <!-- liste -->
                      <a href="<?= $ecographie['option2_link'] ?>"
                        class="nav-link"><?= $ecographie['option2_name'] ?></a>

                    </nav>
                  </div>

                  <!-- <a class="nav-link collapsed" href="<?= $autreServices['option2_link'] ?>" aria-expanded="false"
                                        aria-controls="pagesCollapseError">
                                        <div class="sb-nav-link-icon"><i class="<?= $autreServices['icon'] ?>"></i></div>
                                        <?= $autreServices['title'] ?>
                                    </a> -->

                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesAutresServices"
                    aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="<?= $autres_services['icon'] ?>"></i></div>
                    <?= $autres_services['title'] ?>
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="collapsePagesAutresServices" aria-labelledby="headingOne">
                    <nav class="sb-sidenav-menu-nested nav accordion">
                      <!-- ajouter -->
                      <a href="<?= $autres_services['option1_link'] ?>"
                        class="nav-link"><?= $autres_services['option1_name'] ?></a>
                      <!-- liste -->
                      <a href="<?= $autres_services['option2_link'] ?>"
                        class="nav-link"><?= $autres_services['option2_name'] ?></a>

                    </nav>
                  </div>

                  <?php if ($lvl == 4 || $lvl == 7) { ?>
                    <!--***************Vaccination***********************-->
                    <a class="nav-link collapsed" href="<?= $vaccination['option2_link'] ?>" aria-expanded="false"
                      aria-controls="pagesCollapseError">
                      <div class="sb-nav-link-icon"><i class="<?= $vaccination['icon'] ?>"></i></div>
                      <?= $vaccination['title'] ?>
                    </a>

                    <!--***************Prénatale***********************-->
                    <a class="nav-link collapsed" href="<?= $prenatale['option2_link'] ?>" aria-expanded="false"
                      aria-controls="pagesCollapseError">
                      <div class="sb-nav-link-icon"><i class="<?= $prenatale['icon'] ?>"></i></div>
                      <?= $prenatale['title'] ?>
                    </a>
                  <?php } ?>


                <?php } ?>

              </nav>
            </div>
          <?php
          }
          ?>

          <?php
          if ($lvl == 2 || $lvl == 3 || $lvl == 4 || $lvl == 7 || $lvl == 5 || $lvl == 10  || $lvl == 12 || $lvl == 15) {
          ?>
            <!--***************Ordonnance***********************-->

            <!-- <a class="nav-link collapsed" href="<?= $ordonnance['option2_link'] ?>" aria-expanded="false"
                            aria-controls="pagesCollapseError">
                            <div class="sb-nav-link-icon"><i class="<?= $ordonnance['icon'] ?>"></i></div>
                            <?= $ordonnance['title'] ?>
                        </a> -->
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesOrdos"
              aria-expanded="false" aria-controls="collapsePages">
              <div class="sb-nav-link-icon"><i class="<?= $ordonnance['icon'] ?>"></i></div>
              <?= $ordonnance['title'] ?>
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePagesOrdos" aria-labelledby="headingOne">
              <nav class="sb-sidenav-menu-nested nav accordion">
                <!-- ajouter -->
                <a href="<?= $ordonnance['option1_link'] ?>"
                  class="nav-link"><?= $ordonnance['option1_name'] ?></a>
                <!-- liste -->
                <a href="<?= $ordonnance['option2_link'] ?>"
                  class="nav-link"><?= $ordonnance['option2_name'] ?></a>

              </nav>
            </div>
          <?php
          }
          ?>



          <?php
          if ($lvl == 2 || $lvl == 4 ||  $lvl == 7 || $lvl == 11 || $lvl == 12) {
          ?>

            <!---------------********************* REGLEMENT ********************----------------->

            <!-- <div class="sb-sidenav-menu-heading">Mon Espace</div> -->
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages6"
              aria-expanded="false" aria-controls="collapsePages">
              <div class="sb-nav-link-icon"><i class="<?= $liste_fact['icon'] ?>"></i></div>
              <?= $liste_fact['title'] ?>
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePages6" aria-labelledby="headingOne"
              data-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">

                <a href="<?= $liste_fact['option1_link'] ?>"
                  class="nav-link"><?= $liste_fact['option1_name'] ?></a>
                <a href="<?= $liste_fact['option2_link'] ?>"
                  class="nav-link"><?= $liste_fact['option2_name'] ?></a>
                <a href="<?= $liste_fact['option3_link'] ?>"
                  class="nav-link"><?= $liste_fact['option3_name'] ?></a>
                <a href="<?= $liste_fact['option4_link'] ?>"
                  class="nav-link"><?= $liste_fact['option4_name'] ?></a>
                <a href="<?= $liste_fact['option5_link'] ?>"
                  class="nav-link"><?= $liste_fact['option5_name'] ?></a>
                <a href="<?= $liste_fact['option6_link'] ?>"
                  class="nav-link"><?= $liste_fact['option6_name'] ?></a>
                <a href="<?= $liste_fact['option7_link'] ?>"
                  class="nav-link"><?= $liste_fact['option7_name'] ?></a>
                <a href="<?= $liste_fact['option8_link'] ?>"
                  class="nav-link"><?= $liste_fact['option8_name'] ?></a>
                <a href="<?= $liste_fact['option9_link'] ?>"
                  class="nav-link"><?= $liste_fact['option9_name'] ?></a>
                <a href="<?= $liste_fact['option10_link'] ?>"
                  class="nav-link"><?= $liste_fact['option10_name'] ?></a>
                <a href="<?= $liste_fact['option11_link'] ?>"
                  class="nav-link"><?= $liste_fact['option11_name'] ?></a>

              </nav>
            </div>
            <!---------------********************* REGLEMENT ********************----------------->

            <!-- <div class="sb-sidenav-menu-heading">Mon Espace</div> -->
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages60"
              aria-expanded="false" aria-controls="collapsePages">
              <div class="sb-nav-link-icon"><i class="<?= $archives['icon'] ?>"></i></div>
              <?= $archives['title'] ?>
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePages60" aria-labelledby="headingOne"
              data-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">

                <a href="<?= $archives['option1_link'] ?>"
                  class="nav-link"><?= $archives['option1_name'] ?></a>
                <a href="<?= $archives['option2_link'] ?>"
                  class="nav-link"><?= $archives['option2_name'] ?></a>
                <a href="<?= $archives['option3_link'] ?>"
                  class="nav-link"><?= $archives['option3_name'] ?></a>
                <a href="<?= $archives['option4_link'] ?>"
                  class="nav-link"><?= $archives['option4_name'] ?></a>
                <a href="<?= $archives['option5_link'] ?>"
                  class="nav-link"><?= $archives['option5_name'] ?></a>
                <a href="<?= $archives['option6_link'] ?>"
                  class="nav-link"><?= $archives['option6_name'] ?></a>
                <a href="<?= $archives['option7_link'] ?>"
                  class="nav-link"><?= $archives['option7_name'] ?></a>
                <a href="<?= $archives['option8_link'] ?>"
                  class="nav-link"><?= $archives['option8_name'] ?></a>
                <a href="<?= $archives['option9_link'] ?>"
                  class="nav-link"><?= $archives['option9_name'] ?></a>
                <a href="<?= $archives['option10_link'] ?>"
                  class="nav-link"><?= $archives['option10_name'] ?></a>
                <a href="<?= $archives['option11_link'] ?>"
                  class="nav-link"><?= $archives['option11_name'] ?></a>

              </nav>
            </div>
          <?php
          }
          ?>

          <!--                   ROLE MAGASINIER-->
          <?php
          if ($lvl == 2) {
          ?>
            <!--***************Produits***********************-->

            <a class="nav-link collapsed" href="<?= $produit['option2_link'] ?>" aria-expanded="false"
              aria-controls="pagesCollapseError">
              <div class="sb-nav-link-icon"><i class="<?= $produit['icon'] ?>"></i></div>
              <?= $produit['title'] ?>
            </a>

          <?php
          }
          ?>
          <?php
          if ($lvl == 4 || $lvl == 6) {
          ?>




            <!--***************Produits***********************-->

            <a class="nav-link collapsed" href="<?= $produit['option2_link'] ?>" aria-expanded="false"
              aria-controls="pagesCollapseError">
              <div class="sb-nav-link-icon"><i class="<?= $produit['icon'] ?>"></i></div>
              <?= $produit['title'] ?>
            </a>

            <!--***************Categories***********************-->

            <a class="nav-link collapsed" href="<?= $cat_prod['option2_link'] ?>" aria-expanded="false"
              aria-controls="pagesCollapseError">
              <div class="sb-nav-link-icon"><i class="<?= $cat_prod['icon'] ?>"></i></div>
              <?= $cat_prod['title'] ?>
            </a>

            <!--***************Categories***********************-->

            <!-- <a class="nav-link collapsed" href="<?= $four_prod['option2_link'] ?>" aria-expanded="false"
                               aria-controls="pagesCollapseError">
                                <div class="sb-nav-link-icon"><i class="<?= $four_prod['icon'] ?>"></i></div>
                                <?= $four_prod['title'] ?>
                            </a> -->

            <!--***************Magasin***********************-->

            <a class="nav-link collapsed" href="<?= $mag_centrale['option2_link'] ?>"
              aria-expanded="false"
              aria-controls="pagesCollapseError">
              <div class="sb-nav-link-icon"><i class="<?= $mag_centrale['icon'] ?>"></i></div>
              <?= $mag_centrale['title'] ?>
            </a>
            <!--***************Pharmacie***********************-->

            <a class="nav-link collapsed" href="<?= $mag_phar['option2_link'] ?>" aria-expanded="false"
              aria-controls="pagesCollapseError">
              <div class="sb-nav-link-icon"><i class="<?= $mag_phar['icon'] ?>"></i></div>
              <?= $mag_phar['title'] ?>
            </a>
            <!--***************Commande***********************-->

            <a class="nav-link collapsed" href="<?= $commande['option2_link'] ?>" aria-expanded="false"
              aria-controls="pagesCollapseError">
              <div class="sb-nav-link-icon"><i class="<?= $commande['icon'] ?>"></i></div>
              <?= $commande['title'] ?>
            </a>

            <!--***************DEMANDE PRODUIT***********************-->

            <a class="nav-link collapsed" href="<?= $demande_produit['option2_link'] ?>" aria-expanded="false"
              aria-controls="pagesCollapseError">
              <div class="sb-nav-link-icon"><i class="<?= $demande_produit['icon'] ?>"></i></div>
              <?= $demande_produit['title'] ?>
            </a>
          <?php
          }
          ?>
          <!--                    PPP-->

          <?php
          if ($lvl == 4  ||  $lvl == 10 || $lvl == 11) {
          ?>

            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages3"
              aria-expanded="false" aria-controls="collapsePages">
              <div class="sb-nav-link-icon"><i class="<?= $mag['icon'] ?>"></i></div>
              <?= $mag['title'] ?>
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePages3" aria-labelledby="headingOne"
              data-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">



                <!--***************Produits***********************-->

                <a class="nav-link collapsed" href="<?= $produit['option2_link'] ?>" aria-expanded="false"
                  aria-controls="pagesCollapseError">
                  <div class="sb-nav-link-icon"><i class="<?= $produit['icon'] ?>"></i></div>
                  <?= $produit['title'] ?>
                </a>
                <?php
                if ($lvl == 4 ||  $lvl == 10) {
                ?>

                  <!--***************Categories***********************-->

                  <a class="nav-link collapsed" href="<?= $cat_prod['option2_link'] ?>" aria-expanded="false"
                    aria-controls="pagesCollapseError">
                    <div class="sb-nav-link-icon"><i class="<?= $cat_prod['icon'] ?>"></i></div>
                    <?= $cat_prod['title'] ?>
                  </a>
                <?php } ?>

                <!--***************Categories***********************-->

                <!-- <a class="nav-link collapsed" href="<?= $four_prod['option2_link'] ?>" aria-expanded="false"
                               aria-controls="pagesCollapseError">
                                <div class="sb-nav-link-icon"><i class="<?= $four_prod['icon'] ?>"></i></div>
                                <?= $four_prod['title'] ?>
                            </a> -->
                <?php
                if ($lvl == 4 || $lvl == 11) {
                ?>
                  <!--***************Magasin***********************-->

                  <a class="nav-link collapsed" href="<?= $mag_centrale['option2_link'] ?>"
                    aria-expanded="false"
                    aria-controls="pagesCollapseError">
                    <div class="sb-nav-link-icon"><i class="<?= $mag_centrale['icon'] ?>"></i></div>
                    <?= $mag_centrale['title'] ?>
                  </a>
                <?php } ?>

                <?php
                if ($lvl == 4 || $lvl == 10 || $lvl == 11) {
                ?>
                  <!--***************Pharmacie***********************-->

                  <a class="nav-link collapsed" href="<?= $mag_phar['option2_link'] ?>" aria-expanded="false"
                    aria-controls="pagesCollapseError">
                    <div class="sb-nav-link-icon"><i class="<?= $mag_phar['icon'] ?>"></i></div>
                    <?= $mag_phar['title'] ?>
                  </a>

                <?php } ?>
                <!--***************Commande***********************-->
                <?php
                if ($lvl == 4 || $lvl == 11) {
                ?>

                  <a class="nav-link collapsed" href="<?= $commande['option2_link'] ?>" aria-expanded="false"
                    aria-controls="pagesCollapseError">
                    <div class="sb-nav-link-icon"><i class="<?= $commande['icon'] ?>"></i></div>
                    <?= $commande['title'] ?>
                  </a>
                <?php } ?>

                <?php
                if ($lvl == 4 || $lvl == 10) {
                ?>

                  <!--***************DEMANDE PRODUIT***********************-->

                  <a class="nav-link collapsed" href="<?= $demande_produit['option2_link'] ?>" aria-expanded="false"
                    aria-controls="pagesCollapseError">
                    <div class="sb-nav-link-icon"><i class="<?= $demande_produit['icon'] ?>"></i></div>
                    <?= $demande_produit['title'] ?>
                  </a>
                <?php } ?>
              </nav>
            </div>
          <?php
          }
          ?>

          <?php
          if ($lvl == 2) {
          ?>

            <!--***************Transfert-Caisse***********************-->


            <a class="nav-link collapsed" href="<?= $caisse['option2_link'] ?>" aria-expanded="false"
              aria-controls="pagesCollapseError">
              <div class="sb-nav-link-icon"><i class="<?= $caisse['icon'] ?>"></i></div>
              <?= $caisse['title'] ?>
            </a>

            <!--***************Dépense-Caisse***********************-->

            <a class="nav-link collapsed" href="<?= $depense_caisse['option2_link'] ?>" aria-expanded="false"
              aria-controls="pagesCollapseError">
              <div class="sb-nav-link-icon"><i class="<?= $depense_caisse['icon'] ?>"></i></div>
              <?= $depense_caisse['title'] ?>
            </a>

            <!--***************Caution***********************-->


            <a class="nav-link collapsed" href="<?= $caution['option2_link'] ?>" aria-expanded="false"
              aria-controls="pagesCollapseError">
              <div class="sb-nav-link-icon"><i class="<?= $caution['icon'] ?>"></i></div>
              <?= $caution['title'] ?>
            </a>

          <?php } ?>

          <?php if ($lvl != 15) { ?>


            <!--##################### -Fourniture-####################-->
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesFour"
              aria-expanded="false" aria-controls="collapsePages">
              <div class="sb-nav-link-icon"><i class="<?= $fourniture['icon'] ?>"></i></div>
              <?= $fourniture['title'] ?>
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePagesFour" aria-labelledby="headingOne"
              data-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                <?php if ($lvl == 4 || $lvl == 7 || $lvl == 6) { ?>

                  <!--***************Outils***********************-->

                  <a class="nav-link collapsed" href="<?= $outil['option2_link'] ?>" aria-expanded="false"
                    aria-controls="pagesCollapseError">
                    <div class="sb-nav-link-icon"><i class="<?= $outil['icon'] ?>"></i></div>
                    <?= $outil['title'] ?>
                  </a>

                  <!--***************catégorie outil***********************-->

                  <a class="nav-link collapsed" href="<?= $cat_outil['option2_link'] ?>" aria-expanded="false"
                    aria-controls="pagesCollapseError">
                    <div class="sb-nav-link-icon"><i class="<?= $cat_outil['icon'] ?>"></i></div>
                    <?= $cat_outil['title'] ?>
                  </a>

                  <!--***************magasin outil***********************-->

                  <a class="nav-link collapsed" href="<?= $mag_outil['option2_link'] ?>" aria-expanded="false"
                    aria-controls="pagesCollapseError">
                    <div class="sb-nav-link-icon"><i class="<?= $mag_outil['icon'] ?>"></i></div>
                    <?= $mag_outil['title'] ?>
                  </a>

                  <!--***************commande outil***********************-->

                  <a class="nav-link collapsed" href="<?= $commande_outil['option2_link'] ?>" aria-expanded="false"
                    aria-controls="pagesCollapseError">
                    <div class="sb-nav-link-icon"><i class="<?= $commande_outil['icon'] ?>"></i></div>
                    <?= $commande_outil['title'] ?>
                  </a>
                <?php } ?>
                <!--***************demande outil***********************-->

                <a class="nav-link collapsed" href="<?= $demande_outil['option2_link'] ?>" aria-expanded="false"
                  aria-controls="pagesCollapseError">
                  <div class="sb-nav-link-icon"><i class="<?= $demande_outil['icon'] ?>"></i></div>
                  <?= $demande_outil['title'] ?>
                </a>


              </nav>
            </div>
          <?php } ?>

          <!--end fourniture-->

          <?php
          if ($lvl == 4 ||  $lvl == 7 || $lvl == 11 || $lvl == 12) {
          ?>

            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages30"
              aria-expanded="false" aria-controls="collapsePages">
              <div class="sb-nav-link-icon"><i class="<?= $tresorie['icon'] ?>"></i></div>
              <?= $tresorie['title'] ?>
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePages30" aria-labelledby="headingOne"
              data-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">

                <!--***************Transfert-Caisse***********************-->


                <a class="nav-link collapsed" href="<?= $caisse['option2_link'] ?>" aria-expanded="false"
                  aria-controls="pagesCollapseError">
                  <div class="sb-nav-link-icon"><i class="<?= $caisse['icon'] ?>"></i></div>
                  <?= $caisse['title'] ?>
                </a>


                <?php
                if ($lvl == 4 ||  $lvl == 7 || $lvl == 11 || $lvl == 12) {
                ?>

                  <!--***************Dépense-Caisse***********************-->

                  <a class="nav-link collapsed" href="<?= $depense_caisse['option2_link'] ?>" aria-expanded="false"
                    aria-controls="pagesCollapseError">
                    <div class="sb-nav-link-icon"><i class="<?= $depense_caisse['icon'] ?>"></i></div>
                    <?= $depense_caisse['title'] ?>
                  </a>

                <?php } ?>

                <!--***************Caution***********************-->


                <a class="nav-link collapsed" href="<?= $caution['option2_link'] ?>" aria-expanded="false"
                  aria-controls="pagesCollapseError">
                  <div class="sb-nav-link-icon"><i class="<?= $caution['icon'] ?>"></i></div>
                  <?= $caution['title'] ?>
                </a>

                <!--***************Retrait***********************-->


                <a class="nav-link collapsed" href="<?= $retrait['option2_link'] ?>" aria-expanded="false"
                  aria-controls="pagesCollapseError">
                  <div class="sb-nav-link-icon"><i class="<?= $retrait['icon'] ?>"></i></div>
                  <?= $retrait['title'] ?>
                </a>

              </nav>
            </div>
          <?php
          }
          ?>


          <!--end fourniture-->

          <?php
          if ($lvl == 4 ||  $lvl == 7 || $lvl == 11 || $lvl == 12 || $lvl == 2) {
          ?>

            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages35"
              aria-expanded="false" aria-controls="collapsePages">
              <div class="sb-nav-link-icon"><i class="<?= $rapport['icon'] ?>"></i></div>
              <?= $rapport['title'] ?>
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePages35" aria-labelledby="headingOne"
              data-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">

                <?php
                if ($lvl == 12 || $lvl == 7 || $lvl == 4 || $lvl == 2) {
                ?>
                  <!--***************Rapport-Caisse***********************-->

                  <a class="nav-link collapsed" href="<?= $rapport_caisse['option2_link'] ?>" aria-expanded="false"
                    aria-controls="pagesCollapseError">
                    <div class="sb-nav-link-icon"><i class="<?= $rapport_caisse['icon'] ?>"></i></div>
                    <?= $rapport_caisse['title'] ?>
                  </a>
                  <!--***************Caisses***********************-->

                  <a class="nav-link collapsed" href="<?= $menu_caisse['option2_link'] ?>" aria-expanded="false"
                    aria-controls="pagesCollapseError">
                    <div class="sb-nav-link-icon"><i class="<?= $menu_caisse['icon'] ?>"></i></div>
                    <?= $menu_caisse['title'] ?>
                  </a>


                  <!--***************Rapport-Vente***********************-->

                  <a class="nav-link collapsed" href="<?= $rapport_vente['option2_link'] ?>" aria-expanded="false"
                    aria-controls="pagesCollapseError">
                    <div class="sb-nav-link-icon"><i class="<?= $rapport_vente['icon'] ?>"></i></div>
                    <?= $rapport_vente['title'] ?>
                  </a>

                  <!--***************Rapport-Remise***********************-->

                  <a class="nav-link collapsed" href="<?= $rapport_remise['option2_link'] ?>" aria-expanded="false"
                    aria-controls="pagesCollapseError">
                    <div class="sb-nav-link-icon"><i class="<?= $rapport_remise['icon'] ?>"></i></div>
                    <?= $rapport_remise['title'] ?>
                  </a>






                <?php } ?>

              </nav>
            </div>
          <?php
          }
          ?>

          <?php
          if ($lvl == 4 ||  $lvl == 7 || $lvl == 11 || $lvl == 12) {
          ?>

            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages36"
              aria-expanded="false" aria-controls="collapsePages">
              <div class="sb-nav-link-icon"><i class="<?= $bilan['icon'] ?>"></i></div>
              <?= $bilan['title'] ?>
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePages36" aria-labelledby="headingOne"
              data-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">


                <!--***************Bilan mensuel***********************-->

                <a class="nav-link collapsed" href="<?= $bilan_mensuel['option2_link'] ?>" aria-expanded="false"
                  aria-controls="pagesCollapseError">
                  <div class="sb-nav-link-icon"><i class="<?= $bilan_mensuel['icon'] ?>"></i></div>
                  <?= $bilan_mensuel['title'] ?>
                </a>


                <!--***************Bilan annuel***********************-->

                <a class="nav-link collapsed" href="<?= $bilan_annuel['option2_link'] ?>" aria-expanded="false"
                  aria-controls="pagesCollapseError">
                  <div class="sb-nav-link-icon"><i class="<?= $bilan_annuel['icon'] ?>"></i></div>
                  <?= $bilan_annuel['title'] ?>
                </a>

                <!--***************Bilan vente***********************-->

                <a class="nav-link collapsed" href="<?= $bilan_vente['option2_link'] ?>" aria-expanded="false"
                  aria-controls="pagesCollapseError">
                  <div class="sb-nav-link-icon"><i class="<?= $bilan_vente['icon'] ?>"></i></div>
                  <?= $bilan_vente['title'] ?>
                </a>




              </nav>
            </div>
          <?php
          }
          ?>


          <!--  <div class="sb-sidenav-menu-heading">Tresoreries</div> -->

          <!--*******************************************MENU TRESORERIE****************************************-->


          <!-- <div class="sb-sidenav-menu-heading">Paramètre</div> -->
          <?php
          if ($lvl == 4 ||  $lvl == 7   || $lvl == 11 || $lvl == 12) {
          ?>

            <!--**************************Config***************************-->
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages7"
              aria-expanded="false" aria-controls="collapsePages">
              <div class="sb-nav-link-icon"><i class="<?= $conf['icon'] ?>"></i></div>
              <?= $conf['title'] ?>
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePages7" aria-labelledby="headingOne"
              data-parent="#sidenavAccordion">
              <?php
              if ($lvl == 4 ||  $lvl == 7 || $lvl == 2) {
              ?>
                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#pagesCollapseError012" aria-expanded="false"
                    aria-controls="pagesCollapseError">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    <?= $utilisateur['title'] ?>
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="pagesCollapseError012" aria-labelledby="headingOne"
                    data-parent="#sidenavAccordionPages">
                    <nav class="sb-sidenav-menu-nested nav">
                      <?php
                      if ($lvl == 4 ||  $lvl == 7 || $lvl == 2) {
                      ?>

                        <a href="<?= $user_list['option1_link'] ?>"
                          class="nav-link"><?= $user_list['option1_name'] ?></a>
                      <?php } ?>

                      <?php
                      if ($lvl == 4 ||  $lvl == 7) {
                      ?>
                        <a href="<?= $user_list['option2_link'] ?>"
                          class="nav-link"><?= $user_list['option2_name'] ?></a>
                        <a href="<?= $user_list['option3_link'] ?>"
                          class="nav-link"><?= $user_list['option3_name'] ?></a>
                      <?php } ?>


                    </nav>
                  </div>
                </nav>

              <?php } ?>
              <?php
              if ($lvl == 2 || $lvl == 4 ||  $lvl == 7 || $lvl == 11 || $lvl == 12) {
              ?>
                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#pagesCollapseError1" aria-expanded="false"
                    aria-controls="pagesCollapseError">
                    <div class="sb-nav-link-icon"><i class="<?= $liste['icon'] ?>"></i></div>
                    <?= $liste['title'] ?>
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="pagesCollapseError1" aria-labelledby="headingOne"
                    data-parent="#sidenavAccordionPages">
                    <nav class="sb-sidenav-menu-nested nav">
                      <?php
                      if ($lvl == 4 ||  $lvl == 7 ||  $lvl == 2  || $lvl == 11 || $lvl == 12) {
                      ?>
                        <?php
                        if ($lvl == 4 ||  $lvl == 7) {
                        ?>
                          <a href="<?= $liste['option1_link'] ?>"
                            class="nav-link"><?= $liste['option1_name'] ?></a>
                          <a href="<?= $liste['option2_link'] ?>"
                            class="nav-link"><?= $liste['option2_name'] ?></a>
                          <a href="<?= $liste['option3_link'] ?>"
                            class="nav-link"><?= $liste['option3_name'] ?></a>
                          <a href="<?= $liste['option4_link'] ?>"
                            class="nav-link"><?= $liste['option4_name'] ?></a>
                          <a href="<?= $liste['option6_link'] ?>"
                            class="nav-link"><?= $liste['option6_name'] ?></a>
                          <a href="<?= $liste['option7_link'] ?>"
                            class="nav-link"><?= $liste['option7_name'] ?></a>
                          <a href="<?= $liste['option8_link'] ?>"
                            class="nav-link"><?= $liste['option8_name'] ?></a>
                          <a href="<?= $liste['option9_link'] ?>"
                            class="nav-link"><?= $liste['option9_name'] ?></a>
                          <a href="<?= $liste['option10_link'] ?>"
                            class="nav-link"><?= $liste['option10_name'] ?></a>
                          <a href="<?= $liste['option21_link'] ?>"
                            class="nav-link"><?= $liste['option21_name'] ?></a>
                          <a href="<?= $liste['option22_link'] ?>"
                            class="nav-link"><?= $liste['option22_name'] ?></a>
                          <a href="<?= $liste['option14_link'] ?>"
                            class="nav-link"><?= $liste['option14_name'] ?></a>
                          <a href="<?= $liste['option24_link'] ?>"
                            class="nav-link"><?= $liste['option24_name'] ?></a>
                        <?php } ?>

                        <?php
                        if ($lvl == 4 ||  $lvl == 7) {
                        ?>

                          <a href="<?= $liste['option11_link'] ?>"
                            class="nav-link"><?= $liste['option11_name'] ?></a>
                          <a href="<?= $liste['option12_link'] ?>"
                            class="nav-link"><?= $liste['option12_name'] ?></a>
                        <?php } ?>
                      <?php } ?>
                      <a href="<?= $liste['option15_link'] ?>"
                        class="nav-link"><?= $liste['option15_name'] ?></a>
                      <a href="<?= $liste['option16_link'] ?>"
                        class="nav-link"><?= $liste['option16_name'] ?></a>
                      <a href="<?= $liste['option17_link'] ?>"
                        class="nav-link"><?= $liste['option17_name'] ?></a>
                      <a href="<?= $liste['option18_link'] ?>"
                        class="nav-link"><?= $liste['option18_name'] ?></a>
                      <a href="<?= $liste['option28_link'] ?>"
                        class="nav-link"><?= $liste['option28_name'] ?></a>
                      <a href="<?= $liste['option29_link'] ?>"
                        class="nav-link"><?= $liste['option29_name'] ?></a>
                      <?php
                      if ($lvl != 2) {
                      ?>
                        <a href="<?= $liste['option19_link'] ?>"
                          class="nav-link"><?= $liste['option19_name'] ?></a>
                        <a href="<?= $liste['option20_link'] ?>"
                          class="nav-link"><?= $liste['option20_name'] ?></a>
                        <a href="<?= $liste['option23_link'] ?>"
                          class="nav-link"><?= $liste['option23_name'] ?></a>
                        <a href="<?= $liste['option25_link'] ?>"
                          class="nav-link"><?= $liste['option25_name'] ?></a>
                        <a href="<?= $liste['option26_link'] ?>"
                          class="nav-link"><?= $liste['option26_name'] ?></a>
                        <a href="<?= $liste['option27_link'] ?>"
                          class="nav-link"><?= $liste['option27_name'] ?></a>
                      <?php } ?>

                    </nav>
                  </div>

                </nav>
              <?php
              }
              ?>
            </div>
          <?php
          }
          ?>

        </div>
      </div>

      <div class="sb-sidenav-footer">
        <div class="container-fluid">
          <div class="d-flex align-items-center justify-content-between small">
            <div class="text-center">- Copyright &copy; 2021 - WIN TECHNOLOGIE</div>
          </div>
        </div>
      </div>
    </nav>
  </div>