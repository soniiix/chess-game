<?php

require_once __DIR__ . '/vendor/autoload.php';

use ChessGame\Game;
use ChessGame\Move;
use ChessGame\Position;
use ChessGame\Exception\InvalidMoveException;
use ChessGame\Exception\NoPieceException;
use ChessGame\Exception\OccupiedByAllyException;
use ChessGame\Exception\WrongTurnException;

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



/*
// Tentative de déplacement illégal
try {
    echo "Tentative de déplacement du pion blanc de e4 à e5 (illégal) :\n";
    $move = new Move(new Position(4, 4), new Position(3, 4));
    $game->play($move);
} catch (InvalidMoveException $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
}

// Tentative de déplacement d'une pièce qui n'existe pas
try {
    echo "Tentative de déplacement d'une pièce qui n'existe pas (h3 à h4) :\n";
    $move = new Move(new Position(7, 7), new Position(6, 7));
    $game->play($move);
} catch (NoPieceException $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
}

// Tentative de déplacement d'une pièce adverse
try {
    echo "Tentative de déplacement d'une pièce adverse (c6 à d4) :\n";
    $move = new Move(new Position(2, 2), new Position(4, 3));
    $game->play($move);
} catch (WrongTurnException $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
}

// Tentative de déplacement d'une pièce à une position occupée par une pièce alliée
try {
    echo "Tentative de déplacement d'une pièce à une position occupée par une pièce alliée (f3 à e4) :\n";
    $move = new Move(new Position(5, 5), new Position(4, 4));
    $game->play($move);
} catch (OccupiedByAllyException $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
}*/