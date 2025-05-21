<?php

//$r = [
//    'title' => 'DRH',
//    'icon' => 'fas fa-cubes',
//    'name'=>'Espace Projets',
//    'link' => 'projets.php',
//                ];
//
//$nouveau_projet = [
//    'name'=>'Nouveau Projet',
//    'link' => 'ajouter_projet.php',
//];
//
//$groupement = [
//    'name'=>'Liste des Groupements',
//    'link' => 'liste_groupements.php',
//];
//
//$nouveau_groupement = [
//    'name'=>'Nouveau Groupement',
//    'link' => 'ajouter_groupement.php',
//];
//
//
//$contrat = [
//    'title' => 'Contrat',
//    'icon' => 'far fa-file-alt',
//    'name'=>'Liste des Contrats',
//    'link' => 'liste_contrats.php',
//];
//
//$nouveau_contrat = [
//    'name'=>'Nouveau Contrat',
//    'link' => 'ajouter_contrat.php',
//];
//
//$entite = [
//    'title' => 'Entités',
//    'icon' => 'fas fa-building',
//    'name'=>'Liste des Entités',
//    'link' => 'liste_entites.php',
//];
//
//$nouveau_entite = [
//    'name'=>'Nouvelle Entité',
//    'link' => 'ajouter_entite.php',
//];
//
//$contact = [
//    'name'=>'Liste des Contacts',
//    'link' => 'liste_contacts.php',
//];
//
//$personnel = [
//    'title' => 'Personnel Interne',
//    'icon' => 'fas fa-users',
//    'name'=>'Liste du Personnel',
//    'link' => 'liste_personnels.php',
//];
//
//$nouveau_personnel = [
//    'name'=>'Nouveau Personnel',
//    'link' => 'ajouter_personnel.php',
//];
//
//$courrier = [
//    'title' => 'Courrier',
//    'icon' => 'fas fa-envelope',
//    'name'=>'Service des Courriers',
//    'link' => 'courrier.php',
//];
//
//$agenda = [
//    'title' => 'Agenda',
//    'icon' => 'fas fa-book',
//    'name'=>'Service Agenda',
//    'link' => 'agenda.php',
//];
//

//-------------------------------------------------Spécialistes-------------------------------------------//
$corps_medical = [
    'title' => 'Corps Médical',
    'icon' => '	fab fa-sith',

    //  'option2_name'=>'Clients',
    // 'option2_link'=>'liste_client',
];

$speciale = [
    'title' => 'Spécialistes',
    'icon' => 'fas fa-user-circle fa-lg',

    //  'option2_name'=>'Clients',
    // 'option2_link'=>'liste_client',
];


$medecin = [
    'title' => 'Médecin',
    'icon' => 'fas fa-user-md',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_medecin.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_medecin.php',
];

$nurse = [
    'title' => 'Infirmière(ier)',
    'icon' => 'fas fa-user-nurse',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_nurse.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_nurse.php',
];

$chirugien = [
    'title' => 'Chirugien',
    'icon' => 'fas fa-id-card-alt',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_chirugien.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_chirugien.php',
];

$laboratin = [
    'title' => 'Techniciens',
    'title_single' => 'technicien',
    'icon' => 'fa fa-address-card',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_laboratin.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_laboratin.php',
];

$radiologue = [
    'title' => 'Radiologue',
    'icon' => 'fa fa-address-card',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_radiologue.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_radiologue.php',
];

$generaliste = [
    'title' => 'Géneraliste',
    'icon' => 'fab fa-slack',

    //  'option2_name'=>'Clients',
    // 'option2_link'=>'liste_client',
];

$personnel = [
    'title' => 'Personnel',
    // 'icon' => 'fas fa-users',
    'icon' => 'fas fa-users',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_personnel.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_personnel.php',
];

//-------------------------------------------------Entités-------------------------------------------//

$entite = [
    'title' => 'Entités',
    'icon' => 'fas fa-user-plus',

    //  'option2_name'=>'Clients',
    // 'option2_link'=>'liste_client',
];

$patient = [
    'title' => 'Patients',
    'icon' => 'fas fa-user-injured',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_patient.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_patient.php',
];

$fournisseur = [
    'title' => 'Fournisseurs',
    'icon' => 'fas fa-shipping-fast',

    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_four.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_four.php',
];

$entreprise = [
    'title' => 'Entreprise',
    'icon' => 'fas fa-user-md',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouvelle_entreprise.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_entreprise.php',
];

