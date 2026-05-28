<?php

require_once __DIR__ . '/vendor/autoload.php';

use ChessGame\Game;
use ChessGame\Move;
use ChessGame\Position;
use ChessGame\Exception\ChessException;

$game = new Game();
$game->start();
echo "Mise en place initiale du plateau :\n";
echo $game->getBoard()->render();

echo "Déplacement du pion blanc de e2 à e4 :\n";
$move = new Move(new Position(6, 4), new Position(4, 4));
$game->play($move);
echo $game->getBoard()->render();

echo "Déplacement du pion noir de e7 à e5 :\n";
$move = new Move(new Position(1, 4), new Position(3, 4));
$game->play($move);
echo $game->getBoard()->render();

echo "Déplacement du cavalier blanc de g1 à f3 :\n";
$move = new Move(new Position(7, 6), new Position(5, 5));
$game->play($move);
echo $game->getBoard()->render();

echo "Déplacement du cavalier noir de b8 à c6 :\n";
$move = new Move(new Position(0, 1), new Position(2, 2));
$game->play($move);
echo $game->getBoard()->render();

// Tests d'exceptions
echo "Déplacement d'une pièce depuis une case vide (e3 à e4) :\n";
try {
    $move = new Move(new Position(5, 4), new Position(4, 4));
    $game->play($move);
} catch (ChessException $e) {
    echo "Erreur : " . $e->getMessage() . "\n\n";
}

echo "Déplacement d'une pièce d'une couleur qui n'est pas au tour de jouer (pion noir de e5 à e4) :\n";
try {
    $move = new Move(new Position(3, 4), new Position(4, 4));
    $game->play($move);
} catch (ChessException $e) {
    echo "Erreur : " . $e->getMessage() . "\n\n";
}

echo "Déplacement d'une pièce vers une case occupée par une pièce alliée (pion blanc de d2 à e4) :\n";
try {
    $move = new Move(new Position(6, 3), new Position(4, 4));
    $game->play($move);
} catch (ChessException $e) {
    echo "Erreur : " . $e->getMessage() . "\n\n";
}