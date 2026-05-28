<?php

namespace ChessGame\Exception;
use Exception;

class WrongTurnException extends Exception {
    public function __construct() {
        parent::__construct("Ce n'est pas au tour de cette couleur de jouer.");
    }
}