$assurances = [
    'title' => 'Assurances',
    'icon' => 'fas fa-user-md',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouvelle_assurance.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_assurance.php',
];


//-------------------------------------------------Services-------------------------------------------//

$service = [
    'title' => 'Facturations',
    'icon' => 'fas fa-handshake',

    //  'option2_name'=>'Clients',
    // 'option2_link'=>'liste_client',
];

//---------------- Consultation -------------- //


$consultation = [
    'title' => 'Consultations',
    'icon' => 'fas fa-heartbeat',
    'option1_name' => 'Nouvelle consult',
    'option1_link' => 'nouvelle_consultation.php',
    'option2_name' => 'Liste consults',
    'option2_link' => 'liste_consultation.php',
];

$examen = [
    'title' => 'Examens',
    'icon' => 'fas fa-file-medical-alt',
    'option1_name' => 'Nouveau exam',
    'option1_link' => 'nouveau_examen.php',
    'option2_name' => 'Liste exams',
    'option2_link' => 'liste_examen.php',
];

$radiologie = [
    'title' => 'Radiologie',
    'icon' => 'fas fa-x-ray',
    'option1_name' => 'Nouvelle radio',
    'option1_link' => 'nouvelle_radiologie.php',
    'option2_name' => 'Liste radios',
    'option2_link' => 'liste_radiologie.php',
];

$hospitalisation = [
    'title' => 'Hospitalisations',
    'icon' => 'fas fa-procedures',
    'option1_name' => 'Nouvelle hospi',
    'option1_link' => 'nouveau_hospitalisation.php?hospitalisation=0',
    'option2_name' => 'Liste hospis',
    'option2_link' => 'liste_hospitalisation.php',
];

$operation = [
    'title' => 'Opérations',
    'icon' => 'fas fa-plus-square',
    'option1_name' => 'Nouveau opéra',
    'option1_link' => 'nouvelle_operation.php',
    'option2_name' => 'Liste opéras',
    'option2_link' => 'liste_operation.php',
];


$ecographie = [
    'title' => 'Ecographies',
    'icon' => 'fas fa-plus-square',
    'option1_name' => 'Nouvelle écho',
    'option1_link' => 'nouvelle_ecographie.php',
    'option2_name' => 'Liste échos',
    'option2_link' => 'liste_ecographie.php',
];


$anesthesie = [
    'title' => 'Anesthésies',
    'icon' => 'fas fa-plus-square',
    'option1_name' => 'Nouvelle anesth',
    'option1_link' => 'nouveau_anesthesie.php',
    'option2_name' => 'Liste anesth',
    'option2_link' => 'liste_anesthesie.php',
];
//-------------------------------------------------autres-------------------------------------------//

$appointment = [
    'title' => 'Rendez-vous',
    'icon' => 'fas fa-calendar-alt',
    'option1_name' => 'Nouveau',
    'option1_link' => 'nouveau_appointment.php',
    'option2_name' => 'Liste',
    'option2_link' => 'liste_appointment.php',
];

$ordonnance = [
    'title' => 'Ordonnances',
    'icon' => 'fas fa-tasks',
    'option1_name' => 'Nouvelle ordo',
    'option1_link' => 'nouvelle_ordonnance_review.php?ref_ordo=andy&id_patient=0&id_agent=0&agent=\'M\'',
    'option2_name' => 'Liste ordos',
    'option2_link' => 'liste_ordonnance.php',
];


$vaccination = [
    'title' => 'Vaccination',
    'icon' => 'fas fa-syringe',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouvelle_vaccination.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_vaccination.php',
];


$prenatale = [
    'title' => 'Cons. Prénatale',
    'icon' => 'fas fa-baby',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouvelle_prenatale.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_prenatale.php',
];

$diagnostique = [
    'title' => 'Diagnostics',
    'icon' => 'fas fa-plus-square',
    'option1_name' => 'Nouveau diagnostique',
    'option1_link' => 'nouveau_diagnostique.php',
    'option2_name' => 'Liste diagnostique',
    'option2_link' => 'liste_diagnostique.php',
];



//-------------------------------------------------Archives-------------------------------------------//

