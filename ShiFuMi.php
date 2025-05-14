<?php

define('HISTORIQUE_FILE', __DIR__ . '/historique.json');

if (!file_exists(HISTORIQUE_FILE)) {
    file_put_contents(HISTORIQUE_FILE, json_encode([]));
}

function jouerPartie() {
    $options = ['1' => 'Pierre', '2' => 'Feuille', '3' => 'Ciseaux'];

    echo "\n=== Nouvelle Partie ===\n";
    foreach ($options as $key => $val) {
        echo "$key. $val\n";
    }
    echo "0. Retour au menu\n";
    echo "Votre choix : ";
    $choix = trim(fgets(STDIN));

    if ($choix === '0') {
        echo "Retour au menu principal.\n";
        return;
    }

    if (!array_key_exists($choix, $options)) {
        echo "Choix invalide.\n";
        return;
    }

    $joueur = $options[$choix];
    $ordi = $options[array_rand($options)];

    echo "Vous avez choisi : $joueur\n";
    echo "L'ordinateur a choisi : $ordi\n";

    $resultat = determinerGagnant($joueur, $ordi);
    echo "Résultat : $resultat\n";

    enregistrerPartie($joueur, $ordi, $resultat);
}

function determinerGagnant($joueur, $ordi) {
    if ($joueur === $ordi) return "Égalité";

    $gagnants = [
        'Pierre' => 'Ciseaux',
        'Feuille' => 'Pierre',
        'Ciseaux' => 'Feuille'
    ];

    return $gagnants[$joueur] === $ordi ? "Victoire" : "Défaite";
}

{

    $victoires = $défaites = $égalités = 0;
    foreach ($data as $partie) {
        match ($partie['résultat']) {
            'Victoire' => $victoires++,
            'Défaite' => $défaites++,
            'Égalité' => $égalités++,
        };
    }

    echo "Total parties : " . count($data) . "\n";
    echo "Victoires : $victoires\n";
    echo "Défaites : $défaites\n";
    echo "Égalités : $égalités\n";
}
