<?php

// Initialise Twig
include('include/twig.php');

$twig = init_twig();

// Lancement du moteur Twig avec les données
echo $twig->render('base.twig', [
]);