$archives = [
    'title' => 'Archives',
    'icon' => 'fas fa-box-open',



    'option1_name' => 'Consultations',
    'option1_link' => 'liste_consultation_checker_archive.php',

    'option2_name' => 'Examens',
    'option2_link' => 'liste_examen_checker_archive.php',

    'option3_name' => 'Hospitalisations',
    'option3_link' => 'liste_hospitalisation_checker_archive.php',

    'option4_name' => 'Opérations',
    'option4_link' => 'liste_operation_checker_archive.php',

    'option5_name' => 'Ordonnances',
    'option5_link' => 'liste_ordonance_checker_archive.php',

    'option6_name' => 'Anesthesie',
    'option6_link' => 'liste_anesthesie_checker_archive.php',

    'option7_name' => 'Ecographie',
    'option7_link' => 'liste_ecographie_checker_archive.php',

    'option8_name' => 'Radiologie',
    'option8_link' => 'liste_radiologie_checker_archive.php',

    'option9_name' => 'Autres Services',
    'option9_link' => 'liste_autres_services_checker_archive.php',

    'option10_name' => 'Vaccination',
    'option10_link' => 'liste_vaccination_checker_archive.php',

    'option11_name' => 'Cons. Prénatale',
    'option11_link' => 'liste_prenatale_checker_archive.php',

];




$demande_produit = [
    'title' => 'Demande-Produits',
    'icon' => 'fas fa-list',
    // 'option1_name'=>'Nouveau',
    //'option1_link' => 'nouvelle_demande_produit.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_demande_produit.php',
];

$lit = [
    'title' => 'Lits',
    'icon' => 'fas fa-bed',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_lit.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_lit.php',
];

$chambre = [
    'title' => 'Chambres',
    'icon' => 'fas fa-home',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_chambre.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_chambre.php',
];

$autres_services = [
    'title' => 'Autres Services',
    'icon' => 'fas fa-plus-square',
    'option1_name' => 'Nouveau autres services',
    'option1_link' => 'nouveau_autres_services.php',
    'option2_name' => 'Liste autres services',
    'option2_link' => 'liste_autres_services.php',
];

//DRH

$mag = [
    'title' => 'Stock',
    'icon' => 'fas fa-home',

    //  'option2_name'=>'Clients',
    // 'option2_link'=>'liste_client',
];

$commande = [
    'title' => 'Commande',
    'icon' => 'fas fa-tasks',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouvelle_commande.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_commande.php',
];




$mag_centrale = [
    'title' => 'Magasin',
    'icon' => 'fas fa-hospital-alt',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_mag_centrale.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_mag_centrale.php',
];

$mag_phar = [
    'title' => 'Pharmacie',
    'icon' => 'fas fa-clinic-medical',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_mag_phar.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_mag_phar.php',
];




$transfert_prod = [
    'title' => 'Transfert Produits',
    'icon' => 'fas fa-plus-cubes',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_operation.php',
];


$produit = [
    'title' => 'Produits',
    'icon' => 'fas fa-cubes',

    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_prod.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_prod.php',
];

$cat_prod = [
    'title' => 'Catégories',
    'icon' => 'fas fa-cube',

    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_cat_prod.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_cat_prod.php',
];

$four_prod = [
    'title' => 'Produits fournisseur',
    'icon' => 'fas fa-cubes',

    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_four_prod.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_four_prod.php',
];











$fourniture = [
    'title' => 'Founitures',
    'icon' => 'fas fa-notes-medical',

    //  'option2_name'=>'Clients',
    // 'option2_link'=>'liste_client',
];


$outil = [
    'title' => 'outils',
    'icon' => 'fas fa-cubes',

    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouvelle_outil.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_outil.php',
];


$cat_outil = [
    'title' => 'Catégories',
    'icon' => 'fas fa-cube',

    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_cat_outil.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_cat_outil.php',
];

$mag_outil = [
    'title' => 'Magasin',
    'icon' => 'fas fa-hospital-alt',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_mag_outil.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_mag_outil.php',
];

$commande_outil = [
    'title' => 'Commande',
    'icon' => 'fas fa-tasks',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouvelle_com_outil.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_com_outil.php',
];


$demande_outil = [
    'title' => 'Demande-outils',
    'icon' => 'fas fa-list',
    // 'option1_name'=>'Nouveau',
    //'option1_link' => 'nouvelle_demande_produit.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_demande_outils.php',
];






$tresorie = [
    'title' => 'Trésorerie',
    'icon' => 'fab fa-cc-amazon-pay',

    //  'option2_name'=>'Clients',
    // 'option2_link'=>'liste_client',
];

$caisse = [
    'title' => 'Transfert_caisse',
    'icon' => 'fas fa-donate',

    'option1_name' => 'liste_caisse',
    'option1_link' => 'nouvelle_caisse.php',
    'option2_link' => 'liste_caisse.php',
];

