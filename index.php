<?php

require_once __DIR__ . '/vendor/autoload.php';

use ChessGame\Game;

$game = new Game();
$game->start();
$game->getBoard()->render();