$menu_caisse = [
    'title' => 'Caisses',
    'icon' => 'fas fa-donate',

    'option1_name' => 'liste_menu_caisse',
    'option1_link' => 'nouvelle_menu_caisse.php',
    'option2_link' => 'liste_menu_caisse.php',
];

$depense_caisse = [
    'title' => 'Dépense_caisse',
    'icon' => 'fas fa-donate',

    'option1_name' => 'liste_depense_caisse',
    'option1_link' => 'nouvelle_depense_caisse.php',
    'option2_link' => 'liste_depense_caisse.php',
];


$demande_caisse = [
    'title' => 'Transfert_caisse',
    'icon' => 'fas fa-donate',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouvelle_ask_caisse.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_ask_caisse.php',
];

$caution = [
    'title' => 'Caution',
    'icon' => 'fas fa-donate',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouvelle_caution.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_caution.php',
];

$retrait = [
    'title' => 'Retrait',
    'icon' => 'fas fa-donate',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_retrait.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_retrait.php',
];


//--------------- Rapport --- ---

$rapport = [
    'title' => 'Rapport',
    'icon' => 'fab fa-cc-amazon-pay',

    //  'option2_name'=>'Clients',
    // 'option2_link'=>'liste_client',
];

$rapport_caisse = [
    'title' => 'Billetage',
    'icon' => 'fas fa-donate',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_rapport_caisse.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_rapport_caisse.php',
];

$rapport_remise = [
    'title' => 'Remise',
    'icon' => 'fas fa-donate',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_rap_remise.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_rap_remise.php',
];


$rapport_vente = [
    'title' => 'Vente',
    'icon' => 'fas fa-donate',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_rap_vente.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_rap_vente.php',
];

$bilan = [
    'title' => 'Bilan',
    'icon' => 'fab fa-cc-amazon-pay',

    //  'option2_name'=>'Clients',
    // 'option2_link'=>'liste_client',
];
$bilan_mensuel = [
    'title' => 'Mensuel',
    'icon' => 'fas fa-donate',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_bilan_memsuel.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_bilan_mensuel.php',
];


$bilan_annuel = [
    'title' => 'Annuel',
    'icon' => 'fas fa-donate',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_bilan_annuel.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_bilan_annuel.php',
];

$bilan_vente = [
    'title' => 'Vente',
    'icon' => 'fas fa-donate',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_bilan_vente.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_bilan_vente.php',
];

$autreServices = [
    'title' => 'Autres services',
    'icon' => 'fas fa-donate',
    // 'option1_name'=>'Nouveau',
    'option1_link' => 'nouveau_autres_services.php',

    // 'option2_name'=>'Liste',
    'option2_link' => 'liste_autres_services.php',
];

//-------------------------------------------------Réglements-------------------------------------------//

$liste_fact = [
    'title' => 'Reglements',
    'icon' => 'fas fa-print',



    'option1_name' => 'Consultations',
    'option1_link' => 'liste_consultation_checker.php',

    'option2_name' => 'Examens',
    'option2_link' => 'liste_examen_checker.php',

    'option3_name' => 'Hospitalisations',
    'option3_link' => 'liste_hospitalisation_checker.php',

    'option4_name' => 'Opérations',
    'option4_link' => 'liste_operation_checker.php',

    'option5_name' => 'Ordonnances',
    'option5_link' => 'liste_ordonance_checker.php',

    'option6_name' => 'Anesthesie',
    'option6_link' => 'liste_anesthesie_checker.php',

    'option7_name' => 'Ecographie',
    'option7_link' => 'liste_ecographie_checker.php',

    'option8_name' => 'Radiologie',
    'option8_link' => 'liste_radiologie_checker.php',

    'option9_name' => 'Autres Services',
    'option9_link' => 'liste_autres_services_checker.php',

    'option10_name' => 'Vaccination',
    'option10_link' => 'liste_vaccination_checker.php',

    'option11_name' => 'Cons. Prénatale',
    'option11_link' => 'liste_prenatale_checker.php',

];

$certificat = [

    'title' => 'Certificats',
    'icon' => 'fas fa-print',

    'option1_name' => 'Arrêt de Travail',
    'option1_link' => 'liste_arret_travail.php',

    'option2_name' => 'errrrr',
    'option2_link' => 'liste_examen_checker.php',

];











$conf = [
    'title' => 'Configuration',
    'icon' => 'fas fa-cogs',

    // 'option1_name'=>'Nouvelle',
    // 'option1_link'=>'nouvelle_sanction',

    // 'option2_name'=>'Liste',
    // 'option2_link'=>'liste_sanction',
];

//Paramètre  
$liste = [
    'title' => 'Listes Prédéfinies',
    'icon' => 'fas fa-list-ul',

    'option1_name' => 'Services',
    'option1_link' => 'liste_departement.php',

    'option2_name' => 'Spécialité',
    'option2_link' => 'liste_specialiste.php',


    'option3_name' => 'Bloc Opératoire',
    'option3_link' => 'liste_bloc_operation.php',


    'option4_name' => 'Salle de soin',
    'option4_link' => 'liste_salle_soin.php',

    'option5_name' => 'Poste',
    'option5_link' => 'liste_poste.php',

    'option6_name' => 'Salle  d\'accueil',
    'option6_link' => 'liste_salle_malade.php',

    'option7_name' => 'Mode de paiement',
    'option7_link' => 'liste_mode_paiement.php',

    'option8_name' => 'Type d\'Examens',
    'option8_link' => 'liste_type_examen.php',

    'option9_name' => 'Type d\'Hospitalisations',
    'option9_link' => 'liste_type_hospitalisation.php',

    'option10_name' => 'Type d\'Opérations',
    'option10_link' => 'liste_type_operation.php',


    'option11_name' => 'Caisses',
    'option11_link' => 'liste_add_caisse.php',

    'option12_name' => 'Commissions',
    'option12_link' => 'liste_commission.php',

    'option13_name' => 'Quartier',
    'option13_link' => 'liste_quartier.php',

    'option14_name' => 'Type consultation',
    'option14_link' => 'liste_type_consultation.php',

    'option15_name' => 'Ville',
    'option15_link' => 'liste_ville.php',


    'option16_name' => 'Pays',
    'option16_link' => 'liste_pays.php',

    'option17_name' => 'Quartiers',
    'option17_link' => 'liste_quartier.php',

    'option18_name' => 'Profession',
    'option18_link' => 'liste_profession.php',

    'option19_name' => 'Lits',
    'option19_link' => 'nouveau_lit.php',

    'option20_name' => 'Chambres',
    'option20_link' => 'nouvelle_chambre.php',

    'option21_name' => 'Type d\'écographie',
    'option21_link' => 'liste_type_ecographie.php',

    'option22_name' => 'Type d\'anesthesie',
    'option22_link' => 'liste_type_anesthesie.php',

    'option23_name' => 'Catégorie d\'examen ',
    'option23_link' => 'liste_cat_type_exa.php',

    'option24_name' => 'Type de radiologie',
    'option24_link' => 'liste_type_radiologie.php',

    'option25_name' => 'Type d\' échantillon ',
    'option25_link' => 'liste_type_echantillon.php',

    'option26_name' => 'Banques',
    'option26_link' => 'liste_add_banque.php',

    'option27_name' => 'Autres Services',
    'option27_link' => 'liste_autre_service.php',

    'option28_name' => 'Maladies',
    'option28_link' => 'liste_maladie.php',

    'option29_name' => 'Vaccins',
    'option29_link' => 'liste_vaccin.php',
];

$user_list = [
    'title' => 'Listes Users',
    'icon' => 'fas fa-list-ul',

    'option1_name' => 'Users Patients',
    'option1_link' => 'liste_user_patient.php',

    'option2_name' => 'Users spécialistes',
    'option2_link' => 'liste_user_specialiste.php',


    'option3_name' => 'Users personnels',
    'option3_link' => 'liste_user_personnel.php',
];

$utilisateur = [
    'title' => 'Utilisateurs',
    'icon' => 'fas fa-user',

    'option1_name' => '#',
    'option1_link' => 'liste_utilisateurs.php',


];

// $activite = [
//     'title' => 'MES ACTIVITES',
//     'icon' => 'fas fa-cogs',

//     'option1_name'=>'Mes Pointages',
//     'option1_link'=>'mes_pointages',

//     'option2_name'=>'Mes Congés',
//     'option2_link'=>'mes_conges',

//     'option3_name'=>'Mes Crédits',
//     'option3_link'=>'mes_credits',
// ];

// $credit = [

//     'option1_name'=>'Credit à valider',
//     'option1_link'=>'liste_credit_valide',

//     'option2_name'=>'Liste des crédits',
//     'option2_link'=>'liste_credit',

//     'option3_name'=>'Etats des pointages',
//     'option3_link'=>'etat_pointages',

// ];

// $conger = [

//     'option1_name'=>'Congé à valider',
//     'option1_link'=>'liste_conger_valide',

//     'option2_name'=>'Liste des congés',
//     'option2_link'=>'liste_conger',

// ];
